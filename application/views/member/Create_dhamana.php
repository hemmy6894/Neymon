<?php echo form_open_multipart(current_lang() . "/member/create_dhamana.php, 'class="form-horizontal"'); ?>

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
<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('dhamana_name'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input type="text" name="dhamana_name" value="<?php echo set_value('dhamana_name'); ?>"  class="form-control"/>
        <?php echo form_error('dhamana_name'); ?>
    </div>
</div>
<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('dhamana_maelezo'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <textarea  name="dhamana_maelezo" class="form-control"><?php echo set_value('dhamana_maelezo'); ?></textarea>
        <?php echo form_error('dhamana_maelezo'); ?>
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">&nbsp;</label>
    <div class="col-lg-6">
        <input class="btn btn-primary" value="<?php echo lang('member_group_btn'); ?>" type="submit"/>
    </div>
</div>


<?php echo form_close(); ?>
