
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
    }

</style>

<div class="row">
    <div class="col-lg-12">
        <div style=" padding: 4px 1px; margin: auto;">
            <div style="text-align: center;"> 
                <h3 style="margin: 0px; padding: 0px;"><strong>Client Balance for the Next Installment</strong></h3>

            </div>
            <div style="padding-top: 10px;">

                <style type="text/css">

                </style>
                <div class="table-responsive" style="overflow: auto;">
                    <table class="table table-bordered" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 50px; padding-right: 10px;">S/No</th>  
                                <th style="text-align: left; width: 200px;">Loan ID</th>  
                                <th style="text-align: left; width: 300px;">Name</th>   
                                <th style="text-align: left; width: 200px;">Base Amount</th>   
                                <th style=" text-align: right; width: 200px; ">Balance for Next Installment</th>        
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;

                            $basic_amount_total = 0;
                            $balance_total =0;
                            if (count($transaction) > 0) {
                                foreach ($transaction as $key => $value) {
                                    $loan_info = $this->loan_model->loan_info($value->LID)->row();
                                    ?>
                                    <tr>
                                        <td style="text-align: right;"><?php echo $i++; ?>.</td>
                                        <td style="text-align: left;"><?php echo $value->LID; ?></td>
                                        <td style="text-align: left;"><?php echo $this->member_model->member_name($loan_info->member_id) ?></td>
                                        <td style="text-align: right;"><?php echo number_format($loan_info->basic_amount, 2); ?></td>   
                                        <td style="text-align: right;"><?php echo number_format($value->balance, 2); ?></td>       
                                    </tr>   

                                    
                                    <?php
                                    $basic_amount_total+=$loan_info->basic_amount;
                                    $balance_total+=$value->balance;
                                }
                                ?>

                                    <tr>
                                        <td style="text-align: right;" colspan="3"><?php echo "TOTAL"; ?>.</td>
                                         <td style="text-align: right;"><?php echo number_format($basic_amount_total, 2); ?></td>   
                                        <td style="text-align: right;"><?php echo number_format($balance_total, 2); ?></td>       
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

    </div>
</div>