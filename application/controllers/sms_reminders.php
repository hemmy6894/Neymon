<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sms
 *
 * @author miltone
 */
class Sms_Reminders extends CI_Controller {

    //put your code here
    //put your code here
    function __construct() {
        parent::__construct();

        /*
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->form_validation->set_error_delimiters('<div class="error_message">', '</div>');
         */
        $this->data['current_title'] = 'Messaging';
        $this->load->model('sms_model');
        $this->load->model('member_model');
        $this->load->model('loan_model');
        $this->load->library('smssending');
        //$this->load->library('maildata'); 
    }
    
     function automatic_email() {
        for($i=1; $i<=2; $i++){
            
            if($i == 1){
                $no_of_day = 1;
            } else if($i == 2){
                $no_of_day = 7;
            }
        $leo = date('Y-m-d');        
        $kesho = date('Y-m-d', strtotime('+' . ($no_of_day) . ' days', strtotime($leo)));
        $datetoshow = date('d M Y',  strtotime($kesho));
   
        
          $deptors = $this->db->select('*, SUM(repayamount) AS totalrepayamount')->group_by('LID')->get_where('loan_contract_repayment_schedule', array('status' => 0, 'repaydate' =>$kesho));
          if($deptors->num_rows() > 0){
              
                        foreach($deptors->result() as $key => $value){
                            
                            $LID = $value->LID;                            
                            $amount = $value->totalrepayamount;
                            $loaninfo = $this->loan_model->loan_info($LID)->row();
                            
                            $member_contact = $this->member_model->member_contact($loaninfo->PID);
                            $recipient = array();
                            if ($member_contact->email <> '') {
                                $std = new stdClass();
                                $std->mail = $member_contact->email;
                                $recipient[] = $std;
                                $recepientmail = $member_contact->email;
                                $mobile = $member_contact->phone1;
                                $PIN = $member_contact->PIN;
                            }
                            $member_name = $this->member_name_sms(null, $loaninfo->PID);
                            
                             
                            $message = 'Ndugu '.$member_name.','.'<br><br>'.' Unakumbushwa kuwa unapaswa kulipa rejesho lako la Tsh. '.$amount.' leo tar '.$datetoshow.' Mamlaka Ya Elimu Tanzania (TEA)'.'<br><br><br>'."Best Regards,"."<br>"." TEA Loan Management.";
                            $SENDER = "TEA";
                            
                           
                            if (count($recipient) > 0) {
                                
                               $message_id = alphaID(time() . substr($mobile,-9));    
                                 /*sending email*/
                            $sendermail = "tealoanmanagement@gmail.com";
                            $senderpassword = "tea*100%";
                            $recepientmail = $recepientmail;
                            $subject = "TEA - Loan Reminder."; 
                            //echo $recepientmail."<br>";
                            $body = $message;
                            $upy = array(
                                'message_id' => $message_id,
                                'date' => date("Y-m-d H:i:s"),
                                'message' => $message,
                                'mobile' => $mobile,
                                'sender' => $SENDER,
                                'PIN' => $PIN,
                                'delivery_date' => date("Y-m-d H:i:s"),
                                'email' => $recepientmail,
                                'media' => 'EMAIL',
                            );
                            
                            $sendingemail = $this->send_email($sendermail, $senderpassword, $recepientmail, $subject, $body);

                             
                            $upy['delivery_status'] = $sendingemail;
                            $this->db->insert('sms_sent', $upy);
                            
                                
                            }
                            
                          
                           //echo '<pre>';
                           //print_r($recipient); 
                         //echo '</pre>';
                           
                        }
             } else {
                        
                echo "There is no due loan amount to remind clients to make payments";        
              }
     }
    }

   

    function automatic() {
        
        $leo = date('Y-m-d');
        $kesho = date('Y-m-d', strtotime('+' . (1) . ' days', strtotime($leo)));
        $datetoshow = date('d M Y',  strtotime($kesho));
   
        
          $deptors = $this->db->select('*, SUM(repayamount) AS totalrepayamount')->group_by('LID')->get_where('loan_contract_repayment_schedule', array('status' => 0, 'repaydate <=' =>$kesho));
          if($deptors->num_rows() > 0){
              
                        foreach($deptors->result() as $key => $value){
                            
                            $LID = $value->LID;                            
                            $amount = $value->totalrepayamount;
                            $loaninfo = $this->loan_model->loan_info($LID)->row();
                            
                            $member_contact = $this->member_model->member_contact($loaninfo->PID);
                            $recipient = array();
                            if ($member_contact->phone1 <> '') {
                                $std = new stdClass();
                                $std->mobile = $member_contact->phone1;
                                $recipient[] = $std;
                            }
                            $member_name = $this->member_name_sms(null, $loaninfo->PID);
                            
                             
                            $message = 'Ndugu '.$member_name.', unakumbushwa kuwa unapaswa kulipa rejesho lako la Tsh. '.$amount.' leo tar '.$datetoshow.' Runners Microfinance LTD';
                            $SENDER = "RUNNERS_MIC";
                            
                           
                            if (count($recipient) > 0) {
                                 
                                $this->smssending->send_sms($SENDER, $message, $recipient, $loaninfo->PIN);
                            }
                            
                          
                           //echo '<pre>';
                           //print_r($recipient); 
                         //echo '</pre>';
                           
                        }
             } else {
                        
                echo "There is no due loan amount to remind clients to make payments";        
              }
        
    }

   
    
  function sms_delivery() {   
        
        $json = file_get_contents("php://input");        
             
            //convert the string of data to an array
            $dataarray = json_decode($json, true);           
            $message_id=$dataarray["message_id"];            
            $status=$dataarray["status"];
            
              date_default_timezone_set('Africa/Nairobi');
              $b = time ();
              $receivedtime = date("Y-m-d H:i:s",$b);
                        
                         $datastatustoupdate = array(
                            'delivery_status' => $status,
                            'delivery_date' => $receivedtime                          
                            );
                         
             $this->db->where('message_id', $message_id);
             $this->db->update('sms_sent', $datastatustoupdate);                         
                        
             $return['status'] = '1';
             
           //telling smsmtandao system that the request is received or not
             echo json_encode($return);       
                  
    }
    
     function member_basic_info_sms($id = null, $PID = null, $member_id = null) {
        $this->db->where('PIN', 100);
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        if (!is_null($PID)) {
            $this->db->where('PID', $PID);
        }
        if (!is_null($member_id)) {
            $this->db->where('member_id', $member_id);
        }

        $this->db->order_by('firstname', 'ASC');
        $this->db->order_by('middlename', 'ASC');
        $this->db->order_by('lastname', 'ASC');
        return $this->db->get('members');
    }
    
     function member_name_sms($member_id = null, $PID = null) {
        $member = $this->member_basic_info_sms(null, $PID, $member_id)->row();
        return $member->firstname . ' ' . $member->middlename . ' ' . $member->lastname;
    }
  

    
      /*sendig email */
        public function send_email($sendermail, $senderpassword, $recepientmail, $subject, $body)
	{
		
                                            $ci = get_instance();
                $ci->load->library('email');
                $config['protocol'] = "smtp";
                $config['smtp_host'] = "ssl://smtp.gmail.com";
                $config['smtp_port'] = "465";
                $config['smtp_user'] = $sendermail; 
                $config['smtp_pass'] = $senderpassword;
                $config['charset'] = "utf-8";
                $config['mailtype'] = "html";
                $config['newline'] = "\r\n";

                $ci->email->initialize($config);

                $ci->email->from("info@tea.or.tz", "TEA LOAN MANAGEMENT");
                $list = array($recepientmail);
                $ci->email->to($list);
                $this->email->reply_to('info@tea.or.tz', 'TEA LOAN MANAGEMENT');
                $ci->email->subject($subject);
                $ci->email->message($body);
                if($ci->email->send()){
                    return "SUCCESS";
                } else {
                    return "FAIL";
                }

            
                
	}
        
    

}
