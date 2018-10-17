<?php

class Report_Model extends CI_Model {

    function report_loan($id = null, $ink = null) {
        $this->db->where('PIN', current_user()->PIN);
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        if (!is_null($ink)) {
            $this->db->where('link', $ink);
        }

        return $this->db->get('report_table_loan');
    }

    function report_share($id = null, $ink = null) {
        $this->db->where('PIN', current_user()->PIN);
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        if (!is_null($ink)) {
            $this->db->where('link', $ink);
        }
        $this->db->where('user', $this->session->userdata('user_id'));
        return $this->db->get('report_table_share');
    }

    function report_contribution($id = null, $ink = null) {
        $this->db->where('PIN', current_user()->PIN);
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        if (!is_null($ink)) {
            $this->db->where('link', $ink);
        }
        $this->db->where('user', $this->session->userdata('user_id'));
        return $this->db->get('report_table_contribution');
    }

    function report_saving($id = null, $ink = null) {
        $this->db->where('PIN', current_user()->PIN);
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        if (!is_null($ink)) {
            $this->db->where('link', $ink);
        }

        return $this->db->get('report_table_saving');
    }

    function report_list($id = null, $ink = null) {
        $this->db->where('PIN', current_user()->PIN);
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        if (!is_null($ink)) {
            $this->db->where('link', $ink);
        }

        return $this->db->get('report_table');
    }

    function report_memberlist($id = null, $ink = null) {
        $this->db->where('PIN', current_user()->PIN);
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        if (!is_null($ink)) {
            $this->db->where('link', $ink);
        }

        return $this->db->get('report_table_member');
    }

    function report_list_journal($id = null, $ink = null) {
        $this->db->where('PIN', current_user()->PIN);
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        if (!is_null($ink)) {
            $this->db->where('link', $ink);
        }

        return $this->db->get('report_table_journal');
    }

    function trial_balance_account($account, $from, $until,$year) { 
        
        $return = array();
        if(is_null($year)){
            $year = active_year();
        }
        
        $openings = $this->ledger_trans_summary_ob($from, $until, $account, TRUE,$year); 
        $closings = $this->ledger_trans_summary_cb($from, $until, $account, TRUE,$year);      
      
        $previous = $this->ledger_trans_summary($from, $until, $account, TRUE,$year);
        $current = $this->ledger_trans_summary($from, $until, $account,FALSE,$year);
        
                
        if (count($previous) > 0 || count($current) > 0 || count($openings) > 0 || count($closings) > 0) {
            
            $openings_amount = 0;
            if (count($openings) > 0) {
                 $openings_amount = $openings[0]->credit - $openings[0]->debit;
            }
            
             $closings_amount = 0;
            if (count($closings) > 0) {
                 $closings_amount = $closings[0]->credit - $closings[0]->debit;
            }
            
            $balance = 0;
            if (count($previous) > 0) {               
                $balance = $previous[0]->credit - $previous[0]->debit;
            }

            if (count($current) > 0) {
                $current = $current[0];
            } else {
                $current = 0;
            }
            return array('balance' => $balance, 'current' => $current,  'openings_amount' => $openings_amount,  'closings_amount' => $closings_amount);
        }
    }

    function create_ledger_trans_summary($from, $until,$year=null) {
        if(is_null($year)){
            $year = active_year();
        }
        $return = array();
        $account_type = $this->finance_model->account_typelist()->result();
        foreach ($account_type as $key => $value) {
            $account_list = $this->finance_model->account_chart(null, null, $value->account)->result();
            foreach ($account_list as $key1 => $value1) {
                $previous = $this->ledger_trans_summary($from, $until, $value1->account, TRUE,$year);
                $current = $this->ledger_trans_summary($from, $until, $value1->account,FALSE,$year);
                if (count($previous) > 0 || count($current) > 0) {
                    $balance = 0;
                    if (count($previous) > 0) {
                        $balance = $previous[0]->debit - $previous[0]->credit;
                    }
                    if ($value->id == 4 || $value->id == 5) {
                        if (count($current) > 0) {
                            $current = $current[0];
                            $return[$value->id][$value1->account] = array('balance' => $balance, 'current' => $current);
                        }
                    } else {
                        if (count($current) > 0) {
                            $current = $current[0];
                        }
                        $return[$value->id][$value1->account] = array('balance' => $balance, 'current' => $current);
                    }
                }
            }
        }

        return $return;
    }

    function get_balance_sheet_data($date, $category,$year=null) {
        $pin = current_user()->PIN;
        if(is_null($year)){
            $year = active_year();
        }
        $sql = "SELECT general_ledger.account as account, account_chart.account_type as account_type,account_chart.name as name, SUM(general_ledger.credit) as credit,SUM(general_ledger.debit) as debit
                    FROM general_ledger INNER JOIN account_chart ON account_chart.account=general_ledger.account WHERE general_ledger.PIN=account_chart.PIN AND account_chart.PIN='$pin' AND general_ledger.year='$year' AND general_ledger.date <= '$date' AND account_chart.account_type='$category'  GROUP BY general_ledger.account";

        return $this->db->query($sql)->result();
    }
    
    
     function balance_sheet_account($date, $account,$year=null) {
        $pin = current_user()->PIN;
       if(is_null($year)){
           $year = active_year();
       }
            $sql = "SELECT general_ledger.account as account,account_chart.account_type as account_type,account_chart.name as name,SUM(general_ledger.credit) as credit,SUM(general_ledger.debit) as debit
                    FROM general_ledger INNER JOIN account_chart ON
                account_chart.account=general_ledger.account WHERE general_ledger.PIN=account_chart.PIN AND account_chart.PIN='$pin' AND general_ledger.date <= '$date' AND general_ledger.year='$year'";
      

        if (!is_null($account)) {
            $sql .= " AND general_ledger.account = '$account'";
        }


        $sql.=" GROUP BY general_ledger.account ORDER BY general_ledger.date ASC, general_ledger.journalID ASC,general_ledger.refferenceID ASC";

        return $this->db->query($sql)->row();
    }
    
    
    

    function ledger_trans_summary($from, $until, $account = null, $previous = false,$year=null) {
        $pin = current_user()->PIN;
        if(is_null($year)){
            $year = active_year();
        }
         
        if ($previous) {
            if($account == '3000002'){ //handling returning earnings
                //$from = $year.'-'.'01'.'-'.'01';                 
                //$year -=1; 
                
              
                }
                
                //$year -=1;
            
            $sql = "SELECT general_ledger.account as account,account_chart.account_type as account_type,account_chart.name as name,SUM(general_ledger.credit) as credit,SUM(general_ledger.debit) as debit
                    FROM general_ledger INNER JOIN account_chart ON
                account_chart.account=general_ledger.account WHERE general_ledger.PIN=account_chart.PIN AND account_chart.PIN='$pin' AND general_ledger.date < '$from'  AND general_ledger.year='$year' AND open_balance !='1' ";
        } else {
            if($account == '3000002'){ //handling returning earnings                
                //$year -=1; 
                //$from = $year.'-'.'01'.'-'.'01';
                //$until = $year.'-'.'12'.'-'.'31';
                             
                }
                
                
            $sql = "SELECT general_ledger.account as account,account_chart.account_type as account_type,account_chart.name as name,SUM(general_ledger.credit) as credit,SUM(general_ledger.debit) as debit
                    FROM general_ledger INNER JOIN account_chart ON
                account_chart.account=general_ledger.account WHERE general_ledger.PIN=account_chart.PIN AND account_chart.PIN='$pin' AND general_ledger.date >= '$from' AND general_ledger.date <= '$until' AND general_ledger.year='$year' AND open_balance !='1' ";
        }

        if (!is_null($account)) {
            $sql .= " AND general_ledger.account = '$account'";
        }


        $sql.=" GROUP BY general_ledger.account ORDER BY general_ledger.date ASC, general_ledger.journalID ASC,general_ledger.refferenceID ASC";

        return $this->db->query($sql)->result();
    }

    
    function ledger_trans_summary_ob($from, $until, $account = null, $previous = false,$year=null) {
        $pin = current_user()->PIN;
        if(is_null($year)){
            $year = active_year();
        }
         
        
        $sql = "SELECT general_ledger.account as account,account_chart.account_type as account_type,account_chart.name as name,SUM(general_ledger.credit) as credit,SUM(general_ledger.debit) as debit
                    FROM general_ledger INNER JOIN account_chart ON
                account_chart.account=general_ledger.account WHERE general_ledger.PIN=account_chart.PIN AND account_chart.PIN='$pin'  AND general_ledger.year='$year' AND open_balance ='1' ";
      
        if (!is_null($account)) {
            $sql .= " AND general_ledger.account = '$account'";
        }


        $sql.=" GROUP BY general_ledger.account ORDER BY general_ledger.date ASC, general_ledger.journalID ASC,general_ledger.refferenceID ASC";

        return $this->db->query($sql)->result();
        
    }
    
    
     function ledger_trans_summary_cb($from, $until, $account = null, $previous = false,$year=null) {
        $pin = current_user()->PIN;
        if(is_null($year)){
            $year = active_year();
        }
         
        if ($year != active_year()){
            $year += 1; 
        }
        
        $sql = "SELECT general_ledger.account as account,account_chart.account_type as account_type,account_chart.name as name,SUM(general_ledger.credit) as credit,SUM(general_ledger.debit) as debit
                    FROM general_ledger INNER JOIN account_chart ON
                account_chart.account=general_ledger.account WHERE general_ledger.PIN=account_chart.PIN AND account_chart.PIN='$pin'  AND general_ledger.year='$year' AND open_balance ='1' ";
      
        if (!is_null($account)) {
            $sql .= " AND general_ledger.account = '$account'";
        }


        $sql.=" GROUP BY general_ledger.account ORDER BY general_ledger.date ASC, general_ledger.journalID ASC,general_ledger.refferenceID ASC";

        return $this->db->query($sql)->result();
        
    }
    
    
    
    function ledger_trans($from, $until, $account = null,$year=null) {
        $pin = current_user()->PIN;        
        if(is_null($year)){
            $year = active_year();
        }
       
        $sql = "SELECT general_ledger.*,account_chart.name,(SELECT type FROM journal WHERE id=general_ledger.journalID) as trans_comment FROM general_ledger INNER JOIN account_chart ON
                account_chart.account=general_ledger.account WHERE general_ledger.PIN=account_chart.PIN AND account_chart.PIN='$pin' AND general_ledger.date >= '$from' AND general_ledger.date <= '$until' AND general_ledger.account_type != 30 AND general_ledger.year='$year' ";

        if (!is_null($account)) {
            $sql .= " AND general_ledger.account = '$account'";
        }
        $sql.=" ORDER BY general_ledger.date ASC,general_ledger.entryid ASC,general_ledger.debit DESC";

        return $this->db->query($sql)->result();
    }

    function journal_trans($from, $until, $journal_id,$year=null) {
        $pin = current_user()->PIN;
         if(is_null($year)){
            $year = active_year();
        }
        $sql = "SELECT general_ledger.*,account_chart.name,general_ledger.entryid,(SELECT type FROM journal WHERE id=general_ledger.journalID) as trans_comment FROM general_ledger INNER JOIN account_chart ON
                account_chart.account=general_ledger.account WHERE general_ledger.PIN=account_chart.PIN AND account_chart.PIN='$pin' AND general_ledger.date >= '$from' AND general_ledger.date <= '$until' AND general_ledger.account_type != 30 AND  general_ledger.year='$year' ";


        $sql .= " AND general_ledger.journalID = '$journal_id'";

        $sql.=" ORDER BY general_ledger.date ASC, general_ledger.entryid ASC,general_ledger.debit DESC";

        return $this->db->query($sql)->result();
    }

    function registration_fee_collection($fromdate, $todate) {
        $pin = current_user()->PIN;
        $sql = "SELECT member_registrationfee.member_id,member_registrationfee.date,member_registrationfee.credit as amount, CONCAT(members.firstname, ' ',members.middlename,' ',members.lastname) as name 
FROM member_registrationfee INNER JOIN members ON member_registrationfee.member_id= members.member_id WHERE members.PIN=member_registrationfee.PIN AND members.PIN='$pin' AND member_registrationfee.date >= '$fromdate' AND member_registrationfee.date <= '$todate'
                ORDER BY member_registrationfee.date ASC,name ASC ";

        return $this->db->query($sql)->result();
    }

    function account_saving_balance($fromdate, $todate, $account_type = '') {
        $pin = current_user()->PIN;
        $sql = "SELECT * FROM members_account WHERE PIN='$pin' AND createdon >= '$fromdate 00:00:00' AND createdon <= '$todate 23:59:59' ";
        if ($account_type != '') {
            $sql.= " AND account_cat='$account_type' ";
        }
        $sql.=" ORDER BY account ASC";

        return $this->db->query($sql)->result();
    }

    function account_contribution_balance($fromdate, $todate) {
        $pin = current_user()->PIN;
        $sql = "SELECT members.PID,members.member_id,CONCAT(members.firstname,' ',members.middlename,' ',members.lastname) as name,members_contribution.balance FROM members LEFT JOIN members_contribution ON members.PID=members_contribution.PID  WHERE members.PIN='$pin' AND members.joiningdate >= '$fromdate 00:00:00' AND members.joiningdate <= '$todate 23:59:59' ";

        $sql.=" ORDER BY members.PID ASC";

        return $this->db->query($sql)->result();
    }

    function share_balance($fromdate, $todate) {
        $pin = current_user()->PIN;
        $sql = "SELECT members.PID,members.member_id,CONCAT(members.firstname,' ',members.middlename,' ',members.lastname) as name,
                members_share.amount,members_share.totalshare,members_share.remainbalance FROM members LEFT JOIN members_share ON members.PID=members_share.PID  WHERE members.PIN='$pin' AND members.joiningdate >= '$fromdate 00:00:00' AND members.joiningdate <= '$todate 23:59:59' ";

        $sql.=" ORDER BY members.PID ASC";

        return $this->db->query($sql)->result();
    }

    function member_list_data($fromdate, $todate, $column) {
        $pin = current_user()->PIN;
        $sql = "SELECT members.PID as internal, ";
        $table = array();
        foreach ($column as $key => $value) {
            $tmp = explode('.', $value);
            $table[$tmp[0]] = $tmp[0];

            $sql.= $value . ' AS ' . str_replace('.', '', $value) . ', ';
        }

        $sql = rtrim($sql, ', ');

        $sql.= ' FROM members';
        if (in_array('members_contact', $table)) {
            $sql.=' LEFT JOIN members_contact ON members_contact.PID=members.PID';
        }
        if (in_array('members_nextkin', $table)) {
            $sql.='  LEFT JOIN members_nextkin ON members_nextkin.PID=members.PID';
        }

        $sql.= " WHERE members.PIN='$pin' AND members.joiningdate >= '$fromdate' AND members.joiningdate <= '$todate' ORDER BY internal ASC";

        return $this->db->query($sql)->result();
    }

    function saving_account_name($refference, $table) {
        $sql = '';
        if ($table == 'members') {
            $sql = "SELECT CONCAT(firstname,' ',middlename,' ',lastname) as name FROM members where PID='$refference'";
        }
        if ($sql != '') {
            $result = $this->db->query($sql)->row();
            return $result->name;
        }
        return '';
    }

    function account_saving_statement($fromdate, $until, $account) {
        $pin = current_user()->PIN;
        $sql = "SELECT  account, trans_date,comment,system_comment,trans_type,paymethod,
case when trans_type = 'CR' then amount else 0 end as credit,
case when trans_type = 'DR' then amount else 0 end as debit,
previous_balance, (SELECT SUM(CASE when trans_type = 'CR' then amount else 0 end) FROM savings_transaction WHERE account='$account' AND trans_date < '$fromdate 00:00:00' ) as credit_total,
    (SELECT SUM(CASE when trans_type = 'DR' then amount else 0 end) FROM savings_transaction WHERE account='$account' AND trans_date < '$fromdate 00:00:00' ) as debit_total
FROM  
  savings_transaction WHERE account='$account' AND trans_date>='$fromdate 00:00:00' AND trans_date <= '$until 23:59:59'  ORDER BY trans_date ASC";

        return $this->db->query($sql)->result();
    }

    function contribution_statement($fromdate, $until, $member_id) {
        $pin = current_user()->PIN;
        $sql = "SELECT  PID,member_id, createdon,comment,system_comment,trans_type,paymethod,
case when trans_type = 'CR' then amount else 0 end as credit,
case when trans_type = 'DR' then amount else 0 end as debit,
previous_balance
   
FROM  
  contribution_transaction WHERE member_id='$member_id' AND PIN='$pin' AND createdon>='$fromdate 00:00:00' AND createdon <= '$until 23:59:59'  ORDER BY createdon ASC";

        return $this->db->query($sql)->result();
    }

    function contribution_statement_previous($fromdate, $member_id) {
        $current_user = current_user()->PIN;
        $sql = "SELECT  PID,member_id,
SUM(COALESCE(case when trans_type = 'CR' then amount else 0 end)) as credit,
SUM(COALESCE(case when trans_type = 'DR' then amount else 0 end)) as debit
FROM  
  contribution_transaction WHERE member_id='$member_id' AND PIN='$current_user' AND createdon < '$fromdate 00:00:00' GROUP BY member_id";
        return $this->db->query($sql)->row();
    }

    function share_statement($fromdate, $until, $member_id) {
        $current_user = current_user()->PIN;
        $sql = "SELECT  PID,member_id, createdon,comment,system_comment,trans_type,paymethod,
case when trans_type = 'CR' then amount else 0 end as credit,
case when trans_type = 'DR' then amount else 0 end as debit,
previous_balance,share_no,previous_share
   
FROM  
  share_transaction WHERE member_id='$member_id' AND PIN='$current_user' AND createdon>='$fromdate 00:00:00' AND createdon <= '$until 23:59:59'  ORDER BY createdon ASC";

        return $this->db->query($sql)->result();
    }

    function account_saving_transactions($fromdate, $until) {
        $pin = current_user()->PIN;
        $sql = "SELECT  account, trans_date,comment,system_comment,trans_type,paymethod,
case when trans_type = 'CR' then amount else 0 end as credit,
case when trans_type = 'DR' then amount else 0 end as debit,
previous_balance
FROM  
  savings_transaction WHERE PIN='$pin' AND  trans_date>='$fromdate 00:00:00' AND trans_date <= '$until 23:59:59'  ORDER BY trans_date ASC";

        return $this->db->query($sql)->result();
    }

    function contribution_transactions($fromdate, $until) {
        $pin = current_user()->PIN;
        $sql = "SELECT  PID,member_id, createdon,comment,system_comment,trans_type,paymethod,
case when trans_type = 'CR' then amount else 0 end as credit,
case when trans_type = 'DR' then amount else 0 end as debit,
previous_balance
FROM  
  contribution_transaction WHERE PIN='$pin' AND  createdon>='$fromdate 00:00:00' AND createdon <= '$until 23:59:59'  ORDER BY createdon ASC";

        return $this->db->query($sql)->result();
    }

    function share_transactions($fromdate, $until) {
        $pin = current_user()->PIN;
        $sql = "SELECT  PID,member_id, createdon,comment,system_comment,trans_type,paymethod,
case when trans_type = 'CR' then amount else 0 end as credit,
case when trans_type = 'DR' then amount else 0 end as debit,
previous_balance,share_no
FROM  
  share_transaction WHERE PIN='$pin' AND   createdon>='$fromdate 00:00:00' AND createdon <= '$until 23:59:59'  ORDER BY createdon ASC";

        return $this->db->query($sql)->result();
    }

    function account_saving_transactions_summary($fromdate, $until) {
        $pin = current_user()->PIN;
        $sql = "SELECT  account, SUM(case when trans_type = 'CR' then amount else 0 end) as credit, SUM(case when trans_type = 'DR' then amount else 0 end) as debit

FROM  
  savings_transaction WHERE PIN='$pin' AND   trans_date>='$fromdate 00:00:00' AND trans_date <= '$until 23:59:59'  GROUP BY account";

        return $this->db->query($sql)->result();
    }

    function contribution_transactions_summary($fromdate, $until) {
        $pin = current_user()->PIN;
        $sql = "SELECT  member_id, SUM(case when trans_type = 'CR' then amount else 0 end) as credit, SUM(case when trans_type = 'DR' then amount else 0 end) as debit

FROM  
  contribution_transaction WHERE PIN='$pin' AND   createdon>='$fromdate 00:00:00' AND createdon <= '$until 23:59:59'  GROUP BY member_id";

        return $this->db->query($sql)->result();
    }

    function share_transactions_summary($fromdate, $until) {
        $pin = current_user()->PIN;
        $sql = "SELECT  member_id, SUM(case when trans_type = 'CR' then amount else 0 end) as credit, SUM(case when trans_type = 'DR' then amount else 0 end) as debit,
SUM(case when trans_type = 'CR' then share_no else 0 end) as credit_sha, SUM(case when trans_type = 'DR' then share_no else 0 end) as debit_sha
FROM  
  share_transaction WHERE PIN='$pin' AND   createdon>='$fromdate 00:00:00' AND createdon <= '$until 23:59:59'  GROUP BY member_id";

        return $this->db->query($sql)->result();
    }

    function account_saving_transactions_summary_previous($fromdate, $account) {
        $pin = current_user()->PIN;
        $sql = "SELECT  account, SUM(case when trans_type = 'CR' then amount else 0 end) as credit, SUM(case when trans_type = 'DR' then amount else 0 end) as debit

FROM  
  savings_transaction WHERE PIN='$pin' AND   trans_date < '$fromdate 00:00:00' AND account = '$account'";

        return $this->db->query($sql)->row();
    }

    function contribution_transactions_summary_previous($fromdate, $member_id) {
        $pin = current_user()->PIN;
        $sql = "SELECT  member_id, SUM(case when trans_type = 'CR' then amount else 0 end) as credit, SUM(case when trans_type = 'DR' then amount else 0 end) as debit

FROM  
  contribution_transaction WHERE PIN='$pin' AND   createdon < '$fromdate 00:00:00' AND member_id = '$member_id'";

        return $this->db->query($sql)->row();
    }

    function share_transactions_summary_previous($fromdate, $member_id) {
        $pin = current_user()->PIN;
        $sql = "SELECT  member_id, SUM(case when trans_type = 'CR' then amount else 0 end) as credit, SUM(case when trans_type = 'DR' then amount else 0 end) as debit,
 SUM(case when trans_type = 'CR' then share_no else 0 end) as share_credit, SUM(case when trans_type = 'DR' then share_no else 0 end) as share_debit
FROM  
  share_transaction WHERE PIN='$pin' AND  createdon < '$fromdate 00:00:00' AND member_id = '$member_id'";

        return $this->db->query($sql)->row();
    }

    //////////////////////////////////LOAN////////////////////////
    function loan_delivery_list() {
        $pin = current_user()->PIN;
        if (!$this->ion_auth->in_group('Members')) {
          
            $sql = "SELECT loan_contract.LID, CONCAT(COALESCE(members.firstname, ''),' ',COALESCE(members.middlename, ''),' ',COALESCE(members.lastname, '')) as name FROM loan_contract
                  INNER JOIN members ON loan_contract.PID=members.PID WHERE loan_contract.PIN='$pin' AND loan_contract.disburse=1";
        } else {
             
            $sql = "SELECT loan_contract.LID, CONCAT(COALESCE(members.firstname, ''),' ',COALESCE(members.middlename, ''),' ',COALESCE(members.lastname, '')) as name FROM loan_contract
                  INNER JOIN members ON loan_contract.PID=members.PID WHERE loan_contract.PIN='$pin' AND loan_contract.disburse=1 AND loan_contract.member_id='" . current_user()->member_id . "'";
        }
        return $this->db->query($sql)->result();
    }

    function loan_statement($LID) {
        $this->db->where('LID', $LID);
        $this->db->order_by('installment', 'ASC');
        return $this->db->get('loan_contract_repayment')->result();
    }

     function loan_account_statement($LID) {
        $this->db->where('LID', $LID);
        $this->db->where('account', '1030012');
        //$this->db->order_by('installment', 'ASC');
        return $this->db->get('general_ledger')->result();
    }
    
     function loan_disbursement($LID) {
        $this->db->where('LID', $LID);
        $this->db->order_by('disbursedate', 'ASC');
        return $this->db->get('loan_contract_disburse')->result();
    }
    
    function loan_list_report($fromdate, $until, $loan_status) {
        $pin = current_user()->PIN;
        $sql = "SELECT * FROM loan_contract WHERE PIN='$pin' AND applicationdate >= '$fromdate' AND applicationdate <= '$until'";
        if ($loan_status != '') {
            if ($loan_status == 0) {
                $sql.= " AND status=$loan_status";
            } else if ($loan_status == 1) {
                $sql.= " AND evaluated=$loan_status";
            } else if ($loan_status == 2) {
                $sql.= " AND status=$loan_status";
            } else if ($loan_status == 4) {
                $sql.= " AND approval=$loan_status";
            } else if ($loan_status == 5) {
                $sql.= " AND status=$loan_status";
            } else if ($loan_status == 6) {
                $sql.= " AND disburse=1";
            } else if ($loan_status == 7) {
                $sql.= " AND evaluated= 2";
            } else if ($loan_status == 8) {
                $sql.= " AND approval= 2";
            } else if ($loan_status == 9) {
                $sql.= " AND approval= 4 AND disburse=1";
            }
        }

        return $this->db->query($sql)->result();
    }

    function loan_list_balance($fromdate, $untill) {
        $pin = current_user()->PIN;
        $sql = "SELECT loan_contract_disburse.*,loan_contract.*,(SELECT SUM(loan_contract_repayment.amount) FROM loan_contract_repayment WHERE loan_contract_repayment.LID=loan_contract_disburse.LID) as repay,
             (SELECT SUM(loan_contract_repayment.principle) FROM loan_contract_repayment WHERE loan_contract_repayment.LID=loan_contract_disburse.LID) as principle,
             (SELECT SUM(loan_contract_repayment.interest) FROM loan_contract_repayment WHERE loan_contract_repayment.LID=loan_contract_disburse.LID) as interest,
             (SELECT SUM(loan_contract_repayment.penalt) FROM loan_contract_repayment WHERE loan_contract_repayment.LID=loan_contract_disburse.LID) as penalt FROM loan_contract_disburse INNER JOIN loan_contract
                ON loan_contract_disburse.LID=loan_contract.LID WHERE loan_contract.PIN='$pin'  AND loan_contract_disburse.disbursedate <= '$untill'  ORDER BY loan_contract_disburse.disbursedate ASC";
        return $this->db->query($sql)->result();
    }

    function loan_transactions($fromdate, $untill) {
        $pin = current_user()->PIN;
        $sql = "SELECT * FROM loan_repayment_receipt WHERE PIN='$pin' AND  paydate >= '$fromdate' AND paydate <= '$untill'  ORDER BY paydate ASC";
        return $this->db->query($sql)->result();
    }

    function loan_transactions_summary($fromdate, $untill) {
        $pin = current_user()->PIN;
        $sql = "SELECT LID, SUM(amount) as amount FROM loan_repayment_receipt WHERE PIN='$pin' AND paydate >= '$fromdate' AND paydate <= '$untill' GROUP BY LID ";
        return $this->db->query($sql)->result();
    }

    function loan_arraers_report($from, $to) {
        $pin = current_user()->PIN;
        $sql = "SELECT c.* FROM loan_contract as c INNER JOIN loan_contract_disburse as d ON c.LID=d.LID WHERE c.disburse=1 AND c.status=4 AND d.createdon >= '$from 00:00:00' AND d.createdon <='$to 23:59:59'";
        $data = $this->db->query($sql)->result();
        $return = array();
        foreach ($data as $key => $value) {
            $product = $this->setting_model->loanproduct($value->product_type)->row();
            $sql2 = "SELECT * FROM loan_contract_repayment_schedule WHERE LID='$value->LID' AND status=0 AND CURRENT_DATE > DATE_ADD(repaydate, INTERVAL $product->warning_day DAY) ORDER BY LID ASC,installment_number ASC";
            $arrears = $this->db->query($sql2)->result();
            foreach ($arrears as $key1 => $value1) {
                $return[] = $value1;
            }
        }

        return $return;
    }

    function loan_maturity_report($from, $to, $dayinterval) {
        $pin = current_user()->PIN;
        $sql = "SELECT c.*,DATE(d.createdon) as disbursed_date FROM loan_contract as c INNER JOIN loan_contract_disburse as d ON c.LID=d.LID WHERE c.disburse=1 AND c.status=4 AND d.createdon >= '$from 00:00:00' AND d.createdon <='$to 23:59:59'";

        $data = $this->db->query($sql)->result();
        $return = array();
        foreach ($data as $key => $value) {
            $return[$key]['data'] = $value;
            $interval = $dayinterval;
            $leo = date('Y-m-d');
            for ($i = 0; $i <= 5; $i++) {
                $sql2 = "SELECT SUM(repayamount) as repayamount FROM loan_contract_repayment_schedule WHERE LID='$value->LID' AND status=0 AND repaydate >= '$leo' AND repaydate <= DATE_ADD('$leo', INTERVAL $interval DAY) ORDER BY LID ASC,installment_number ASC";
                $maturity = $this->db->query($sql2)->row();
                if ($maturity) {
                    $return[$key]['step'][$i] = $maturity->repayamount;
                } else {
                    $return[$key]['step'][$i] = '';
                }
                $tmp = date('Y-m-d', strtotime('+' . $interval . ' days', strtotime($leo)));
                $leo = $tmp;
            }
        }

        return $return;
    }

    function balance_nextinstall() {
        $sql = " SELECT * FROM loan_balance_carry  WHERE balance > 0";
        return $this->db->query($sql)->result();
    }

    function loan_classification_report() {
        $sql = "SELECT LID,classfication,days,rate FROM provision_rate_status ORDER BY classfication ASC,days ASC";
        return $this->db->query($sql)->result();
    }
    
    function loan_classification_report_rest() {
        $sql = "SELECT * FROM loan_contract WHERE LID NOT IN ( SELECT LID FROM provision_rate_status) AND status=4  ORDER BY LID ASC";
        return $this->db->query($sql)->result();
    }
    
    function loan_classification_report_rest_days($LID) {
        $sql = "SELECT * FROM loan_contract WHERE LID NOT IN ( SELECT LID FROM provision_rate_status) AND status=4  ORDER BY LID ASC";
        return $this->db->query($sql)->result();
    }
    
    function profit_for_current_year($fromdate, $todate, $year){       
        
           
                        //check income || 
                        $transaction = $this->create_ledger_trans_summary($fromdate, $todate, $year);

                        $total_income = 0;
                        $total_expenses = 0;


                        $check_exp_inc = 0;
                        if (array_key_exists(4, $transaction)) {
                            $check_exp_inc = 1;
                            //income data available
                           
                            foreach ($transaction[4] as $key1 => $value1) {
                                $account_info = $this->finance_model->account_chart(null, $key1)->row();

                                $open_balance_label = 0;

                                if (count($value1['current']) > 0) {

                                    $tmp = $value1['current']->credit - $value1['current']->debit;

                                    if ($tmp < 0) {
                                        $open_balance_label = '(' . number_format((0 - $tmp), 2) . ')';
                                        $total_income -= (0 - $tmp);
                                    } else {
                                        $open_balance_label = number_format($tmp, 2);
                                        $total_income += $tmp;
                                    }
                                }
                               
                            }
                            $total_income_label = '';

                            if ($total_income < 0) {
                                $total_income_label = '(' . number_format((0 - $total_income), 2) . ')';
                            } else {
                                $total_income_label = number_format($total_income, 2);
                            }
                           
                        }


                        if (array_key_exists(5, $transaction)) {
                            $check_exp_inc = 1;
                            //income data available
                           
                            foreach ($transaction[5] as $key1 => $value1) {
                                $account_info = $this->finance_model->account_chart(null, $key1)->row();

                                $open_balance_label = '-';

                                if (count($value1['current']) > 0) {

                                    $tmp = $value1['current']->debit - $value1['current']->credit;

                                    if ($tmp < 0) {
                                        $open_balance_label = '(' . number_format((0 - $tmp), 2) . ')';
                                        $total_expenses -= (0 - $tmp);
                                    } else {
                                        $open_balance_label = number_format($tmp, 2);
                                        $total_expenses += $tmp;
                                    }
                                }
                               
                            }
                            $total_expenses_label = '';

                            if ($total_expenses < 0) {
                                $total_expenses_label = '(' . number_format((0 - $total_expenses), 2) . ')';
                            } else {
                                $total_expenses_label = number_format($total_expenses, 2);
                            }
                           
                        }


                        
                         
                          $close_balance_label = '';
                          $close_balance = $total_income - $total_expenses;
                          
                          /*if ($close_balance > 0) {
                          $close_balance_label = number_format($close_balance, 2) ;
                         
                          } else if ($close_balance < 0) {
                          $close_balance_label = '('.number_format((0-$close_balance), 2) . ')';
                          
                          }*/
                          
        
        
        return $close_balance;        
        
    }
    
    
    

}
