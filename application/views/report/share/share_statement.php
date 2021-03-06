<div class="row">
    <div class="col-lg-12">
        <div style=" padding: 30px 10px; margin: auto;">
            <div style="text-align: center;"> <h3><strong><?php echo company_info()->name; ?></strong></h3>
                <h1><strong>Member Share Statement</strong></h1>
                <h4><strong>For the period from <?php echo format_date($reportinfo->fromdate, false); ?> to <?php echo format_date($reportinfo->todate, false); ?></strong></h4>
            </div>
            <div style="padding-top: 20px;">
                <style type="text/css">
                    table.table thead tr th{
                        border-bottom-color: #000;
                         vertical-align: bottom !important;
                    }
                    table.table tbody tr td{
                        border: 0px;
                    }
                    table.table tbody tr td.draw_border{
                        border-top: 1px solid #ccc;
                    }
                </style>
                <div style="margin-left: 100px; margin-bottom: 20px;">
                    <strong>Member ID : </strong> <?php echo $reportinfo->description; ?><br/>
                    <strong>Member Name : </strong> <?php echo $this->member_model->member_name($reportinfo->description); ?><br/>
                </div>
                <div class="table-responsive" style="overflow: auto;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 130px;">Date</th>  
                                <th style="width: 300px;">Description</th>  
                                <th style="width: 190px; text-align: right;">Debit [DR]</th>  
                                <th style="width: 190px; text-align: right;">Credit [CR]</th>  
                                <th style="width: 90px; text-align: right; ">No. of Share Affected</th>  
                                <th style="width: 90px; text-align: right;">No. of Share Remain</th>  
                                <th style="width: 190px; text-align: right;">Balance</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $balance = 0;
                            $share_balance = 0;
                            if (count($transaction) > 0) {

                                $balance = $transaction[0]->previous_balance;
                                $share_balance = $transaction[0]->previous_share;
                                ?>
                                <tr>
                                    <td></td>
                                    <td>BROUGHT FORWARD BALANCE</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right;"><?php echo number_format($share_balance, 2); ?></td>
                                    <td style="text-align: right;"><?php echo number_format($balance, 2); ?></td>
                                </tr>
                                <?php
                            }
                            $credit = 0;
                            $debit = 0;
                            foreach ($transaction as $key => $value) {
                                $dt = explode(' ', $value->createdon);
                                if ($value->debit > 0) {
                                    $balance -= $value->debit;
                                    $debit += $value->debit;
                                    $share_balance -= $value->share_no;
                                } else if ($value->credit > 0) {
                                    $balance += $value->credit;
                                    $credit += $value->credit;
                                    $share_balance += $value->share_no;
                                }
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo format_date($dt[0], FALSE); ?></td>
                                    <td><?php echo $value->system_comment . ' [' . $value->paymethod . ']'; ?></td>
                                    <td style="text-align: right;"><?php echo ($value->debit > 0 ? number_format($value->debit, 2) : ''); ?></td>
                                    <td style="text-align: right;"><?php echo ($value->credit > 0 ? number_format($value->credit, 2) : ''); ?></td>
                                    <td style="text-align: right;"><?php echo number_format($value->share_no, 2); ?></td>
                                    <td style="text-align: right;"><?php echo number_format($share_balance, 2); ?></td>
                                    <td style="text-align: right;"><?php echo number_format($balance, 2); ?></td>
                                </tr>
                            <?php }
                            ?>
                            <tr>
                                <td colspan="2" style="border-top: 1px solid #000;border-bottom:  1px solid #000;"></td>
                                <td style="border-top: 1px solid #000;border-bottom:  1px solid #000; text-align: right;"><?php echo number_format($debit, 2); ?></td>
                                <td style="border-top: 1px solid #000;border-bottom:  1px solid #000; text-align: right;"><?php echo number_format($credit, 2); ?></td>
                                <td  style="border-top: 1px solid #000;border-bottom:  1px solid #000;"></td>
                                <td  style="border-top: 1px solid #000;border-bottom:  1px solid #000;"></td>
                                <td  style="border-top: 1px solid #000;border-bottom:  1px solid #000;"></td>
                            </tr>
                        </tbody>


                    </table>
                    <div style="text-align: right; font-size: 15px; font-weight: bold;"> Amount Remain for the next transaction : <?php 
                    $remain_amount = $this->db->get_where('members_share',array('member_id'=>$reportinfo->description))->row();
                    $remain_amount_data = (count($remain_amount) > 0 ? $remain_amount->remainbalance : 0);
                    echo number_format($remain_amount_data, 2); ?></div>
                    <div style="text-align: right; font-size: 25px; font-weight: bold;"> Balance : <?php echo number_format($balance, 2); ?></div>
                </div>
                <div style="text-align: center">
					<?php
						$this->load->view('report/printer');
						$data = site_url(current_lang() . '/report_share/share_statement_print/' . $link_cat . '/' . $id);
						printingJavaScript($data)
					?>
					&nbsp; &nbsp; &nbsp; &nbsp;
                    <a href="<?php echo site_url(current_lang() . '/report_share/create_share_report_title/' . $link_cat . '/' . $id); ?>" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
