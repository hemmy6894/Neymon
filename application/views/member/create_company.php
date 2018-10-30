<?php echo form_open_multipart(current_lang() . "/member/create_company.php, 'class="form-horizontal"'); ?>

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
<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('company_name'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input type="text" name="company_name" value="<?php echo set_value('company_name'); ?>"  class="form-control"/>
        <?php echo form_error('company_name'); ?>
    </div>
</div>
<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('company_slp'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input type="text" name="company_slp" value="<?php echo set_value('company_slp'); ?>"  class="form-control"/>
        <?php echo form_error('company_slp'); ?>
    </div>
</div>
<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('company_city'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input type="text" name="company_city" value="<?php echo set_value('company_city'); ?>"  class="form-control"/>
        <?php echo form_error('company_city'); ?>
    </div>
</div>
<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('company_district'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input type="text" name="company_district" value="<?php echo set_value('company_district'); ?>"  class="form-control"/>
        <?php echo form_error('company_district'); ?>
    </div>
</div>
<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('company_phone'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input type="text" name="company_phone" value="<?php echo set_value('company_phone'); ?>"  class="form-control"/>
        <?php echo form_error('company_phone'); ?>
    </div>
</div>
<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('company_email'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input type="text" name="company_email" value="<?php echo set_value('company_email'); ?>"  class="form-control"/>
        <?php echo form_error('company_email'); ?>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label">&nbsp;</label>
    <div class="col-lg-6">
        <input class="btn btn-primary" value="<?php echo lang('member_group_btn'); ?>" type="submit"/>
    </div>
</div>


<?php echo form_close(); ?>
