<div class="row">
    <div class="col-lg-12">
        <div style=" padding: 30px 10px; margin: auto;">
            <div style="text-align: center;"> <h3><strong><?php echo company_info()->name; ?></strong></h3>
                <h1><strong>Loan Arrears  Report</strong></h1>
                <h4><strong>Loan Disbursed from <?php echo format_date($reportinfo->fromdate, false); ?> to <?php echo format_date($reportinfo->todate, false); ?></strong></h4>

            </div>
            <div style="padding-top: 20px;">

                <style type="text/css">

                </style>
                <div class="table-responsive" style="overflow: auto;">
                    <table class="table table-bordered" style="width: 1000px;">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 50px; padding-right: 10px;">S/No</th>  
                                <th style="text-align: left; width: 120px;">Loan ID</th>  
                                <th style="text-align: left; width: 200px;">Name</th>   
                                <th style=" text-align: right; width: 150px; ">Base Amount</th>       
                                <th style=" text-align: right; width: 150px; ">Base Amount Balance</th>  
                                <th style=" text-align: right; width: 100px; ">Arrears principle</th>       
                                <th style=" text-align: right; width: 100px; ">Arrears Interest</th>       
                                <th style=" text-align: right; width: 100px; ">Penalty</th>       
                                <th style=" text-align: right; width: 150px; ">Total Arrears</th>       
                                <th style=" text-align: right; width: 100px; ">Days in Arrears</th>       
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;

                            if (count($transaction) > 0) {
                                $arraers_principle= 0;
                                $arraers_interest= 0;
                                $arraers_penalty= 0;
                                $arraers_total= 0;
                                foreach ($transaction as $key => $value) {
                                    $loan_info = $this->loan_model->loan_info($value->LID)->row();
                                    $principal_repay = $this->loan_model->total_amount_repay($value->LID);
                                    ?>
                                    <tr>
                                        <td style="text-align: right;"><?php echo $i++; ?>.</td>
                                        <td style="text-align: left;"><?php echo $value->LID; ?></td>
                                        <td style="text-align: left;"><?php echo $this->member_model->member_name(null,$loan_info->PID) ?></td>
                                        <td style="text-align: right;"><?php echo number_format($loan_info->basic_amount, 2); ?></td>         
                                        <td style="text-align: right;"><?php echo number_format(($loan_info->basic_amount-$principal_repay), 2); ?></td>       
                                        <td style="text-align: right;"><?php echo number_format($value->principle, 2); ?></td>       
                                        <td style="text-align: right;"><?php echo number_format($value->interest, 2); ?></td>       

                                        <?php
                                        $arraers_interest += $value->interest;
                                        $arraers_principle += $value->principle;
                                        $product = $this->setting_model->loanproduct($loan_info->product_type)->row();
                                        $warning_days = $product->warning_day;
                                        $max_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($value->repaydate)) . " +" . $warning_days . " days"));
                                        $paydate = date('Y-m-d');
                                        $d1 = new DateTime($max_date);
                                        $d2 = new DateTime($paydate);
                                        $number_of_day = $d1->diff($d2)->days;
                                        $number_months = ($d1->diff($d2)->m + ($d1->diff($d2)->y * 12));
                                        $number_months += 1;
                                        $repay_amount_install = $value->repayamount;
                                        $penalt_method = $product->penalt_method;
                                        //$penalt_percentage = $product->penalt_percentage;
                                        $penalt_percentage = $loan_info->penalt_percent;
                                        $penalt = 0;
                                        $principle = $value->principle;
                                        $interest = $value->interest;
                                        if ($penalt_method == 1) {
                                            //only on principle
                                            $penalt = (($penalt_percentage / 100) * $principle);
                                        } else if ($penalt_method == 2) {
                                            $tmp2 = $principle + $interest;
                                            $penalt = (($penalt_percentage / 100) * $tmp2);
                                        } else if ($penalt_method == 3) {
                                            $tmp2 = $repay_amount_install;
                                            $number_months = $number_of_day;
                                            $penalt = ((($penalt_percentage / 100) * $tmp2) / 30);
                                        }

                                        $penalt_avail = round($penalt, 2);
                                        
                                        $arraers_penalty += ($penalt*$number_months);
                                        $total_A = $value->repayamount+($penalt*$number_months);
                                        $arraers_total += $total_A;
                                        ?>

                                        <td style="text-align: right;"><?php echo number_format(($penalt*$number_months),2); ?></td>       
                                        <td style="text-align: right;"><?php echo number_format($total_A,2); ?></td>       
                                        <td style="text-align: right;"><?php echo number_format($number_months); ?></td>       

                                    </tr>   

                                    <?php
                                }
                                ?>
                                
                                <tr>
                                    <td colspan="5" style="text-align: right; font-weight: bold;">Grand Total: </td>
                                 <td style="text-align: right;"><?php echo number_format($arraers_principle,2); ?></td>
                                 <td style="text-align: right;"><?php echo number_format($arraers_interest,2); ?></td>
                                 <td style="text-align: right;"><?php echo number_format($arraers_penalty,2); ?></td>
                                 <td style="text-align: right;"><?php echo number_format($arraers_total,2); ?></td>
                                 <td style="text-align: right;">&nbsp;</td>
                           
                            </tr>
                            <?php
                            } else {
                                ?>
                                <tr>
                                    <td colspan="8">No data found</td>
                                </tr>
                            <?php } ?>
                        </tbody>


                    </table>
                </div>



            </div>

        </div>
        <div style="text-align: center; padding-top: 20px; border-top: 1px solid #000;">
			<?php
				$data = site_url(current_lang() . '/report_loan/loan_arrears_print/' . $link_cat . '/' . $id);
			?>
			<a href="#" onclick="printJS('<?=$data;?>')" class="btn btn-primary">Print</a>
			&nbsp; &nbsp; &nbsp; &nbsp;  
            <a href="<?php echo site_url(current_lang() . '/report_loan/create_loan_report_title/' . $link_cat . '/' . $id); ?>" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>