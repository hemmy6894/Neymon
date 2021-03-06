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
    <table style="border-bottom:1px solid #000;">
        <tr>
            <td style="width:300px;">
                <img src="'. base_url().'logo/'.company_info()->logo.'" style="width:250px; height:200px;"/>
            </td>
            <td style="width:1200px; text-align:center"><b>
               '. company_info()->name.'<br/>
                P.O.Box' . strtoupper(company_info()->box) .' , '. strtoupper(lang('clientaccount_label_phone')).':' . company_info()->mobile.'<br/>
                CASH SHARE BUY/REFUND FORM<br/>
               FOMU YA KUNUNUA/KURUDISHA HISA
</b>
            </td>
        </tr>
    </table>
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<table >
        <tr>
            <td style="width:750px;">Date/Tarehe <br/> <b>';
$ex = explode(' ', $trans->createdon);

$html.=format_date($ex[0], FALSE) .'</b> <br/></td>
            <td style="width:750px;">&nbsp;</td>
        </tr>
        <tr>
            <td>Member Number<br/>Namba ya Utambulisho<br/><b> '.'SYSTEM No : ' .$trans->PID.' <br/>Other No : '.$trans->member_id .'</b><br/></td>
            <td>Number Holder\'s Name<br/>Jina la Mwenye Namba<br/><b>  ';
         $account_name = $this->member_model->member_basic_info(null,$trans->PID,$trans->member_id)->row();
$html.=$account_name->firstname.' '.$account_name->middlename.' '.$account_name->lastname.'</b><br/></td>
        </tr>
        <tr>
            <td>Buy/Sell<br/>Kununua/Kuuza<br/><b> '. ($trans->trans_type == 'CR' ? lang('BUY'): lang('SELL')) .'</b><br/></td>
            <td>Amount<br/>Kiasi cha Fedha<br/><b>   '. number_format($trans->amount,2).' &nbsp;  '.$trans->trans_type.'</b></td>
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

$this->pdf->Output($trans->PID. '.pdf', 'I');
exit;
?>