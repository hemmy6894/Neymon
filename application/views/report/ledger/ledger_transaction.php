<div class="row">
    <div class="col-lg-12">
        <div style=" padding: 30px 10px; margin: auto;">
            <div style="text-align: center;"> <h3><strong><?php echo company_info()->name; ?></strong></h3>
                <h1><strong>General Ledger Transactions</strong></h1>
                <h4><strong>For the period from <?php echo format_date($reportinfo->fromdate, false); ?> to <?php echo format_date($reportinfo->todate, false); ?></strong></h4>
                <h4><strong>Financial Year <?php echo $reportinfo->year; ?> </strong></h4>
          
            </div>
            <div style="padding-top: 20px;">
                <style type="text/css">
                    table.table tbody tr td{
                        border: 0px;
                    }
                </style>
                <table class="table" >
                    <thead>
                        <tr>
                            <th style="text-align: center;">Date</th>
                            <?php if($reportinfo->account == '4000010' || $reportinfo->account == '1030013'){ ?>
                            <th>Loan Number</th>
                            <?php } ?>
                            <th style="text-align: center;">#</th>
                            <th>Account</th>
                            <th style="text-align: right; padding-right: 20px; width: 200px;">Debit</th>
                            <th style="text-align: right; padding-right: 20px; width: 200px;">Credit</th>
                            <th style="text-align: right; padding-right: 20px; width: 200px;">Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $credittotal = 0;
                        $debittotal = 0;
                        foreach ($transaction as $key => $value) {
                            $credittotal += $value->credit;
                            $debittotal += $value->debit;
                            ?>
                            <tr>
                                <td style="text-align: center; width: 120px"><?php echo format_date($value->date,false); ?></td>
                                <?php if($reportinfo->account == '4000010'  || $reportinfo->account == '1030013'){ 
                                    $member = loan_member_info($value->PID, $value->member_id);
                                    ?>
                                <td style="text-align: left; padding-left: 30px;"><?php echo $value->LID." - ".$member->firstname." ".$member->middlename." ".$member->lastname; ?></td>
                                <?php } ?>
                                <td style="text-align: center;"><?php echo ($value->invoiceid > 0 ? '#'.$value->invoiceid:''); ?></td>
                                <td style="<?php echo ($value->credit > 0 ? 'padding-left:30px;':'');  ?>"> <?php echo $value->name; ?></td>
                                <td style="text-align: right; padding-right: 20px;"><?php echo ($value->debit > 0 ? number_format($value->debit,2):''); ?></td>
                                <td style="text-align: right; padding-right: 20px;"><?php echo ($value->credit > 0 ? number_format($value->credit,2):''); ?></td>
                                <td style="text-align: right; padding-right: 20px;">
                                    <?php  $balance_total = $debittotal - $credittotal;
                                  echo ($balance_total > 0 ? number_format($balance_total,2):'(' . number_format((-1 * $balance_total), 2) . ')'); 
                                            ?>
                                </td>
                          
                            </tr>
                        <?php }
                        ?>
                            <tr>
                              <td style="border-top: 1px solid #000; border-bottom:  1px solid #000;"></td>
                              <?php if($reportinfo->account == '4000010'  || $reportinfo->account == '1030013'){ ?>
                              <td style="border-top: 1px solid #000; border-bottom:  1px solid #000;"></td>
                              <?php } ?>
                                <td style="border-top: 1px solid #000; border-bottom:  1px solid #000;"></td>
                                <td style="border-top: 1px solid #000; border-bottom:  1px solid #000;"></td>
                                <td style="border-top: 1px solid #000; border-bottom:  1px solid #000; text-align: right; padding-right: 20px;"><?php echo number_format($debittotal,2); ?></td>
                                <td style="border-top: 1px solid #000; border-bottom:  1px solid #000;text-align: right; padding-right: 20px;"><?php echo number_format($credittotal,2); ?></td>
                                <td style="border-top: 1px solid #000; border-bottom:  1px solid #000;text-align: right; padding-right: 20px;"><?php 
                                  $balance_total = $debittotal - $credittotal;
                                  echo ($balance_total > 0 ? number_format($balance_total,2):'(' . number_format((-1 * $balance_total), 2) . ')'); 
                                 
                                
                                ?></td>
                         
                                
                            </tr>
                    </tbody>

                </table>
            </div>
            <div style="text-align: center">
				<?php
					$data = site_url(current_lang().'/report/ledger_trans_print/'.$link_cat.'/'.$id);
				?>
				<a href="#" onclick="printJS('<?=$data;?>')" class="btn btn-primary">Print</a>
				&nbsp; &nbsp; &nbsp; &nbsp;
                <a href="<?php echo site_url(current_lang().'/report/create_ledger_trans_title/'.$link_cat.'/'.$id); ?>" class="btn btn-primary">Edit</a>
            </div>
        </div>
        
    </div>
</div>