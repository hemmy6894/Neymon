
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
        <div style=" padding: 5px 5px; text-align: center; margin: auto;">
            <h3 style="margin: 0px; padding: 0px;"><strong>Loan Maturity  Report</strong></h3>
            <h4 style="margin: 0px; padding: 0px;"><strong>Loan Disbursed from <?php echo format_date($reportinfo->fromdate, false); ?> to <?php echo format_date($reportinfo->todate, false); ?></strong></h4>

        </div>
        <div style="padding-top: 5px;">


            <div class="table-responsive" style="overflow: auto;">
                <table class="table table-bordered" cellpadding='0' cellspacing='0'>
                    <thead>
                        <tr>
                            <th style="text-align: center; width: 50px; padding-right: 10px;">S/No</th>  
                            <th style="text-align: left; width: 120px;">Loan ID</th>  
                            <th style="text-align: left; width: 200px;">Name</th>   
                            <th style="text-align: center; width: 100px;">Disburse Date</th>   
                            <th style=" text-align: right; width: 150px; ">Base Amount</th> 
                            <?php
                            $sum_total = array();
                            $header = array();
                            $p = 1;
                            for ($x = 0; $x <= 5; $x++) {
                                $sum_total[$x] = 0;
                                $header[$x] = ($x == 0 ? ($reportinfo->custom * ($p - 1)) : (($reportinfo->custom * ($p - 1)) + 1) ) . ' - ' . ($reportinfo->custom * $p) . ' Days';
                                $p++;
                            }
                            foreach ($header as $key_h1 => $value_h1) {
                                ?>
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
                                        <td style="text-align: right;"><?php echo ($value['step'][$keyxx] > 0 ? number_format($value['step'][$keyxx], 2) : ''); ?></td>           
                                    <?php }
                                    ?>

                                </tr>   

                                <?php
                            }
                            ?>

                            <tr>
                                <td colspan="5" style="text-align: right; font-weight: bold;">Grand Total: </td>
                                <?php foreach ($sum_total as $key_s => $value_s) { ?>
                                    <td style="text-align: right;"><?php echo number_format($value_s, 2); ?></td>
                                <?php }
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

</div>