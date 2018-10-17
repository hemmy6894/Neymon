<style type="text/css">
    #receipt{
        width: 600px;
        border: 1px solid #ccc;
        margin: auto;
        padding: 10px;
    }
    table#receipt_header{
        width: 580px;
        margin: auto;
    }
    table#receipt_header tr td{
        vertical-align: middle;
    }
    table#receipt_header tr td#logo_receipt{
        width: 150px;
        border: 0px;
    }
    table#receipt_header tr td#logo_receipt img{
        width: 120px;
        height: 100px;
    }

    table#receipt_header tr td#receipt_title{
        font-weight: bold;
        font-size: 15px;
        text-align: center;
        vertical-align: middle;
        border: 0px;
    }

    table#receipt_after_title{
        width: 580px;
        table-layout: fixed;    
        margin: auto;
        padding-top: 10px;
    }
    
    table#receipt_after_title tr td{
        padding-bottom: 15px;
    }
</style>

<div id="receipt">
    <table id="receipt_header">
        <tr>
            
            <td id="receipt_title" style="padding-left: auto; padding-right: auto">
                <?php echo company_info()->name; ?><br/>
                 <img src="<?php echo base_url() ?>logo/<?php echo company_info()->logo; ?>"/> <br/>
    
                <div style ="font-size: 160%">EDUCATION FUND RECEIPT</div>
              </td>
              <td id="logo_receipt">
                  <b>NO.</b>  <div style ="font-size: 150%; padding-left: 0px"><?php echo $trans->customer_receipt; ?></div>
               </td>
        </tr>
    </table>
    <div style="height: 10px; border-top: 1px solid #ccc;"></div>
    <table id="receipt_after_title">
       <?php //$deposited_to = client_user_info($trans->FROM_TO_PIN, TRUE); ?>
        <tr>
            <td>&nbsp;</td>
             <td>&nbsp;</td>
            <td>Date  <b style="border-bottom: 1px dotted #000; width: 83%; margin-top:-20px; margin-left: 40px; font-weight: bold; "> <?php  echo format_date($trans->paydate, FALSE) ; ?></b></td>
            
        </tr>
        <tr>            
            <td colspan="3">Received from: <b style="border-bottom: 1px dotted #000; width: 83%; margin-top:-20px; margin-left: 100px; font-weight: bold;" > <?php $fullname = $this->loan_model->loan_holder_name($trans->LID); echo $trans->LID.' - '.$fullname ; ?>  </b> </td>
        </tr>
         <tr>  
             <?php 
             $loan_info = $this->loan_model->loan_info($trans->LID)->row();
             $contactinfo = $this->member_model->member_contact($loan_info->PID);
             ?>
            <td colspan="3">Address: <b style="border-bottom: 1px dotted #000; width: 83%; margin-top:-20px; margin-left: 100px; font-weight: bold;" > <?php echo 'P.O.Box '.$contactinfo->postaladdress; ?></b>
             </td>
        </tr>
         <tr>            
            <td colspan="3">The sum of Shillings: <b style="border-bottom: 1px dotted #000;  font-weight: bold;" >  <?php echo strtoupper($this->loan_model->numbertoword(number_format($trans->amount,2)))." ONLY"; ?></b>
                    
            </td>
        </tr>       
        <!-- <tr>            
            <td colspan="3">&nbsp;</td>
        </tr>-->  
        <tr>            
            <td colspan="3">In respect of:</td>
        </tr> 
        <tr>
            <td>
                <input  type="checkbox" name="modul" class="pure-input-1-2" value="1" placeholder="Group name"> Donation
            </td>
            <td>
                <input  type="checkbox" name="modul" class="pure-input-1-2" value="1" placeholder="Group name"> Gift
            </td>
            <td>
                <input  type="checkbox" name="modul" class="pure-input-1-2" value="1" placeholder="Group name"> Grants
            </td>
        </tr>
        <tr>
            <td>
                <input  type="checkbox" name="modul" class="pure-input-1-2" value="1" placeholder="Group name"> Bequest
            </td>
            <td>
                <input  type="checkbox" name="modul" class="pure-input-1-2" value="1" placeholder="Group name" checked="true"> Loan Repayment
            </td>
            <td>
                <input  type="checkbox" name="modul" class="pure-input-1-2" value="1" placeholder="Group name"> Other
            </td>
        </tr>
        <tr>            
            <td colspan="2">Amount <b style="border-bottom: 1px dotted #000; width: 73%; margin-top:-20px; margin-left: 60px; font-weight: bold;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo number_format($trans->amount,2) ; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b></td>
            <td><div style="margin-left: -30px;"><?php echo "(In figures)"; ?></div></td>
        </tr>
         <tr>
            <td colspan="2" style="height: 30px;"></td>
        </tr>
         <tr>            
            <td colspan="2">Signature <b style="border-bottom: 1px dotted #000; width: 73%; margin-top:-20px; margin-left: 60px; font-weight: bold;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b>  </td>
            <td>&nbsp;</td>
        </tr>
       
        
       
       
        
       

    </table>
    <br/>
    
</div>