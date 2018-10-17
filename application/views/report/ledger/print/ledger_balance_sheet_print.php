
<div class="row">
    <div class="col-lg-12">
        <div style=" padding: 0px; margin: auto;">
            <div style="text-align: center;">
                <h3 style="margin: 0px; padding: 0px;"><strong>Balance Sheet</strong></h3>
                <h4 style="margin: 0px; padding: 0px;"><strong><?php echo date('F d, Y', strtotime($reportinfo->fromdate)); ?></strong></h4>
            </div>
            
             <style type="text/css">
                    table.table tbody tr td{
                        border: 0px;
                        font-size: 13px;
                    }
                    table tr td{
                        padding-top: 5px;
                         font-size: 13px;
                    }
                </style>
                 
                
                <table class="table" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center; width: 600px; text-align: left; ">Account / Particulars</th>
                            <th style="text-align: right;  width: 250px;"> Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $account_list = $this->finance_model->account_chart_hiarchy();
                  
                        foreach ($account_list['toplevel'] as $key => $value) {
                         
                            if($key != 40 && $key != 50){
                            $main_account_total = 0;
                            ?>
                            <tr>
                                <td style="font-weight: bold;" ><?php echo strtoupper($value->name); ?></td>
                            </tr>
                            <?php
                            foreach ($account_list['sublevel'][$key] as $key_sub => $value_sub) {
                                $sub_account_total = 0;
                                ?>
                                <tr>
                                    <td style="font-weight: bold; padding-left: 40px;" ><?php echo strtoupper($value_sub->name); ?></td>
                                </tr>
                                <?php
                                foreach ($account_list['account_list'][$key][$key_sub] as $key1 => $value1) {
                                    $account_balance = $this->report_model->balance_sheet_account($reportinfo->fromdate, $value1->account, $reportinfo->year);
                                    if ($account_balance) {
                                        
                                         if($value1->account == '3000002'){ //handling profit for the year
                                          $profit_for_the_year = $this->report_model->profit_for_current_year(date("Y-01-01"),$reportinfo->fromdate, $reportinfo->year);
                                          $balance_amount+=$profit_for_the_year;
                                          $profit_for_the_year = ($profit_for_the_year > 0 ? number_format($profit_for_the_year,2):'(' . number_format((-1 * $profit_for_the_year), 2) . ')'); 
                                   
                                          
                                         $retaining_earnings = 0-$account_balance->debit;
                                         $balance_amount+=$retaining_earnings;
                                         $retaining_earnings = ($retaining_earnings > 0 ? number_format($retaining_earnings,2):'(' . number_format((-1 * $retaining_earnings), 2) . ')'); 
                                       //  $account_balance->credit."<br>";                                     
                                      //  echo $account_balance->debit."<br>";                                        exit;
                                       //echo  $profit_for_the_year;
                                         
                                         $account_balance->credit = 0;
                                         $account_balance->debit = 0;    
                                        }
                                        $balance_amount = $account_balance->credit - $account_balance->debit;
                                    
                                    $main_account_total+=$balance_amount;
                                    $sub_account_total+=$balance_amount;
                                    $balance_amount_label = 0;
                                    if ($balance_amount >= 0) {
                                        $balance_amount_label = number_format($balance_amount, 2);
                                    } else {
                                        $balance_amount_label = '(' . number_format((-1 * $balance_amount), 2) . ')';
                                    }
                                    
                                    if($value1->account == '3000002'){ ?> 
                                       
                                    <tr>
                                        <td style="padding-left: 80px;" ><?php echo $value1->account . ' - ' . strtoupper($value1->name); ?></td>
                                        <td style="text-align: right;" ><?php echo $retaining_earnings; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 80px;" ><?php echo '' . '  ' . strtoupper('Profit For The Year'); ?></td>
                                        <td style="text-align: right;" ><?php echo $profit_for_the_year; ?></td>
                                    </tr>
                                        
                                   <?php } else{
                                    ?>
                                
                                    <tr>
                                        <td style="padding-left: 80px;" ><?php echo $value1->account . ' - ' . strtoupper($value1->name); ?></td>
                                        <td style="text-align: right;" ><?php echo $balance_amount_label; ?></td>
                                    </tr>

                                    <?php }
                                    }
                                }

                                $balance_subaccount_label = 0;
                                if ($sub_account_total >= 0) {
                                    $balance_subaccount_label = number_format($sub_account_total, 2);
                                } else {
                                    $balance_subaccount_label = '(' . number_format((-1 * $sub_account_total), 2) . ')';
                                }
                                ?>
                                <tr>
                                    <td style="padding-left: 150px; font-weight: bold;" >TOTAL <?php echo strtoupper($value_sub->name); ?>:</td>

                                    <td style="text-align: right;  border-top:  1px dotted #ccc;  font-weight: bold;" ><?php echo $balance_subaccount_label; ?></td>
                                </tr>  

                            <?php } 
                            $main_account_total_label = 0;
                                if ($main_account_total >= 0) {
                                    $main_account_total_label = number_format($main_account_total, 2);
                                } else {
                                    $main_account_total_label = '(' . number_format((-1 * $main_account_total), 2) . ')';
                                }
                                ?>
                                <tr>
                                    <td style="padding-left: 40px; border-bottom: 1px dotted #ccc; border-top:  1px dotted #ccc; font-weight: bold;" >TOTAL <?php echo strtoupper($value->name); ?>:</td>

                                    <td style="text-align: right; border-bottom: 1px dotted #ccc; border-top:  1px dotted #ccc;  font-weight: bold;" ><?php echo $main_account_total_label; ?></td>
                                </tr>  
                            <tr>
                                <td colspan="2"><br/><br/></td>
                            </tr>
                        <?php } } ?>

                        

                    </tbody>


                </table>
                
                

        </div>
    </div>
</div>
