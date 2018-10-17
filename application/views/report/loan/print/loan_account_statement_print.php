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
                
                
                <table class="table"  cellspacing="0" cellpading="0" style="width: 100%;">
        <thead>
            <tr>
                <th style="width: 50px;">#</th>
                <th style="width: 120px;">Date</th>
                <th style="width: 200px;">Particulars</th>
                <th style="width: 150px;">Dr</th>
                <th style="width: 150px;" >Cr</th>                
                <th style="width: 180px;">Balance</th>


            </tr>

        </thead>
        <tbody>
            <tr>
                <td  colspan="5"><?php echo "Opening Balance As on ".date("d-m-Y", strtotime($loaninfo->createdon)); ?></td>                               
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
                <td ><?php echo $value->description; ?></td>
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
        </div>
    </div>
</div>