

<div class="row">
    <div class="col-lg-12">
        <div style=" margin: auto;">
            <div style="text-align: center;"> 
                <h3 style="margin: 0px; padding: 0px;"><strong>CLASSIFICATION REPORT</strong></h3>
               <br/>
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
                        font-size: 15px;
                    }
                    table.table thead tr th{
                        border-left:  1px solid #000;
                        border-top:   1px solid #000;
                        border-bottom:1px solid #000;
                        font-size: 15px;
                    }
                    
                </style>
                    <table class="table"  cellspacing="0" cellpading="0">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 50px; padding-right: 10px;">S/No</th>  
                                <th style="text-align: left; width: 120px;">Loan ID</th>  
                                <th style="text-align: left; width: 200px;">Name</th>   
                                <th style="text-align: left; width: 150px;">Classification</th> 
                                <th style=" text-align: right; width: 150px; ">Arrears(principle+Interest)</th>      
                                <th style=" text-align: right; width: 150px; ">Provided Amount</th> 
                                <th style=" text-align: right; width: 100px; ">Balance</th> 


                                <th style=" text-align: right; width: 100px; ">Provision %</th> 
                                <th style=" text-align: right; width: 100px; ">Days</th>       
                            </tr>
                        </thead>
                        <tbody>
                            
                              <?php
                            $i = 1;

                            if (count($transaction_rest) > 0) {
                               
                                $arraers_total = 0;
                                $provision_amount = 0;
                                foreach ($transaction_rest as $key => $value) {
                                    $loan_info = $this->loan_model->loan_info($value->LID)->row();
                                    $principal_repay = $this->loan_model->total_amount_repay($value->LID);
                                    $amount_in_arrears = $this->loan_model->total_amount_in_arrears($value->LID);
                                    $check_provision_amount = $this->db->query(" SELECT SUM(credit) as credit,SUM(debit) as debit FROM provision_baddebt_transaction WHERE LID = '$value->LID'")->row();
                                    $previous_amount = 0;
                                    if ($check_provision_amount) {
                                        $previous_amount = $check_provision_amount->credit - $check_provision_amount->debit;
                                    }
                                    $provision_amount+=$previous_amount;
                                    $outstanding_balance = $this->loan_model->total_outstanding_balance($value->LID);
                                    $days = $this->loan_model->provision_days($value->LID);
                                    
                                    ?>
                                    <tr>
                                        <td style="text-align: right;"><?php echo $i++; ?>.</td>
                                        <td style="text-align: left;"><?php echo $value->LID; ?></td>
                                        <td style="text-align: left;"><?php echo $this->member_model->member_name(null,$loan_info->PID) ?></td>
                                        <td style="text-align: left;"><?php echo get_value('provision_rate', 1, 'class')." (".get_value('provision_rate', 1, 'range').")"; ?></td>
                                        <td style="text-align: right;"><?php echo number_format($amount_in_arrears, 2); ?></td> 
                                        <td style="text-align: right;"><?php echo number_format($previous_amount, 2); ?></td> 
                                        <td style="text-align: right;"><?php echo number_format($outstanding_balance, 2); ?></td>
                                        <td style="text-align: right;"><?php echo get_value('provision_rate', 1, 'rate');; ?></td>       
                                        <td style="text-align: right;"><?php echo number_format($days); ?></td>       

                                    </tr>   

                                    <?php
                                }
                                } else { 
                                  $i = 1;  
                                }
                                ?>
                            
                            
                            <?php
                            $i = $i;

                            if (count($transaction) > 0) {
                                      $arraers_total = 0;
                                $provision_amount = 0;
                                foreach ($transaction as $key => $value) {
                                    $loan_info = $this->loan_model->loan_info($value->LID)->row();
                                    $principal_repay = $this->loan_model->total_amount_repay($value->LID);
                                    $amount_in_arrears = $this->loan_model->total_amount_in_arrears($value->LID);
                                    $check_provision_amount = $this->db->query(" SELECT SUM(credit) as credit,SUM(debit) as debit FROM provision_baddebt_transaction WHERE LID = '$value->LID'")->row();
                                    $previous_amount = 0;
                                    if ($check_provision_amount) {
                                        $previous_amount = $check_provision_amount->credit - $check_provision_amount->debit;
                                    }
                                    $provision_amount+=$previous_amount;
                                    $outstanding_balance = $this->loan_model->total_outstanding_balance($value->LID);
                                    ?>
                                    <tr>
                                        <td style="text-align: right;"><?php echo $i++; ?>.</td>
                                        <td style="text-align: left;"><?php echo $value->LID; ?></td>
                                        <td style="text-align: left;"><?php echo $this->member_model->member_name($loan_info->member_id) ?></td>
                                        <td style="text-align: left;"><?php echo get_value('provision_rate', $value->classfication, 'class')." (".get_value('provision_rate', $value->classfication, 'range').")"; ?></td>
                                        <td style="text-align: right;"><?php echo number_format($amount_in_arrears, 2); ?></td> 
                                        <td style="text-align: right;"><?php echo number_format($previous_amount, 2); ?></td> 
                                        <td style="text-align: right;"><?php echo number_format($outstanding_balance, 2); ?></td>
                                        <td style="text-align: right;"><?php echo $value->rate; ?></td>       
                                        <td style="text-align: right;"><?php echo $value->days; ?></td>       

                                    </tr>  

                                    <?php
                                }
                                ?>

                                
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td colspan="11">No data found</td>
                                </tr>
                            <?php } ?>
                        </tbody>


                    </table>
                    
            </div>
        </div>
    </div>
</div>

                