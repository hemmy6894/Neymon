<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of member
 *
 * @author miltone
 */
class Member extends CI_Controller {

    //put your code here

    function __construct() {
        parent::__construct();


        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->form_validation->set_error_delimiters('<div class="error_message">', '</div>');

        $this->data['current_title'] = lang('page_member');
        $this->lang->load('setting');
        $this->lang->load('member');
        $this->load->model('member_model');
        $this->load->library('ion_auth');
    }

    /*
     * Function to uploads files to server
     * @author Miltone Urassa
     * @Contact miltoneurassa@yahoo.com
     */

    function upload_file($array, $name, $folder) {
        $extension = $this->getExtension($array[$name]['name']);
        $current_user = current_user();
        $filename = time() .'_'.$current_user->id.'.'.$extension ;

        $path = './' . $folder . '/';
        $path1 = './' . $folder . '/';
        $path = $path . basename($filename);

        if (move_uploaded_file($_FILES[$name]['tmp_name'], $path)) {
            // chmod($path1.$filename, 777);
            return $filename;
        } else {
            return '';
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

    function index() {
        
    }

    function deactivate($id) {
        $id = decode_id($id);
        $this->db->update('members', array('status' => 0), array('id' => $id));
        $this->session->set_flashdata('message', lang('member_deactivated'));
        redirect(current_lang() . '/member/member_list', 'refresh');
    }

    function activate($id) {
        $id = decode_id($id);
        $this->db->update('members', array('status' => 1), array('id' => $id));
        $this->session->set_flashdata('message', lang('member_activated'));
        redirect(current_lang() . '/member/member_list', 'refresh');
    }
    function add_group() {
        $this->data['title'] = lang('member_add_group');

        $this->form_validation->set_rules('company_name', lang('company_name'), 'required');
        $this->form_validation->set_rules('company_slp', lang('company_slp'), 'required|');
        $this->form_validation->set_rules('company_city', lang('company_city'), 'required');
       $this->form_validation->set_rules('company_distrit', lang('company_distrit'), 'required');

       $this->form_validation->set_rules('company_phone', lang('company_phone'), 'required|numeric');
       $this->form_validation->set_rules('company_ward', lang('company_ward'), 'required|');
       $this->form_validation->set_rules('company_street', lang('company_street'), 'required|');
      
        if ($this->form_validation->run() == TRUE) {

            $new_group = array(
                'company_name' => trim($this->input->post('company_name')),
                'company_city' => trim($this->input->post('company_city')),
                'company_slp'=> trim($this->input->post('company_slp')),
                'company_distrit'=> trim($this->input->post('company_distrit')),
                'company_phone' => trim($this->input->post('company_phone')),
                'company_email' => trim($this->input->post('company_email')),
                'company_ward' => trim($this->input->post('company_ward')),
                'company_street' => trim($this->input->post('company_street')),
                'createdby' => current_user()->id,
                'PIN' => current_user()->PIN,
            );

            $return = $this->member_model->add_group($new_group);
            if ($return) {
                $this->session->set_flashdata('message', lang('member_group_success'));
                redirect(current_lang() . '/member/add_group', 'refresh');
            } else {
                $this->data['warning'] = lang('member_group_fail');
            }
        }

        $this->data['content'] = 'member/create_member_group';
        $this->load->view('template', $this->data);
    }



   /* function add_group() {
        $this->data['title'] = lang('member_add_group');

        $this->form_validation->set_rules('company_name', lang('company_name'), 'required');
        $this->form_validation->set_rules('company_slp', lang('company_slp'), '');
        $this->form_validation->set_rules('company_city', lang('company_city'), '');
        $this->form_validation->set_rules('company_distrit', lang('company_distrit'), 'required');

        $this->form_validation->set_rules('company_phone', lang('company_phone'), 'required|numeric');
        $this->form_validation->set_rules('company_pre_phone', lang('company_pre_phone'), '');
        $this->form_validation->set_rules('company_ward', lang('company_ward'), '');
        $this->form_validation->set_rules('company_street', lang('company_street'), '');
        $this->form_validation->set_rules('company_email', lang('company_email'), '');

        if ($this->form_validation->run() == TRUE) {

            $new_group = array(
                'company_name'=> trim($this->input->post('company_name')),
                'company_slp'=> trim($this->input->post('company_slp')),
                'company_city'=> trim($this->input->post('company_city')),
                'company_distrit'=> trim($this->input->post('company_distrit')),
                'company_phone' => trim($this->input->post('company_pre_phone')),
                'company_phone' => trim($this->input->post('company_phone')),
                'company_email' => trim($this->input->post('company_email')),
                'company_ward' => trim($this->input->post('company_ward')),
                'company_street' => trim($this->input->post('company_street')),
                'createdby' => current_user()->id,
                'PIN' => current_user()->PIN,
            );

            $return = $this->member_model->add_group($new_group);
            if ($return) {
                print_r($return);
                print_r($new_group);
                $this->session->set_flashdata('message', lang('member_group_success'));
                redirect(current_lang() . '/member/add_group', 'refresh');
            } else {
                $this->data['warning'] = lang('member_group_fail');
            }
        }

        $this->data['content'] = 'member/create_member_group';
        $this->load->view('template', $this->data);
    }
*/
    function member_group_edit($id) {
        $this->data['id'] = $id;

        $id = decode_id($id);
        $this->data['grouplist'] = $this->member_model->member_group($id)->row();
        $this->data['title'] = lang('member_add_group_edit');

        $this->form_validation->set_rules('company_name', lang('company_name'), 'required');
        $this->form_validation->set_rules('company_slp', lang('company_slp'), '');
        $this->form_validation->set_rules('company_city', lang('company_city'), '');
        $this->form_validation->set_rules('company_distrit', lang('company_distrit'), 'required');

        $this->form_validation->set_rules('company_phone', lang('company_phone'), 'required|numeric');
        $this->form_validation->set_rules('company_pre_phone', lang('company_pre_phone'), '');
        $this->form_validation->set_rules('company_ward', lang('company_ward'), '');
        $this->form_validation->set_rules('company_street', lang('company_street'), '');
        $this->form_validation->set_rules('company_email', lang('company_email'), '');
        if ($this->form_validation->run() == TRUE) {

            $new_group = array(
                'name' => trim($this->input->post('company_name')),
                'company_slp' => trim($this->input->post('company_slp')),
                'company_city' => trim($this->input->post('company_city')),
                'company_distrit' => trim($this->input->post('company_distrit')),
                'company_phone' => trim($this->input->post('company_pre_phone')),
                'company_phone' => trim($this->input->post('company_phone')),
                'company_email' => trim($this->input->post('company_email')),
                'company_ward' => trim($this->input->post('company_ward')),
                'company_street' => trim($this->input->post('company_street')),
                'createdby' => current_user()->id,
            );
            $return = $this->member_model->edit_group($new_group, $id);
            if ($return) {
                $this->session->set_flashdata('message', lang('member_group_success'));
                redirect(current_lang() . '/member/member_group_edit/' . encode_id($id), 'refresh');
            } else {
                $this->data['warning'] = lang('member_group_fail');
            }
        }

        $this->data['content'] = 'member/edit_member_group';
        $this->load->view('template', $this->data);
    }

    function member_group_list() {
        $this->data['title'] = lang('member_group_list');
        $this->data['grouplist'] = $this->member_model->member_group()->result();
        $this->data['content'] = 'member/member_grouplist';
        $this->load->view('template', $this->data);
    }
	
	function view_mamber() {
        $this->data['content'] = 'member/view_member';
        $this->load->view('template', $this->data);
    }
	
	function view_mamber_loan() {
        $this->data['content'] = 'member/view_member';
        $this->load->view('template', $this->data);
    }
	
	function view_all() {
        $this->data['content'] = 'member/view_all';
        $this->load->view('template', $this->data);
    }
	
	function view_all_download() {
        $this->data['content'] = 'member/view_all';
        $this->load->view('member/view_all_download');
    }

    function new_member() {

        $this->data['title'] = lang('member_registration');
        if ($this->input->post('fee')) {
            $_POST['fee'] = str_replace(',', '', $_POST['fee']);
        }
        $this->form_validation->set_rules('category', lang('member_category'), 'required');
        $this->form_validation->set_rules('fee', lang('member_registration_fee'), 'numeric');
        $this->form_validation->set_rules('memberid_type', lang('member_type_id_number'), '');
    if($this->input->post('category') =='Individual'){    
        $this->form_validation->set_rules('firstname', lang('member_firstname'), 'required|alpha');
        $this->form_validation->set_rules('middlename', lang('member_middlename'), 'alpha');
        $this->form_validation->set_rules('jobtitle', lang('member_jobtitle'), 'alpha');
        $this->form_validation->set_rules('lastname', lang('member_lastname'), 'required|alpha');
        $this->form_validation->set_rules('gender', lang('member_gender'), 'required|alpha');
        $this->form_validation->set_rules('type_id', lang('member_type_id'), '');
        $this->form_validation->set_rules('memberid_month_salary', lang('member_month_salary'), 'required|numeric');
        $this->form_validation->set_rules('maritalstatus', lang('member_maritalstatus'), 'required');
        $this->form_validation->set_rules('dob', lang('member_dob'), 'required|valid_date');
        $this->form_validation->set_rules('id_name_issue',lang('member_type_name_issue'), 'required|alpha');
        $this->form_validation->set_rules('id_place_issue',lang('member_type_place_issue'), 'required|alpha');
        //$this->form_validation->set_rules('memberid_month_salary',lang('member_month_salary'), 'required|numeric');
        
    } else if($this->input->post('category') =='Company'){ 
     $this->form_validation->set_rules('companyname', lang('companyname'), 'required');
     $this->form_validation->set_rules('type_id_tin', lang('member_type_id_tin'), 'required');
     $this->form_validation->set_rules('certificate_of_incorpation', lang('certificate_of_incorpation'), 'required');
     $this->form_validation->set_rules('doi', lang('member_doi'), 'required|valid_date');
    
    }
        $this->form_validation->set_rules('joindate', lang('member_join_date'), 'required|valid_date');



        // upload files
        $upload_photo = true;
        $file_name = '';
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            $extension = $this->getExtension($_FILES['file']['name']);
            if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
                $this->data['logo_error'] = lang('member_photo_error');
                $upload_photo = FALSE;
            } else {
                $file_name = $this->upload_file($_FILES, 'file', 'uploads/memberphoto');
                $upload_photo = TRUE;
            }
        }
         //upload user slip files/
         $upload_photo_salary = true;
         $file_name_salary = '';
         if (isset($_FILES['file_salary']['name']) && $_FILES['file_salary']['name'] != '') {
             $extension = $this->getExtension($_FILES['file_salary']['name']);
             if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
                 $this->data['logo_error_salary'] = lang('member_photo_error');
                 $upload_photo_salary = FALSE;
             } else {
                 $file_name_salary = $this->upload_file($_FILES, 'file', 'uploads/memberphoto');
                 $upload_photo_salary = TRUE;
             }
         }
//closed
        if ($this->form_validation->run() == TRUE && $upload_photo == TRUE && $upload_photo_salary == TRUE) {
            $memberfee = default_text_value('REGISTRATION_FEE');

            $registrationfee = trim($this->input->post('fee'));
            if ($memberfee <= $registrationfee) {
                $member_id = trim($this->input->post('memberid_type'));
                //check if member id exist

                if (!$this->member_model->is_member_exist($member_id)) {
                    
                    
                    //add new member
                if($this->input->post('category') =='Individual'){  
                    
                    $new_member = array(
                        'memberid_type' => $member_id,
                        'firstname' => trim($this->input->post('firstname')),
                        'middlename' => trim($this->input->post('middlename')),
                        'jobtitle' => trim($this->input->post('jobtitle')),
                        'lastname' => trim($this->input->post('lastname')),
                        'gender' => trim($this->input->post('gender')),
                        'type_id' => trim($this->input->post('type_id')),
                        'memberid_name_issue'=>trim($this->input->post('id_name_issue')),
                        'memberid_place_issue'=>trim($this->input->post('id_place_issue')),
                        'month_salary' => trim($this->input->post('memberid_month_salary')),
                        'maritalstatus' => trim($this->input->post('maritalstatus')),
                        'dob' => format_date(trim($this->input->post('dob'))),
                        'joiningdate' => format_date(trim($this->input->post('joindate'))),
                        'createdby' => $this->session->userdata('user_id'),
                        'PIN' => current_user()->PIN
                    );
                }else if($this->input->post('category') =='Company'){
                  
                    $new_member = array(
                        'memberid_type' => $member_id,
                        'firstname' => trim($this->input->post('companyname')),
                        'TIN' => trim($this->input->post('type_id_tin')),
                        'incorporation_certificate' => trim($this->input->post('certificate_of_incorpation')),
                        'type_id' => trim($this->input->post('type_id')),
                        'type_id_number' => trim($this->input->post('type_id_number')),
                        'dob' => format_date(trim($this->input->post('doi'))),
                        'joiningdate' => format_date(trim($this->input->post('joindate'))),
                        'createdby' => $this->session->userdata('user_id'),
                        'PIN' => current_user()->PIN
                    );
                    
                } 
                    
                     $new_member['category'] = $this->input->post('category');
                    
                    if ($file_name <> '') {
                        $new_member['photo'] = $file_name;
                    }
                    //salary_slip
                    if ($file_name_salary<>''){
                        $new_member['photo_salary']=$file_name_salary; 

                    }
                    $registrationfee = trim($this->input->post('fee'));
                    $return = $this->member_model->add_member($new_member, $registrationfee);
                    
                    if ($return) {

                        $username = $member_id;
                        $email = $member_id;
                        $password = alphaID($return, FALSE, 4);
                        
                        

                        // create account for login
                       if($this->input->post('category') =='Individual'){ 
                        $additional_data = array(
                            'first_name' => $new_member['firstname'],
                            'last_name' => $new_member['lastname'],
                            'memberid_type' => $member_id,
                            'oldpass' => $password,
                            'MID' => $return,
                            'PIN' => current_user()->PIN,
                            'company' => company_info()->name,
                        );
                       }else if($this->input->post('category') =='Company'){
                         $additional_data = array(
                            'first_name' => $new_member['firstname'],                            
                            'memberid_type' => $member_id,
                            'oldpass' => $password,
                            'MID' => $return,
                            'PIN' => current_user()->PIN,
                            'company' => company_info()->name,
                        );  
                       }
                       

                        $this->ion_auth->register($username, $password, $email, $additional_data, array(3));

                      

                        $this->session->set_flashdata('message', lang('member_create_success'));
                        redirect(current_lang() . '/member/memberinfo/' . encode_id($return), 'refresh');
                    } else {
                        $this->data['warning'] = lang('member_create_fail');
                    }
                } else {
                    
                    $this->data['warning'] = lang('member_exist');
                }
            } else {
                $this->data['warning'] = lang('member_invalid_registrationfee');
            }
        }

        $this->data['content'] = 'member/new_member';
        $this->load->view('template', $this->data);
    }

    function memberinfo($id) {
        $id = decode_id($id);
        $this->data['basicinfo'] = $this->member_model->member_basic_info($id)->row();

        $status = lang('member_registration_status');
        $this->data['title'] = lang('member_infopage');
        if ($this->data['basicinfo']->formstatus != 3) {
            $this->data['subtitle'] = ' : ' . lang('member_registration_status_label') . ' <label>' . $status[$this->data['basicinfo']->formstatus] . '</label>';
        }

    if($this->input->post('category') =='Individual'){
        $this->form_validation->set_rules('firstname', lang('member_firstname'), 'required|alpha');
        $this->form_validation->set_rules('middlename', lang('member_middlename'), 'alpha');
        $this->form_validation->set_rules('jobtitle', lang('member_jobtitle'), 'alpha');
        $this->form_validation->set_rules('lastname', lang('member_lastname'), 'required|alpha');
        $this->form_validation->set_rules('gender', lang('member_gender'), 'required|alpha');
        $this->form_validation->set_rules('maritalstatus', lang('member_maritalstatus'), 'required');
        $this->form_validation->set_rules('dob', lang('member_dob'), 'required|valid_date');
    }else if($this->input->post('category') =='Company'){ 
     $this->form_validation->set_rules('companyname', lang('companyname'), 'required');          
    }
        $this->form_validation->set_rules('joindate', lang('member_join_date'), 'required|valid_date');


        // check if new photo uploaded
        // upload files
        $upload_photo = true;
        $file_name = '';
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            $extension = $this->getExtension($_FILES['file']['name']);
            if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
                $this->data['logo_error'] = 'Invalid format, only jpg,jpeg,png and gif is supported';
                $upload_photo = FALSE;
            } else {
                $file_name = $this->upload_file($_FILES, 'file', 'uploads/memberphoto');
                $upload_photo = TRUE;
            }
        }




        if ($this->form_validation->run() == TRUE & $upload_photo == TRUE) {
            //edit member info
          if($this->input->post('category') =='Individual'){  
            $edit_member = array(
                'firstname' => trim($this->input->post('firstname')),
                'middlename' => trim($this->input->post('middlename')),
                'jobtitle' => trim($this->input->post('jobtitle')),
                'lastname' => trim($this->input->post('lastname')),
                'gender' => trim($this->input->post('gender')),
                'maritalstatus' => trim($this->input->post('maritalstatus')),
                'dob' => format_date(trim($this->input->post('dob'))),
                'type_id' => trim($this->input->post('type_id')),
                'type_id_number' => trim($this->input->post('type_id_number')),
                'joiningdate' => format_date(trim($this->input->post('joindate'))),
            );
            
          }else if($this->input->post('category') =='Company'){
                  $edit_member = array(
                'firstname' => trim($this->input->post('companyname')), 
                'TIN' => trim($this->input->post('type_id_tin')),
                'incorporation_certificate' => trim($this->input->post('certificate_of_incorpation')),
                'type_id' => trim($this->input->post('type_id')),
                'type_id_number' => trim($this->input->post('type_id_number')),
                'dob' => format_date(trim($this->input->post('doi'))),
                'joiningdate' => format_date(trim($this->input->post('joindate'))),
            );
                    
                } 
          
          

            if ($file_name <> '') {
                $edit_member['photo'] = $file_name;
            }

            $return = $this->member_model->edit_member($edit_member, $id);
            if ($return) {
                $this->session->set_flashdata('message', lang('member_edited_success'));
                redirect(current_lang() . '/member/memberinfo/' . encode_id($id), 'refresh');
            } else {
                $this->data['warning'] = lang('member_edited_fail');
            }
        }



        $this->data['content'] = 'member/edit_memberinfo';
        $this->load->view('template', $this->data);
    }

    function membercontact($id) {


        $id = decode_id($id);
        $this->data['basicinfo'] = $this->member_model->member_basic_info($id)->row();
        $this->data['contactinfo'] = $this->member_model->member_contact($this->data['basicinfo']->PID);

        $status = lang('member_registration_status');
        $this->data['title'] = lang('member_contact_info');
        if ($this->data['basicinfo']->formstatus != 3) {
            $this->data['subtitle'] = ' : ' . lang('member_registration_status_label') . ' <label>' . $status[$this->data['basicinfo']->formstatus] . '</label>';
        }
        $this->form_validation->set_rules('pre_phone1', '', 'required');
        $this->form_validation->set_rules('pre_phone2', '', 'required');
        if($this->data['basicinfo']->category == "Company"){ 
        $this->form_validation->set_rules('phone1', lang('member_contact_phone3'), 'required|numeric|valid_phone');
        } else {
         $this->form_validation->set_rules('phone1', lang('member_contact_phone1'), 'required|numeric|valid_phone');
        
        }
        $this->form_validation->set_rules('phone2', lang('member_contact_phone2'), 'numeric|valid_phone');
        $this->form_validation->set_rules('contact_house', lang('member_contact_house'),'');
        $this->form_validation->set_rules('box', lang('member_contact_box'), '');
        //$this->form_validation->set_rules('fax', lang('member_contact_fax'), '');
       // $this->form_validation->set_rules('physical', lang('member_contact_physical'), '');
        $this->form_validation->set_rules('contact_city', lang('member_contact_city'),'');
        $this->form_validation->set_rules('contact_district', lang('member_contact_district'),'');
        $this->form_validation->set_rules('contact_ward', lang('member_contact_ward'),'');
        $this->form_validation->set_rules('contact_street', lang('member_contact_street'),'');


        if ($this->form_validation->run() == TRUE) {
            $member_contact = array(
                'PID' => $this->data['basicinfo']->PID,
                'phone1' => trim($this->input->post('pre_phone1')) . trim($this->input->post('phone1')),
                'contact_house' => trim($this->input->post('contact_house')),
                'postaladdress' => trim($this->input->post('box')),
                'contact_city' => trim($this->input->post('contact_city')),
                'contact_district' => trim($this->input->post('contact_district')),
                'contact_ward' => trim($this->input->post('contact_ward')),
                'contact_street' => trim($this->input->post('contact_street')),
                'createdby' => current_user()->id,
                'PIN'=>  current_user()->PIN
            );

            if ($this->input->post('phone2')) {
                $member_contact['phone2'] = trim($this->input->post('pre_phone2')) . trim($this->input->post('phone2'));
            }


            $return = $this->member_model->add_contact($member_contact, $id, $this->data['basicinfo']->formstatus);
            if ($return) {
                $this->session->set_flashdata('message', lang('member_contact_success'));
                redirect(current_url(), 'refresh');
            } else {
                $this->data['warning'] = lang('member_contact_fail');
            }
        }

        $this->data['content'] = 'member/contactinfo';
        $this->load->view('template', $this->data);
    }

    function membernextkin($id) {

        $id = decode_id($id);
        $this->data['basicinfo'] = $this->member_model->member_basic_info($id)->row();
        $this->data['nextkininfo'] = $this->member_model->member_nextkin($this->data['basicinfo']->PID);

        $status = lang('member_registration_status');
        $this->data['title'] = lang('nextkin_title');
        if ($this->data['basicinfo']->formstatus != 3) {
            $this->data['subtitle'] = ' : ' . lang('member_registration_status_label') . ' <label>' . $status[$this->data['basicinfo']->formstatus] . '</label>';
        }
        $this->form_validation->set_rules('pre_phone1', '', 'required');
        $this->form_validation->set_rules('phone1', lang('member_contact_phone1'), 'required|numeric|valid_phone');
        $this->form_validation->set_rules('email', lang('member_contact_email'), 'valid_email');
        $this->form_validation->set_rules('name', lang('nextkin_name'), 'required');
        $this->form_validation->set_rules('relationship', lang('nextkin_relationship'), 'required');
        $this->form_validation->set_rules('box', lang('member_contact_box'), '');
        $this->form_validation->set_rules('physical', lang('member_contact_physical'), '');


        if ($this->form_validation->run() == TRUE) {
            $member_nextkin = array(
                'PID' => $this->data['basicinfo']->PID,
                'phone' => trim($this->input->post('pre_phone1')) . trim($this->input->post('phone1')),
                'email' => trim($this->input->post('email')),
                'relationship' => trim($this->input->post('relationship')),
                'name' => trim($this->input->post('name')),
                'postaladdress' => trim($this->input->post('box')),
                'physicaladdress' => trim($this->input->post('physical')),
                'createdby' => current_user()->id,
                'PIN'=>  current_user()->PIN
            );




            $return = $this->member_model->add_nextkininfo($member_nextkin, $id, $this->data['basicinfo']->formstatus);
            if ($return) {
                $this->session->set_flashdata('message', lang('member_contact_success'));
                redirect(current_url(), 'refresh');
            } else {
                $this->data['warning'] = lang('member_contact_fail');
            }
        }

        $this->data['content'] = 'member/nextkininfo';
        $this->load->view('template', $this->data);
    }
    
    
    function memberbusiness($id) {

        $id = decode_id($id);
        $this->data['basicinfo'] = $this->member_model->member_basic_info($id)->row();
        $this->data['businessinfo'] = $this->member_model->member_businessinfo($this->data['basicinfo']->PID);

        $status = lang('member_registration_status');
        $this->data['title'] = lang('nextkin_title');
        if ($this->data['basicinfo']->formstatus != 3) {
            $this->data['subtitle'] = ' : ' . lang('member_registration_status_label') . ' <label>' . $status[$this->data['basicinfo']->formstatus] . '</label>';
        }
        $this->form_validation->set_rules('pre_phone1', '', 'required');
        $this->form_validation->set_rules('phone1', lang('member_contact_phone1'), 'required|numeric|valid_phone');
        $this->form_validation->set_rules('email', lang('member_contact_email'), 'valid_email');
        $this->form_validation->set_rules('name', lang('nextkin_name'), 'required');
        $this->form_validation->set_rules('relationship', lang('nextkin_relationship'), 'required');
        $this->form_validation->set_rules('box', lang('member_contact_box'), '');
        $this->form_validation->set_rules('physical', lang('member_contact_physical'), '');


        if ($this->form_validation->run() == TRUE) {
            $member_nextkin = array(
                'PID' => $this->data['basicinfo']->PID,
                'phone' => trim($this->input->post('pre_phone1')) . trim($this->input->post('phone1')),
                'email' => trim($this->input->post('email')),
                'relationship' => trim($this->input->post('relationship')),
                'name' => trim($this->input->post('name')),
                'postaladdress' => trim($this->input->post('box')),
                'physicaladdress' => trim($this->input->post('physical')),
                'createdby' => current_user()->id,
                'PIN'=>  current_user()->PIN
            );




            $return = $this->member_model->add_nextkininfo($member_nextkin, $id, $this->data['basicinfo']->formstatus);
            if ($return) {
                $this->session->set_flashdata('message', lang('member_contact_success'));
                redirect(current_url(), 'refresh');
            } else {
                $this->data['warning'] = lang('member_contact_fail');
            }
        }

        $this->data['content'] = 'member/nextkininfo';
        $this->load->view('template', $this->data);
    }

    function member_list() {
        $this->load->library('pagination');
        $this->data['title'] = lang('member_list');

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


        $config["base_url"] = site_url(current_lang() . '/member/member_list/');
        $config["total_rows"] = $this->member_model->count_member($key);
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

        $this->data['member_list'] = $this->member_model->search_member($key, $config["per_page"], $page);



        $this->data['content'] = 'member/memberlist';
        $this->load->view('template', $this->data);
    }

    function membergroup($id) {
        $id = decode_id($id);
        $this->data['title'] = lang('member_addgroup');
        $this->data['basicinfo'] = $this->member_model->member_basic_info($id)->row();
        $this->data['allgroup'] = $this->member_model->member_group()->result();
        $selected_group = $this->member_model->member_group_cross($this->data['basicinfo']->PID);

        $selected_group_array1 = array();
        foreach ($selected_group as $key => $value) {
            $selected_group_array1[] = $value->group_id;
        }

        $selected_gp_array = $selected_group_array1;
        if ($this->input->post('SAVEGRP')) {
            if ($this->input->post('selectedgp')) {

                $expl = explode(',', $this->input->post('selectedgp'));
                $delete_this = array_diff($selected_gp_array, $expl);
                foreach ($delete_this as $keyx => $valuex) {
                    $this->db->delete('members_groups', array('group_id' => $valuex, 'PID' => $this->data['basicinfo']->PID));
                }


                foreach ($expl as $keyy => $valuey) {
                    //check
                    $check = $this->db->get_where('members_groups', array('group_id' => $valuey, 'PID' => $this->data['basicinfo']->PID))->result();
                    if (count($check) == 0) {

                        $gp = $this->member_model->member_group($valuey)->row();
                        $array_insert = array(
                            'group_id' => $valuey,
                            'GID' => $gp->GID,
                            'member_id' => $this->data['basicinfo']->member_id,
                            'PID' => $this->data['basicinfo']->PID,
                            'createdby' => $this->session->userdata('user_id'),
                            'PIN'=>  current_user()->PIN
                        );
                        $this->db->insert('members_groups', $array_insert);
                    }
                }
                $this->data['message'] = lang('member_contact_success');
            } else {
                //remove all
                $delete = $this->db->delete('members_groups', array('PID' => $this->data['basicinfo']->PID));
                if ($delete) {
                    $this->data['message'] = lang('member_contact_success');
                }
            }
        }




        $selected_group = $this->member_model->member_group_cross($this->data['basicinfo']->PID);

        $selected_group_array = array();
        foreach ($selected_group as $key => $value) {
            $selected_group_array[] = $value->group_id;
        }

        $this->data['selected_gp_array'] = $selected_group_array;
        $this->data['selected_gp'] = $selected_group;

        $this->data['content'] = 'member/member_group';
        $this->load->view('template', $this->data);
    }

}

?>
