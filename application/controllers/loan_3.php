<?php
	class Loan_3 extends CI_Controller {
		function __construct() {
			parent::__construct();
			if (!$this->ion_auth->logged_in()) {
				//redirect them to the login page
				redirect('auth/login', 'refresh');
			}
			$this->data['current_title'] = lang('page_loan');
			$this->lang->load('member');
			$this->lang->load('finance');
			$this->lang->load('loan');
			$this->lang->load('setting');
			$this->lang->load('customer');
			$this->load->model('neymon_loan');
			$this->load->model('loan_model');
			$this->load->model('member_model');
			$this->load->model('setting_model');
			$this->load->model('contribution_model');
		}
		function loan_application(){
			if($this->input->post('requested_amount')){
				 $_POST['requested_amount'] = str_replace(',','',$_POST['requested_amount']);
				 $_POST['grace_period'] = str_replace(',','',$_POST['grace_period']);
			}
			$this->form_validation->set_rules('requested_amount', lang('requested_amount'), 'required|numeric');
			$this->form_validation->set_rules('member_type_id_number', lang('member_type_id_number'), 'required');
			$this->form_validation->set_rules('rate', 'Rate', 'required|numeric');
			$this->form_validation->set_rules('installment', lang('loan_installment'), 'required|numeric');
			$this->form_validation->set_rules('installment_mark', 'installment mark', 'required');
			$this->form_validation->set_rules('applicationdate', lang('loan_applicationdate'), 'required|valid_date');
			$this->form_validation->set_rules('amount_by_word', lang('amount_by_word'), 'required');
			$this->form_validation->set_rules('purpose', lang('loan_purpose'), 'required');
			$this->form_validation->set_rules('grace_period', lang('grace_period'), 'required|numeric');
			$this->form_validation->set_rules('grace_period_unit', lang('grace_period_unit'), 'required');
			if($this->form_validation->run() == TRUE){
				$rate = $this->input->post('rate');
				$appdate = $this->input->post('applicationdate');
				$member_type_id_number = $this->input->post('member_type_id_number');
				$amount_by_word = $this->input->post('amount_by_word');
				$requested_amount = $this->input->post('requested_amount');
				$ins = $this->input->post('installment');
				$mark = $this->input->post('installment_mark');
				echo $deaddate =  date('Y-m-d', strtotime("+$ins $mark", strtotime($appdate)));;
				$loan_amount_rate = $requested_amount * ($rate / 100);
				$loan_amount_total = $requested_amount + $loan_amount_rate;
				
				$loan = array(
							'loan_amount' => $requested_amount,
							'loan_period' => $ins,
							'user_id' => $member_type_id_number,
							'loan_period_mark' => $mark,
							'account_type' => "M-Pesa",
							'amount_by_word' => $amount_by_word,
							'loan_rate' => $rate,
							'loan_date' => $appdate,
							'loan_deadline' => $deaddate,
							'loan_amount_rate' => $loan_amount_rate,
							'loan_amount_total' => $loan_amount_total,
						);
				
				$payed = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
					
				$grace_period = $this->input->post('grace_period');
				$grace_period_unit = $this->input->post('grace_period_unit');
				$penalt = 1;
				$penalt_time = 1;
				$penalt_mark = "days";
				$purpose = $this->input->post('purpose');
				$calculation =  $this->loan_calculator($requested_amount,$payed,$ins,$grace_period);
				$loan_details = array(
										'grace_period' => $grace_period,
										'grace_period_mark' => $grace_period_unit,
										'penalty' => $penalt,
										'penalty_time' => $penalt_time,
										'penalty_mark' => $penalt_mark,
										'dloan_purpose' => $purpose,
										'd_loan_status' => 'NEW',
										'calculation' => $calculation,
										'id_prepared' => current_user()->id
									);
									
				
				$this->neymon_loan->create($loan, $loan_details, "Created");
				//die("SUCCESS");
			}
			
			$this->data['loan_interval'] = $this->neymon_loan->get_loan_interval();
			$this->data['content'] = 'loan/loan_application_step3';
			$this->load->view('template', $this->data);
		}
		
		function view_indetail($loanid) {
			$this->data['title'] = lang('loan_viewdetails');
			$this->data['loanid'] = $loanid;
			$LID = decode_id($loanid);
			$this->data['loaninfo'] = $this->neymon_loan->loan_info($LID)->row();
			$this->data['function_view'] = function($datas){
				$this->view_calculator($datas);
			};
			//print_r($this->data['loaninfo']);
			//die();
			$this->data['content'] = 'loan/neymon_loan_view_in_details';
			$this->load->view('template', $this->data);
		}
	
		function view($loanno = null){
			$this->load->library('pagination');
			
			$this->data['title'] = lang('loan_list');
			if (!$this->ion_auth->logged_in()) {
				//redirect them to the login page
				redirect('auth/login', 'refresh');
			}
			if (isset($_GET['row_per_pg'])) {
				$this->session->set_userdata('PER_PAGE', $_GET['row_per_pg']);
			} else if (!$this->session->userdata('PER_PAGE')) {
				$this->session->set_userdata('PER_PAGE', 40);
			}
			$config["per_page"] = $this->session->userdata('PER_PAGE');
			$key = null;
			if (isset($_POST['key']) && $_POST['key'] != '') {
				$key = $_POST['key'];
			} else if (isset($_GET['key'])) {
				$key = $_GET['key'];
			}
			if (!is_null($key)) {
				$config['suffix'] = '?key=' . $key;
			}
			$page = ($this->uri->segment(4) ? $this->uri->segment(4) : 0);
			$returned_data = $this->neymon_loan->view($key,$config["per_page"],$page);
			$config["base_url"] = site_url(current_lang() . '/loan/loan_viewlist/');
			$config["total_rows"] = $returned_data->num_rows;
			$config["uri_segment"] = 4;
			$config['full_tag_open'] = '<div class="pagination" style="background-color:#fff; margin-left:0px;">';
			$config['full_tag_close'] = '</div>';
			$config['num_tag_open'] = '<div class="link-pagination">';
			$config['num_tag_close'] = '</div>';
			$config['prev_tag_open'] = '<div class="link-pagination">';
			$config['prev_tag_close'] = '</div>';
			$config['next_tag_open'] = '<div class="link-pagination">';
			$config['next_tag_close'] = '</div>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Previous';
			$config['cur_tag_open'] = '<div class="link-pagination current">';
			$config['cur_tag_close'] = '</div>';
			$config["num_links"] = 10;
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4) ? $this->uri->segment(4) : 0);
			$this->data['links'] = $this->pagination->create_links();
			$rs = $returned_data->result();
			$this->data['loan_list'] = $rs;
			$this->data['content'] = 'loan/neymon_view_loan';
			$this->load->view('template', $this->data);
		}
		
		function loan_evaluation() {
			$this->data['title'] = lang('loan_evaluation_list');
			$this->data['loan_wait'] = $this->neymon_loan->loan_wait_evaluation();
			
			//print_r($this->data['loan_wait']);
			
			//die();
			$this->data['content'] = 'loan/neymon_loan_evaluation_list';
			$this->load->view('template', $this->data);
		}
		
		function loan_evaluation_action($loanid) {
			$pin = current_user()->PIN;
			$this->data['title'] = lang('loan_evaluation_inaction');
			$this->data['loanid'] = $loanid;
			$LID = "LN10000007";//decode_id($loanid);
			$this->data['loaninfo'] = $this->neymon_loan->loan_info($LID)->row();
			$this->form_validation->set_rules('status', lang('loan_status'), 'required');
			$this->form_validation->set_rules('comment', lang('loan_comment'), 'required');
			if ($this->form_validation->run() == TRUE) {
				$where = array(
								'loan_id' => $LID
							);
				$array_data = array(
					'd_loan_status' => $this->input->post('status'),
					'id_accepted' => current_user()->id
				);
				$activities = $this->input->post('comment');
			}
			//print_r($this->data['loaninfo']);
			//die();
			$this->data['content'] = 'loan/neymon_evaluation_action';
			$this->load->view('template', $this->data);
		}
	
		function loan_editing($loanid) {
			$this->data['loanid'] = $loanid;
			$LID = decode_id($loanid);
			$info = $this->neymon_loan->loan_info($LID)->row();
			
			$this->data['basicinfo'] = $this->member_model->member_basic_info(null, null, $info->user_id)->row();
			$l = $this->data['loaninfo'] = $this->neymon_loan->loan_info($LID)->row();
			$p = $this->data['paysource_list'] = $this->contribution_model->contribution_source()->result();
			$lp = $this->data['loan_product_list'] = $this->setting_model->loanproduct()->result();
			
			/*
			print_r($l);
			echo "<br>";
			echo "<br>";
			print_r($p);
			echo "<br>";
			echo "<br>";
			print_r($lp);
			*/
			//die();
			$this->data['content'] = 'loan/neymon_loan_editind';
			$this->load->view('template', $this->data);
		}
		function view_calculator($calculator,$action = null){
			if(is_null($action)){
				$action = "readonly";
				$calculator = json_decode($calculator);
			}else{
				$action = "";
			}
			?>
				<table border="1" cellspacing="2" cellpadding="5" class="table" width="80%">
					<tr>
						<th>Month</th>
						<th>Principal</th>
						<th>Principle payment</th>
						<th>Interest</th>
						<th>Month pay</th>
						<th>Payed</th>
						<th>Month Remain Balance</th>
						<th>Outstanding</th>
					</tr>
					<?php
						$b = 0;
						foreach($calculator as $c){
							$c = (array)$c;
							$payed = $c['payed'];
						?>
							<tr>
								<td><?=$c['month'];?></td>
								<td><?=$c['principal'];?></td>
								<td><?=$c['principle_payment'];?></td>
								<td><?=$c['interest'];?></td>
								<td><?=$c['month_pay'];?></td>
								<td><input type="text" id="payed<?=$b++;?>" value="<?=$payed;?>" <?=$action;?> oninput="onchanged(this)" size="12" onkeyup="onchanged(this)"></td>
								<td><?=$c['month_remain_balance'];?></td>
								<td><?=$c['outstanding'];?></td>
							</tr>
						<?php
						}
					?>
				</table>
				<?php
		}
		function loan_calculator($principal,$payed,$period,$grace_period){
			for($i = 0; $i < $period; $i++){
				$payed_array[$i] = array('month' => 'October', 'payed' => $payed[$i]);
			}
			$interest = $_POST['rate'] / 100;
			$priperiod = $principal / $period;
			$calculator = array();
			
			$i = 0;
			foreach($payed_array as $payed_a){
				$principle_payment = $this->principle_payment($priperiod,$principal);
				$interest2 = $this->interest($principal,$interest);
				$month_pay = $this->month_pay($principle_payment,$interest2);
				$month_remain_balance = $this->month_remain_balance($month_pay,(float)$payed_a['payed']);
				$outstanding = $this->outstanding($principal,$principle_payment,$month_remain_balance,$month_pay);

				$calculator[$i]['month'] = $payed_a['month'];
				$calculator[$i]['payed'] = $payed_a['payed'];
				$calculator[$i]['principal'] = $principal;
				$calculator[$i]['principle_payment'] = $principle_payment;
				$calculator[$i]['interest'] = $interest2;
				$calculator[$i]['month_pay'] = $month_pay;
				$calculator[$i]['month_remain_balance'] = $month_remain_balance;
				$calculator[$i]['outstanding'] = $outstanding;
				$i++;
				$principal = $outstanding;
			}
			
			return json_encode($calculator);
		}
		
		function principle_payment($priperiod,$outsating){
			return $priperiod > $outsating ? $outsating : $priperiod;
		}

		function interest($principal,$interest){
			return $principal * $interest;
		}

		function month_pay($principle_payment,$interest){
			return $principle_payment + $interest;
		}

		function month_remain_balance($month_pay,$payed){
			return $payed - $month_pay;
		}

		function outstanding($principal,$principle_payment,$month_remain_balance,$payed = null){
			return $payed >= 0 ? $principal - $principle_payment  : $principal - $principle_payment - $month_remain_balance;
		}
		
		function query_calculation($loanno){
			
		}
	}
?>