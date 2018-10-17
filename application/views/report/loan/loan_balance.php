<div class="row">
    <div class="col-lg-12">
        <div style=" padding: 30px 10px; margin: auto;">
            <div style="text-align: center;"> <h3><strong><?php echo company_info()->name; ?></strong></h3>
                <h1><strong>Loan Balance</strong></h1>
                <h4><strong>Loan disbursed until <?php echo format_date($reportinfo->todate, false); ?></strong></h4>
                
            </div>
            <div style="padding-top: 20px;">

                <style type="text/css">
                   
                </style>
<div class="table-responsive" style="overflow: auto;">
    <table class="table table-bordered" style="width: 1500px;">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 50px; padding-right: 10px;">S/No</th>  
                                <th style="text-align: left; width: 150px;">Loan ID</th>  
                                <th style="text-align: left; width: 250px;">Name</th>   
                                <th style=" text-align: left; width: 200px; ">Loan Type</th>       
                                <th style=" text-align: left; width: 100px; ">Disbursed Date</th>       
                                <th style=" text-align: right; width: 200px; ">Loan Amount</th>      
                                <th style=" text-align: right; width: 200px; ">Amount Repaid</th>      
                                <th style=" text-align: right; width: 200px; ">Principle Paid</th>       
                                <th style=" text-align: right; width: 200px; ">Interest Paid</th>       
                                <th style=" text-align: right; width: 200px; ">Penalty</th>
                                <th style=" text-align: right; width: 200px; ">Paid In Advance</th>
                                <th style=" text-align: right; width: 200px; ">Balance</th> 
                                <th style=" text-align: right; width: 200px; ">Principle Balance</th> 
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            if(count($transaction) > 0){
                                $total_principle=0;
                                $total_loan=0;
                                $interest=0;
                                $penalt=0;
                                $repaid=0;
                                $loan_balance=0;
                                $total_loan_balance=0;
                                $principle_balance=0;
                                $total_principle_balance=0;
                                $total_previous_remain_balance = 0;
                                
                            foreach ($transaction as $key => $value) { 
                                $total_principle += $value->principle;
                                $total_loan += $value->total_loan;
                                $interest += $value->interest;
                                $penalt += $value->penalt;
                                $repaid += $value->repay;
                                
                                $previous_remain_balance = $this->loan_model->get_previous_remain_balance($value->LID);
                                $total_previous_remain_balance += $previous_remain_balance;
                                        
                                $loan_balance = $value->total_loan - ($value->repay+$previous_remain_balance);
                                $total_loan_balance += $loan_balance;
                                
                                $loaninfo = $this->loan_model->loan_info($value->LID)->row();                                
                                $principle_balance =$loaninfo->basic_amount - ($value->principle+$previous_remain_balance);
                                $total_principle_balance += $principle_balance;
                                
                                ?>
                            <tr>
                                <td style="text-align: right;"><?php echo $i++; ?>.</td>
                                <td style="text-align: left;"><?php echo $value->LID ?></td>
                                <td style="text-align: left;"><?php echo $this->member_model->member_name($value->member_id) ?></td>
                                <td style="text-align: left;"><?php echo $this->setting_model->loanproduct($value->product_type)->row()->name; ?></td>
                                <td style="text-align: center;"><?php echo format_date($value->disbursedate,FALSE); ?></td>
                                <td style="text-align: right;"><?php echo number_format($value->total_loan,2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($value->repay,2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($value->principle,2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($value->interest,2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($value->penalt,2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($previous_remain_balance,2); ?></td>
                                <td style="text-align: right;"><?php if($loan_balance >=0){ echo number_format(($loan_balance),2); } else { echo "(".number_format(($loan_balance),2).")"; } ?></td>
                                <td style="text-align: right;"><?php if($principle_balance >=0){ echo number_format(($principle_balance),2); } else { echo "(".number_format(($principle_balance),2).")"; } ?></td>
                               
                            </tr>  
                            <?php } ?>
                            <tr>
                                <td colspan="5" ></td>
                                <td style="text-align: right;"><?php echo number_format($total_loan,2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($repaid,2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($total_principle,2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($interest,2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($penalt,2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($total_previous_remain_balance,2); ?></td>
                                <td style="text-align: right;"><?php if($total_loan_balance >=0){ echo number_format(($total_loan_balance),2); } else { echo "(".number_format(($total_loan_balance),2).")"; } ?></td>
                                <td style="text-align: right;"><?php if($total_principle_balance >=0){ echo number_format(($total_principle_balance),2); } else { echo "(".number_format(($total_principle_balance),2).")"; } ?></td>
                               
                            </tr>
                            
                           <?php }else{?>
                            <tr>
                                <td colspan="13">No loan disbursed within selected date range</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        
                        
                    </table>
</div>



            </div>

        </div>
        <div style="text-align: center; padding-top: 20px; border-top: 1px solid #000;">
					<?php
						$data = site_url(current_lang() . '/report_loan/loan_balance_print/' . $link_cat . '/' . $id);
					?>
					<a href="#" onclick="printJS('<?=$data;?>')" class="btn btn-primary">Print</a>
					&nbsp; &nbsp; &nbsp; &nbsp;  
                    <a href="<?php echo site_url(current_lang() . '/report_loan/create_loan_report_title/' . $link_cat . '/' . $id); ?>" class="btn btn-primary">Edit</a>
                </div>
    </div>
</div>