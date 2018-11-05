<?php
$this->load->view('loan/topmenu');
?>

<div style="margin-top: 20px;" class="col-lg-12">
    
    
     <div class="col-lg-3">
        <img src="<?php echo base_url() ?>uploads/memberphoto/<?php echo $basicinfo->photo; ?>" style="width: 150px; height: 170px; border: 1px solid #ccc;"/>
        <div style="display: block;  margin-top: 20px; font-size: 15px;">
            <?php echo lang('member_pid') ?> : <?php echo $basicinfo->PID; ?>
        </div>
        <div style="display: block;  margin-top: 5px; font-size: 15px;">
            <?php echo lang('member_member_id') ?> : <?php echo $basicinfo->member_id; ?>
        </div>
         <?php if($basicinfo->category == "Company"){ ?>
        <div style="display: block;  margin-top: 5px; font-size: 15px;">
            <?php echo lang('companyname') ?> : <?php echo $basicinfo->firstname; ?>
        </div>
        <div style="display: block;  margin-top: 5px; font-size: 15px;">
            <?php echo lang('member_type_id_tin') ?> : <?php echo $basicinfo->TIN; ?>
        </div>
        <div style="display: block;  margin-top: 5px; font-size: 15px;">
            <?php echo lang('certificate_of_incorpation') ?> : <?php echo $basicinfo->incorporation_certificate; ?>
        </div>
        <?php } ?>
         <?php if($basicinfo->category == "Individual"){ ?>
        <div style="display: block;  margin-top: 5px; font-size: 15px;">
            <?php echo lang('member_firstname') ?> : <?php echo $basicinfo->firstname; ?>
        </div>
        <div style="display: block;  margin-top: 5px; font-size: 15px;">
            <?php echo lang('member_middlename') ?> : <?php echo $basicinfo->middlename; ?>
        </div>
        <div style="display: block;  margin-top: 5px; font-size: 15px;">
            <?php echo lang('member_lastname') ?> : <?php echo $basicinfo->lastname; ?>
        </div>
        <div style="display: block;  margin-top: 5px; font-size: 15px;">
            <?php echo lang('member_gender') ?> : <?php echo $basicinfo->gender; ?>
        </div>
        <?php } ?>
        <br/><br/>
    </div>
    
    



<div class="col-lg-9">
		<link href="<?php echo base_url(); ?>media/css/plugins/datapicker/datepicker3.css" rel="stylesheet"/>
			<?php echo form_open_multipart(current_lang() . "/loan_3/loan_editing/" . $loanid, 'class="form-horizontal"'); ?>
			<div style="color: brown;margin: 20px; font-weight: bold; font-size: 13px; border-bottom: 1px solid #ccc;">
             <?php echo lang('loan_basic_info') ; ?>
            </div>
		
			<div class="form-group"><label class="col-lg-4 control-label"> <?=lang('loan_LID');?>  : <span class="required">*</span> </label>
                <div class="col-lg-7">
                    <input type="text" name="loan_LID" readonly value="<?=@$loaninfo->loan_id; ?>"  id="loan_LID" class="form-control"/>
                    <?php echo form_error('loan_LID'); ?>
                </div>
            </div>
		
		 <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('requested_amount'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-5">
                <input type="text"  name="requested_amount"  value="<?=@$loaninfo->loan_amount; ?>"  class="form-control amountformat"/>
                <?php echo form_error('requested_amount'); ?>
            </div>
			<div class="col-lg-2">
				<select name="rate" class="form-control" >
                    <option value=""> <?php echo lang('select_default_text'); ?></option>
                    <?php
                    $loop = lang('rate_unitoption');
                    $selected = $loaninfo->loan_rate;
                    foreach ($loop as $key => $value) {
						$sel =  ($selected ? ($selected == $key ? 'selected' : '') : '');
                        ?>
                        <option <?php echo $sel; ?> value="<?=$key; ?>"> <?php echo $value; ?></option>
                    <?php }
                    ?>
                </select>
				 <?php echo form_error('rate'); ?>
			</div>
        </div>
		
		<div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_installment'); ?>  : <span class="required">*</span></label>
			<div class="col-lg-4">
				<input type="text" class="form-control" name="installment" id="installment" value="<?=@$loaninfo->loan_period; ?>">
				<?=form_error('installment'); ?>
			</div>
			<div class="col-lg-3">
				<select name="installment_mark" class="form-control" id="installment_mark">
					<option value=""> <?php echo lang('select_default_text'); ?></option>
					<?php
					$selected = $loaninfo->loan_period_mark;
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
                    <input type="text" name="applicationdate" placeholder="<?php echo lang('hint_date'); ?>" value="<?=@$loaninfo->loan_date;?>"  data-date-format="DD-MM-YYYY" class="form-control"/>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar "></span>
                    </span>
                </div>
                <?php echo form_error('applicationdate'); ?>
            </div>
        </div>
		
		<div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('amount_by_word'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                <textarea rows="3" name="amount_by_word" class="form-control" > <?=@$loaninfo->amount_by_word;?> </textarea>
                <?php echo form_error('amount_by_word'); ?>
            </div>
        </div>
		
		<div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_purpose'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                <textarea rows="3" name="purpose" class="form-control" > <?=@$loaninfo->dloan_purpose;?>  </textarea>
                <?php echo form_error('purpose'); ?>
            </div>
        </div>
		
		<div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('grace_period'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-4">
                <input  type="text"  name="grace_period" value="<?=@$loaninfo->grace_period?>"  class="form-control  amountformat" />
                <?php echo form_error('grace_period'); ?>
            </div>
            <div class="col-lg-3">
                <select name="grace_period_unit" class="form-control" >
                    <option value=""> <?php echo lang('select_default_text'); ?></option>
                    <?php
                    $loop = lang('grace_period_unitoption');
                    $selected = @$loaninfo->grace_period_mark;
                    foreach ($loop as $key => $value) {
                        ?>
                        <option <?php echo ($selected ? ($selected == $key ? 'selected="selected' : '') : ''); ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
                    <?php }
                    ?>
                </select>
				<?php echo form_error('grace_period_unit'); ?>
            </div>
        </div>
		 <?php if($loaninfo->edited == 1){ ?>

			<div class="form-group">
				<label class="col-lg-3 control-label">&nbsp;</label>
				<div class="col-lg-6">
					<input class="btn btn-primary" value="<?php echo lang('member_edit_btn'); ?>" type="submit"/>
				</div>
			</div>
			
		 <?php } ?>

    <?php echo form_close(); ?>

    <script src="<?php echo base_url() ?>media/js/script/moment.js"></script>
    <script src="<?php echo base_url() ?>media/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $(function() {
            $('.datetimepicker').datetimepicker({
                pickTime: false
            });

            $("#myCheck").click(function() {
                if($(this).is(":checked")) {
                    $(".hide_existing_loan").show();
                } else {
                    $(".hide_existing_loan").hide();
                }
            });

        });
    </script>




</div>
</div>