
<?php echo form_open_multipart(current_lang() . "/loan_3/loan_application", 'class="form-horizontal"'); ?>
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

		<div style="color: brown;margin: 20px; font-weight: bold; font-size: 13px; border-bottom: 1px solid #ccc;">
            <?php echo lang('loan_basic_info2'); ?>
        </div>
		<div class="form-group">
            <label class="control-label col-lg-4">Search Client</label>
            <div class="col-lg-7">
                <select class="select2_single form-control" tabindex="-1">
                    <option value=""></option>
                </select>
            </div>
        </div>
		
			<div class="form-group"><label class="col-lg-4 control-label"> <?=lang('member_type_id_number');?>  : <span class="required">*</span> </label>
                <div class="col-lg-7">
                    <input type="text" name="member_type_id_number" readonly value="<?php echo set_value('member_type_id_number',''); ?>"  id="member_type_id_number" class="form-control"/>
                    <?php echo form_error('member_type_id_number'); ?>
                </div>
            </div>
			
		<div style="color: brown;margin: 20px; font-weight: bold; font-size: 13px; border-bottom: 1px solid #ccc;">
            <?php echo lang('loan_basic_info'); ?>
        </div>
		
		 <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('requested_amount'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-5">
                <input type="text"  name="requested_amount"  value="<?php echo set_value('requested_amount'); ?>"  class="form-control amountformat"/>
                <?php echo form_error('requested_amount'); ?>
            </div>
			<div class="col-lg-2">
				<select class="form-control" name="rate" required>
					<option >Select Rate</option>
					<option value="10">10</option>
					<option value="20">20</option>
				</select>
				 <?php echo form_error('rate'); ?>
			</div>
        </div>
		
		<div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_installment'); ?>  : <span class="required">*</span></label>
			<div class="col-lg-4">
				<input type="text" class="form-control" name="installment" id="installment" value="<?=set_value('installment');?>">
				<?=form_error('installment'); ?>
			</div>
			<div class="col-lg-3">
				<select name="installment_mark" class="form-control" id="installment_mark">
					<option value=""> <?php echo lang('select_default_text'); ?></option>
					<?php
					$selected = set_value('installment_mark');
					foreach ($loan_interval as $value) {
						?>
						<option <?php echo ($selected ? ($selected == $value->name ? 'selected="selected' : '') : ''); ?> value="<?=$value->name; ?>"> <?=$value->description; ?></option>
					<?php }
					?>
				</select>
				<?php echo form_error('installment_mark'); ?>
			</div>
		</div>
		
		<div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_applicationdate'); ?>  : <span class="required">*</span></label>
            <div class=" col-lg-7">
                <div class="input-group date datetimepicker" id="datetimepicker" >
                    <input type="text" name="applicationdate" placeholder="<?php echo lang('hint_date'); ?>" value="<?php echo set_value('applicationdate'); ?>"  data-date-format="DD-MM-YYYY" class="form-control"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar "></span>
                    </span>
                </div>
                <?php echo form_error('applicationdate'); ?>
            </div>
        </div>
		
		<div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('amount_by_word'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                <textarea rows="3" name="amount_by_word" class="form-control" > <?php echo set_value('amount_by_word'); ?> </textarea>
                <?php echo form_error('amount_by_word'); ?>
            </div>
        </div>
		
		<div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_purpose'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                <textarea rows="3" name="purpose" class="form-control" > <?php echo set_value('purpose'); ?> </textarea>
                <?php echo form_error('purpose'); ?>
            </div>
        </div>
		
		<div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('grace_period'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-4">
                <input  type="text"  name="grace_period" value="<?php echo set_value('grace_period'); ?>"  class="form-control  amountformat" />
                <?php echo form_error('grace_period'); ?>
            </div>
            <div class="col-lg-3">
                <select name="grace_period_unit" class="form-control" >
                    <option value=""> <?php echo lang('select_default_text'); ?></option>
                    <?php
                    $loop = lang('grace_period_unitoption');
                    $selected = set_value('grace_period_unit');
                    foreach ($loop as $key => $value) {
                        ?>
                        <option <?php echo ($selected ? ($selected == $key ? 'selected="selected' : '') : ''); ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
                    <?php }
                    ?>
                </select>
				<?php echo form_error('grace_period_unit'); ?>
            </div>
        </div>
		<div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-6">
                <input class="btn btn-primary" value="<?php echo lang('loan_addbtn'); ?>" type="submit"/>
            </div>
        </div>
    <div class="col-lg-5" id="member_info">
		Infos
    </div>
		
<script type="text/javascript">
    $(document).ready(function() {
        $('.datetimepicker').datetimepicker({
            pickTime: false
        });
	});
	
	$(".select2_single").select2({
            placeholder: "Select a client",
            minimumInputLength: 1,
            ajax: {
                url:"<?php echo site_url(current_lang() . '/saving/search_by_select2'); ?>",
                type: "POST",
                quietMillis: 1000,
                data: function (term) {
                    return {
                        term: term
                    };
                },
                processResults: function (data) {
                    data = $.parseJSON(data);
                    return {
                        results: data
                    };
                }
            },
            sorter: function(data) {
                return data.sort(function (a, b) {
                    if (a.text > b.text) {
                        return 1;
                    }
                    if (a.text < b.text) {
                        return -1;
                    }
                    return 0;
                });
            }
        });
		
		$('.select2_single').on('select2:select', function (e) {
            // Do something
            var selected_element = $(e.currentTarget);
            selectFind(selected_element.val());
        });
		
		function selectFind(data){
			$("#member_type_id_number").val(data);
		}
</script>