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
                             <strong><?php echo lang('member_type_id_tin') ?> : </strong> <?php echo $memberinfo->TIN; ?><br/>
                            <strong><?php echo lang('certificate_of_incorpation') ?> : </strong> <?php echo $memberinfo->incorporation_certificate; ?><br/>
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
                $undisbursed_amount = $loaninfo->basic_amount-$disburseinfo->sumdisburseamount;
               
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
                         <strong><?php echo lang('total_loan_amount') ?> : </strong> <?php echo number_format($loaninfo->total_loan, 2); ?><br/>
                         <strong><?php echo lang('loan_amount_undisbursed') ?> : </strong> <?php echo number_format($undisbursed_amount, 2); ?><br/>
                         <strong><?php echo lang('loan_amount_already_disbursed') ?> : </strong> <?php echo number_format($disburseinfo->sumdisburseamount, 2); ?><br/>

                        
                    </div></td>

            </tr>
        </table>
    </div>
</div>

<div class="table-responsive">


    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><?php echo lang('sno'); ?></th>
                <th><?php echo lang('due_date'); ?></th>
                <th><?php echo lang('amount'); ?></th>
                <th><?php echo 'Interest'; ?></th>
                <th><?php echo 'Principle'; ?></th>
                <th><?php echo lang('balance'); ?></th>

            </tr>

        </thead>
        <tbody>
            <tr>
                <td></td>
                <td style="text-align: center;"></td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;"><?php echo number_format($loaninfo->total_loan, 2); ?></td>
            </tr>
            <?php
            if (count($schedule) > 0) {
                $s = 1;
                foreach ($schedule as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $s++; ?></td>
                        <td style="text-align: center;"><?php
                            echo date('d M, Y', strtotime($value->repaydate));
                            ?>
                        </td>
                        <td style="text-align: right;"><?php echo number_format($value->repayamount,2) ?></td>
                        <td style="text-align: right;"><?php echo number_format($value->interest,2) ?></td>
                        <td style="text-align: right;"><?php echo number_format($value->principle,2) ?></td>
                        <td style="text-align: right;"><?php echo number_format($value->balance,2) ?></td>
                       
                    </tr>
                <?php }
                ?>

<?php } ?>
        </tbody>

    </table>

    <div style="text-align: center;">
		<?php
			$data = site_url(current_lang() . '/loan/print_repayment_schedule/' . $loanid);
		?>
		<a href="#" onclick="printJS('<?=$data;?>')" class="btn btn-primary">Print</a>
		&nbsp; &nbsp; &nbsp; &nbsp;
	</div>
</div>