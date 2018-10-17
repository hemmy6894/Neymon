<?php
$this->load->library('pdf');
$this->pdf->set_subtitle('');
$this->pdf->hidefooter(FALSE);
$this->pdf->start_pdf(FALSE);
$this->pdf->SetSubject('miltone');
$this->pdf->SetKeywords('miltone');
$this->pdf->AddPage();
$initial_page = $this->pdf->getNumPages();
$y = $this->pdf->SetY(0);
$y = $this->pdf->SetY(10);

$this->pdf->SetFont('times', '', 9);


$html='<div id="receipt">
    <table style="border-bottom:0px solid #fff;">
    <tr> 
     <td style="width:1200px; text-align:center; font-size: 150%"><b>
               '. company_info()->name.'<br/>
                
              </b>
            </td>
    </tr>
        <tr>
            <td style="width:1200px; text-align:center">
                <img src="'. base_url().'logo/'.company_info()->logo.'" style="width:250px; height:200px;"/>
            </td>
            
         </tr>
        <tr>
            <td style="width:1200px; text-align:center; font-size: 180%"><b>
                  EDUCATION FUND RECEIPT <br/>
              
                </b>
            </td>
        </tr>
    </table>
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<table >
        <tr>
            <td style="width:750px; text-align:right">Date: <b>';


$html.=format_date($trans->paydate, FALSE) .'</b> <br/></td>
            <td style="width:750px;">&nbsp;</td>
        </tr>
        <tr>
            <td style="width:1200px;">Received from : <b style="text-decoration: underline; text-decoration-line: dashed; width:800px"> ' .$trans->LID.' - '.$this->loan_model->loan_holder_name($trans->LID).'</b><br/></td>
            
        </tr>
        <tr>
            <td>Address :<br/><br/><b> '. ($this->loan_model->installment_affected($trans->receipt)) .'</b><br/></td>
            <td>Amount<br/>Kiasi cha Fedha<br/><b>   '. number_format($trans->amount,2).'</b></td>
        </tr>
        <tr>
            <td>Transaction Number <br/>Namba ya Muamala<br/><b> '. $trans->receipt.'</b><br/></td>
            <td>Teller Name<br/>Jina la Mhasibu Fedha<br/><b>   ';
        $use = current_user($trans->createdby);
        $html.=$use->first_name.' '.$use->last_name.'</b></td>
        </tr>
         <tr>
            <td colspan="2" style="height: 30px;"></td>
        </tr>
        
  <tr>
            <td>Customer/Mteja <br/>
                <br/>.....................................</td>
            <td>Teller/Mhasibu Fedha<br/><br/>.......................................................</td>
        </tr>

    </table><div style="font-style: italic; border-bottom:1px solid black; width:1500px; "><br/>Printed on: '.date('d-m-Y H:i:s').'</div>
</div>';


$this->pdf->writeHTML($html, true, false, true, false, '');

$this->pdf->Output($trans->LID. '.pdf', 'I');
exit;
?>