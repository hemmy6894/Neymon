<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of loan
 *
 * @author miltone
 */
class Loan extends CI_Controller {
    //put your code here
    public $loan_allowed = 0;
    //put your code here
    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->form_validation->set_error_delimiters('<div class="error_message">', '</div>');
        $this->data['current_title'] = lang('page_loan');
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
    }
    /*
     * Function to uploads files to server
     * @author Miltone Urassa
     * @Contact miltoneurassa@yahoo.com
     */
    function upload_file($array, $name, $folder) {
        $filename = time() . $array[$name]['name'];
        $path = './' . $folder . '/';
        $path1 = './' . $folder . '/';
        $path = $path . basename($filename);
        if (move_uploaded_file($_FILES[$name]['tmp_name'], $path)) {
            // chmod($path1.$filename, 777);
            return $filename;
        } else {
            return 0;
        }
    }
    /*
     *  @author Miltone Urassa
     *  @Contact : miltoneurassa@yahoo.com
     *  function Name :  getExtension
     *  Description : File extension
     *  @parm filename
     *  @return file extension in lower case
     * 
     */
    function getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return strtolower($ext);
    }

    function automatic_repayment_process() {
        $this->data['title'] = 'Automatic Loan Repayment';
        $this->form_validation->set_rules('date_month', 'Months', 'required|valid_month');
        if ($this->form_validation->run() == TRUE) {
            $month = trim($this->input->post('date_month'));
            $exp = explode('-', $month);
            $selected = $exp[1] . $exp[0];
            $current = date('Ym');
            if ($selected <= $current) {

            } else {
                $this->data['warning'] = 'Invalid month';
            }
        }
        $this->data['content'] = 'loan/loan_autmatic';
        $this->load->view('template', $this->data);
    }

    function loan_application() {
        $pin = current_user()->PIN;
        $this->data['title'] = lang('loan_create_new');
        if ($this->input->post('amount')) {
            $_POST['amount'] = str_replace(',', '', $_POST['amount']);
            $_POST['requested_amount'] = str_replace(',', '', $_POST['requested_amount']);
            $_POST['income'] = str_replace(',', '', $_POST['income']);
            $_POST['procesingfee'] = str_replace(',', '', $_POST['procesingfee']);
            $_POST['interest_rate'] = str_replace(',', '', $_POST['interest_rate']);
        }

        $this->form_validation->set_rules('applicationdate', lang('loan_applicationdate'), 'required|valid_dae');
        $this->form_validation->set_rules('product', lang('loan_product'), 'required');
        $this->form_validation->set_rules('interest_rate', 'Interest Rate', 'required|numeric');
        $this->form_validation->set_rules('penalt_percent', 'Penalt Percentage (%)', 'required|numeric');
        $this->form_validation->set_rules('amount', lang('loan_applied_amount'), 'required|numeric');
        $this->form_validation->set_rules('requested_amount', lang('requested_amount'), 'required|numeric');
        $this->form_validation->set_rules('installment', lang('loan_installment'), 'required|numeric');
        $this->form_validation->set_rules('source', lang('loan_paysource'), 'required');
        $this->form_validation->set_rules('purpose', lang('loan_purpose'), 'required');
        $this->form_validation->set_rules('pid', lang('member_pid'), 'required');
        $this->form_validation->set_rules('member_id', lang('member_member_id'), 'required');
        $this->form_validation->set_rules('income', 'Monthly Income', 'numeric');
        $this->form_validation->set_rules('procesingfee', 'Loan Processing Fee', 'required|numeric');
        $this->form_validation->set_rules('grace_period', lang('grace_period'), 'required');
        $this->form_validation->set_rules('grace_period_unit', lang('grace_period'), 'required');
        $this->form_validation->set_rules('existing_loan', 'Existing Loan', 'numeric');
        /* Checking if its old loan entry */
        if($this->input->post('existing_loan') == 1){
            $this->form_validation->set_rules('original_amount', 'Original Amount', 'required|numeric');
            $this->form_validation->set_rules('original_date', 'Original Date', 'required|valid_dae');
        }
        if ($this->form_validation->run() == TRUE) {
            $PID_initial = explode('-', trim($this->input->post('pid')));
            $member_id_initial = explode('-', trim($this->input->post('member_id')));
            $pid = $PID = $PID_initial[0];
            $member_id = $member_id_initial[0];
            $product_id = $this->input->post('product');
            $product = $this->setting_model->loanproduct($product_id)->row();
            $date = format_date(trim($this->input->post('applicationdate')));
            $amount = $this->input->post('amount');
            $requested_amount = $this->input->post('requested_amount');
            $installment = trim($this->input->post('installment'));
            $source = trim($this->input->post('source'));
            $purpose = trim($this->input->post('purpose'));
            $processingfee = $this->input->post('procesingfee');
            $interest_rate = $this->input->post('interest_rate');
            $penalt_percent = $this->input->post('penalt_percent');
            $grace_period = trim($this->input->post('grace_period'));
            $grace_period_unit = trim($this->input->post('grace_period_unit'));
            if($this->input->post('is_existing_loan') == 1){
                $is_existing_loan = 1;
                $original_amount = $this->input->post('original_amount');
                $original_date = format_date(trim($this->input->post('original_date')));
            }else{
                $is_existing_loan = 0;
                $original_amount = 0;
                $original_date = null;
            }
            $createloan = array(
                'PID' => $pid,
                'member_id' => $member_id,
                'product_type' => $product_id,
                'rate' => $interest_rate,
                'penalt_percent' => $penalt_percent,
                'interval' => $product->interval,
                'basic_amount' => $amount,
                'number_istallment' => $installment,
                'pay_source' => $source,
                'applicationdate' => $date,
                'loan_purpose' => $purpose,
                'loan_applied' => $requested_amount,
                'monthly_income' => trim($this->input->post('income')),
                'grace_period' => $grace_period,
                'grace_period_unit' => $grace_period_unit,
                'createdby' => current_user()->id,
                'PIN' => $pin,
                'is_existing_loan' => $is_existing_loan,
                'original_amount' => $original_amount,
                'original_date' => $original_date,
            );
            if ($product->maxmum_time >= $installment) {
                //start validating
                //$share_info = $this->share_model->share_member_info($pid, $member_id);
                // $saving_account = $this->finance_model->saving_account_balance_PID($pid, $member_id);
                //$contribution = $this->contribution_model->contribution_balance($pid, $member_id);
                // $installment_amount = $this->loanbase->get_installment($product->interest_rate, $amount, $installment, $product->interest_method, $product->interval);
                // if ($this->maximum_loan_allowed($product, $amount, $contribution, $pid) == TRUE  && $this->maximum_contributions_times($product, $amount, $contribution) == TRUE && $this->pass_share_condition($product, $share_info) == TRUE && $this->pass_contribution_condition($product, $contribution) == TRUE && $this->pass_saving_condition($product, $saving_account) == TRUE) {
                $installment_amount = $this->loanbase->get_installment($interest_rate, $amount, $installment, $product->interest_method, $product->interval, $product->id);
                $total_interest_amount = $this->loanbase->totalInterest($interest_rate, $amount, $installment, $installment_amount, $product->interest_method, $product->interval, $product->id);
                $createloan['installment_amount'] = $installment_amount;

                $createloan['total_interest_amount'] = $total_interest_amount;
                $createloan['total_loan'] = ($total_interest_amount + $amount);
                $insert = $this->loan_model->add_newloan($createloan, $processingfee);
                if ($insert) {
                    //notify user
                    $recipient = array();
                    /* $expl = explode(',', NEW_LOAN);
                      foreach ($expl as $key => $value) {
                      $std = new stdClass();
                      $std->mobile = $value;
                      $recipient[] = $std;
                      } */
                    $member_name = $this->member_model->member_name(null, $pid);
                    $message = 'Notification, New loan ' . $insert . ' created for ' . $member_name;
                    //if(count($recipient) > 0){
                    //send SMS=====================================================
                    //$this->smssending->send_sms(SENDER, $message, $recipient);
                    //}
                    $this->session->set_flashdata('message', lang('loan_saved_success'));
                    redirect(current_lang() . '/loan/loan_editing/' . encode_id($insert), 'refresh');
                } else {
                    $this->data['warning'] = lang('loan_add_fail');
                }
                /* } else {
                  if (!$this->pass_contribution_condition($product, $contribution)) {
                  $this->data['warning'] = lang('loan_contribution_insufficient');
                  }
                  if (!$this->pass_saving_condition($product, $saving_account)) {
                  $this->data['warning'] = lang('loan_saving_insufficient');
                  }else if (!$this->pass_share_condition($product, $share_info)) {
                  $this->data['warning'] = lang('loan_share_insufficient');
                  }else if (!$this->maximum_contributions_times($product, $amount, $contribution)) {
                  $this->data['warning'] = lang('loan_contribution_times_exceed');
                  }
                  else if (!$this->pass_monthly_income($createloan['monthly_income'], $pid, $installment_amount)) {
                  $this->data['warning'] = lang('loan_contribution_exceed_one_third');
                  }
                  else if (!$this->maximum_loan_allowed($product, $amount, $contribution, $pid)) {
                  $this->data['warning'] = lang('loan_not_allowed', number_format($this->loan_allowed, 2));
                  }
                  } */
            } else {
                $this->data['warning'] = lang('loan_maximum_duration');
            }
        }
        $this->data['paysource_list'] = $this->contribution_model->contribution_source()->result();
        $this->data['loan_product_list'] = $this->setting_model->loanproduct()->result();
        $this->data['content'] = 'loan/loan_application_step1';
        $this->load->view('template', $this->data);
    }

    function pass_monthly_income($monthy_income, $pid, $newinstall = 0) {
        // 
        $pin = current_user()->PIN;
        $monthly_contribution = 0;
        $contr_setup = $this->db->get_where('contribution_settings', array('PID' => $pid, 'PIN' => $pin))->row();
        if (count($contr_setup) > 0) {
            $monthly_contribution = $contr_setup->amount;
        } else {
            $this->db->where('PIN', $pin);
            $contr_setup = $this->db->get('contribution_global')->row();
            $monthly_contribution = $contr_setup->amount;
        }
        //check open_loan
        $open_loan = $this->db->query("SELECT * FROM loan_contract WHERE PID='$pid' AND disburse=1 AND status=4")->result();
        $repay_installment = 0;
        foreach ($open_loan as $key => $value) {
            $repay_installment += $value->installment_amount;
        }
        $total_contr_from_salary = $repay_installment + $monthly_contribution + $newinstall;
        $remain_theluth = ((1 / 3) * $monthy_income);
        //$remain = $monthy_income - $total_contr_from_salary;
        if ($total_contr_from_salary <= $remain_theluth) {
            return TRUE;
        }
        return FALSE;
    }

    function pass_share_condition($product, $share) {
        if ($product->loan_security_share_min > 0) {
            if ($share) {
                if ($share->totalshare >= $product->loan_security_share_min) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }
        return TRUE;
    }

    function pass_saving_condition($product, $saving) {
        if ($product->loan_security_saving_minimum > 0) {
            if ($saving) {
                if ($saving->balance >= $product->loan_security_saving_minimum) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }
        return TRUE;
    }

    function maximum_loan_allowed($product, $loan_amount, $contribution, $pid) {
        $total_amount = $contribution->balance * $product->loan_security_contribution_times;
        $open_loan = $this->db->query("SELECT * FROM loan_contract WHERE PID='$pid' AND approval=4")->result();
        $principles = 0;
        $amount_paid = 0;
        foreach ($open_loan as $key => $value) {
            $amount_paid += $this->db->query("SELECT SUM('amount') as amount FROM loan_repayment_receipt WHERE LID='$value->LID'")->row()->amount;
            $principles += $value->basic_amount;
        }
        $open_principle = $principles - $amount_paid;
        $allowed = $total_amount - $open_principle;
        $this->loan_allowed = $allowed;
        if ($allowed >= $loan_amount) {
            return TRUE;
        }
        return FALSE;
    }

    function maximum_contributions_times($product, $loan_amount, $contribution) {
        $total_amount = $contribution->balance * $product->loan_security_contribution_times;
        if ($total_amount == 0) {
            return TRUE;
        } else {
            if (count($contribution) > 0) {
                if ($loan_amount <= $total_amount) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }
        return TRUE;
    }

    function pass_contribution_condition($product, $contribution) {
        if ($product->loan_security_contribution_min > 0) {
            if ($contribution) {
                if ($contribution->balance >= $product->loan_security_contribution_min) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }
        return TRUE;
    }

    function loan_editing($loanid) {
        $this->data['loanid'] = $loanid;
        $LID = decode_id($loanid);
        $info = $this->loan_model->loan_info($LID)->row();
        if ($this->input->post('amount')) {
            $_POST['amount'] = str_replace(',', '', $_POST['amount']);
            $_POST['requested_amount'] = str_replace(',', '', $_POST['requested_amount']);
            $_POST['income'] = str_replace(',', '', $_POST['income']);
            $_POST['interest_rate'] = str_replace(',', '', $_POST['interest_rate']);
        }
        $this->form_validation->set_rules('applicationdate', lang('loan_applicationdate'), 'required|valid_dae');
        $this->form_validation->set_rules('product', lang('loan_product'), 'required');
        $this->form_validation->set_rules('interest_rate', 'Interest Rate', 'required|numeric');
        $this->form_validation->set_rules('penalt_percent', 'Penalt Percentage (%)', 'required|numeric');
        $this->form_validation->set_rules('amount', lang('loan_applied_amount'), 'required|numeric');
        $this->form_validation->set_rules('requested_amount', lang('requested_amount'), 'required|numeric');
        $this->form_validation->set_rules('installment', lang('loan_installment'), 'required|numeric');
        $this->form_validation->set_rules('source', lang('loan_paysource'), 'required');
        $this->form_validation->set_rules('purpose', lang('loan_purpose'), 'required');
        $this->form_validation->set_rules('income', 'Monthly Income', 'required|numeric');
        $this->form_validation->set_rules('grace_period', lang('grace_period'), 'required|numeric');
        $this->form_validation->set_rules('grace_period_unit', lang('grace_period'), 'required');
        /* Checking if its old loan entry */
        if($this->input->post('existing_loan') == 1){
            $this->form_validation->set_rules('original_amount', 'Original Amount', 'required|numeric');
            $this->form_validation->set_rules('original_date', 'Original Date', 'required|valid_dae');
        }

        if ($this->form_validation->run() == TRUE) {
            $pid = $PID = $info->PID;
            $member_id = $info->member_id;
            $product_id = $this->input->post('product');
            $product = $this->setting_model->loanproduct($product_id)->row();
            $interest_rate = trim($this->input->post('interest_rate'));
            $penalt_percent = trim($this->input->post('penalt_percent'));
            $date = format_date(trim($this->input->post('applicationdate')));
            $amount = $this->input->post('amount');
            $requested_amount = $this->input->post('requested_amount');
            $installment = trim($this->input->post('installment'));
            $source = trim($this->input->post('source'));
            $purpose = trim($this->input->post('purpose'));
            $grace_period = trim($this->input->post('grace_period'));
            $grace_period_unit = trim($this->input->post('grace_period_unit'));
            $pin = current_user()->PIN;
            if($this->input->post('is_existing_loan') == 1){
                $is_existing_loan = 1;
                $original_amount = $this->input->post('original_amount');
                $original_date = format_date(trim($this->input->post('original_date')));
            }else{
                $is_existing_loan = 0;
                $original_amount = 0;
                $original_date = null;
            }
            $createloan = array(
                'product_type' => $product_id,
                'rate' => $interest_rate,
                'penalt_percent' => $penalt_percent,
                'interval' => $product->interval,
                'basic_amount' => $amount,
                'loan_applied' => $requested_amount,
                'number_istallment' => $installment,
                'pay_source' => $source,
                'applicationdate' => $date,
                'monthly_income' => trim($this->input->post('income')),
                'grace_period' => $grace_period,
                'grace_period_unit' => $grace_period_unit,
                'loan_purpose' => $purpose,
                'PIN' => $pin,
                'is_existing_loan' => $is_existing_loan,
                'original_amount' => $original_amount,
                'original_date' => $original_date,
            );
            if ($product->maxmum_time >= $installment) {
                //start validating
                //$share_info = $this->share_model->share_member_info($pid, $member_id);
                //$saving_account = $this->finance_model->saving_account_balance_PID($pid, $member_id);
                //$contribution = $this->contribution_model->contribution_balance($pid, $member_id);
                $installment_amount = $this->loanbase->get_installment($interest_rate, $amount, $installment, $product->interest_method, $product->interval, $product->id);

                $total_interest_amount = $this->loanbase->totalInterest($interest_rate, $amount, $installment, $installment_amount, $product->interest_method, $product->interval, $product->id);
                $createloan['installment_amount'] = $installment_amount;
                $createloan['total_interest_amount	'] = $total_interest_amount;
                $createloan['total_loan	'] = ($total_interest_amount + $amount);
                $insert = $this->loan_model->edit_loan_info($createloan, $LID);
                if ($insert) {
                    $this->session->set_flashdata('message', lang('loan_saved_success'));
                    redirect(current_lang() . '/loan/loan_editing/' . encode_id($insert), 'refresh');
                } else {
                    $this->data['warning'] = lang('loan_add_fail');
                }

            } else {
                $this->data['warning'] = lang('loan_maximum_duration');
            }
        }
        $this->data['basicinfo'] = $this->member_model->member_basic_info(null, $info->PID, $info->member_id)->row();
        $this->data['loaninfo'] = $this->loan_model->loan_info($LID)->row();
        $this->data['paysource_list'] = $this->contribution_model->contribution_source()->result();
        $this->data['loan_product_list'] = $this->setting_model->loanproduct()->result();
        $this->data['content'] = 'loan/loan_editing';
        $this->load->view('template', $this->data);
    }

    function loan_security($loanid) {
        $this->data['loanid'] = $loanid;
        $LID = decode_id($loanid);
        $info = $this->loan_model->loan_info($LID)->row();
        $this->form_validation->set_rules('declaration', lang('loan_security_declaration'), 'required');
        $this->form_validation->set_rules('comment', lang('loan_supporting_document_comment'), '');
        $upload_photo = TRUE;
        $file_name = 0;
        if ($this->input->post('comment')) {
            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
                $extension = $this->getExtension($_FILES['file']['name']);
                $file_name = $this->upload_file($_FILES, 'file', 'uploads/document');
                $upload_photo = TRUE;
            } else if (isset($_FILES['file']['name']) && $_FILES['file']['name'] == '') {
                $this->data['logo_error'] = 'The ' . lang('loan_supporting_document_attach') . ' field is required';
                $upload_photo = FALSE;
            }
        }
        $pin = current_user()->PIN;
        if ($this->form_validation->run() == TRUE && $upload_photo == true) {
            $declaration = array(
                'declaration' => trim($this->input->post('declaration')),
                'LID' => $LID,
                'PIN' => $pin
            );
            $this->loan_model->loan_declaration($declaration);
            if ($this->input->post('comment')) {
                if ($file_name != 0) {
                    $doc = array(
                        'comment' => trim($this->input->post('comment')),
                        'file' => $file_name,
                        'LID' => $LID,
                        'PIN' => $pin
                    );
                    $this->loan_model->loan_supporting_doc($doc);
                }
            }
            $this->data['message'] = lang('loan_info_saved');
        }
        $this->data['basicinfo'] = $this->member_model->member_basic_info(null, $info->PID, $info->member_id)->row();
        $this->data['loaninfo'] = $this->loan_model->loan_info($LID)->row();
        $this->data['declaration'] = $this->loan_model->get_declaration($LID);
        $this->data['supporting_doc'] = $this->loan_model->get_supporting_doc($LID);
        $this->data['content'] = 'loan/loan_security';
        $this->load->view('template', $this->data);
    }

    function loan_business($loanid) {
        $this->data['loanid'] = $loanid;
        $LID = decode_id($loanid);

        $info = $this->loan_model->loan_info($LID)->row();
        $this->form_validation->set_rules('business_name', 'Business Name', 'required');
        $this->form_validation->set_rules('business_location', 'Business Location', 'required');
        $this->form_validation->set_rules('business_type', 'Business Type', 'required');
        $this->form_validation->set_rules('business_location_since', 'Location Since', 'required');
        $this->form_validation->set_rules('business_since', 'Business Since', 'required');

        if ($this->input->post('is_tz_citizen')) {
        } else {
            $_POST['is_tz_citizen'] = '';
        }

        if ($this->input->post('is_government_institution')) {
        } else {
            $_POST['is_government_institution'] = '';
        }

        if ($this->input->post('is_owner')) {
        } else {
            $_POST['is_owner'] = '';
        }

        if ($this->input->post('is_operate')) {
        } else {
            $_POST['is_operate'] = '';
        }

        if ($this->input->post('exercising_activity')) {
        } else {
            $_POST['exercising_activity'] = '';
        }

        if ($this->input->post('activity_past6month')) {
        } else {
            $_POST['activity_past6month'] = '';
        }

        if ($this->input->post('relative_employee')) {
            if ($this->input->post('relative_employee') == 1) {
                $this->form_validation->set_rules('employee_name', 'Employee Name', 'required');
            }
        } else {
            $_POST['relative_employee'] = '';
        }


        $current_user = current_user();
        if ($this->form_validation->run() == TRUE) {
            $businessdata = array(
                'business_name' => trim($this->input->post('business_name')),
                'business_location' => trim($this->input->post('business_location')),
                'business_type' => trim($this->input->post('business_type')),
                'location_since' => trim($this->input->post('business_location_since')),
                'business_since' => trim($this->input->post('business_since')),
                'is_tz_citizen' => trim($this->input->post('is_tz_citizen')),
                'is_owner' => trim($this->input->post('is_owner')),
                'is_operate' => trim($this->input->post('is_operate')),
                'exercising_activity' => trim($this->input->post('exercising_activity')),
                'activity_past6month' => trim($this->input->post('activity_past6month')),
                'relative_employee' => trim($this->input->post('relative_employee')),
                'employee_name' => trim($this->input->post('employee_name')),
                'is_government_institution' => trim($this->input->post('is_government_institution')),
                'LID' => $LID,
                'PIN' => $current_user->PIN,
                'createdby' => $current_user->id,
            );
            $update = $this->loan_model->update_loan_businessinfo($businessdata);
            if ($update) {
                $this->data['message'] = lang('loan_info_saved');
            } else {
                $this->data['warning'] = lang('contribution_minimum_fail');
            }
        }
        $this->data['basicinfo'] = $this->member_model->member_basic_info(null, $info->PID, $info->member_id)->row();
        $this->data['loaninfo'] = $info;
        $check = $this->loan_model->get_loanbusinessinfo($LID);
        if ($check) {
            $this->data['businessinfo'] = $check;
        }
        $this->data['content'] = 'loan/loan_business';
        $this->load->view('template', $this->data);
    }

    function deletedoc($loanid, $id) {
        $this->db->delete('loan_contract_supportdoc', array('id' => $id));
        redirect(current_lang() . '/loan/loan_security/' . $loanid, 'refresh');
    }

    function remove_guarantor($loanid, $id) {
        $this->db->delete('loan_contract_guarantor', array('id' => $id));
        redirect(current_lang() . '/loan/loan_guarantor/' . $loanid, 'refresh');
    }

    function loan_guarantor($loanid, $edit = null) {
        $this->data['loanid'] = $loanid;
        $LID = decode_id($loanid);
        $info = $this->loan_model->loan_info($LID)->row();
        $this->form_validation->set_rules('customerid', lang('loan_quarantor_name'), 'required');
        $this->form_validation->set_rules('relationship', lang('loan_quarantor_relationship'), 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|valid_phone2');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('asset', lang('loan_quarantor_asset'), 'required');
        $upload_photo = TRUE;
        $file_name = 0;
        $upload_photo2 = TRUE;
        $file_name2 = 0;
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            $extension = $this->getExtension($_FILES['file']['name']);
            $file_name = $this->upload_file($_FILES, 'file', 'uploads/document');
            $upload_photo = TRUE;
        }
        if (isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != '') {

            $extension = $this->getExtension($_FILES['photo']['name']);
            if($extension != 'jpg' && $extension != 'png' && $extension !='jpeg' && $extension !='gif'){
                $this->data['logo_error1'] = 'Only jpg,jpeg,png and gif images are allowed';

            }else{

                $file_name2 = $this->upload_file($_FILES, 'photo', 'uploads/guarantor');

                $upload_photo2 = TRUE;
            }
        }
        $pin = current_user()->PIN;
        if ($this->form_validation->run() == TRUE && $upload_photo == true && $upload_photo2 == TRUE) {
            $guarantor = array(
                'LID' => $LID,
                'name' => trim($this->input->post('customerid')),
                'mobile' => trim($this->input->post('mobile')),
                'email' => trim($this->input->post('email')),
                'relationship' => trim($this->input->post('relationship')),
                'declaration' => trim($this->input->post('asset')),
                'PIN' => $pin
            );
            if ($file_name != 0) {
                $guarantor['file'] = $file_name;
            }
            if ($file_name2 != 0) {
                $guarantor['photo'] = $file_name2;
            }
            /* if ($this->ion_auth->in_group('Members')) {
              $guarantor['request'] = 1;
              //================================SMS NOTIFICATION=====================================
              //notify guarantor requested
              $contact = $this->member_model->member_contact($guarantor['PID']);
              if ($contact->phone1 <> '') {
              $loaninfo = $this->loan_model->loan_info($guarantor['LID'])->row();
              $memberinfo = $this->member_model->member_basic_info(null, $loaninfo->PID)->row();
              $message = str_replace('LOAN_NUMBER', $guarantor['LID'], REQUEST_GUARANTOR);
              $message1 = str_replace('MEMBER_NAME', $memberinfo->firstname . ' ' . $memberinfo->lastname, $message);
              // $this->smssending->send_sms_single(SENDER, $message1, $contact->phone1);
              }
              //=====================================================================================
              } */
            $this->loan_model->add_guarantor($guarantor, $edit);
            $this->session->set_flashdata('message', lang('loan_info_saved'));
            redirect(current_lang() . '/loan/loan_guarantor/' . $loanid . '/' . $edit, 'refresh');
        }
        $this->data['basicinfo'] = $this->member_model->member_basic_info(null, $info->PID, $info->member_id)->row();
        $this->data['loaninfo'] = $this->loan_model->loan_info($LID)->row();
        $this->data['guarantor_list'] = $this->loan_model->get_guarantor(null, $LID)->result();
        $this->data['member_list'] = $this->member_model->member_basic_info()->result();
        $this->data['content'] = 'loan/loan_guarantor';
        $this->load->view('template', $this->data);
    }

    function loan_evaluation() {
        $this->data['title'] = lang('loan_evaluation_list');
        $this->data['loan_wait'] = $this->loan_model->loan_wait_evaluation();
        $this->data['content'] = 'loan/loan_evaluationlist';
        $this->load->view('template', $this->data);
    }

    function loan_guarantor_request() {
        $this->data['title'] = 'Loan Guarantor Request';
        $member = $this->member_model->member_basic_info(null, null, current_user()->member_id)->row();
        $this->data['request'] = $this->db->query("SELECT * FROM loan_contract_guarantor WHERE PID='$member->PID' AND request_status=0")->result();
        $this->data['content'] = 'loan/loan_guarantor_request';
        $this->load->view('template', $this->data);
    }

    function loan_guarantor_respond($id) {
        if (isset($_GET['s'])) {
            if ($_GET['s'] == 'reject') {
                $id = decode_id($id);
                $this->db->update('loan_contract_guarantor', array('request_status' => 2), array('id' => $id));
                $g = $this->db->get_where('loan_contract_guarantor', array('id' => $id))->row();
                $memberinfo = $this->member_model->member_basic_info(null, $g->PID)->row();
                //==================================REJECT NOTFICATION=================================================
                $loaninfo = $this->loan_model->loan_info($g->LID)->row();
                $contact = $this->member_model->member_contact($loaninfo->PID);
                if ($contact->phone1 <> '') {
                    $message = str_replace('LOAN_NUMBER', $g->LID, REQUEST_GUARANTOR_RESPOND);
                    $message1 = str_replace('MEMBER_NAME', $memberinfo->firstname . ' ' . $memberinfo->lastname, $message);
                    $message2 = str_replace('ACTION', 'reject', $message1);
                    // $this->smssending->send_sms_single(SENDER, $message2, $contact->phone1);
                }
                //========================================================================================
                redirect(current_lang() . '/loan/loan_guarantor_request', 'refresh');
            } else if ($_GET['s'] == 'accept') {
                $this->data['id'] = $id;
                $this->data['title'] = 'Loan guarantor responding';
                $id = decode_id($id);
                $this->form_validation->set_rules('relationship', lang('loan_quarantor_relationship'), 'required');
                $this->form_validation->set_rules('asset', lang('loan_quarantor_asset'), 'required');
                $upload_photo = TRUE;
                $file_name = 0;
                if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
                    $extension = $this->getExtension($_FILES['file']['name']);
                    $file_name = $this->upload_file($_FILES, 'file', 'uploads/document');
                    $upload_photo = TRUE;
                }
                $pin = current_user()->PIN;
                if ($this->form_validation->run() == TRUE && $upload_photo == true) {
                    $guarantor = array(
                        'relationship' => trim($this->input->post('relationship')),
                        'declaration' => trim($this->input->post('asset')),
                        'PIN' => $pin
                    );
                    if ($file_name != 0) {
                        $guarantor['file'] = $file_name;
                    }
                    $guarantor['request_status'] = 1;
                    $g = $this->db->get_where('loan_contract_guarantor', array('id' => $id))->row();
                    $memberinfo = $this->member_model->member_basic_info(null, $g->PID)->row();
                    //==================================REJECT NOTFICATION=================================================
                    $loaninfo = $this->loan_model->loan_info($g->LID)->row();
                    $contact = $this->member_model->member_contact($loaninfo->PID);
                    if ($contact->phone1 <> '') {
                        $message = str_replace('LOAN_NUMBER', $g->LID, REQUEST_GUARANTOR_RESPOND);
                        $message1 = str_replace('MEMBER_NAME', $memberinfo->firstname . ' ' . $memberinfo->lastname, $message);
                        $message2 = str_replace('ACTION', 'accept', $message1);
                        //$this->smssending->send_sms_single(SENDER, $message2, $contact->phone1);
                    }
                    $this->loan_model->add_guarantor($guarantor, $id);
                    $this->session->set_flashdata('message', lang('loan_info_saved'));
                    redirect(current_lang() . '/loan/loan_guarantor_request/', 'refresh');
                }
                $g = $this->db->get_where('loan_contract_guarantor', array('id' => $id))->row();
                $loaninfo = $this->loan_model->loan_info($g->LID)->row();
                $this->data['loaninfo'] = $loaninfo;
                $this->data['basicinfo'] = $this->member_model->member_basic_info(null, $loaninfo->PID)->row();
                $this->data['content'] = 'loan/guarantor_respond_accept';
                $this->load->view('template', $this->data);
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    function member_loan_list() {
        $pin = current_user()->PIN;
        $this->data['title'] = 'Loan List';
        $member_id = current_user()->member_id;
        $sql = "SELECT loan_contract.*,loan_status.name FROM loan_contract INNER JOIN members ON members.PID=loan_contract.PID ";
        $sql .= " INNER JOIN loan_status ON loan_status.code=loan_contract.status WHERE loan_contract.member_id='$member_id' AND loan_contract.PIN='$pin'";
        $sql.= " ORDER BY loan_contract.applicationdate ASC";
        $this->data['loan_list'] = $this->db->query($sql)->result();
        $this->data['content'] = 'loan/member_loan_list';
        $this->load->view('template', $this->data);
    }

    function loan_evaluation_action($loanid) {
        $pin = current_user()->PIN;
        $this->data['title'] = lang('loan_evaluation_inaction');
        $this->data['loanid'] = $loanid;
        $LID = decode_id($loanid);
        $this->form_validation->set_rules('status', lang('loan_status'), 'required');
        $this->form_validation->set_rules('comment', lang('loan_comment'), 'required');
        if ($this->form_validation->run() == TRUE) {
            $array_data = array(
                'LID' => $LID,
                'status' => $this->input->post('status'),
                'comment' => $this->input->post('comment'),
                'createdby' => current_user()->id,
                'PIN' => $pin,
            );
            $create = $this->db->insert('loan_contract_evaluation', $array_data);
            if ($create) {
                //load data
                $evst = $this->input->post('status');
                $up = array('evaluated' => $evst, 'status' => $evst);
                if ($evst == 1) {
                    $up['edit'] = 1;
                }
                //notify user
                $recipient = array();
                if ($evst == 1) {
                    $expl = explode(',', APROVE_LOAN);
                    foreach ($expl as $key => $value) {
                        $std = new stdClass();
                        $std->mobile = $value;
                        $recipient[] = $std;
                    }
                }
                $loaninfo = $this->loan_model->loan_info($LID)->row();
                $member_contact = $this->member_model->member_contact($loaninfo->PID);
                if ($member_contact->phone1 <> '') {
                    $std = new stdClass();
                    $std->mobile = $member_contact->phone1;
                    $recipient[] = $std;
                }
                $member_name = $this->member_model->member_name(null, $loaninfo->PID);
                $message = 'Notification, Loan ' . $loaninfo->PID . '=>' . $member_name . ' Evaluated, STATUS:' . str_replace('&', ' and', $this->db->get_where('loan_status', array('code' => $evst))->row()->name);
                if (count($recipient) > 0) {
                    //$this->smssending->send_sms(SENDER, $message, $recipient);
                }
                $this->db->update('loan_contract', $up, array('LID' => $LID));
                $this->session->set_flashdata('message', lang('loan_info_saved'));
                redirect(current_lang() . '/loan/loan_evaluation_action/' . $loanid, 'refresh');
            }
        }
        if (validation_errors()) {
            $this->data['warning'] = lang('loan_evaluation_error');
        }
        $this->data['loaninfo'] = $this->loan_model->loan_info($LID)->row();
        $this->data['content'] = 'loan/evaluation_acction';
        $this->load->view('template', $this->data);
    }

    function loan_approval() {
        $this->data['title'] = lang('loan_evaluation_list');
        $this->data['loan_wait'] = $this->loan_model->loan_wait_approval();
        $this->data['content'] = 'loan/loan_wait_toapprove';
        $this->load->view('template', $this->data);
    }

    function loan_approval_action($loanid) {
        $pin = current_user()->PIN;
        $this->data['title'] = lang('loan_approval_inaction');
        $this->data['loanid'] = $loanid;
        $LID = decode_id($loanid);
        $this->form_validation->set_rules('status', lang('loan_status'), 'required');
        $this->form_validation->set_rules('comment', lang('loan_comment'), 'required');
        if ($this->form_validation->run() == TRUE) {
            $array_data = array(
                'LID' => $LID,
                'status' => $this->input->post('status'),
                'comment' => $this->input->post('comment'),
                'createdby' => current_user()->id,
                'PIN' => $pin,
            );
            $create = $this->db->insert('loan_contract_approve', $array_data);
            if ($create) {


                //load data
                $evst = $this->input->post('status');
                $up = array('approval' => $evst, 'status' => $evst);
                $recipient = array();
                if ($evst == 4) {
                    $expl = explode(',', DISBURSE_LOAN);
                    foreach ($expl as $key => $value) {
                        $std = new stdClass();
                        $std->mobile = $value;
                        $recipient[] = $std;
                    }
                }
                $loaninfo = $this->loan_model->loan_info($LID)->row();
                $member_contact = $this->member_model->member_contact($loaninfo->PID);
                if ($member_contact->phone1 <> '') {
                    $std = new stdClass();
                    $std->mobile = $member_contact->phone1;
                    $recipient[] = $std;
                }
                $member_name = $this->member_model->member_name(null, $loaninfo->PID);
                $message = 'Notification, Loan ' . $loaninfo->PID . '=>' . $member_name . ' Approved, STATUS:' . str_replace('&', 'and', $this->db->get_where('loan_status', array('code' => $evst))->row()->name);
                if (count($recipient) > 0) {
                    // $this->smssending->send_sms(SENDER, $message, $recipient);
                }
                $this->db->update('loan_contract', $up, array('LID' => $LID));
                $this->session->set_flashdata('message', lang('loan_info_saved'));
                redirect(current_lang() . '/loan/loan_approval_action/' . $loanid, 'refresh');
            }
        }
        if (validation_errors()) {
            $this->data['warning'] = lang('loan_evaluation_error');
        }
        $this->data['loaninfo'] = $this->loan_model->loan_info($LID)->row();
        $this->data['content'] = 'loan/loan_approval_action';
        $this->load->view('template', $this->data);
    }

    function loan_disbursement() {
        $this->data['title'] = lang('loan_disburseme_list');
        $this->data['loan_wait'] = $this->loan_model->loan_wait_disburse();
        $this->data['content'] = 'loan/loan_wait_disburse';
        $this->load->view('template', $this->data);
    }

    function loan_disburse_action($loanid) {
        $pin = current_user()->PIN;
        $this->data['title'] = lang('loan_disburse_inaction');
        $this->data['loanid'] = $loanid;
        $LID = decode_id($loanid);

        if ($this->input->post('amount')) {
            $_POST['amount'] = str_replace(',', '', $_POST['amount']);
        }

        //$this->form_validation->set_rules('disbursedate', lang('loan_startrepay_date'), 'required|valid_date');
        $this->form_validation->set_rules('disbursedate2', lang('loan_startdisburse_date'), 'required|valid_date');
        $this->form_validation->set_rules('amount', lang('loan_amount_todisburse'), 'required|numeric');
        $this->form_validation->set_rules('comment', lang('loan_comment'), 'required');
        $this->form_validation->set_rules('loan_disburse_account', 'Disburse from A/C', 'required');
        $this->form_validation->set_rules('loan_disburse_accountto', 'Disburse To A/C', 'required');
        //$this->form_validation->set_rules('grace_period', lang('grace_period'), 'required');
        //$this->form_validation->set_rules('grace_period_unit', lang('grace_period'), 'required');

        $check_number_received = '';
        if ($this->input->post('paymenthod')) {
            $is_cheque = $this->input->post('paymenthod');
            if ($is_cheque == 'CHEQUE') {
                $this->form_validation->set_rules('cheque', lang('cheque_no'), 'required');
                $check_number_received = trim($this->input->post('cheque'));
            }
        }

        if ($this->form_validation->run() == TRUE) {
            $paymethod = trim($this->input->post('paymenthod'));
            $first_intall_date = format_date(trim($this->input->post('disbursedate')));
            //$grace_period = trim($this->input->post('grace_period')); 
            //$grace_period_unit = trim($this->input->post('grace_period_unit')); 
            $custom_disburse_date = format_date(trim($this->input->post('disbursedate2')));
            //$first_intall_date = date('Y-m-d', strtotime('+' . ($grace_period) .' '. $grace_period_unit, strtotime($custom_disburse_date)));
            //$datetoshow = date('d M Y',  strtotime($kesho));

            //update grace period if changed
            $createloangrace = array(
                'grace_period' => $grace_period,
                'grace_period_unit' => $grace_period_unit,
            );
            $insert3 = $this->loan_model->edit_loan_info($createloangrace, $LID);

            if($custom_disburse_date <= $first_intall_date){
                $disbursed_amount = trim($this->input->post('amount'));
                $infodata = $this->loan_model->loan_info($LID)->row();
                $disbursedata = $this->loan_model->already_disbursed_amount($LID);
                $memberdata = $this->member_model->member_basic_info(null, $infodata->PID, null)->row();

                if ($disbursed_amount <= ($infodata->basic_amount - $disbursedata->sumdisburseamount)){

                    $array_data = array(
                        'LID' => $LID,
                        'disbursedate' => $custom_disburse_date,
                        'comment' => $this->input->post('comment'),
                        'paymethod' => $paymethod,
                        'cheque_no' => $check_number_received,
                        'createdby' => current_user()->id,
                        'PIN' => $pin,
                    );

                    if($memberdata->category == 'Company'){
                        $array_data['disburseamount'] = $disbursed_amount;
                        $amount_to_disburse = $disbursed_amount ;
                    } else if($memberdata->category == 'Individual'){
                        $array_data['disburseamount'] = $infodata->basic_amount;
                        $amount_to_disburse = $infodata->basic_amount;
                    }

                    $this->db->trans_start();
                    $create = $this->db->insert('loan_contract_disburse', $array_data);
                    if ($create) {
                        //load data
                        if($memberdata->category == 'Company'){
                            if($disbursed_amount == ($infodata->basic_amount - $disbursedata->sumdisburseamount)){
                                $up = array('disburse' => 1, 'multiple_disburse_status'=> 2, 'loan_principle_account' => $this->input->post('loan_disburse_accountto'));
                            } else if($disbursed_amount < ($infodata->basic_amount - $disbursedata->sumdisburseamount)) {
                                $up = array('disburse' => 1, 'multiple_disburse_status'=> 1, 'loan_principle_account' => $this->input->post('loan_disburse_accountto'));

                            }
                        }

                        if($memberdata->category == 'Individual'){
                            $up = array('disburse' => 1, 'multiple_disburse_status'=> 2, 'loan_principle_account' => $this->input->post('loan_disburse_accountto'));
                        }
                        $this->db->update('loan_contract', $up, array('LID' => $LID));

                        // insert repay schedule
                        //loan disbursed now credit Bank account and debit Loan account
                        $product = $this->setting_model->loanproduct($infodata->product_type)->row();
                        //bank account
                        $credit_account = $this->input->post('loan_disburse_account');
                        //ledger entry ID
                        $ledger_entry = array('date' => $array_data['disbursedate'], 'PIN' => $pin);
                        $this->db->insert('general_ledger_entry', $ledger_entry);
                        $ledger_entry_id = $this->db->insert_id();
                        //ledger data
                        $ledger = array(
                            'journalID' => 4,
                            'entryid' => $ledger_entry_id,
                            'LID' => $LID,
                            'date' => $array_data['disbursedate'],
                            'description' => 'Loan Disbursed',
                            'linkto' => 'loan_contract.LID',
                            'fromtable' => 'loan_contract',
                            'paid' => 0,
                            'year'=>  active_year(),
                            'PID' => $infodata->PID,
                            'member_id' => $infodata->member_id,
                            'PIN' => $pin,
                        );
                        $ledger['account'] = $credit_account;
                        $ledger['credit'] = $amount_to_disburse;
                        $accountinfo = account_row_info($ledger['account']);
                        $ledger['account_type'] = $accountinfo->account_type;
                        $ledger['sub_account_type'] = $accountinfo->sub_account_type;
                        $this->db->insert('general_ledger', $ledger);
                        $ledger['credit'] = 0;
                        $ledger['debit'] = 0;
                        //debit account
                        $debit_account = $this->input->post('loan_disburse_accountto');
                        $ledger['debit'] = $amount_to_disburse;
                        $ledger['account'] = $debit_account;
                        //$ledger['account_type'] = account_row_info($ledger['account'])->account_type;
                        $accountinfo = account_row_info($ledger['account']);
                        $ledger['account_type'] = $accountinfo->account_type;
                        $ledger['sub_account_type'] = $accountinfo->sub_account_type;
                        $this->db->insert('general_ledger', $ledger);

                        //creating repayment schedule when disbursement  is for the firsttime
                        if($infodata->disburse == 0){

                            $schedule = $this->loanbase->create_repayment_schedule($infodata->installment_amount, $infodata->rate, $infodata->number_istallment, $first_intall_date, $infodata->basic_amount, $LID, $product->interest_method, $product->interval, $infodata->total_loan);



                            //custom staff loan
                            if($product->id == 4){
                                if($infodata->number_istallment > 12){


                                    $Sum_repayamount = $infodata->installment_amount;
                                    $Sum_interest = $infodata->total_interest_amount;
                                    $Sum_principle = $infodata->basic_amount;
                                    $Sum_balance = $infodata->total_loan;
                                    $interest_repay = round($infodata->total_interest_amount/$infodata->number_istallment, 2);

                                    foreach ($schedule as $key => $values1) {


                                        $date = $values1['repaydate'];
                                        $month = $values1['month'];
                                        $LID = $values1['LID'];
                                        $PIN = $values1['PIN'];
                                        $installment_number = $values1['installment_number'];
                                        $Sum_repayamount = $Sum_repayamount;
                                        $Sum_interest = $interest_repay;
                                        $Sum_principle = $Sum_repayamount - $interest_repay;
                                        $Sum_balance = $Sum_balance - $Sum_repayamount;




                                        $array1 = array();

                                        $array1['repaydate'] = $date;
                                        $array1['month'] = $month;
                                        $array1['LID'] = $LID;
                                        $array1['PIN'] = $PIN;
                                        $array1['installment_number'] = $installment_number;
                                        $array1['repayamount'] = $Sum_repayamount;
                                        $array1['interest'] = $Sum_interest;
                                        $array1['principle'] = $Sum_principle;
                                        $array1['balance'] = $Sum_balance;



                                        $Sum_repayamount = $Sum_repayamount;
                                        $Sum_interest = $Sum_interest;
                                        $Sum_principle = $Sum_principle;
                                        $Sum_balance = $Sum_balance;

                                        $schedule1[] = $array1;



                                    }

                                    $schedule = array();
                                    $schedule =  $schedule1;
                                }
                            }


                            $this->db->insert_batch('loan_contract_repayment_schedule', $schedule);

                            $valuevv = $this->db->query("SELECT * FROM loan_contract_repayment_schedule WHERE LID ='$LID' ORDER BY installment_number	ASC LIMIT 1")->row();
                            $rundate = date('Y-m-d', strtotime('+' . ($product->warning_day + 1) . ' days', strtotime($valuevv->repaydate)));
                            $upx = array(
                                'LID' => $LID,
                                'last_provision' => 0,
                                'last_date' => $rundate,
                            );
                            $this->db->insert('provision_rate_run', $upx);
                        } //end repay schedule
                        $this->db->trans_complete();
                        $this->session->set_flashdata('message', lang('loan_info_saved'));
                        redirect(current_lang() . '/loan/view_repayment_schedule/' . $loanid, 'refresh');
                    }
                    $this->db->trans_complete();

                } else {
                    $this->data['warning'] = lang('loan_disburse_fail');
                }

            } else {
                $this->data['warning'] = lang('loan_dates_fail');
            }

        }

        if (validation_errors()) {
            $this->data['warning'] = lang('loan_evaluation_error');
        }

        $this->data['account_list2'] = $this->finance_model->account_chart_hiarchy(array(10 => array(1, 2)));
        $this->data['account_list3'] = $this->finance_model->account_chart_hiarchy(array(10 => array(3)));
//        echo '<pre>';
//        print_r($this->data['account_list2']);
//        echo '</pre>';exit;
        $this->data['loaninfo'] = $this->loan_model->loan_info($LID)->row();
        $this->data['disburseinfo'] = $this->loan_model->already_disbursed_amount($LID);
        $this->data['content'] = 'loan/loan_disburse_action';
        $this->load->view('template', $this->data);
    }

    function loan_viewlist() {
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
        $config["base_url"] = site_url(current_lang() . '/loan/loan_viewlist/');
        $config["total_rows"] = $this->loan_model->count_loan($key);
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
       
        $this->data['links'] = $this->pagination->create_links();
        $this->data['loan_list'] = $this->loan_model->search_loan($key, $config["per_page"], $page);
        $this->data['content'] = 'loan/viewloanlist';
        $this->load->view('template', $this->data);
    }

    function view_indetail($loanid) {
        $this->data['title'] = lang('loan_viewdetails');
        $this->data['loanid'] = $loanid;
        $LID = decode_id($loanid);
        $this->data['loaninfo'] = $this->loan_model->loan_info($LID)->row();
        $this->data['content'] = 'loan/loan_view_details';
        $this->load->view('template', $this->data);
    }

    function loan_repayment() {
        $pin = current_user()->PIN;
        $this->data['title'] = lang('loan_repayment');
        $this->data['loanlist'] = $this->loan_model->loan_repay_list();
        $this->data['paymenthod'] = $this->finance_model->paymentmenthod();

        if ($this->input->post('amount')) {
            $_POST['amount'] = str_replace(',', '', $_POST['amount']);
        }
        $this->form_validation->set_rules('amount', lang('loan_repay_amount'), 'required|numeric');
        $this->form_validation->set_rules('loanid', lang('loan_LID'), 'required');
        $this->form_validation->set_rules('repaydate', lang('loan_repay_date'), 'required|valid_date');
        $this->form_validation->set_rules('received_account','Received In Account', 'required');
        $this->form_validation->set_rules('paymenthod', lang('paymentmethod'), 'required');
        $check_number_received = '';
        if ($this->input->post('paymenthod')) {
            $is_cheque = $this->input->post('paymenthod');
            if ($is_cheque == 'CHEQUE') {
                $this->form_validation->set_rules('cheque', lang('cheque_no'), 'required');
                $check_number_received = trim($this->input->post('cheque'));
            }
        }

        if ($this->form_validation->run() == TRUE) {
            $paymethod = trim($this->input->post('paymenthod'));
            $amount = trim($this->input->post('amount'));
            $repaid_amount = $amount;
            $LID = trim($this->input->post('loanid'));
            $paydate = format_date(trim($this->input->post('repaydate')));
            $loaninfo = $this->loan_model->loan_info($LID)->row();
            $product = $this->setting_model->loanproduct($loaninfo->product_type)->row();
            $open_repayment = $this->loan_model->open_repayment_installment($LID);
            $previous_remain_balance = $this->loan_model->get_previous_remain_balance($LID);
            $previous_remain_balance_id = $this->loan_model->get_previous_remain_balance_id($LID);


            //current money in hand
            //$amount_tmp = ($amount + $previous_remain_balance);
            $amount_tmp = $amount;


            $received_account = $this->input->post('received_account');
            $error_array = array();
            $success_array = array();
            if ($amount > 0) {
                if ($loaninfo->status == 4) {
                    $this->db->trans_start();
                    if (count($open_repayment) > 0) {
                        $receipt = $this->loan_model->loan_repay_receipt($LID, $amount, $paydate, $paymethod, $check_number_received);

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
                                            'createdby' => current_user()->id,
                                            'PIN' => $pin,
                                        );

                                        $this->loan_model->record_loan_repayment($array_data, $value->id,$received_account);
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
                                                'createdby' => current_user()->id,
                                                'PIN' => $pin,
                                            );

//print_r($array_data);
//echo '</pre>';                         
//exit;                               

                                            $this->loan_model->record_loan_repayment($array_data, $value->id,$received_account);
                                        } else {


                                            $insufficient_amount = $amount_tmp + $amount_already_paid; //including the previous insufficient amount


                                            //When accrual is run but the amount is insufficient and there is penalty
                                            $penalty_before=$penalt_avail * $number_months;

                                            $deductforbalance = ($repay_amount_install_original + ($penalt_avail * $number_months)) - ($amount_already_paid + $amount_tmp);


                                            $balance_after = $value->balance + $deductforbalance;

                                            $installment_after = $amount_tmp;
                                            $interest_priority = 0;
                                            $principle_not_priority = 0;
                                            $penalty_not_priority = 0;

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
                                            }

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

                                            }

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

                                            if ($amount_tmp > 0) {
                                                // insert as balance for next installment
                                                $previous_remain_balance = $this->loan_model->get_previous_remain_balance($LID);
                                                $this->loan_model->add_remain_balance($LID, round($amount_tmp + $previous_remain_balance, 2));
                                                $previous_remain_balance_id = $this->loan_model->get_previous_remain_balance_id($LID);
                                            }
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
                                        }


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
                                            'createdby' => current_user()->id,
                                            'PIN' => $pin,
                                        );



                                        $this->loan_model->record_loan_repayment_insufficient($array_data, $value->id,$received_account, $insufficient_amount);

                                        if ($amount_tmp > 0) {
                                            // insert as balance for next installment
                                            $previous_remain_balance = $this->loan_model->get_previous_remain_balance($LID);
                                            $this->loan_model->add_remain_balance($LID, round($amount_tmp + $previous_remain_balance, 2));
                                            $previous_remain_balance_id = $this->loan_model->get_previous_remain_balance_id($LID);
                                        }
                                        break;

                                    } else {
                                        break;
                                    }
                                }
                            } else {
                                //Unearned has not run
                                //when accrual is not run

                                // insert to balance
                                $previous_remain_balance = $this->loan_model->get_previous_remain_balance($LID);
                                $this->loan_model->add_remain_balance($LID, round($amount_tmp + $previous_remain_balance, 2));
                                $previous_remain_balance_id = $this->loan_model->get_previous_remain_balance_id($LID);

                                //Debit Bank/Cash
                                //Credit Loan Prepayment Account
                                $prepaid = $this->loan_model->loan_prepayment_account_before_accrualrun($paydate, $LID, $received_account, round($amount_tmp, 2), $previous_remain_balance_id);
                                break;

                            }
                        }
                        $this->db->trans_complete();
                        $this->session->set_flashdata('next_customer', site_url(current_lang() . '/loan/loan_repayment'));
                        $this->session->set_flashdata('next_customer_label', 'Process New Loan Repayment');
                        redirect(current_lang() . '/loan/view_loanreceipt/' . $receipt, 'refresh');
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

//$this->data['account_list2'] = $this->finance_model->account_chart_hiarchy(array(10 => array(1, 2)));
        $this->data['account_list2'] = $this->finance_model->account_chart_hiarchy();

        $this->data['content'] = 'loan/loan_repayment';
        $this->load->view('template', $this->data);
    }

    function view_repayment_schedule($loanid) {
        $this->data['title'] = lang('loan_view_repayment_schedule');
        $this->data['loanid'] = $loanid;
        $LID = decode_id($loanid);
        $this->db->order_by('installment_number', 'ASC');
        $this->data['schedule'] = $this->db->get_where('loan_contract_repayment_schedule', array('LID' => $LID))->result();
        $this->data['loaninfo'] = $this->loan_model->loan_info($LID)->row();
        $this->data['disburseinfo'] = $this->loan_model->already_disbursed_amount($LID);
        $this->data['content'] = 'loan/loan_repayment_schedule';
        $this->load->view('template', $this->data);
    }

    function print_repayment_schedule($loanid) {
        $this->data['loanid'] = $loanid;
        $LID = decode_id($loanid);
        $this->db->order_by('installment_number', 'ASC');
        $schedule = $this->db->get_where('loan_contract_repayment_schedule', array('LID' => $LID))->result();
        $loaninfo = $this->loan_model->loan_info($LID)->row();
        $disburseinfo = $this->loan_model->already_disbursed_amount($LID);
        include 'pdf/repayment_schedule.php';
    }

    function view_loanreceipt($receipt) {
        $this->lang->load('setting');
        $trans = $this->loan_model->get_transaction($receipt);
        if ($trans) {
            $this->data['title'] = lang('view_receipt');
            $this->data['trans'] = $trans;
            $this->data['content'] = 'loan/loan_receipt';
            $this->load->view('template', $this->data);
        } else {
            return show_error('Transaction id not exist..', 500, 'INVALID RECEIPT NUMBER');
        }
    }

    function search_interest_rate($id=null){
        $id = $_REQUEST['id'];

        if(!is_null($id)){
            $this->db->where('id', $id);
        }
        $this->db->select('')->from('loan_product')->limit(1);
        $queryservice = $this->db->get('');

        if($queryservice->num_rows()> 0){?>

            <?php
            foreach($queryservice->result() as $service):
                ?>
                <div class="form-group" >
                    <label class="col-lg-4 control-label"><?php echo 'Interest Rate'; ?>  : <span class="required">*</span></label>
                    <div class="col-lg-7" >
                        <input type="text"  name="interest_rate" value="<?php echo set_value('interest_rate', $service->interest_rate); ?>"  class="form-control  amountformat"/>
                        <?php echo form_error('interest_rate'); ?>
                    </div>
                </div>

            <?php endforeach; }  ?>


    <?php  }

    function search_penalt_percent($id=null){
        $id = $_REQUEST['id'];

        if(!is_null($id)){
            $this->db->where('id', $id);
        }
        $this->db->select('')->from('loan_product')->limit(1);
        $queryservice = $this->db->get('');

        if($queryservice->num_rows()> 0){?>

            <?php
            foreach($queryservice->result() as $service):
                ?>
                <div class="form-group" >
                    <label class="col-lg-4 control-label"><?php echo 'Penalty Percentage (%)'; ?>  : <span class="required">*</span></label>
                    <div class="col-lg-7" >
                        <input type="text"  name="penalt_percent" value="<?php echo set_value('penalt_percent', $service->penalt_percentage); ?>"  class="form-control  amountformat"/>
                        <?php echo form_error('penalt_percent'); ?>
                    </div>
                </div>

            <?php endforeach; }  ?>


    <?php  }

    function print_receipt($receipt) {
        $this->lang->load('setting');
        $trans = $this->loan_model->get_transaction($receipt);
        if ($trans) {
            $this->data['trans'] = $this->loan_model->get_transaction($receipt);
            $html = $this->load->view('loan/print/loan_receipt', $this->data, true);
            $this->export_receipt($html, 'Loan_receipt', A4);
            //include 'include/loan_receipt.php';
            exit;
        } else {
            return show_error('Transaction id not exist..', 500, 'INVALID RECEIPT NUMBER');
        }
    }

    function push_to_evaluation($loanid) {
        //deleting loan and keep deleted records
        $this->data['loanid'] = $loanid;
        $LID = decode_id($loanid);
        $info = $this->loan_model->loan_info($LID)->row();
        $pin = current_user()->PIN;
        $this->db->update('loan_contract', array('push_to_evaluation'=>1), array('LID'=>$LID, 'PIN'=>$pin));

        $this->session->set_flashdata('message', lang('loan_pushtoevaluation_success'));
        redirect(current_lang() . '/loan/loan_viewlist', 'refresh');

    }

    function export_receipt($html, $filename, $page_orientation = null) {
        $filename = $filename.'.pdf';
        //$html = "Tanzania";
        $this->load->library('pdf1');
        $pdf = $this->pdf1->load($page_orientation);
        //$pdf->SetHTMLHeader($header);
        $pdf->SetFooter('Printed on' . ' ' . date('d-m-Y H:i:s')); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
        $pdf->WriteHTML($html); // write the HTML into the PDF
        $pdf->Output($filename, 'I'); // save to file because we can  
    }
}
?>
