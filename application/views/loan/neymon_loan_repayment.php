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
                <option <?php echo ($selected ? ($selected == $value->loan_id ? 'selected="selected' : '') : ''); ?> value="<?php echo $value->loan_id; ?>"> <?php echo $value->loan_id . ' - ' . $value->firstname . ' ' . $value->middlename . ' ' . $value->lastname; ?></option>
            <?php }
            ?>
        </select>
        <?php echo form_error('loanid'); ?>
    </div>
</div>
<br />
<br />
<div id="display_loan_data"></div>

<?php echo form_close(); ?>
<input type="hidden" value="<?=$base_url;?>" id="base_url">
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
	
	$("#loanid").change(function(){
		var loanid = $("#loanid").val();
		var loan_payment = $("#base_url").val() + '/' + loanid;
		//loan_payment = loan_payment;
		//console.log(loan_payment);
		$.ajax(
			{
				url : loan_payment,
				cache : false,
				success : function(response){
					$("#display_loan_data").html(response);
				}
			}
		);
	});
</script>