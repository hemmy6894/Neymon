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
				return array("user" => "","action_time" => "", "performed" => "");
			}
		}
		
		function get_loan_interval(){
			return $this->db->get("loan_interval")->result();
		}
	}
?>