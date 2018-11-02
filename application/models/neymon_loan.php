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
		function activities_create($activities){
			if($activities){
				$time = date("Y-m-d H:i:s");
				$data = array(
								"user" => current_user()->id,
								"action_time" => $time,
								"performed" => $activities
							);
				return json_encode($data);
			}else{
				return "[]";
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