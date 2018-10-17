<div class="row">
    <div class="col-lg-12">
        <div style=" padding: 30px 10px; margin: auto;">
            <div style="text-align: center;"> <h3><strong><?php echo company_info()->name; ?></strong></h3>
                <h1><strong>Loan Maturity  Report</strong></h1>
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
                                <th style="text-align: center; width: 100px;">Disburse Date</th>   
                                <th style=" text-align: right; width: 150px; ">Base Amount</th> 
                                <?php
                                   $sum_total = array();
                               $header= array();
                               $p=1;
                               for($x=0;$x<=5;$x++){
                                   $sum_total[$x] = 0;
                                   $header[$x] = ($x==0 ?($reportinfo->custom*($p-1))  :  (($reportinfo->custom*($p-1))+1) ).' - '.($reportinfo->custom*$p).' Days';
                                   $p++;
                               }
                                               foreach ($header as $key_h1=>$value_h1){ ?>
                                                <th style=" text-align: right; width: 120px; "><?php echo $value_h1; ?></th>     
                                              <?php }
                                       ?>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;

                            if (count($transaction) > 0) {
                            
                                foreach ($transaction as $key => $value) {
                                    $loan_info = $this->loan_model->loan_info($value['data']->LID)->row();
                                    ?>
                                    <tr>
                                        <td style="text-align: right;"><?php echo $i++; ?>.</td>
                                        <td style="text-align: left;"><?php echo $value['data']->LID; ?></td>
                                        <td style="text-align: left;"><?php echo $this->member_model->member_name($loan_info->member_id) ?></td>
                                        <td style="text-align: center;"><?php echo $value['data']->disbursed_date; ?></td>         
                                       <td style="text-align: right;"><?php echo number_format($loan_info->basic_amount, 2); ?></td>       
                                       <?php
                                               foreach ($header as $keyxx => $valuexx) {
                                                   $sum_total[$keyxx] += $value['step'][$keyxx];
                                                   ?>
                                                <td style="text-align: right;"><?php echo ($value['step'][$keyxx] > 0 ? number_format($value['step'][$keyxx], 2):''); ?></td>           
                                              <?php }
                                       ?>
                                            
                                    </tr>   

                                    <?php
                                }
                                ?>
                                
                               <tr>
                                    <td colspan="5" style="text-align: right; font-weight: bold;">Grand Total: </td>
                                    <?php
                                foreach ($sum_total as $key_s => $value_s) {?>
                                    <td style="text-align: right;"><?php echo number_format($value_s,2); ?></td>
                               <?php  }
                                    ?>
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
				$data = site_url(current_lang() . '/report_loan/loan_maturity_print/' . $link_cat . '/' . $id);
			?>
			<a href="#" onclick="printJS('<?=$data;?>')" class="btn btn-primary">Print</a>
			&nbsp; &nbsp; &nbsp; &nbsp;
            <a href="<?php echo site_url(current_lang() . '/report_loan/create_loan_report_title/' . $link_cat . '/' . $id); ?>" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>