<div class="row">
    <div class="col-lg-12">
        <div style=" padding: 30px 10px; margin: auto;">
            <div style="text-align: center;"> <h3><strong><?php echo company_info()->name; ?></strong></h3>
                <h1><strong>Loan List</strong></h1>
                <h4><strong>Loan applied from <?php echo format_date($reportinfo->fromdate, false); ?> to <?php echo format_date($reportinfo->todate, false); ?></strong></h4>
                <h5><strong>Status : <?php echo loan_status($reportinfo->custom); ?></strong></h5>
            </div>
            <div style="padding-top: 20px;">

                <style type="text/css">
                   
                </style>
<div class="table-responsive" style="overflow: auto;">
    <table class="table table-bordered" style="width: 1300px;">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 50px; padding-right: 10px;">S/No</th>  
                                <th style="text-align: left; width: 150px;">Loan ID</th>  
                                <th style="text-align: left; width: 250px;">Name</th>   
                                <th style=" text-align: left; width: 200px; ">Loan Type</th>       
                                <th style=" text-align: left; width: 100px; ">Applied Date</th>       
                                <th style=" text-align: right; width: 200px; ">Base Amount</th>       
                                <th style=" text-align: right; width: 50px; ">Rate(%)</th>       
                                <th style=" text-align: right; width: 50px; ">Installment#</th>       
                                <th style=" text-align: right; width: 200px; ">Installment Amount</th>       
                                <th style=" text-align: right; width: 200px; ">Interest</th>       
                                <th style=" text-align: right; width: 200px; ">Total</th>       
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            if(count($transaction) > 0){
                                $baseamount=0;
                                $total_loan=0;
                                $interest=0;
                            foreach ($transaction as $key => $value) { 
                                $baseamount += $value->basic_amount;
                                $total_loan += $value->total_loan;
                                $interest += $value->total_interest_amount;
                                ?>
                            <tr>
                                <td style="text-align: right;"><?php echo $i++; ?>.</td>
                                <td style="text-align: left;"><?php echo $value->LID ?></td>
                                <td style="text-align: left;"><?php echo $this->member_model->member_name(null,$value->PID) ?></td>
                                <td style="text-align: left;"><?php echo $this->setting_model->loanproduct($value->product_type)->row()->name; ?></td>
                                <td style="text-align: center;"><?php echo format_date($value->applicationdate,FALSE); ?></td>
                                <td style="text-align: right;"><?php echo number_format($value->basic_amount,2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($value->rate,2); ?></td>
                                <td style="text-align: right;"><?php echo $value->number_istallment .' '.$this->setting_model->intervalinfo($value->interval)->row()->description; ?></td>
                                <td style="text-align: right;"><?php echo number_format($value->installment_amount,2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($value->total_interest_amount,2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($value->total_loan,2); ?></td>
                            </tr>  
                            <?php } ?>
                            <tr>
                                <td colspan="5" ></td>
                                <td style="text-align: right;"><?php echo number_format($baseamount,2); ?></td>
                                <td style="text-align: right;"></td>
                                <td style="text-align: right;"></td>
                                <td style="text-align: right;"></td>
                                <td style="text-align: right;"><?php echo number_format($interest,2); ?></td>
                                <td style="text-align: right;"><?php echo number_format($total_loan,2); ?></td>
                           
                            </tr>
                            
                           <?php }else{?>
                            <tr>
                                <td colspan="13">No data found</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        
                        
                    </table>
</div>



            </div>

        </div>
        <div style="text-align: center; padding-top: 20px; border-top: 1px solid #000;">
          
					<?php
						$data = site_url(current_lang() . '/report_loan/loan_list_print/' . $link_cat . '/' . $id);
					?>
					<a href="#" onclick="printJS('<?=$data;?>')" class="btn btn-primary">Print</a>
					&nbsp; &nbsp; &nbsp; &nbsp;
                    <a href="<?php echo site_url(current_lang() . '/report_loan/create_loan_report_title/' . $link_cat . '/' . $id); ?>" class="btn btn-primary">Edit</a>
                </div>
    </div>
</div>