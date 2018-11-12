<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><?php echo lang('loan_LID'); ?></th>
                <th><?php echo lang('member_name'); ?></th>
                <th><?php echo lang('loan_applied_amount'); ?></th>
                <th><?php echo lang('loan_installment'); ?></th>
                <th><?php echo lang('loan_installment_amount'); ?></th>
                <th><?php echo lang('loan_total_interest'); ?></th>
                <th><?php echo lang('index_action_th'); ?></th>

            </tr>

        </thead>
        <tbody>
            <?php if (count($loan_wait) > 0) {
                foreach ($loan_wait as $key => $value) {
                    ?>
            <tr>
                <td><?php echo $value->loan_id;?></td>
                <td style="text-align: center;"><?php 
				//$value->user_id = 1000003;
				if($value->user_id != ""){
                $info = $this->member_model->member_basic_info(null,$value->user_id)->row();
                echo $info->memberid_type.' : '.$info->firstname.' '.$info->middlename.' '.$info->lastname; 
				}
				?></td>
                <td style="text-align: right;"><?php echo number_format($value->loan_amount,2) ?></td>
                <td style="text-align: center;"><?php 
                $interval = $this->setting_model->intervalinfo($value->loan_period)->row();
                echo @$value->loan_period.' '.@$value->loan_period_mark; ?></td>
                <td style="text-align: right;"><?php echo number_format(($value->loan_amount + $value->loan_amount_rate) ,2) ?></td>
                <td style="text-align: right;"><?php echo number_format($value->loan_amount_rate,2) ?></td>
                 <td><?php echo anchor(current_lang() . "/loan_3/loan_evaluation_action/" . encode_id($value->loan_id), ' <i class="fa fa-file"></i> ' . lang('loan_evaluation_link')); ?></td>
            </tr>
                <?php }
                ?>

<?php } ?>
        </tbody>

    </table>
</div>