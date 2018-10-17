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

    
    //Recognition on due date
    function run_unearned() {

        $filehandle = fopen("./cron/unearned.txt", "w+");
        if (flock($filehandle, LOCK_EX | LOCK_NB)) {
            $year2 = active_year();
            $year2 = substr($year2, -4);
            $leo = date($year2.'-06-30');
            echo  $leo;
            //$leo = date('Y-m-d');
            $check = $this->db->query("SELECT * FROM loan_contract_repayment_schedule WHERE status = 0 AND unearned !='1' AND repaydate <= '$leo' LIMIT 100")->result();
            if(count($check) > 0){
                
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

                //$ledger_entry = array('date' => date('Y-m-d'), 'PIN' => $value->PIN);
                $ledger_entry = array('date' => date("Y-m-d", strtotime($value->repaydate)), 'PIN' => $value->PIN);
                $this->db->insert('general_ledger_entry', $ledger_entry);
                $ledger_entry_id = $this->db->insert_id();

                $ledger = array(
                    'journalID' => 4,
                    'refferenceID' => $referenceID,
                    'entryid' => $ledger_entry_id,
                    'LID' => $LID,
                    //'date' => date('Y-m-d'),
                    'date' => date("Y-m-d", strtotime($value->repaydate)),
                    //'description' => 'Loan Repayment',
                    'description' => 'Interest For '.date("F, Y", strtotime($value->repaydate)),
                    'linkto' => 'loan_contract_repayment_unearned.id',
                    'fromtable' => 'loan_contract_repayment_unearned',
                    'paid' => 0,
                    'year' => active_year(),
                    'PIN' => $value->PIN,
                    'PID' => $infodata->PID,
                    'member_id' => $infodata->member_id,
                );



                //Debit Interest Receivable
                $ledger['credit'] = 0;
                $ledger['debit'] = 0;
                $debit_account = $product->loan_interest_receivable_account;                
                $ledger['account'] = $debit_account;
                $ledger['debit'] = $value->interest;
                $infoaccount = account_row_info($ledger['account']);
                $ledger['account_type'] = $infoaccount->account_type;
                $ledger['sub_account_type'] = $infoaccount->sub_account_type;
                $this->db->insert('general_ledger', $ledger);

                //Credit Interest Income
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
            
        } else {
                       
            //repay from prepayment account on due date automatically
            echo "here";
            $this->auto_repayment_from_prepayment_account();
            
        }

            flock($filehandle, LOCK_UN);  // don't forget to release the lock
        } else {
            
        }

        fclose($filehandle);
    }
    
    
    
    
    
    
    
    
    
    
    //POSTING OF PREPAYMENTS  On due date AUTOMATICALY
    function auto_repayment_from_prepayment_account() {
        $check2 = $this->db->query("SELECT * FROM loan_balance_carry WHERE balance > 0  LIMIT 100")->result();
        
        
      
        $this->data['loanlist'] = $this->loan_model->loan_repay_list();
      
        

        if (count($check2) > 0) {
           
            foreach ($check2 as $key2 => $value2) {
                
            $pin = $value2->PIN;
            $amount = 0;
            $repaid_amount = $amount;
            $LID = $value2->LID;
            $paydate = $this->loan_model->get_previous_receipt_date($LID, $pin);
            //$paydate = date('Y-m-d');


            $loaninfo = $this->loan_model->loan_info($LID)->row();
            $product = $this->setting_model->loanproduct($loaninfo->product_type)->row();

            $open_repayment = $this->loan_model->open_repayment_installment($LID);
            $previous_remain_balance = $value2->balance;
            $previous_remain_balance_id = $value2->id;
             
            
            //current money in hand
            $amount_tmp = ($amount + $previous_remain_balance);
           
            $received_account = $product->loan_prepayment_account;  //this is loan prepayment account
          
            $error_array = array();
            $success_array = array();
            if ($amount >= 0) {
                if ($loaninfo->status == 4) {
                    $this->db->trans_start();
                    if (count($open_repayment) > 0) {
                        //$receipt = $this->loan_model->loan_repay_receipt($LID, $amount, $paydate);
                         $receipt = $this->loan_model->get_previous_receipt($LID, $pin);
                       
                       if ($receipt != ''){
                         
                         foreach ($open_repayment as $key => $value) {
                             //pull already made payments
                             $former = $this->loan_model->installment_paid_amount($LID, $value->installment_number);
                             foreach($former as $key3 => $former_payments){
                             $amount_already_paid = $former_payments->tamount; //was insuffienty paid
                             $interest_already_paid = $former_payments->interest_paid;
                             $principle_already_paid = $former_payments->principle_paid;
                             $penalty_already_paid = $former_payments->penalt_paid;
                             }
                             
                         //check if Unerned already runed
                         $unearned = $this->db->get_where('loan_contract_repayment_unearned', array('id' => $value->id, 'LID' => $LID,'earned'=>0))->row();
                         if ($unearned) {
                           
                            $repay_amount_install = $value->repayamount;
                            $repay_amount_install_original = $value->repayamount;
                            $repay_amount_install -= $amount_already_paid; 
                           
                            
                            if ($amount_tmp >= $repay_amount_install) {
                                
                                //there is at least one installment in this stage
                                //check due date
                                $warning_days = $product->warning_day;
                                $max_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($value->repaydate)) . " +" . $warning_days . " days"));

                                if ($paydate <= $max_date) {
                                   
                                    //amewah kulipa
                                    //insert data
                                    $amount_tmp -= $repay_amount_install;
                                    $deductforbalance = $repay_amount_install_original - ($amount_already_paid + $repay_amount_install);
                                    
                                    $array_data = array(
                                        'LID' => $LID,
                                        'receipt' => $receipt,
                                        'installment' => $value->installment_number,
                                        'amount' => $repay_amount_install,
                                        'paydate' => $paydate,
                                        'interest' => $value->interest - $interest_already_paid,
                                        'principle' => $value->principle- $principle_already_paid,
                                        'duedate' => $value->repaydate,
                                        'balance' => $value->balance + $deductforbalance,
                                        'iliyobaki' => round($amount_tmp, 2),
                                        'createdby' => 0,
                                        'PIN' => $pin,
                                    );
                                            
                                    $this->loan_model->record_loan_repayment($array_data, $value->id,$received_account);
                                     
                                     // insert as balance for next installment                                                                  
                                     $this->loan_model->add_remain_balance($LID, round($amount_tmp, 2));                                     
                                    
                                } else {
                                    
                                    
                                    //kachelewa kulipa
                                    //get_number of months
                                    $d1 = new DateTime($max_date);
                                    $d2 = new DateTime($paydate);
                                    $number_of_day = $d1->diff($d2)->days;
                                    $number_months = ($d1->diff($d2)->m + ($d1->diff($d2)->y * 12));
                                    $number_months += 1;

                                    $penalt_method = $product->penalt_method;
                                    //$penalt_percentage = $product->penalt_percentage;
                                    $penalt_percentage = $loaninfo->penalt_percent;
                                    $penalt = 0;
                                    $principle = $value->principle;
                                    $interest = $value->interest;
                                    if ($penalt_method == 1) {
                                        //only on principle
                                        $penalt = (($penalt_percentage / 100) * $principle);
                                    } else if ($penalt_method == 2) {
                                        $tmp2 = $principle + $interest;
                                        $penalt = (($penalt_percentage / 100) * $tmp2);
                                    } else if ($penalt_method == 3) {
                                        $tmp2 = $repay_amount_install;
                                        $number_months = $number_of_day;
                                        $penalt = ((($penalt_percentage / 100) * $tmp2) / 30);
                                    }

                                    $penalt_avail = round($penalt, 2);
                                    $test_remain = ($repay_amount_install + ($penalt_avail * $number_months));

                                    if ($amount_tmp >= $test_remain) {
                                        //good
                                       
                                       $amount_tmp -= $test_remain;
                                       
                                       $deductforbalance = ($repay_amount_install_original + ($penalt_avail * $number_months)) - ($amount_already_paid + $test_remain);
                                  
                                        $array_data = array(
                                            'LID' => $LID,
                                            'receipt' => $receipt,
                                            'installment' => $value->installment_number,
                                            'amount' => $test_remain,
                                            'paydate' => $paydate,
                                            'interest' => $value->interest - $interest_already_paid,
                                            'principle' => $value->principle - $principle_already_paid,
                                            'balance' => $value->balance + $deductforbalance,
                                            'duedate' => $value->repaydate,
                                            'iliyobaki' => round($amount_tmp, 2),
                                            'penalt' => ($penalt_avail * $number_months) - $penalty_already_paid,
                                            'penalty_months' => $number_months,
                                            'createdby' => 0,
                                            'PIN' => $pin,
                                        );                                       
                                  
//print_r($array_data);
//echo '</pre>';                         
//exit;                               
                                       
                                        $this->loan_model->record_loan_repayment($array_data, $value->id,$received_account);
                                         // insert as balance for next installment                                                                  
                                        $this->loan_model->add_remain_balance($LID, round($amount_tmp, 2));                                     
                                    
                                    } else {                                       
                                        
                                        //When accrual is run but the amount is insufficient and there is penalty
                                    $insufficient_amount = $amount_tmp + $amount_already_paid; //including the previous insufficient amount  
                                     
                                    $penalty_before=$penalt_avail * $number_months;
                                    
                                    $deductforbalance = ($repay_amount_install_original + ($penalt_avail * $number_months)) - ($amount_already_paid + $amount_tmp);
                                  
                                    
                                    $balance_after = $value->balance + $deductforbalance;
                                   
                                    $installment_after = $amount_tmp;
                                    $interest_priority = 0;
                                    $principle_not_priority = 0;
                                    $penalty_not_priority = 0;
                                    
                                    if($value->interest > 0){
                                    //Pay interest as priority
                                    if(($value->interest-$interest_already_paid) > $amount_tmp){
                                    $interest_priority = $amount_tmp;
                                    $amount_tmp = 0;
                                    } else if(($value->interest-$interest_already_paid) == $amount_tmp){
                                    $interest_priority = $amount_tmp;
                                    $amount_tmp = 0;
                                    } else if(($value->interest - $interest_already_paid) < $amount_tmp){
                                    $interest_priority = ($value->interest - $interest_already_paid);
                                    $amount_tmp -= $interest_priority;
                                    }}
                                    
                                    
                                    
                                    if($value->principle > 0){
                                    if ($amount_tmp > 0) {
                                        //now pay principle if there still some amount
                                    if(($value->principle - $principle_already_paid) > $amount_tmp){
                                    $principle_not_priority = $amount_tmp;
                                    $amount_tmp = 0;
                                    } else if(($value->principle - $principle_already_paid) == $amount_tmp){
                                    $principle_not_priority = $amount_tmp;
                                    $amount_tmp = 0;
                                    } else if(($value->principle - $principle_already_paid) < $amount_tmp){
                                    $principle_not_priority = ($value->principle - $principle_already_paid);
                                    $amount_tmp -= $principle_not_priority;
                                    }                                        
                                    }}
                                    
                                    if ($amount_tmp > 0) {
                                        //now pay penalty if there still some amount
                                    if(($penalty_before-$penalty_already_paid) > $amount_tmp){
                                    $penalty_not_priority = $amount_tmp;
                                    $amount_tmp = 0;
                                    } else if(($penalty_before - $penalty_already_paid) == $amount_tmp){
                                    $penalty_not_priority = $amount_tmp;
                                    $amount_tmp = 0;
                                    } else if($penalty_before < $amount_tmp){
                                    $penalty_not_priority = ($penalty_before - $penalty_already_paid);
                                    $amount_tmp -= $penalty_not_priority;
                                    }
                                        
                                    }
                                    
                                    
                                    
                                    
                                    $array_data = array(
                                        'LID' => $LID,
                                        'receipt' => $receipt,
                                        'installment' => $value->installment_number,
                                        'amount' => $installment_after,
                                        'paydate' => $paydate,
                                        'interest' => $interest_priority,
                                        'principle' => $principle_not_priority,
                                        'duedate' => $value->repaydate,
                                        'balance' => $balance_after,
                                        'iliyobaki' => round($amount_tmp, 2),
                                        'penalt' => $penalty_not_priority,
                                        'penalty_months' => $number_months,
                                        'createdby' => current_user()->id,
                                        'PIN' => $pin,
                                    );
                                  
                                    
                                    $this->loan_model->record_loan_repayment_insufficient($array_data, $value->id,$received_account, $insufficient_amount);
                                    
                                     // insert as balance for next installment
                                    $this->loan_model->add_remain_balance($LID, round($amount_tmp, 2));
                                    $previous_remain_balance_id = $this->loan_model->get_previous_remain_balance_id($LID);
                                    break;             
                      
                                        
                                        
                                        
                                        
                                        
                                        
                                    }
                                }
                            } else { 
                                if ($amount_tmp > 0) {
                                       //When accrual is run but the amount is insufficient
                                    
                                    $insufficient_amount = $amount_tmp + $amount_already_paid; //including the previous insufficient amount  
                                    $interest_priority = 0;
                                    $principle_not_priority = 0;
                                      
                                    $deductforbalance = $repay_amount_install_original - ($amount_already_paid + $amount_tmp);
                                    
                                    $balance_after = $value->balance + $deductforbalance;
                                    $installment_after = $amount_tmp;
                                    
                                    
                                    if($value->interest > 0){
                                    //Pay interest as priority
                                    if(($value->interest - $interest_already_paid) > $amount_tmp){
                                    $interest_priority = $amount_tmp;
                                    $amount_tmp = 0;
                                    } else if(($value->interest - $interest_already_paid) == $amount_tmp){
                                    $interest_priority = $amount_tmp;
                                    $amount_tmp = 0;
                                    } else if(($value->interest - $interest_already_paid) < $amount_tmp){
                                    $interest_priority = ($value->interest - $interest_already_paid);
                                    $amount_tmp -= $interest_priority;
                                    }}                                    
                                   
                                    
                                    if($value->principle > 0){
                                    if ($amount_tmp > 0) {
                                        //now pay principle if there still some amount
                                    if(($value->principle-$principle_already_paid) > $amount_tmp){
                                    $principle_not_priority = $amount_tmp;
                                    $amount_tmp = 0;
                                    } else if(($value->principle - $principle_already_paid) == $amount_tmp){
                                    $principle_not_priority = $amount_tmp;
                                    $amount_tmp = 0;
                                    } else if(($value->principle-$principle_already_paid) < $amount_tmp){
                                    $principle_not_priority = ($value->principle - $principle_already_paid);
                                    $amount_tmp -= $principle_not_priority;
                                    }                                        
                                    }}
                                     
                                    
                                    $array_data = array(
                                        'LID' => $LID,
                                        'receipt' => $receipt,
                                        'installment' => $value->installment_number,
                                        'amount' => $installment_after,
                                        'paydate' => $paydate,
                                        'interest' => $interest_priority,
                                        'principle' => $principle_not_priority,
                                        'duedate' => $value->repaydate,
                                        'balance' => $balance_after,
                                        'iliyobaki' => round($amount_tmp, 2),
                                        'createdby' => current_user()->id,
                                        'PIN' => $pin,
                                    );
                                    
                                    
                                    
                                    $this->loan_model->record_loan_repayment_insufficient($array_data, $value->id,$received_account, $insufficient_amount);
                                                                 
                                    
                                    // insert as balance for next installment                                                                  
                                     $this->loan_model->add_remain_balance($LID, round($amount_tmp, 2));                                     
                                     $previous_remain_balance_id = $this->loan_model->get_previous_remain_balance_id($LID);
                                     break;             
                      
                                } else {

                                    break;
                                }
                            }
                         } else {
                        
                             
                         }
                        }


                        $this->db->trans_complete();
                        //$this->session->set_flashdata('next_customer', site_url(current_lang() . '/loan/loan_repayment'));
                       // $this->session->set_flashdata('next_customer_label', 'Process New Loan Repayment');

                        //redirect(current_lang() . '/loan/view_loanreceipt/' . $receipt, 'refresh');
                     } else { 
                         
                          $this->data['warning'] = 'No previous receipt was found';
             
                     }
                    } else {
                        $this->data['warning'] = 'No open installment available for new payment';
                    }
                } else {
                    $this->data['warning'] = 'Invalid Operation, Loan Status does not allow Repayment process';
                }
            } else {
                $this->data['warning'] = 'Amount should be greater than 0';
            }
       
        
        }
            
      }
        

        
    }

    
    
    
    
    

}
