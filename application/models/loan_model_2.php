<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loan_model
 *
 * @author miltone
 */
class Loan_Model extends CI_Model {

    //put your code here

    function __construct() {
        parent::__construct();
    }

    function is_loan_product_exist($product_id) {
        $this->db->where('PIN', current_user()->PIN);
        $this->db->where('id', $product_id);
        $come = $this->db->get('loan_product')->row();
        if (count($come) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function is_loan_exist($loan_id) {
        $this->db->where('PIN', current_user()->PIN);
        $this->db->where('LID', $loan_id);
        $come = $this->db->get('loan_contract')->row();
        if (count($come) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function get_declaration($loanid) {
        $this->db->where('PIN', current_user()->PIN);
        $this->db->where('LID', $loanid);
        $come = $this->db->get('loan_contract_declaration')->row();
        if ($come) {
            return $come;
        } else {
            $new = new stdClass();
            $new->declaration = '--------';
            return $new;
        }
    }

    function get_supporting_doc($loanid) {
        $this->db->where('PIN', current_user()->PIN);
        $this->db->where('LID', $loanid);
        return $this->db->get('loan_contract_supportdoc')->result();
    }

    function loan_declaration($data) {
        $pin = current_user()->PIN;
        $check = $this->db->get_where('loan_contract_declaration', array('LID' => $data['LID'], 'PIN' => $pin))->row();
        if (count($check) == 1) {
            return $this->db->update('loan_contract_declaration', $data, array('LID' => $data['LID'], 'PIN' => $pin));
        } else {
            return $this->db->insert('loan_contract_declaration', $data);
        }
    }

    function loan_evaluation_history($loanid) {
        $sql = "SELECT loan_contract_evaluation.*,loan_status.name,users.first_name,users.last_name FROM loan_contract_evaluation "
                . "INNER JOIN loan_status  ON loan_status.code = loan_contract_evaluation.status "
                . "INNER JOIN users  ON loan_contract_evaluation.createdby = users.id  WHERE loan_contract_evaluation.LID='$loanid'  order by loan_contract_evaluation.createdon desc";
        return $this->db->query($sql);
    }

    function loan_approval_history($loanid) {
        $sql = "SELECT loan_contract_approve.*,loan_status.name,users.first_name,users.last_name FROM loan_contract_approve "
                . "INNER JOIN loan_status  ON loan_status.code = loan_contract_approve.status "
                . "INNER JOIN users  ON loan_contract_approve.createdby = users.id  WHERE loan_contract_approve.LID='$loanid'  order by loan_contract_approve.createdon desc";
        return $this->db->query($sql);
    }

    function loan_disburse_history($loanid) {
        $sql = "SELECT loan_contract_disburse.*,users.first_name,users.last_name FROM loan_contract_disburse "
                . "INNER JOIN users  ON loan_contract_disburse.createdby = users.id  WHERE loan_contract_disburse.LID='$loanid'  order by loan_contract_disburse.createdon desc";
        return $this->db->query($sql);
    }

    function get_guarantor($id = null, $loanid = null) {
        $this->db->where('PIN', current_user()->PIN);
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }

        if (!is_null($loanid)) {
            $this->db->where('LID', $loanid);
        }

        return $this->db->get('loan_contract_guarantor');
    }

    function add_guarantor($data, $edit = null) {
        $check = $this->db->get_where('loan_contract_declaration', array('LID' => $data['LID']))->row();
        if (!is_null($edit)) {
            return $this->db->update('loan_contract_guarantor', $data, array('id' => $edit));
        } else {
            return $this->db->insert('loan_contract_guarantor', $data);
        }
    }

    function loan_supporting_doc($data) {

        return $this->db->insert('loan_contract_supportdoc', $data);
    }

    function loan_info($loanid = null, $pin = null, $member_id = null) {

        if (!is_null($loanid)) {
            $this->db->where('LID', $loanid);
        }
        if (!is_null($pin)) {
            $this->db->where('PID', $pin);
        }
        if (!is_null($member_id)) {
            $this->db->where('member_id', $member_id);
        }

        return $this->db->get('loan_contract');
    }

    function edit_loan_info($data, $loanid) {
        $this->db->update('loan_contract', $data, array('LID' => $loanid));
        return $loanid;
    }

    function update_loan_businessinfo($data) {
        $info = $this->get_loanbusinessinfo($data['LID']);
        if ($info) {
            return $this->db->update('loan_contract_business', $data, array('LID' => $data['LID']));
        } else {
            return $this->db->insert('loan_contract_business', $data);
        }
    }

    function get_loanbusinessinfo($LID) {
        $this->db->where('LID', $LID);
        return $this->db->get('loan_contract_business')->row();
    }

    function add_newloan($data, $processingfee = 0) {
        $loanid = $this->db->get('auto_inc')->row()->loan;
        // increatent 1 next PIN
        $this->db->set('loan', 'loan+1', FALSE);
        $this->db->update('auto_inc');

        $data['LID'] = 'LN' . $loanid;

        $insert = $this->db->insert('loan_contract', $data);
        if ($insert) {
            if ($processingfee > 0) {



                $array_registration = array(
                    'PID' => $data['PID'],
                    'member_id' => $data['member_id'],
                    'amount' => $processingfee,
                    'createdby' => current_user()->id,
                    'PIN' => $data['PIN'],
                    'LID' => $data['LID']
                );

                $this->db->insert('loanprocessing_fee', $array_registration);
                $refferenceid = $this->db->insert_id();
                //now insert to income journal
                $credit_account = 4000002;
                $debit_account = 1020001;

                $ledger_entry = array('date' => date('Y-m-d'));
                $this->db->insert('general_ledger_entry', $ledger_entry);
                $ledger_entry_id = $this->db->insert_id();

                //update ledger book
                $ledgerbook = array(
                    'journalID' => 2,
                    'refferenceID' => $refferenceid,
                    'entryid' => $ledger_entry_id,
                    'date' => date('Y-m-d'),
                    'description' => 'Loan Processing Fee ',
                    'linkto' => 'loanprocessing_fee.id',
                    'fromtable' => 'loanprocessing_fee',
                    'PID' => $data['PID'],
                    'member_id' => $data['member_id'],
                    'PIN' => $data['PIN'],
                    'year'=>  active_year(),
                );

                $ledgerbook['account'] = $credit_account;
                $ledgerbook['credit'] = $processingfee;
                $infoaccount = account_row_info($ledgerbook['account']);
                $ledgerbook['account_type'] = $infoaccount->account_type;
                $ledgerbook['sub_account_type'] = $infoaccount->sub_account_type;
                $this->db->insert('general_ledger', $ledgerbook);

                $ledgerbook['credit'] = 0;
                $ledgerbook['debit'] = 0;
                //retain earning
                $ledgerbook['account'] = 3000002;
                $ledgerbook['credit'] = $processingfee;
                $infoaccount = account_row_info($ledgerbook['account']);
                $ledgerbook['account_type'] = $infoaccount->account_type;
                $ledgerbook['sub_account_type'] = $infoaccount->sub_account_type;
                $this->db->insert('general_ledger', $ledgerbook);

                $ledgerbook['credit'] = 0;
                $ledgerbook['debit'] = 0;
                $ledgerbook['account'] = $debit_account;
                $infoaccount = account_row_info($ledgerbook['account']);
                $ledgerbook['account_type'] = $infoaccount->account_type;
                $ledgerbook['sub_account_type'] = $infoaccount->sub_account_type;
                $ledgerbook['debit'] = $processingfee;
                $this->db->insert('general_ledger', $ledgerbook);
            }

            return $data['LID'];
        }

        return FALSE;
    }

    function loan_wait_evaluation() {
        $pin = current_user()->PIN;
        return $this->db->query("SELECT * FROM loan_contract WHERE PIN='$pin' AND (status=0 OR status=3) ORDER BY applicationdate DESC")->result();
    }

    function loan_wait_approval() {
        $pin = current_user()->PIN;
        return $this->db->query("SELECT * FROM loan_contract WHERE PIN='$pin' AND status=1 ORDER BY applicationdate DESC")->result();
    }

    function loan_wait_disburse() {
        $pin = current_user()->PIN;
        return $this->db->query("SELECT * FROM loan_contract WHERE PIN='$pin' AND status=4 AND disburse=0 ORDER BY applicationdate DESC")->result();
    }

    function loan_repay_list() {
        $pin = current_user()->PIN;
        return $this->db->query("SELECT loan_contract.*,members.firstname,members.middlename,members.lastname  FROM loan_contract INNER JOIN members ON members.PID=loan_contract.PID WHERE loan_contract.PIN='$pin' AND loan_contract.status=4 AND loan_contract.disburse=1 ORDER BY loan_contract.LID ASC")->result();
    }

    function count_loan($key = null) {
        $pin = current_user()->PIN;
        $sql = "SELECT loan_contract.* FROM loan_contract INNER JOIN members ON members.PID=loan_contract.PID WHERE loan_contract.PIN='$pin'  ";

        if (!is_null($key)) {
            $sql .= "  AND (loan_contract.LID LIKE '$key%' OR loan_contract.member_id LIKE '$key%' OR members.firstname LIKE '$key%' OR members.lastname LIKE '$key%')";
        }

        return count($this->db->query($sql)->result());
    }

    function search_loan($key, $limit, $start) {
        $pin = current_user()->PIN;
        $sql = "SELECT loan_contract.*,loan_status.name FROM loan_contract INNER JOIN members ON members.PID=loan_contract.PID ";
        $sql .= " INNER JOIN loan_status ON loan_status.code=loan_contract.status WHERE loan_contract.PIN='$pin'";

        if (!is_null($key)) {
            $sql .= "  AND ( loan_contract.LID LIKE '$key%' OR loan_contract.member_id LIKE '$key%' OR members.firstname LIKE '$key%' OR members.lastname LIKE '$key%')";
        }

        $sql.= " ORDER BY loan_contract.applicationdate ASC LIMIT $start,$limit";

        return $this->db->query($sql)->result();
    }

    function open_repayment_installment($LID) {
        $this->db->where('LID', $LID);
        $this->db->where('status', 0);
        $this->db->order_by('installment_number', 'ASC');
        return $this->db->get('loan_contract_repayment_schedule')->result();
    }

    function get_previous_remain_balance($LID) {
        $this->db->where('PIN', current_user()->PIN);
        $this->db->where('LID', $LID);
        $val = $this->db->get('loan_balance_carry')->row();
        if ($val) {
            return $val->balance;
        }

        return 0;
    }
    
     function get_previous_remain_balance_id($LID) {
        $this->db->where('PIN', current_user()->PIN);
        $this->db->where('LID', $LID);
        $val = $this->db->get('loan_balance_carry')->row();
        if ($val) {
            return $val->id;
        }

        return 0;
    }

    function loan_repay_receipt($LID, $amount, $paydate) {
        $pin = current_user()->PIN;
        $receipt = $this->receiptNo();
        $array = array(
            'LID' => $LID,
            'receipt' => $receipt,
            'amount' => $amount,
            'paydate' => $paydate,
            'createdby' => current_user()->id,
            'PIN' => $pin,
        );

        $this->db->insert('loan_repayment_receipt', $array);
        return $receipt;
    }

    function add_remain_balance($LID, $amount) {
        $pin = current_user()->PIN;
        $check = $this->db->get_where('loan_balance_carry', array('LID' => $LID, 'PIN' => $pin))->row();
        if (count($check) > 0) {
            $this->db->where('LID', $LID);
            $this->db->where('PIN', $pin);
            $this->db->set('balance', $amount, FALSE);
            return $this->db->update('loan_balance_carry');
        } else {
            return $this->db->insert('loan_balance_carry', array('LID' => $LID, 'PIN' => $pin, 'balance' => $amount));
        }
    }

    function record_loan_repayment($array_data, $repay_schedule_ref, $received_in) {
        $pin = current_user()->PIN;
        $this->db->trans_start();
        $insert = $this->db->insert('loan_contract_repayment', $array_data);
        $referenceID = $this->db->insert_id();
        //general entry id
        $ledger_entry = array('date' => $array_data['paydate'], 'PIN' => $pin);
        $this->db->insert('general_ledger_entry', $ledger_entry);
        $ledger_entry_id = $this->db->insert_id();

        $LID = $array_data['LID'];
        $infodata = $this->loan_model->loan_info($LID)->row();
        $product = $this->setting_model->loanproduct($infodata->product_type)->row();
        //prepare to enter ledger
        //ledger data
        $ledger = array(
            'journalID' => 4,
            'refferenceID' => $referenceID,
            'entryid' => $ledger_entry_id,
            'LID' => $LID,
            'date' => $array_data['paydate'],
            'description' => 'Loan Repayment',
            'linkto' => 'loan_contract_repayment.id',
            'fromtable' => 'loan_contract_repayment',
            'paid' => 0,
            'year' => active_year(),
            'PIN' => $pin,
            'PID' => $infodata->PID,
            'member_id' => $infodata->member_id,
        );

        $ledger['credit'] = 0;
        $ledger['debit'] = 0;
        //Debit Cash/Bank Account
        $debit_account = $received_in;
        $ledger['account'] = $debit_account;
        $ledger['debit'] = $array_data['principle'];
        $infoaccount = account_row_info($ledger['account']);
        $ledger['account_type'] = $infoaccount->account_type;
        $ledger['sub_account_type'] = $infoaccount->sub_account_type;
        $this->db->insert('general_ledger', $ledger);

        // Credit Client Loan Principal
        $ledger['credit'] = 0;
        $ledger['debit'] = 0;
        $ledger['account'] = $infodata->loan_principle_account;
        $ledger['credit'] = $array_data['principle'];
        $infoaccount = account_row_info($ledger['account']);
        $ledger['account_type'] = $infoaccount->account_type;
        $ledger['sub_account_type'] = $infoaccount->sub_account_type;
        $this->db->insert('general_ledger', $ledger);

        //check if Unerned already runed
        $unearned = $this->db->get_where('loan_contract_repayment_unearned', array('id' => $repay_schedule_ref, 'LID' => $LID,'earned'=>0))->row();
        if ($unearned) {
            //REMOVE UNEARNED ROW
            //Debit Cash/Bank Account
            $ledger['credit'] = 0;
            $ledger['debit'] = 0;
            $debit_account = $received_in;
            $ledger['account'] = $debit_account;
            $ledger['debit'] = $array_data['interest'];
            //$ledger['account_type'] = account_row_info($ledger['account'])->account_type;
            $infoaccount = account_row_info($ledger['account']);
            $ledger['account_type'] = $infoaccount->account_type;
            $ledger['sub_account_type'] = $infoaccount->sub_account_type;
            $this->db->insert('general_ledger', $ledger);

            //Credit Interest Receivable
            $ledger['credit'] = 0;
            $ledger['debit'] = 0;
            $ledger['account'] = 1030016;
            //$ledger['account'] = $infodata->loan_principle_account;
            $ledger['credit'] = $array_data['interest'];
            // $ledger['account_type'] = account_row_info($ledger['account'])->account_type;
            $infoaccount = account_row_info($ledger['account']);
            $ledger['account_type'] = $infoaccount->account_type;
            $ledger['sub_account_type'] = $infoaccount->sub_account_type;
            $this->db->insert('general_ledger', $ledger);
            $this->db->update('loan_contract_repayment_unearned',array('earned'=>1), array('id' => $unearned->id));
       } else {
            // NORMAL INCOME
            //Debit Cash/Bank Account
            $ledger['credit'] = 0;
            $ledger['debit'] = 0;
            $debit_account = $received_in;
            $ledger['account'] = $debit_account;
            $ledger['debit'] = $array_data['interest'];
            //$ledger['account_type'] = account_row_info($ledger['account'])->account_type;
            $infoaccount = account_row_info($ledger['account']);
            $ledger['account_type'] = $infoaccount->account_type;
            $ledger['sub_account_type'] = $infoaccount->sub_account_type;
            $this->db->insert('general_ledger', $ledger);

            //Credit Income Account
            $ledger['credit'] = 0;
            $ledger['debit'] = 0;
            $ledger['account'] = $product->loan_interest_account;
            $ledger['credit'] = $array_data['interest'];
            // $ledger['account_type'] = account_row_info($ledger['account'])->account_type;
            $infoaccount = account_row_info($ledger['account']);
            $ledger['account_type'] = $infoaccount->account_type;
            $ledger['sub_account_type'] = $infoaccount->sub_account_type;
            $this->db->insert('general_ledger', $ledger);

            $ledger['debit'] = 0;
            $ledger['account'] = 3000002;
            // $ledger['account_type'] = account_row_info($ledger['account'])->account_type;
            $infoaccount = account_row_info($ledger['account']);
            $ledger['account_type'] = $infoaccount->account_type;
            $ledger['sub_account_type'] = $infoaccount->sub_account_type;
            $ledger['credit'] = $array_data['interest'];
            $this->db->insert('general_ledger', $ledger);
        }



        //check if penalty exist
        if (array_key_exists('penalt', $array_data)) {
            //Debit Account Receivable
            $ledger['credit'] = 0;
            $ledger['debit'] = 0;
            $debit_account = $received_in;
            $ledger['account'] = $debit_account;
            $ledger['debit'] = $array_data['penalt'];
            //$ledger['account_type'] = account_row_info($ledger['account'])->account_type;
            $infoaccount = account_row_info($ledger['account']);
            $ledger['account_type'] = $infoaccount->account_type;
            $ledger['sub_account_type'] = $infoaccount->sub_account_type;
            $this->db->insert('general_ledger', $ledger);

            //Credit Penalty Account
            $ledger['credit'] = 0;
            $ledger['debit'] = 0;
            $ledger['account'] = $product->loan_penalt_account;
            $ledger['credit'] = $array_data['penalt'];
            // $ledger['account_type'] = account_row_info($ledger['account'])->account_type;
            $infoaccount = account_row_info($ledger['account']);
            $ledger['account_type'] = $infoaccount->account_type;
            $ledger['sub_account_type'] = $infoaccount->sub_account_type;
            $this->db->insert('general_ledger', $ledger);


            //credit equity
            $ledger['credit'] = 0;
            $ledger['debit'] = 0;
            $ledger['account'] = 3000002;
            //$ledger['account_type'] = account_row_info($ledger['account'])->account_type;
            $infoaccount = account_row_info($ledger['account']);
            $ledger['account_type'] = $infoaccount->account_type;
            $ledger['sub_account_type'] = $infoaccount->sub_account_type;
            $ledger['credit'] = $array_data['penalt'];
            $this->db->insert('general_ledger', $ledger);
        }
        
           
        

        $check_provision = $this->db->query(" SELECT SUM(credit) as credit,SUM(debit) as debit FROM provision_baddebt_transaction WHERE LID = '$LID'")->row();

        if ($check_provision) {
            $balancex = $check_provision->credit - $check_provision->debit;
            if ($balancex > 0) {
                $reverse_amount = 0;
                if ($balancex >= $array_data['principle']) {
                    $reverse_amount = $array_data['principle'];
                } else {
                    $reverse_amount =  $balancex;
                }
                
                    $insert_recordreverse = array(
                 'LID' => $LID,
                 'classfication' => '',
                 'days' => '',
                 'provision_rate' => '',
                 'debit' => $reverse_amount,
                 );
                    
                $this->db->insert('provision_baddebt_transaction', $insert_recordreverse);

                $ledger['description'] = 'Provision for doubtful Reverse';
                $ledger['classfication_reverse'] = 1;

                // credit Bad dept
                $ledger['credit'] = $reverse_amount;
                $ledger['debit'] = 0;
                $ledger['account'] = 5000033;                
                $infoaccount = account_row_info($ledger['account']);
                $ledger['account_type'] = $infoaccount->account_type;
                $ledger['sub_account_type'] = $infoaccount->sub_account_type;
                $this->db->insert('general_ledger', $ledger);

                //debit Provisional for doubtful
                $ledger['credit'] = 0;
                $ledger['debit'] = $reverse_amount;
                //$ledger['account'] = $infodata->loan_principle_account;
                $ledger['account'] = 2010018;
                $infoaccount = account_row_info($ledger['account']);
                $ledger['account_type'] = $infoaccount->account_type;
                $ledger['sub_account_type'] = $infoaccount->sub_account_type;
                $this->db->insert('general_ledger', $ledger);
                $this->db->delete('provision_rate_status', array('LID' => $LID));

                $next_installment = $this->db->query("SELECT * FROM loan_contract_repayment_schedule WHERE status = 0 AND LID='$LID' LIMIT 1")->row();

                if ($next_installment) {
                    $next = date('Y-m-d', strtotime('+' . ($product->warning_day + 1) . ' days', strtotime($next_installment->repaydate)));
                    $this->db->update('provision_rate_run', array('last_date' => $next), array('LID' => $LID));
                }
                //$this->db->update('general_ledger', array('classfication_reverse' => 1), array('LID' => $LID, 'classfication_reverse' => 0, 'loan_installno' => $array_data['installment']));
            }
        }


        $this->db->update('loan_contract_repayment_schedule', array('status' => 1, 'unearned' => 0), array('id' => $repay_schedule_ref));
        $this->db->update('loan_repayment_receipt', array('affect_loan' => 1, 'installment' => $array_data['installment']), array('receipt' => $array_data['receipt']));
        $this->db->trans_complete();
        return $insert;
    }

    function loan_prepayment_account($action, $paydate, $LID, $received_in, $previous_remain_balance, $previous_remain_balance_id ){
        $pin = current_user()->PIN;
        //general entry id
        $ledger_entry = array('date' => $paydate, 'PIN' => $pin);
        $this->db->insert('general_ledger_entry', $ledger_entry);
        $ledger_entry_id = $this->db->insert_id();

        $LID = $LID;
        $infodata = $this->loan_model->loan_info($LID)->row();
        $product = $this->setting_model->loanproduct($infodata->product_type)->row();
        //prepare to enter ledger
        //ledger data
        $ledger = array(
            'journalID' => 4,
            'refferenceID' => $previous_remain_balance_id ,
            'entryid' => $ledger_entry_id,
            'LID' => $LID,
            'date' => $paydate,
            'description' => 'Balance For The Next Installment',
            'linkto' => 'loan_balance_carry.id',
            'fromtable' => 'loan_balance_carry',
            'paid' => 0,
            'year' => active_year(),
            'PIN' => $pin,
            'PID' => $infodata->PID,
            'member_id' => $infodata->member_id,
        );
        
        
         //check if there is balance for next installment
        if($previous_remain_balance > 0){
            if($action == 'credit'){
        
            
           //Debit Cash/Bank Account
        $ledger['credit'] = 0;
        $ledger['debit'] = 0;
        $debit_account = $received_in;
        $ledger['account'] = $debit_account;
        $ledger['debit'] = $previous_remain_balance;
        $infoaccount = account_row_info($ledger['account']);
        $ledger['account_type'] = $infoaccount->account_type;
        $ledger['sub_account_type'] = $infoaccount->sub_account_type;
        $this->db->insert('general_ledger', $ledger);

        // Credit Loan Prepayment Account
        $ledger['credit'] = 0;
        $ledger['debit'] = 0;
        //$ledger['account'] = 1030013;
        $ledger['account'] = $product->loan_prepayment_account;        
        $ledger['credit'] = $previous_remain_balance;
        $infoaccount = account_row_info($ledger['account']);
        $ledger['account_type'] = $infoaccount->account_type;
        $ledger['sub_account_type'] = $infoaccount->sub_account_type;
        $this->db->insert('general_ledger', $ledger); 
            }
            
          if($action == 'debit'){ 

        // Debit Loan Prepayment Account
        $ledger['credit'] = 0;
        $ledger['debit'] = 0;
        //$ledger['account'] = 1030013;
        $ledger['account'] = $product->loan_prepayment_account;        
        $ledger['debit'] = $previous_remain_balance;
        $infoaccount = account_row_info($ledger['account']);
        $ledger['account_type'] = $infoaccount->account_type;
        $ledger['sub_account_type'] = $infoaccount->sub_account_type;
        $this->db->insert('general_ledger', $ledger);        
        
        
           //Credit Cash/Bank Account
        $ledger['credit'] = 0;
        $ledger['debit'] = 0;
        $debit_account = $received_in;
        $ledger['account'] = $debit_account;
        $ledger['credit'] = $previous_remain_balance;
        $infoaccount = account_row_info($ledger['account']);
        $ledger['account_type'] = $infoaccount->account_type;
        $ledger['sub_account_type'] = $infoaccount->sub_account_type;
        $this->db->insert('general_ledger', $ledger);
        
            }
            
            
        }
        
        

        
    }
    
    
    function receiptNo() {
        $query = $this->db->query("SELECT MAX(id) as id  FROM loan_repayment_receipt")->row();
        return alphaID(($query->id * time()), FALSE, 12);
    }

    function get_transaction($receipt) {
        $this->db->where('receipt', $receipt);
        return $this->db->get('loan_repayment_receipt')->row();
    }

    function loan_holder_name($LID) {
        $sql = "SELECT CONCAT(members.firstname,' ',members.middlename,' ',members.lastname) as name FROM members INNER JOIN loan_contract ON members.PID=loan_contract.PID WHERE loan_contract.LID='$LID'";
        return $this->db->query($sql)->row()->name;
    }

    function installment_affected($receipt) {
        $min = $this->db->query("SELECT MIN(installment) as min  FROM loan_contract_repayment where receipt='$receipt'")->row();
        $max = $this->db->query("SELECT MAX(installment) as max  FROM loan_contract_repayment where receipt='$receipt'")->row();
        $installment = 0;
        if ($min->min == $max->max) {
            $installment = 'Installment No. ' . $max->max;
        } else {
            $installment = 'Installment No. ' . $min->min . ' - ' . $max->max;
        }

        return $installment;
    }

    function total_amount_repay($LID) {
        $sql = "SELECT SUM(principle) as paid_principle FROM loan_contract_repayment_schedule WHERE LID='$LID' and status=1 AND write_off=0";
        $sum = $this->db->query($sql)->row();
        if ($sum) {
            return $sum->paid_principle;
        }

        return 0;
    }
    
     function total_amount_in_arrears($LID) {
        $leo = date('Y-m-d');    
        
        $sql = "SELECT SUM(principle) as unpaid_principle, SUM(interest) as unpaid_interest  FROM loan_contract_repayment_schedule WHERE LID='$LID' and status=0 and write_off=0 and repaydate <='$leo' ";
        $sum = $this->db->query($sql)->row();
        if ($sum) {
            return $sum->unpaid_principle + $sum->unpaid_interest;
        }

        return 0;
    }
    
     function total_outstanding_balance($LID) {
        $leo = date('Y-m-d');    
        
        $sql = "SELECT SUM(principle) as unpaid_principle, SUM(interest) as unpaid_interest  FROM loan_contract_repayment_schedule WHERE LID='$LID' and status=0 and write_off=0 ";
        $sum = $this->db->query($sql)->row();
        if ($sum) {
            return $sum->unpaid_principle;
        }

        return 0;
    }
    
     function provision_days($LID) {
         $leo = date('Y-m-d');
        $sql = "SELECT loan_contract_repayment_schedule.*,(SELECT repaydate FROM loan_contract_repayment_schedule WHERE loan_contract_repayment_schedule.LID=LID AND status=0 ORDER BY repaydate ASC LIMIT 1 ) as early_date FROM loan_contract_repayment_schedule INNER JOIN loan_contract ON loan_contract.LID=loan_contract_repayment_schedule.LID  WHERE loan_contract_repayment_schedule.repaydate <= '$leo' AND loan_contract_repayment_schedule.status = '0' AND loan_contract.status=4 AND loan_contract.LID='$LID' GROUP BY loan_contract_repayment_schedule.LID ";
        $result = $this->db->query($sql)->result();
        //print_r($result);
        

        foreach ($result as $key => $value) {


            $infodata = $this->loan_model->loan_info($value->LID)->row();
            
            $product = $this->setting_model->loanproduct($infodata->product_type)->row();
            $max_date = date('Y-m-d', strtotime('+' . ($product->warning_day + 1) . ' days', strtotime($value->repaydate)));

              $d1 = new DateTime($max_date);
              $d2 = new DateTime($leo);
              $number_of_day = $d1->diff($d2)->days;
              return $number_of_day;
        }
     }

}
