<!-- basic information -->
<?php $memberinfo = $this->member_model->member_basic_info(null, $loaninfo->PID)->row(); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?php echo lang('member_basic_info'); ?></h4>
    </div>
    <div class="panel-body">
        <table>
            <tr>
                <td><img  style="width: 100px; height: 100px;" src="<?php echo base_url() ?>uploads/memberphoto/<?php echo $memberinfo->photo; ?>"/></td>
                <td valign='top'><div style="padding-left: 30px;">
                         <?php if($memberinfo->category == "Company"){ ?>
                        <strong><?php echo lang('companyname') ?> : </strong> <?php echo $memberinfo->firstname; ?><br/>
                         <strong><?php echo lang('member_doi') ?> : </strong> <?php echo format_date($memberinfo->dob, FALSE); ?><br/>
                        <?php } ?>
                         <?php if($memberinfo->category == "Individual"){ ?>
                        <strong><?php echo lang('member_firstname') ?> : </strong> <?php echo $memberinfo->firstname; ?><br/>
                        <strong><?php echo lang('member_middlename') ?> : </strong> <?php echo $memberinfo->middlename; ?><br/>
                        <strong><?php echo lang('member_lastname') ?> : </strong> <?php echo $memberinfo->lastname; ?><br/>
                        <strong><?php echo lang('member_gender') ?> : </strong> <?php echo $memberinfo->gender; ?><br/>
                        <strong><?php echo lang('member_dob') ?> : </strong> <?php echo format_date($memberinfo->dob, FALSE); ?><br/>
                         <?php } ?>
                    </div></td>
                <td valign="top"><div style="padding-left: 100px;">
                        <strong><?php echo lang('member_pid') ?> : </strong> <?php echo $memberinfo->PID; ?><br/>
                        <strong><?php echo lang('member_member_id') ?> : </strong> <?php echo $memberinfo->member_id; ?><br/>
                        <strong><?php echo lang('member_join_date') ?> : </strong> <?php echo format_date($memberinfo->joiningdate, FALSE); ?><br/>
                    </div></td>



            </tr>
        </table>
    </div>
</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?php echo lang('loan_info'); ?></h4>
    </div>
    <div class="panel-body">
        <table>
            <tr>
                <?php
                $product = $this->setting_model->loanproduct($loaninfo->product_type)->row();
                $interval = $this->setting_model->intervalinfo($loaninfo->interval)->row();
                ?>
                <td valign='top'><div style="padding-left: 30px;">
                        <strong><?php echo lang('loan_product') ?> : </strong> <?php echo $product->name; ?><br/>
                        <strong><?php echo lang('loanproduct_interest') ?> : </strong> <?php echo $loaninfo->rate; ?><br/>
                        <strong><?php echo lang('loan_installment') ?> : </strong> <?php echo $loaninfo->number_istallment . ' ' . $interval->name; ?><br/>
                        <strong><?php echo lang('loan_paysource') ?> : </strong> <?php echo $loaninfo->pay_source; ?><br/>

                    </div></td>
                <td valign="top"><div style="padding-left: 40px;">
                        <strong><?php echo lang('loan_applicationdate') ?> : </strong> <?php echo format_date($loaninfo->applicationdate, FALSE); ?><br/>
                        <strong><?php echo lang('loan_installment_amount') ?> : </strong> <?php echo number_format($loaninfo->installment_amount, 2); ?><br/>
                        <strong><?php echo lang('loan_total_interest') ?> : </strong> <?php echo number_format($loaninfo->total_interest_amount, 2); ?><br/>
                        <strong><?php echo lang('loan_applied_amount') ?> : </strong> <?php echo number_format($loaninfo->basic_amount, 2); ?><br/>

                    </div></td>
                <td valign="top"><div style="padding-left: 40px;">
                        <strong><?php echo lang('loan_LID') ?> : </strong> <?php echo $loaninfo->LID; ?><br/>

                    </div></td>

            </tr>
        </table>
    </div>
</div>


<div class="table-responsive">


    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 50px;">#</th>
                <th>Date</th>
                <th>Particulars</th>
                <th>Dr</th>
                <th>Cr</th>                
                <th>Balance</th>


            </tr>

        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;" colspan="5"><?php echo "Opening Balance As on ".date("d-m-Y", strtotime($loaninfo->createdon)); ?></td>                               
                <td style="text-align: right;"><?php echo number_format(0,2); ?></td>
            </tr>
            <?php
            if($trans){
                $i=1;
                $totalbalance=0;
            foreach ($trans as $key => $value) { 
                if($value->debit > 0){
                    $debit = $value->debit;
                    $debit_label = number_format($value->debit,2);
                    $totalbalance -= $debit;
                } else {
                    $debit = 0;
                    $debit_label = " ";
                }
                
                if($value->credit > 0){
                    $credit = $value->credit;
                    $credit_label = number_format($value->credit,2);
                   $totalbalance += $credit;
                } else {
                   $credit_label = " "; 
                   $credit = 0;
                }
                
                ?>
             
            <tr>
                <td style="text-align: center;"><?php echo $i; ?></td>
                <td style="text-align: center;"><?php echo format_date($value->date,false); ?></td>
                <td style="text-align: center;"><?php echo $value->description; ?></td>
                <td style="text-align: right;"><?php echo $debit_label; ?></td>
                <td style="text-align: right;"><?php echo $credit_label; ?></td>                
                <td style="text-align: right;"><?php echo number_format($totalbalance,2); ?></td>
            </tr>
            <?php $i++; }
            }
            ?>


        </tbody>
    </table>
</div>
 <div style="text-align: center">
	<?php
			$data = site_url(current_lang().'/report_loan/loan_account_statement_print/?loan_id='.$loaninfo->LID);
		?>
		<a href="#" onclick="printJS('<?=$data;?>')" class="btn btn-primary">Print</a>
		&nbsp; &nbsp; &nbsp; &nbsp;         
				 </div>




