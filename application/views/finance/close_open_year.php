<link href="<?php echo base_url(); ?>media/css/choosen/chosen.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>media/css/plugins/datapicker/datepicker3.css" rel="stylesheet"/>

<div class="table-responsive">
  <?php echo form_open_multipart(current_lang() . "/finance/close_open_year/", 'class="form-horizontal"'); ?>

<?php
if (isset($message) && !empty($message)) {
    echo '<div class="label label-info displaymessage">' . $message . '</div>';
} else if ($this->session->flashdata('message') != '') {
    echo '<div class="label label-info displaymessage">' . $this->session->flashdata('message') . '</div>';
} else if (isset($warning) && !empty($warning)) {
    echo '<div class="label label-danger displaymessage">' . $warning . '</div>';
} else if ($this->session->flashdata('warning') != '') {
    echo '<div class="label label-danger displaymessage">' . $this->session->flashdata('warning') . '</div>';
}
?>
    
    <div class="form-group"><label class="col-lg-3 control-label">New Year  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input type="text" name="year" value="<?php echo set_value('year'); ?>"  class="form-control"/> 
        <?php echo form_error('year'); ?>
    </div>
</div>
    <div class="form-group"><label class="col-lg-3 control-label">New Year Start Date : <span class="required">*</span></label>
        <div class="col-lg-6">
        <div class="input-group date" id="datetimepicker" >
            <input type="text" name="date" placeholder="<?php echo lang('hint_date'); ?>" value="<?php echo set_value('date'); ?>"  data-date-format="DD-MM-YYYY" class="form-control"/> 
            <span class="input-group-addon">
                <span class="fa fa-calendar "></span>
            </span>
        </div>
        <?php echo form_error('date'); ?>
    </div>
</div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="width:80px;"><?php echo lang('sno'); ?></th>
                <th><?php echo lang('account_no'); ?></th>
                <th><?php echo lang('finance_account_type'); ?></th>
                <th><?php echo 'Sub Account'; ?></th>
                <th><?php echo lang('finance_account_name'); ?></th>
                <th><?php echo 'Debit' ?></th>
                <th><?php echo 'Credit'; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            if (count($account_chart) > 0) {
                foreach ($account_chart as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $value->account ?></td>
                         <td><?php
                            $account_type = $this->finance_model->account_type(null,$value->account_type)->row();
                            echo $account_type->name
                            ?></td>
                         <td><?php
                            $account_type = $this->finance_model->account_type_sub(null,$value->account_type,$value->sub_account_type)->row();
                            echo $account_type->name
                            ?></td>
                        <td><?php echo $value->name ?></td>
                       
                        <td>
                            <input type="text" name="opening_debit[<?php echo $value->account ?>]" class="form-control input-sm amountformat"/>
                        </td>
                        <td>
                            <input type="text" name="opening_credit[<?php echo $value->account ?>]" class="form-control input-sm amountformat"/>
                        </td>
                    </tr>
                <?php }
            } else {
                ?>

                <tr>
                    <td colspan="7"> <?php echo lang('data_not_found'); ?></td>
                </tr>
<?php } ?>
        </tbody>
    </table>
    
    <div class="form-group">
    <label class="col-lg-3 control-label">&nbsp;</label>
    <div class="col-lg-6">
        <input class="btn btn-primary" value="Open New Year" type="submit"/>
    </div>
</div>


<?php echo form_close(); ?>

</div>

<script src="<?php echo base_url() ?>media/js/script/moment.js"></script>
<script src="<?php echo base_url() ?>media/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<script type="text/javascript">

    $(function() {
        $('#datetimepicker').datetimepicker({
            pickTime: false
        });
        
    });
</script>