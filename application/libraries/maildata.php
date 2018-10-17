<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of maildata
 *
 * @author miltone
 */
class Maildata {

    //put your code here

    function __construct() {
        
    }

    public function __get($var) {
        return get_instance()->$var;
    }

    function send_email($subject, $message, $recipient=array(), $notify_admin=false,$bcc=array(), $attachment=null) {
      
        $this->load->library('email');
        $this->email->from("smsmtandao@gmail.com", 'SMS MTANDAO');
        $this->email->subject($subject);
        $this->email->to($recipient);
        
        if($notify_admin){
        $bcc[] = EMAIL_INFO_ADMIN;
        $this->email->bcc($bcc);
        }
        
        if (!is_null($attachment)) {
            $this->email->attach($attachment);
        }
        
        $this->email->message($message);
        if ($this->email->send()) {
             
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>
