<div class="row">
    <div class="col-lg-12">
        <div style=" margin: auto;">
            <div style="text-align: center;"> 
                <h3 style="margin: 0px; padding: 0px;"><strong>Loan Balance Report</strong></h3>
                <h4><strong>Loan disbursed until <?php echo format_date($reportinfo->todate, false); ?></strong></h4>
              
            </div>
            <div style="">
                <style type="text/css">
                    table.table{
                     border-right:   1px solid #000;   
                    }
                    table.table tbody tr td{
                       
                        border-left:  1px solid #000;
                        border-bottom:    1px solid #000;
                        padding-top: 5px;
                        font-size: 17px;
                    }
                    table.table thead tr th{
                        border-left:  1px solid #000;
                        border-top:   1px solid #000;
                        border-bottom:1px solid #000;
                    }
                    
                </style>
              <table class="table"  cellspacing="0" cellpading="0">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 50px; padding-right: 10px;">S/No</th>  
                                <th style="text-align: left; width: 120px;">Loan ID</th>  
                                <th style="text-align: left; width: 200px;">Name</th>   
                                <th style=" text-align: left; width: 200px; ">Loan Type</th>       
                                <th style=" text-align: left; width: 100px; ">Disbursed Date</th>       
                                <th style=" text-align: right; width: 150px; ">Loan Amount</th>      
                                <th style=" text-align: right; width: 140px; ">Amount Repaid</th>      
                                <th style=" text-align: right; width: 140px; ">Principle Paid</th>       
                                <th style=" text-align: right; width: 140px; ">Interest Paid</th>       
                                <th style=" text-align: right; width: 140px; ">Penalty</th> 
                                <th style=" text-align: right; width: 200px; ">Paid In Advance</th>
                                <th style=" text-align: right; width: 140px; ">Balance</th> 
                                <th style=" text-align: right; width: 200px; ">Principle Balance</th> 

                            </tr>

                        </thead>  
                        <tbody>
                             <tbody>
                            <?php
                            $i=1;
                            
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
                          
                        </tbody>
                        
                        
              </table>
                
                
                
                
            </div>
        </div>
    </div>
</div>