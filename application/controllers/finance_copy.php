<?php  

	/**
	 * 
	 */
	class finance_copy extends CI_controller
	{
		
		 function __construct() {
        parent::__construct();


        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->form_validation->set_error_delimiters('<div class="error_message">', '</div>');

        $this->data['current_title'] = lang('page_finance');
        $this->lang->load('setting');
        $this->lang->load('finance');
        $this->load->model('member_model');
        $this->load->model('finance_model');
        $this->load->model('setting_model');
    }

    function index() {
        
    }


    function finance_account_create($account_amount = null) {
        $this->data['title'] = lang('finance_account_create');
        
        $this->form_validation->set_rules('account_type', lang('member_group_description'), 'required');
        $this->form_validation->set_rules('accountdate', lang('finance_account_date'), 'required');
        $this->form_validation->set_rules('accountnumber', lang('finance_account_number'), 'required');
        $this->form_validation->set_rules('accountamount', lang('finance_account_amount'), 'required');
        $this->form_validation->set_rules('accountname2', lang('finance_account_name2'), 'required');
        
        $this->form_validation->set_rules('accountdescription', lang('finance_account_description'), '');


        if ($this->form_validation->run() == TRUE) {


            $date = $this->input->post('accountdate');
            $accountnumber = $this->input->post('accountnumber');
            $tmp = $this->input->post('account_type');
            $accountamount = $this->input->post('accountamount');
            $description = $this->input->post('accountdescription');
            $name = $this->input->post('accountname2');
            $tmp1 = explode('_', $tmp);
            $accounttype = $tmp1[0];
            $accounttype_sub = $tmp1[1];


            $create_account = array(
                'account_date' => $date,
                'account_number' => $accountnumber,
                'account_type' => $accounttype,
                'sub_account_type' => $accounttype_sub,
                'account_amount' => trim($accountamount),
                'description' => trim($description),
                'name' => trim($name),
               
            );
            $return = $this->finance_model->create_chart_account($create_account);
            if ($return) {
                $this->session->set_flashdata('message', lang('finance_account_create_success'));
                redirect(current_lang() . '/finance/finance_account_create/' . $parent_account, 'refresh');
            } else {
                $this->data['warning'] = lang('finance_account_create_fail');
            }
        }

        $this->data['account_typelist'] = $this->finance_model->account_typelist()->result();

        $this->data['content'] = 'finance/create_account';
        $this->load->view('template', $this->data);
    }
















		
	}