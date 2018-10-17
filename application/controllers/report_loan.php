<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of report_loan
 *
 * @author miltone
 */
class Report_Loan extends CI_Controller {

	private $header_page;
//put your code here
    function __construct() {
        parent::__construct();

		$this->header_page = $header_page = '<div style="border-bottom:1px solid #000; text-align:center;">
                <table style="display:inline-block;"><tr><td valign="top"><img style="height:50px; display:inline-block;" src="' . base_url() . 'logo/' . company_info()->logo . '"/></td>
                    <td style="text-align:center;"><h2 style="padding: 0px; margin: 0px;font-size:18px; text-align:center;"><strong>' . company_info()->name . '</strong></h2>
                        <h5 style="padding: 0px; margin: 0px; font-size:15px; text-align:center;"><strong> P.O.Box ' . strtoupper(company_info()->box) . ' , ' . strtoupper(lang('clientaccount_label_phone')) . ':' . company_info()->mobile . '</strong></h5></td></tr></table> 
                </div>';
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->form_validation->set_error_delimiters('<div class="error_message">', '</div>');

        $this->data['current_title'] = lang('page_report');
        $this->lang->load('member');
        $this->lang->load('finance');
        $this->lang->load('loan');
        $this->lang->load('setting');
        $this->lang->load('customer');
        $this->load->library('loanbase');
        $this->load->model('finance_model');
        $this->load->model('member_model');
        $this->load->model('contribution_model');
        $this->load->model('setting_model');
        $this->load->model('customer_model');
        $this->load->model('loan_model');
        $this->load->model('share_model');
        $this->load->model('report_model');
    }

    function repayment_schedule() {
        $this->data['title'] = lang('repayment_schedule');
        $this->form_validation->set_rules('loan_id', lang('loan_id'), 'required');
        $this->data['loan_id'] = '';
        $loan_id = '';
        if ($this->form_validation->run() == TRUE) {
            $loan_id = $this->input->post('loan_id');
            $this->data['loan_id'] = $loan_id;
        }

        if (isset($_GET['loan_id'])) {
            $loan_id = $_GET['loan_id'];
            $this->data['loan_id'] = $loan_id;
        }
        $this->data['loan_list'] = $this->report_model->loan_delivery_list();        
        $this->data['content'] = 'report/loan/repayment_schedule';
        $this->load->view('template', $this->data);
    }

    function loan_statement() {
        $this->data['title'] = lang('loan_statement');
        $this->form_validation->set_rules('loan_id', lang('loan_id'), 'required');
        $this->data['loan_id'] = '';
        $loan_id = '';
        if ($this->form_validation->run() == TRUE) {
            $loan_id = $this->input->post('loan_id');
            $this->data['loan_id'] = $loan_id;
        }

        if (isset($_GET['loan_id'])) {
            $loan_id = $_GET['loan_id'];
            $this->data['loan_id'] = $loan_id;
        }
        $this->data['loan_list'] = $this->report_model->loan_delivery_list();
        $this->data['content'] = 'report/loan/loan_statement';
        $this->load->view('template', $this->data);
    }

    function loan_statement_print() {
        $LID = $_GET['loan_id'];
        $this->data['loaninfo'] = $this->loan_model->loan_info($LID)->row();
        $this->data['trans'] = $this->report_model->loan_statement($LID);
        $html = $this->load->view('report/loan/print/loan_statement_print', $this->data, true);
        $this->export_to_pdf($html, $LID, 'A4');
    }
    
    function loan_statement_custom() {
        $this->data['title'] = lang('loan_statement');
        $this->form_validation->set_rules('loan_id', lang('loan_id'), 'required');
        $this->data['loan_id'] = '';
        $loan_id = '';
        if ($this->form_validation->run() == TRUE) {
            $loan_id = $this->input->post('loan_id');
            $this->data['loan_id'] = $loan_id;
        }

        if (isset($_GET['loan_id'])) {
            $loan_id = $_GET['loan_id'];
            $this->data['loan_id'] = $loan_id;
        }
        $this->data['loan_list'] = $this->report_model->loan_delivery_list();
        $this->data['content'] = 'report/loan/loan_statement_custom';
        $this->load->view('template', $this->data);
    }

    function loan_statement_custom_print() {
        $LID = $_GET['loan_id'];
        $this->data['loaninfo'] = $this->loan_model->loan_info($LID)->row();
         $this->data['trans'] = $this->report_model->loan_statement($LID);
   $this->data['repayment'] = $this->report_model->loan_statement($LID); 
   $this->data['disbursment'] = $this->report_model->loan_disbursement($LID); 
   $this->data['schedule'] = $this->db->get_where('loan_contract_repayment_schedule', array('LID' => $LID))->result();
   $this->data['dues'] = $this->db->get_where('loan_contract_repayment_schedule', array('LID' => $LID, 'repaydate <=' => date('Y-m-d')))->result();
  
        $html = $this->load->view('report/loan/print/loan_statement_custom_print', $this->data, true);
        $this->export_to_pdf($html, $LID, 'A4');
    }
    
    function loan_account_statement() {
        $this->data['title'] = lang('loan_account_statement');
        $this->form_validation->set_rules('loan_id', lang('loan_id'), 'required');
        $this->data['loan_id'] = '';
        $loan_id = '';
        if ($this->form_validation->run() == TRUE) {
            $loan_id = $this->input->post('loan_id');
            $this->data['loan_id'] = $loan_id;
        }

		
        if (isset($_GET['loan_id'])) {
            $loan_id = $_GET['loan_id'];
            $this->data['loan_id'] = $loan_id;
        }
        $this->data['loan_list'] = $this->report_model->loan_delivery_list();
        $this->data['content'] = 'report/loan/loan_account_statement';
        $this->load->view('template', $this->data);
    }

    function loan_account_statement_print() {
        $LID = $_GET['loan_id'];
        $this->data['loaninfo'] = $this->loan_model->loan_info($LID)->row();
        $this->data['trans'] = $this->report_model->loan_account_statement($LID);
        $html = $this->load->view('report/loan/print/loan_account_statement_print', $this->data, true);
        $this->export_to_pdf($html, $LID, 'A4');
    }

    function delete_report_loan($link, $id = null) {
        if (!is_null($id)) {
            $id = decode_id($id);
            $this->db->delete('report_table_loan', array('id' => $id));
            redirect(current_lang() . '/report_loan/loan_report/' . $link);
        }
        redirect(current_lang() . '/report_loan/loan_report/' . $link);
    }

    function loan_report($link, $id = null) {

        if ($link == 1) {
            $this->data['title'] = lang('report_loan_list');
        } else if ($link == 2) {
            $this->data['title'] = lang('report_loan_balance');
        } else if ($link == 3) {
            $this->data['title'] = lang('report_loan_interest_penalty');
        } else if ($link == 4) {
            $this->data['title'] = lang('report_loan_transaction');
        } else if ($link == 5) {
            $this->data['title'] = lang('report_loan_transaction_summary');
        } else if ($link == 6) {
            $this->data['title'] = 'Loan Arrears Report';
        } else if ($link == 7) {
            $this->data['title'] = 'Loan Maturity Report';
        }else if ($link == 8) {
            $this->data['title'] = 'Classification Loan Report';
        }


        $this->data['id'] = $id;
        $this->data['link_cat'] = $link;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $this->data['reportlist'] = $this->report_model->report_loan(null, $link)->result();
        $this->data['content'] = 'report/loan/loan_report_title';
        $this->load->view('template', $this->data);
    }

    function create_loan_report_title($link, $id = null) {
        if ($link == 1) {
            $this->data['title'] = lang('report_loan_list');
        } else if ($link == 2) {
            $this->data['title'] = lang('report_loan_balance');
        } else if ($link == 3) {
            $this->data['title'] = lang('report_loan_interest_penalty');
        } else if ($link == 4) {
            $this->data['title'] = lang('report_loan_transaction');
        } else if ($link == 5) {
            $this->data['title'] = lang('report_loan_transaction_summary');
        } else if ($link == 6) {
            $this->data['title'] = 'Loan Arrears Report';
        } else if ($link == 7) {
            $this->data['title'] = 'Loan Maturity Report';
        }else if ($link == 8) {
            $this->data['title'] = 'Classification Loan Report';
        }


        $this->data['id'] = $id;
        $this->data['link_cat'] = $link;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $this->form_validation->set_rules('fromdate', ($link == 1 ? 'Loan applied From' : (($link == 3 || $link == 6 || $link == 7 || $link == 8) ? 'Loan Disbursed From' : ($link_cat == 2 ? 'Loan Disbursed Until' :  'From'))), 'required|valid_date');
      if ($link != 2) {
        $this->form_validation->set_rules('todate', 'Until', 'required|valid_date');
       }
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($link == 7) {
            $this->form_validation->set_rules('custom', 'Days Interval', 'required|integer');
        }
        if ($this->form_validation->run() == TRUE) {
            $from = format_date(trim($this->input->post('fromdate')));
            if ($link != 2) {
            $to = format_date(trim($this->input->post('todate')));
            } else {
                $to = $from;
            }
            $description = trim($this->input->post('description'));
            $page = trim($this->input->post('page'));
            if ($from <= $to) {
                $array = array(
                    'fromdate' => $from,
                    'todate' => $to,
                    'description' => $description,
                    'link' => $link,
                    'page' => $page,
                    'PIN' => current_user()->PIN,
                );

                if ($link == 1) {
                    $array['custom'] = $this->input->post('custom');
                } else if ($link == 7) {
                    $array['custom'] = $this->input->post('custom');
                }

                if (is_null($id)) {
                    $this->db->insert('report_table_loan', $array);
                } else {
                    $this->db->update('report_table_loan', $array, array('id' => $id));
                }

                redirect(current_lang() . '/report_loan/loan_report/' . $link, 'refresh');
            } else {
                $this->data['warning'] = 'From date is greater than until date';
            }
        }


        if (!is_null($id)) {
            $this->data['reportinfo'] = $this->report_model->report_loan($id)->row();
        }

        $this->data['content'] = 'report/loan/create_loan_report_title';
        $this->load->view('template', $this->data);
    }

    function loan_list_view($link, $id) {
        $this->data['title'] = lang('report_loan_list');
        $this->data['link_cat'] = $link;
        $this->data['id'] = $id;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $reportinfo = $this->report_model->report_loan($id)->row();
        $this->data['reportinfo'] = $reportinfo;
        $this->data['transaction'] = $this->report_model->loan_list_report($reportinfo->fromdate, $reportinfo->todate, $reportinfo->custom);

        $this->data['content'] = 'report/loan/loan_list_view';
        $this->load->view('template', $this->data);
    }

    function loan_list_print($link, $id) {
        $this->data['title'] = lang('report_loan_list');
        $this->data['link_cat'] = $link;
        $this->data['id'] = $id;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $reportinfo = $this->report_model->report_loan($id)->row();
        $this->data['reportinfo'] = $reportinfo;
        $this->data['transaction'] = $this->report_model->loan_list_report($reportinfo->fromdate, $reportinfo->todate, $reportinfo->custom);

        $html = $this->load->view('report/loan/print/loan_list_print', $this->data, true);
        $this->export_to_pdf($html, 'Loan_list', 'A4-L');
    }

    function loan_balance_view($link, $id) {
        $this->data['title'] = lang('report_loan_balance');
        $this->data['link_cat'] = $link;
        $this->data['id'] = $id;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $reportinfo = $this->report_model->report_loan($id)->row();
        $this->data['reportinfo'] = $reportinfo;
        $this->data['transaction'] = $this->report_model->loan_list_balance($reportinfo->fromdate, $reportinfo->todate);

        $this->data['content'] = 'report/loan/loan_balance';
        $this->load->view('template', $this->data);
    }
    function loan_classification_view() {
        $this->data['title'] = 'Loan Classification Report';
      
        $this->data['transaction'] = $this->report_model->loan_classification_report();
        $this->data['transaction_rest'] = $this->report_model->loan_classification_report_rest();

        $this->data['content'] = 'report/loan/loan_classification';
        $this->load->view('template', $this->data);
    }
    function loan_classification_print() {
        $this->data['title'] = 'Loan Classification Report';
      
        $this->data['transaction'] = $this->report_model->loan_classification_report();
        $this->data['transaction_rest'] = $this->report_model->loan_classification_report_rest();

        
        $html = $this->load->view('report/loan/print/loan_classification_print', $this->data, true);
        $this->export_to_pdf($html, 'Loan_Classfication_Report', 'A4-L');
       
    }

    function loan_maturity_view($link, $id) {
        $this->data['title'] = 'Loan Maturity Report';
        $this->data['link_cat'] = $link;
        $this->data['id'] = $id;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $reportinfo = $this->report_model->report_loan($id)->row();
        $this->data['reportinfo'] = $reportinfo;
        $this->data['transaction'] = $this->report_model->loan_maturity_report($reportinfo->fromdate, $reportinfo->todate,$reportinfo->custom);

        $this->data['content'] = 'report/loan/loan_maturity_report';
        $this->load->view('template', $this->data);
    }

    function loan_arrears_view($link, $id) {
        $this->data['title'] = 'Loan Arrears Report';
        $this->data['link_cat'] = $link;
        $this->data['id'] = $id;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $reportinfo = $this->report_model->report_loan($id)->row();
        $this->data['reportinfo'] = $reportinfo;
        $this->data['transaction'] = $this->report_model->loan_arraers_report($reportinfo->fromdate, $reportinfo->todate);

        $this->data['content'] = 'report/loan/loan_arrears_report';
        $this->load->view('template', $this->data);
    }

    function loan_arrears_print($link, $id) {
        $this->data['title'] = 'Loan Arrears Report';
        $this->data['link_cat'] = $link;
        $this->data['id'] = $id;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $reportinfo = $this->report_model->report_loan($id)->row();
        $this->data['reportinfo'] = $reportinfo;
        $this->data['transaction'] = $this->report_model->loan_arraers_report($reportinfo->fromdate, $reportinfo->todate);

        $html = $this->load->view('report/loan/print/loan_arrears_report', $this->data, true);
        $this->export_to_pdf($html, 'Loan_Arrears_Report', 'A4-L');
       
    }
    function loan_maturity_print($link, $id) {
    $this->data['title'] = 'Loan Maturity Report';
        $this->data['link_cat'] = $link;
        $this->data['id'] = $id;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $reportinfo = $this->report_model->report_loan($id)->row();
        $this->data['reportinfo'] = $reportinfo;
        $this->data['transaction'] = $this->report_model->loan_maturity_report($reportinfo->fromdate, $reportinfo->todate,$reportinfo->custom);

        $html = $this->load->view('report/loan/print/loan_maturity_report', $this->data, true);
        $this->export_to_pdf($html, 'Loan_Maturity_Report', 'A4-L');
        $this->load->view('template', $this->data);
    }
    

    function loan_balance_print($link, $id) {
        $this->data['title'] = lang('report_loan_balance');
        $this->data['link_cat'] = $link;
        $this->data['id'] = $id;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $reportinfo = $this->report_model->report_loan($id)->row();
        $this->data['reportinfo'] = $reportinfo;
        $this->data['transaction'] = $this->report_model->loan_list_balance($reportinfo->fromdate, $reportinfo->todate);

        $html = $this->load->view('report/loan/print/loan_balance_print', $this->data, true);
        $this->export_to_pdf($html, 'Loan_balance', 'A4-L');
        ;
    }

    function loan_interest_penalty_view($link, $id) {
        $this->data['title'] = lang('report_loan_interest_penalty');
        $this->data['link_cat'] = $link;
        $this->data['id'] = $id;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $reportinfo = $this->report_model->report_loan($id)->row();
        $this->data['reportinfo'] = $reportinfo;
        $this->data['transaction'] = $this->report_model->loan_list_balance($reportinfo->fromdate, $reportinfo->todate);

        $this->data['content'] = 'report/loan/loan_interest_balance';
        $this->load->view('template', $this->data);
    }

    function loan_interest_penalty_print($link, $id) {
        $this->data['title'] = lang('report_loan_interest_penalty');
        $this->data['link_cat'] = $link;
        $this->data['id'] = $id;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $reportinfo = $this->report_model->report_loan($id)->row();
        $this->data['reportinfo'] = $reportinfo;
        $this->data['transaction'] = $this->report_model->loan_list_balance($reportinfo->fromdate, $reportinfo->todate);

        $html = $this->load->view('report/loan/print/loan_interest_balance_print', $this->data, true);
        $this->export_to_pdf($html, 'Loan_balance_interest_penalty', $reportinfo->page);
    }

    function loan_transaction_view($link, $id) {
        $this->data['title'] = lang('report_loan_transaction');
        $this->data['link_cat'] = $link;
        $this->data['id'] = $id;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $reportinfo = $this->report_model->report_loan($id)->row();
        $this->data['reportinfo'] = $reportinfo;
        $this->data['transaction'] = $this->report_model->loan_transactions($reportinfo->fromdate, $reportinfo->todate);

        $this->data['content'] = 'report/loan/loan_transaction';
        $this->load->view('template', $this->data);
    }

    function loan_transaction_print($link, $id) {
        $this->data['title'] = lang('report_loan_transaction');
        $this->data['link_cat'] = $link;
        $this->data['id'] = $id;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $reportinfo = $this->report_model->report_loan($id)->row();
        $this->data['reportinfo'] = $reportinfo;
        $this->data['transaction'] = $this->report_model->loan_transactions($reportinfo->fromdate, $reportinfo->todate);
        $html = $this->load->view('report/loan/print/loan_transaction_print', $this->data, true);
        $this->export_to_pdf($html, 'Loan_transactions', $reportinfo->page);
    }

    function loan_transaction_summary_view($link, $id) {
        $this->data['title'] = lang('report_loan_transaction_summary');
        $this->data['link_cat'] = $link;
        $this->data['id'] = $id;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $reportinfo = $this->report_model->report_loan($id)->row();
        $this->data['reportinfo'] = $reportinfo;
        $this->data['transaction'] = $this->report_model->loan_transactions_summary($reportinfo->fromdate, $reportinfo->todate);

        $this->data['content'] = 'report/loan/loan_transaction_summary';
        $this->load->view('template', $this->data);
    }

    function loan_transaction_summary_print($link, $id) {
        $this->data['title'] = lang('report_loan_transaction_summary');
        $this->data['link_cat'] = $link;
        $this->data['id'] = $id;
        if (!is_null($id)) {
            $id = decode_id($id);
        }

        $reportinfo = $this->report_model->report_loan($id)->row();
        $this->data['reportinfo'] = $reportinfo;
        $this->data['transaction'] = $this->report_model->loan_transactions_summary($reportinfo->fromdate, $reportinfo->todate);


        $html = $this->load->view('report/loan/print/loan_transaction_summary_print', $this->data, true);
        $this->export_to_pdf($html, 'Loan_transactions_summary', $reportinfo->page);
    }
    
    function balance_nextinstall(){
      $this->data['transaction'] = $this->report_model->balance_nextinstall();  
       $html = $this->load->view('report/loan/print/balance_nextinstall', $this->data, true);
        echo $this->header_page . $html;
		die();
		$this->export_to_pdf($html, 'Loan_transactions_summary', $reportinfo->page);   
    }
    
     function view_indetail_print($loanid) {
        $this->data['title'] = lang('loan_viewdetails');
        $this->data['loanid'] = $loanid;
        $LID = decode_id($loanid);

        $this->data['loaninfo'] = $this->loan_model->loan_info($LID)->row();
        //$this->data['content'] = 'loan/loan_view_details';
       $html = $this->load->view('loan/print/loan_view_details_print', $this->data, true);        
        $this->export_to_pdf($html, 'Loan_information_in_details', 'A4-L');
        
    }
                function export_to_pdf($html, $filename, $page_orientation = null) {
                     $filename = $filename.'.pdf';
        //$html = "Tanzania";
		
        $this->load->library('pdf1');
        //$pdf = $this->pdf1->load($page_orientation);
		
        
		echo $this->header_page . $html;
		$this->load->view('report/printer_two');
		die();
        $pdf->SetHTMLHeader($header);
        $pdf->SetFooter('TEA LOAN MANAGEMENT' . '|{PAGENO}|' . date('d-m-Y H:i:s')); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
        $pdf->WriteHTML($html); // write the HTML into the PDF
        $pdf->Output($filename, 'I'); // save to file because we can  
    }

}
