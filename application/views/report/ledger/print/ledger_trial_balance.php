
<div class="row">
    <div class="col-lg-12">
        <div style=" padding: 0px; margin: auto;">
            <div style="text-align: center;">
                <h3 style="margin: 0px; padding: 0px;"><strong>Trial Balance</strong></h3>
                <h4 style="margin: 0px; padding: 0px;"><strong>For the period of  <?php echo format_date($reportinfo->fromdate, false); ?> To <?php echo format_date($reportinfo->todate, false) ?></strong></h4>
            </div>
            <div style="padding-top: 20px;">
                <style type="text/css">
                    table.table{
                        width: 100%;
                        font-size: 15px;
                    }
                    table.table tbody tr td{
                        border: 0px;
                        font-size: 15px;
                        padding-top: 5px;
                        padding-bottom: 5px;
                    }
                    table.table thead tr th{
                        border-bottom: 1px solid #000;
                        padding-left: 10px;
                         font-size: 15px;
                    }
                </style>
               
                <div style="clear: both;"></div>
                
                 <table class="table" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center; width: 400px; ">Account</th>
                            <th style="text-align: right;  width: 200px;"> Opening</th>
                            <th style="text-align: right;  width: 200px;"> Debit</th>
                            <th style="text-align: right;  width: 200px;"> Credit</th>
                            <th style="text-align: right;  width: 200px;"> Closing</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //$account_list = $this->finance_model->account_chart_hiarchy(array(),FALSE);
                        $account_list = $this->finance_model->account_chart_hiarchy(); //show all accounts
                        $total_credit = 0;
                        $total_debit = 0;
                        $opening_balance_total = 0;
                        $closing_balance_total = 0;
                        foreach ($account_list['toplevel'] as $key => $value) {
                            foreach ($account_list['sublevel'][$key] as $key_sub => $value_sub) {
                                ?>

                                <?php
                                foreach ($account_list['account_list'][$key][$key_sub] as $key1 => $value1) {
                                    
                                    
                                                                   
                                    $account_balance = $this->report_model->trial_balance_account($value1->account, $reportinfo->fromdate, $reportinfo->todate, $reportinfo->year);

                                    $closing_balance = 0;
                                    $sub_credit = 0;
                                    $sub_debit = 0;
                                    $open_balance_label = 0;

                                    //$open_balance = $account_balance['balance']; //old                                                                          
                                    $open_balance = $account_balance['openings_amount'];
                                    
                                    
                                    
                                    if($value1->account == '3000002'){ //handling returning earnings
                                        //$from = $year.'-'.'01'.'-'.'01';                 
                                        //$year -=1; 
                                          //$open_balance = 0;
                                         //$open_balance = 0- $account_balance['current']->debit;


                                        }
                                    
                                    

                                    if ($open_balance > 0) {
                                        $open_balance_label = number_format($open_balance, 2);
                                        $closing_balance += $open_balance;
                                        $opening_balance_total+=$open_balance;
                                    } else if ($open_balance < 0) {
                                        $open_balance_label = '(' . number_format((-1 * $open_balance), 2) . ')';
                                        $closing_balance += $open_balance;
                                        $opening_balance_total+=$open_balance;
                                    } else {
                                        $open_balance_label = number_format($open_balance_label, 2);
                                    }


                                    if (count($account_balance['current']) > 0) {                                       
                                       if($value1->account == '3000002' && $reportinfo->year == active_year()){ //handling returning earnings
                                        //$from = $year.'-'.'01'.'-'.'01';                 
                                        //$year -=1; 
                                          $account_balance['current']->credit = 0;
                                          $account_balance['current']->debit = 0;
                                          $closing_balance = $open_balance;
                                         
                                        }
                                        $total_credit += $account_balance['current']->credit;
                                        $total_debit += $account_balance['current']->debit; 
                                        //if($reportinfo->year == active_year()){  
                                         $closing_balance += ($account_balance['current']->credit - $account_balance['current']->debit);
                                     
                                        /*}else {
                                          $closing_balance += $account_balance['closings_amount'];
                                        }*/
                                          }

                                    $closing_balance_total+=$closing_balance;

                                    $closing_balance_label = '';
                                    if ($closing_balance > 0) {
                                        $closing_balance_label = number_format($closing_balance, 2);
                                    } else {
                                        $closing_balance_label = '(' . number_format((-1 * $closing_balance), 2) . ')';
                                    }
                                    ?>
                                    <tr>
                                        <td style="padding-left: 30px;" ><?php echo $value1->account . ' - ' . $value1->name; ?></td>
                                        <td style="text-align: right;" ><?php echo $open_balance_label; ?></td>
                                        <td style="text-align: right;"><?php echo (count($account_balance['current']) > 0 ? ($account_balance['current']->debit > 0 ? number_format($account_balance['current']->debit, 2) : '') : ''); ?></td>
                                        <td style="text-align: right;"><?php echo (count($account_balance['current']) > 0 ? ($account_balance['current']->credit > 0 ? number_format($account_balance['current']->credit, 2) : '') : ''); ?></td>
                                        <td style="text-align: right;" ><?php echo $closing_balance_label; ?></td>
                                    </tr>

                                    <?php
                                }
                            }
                        }

                        $opening_balance_total_label = 0;
                        if ($opening_balance_total > 0) {
                            $opening_balance_total_label = number_format($opening_balance_total, 2);
                        } else if ($opening_balance_total < 0) {
                            $opening_balance_total_label = '(' . number_format((-1 * $opening_balance_total), 2) . ')';
                        }
                        $closing_balance_total_label = 0;
                        if ($closing_balance_total >= 0) {
                            $closing_balance_total_label = number_format($closing_balance_total, 2);
                        } else if ($closing_balance_total < 0) {
                            $closing_balance_total_label = '(' . number_format((-1 * $closing_balance_total), 2) . ')';
                        }
                        ?>

                        <tr>
                            <td style="text-align: right; font-weight: bold;" >Grand Total:</td>
                            <td style="text-align: right; font-weight: bold;" ><?php echo $opening_balance_total_label; ?></td>
                            <td style="text-align: right; font-weight: bold;"><?php echo number_format($total_debit, 2); ?></td>
                            <td style="text-align: right; font-weight: bold;"><?php echo number_format($total_credit, 2); ?></td>

                            <td style="text-align: right; font-weight: bold;" ><?php echo $closing_balance_total_label; ?></td>
                        </tr>
                        
                    </tbody>


                </table>
                
            </div>
        </div>

    </div>
</div>