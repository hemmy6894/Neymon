<div class="row">
    <div class="col-lg-12">
        <div style=" margin: auto;">
            <div style="text-align: center;"> 
                <h3 style="margin: 0px; padding: 0px;"><strong>Loan Statement</strong></h3>

            </div>
            <div style="">
                <style type="text/css">
                    table tr td{
                        font-size: 13px;
                    }
                    table.table tbody tr td{
                        border: 0px;
                        padding-top: 10px;
                    }
                    table.table thead tr th{
                        border-bottom: 1px solid #000;
                        font-size: 13px;
                    }
                </style>

                <!-- basic information -->
                <?php $memberinfo = $this->member_model->member_basic_info(null, $loaninfo->PID)->row(); ?>

                <h4 style="border-bottom: 1px solid #000;"><?php echo lang('member_basic_info'); ?></h4>

                <table>
                    <tr>
                        <td valign='top' style="width: 120px;"><img  style="width: 100px; height: 100px;" src="<?php echo base_url() ?>uploads/memberphoto/<?php echo $memberinfo->photo; ?>"/></td>
                        <td valign='top'>
                            <table>
                                <?php if($memberinfo->category == "Company"){ ?>
                                <tr><td><?php echo lang('companyname') ?> : </td><td> <?php echo $memberinfo->firstname; ?></td></tr>
                                 <tr><td><?php echo lang('member_doi') ?> : </td><td> <?php echo format_date($memberinfo->dob, FALSE); ?></td></tr>
                               <?php } ?>
                                 <?php if($memberinfo->category == "Individual"){ ?>
                                <tr><td><?php echo lang('member_firstname') ?> : </td><td> <?php echo $memberinfo->firstname; ?></td></tr>
                                <tr><td><?php echo lang('member_middlename') ?> : </td><td> <?php echo $memberinfo->middlename; ?></td></tr>
                                <tr><td><?php echo lang('member_lastname') ?> : </td><td> <?php echo $memberinfo->lastname; ?></td></tr>
                                <tr><td><?php echo lang('member_gender') ?> : </td><td> <?php echo $memberinfo->gender; ?></td></tr>
                                <tr><td><?php echo lang('member_dob') ?> : </td><td> <?php echo format_date($memberinfo->dob, FALSE); ?></td></tr>
                                <?php } ?>
                            </table>
                        </td>
                        <td valign='top' style="padding-left: 50px;">
                            <table>
                                <tr><td><?php echo lang('member_pid') ?> : </td><td> <?php echo $memberinfo->PID; ?></td></tr>
                                <tr><td><?php echo lang('member_member_id') ?> : </td><td> <?php echo $memberinfo->member_id; ?></td></tr>
                                <tr><td><?php echo lang('member_join_date') ?> : </td><td> <?php echo format_date($memberinfo->joiningdate, FALSE); ?></td></tr>

                            </table>
                        </td>



                    </tr>
                </table>



                <h4 style="border-bottom: 1px solid #000;"><?php echo lang('loan_info'); ?></h4>


                <table>
                    <tr>
                        <?php
                        $product = $this->setting_model->loanproduct($loaninfo->product_type)->row();
                        $interval = $this->setting_model->intervalinfo($loaninfo->interval)->row();
                        ?>
                        <td valign='top'>
                            <table>
                                <tr><td><?php echo lang('loan_product') ?> : </td><td> <?php echo $product->name; ?></td></tr>
                                <tr><td><?php echo lang('loanproduct_interest') ?> : </td><td> <?php echo $loaninfo->rate; ?></td></tr>
                                <tr><td><?php echo lang('loan_installment') ?> : </td><td> <?php echo $loaninfo->number_istallment . ' ' . $interval->name; ?></td></tr>
                                <tr><td><?php echo lang('loan_paysource') ?> : </td><td> <?php echo $loaninfo->pay_source; ?></td></tr>
                            </table>
                        </td>
                        <td valign="top" style="padding-left: 30px;">
                            <table>
                                <tr><td><?php echo lang('loan_applicationdate') ?> : </td><td style="text-align: right;"> <?php echo format_date($loaninfo->applicationdate, FALSE); ?></td></tr>
                                <tr><td><?php echo lang('loan_installment_amount') ?> : </td><td style="text-align: right;"> <?php echo number_format($loaninfo->installment_amount, 2); ?></td></tr>
                                <tr><td><?php echo lang('loan_total_interest') ?> : </td><td style="text-align: right;"> <?php echo number_format($loaninfo->total_interest_amount, 2); ?></td></tr>
                                <tr><td><?php echo lang('loan_applied_amount') ?> : </td><td style="text-align: right;"> <?php echo number_format($loaninfo->basic_amount, 2); ?></td></tr>
                            </table>
                        </td>
                        <td valign="top" style="padding-left: 10px;">
                            <?php echo lang('loan_LID') ?> :  <?php echo $loaninfo->LID; ?>

                        </td>

                    </tr>
                </table>
                <br/>
               
                
                
                
                
                
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?php echo "PART I DISBURSEMENTS"; ?></h4>
    </div>
    <div class="panel-body">
<div class="table-responsive" >


    <table class="table table-bordered" style="width: 100%;">
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


    <table class="table table-bordered" style="width: 100%;">
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
                <td colspan="2" style="text-align: center; font-weight: bold;"> Total Loan Outstanding</td>                
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


    <table class="table table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th>INTEREST</th>
                <th>DATE DUE</th>                
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





            </div>
        </div>
    </div>
</div>