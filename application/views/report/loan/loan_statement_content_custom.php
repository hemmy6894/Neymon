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



<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?php echo "PART I DISBURSEMENTS"; ?></h4>
    </div>
    <div class="panel-body">
<div class="table-responsive">


    <table class="table table-bordered">
        <thead>
            <tr>
                
                <th>Date</th>
                <!--<th>PV</th>-->
                <th>CHQ NO</th>
                <th>DISBURSEMENT</th>
                <th>REPAYMENT</th>
                <th>LOAN BALANCE</th>
                <th>UNDISBURSED</th>


            </tr>

        </thead>
        <tbody>
            <?php
            $disbursed_total = 0;
            $total_loan = $loaninfo->basic_amount;
            foreach ($disbursment as $key => $value) { 
                
                $disbursed_total += $value->disburseamount;
                $loan_balance = $disbursed_total;
                $undisbursed_amount = $total_loan - $disbursed_total;
                
                ?>
            <tr>
                
                <td style="text-align: center;"><?php echo format_date($value->disbursedate,false); ?></td>
                <!--<td style="text-align: center;"></td>-->
                <td style="text-align: center;"><?php echo $value->cheque_no; ?></td>
                <td style="text-align: right;"><?php echo number_format($value->disburseamount,2); ?></td>
                <td style="text-align: center;"></td>
                <td style="text-align: right;"><?php echo number_format($loan_balance,2); ?></td>
                <td style="text-align: right;"><?php echo number_format($undisbursed_amount,2); ?></td>
                
            </tr>
            <?php }
            ?>

             <?php
            $repayment_total = 0;
            $total_loan = $loaninfo->basic_amount;
            foreach ($repayment as $key => $value) { 
                
                $repayment_total += $value->amount;
                $loan_balance = $disbursed_total - $repayment_total;
                
                
                ?>
            <tr>
                
                <td style="text-align: center;"><?php echo format_date($value->paydate,false); ?></td>
                <!--<td style="text-align: center;"></td>-->
                <td style="text-align: center;"></td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;"><?php echo number_format($value->amount,2); ?></td>
                <td style="text-align: right;"><?php echo number_format($loan_balance,2); ?></td>
                <td style="text-align: right;"><?php echo number_format($undisbursed_amount,2); ?></td>
                
            </tr>
            <?php }
            ?>
            
            <tr>
                
                
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: right;font-weight: bold;"><?php echo number_format($disbursed_total,2); ?></td>
                <td style="text-align: right; font-weight: bold;"><?php echo number_format($repayment_total,2); ?></td>
                <td style="text-align: right; font-weight: bold;"><?php echo number_format($loan_balance,2); ?></td>
                <td style="text-align: right; font-weight: bold;"><?php echo number_format($undisbursed_amount,2); ?></td>
                
            </tr>

        </tbody>
    </table>
</div>
 </div>
</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?php echo "PART II INTEREST CHARGED"; ?></h4>
    </div>
    <div class="panel-body">
<div class="table-responsive">


    <table class="table table-bordered">
        <thead>
            <!--<tr>
                <th style="width: 50px;">#</th>
                <th>Due Date</th>
                <th>Paid Date</th>
                <th>Installment Amount</th>
                <th>Interest</th>
                <th>Penalty</th>
                <th>Principle</th>
                <th>Balance</th>


            </tr>-->

        </thead>
        <tbody>
            <?php
            $total_interest = 0;
            foreach ($schedule as $key => $value) { 
                $total_interest += $value->interest;
                ?>
            <tr>
                
                <td style="text-align: center;"><?php echo format_date($value->repaydate,false); ?></td>
                <td colspan="2" style="text-align: center;">Interest</td>               
                <td style="text-align: right;"><?php echo number_format($value->interest,2); ?></td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;"><?php echo number_format($total_interest,2); ?></td>
                <td style="text-align: right;"></td>
            </tr>
            <?php }
            ?>
            
             <tr>
                
                <td style="text-align: center;"></td>
                <td colspan="2" style="text-align: center;font-weight: bold;"> Total Interest Charged</td>                
                <td style="text-align: right;font-weight: bold;"><?php echo number_format($total_interest,2); ?></td>
                <td style="text-align: right; font-weight: bold;"></td>
                <td style="text-align: right; font-weight: bold;"><?php echo number_format($total_interest,2); ?></td>
                <td style="text-align: right; font-weight: bold;"></td>
                
            </tr>
            
            <tr>
                
                <td style="text-align: center;"></td>
                <td colspan="2" style="text-align: center;"> </td>                
                <td style="text-align: right;font-weight: bold;"></td>
                <td style="text-align: right; font-weight: bold;"></td>
                <td style="text-align: right; font-weight: bold;"></td>
                <td style="text-align: right; font-weight: bold;"></td>
                
            </tr>
            <tr>
                
                <td style="text-align: center;"></td>
                <td colspan="2" style="text-align: center;font-weight: bold;"> Total Loan Outstanding</td>                
                <td style="text-align: right;font-weight: bold;"><?php echo number_format($loaninfo->total_loan,2); ?></td>
                <td style="text-align: right; font-weight: bold;"><?php echo number_format($repayment_total,2); ?></td>
                <td style="text-align: right; font-weight: bold;"><?php echo number_format($loaninfo->total_loan - $repayment_total,2); ?></td>
                <td style="text-align: right; font-weight: bold;"></td>
                
            </tr>


        </tbody>
    </table>
</div>
 </div>
</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?php echo "PART III INSTALLMENT DUE"; ?></h4>
    </div>
    <div class="panel-body">
<div class="table-responsive">


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>INTEREST</th>
                <th style="width: 100px; ">DATE DUE</th>                
                <th>INSTALLMENTS DUE</th>
                <th>INSTALLMENTS PAID</th>
                <th>INTALLMENT OUTSTANDING</th>
                <th>INTEREST ON OVERDUE AMOUNT</th>
                <th>OVERDUE INSTALLMENT</th>


            </tr>

        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;"><?php echo $loaninfo->rate.'%'; ?></td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;"></td>
                </tr>
            <?php foreach ($dues as $key => $value) { 
                
                
                 $former = $this->loan_model->installment_paid_amount($value->LID, $value->installment_number);
                             foreach($former as $key3 => $former_payments){
                             $amount_already_paid = $former_payments->tamount; //was insuffienty paid
                             $interest_already_paid = $former_payments->interest_paid;
                             $principle_already_paid = $former_payments->principle_paid;
                             $penalty_already_paid = $former_payments->penalt_paid;
                             }
                
                ?>
            
            <tr>
                <td style="text-align: right;"></td>
                <td style="text-align: center;"><?php echo format_date($value->repaydate,false); ?></td>
                <td style="text-align: right;"><?php echo number_format($value->repayamount,2); ?></td>
                <td style="text-align: right;"><?php echo number_format($amount_already_paid,2); ?></td>
                <td style="text-align: right;"><?php echo number_format($value->repayamount-$amount_already_paid,2); ?></td>
                <td style="text-align: right;"><?php echo number_format($value->interest-$interest_already_paid,2); ?></td>
                <td style="text-align: right;"><?php echo number_format($value->repayamount-$amount_already_paid,2); ?></td>
               
            </tr>
            <?php }
            ?>


        </tbody>
    </table>
</div>
 </div>
</div>

        
        
 <div style="text-align: center">
    <?php
		$data = site_url(current_lang().'/report_loan/loan_statement_custom_print/?loan_id='.$loaninfo->LID);
	?>
	<a href="#" onclick="printJS('<?=$data;?>')" class="btn btn-primary">Print</a>
	&nbsp; &nbsp; &nbsp; &nbsp;              
 </div>




