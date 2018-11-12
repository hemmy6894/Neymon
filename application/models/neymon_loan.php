<?php
	class Neymon_Loan extends CI_Model {
		function create($loan = null,$loan_details = null,$activities = null){
			$num = 10000000;
			$loan_no = null;
			if($loan != null){
				$this->db->insert("neymon_loan",$loan);
				$id = $this->db->insert_id();
				$num += $id;
				$nums = "LN" . $num;
				$loan_no = array("loan_id" => $nums);
				$where = array("id" => $id);
				$this->db->update("neymon_loan",$loan_no,$where);
				$loan_no = $nums;
			}
			if($activities != null){
				$loan_details['activities'] = $this->activities_create($activities);
			}
			if($loan_details != null && $loan_no != null){
				$loan_details['dloan_no'] = $loan_no;
				return $this->db->insert("neymon_loan_details",$loan_details);
			}
		}
		
		function edit($loanno = null, $loan = null, $dloan = null, $action_performed = null){
			if(is_null($loanno)){
				return "Loan no can't be empty";
			}
			
			if(is_null($loan)){
				return "Nothing to update";
			}
			
			if(is_null($dloan)){
				return "Enter loan details to update";
			}
			if(is_null($action_performed)){
				$action_performed = "Edited";
			}
			$dloan['activities'] = $this->activities_create($action_performed,"neymon_loan_details",$loanno,"dloan_no");
			
			if($this->db->update("neymon_loan",$loan,array('loan_id' => $loanno))){
				return $this->db->update("neymon_loan_details",$dloan,array('dloan_no' => $loanno));
			}
			return $this->db->error(); 
		}
		
		function loan_info($loanid = null, $pin = null, $member_id = null) {

			if (!is_null($loanid)) {
				$this->db->where('neymon_loan.loan_id', $loanid);
			}
			if (!is_null($pin)) {
				//$this->db->where('PID', $pin);
			}
			if (!is_null($member_id)) {
				//$this->db->where('member_id', $member_id);
			}

			$this->db->join('neymon_loan_details','neymon_loan_details.dloan_no = neymon_loan.loan_id');
			return $this->db->get('neymon_loan');
		}
	
		function loan_wait_evaluation() {
			$pin = current_user()->PIN;
			return $this->db->query("SELECT * FROM neymon_loan as nl INNER JOIN neymon_loan_details as nld ON nl.loan_id = nld.dloan_no AND PIN='$pin' AND (d_loan_status = 'NEW' OR d_loan_status = 'EVALUATE') AND evaluated = 0 ORDER BY loan_date DESC")->result();
		}
	
<<<<<<< HEAD
		function loan_repay_list() {
			$pin = current_user()->PIN;
			$this->db->select("neymon_loan.*,members.firstname,members.middlename,members.lastname");
			$this->db->join("neymon_loan_details","neymon_loan_details.dloan_no = neymon_loan.loan_id");
			$this->db->join("members","neymon_loan.user_id = members.PID");
			$this->db->where(array("neymon_loan.PIN" => $pin));
			return $this->db->get("neymon_loan")->result();
=======
		function evaluate_loan($loanno,$evaluation,$comment){
			$curuser = current_user();
			
			$loan_contract_evaluation = array(
				'LID' => $loanno,
				'status' => 1,
				'comment' => $comment,
				'createdby' => $curuser->id,
				'PIN' => $curuser->PIN
			);
			
			$loan_details = array(
				'd_loan_status' => $evaluation
			);
			$loan_details['activities'] = $this->activities_create($comment,"neymon_loan_details",$loanno,"dloan_no");
			//die();
			//$this->db->select("*");
			//$this->db->where(array("LID" => $loanno));
			//$state_evaluation = $this->db->get('loan_contract_evaluation');
			//if($state_evaluation->num_rows() < 1){
				if($this->db->insert('loan_contract_evaluation',$loan_contract_evaluation)){
					return $this->db->update('neymon_loan_details',$loan_details,array('dloan_no' => $loanno));
				}else{
					return 0;
				}
			//}else{
			//	return 2;
			//}
>>>>>>> 736c3b096751c21a863aaf634533568ae460599e
		}
		
		function view($loan = null,$limit = null, $start = null){
			if(!is_null($loan)){
				$this->db->where(array('loan_id' => $loan));
			}
			$this->db->join('neymon_loan_details', 'neymon_loan_details.dloan_no = neymon_loan.loan_id');
			$this->db->order_by('neymon_loan.loan_id','ASC');
			if(!is_null($limit) && !is_null($start))
			$this->db->limit($limit,$start);
			return $this->db->get('neymon_loan');
		}
		function activities_create($activities = null, $table = null, $id = null, $pr = null){
			$all_data = array();
			if(!is_null($table) && !is_null($id) && !is_null($pr)){
				$n = $this->get_activity($table,$id,$pr);
				$all_data = $n == null ? array() : $n;
			}
			$count = count($all_data);
			
			$alld = array();
			if($count){
				foreach($all_data as $all){
					$alld[] = json_decode($all->activities);
					$alld = $alld[0];
				}
			}
			$count = count($alld);
			if($activities){
				$time = date("Y-m-d H:i:s");
				 $data = (object)array(
								"user" => current_user()->id,
								"action_time" => $time,
								"performed" => $activities
							);
				$alld[$count] = $data;
				//print_r($alld,false);
				return json_encode($alld);
			}else{
				return "[]";
			}
		}
		
		function get_activity($table,$id,$pr){
			$this->db->where(array($pr => "$id"));
			$this->db->select('activities');
			$res = $this->db->get($table)->result();
			if($counter = count($res)){
				return $res;
			}else{
				return null;
			}
		}
		
		function activities_read($activities){
			if($activities){
				return @json_decode($activities);
			}else{
				return (object)array("user" => "","action_time" => "", "performed" => "");
			}
		}
		
		function get_loan_interval(){
			return $this->db->get("loan_interval")->result();
		}
	}
?>