<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clientaccount
 *
 * @author miltone
 */
class Current_Year extends CI_Controller {

    //put your code here

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->form_validation->set_error_delimiters('<div class="error_message">', '</div>');

        $this->data['current_title'] = lang('page_setting');
        $this->lang->load('setting');
        $this->load->model('setting_model');
        $this->load->model('finance_model');
        $this->load->library('user_agent');
    }

    function change_to($id = null) {
        $id = decode_id($id);
        $year = $this->finance_model->get_financial_year($id);
        $this->session->set_userdata('user_active_year', $year->year);
        //redirect('dashboard/index');
        redirect($this->agent->referrer());
    }

}

?>
