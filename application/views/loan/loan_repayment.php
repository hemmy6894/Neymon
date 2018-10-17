<link href="<?php echo base_url(); ?>media/css/choosen/chosen.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>media/css/plugins/datapicker/datepicker3.css" rel="stylesheet"/>
<?php echo form_open_multipart(current_lang() . "/loan/loan_repayment", 'class="form-horizontal"'); ?>
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
<div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_LID'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-7">
        <select name="loanid" class="form-control" id="loanid">
            <option value=""> <?php echo lang('select_default_text'); ?></option>
            <?php
            $selected = set_value('loanid');
            foreach ($loanlist as $key => $value) {
                ?>
                <option <?php echo ($selected ? ($selected == $value->LID ? 'selected="selected' : '') : ''); ?> value="<?php echo $value->LID; ?>"> <?php echo $value->LID . ' - ' . $value->firstname . ' ' . $value->middlename . ' ' . $value->lastname; ?></option>
            <?php }
            ?>
        </select>
        <?php echo form_error('loanid'); ?>
    </div>
</div>
<div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_repay_amount'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-7">
        <input type="text"  name="amount" value="<?php echo set_value('amount'); ?>"  class="form-control  amountformat"/>
        <?php echo form_error('amount'); ?>
    </div>
</div>
<div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_repay_date'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-7">
        <div class="input-group date" id="datetimepicker" >
            <input type="text" name="repaydate" placeholder="<?php echo lang('hint_date'); ?>" value="<?php echo set_value('repaydate'); ?>"  data-date-format="DD-MM-YYYY" class="form-control"/>
            <span class="input-group-addon">
                <span class="fa fa-calendar "></span>
            </span>
        </div>
        <?php echo form_error('repaydate'); ?>
    </div>
</div>
<div class="form-group"><label class="col-lg-4 control-label"><?php echo 'Received in A/C'; ?>  : <span class="required">*</span></label>
    <div class="col-lg-7">
        <select name="received_account" class="form-control">
            <option value=""><?php echo lang('select_default_text'); ?></option>
            <?php
            $selected = set_value('received_account');
            foreach ($account_list2['toplevel'] as $key => $value) {
                foreach ($account_list2['sublevel'][$key] as $key_sub => $value_sub) {
                    ?>
                    <optgroup style="padding-left: 10px;" label="<?php echo $value->name.' - '.$value_sub->name; ?>">
                        <?php foreach ($account_list2['account_list'][$key][$key_sub] as $key1 => $value1) { ?>
                            <option <?php echo ($value1->account == $selected ? 'selected="selected"' : ''); ?> value="<?php echo $value1->account; ?>"><?php echo $value1->name; ?></option>
                        <?php } ?>
                    </optgroup>
                <?php }} ?>
        </select>
        <?php echo form_error('received_account'); ?>
    </div>
</div>
<div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('paymentmethod'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-7">
        <select name="paymenthod" id="paymenthod" class="form-control">
            <option value=""><?php echo lang('select_default_text'); ?></option>
            <?php
            $selected = set_value('paymenthod');
            foreach ($paymenthod as $key => $value) {
                ?>
                <option <?php echo ($value->name == $selected ? 'selected="selected"' : ''); ?> value="<?php echo $value->name; ?>"><?php echo $value->name; ?></option>
            <?php } ?>
        </select>
        <?php echo form_error('paymenthod'); ?>
    </div>
</div>
<div id="chequenumber" class="form-group"><label class="col-lg-4 control-label"><?php echo lang('cheque_no'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-7">
        <input type="text"  name="cheque" value="<?php echo set_value('cheque'); ?>"  class="form-control "/>
        <?php echo form_error('cheque'); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-4 control-label">&nbsp;</label>
    <div class="col-lg-7">
        <input class="btn btn-primary" value="<?php echo lang('loan_repay_btn'); ?>" type="submit"/>
    </div>
</div>
</div>
</div>
<?php echo form_close(); ?>
<script src="<?php echo base_url() ?>media/js/chosen.jquery.js"></script>
<script src="<?php echo base_url() ?>media/js/script/moment.js"></script>
<script src="<?php echo base_url() ?>media/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(function() {
        $('#datetimepicker').datetimepicker({
            pickTime: false
        });
        var config = {
            no_results_text: 'Oops, nothing found!'
        }
        $("#loanid").chosen(config);
    });
    $("#chequenumber").hide();
    var paymenthod = '<?php echo set_value("paymenthod"); ?>';
    if(paymenthod == 'CHEQUE'){
        $("#chequenumber").show();
    }else{
        $("#chequenumber").hide();
    }
    $("#paymenthod").change(function(){
        var val = $(this).val();
        if(val == 'CHEQUE'){
            $("#chequenumber").show();
        }else{
            $("#chequenumber").hide();
        }
    });
</script>