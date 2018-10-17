<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of provision
 *
 * @author miltone
 */
class provision extends CI_Controller {

    //put your code here

    function __construct() {
        parent::__construct();

        $this->data['current_title'] = lang('page_loan');
        $this->load->library('loanbase');
        $this->load->model('finance_model');
        $this->load->model('loan_model');
        $this->load->model('setting_model');
    }

    function provision_info($id) {
        $this->db->where('id', $id);
        return $this->db->get('provision_rate')->row();
    }

    function get_provision($days) {
        $result = $this->db->query("SELECT * FROM provision_rate ORDER BY days DESC")->result();
        foreach ($result as $key => $value) {

            if ($days >= $value->days) {
                return $value;
            }
        }

        return FALSE;
    }

    function balance_outstanding_loan($LID) {
        $sql = "SELECT SUM(principle) as principle,SUM(interest) as interest FROM loan_contract_repayment WHERE LID='$LID'";
        $result = $this->db->query($sql)->row();
        $loan = $this->db->get_where('loan_contract', array('LID' => $LID))->row();
        $balance = ($loan->basic_amount + $loan->total_interest_amount);
        if ($result) {
            $balance-=$result->principle;
            $balance-=$result->interest;
        }

        return $balance;
    }

    function balance_outstanding_principle($LID) {
        $sql = "SELECT SUM(principle) as principle,SUM(interest) as interest FROM loan_contract_repayment WHERE LID='$LID'";
        $result = $this->db->query($sql)->row();
        $loan = $this->db->get_where('loan_contract', array('LID' => $LID))->row();
        $balance = ($loan->basic_amount);
        if ($result) {
            $balance-=$result->principle;            
        }

        return $balance;
    }
    
    function provision_rate() {
         $filehandle = fopen("./cron/lock.txt", "w+");
           if (flock($filehandle, LOCK_EX | LOCK_NB)) {
        $leo = date('Y-m-d');
        $sql = "SELECT loan_contract_repayment_schedule.*,(SELECT repaydate FROM loan_contract_repayment_schedule WHERE loan_contract_repayment_schedule.LID=LID AND status=0 ORDER BY repaydate ASC LIMIT 1 ) as early_date FROM loan_contract_repayment_schedule INNER JOIN loan_contract ON loan_contract.LID=loan_contract_repayment_schedule.LID  WHERE loan_contract_repayment_schedule.repaydate <= '$leo' AND loan_contract_repayment_schedule.status = '0' AND loan_contract.status=4 GROUP BY loan_contract_repayment_schedule.LID ";
        $result = $this->db->query($sql)->result();
        //print_r($result);
        

        foreach ($result as $key => $value) {


            $infodata = $this->loan_model->loan_info($value->LID)->row();
            
            $product = $this->setting_model->loanproduct($infodata->product_type)->row();
            $max_date = date('Y-m-d', strtotime('+' . ($product->warning_day + 1) . ' days', strtotime($value->repaydate)));

              $d1 = new DateTime($max_date);
              $d2 = new DateTime($leo);
              $number_of_day = $d1->diff($d2)->days;
              $provision = $this->get_provision($number_of_day);
 

//echo "date1 ".$max_date."<br>";
//echo "date1 ".$leo."<br>";
              
              if ($provision) {

              $check_provision_amount = $this->db->query(" SELECT SUM(credit) as credit,SUM(debit) as debit FROM provision_baddebt_transaction WHERE LID = '$value->LID'")->row();
              $previous_amount = 0;
              if ($check_provision_amount) {
              $previous_amount = $check_provision_amount->credit - $check_provision_amount->debit;
              }
              
 
              $outstanding_principle = $this->balance_outstanding_principle($value->LID);

            $prov_amount = (($provision->rate / 100) * $outstanding_principle);
             $prov_amount_remain = round(($prov_amount - $previous_amount), 2);
              if ($prov_amount_remain > 0) {
              
                  $this->db->trans_start();
              $insert_record = array(
              'LID' => $value->LID,
              'classfication' => $provision->id,
              'days' => $number_of_day,
              'provision_rate' => $provision->rate,
              'credit' => $prov_amount_remain,
              );
             
               //print_r($insert_record); echo "<br>";              
             
             
              $checkxx = $this->db->get_where('provision_rate_status', array('LID' => $value->LID))->row();
              if ($checkxx) {
              $this->db->update('provision_rate_status', array('classfication' => $provision->id,'days'=>$number_of_day,'rate'=>$provision->rate), array('LID' => $value->LID));
              } else {
              $this->db->insert('provision_rate_status', array('classfication' => $provision->id, 'LID' => $value->LID,'days'=>$number_of_day,'rate'=>$provision->rate));
              }

              $this->db->insert('provision_baddebt_transaction', $insert_record);
              $last_insert = $this->db->insert_id();

              $ledger_entry = array('date' => date('Y-m-d'), 'PIN' => $value->PIN);
              $this->db->insert('general_ledger_entry', $ledger_entry);
              $ledger_entry_id = $this->db->insert_id();

              // $infodata = $this->loan_model->loan_info($check->LID)->row();
              //ledger data
              $ledger = array(
              'journalID' => 4,
              'entryid' => $ledger_entry_id,
              'LID' => $value->LID,
              'refferenceID' => $last_insert,
              'date' => date('Y-m-d'),
              'description' => 'Provision for doubtful',
              'linkto' => 'provision_baddebt_transaction.id',
              'fromtable' => 'provision_baddebt_transaction',
              'paid' => 0,
              'PID' => $infodata->PID,
              'member_id' => $infodata->member_id,
              'PIN' => $value->PIN,
              'classfication' => $provision->id,
              'loan_installno' => $value->installment_number,
                  'year'=>  active_year()
              );


              //debit Bad Dept account
              $ledger['credit'] = 0;
              $ledger['debit'] = 0;
              $debit_account = 5000033;                            
              $ledger['account'] = $debit_account;
              $ledger['debit'] = $prov_amount_remain;
              //$ledger['account_type'] = account_row_info($ledger['account'])->account_type;
              $infoaccount = account_row_info($ledger['account']);
              $ledger['account_type'] = $infoaccount->account_type;
              $ledger['sub_account_type'] = $infoaccount->sub_account_type;
              $this->db->insert('general_ledger', $ledger);

              //Credit Provision for doubtful
              $ledger['credit'] = 0;
              $ledger['debit'] = 0;
              //$debit_account = $infodata->loan_principle_account;            
              $debit_account = 2010018;
              $ledger['account'] = $debit_account;
              $ledger['credit'] = $prov_amount_remain;
              //$ledger['account_type'] = account_row_info($ledger['account'])->account_type;
              $infoaccount = account_row_info($ledger['account']);
              $ledger['account_type'] = $infoaccount->account_type;
              $ledger['sub_account_type'] = $infoaccount->sub_account_type;
              $this->db->insert('general_ledger', $ledger);
              $this->db->trans_complete();
 
 
              }
 
 
              } 
        }
        
        
        
          flock($filehandle, LOCK_UN);  // don't forget to release the lock
          } else {

          }

          fclose($filehandle);

         
    }

    function run_unearned() {

        $filehandle = fopen("./cron/unearned.txt", "w+");
        if (flock($filehandle, LOCK_EX | LOCK_NB)) {
            $leo = date('Y-m-d');
            $check = $this->db->query("SELECT * FROM loan_contract_repayment_schedule WHERE status = 0 AND unearned !='1' AND repaydate < '$leo' LIMIT 100")->result();

            foreach ($check as $key => $value) {
                $this->db->trans_start();

                $unearned = array(
                    'id' => $value->id,
                    'LID' => $value->LID,
                    'installment_number' => $value->installment_number,
                    'repaydate' => $value->repaydate,
                    'repayamount' => $value->repayamount,
                    'interest' => $value->interest,
                    'principle' => $value->principle,
                    'balance' => $value->balance,
                    'status' => $value->status,
                    'PIN' => $value->PIN,
                );

                $this->db->insert('loan_contract_repayment_unearned', $unearned);
                $referenceID = $this->db->insert_id();

                $LID = $value->LID;
                $infodata = $this->loan_model->loan_info($LID)->row();

                $product = $this->setting_model->loanproduct($infodata->product_type)->row();

                $ledger_entry = array('date' => date('Y-m-d'), 'PIN' => $value->PIN);
                $this->db->insert('general_ledger_entry', $ledger_entry);
                $ledger_entry_id = $this->db->insert_id();

                $ledger = array(
                    'journalID' => 4,
                    'refferenceID' => $referenceID,
                    'entryid' => $ledger_entry_id,
                    'LID' => $LID,
                    'date' => date('Y-m-d'),
                    'description' => 'Loan Repayment',
                    'linkto' => 'loan_contract_repayment_unearned.id',
                    'fromtable' => 'loan_contract_repayment_unearned',
                    'paid' => 0,
                    'year' => active_year(),
                    'PIN' => $value->PIN,
                    'PID' => $infodata->PID,
                    'member_id' => $infodata->member_id,
                );



                //Debit Client Loan Account
                $ledger['credit'] = 0;
                $ledger['debit'] = 0;
                $debit_account = $infodata->loan_principle_account;
                $ledger['account'] = $debit_account;
                $ledger['debit'] = $value->interest;
                //$ledger['account_type'] = account_row_info($ledger['account'])->account_type;
                $infoaccount = account_row_info($ledger['account']);
                $ledger['account_type'] = $infoaccount->account_type;
                $ledger['sub_account_type'] = $infoaccount->sub_account_type;
                $this->db->insert('general_ledger', $ledger);

                //Credit Income Account
                $ledger['credit'] = 0;
                $ledger['debit'] = 0;
                $ledger['account'] = $product->loan_interest_account;
                $ledger['credit'] = $value->interest;

                $infoaccount = account_row_info($ledger['account']);
                $ledger['account_type'] = $infoaccount->account_type;
                $ledger['sub_account_type'] = $infoaccount->sub_account_type;
                $this->db->insert('general_ledger', $ledger);

                $ledger['credit'] = 0;
                $ledger['debit'] = 0;
                $ledger['account'] = 3000002;

                $infoaccount = account_row_info($ledger['account']);
                $ledger['account_type'] = $infoaccount->account_type;
                $ledger['sub_account_type'] = $infoaccount->sub_account_type;
                $ledger['credit'] = $value->interest;
                $this->db->insert('general_ledger', $ledger);
                $this->db->update('loan_contract_repayment_schedule', array('unearned' => 1), array('id' => $value->id));

                $this->db->trans_complete();
            }

            flock($filehandle, LOCK_UN);  // don't forget to release the lock
        } else {
            
        }

        fclose($filehandle);
    }

}
