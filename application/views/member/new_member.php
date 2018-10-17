<!-- Gritter -->
<link href="<?php echo base_url(); ?>media/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<?php echo form_open_multipart(current_lang() . "/member/new_member", 'class="form-horizontal"'); ?>

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
<div class="form-group"  ><label class="col-lg-3 control-label"><?php echo lang('member_category'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <select name="category" class="form-control" onchange="showDiv(this)">
            <option value=""> <?php echo lang('select_default_text'); ?></option>
            <?php
            $loop = lang('member_categoryoption');
            //$selected = set_value('category');
            $selected = "";
            foreach ($loop as $key => $value) {
                ?>
                <option <?php echo ($selected ? ($selected == $key ? 'selected="selected' : '') : ''); ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            <?php }
            ?>
        </select>
        <?php echo form_error('category'); ?>
    </div>
</div>

<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('member_registration_fee'); ?>  : <span class="required"></span></label>
    <div class="col-lg-6">
        <input type="text"  name="fee" value="<?php echo set_value('fee'); ?>"  class="form-control  amountformat"/> 
        <?php echo form_error('fee'); ?>
    </div>
</div>
<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('member_member_id'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input type="text" name="memberid" value="<?php echo set_value('memberid'); ?>"  class="form-control"/> 
        <?php echo form_error('memberid'); ?>
    </div>
</div>

<div class="form-group" id="companyname" style="display:none" ><label class="col-lg-3 control-label"><?php echo lang('companyname'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input type="text" name="companyname" value="<?php echo set_value('firstname'); ?>"  class="form-control"/> 
        <?php echo form_error('companyname'); ?>
    </div>
</div>

<div class="form-group" id="tin" style="display:none"><label class="col-lg-3 control-label"><?php echo lang('member_type_id_tin'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input type="text" name="type_id_tin" value="<?php echo set_value('type_id_tin'); ?>"  class="form-control"/> 
        <?php echo form_error('type_id_tin'); ?>
    </div>
</div>

<div class="form-group" id="certificate_of_incorpation" style="display:none"><label class="col-lg-3 control-label"><?php echo lang('certificate_of_incorpation'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input type="text" name="certificate_of_incorpation" value="<?php echo set_value('certificate_of_incorpation'); ?>"  class="form-control"/> 
        <?php echo form_error('certificate_of_incorpation'); ?>
    </div>
</div>

<div class="form-group" id="firstname"><label class="col-lg-3 control-label"><?php echo lang('member_firstname'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>"  class="form-control"/> 
        <?php echo form_error('firstname'); ?>
    </div>
</div>

<div class="form-group" id="middlename"><label class="col-lg-3 control-label"><?php echo lang('member_middlename'); ?>  :</label>
    <div class="col-lg-6">
        <input type="text" name="middlename" value="<?php echo set_value('middlename'); ?>"  class="form-control"/> 
        <?php echo form_error('middlename'); ?>
    </div>
</div>
<div class="form-group" id="lastname"><label class="col-lg-3 control-label"><?php echo lang('member_lastname'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input type="text" name="lastname" value="<?php echo set_value('lastname'); ?>"  class="form-control"/> 
        <?php echo form_error('lastname'); ?>
    </div>
</div>
<div class="form-group" id="gender" ><label class="col-lg-3 control-label"><?php echo lang('member_gender'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <select name="gender" class="form-control">
            <option value=""> <?php echo lang('select_default_text'); ?></option>
            <?php
            $loop = lang('member_genderoption');
            $selected = set_value('gender');
            foreach ($loop as $key => $value) {
                ?>
                <option <?php echo ($selected ? ($selected == $key ? 'selected="selected' : '') : ''); ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            <?php }
            ?>
        </select>
        <?php echo form_error('gender'); ?>
    </div>
</div>
<div class="form-group" id="maritalstatus"><label class="col-lg-3 control-label"><?php echo lang('member_maritalstatus'); ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <select name="maritalstatus" class="form-control">
            <option value=""> <?php echo lang('select_default_text'); ?></option>
            <?php
            $loop = lang('member_maritalstatus_option');
            $selected = set_value('maritalstatus');
            foreach ($loop as $key => $value) {
                ?>
                <option <?php echo ($selected ? ($selected == $key ? 'selected="selected' : '') : ''); ?> value="<?php echo $key; ?>"> <?php echo $value; ?></option>
            <?php } ?>
        </select>
        <?php echo form_error('maritalstatus'); ?>
    </div>
</div>


<div class="form-group" id="dob"><label class="col-lg-3 control-label"><?php echo lang('member_dob'); ?>  : <span class="required">*</span></label>
    <div class=" col-lg-6">
        <div class="input-group date" id="datetimepicker" >
            <input type="text" name="dob" placeholder="<?php echo lang('hint_date'); ?>" value="<?php echo set_value('dob'); ?>"  data-date-format="DD-MM-YYYY" class="form-control"/> 
            <span class="input-group-addon">
                <span class="fa fa-calendar "></span>
            </span>
        </div>
        <?php echo form_error('dob'); ?>
    </div>
</div>

<div class="form-group" id="doi" style="display:none"><label class="col-lg-3 control-label"><?php echo lang('member_doi'); ?>  : <span class="required">*</span></label>
    <div class=" col-lg-6">
        <div class="input-group date" id="datetimepicker3" >
            <input type="text" name="doi" placeholder="<?php echo lang('hint_date'); ?>" value="<?php echo set_value('doi'); ?>"  data-date-format="DD-MM-YYYY" class="form-control"/> 
            <span class="input-group-addon">
                <span class="fa fa-calendar "></span>
            </span>
        </div>
        <?php echo form_error('doi'); ?>
    </div>
</div>


<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('member_join_date'); ?>  : <span class="required">*</span></label>
    <div class=" col-lg-6">
        <div class="input-group date" id="datetimepicker2" >
            <input type="text" name="joindate" placeholder="<?php echo lang('hint_date'); ?>" value="<?php echo set_value('joindate'); ?>"  data-date-format="DD-MM-YYYY" class="form-control"/> 
            <span class="input-group-addon">
                <span class="fa fa-calendar "></span>
            </span>
        </div>
        <?php echo form_error('joindate'); ?>
    </div>
</div>
<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('member_type_id'); ?>  :</label>
    <div class="col-lg-6">
        <input type="text" name="type_id" value="<?php echo set_value('type_id'); ?>"  class="form-control"/> 
        <?php echo form_error('type_id'); ?>
    </div>
</div>
<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('member_type_id_number'); ?>  :</label>
    <div class="col-lg-6">
        <input type="text" name="type_id_number" value="<?php echo set_value('type_id_number'); ?>"  class="form-control"/> 
        <?php echo form_error('type_id_number'); ?>
    </div>
</div>

<div class="form-group"><label class="col-lg-3 control-label"><?php echo lang('member_photo'); ?>  :  </label>
    <div class="col-lg-6">
        <input type="file" name="file"  class="form-control"> 
        <?php if (isset($logo_error)) {
            echo '<div class="error_message">' . $logo_error . '</div>';
        } ?>
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">&nbsp;</label>
    <div class="col-lg-6">
        <input class="btn btn-primary" value="<?php echo lang('member_addbtn'); ?>" type="submit"/>
    </div>
</div>

<?php echo form_close(); ?>

<script src="<?php echo base_url() ?>media/js/script/moment.js"></script>
<script src="<?php echo base_url() ?>media/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
            pickTime: false
        });
        $('#datetimepicker2').datetimepicker({
            pickTime: false
        });
        
        $('#datetimepicker3').datetimepicker({
            pickTime: false
        });
    });
    
    function showDiv(elem){
                            if(elem.value != "Company"){ 
                               document.getElementById('companyname').style.display = "none";
                               document.getElementById('firstname').style.display = "block";
                               document.getElementById('lastname').style.display = "block";
                               document.getElementById('middlename').style.display = "block";
                               document.getElementById('gender').style.display = "block";
                               document.getElementById('maritalstatus').style.display = "block";
                               document.getElementById('dob').style.display = "block";
                               document.getElementById('doi').style.display = "none";
                               document.getElementById('tin').style.display = "none";
                               document.getElementById('certificate_of_incorpation').style.display = "none";
                               
                           } else {
                               document.getElementById('companyname').style.display = "block";
                               document.getElementById('firstname').style.display = "none";
                               document.getElementById('lastname').style.display = "none";
                               document.getElementById('middlename').style.display = "none";
                               document.getElementById('gender').style.display = "none";
                               document.getElementById('maritalstatus').style.display = "none";
                               document.getElementById('dob').style.display = "none";
                               document.getElementById('doi').style.display = "block";
                               document.getElementById('tin').style.display = "block";
                               document.getElementById('certificate_of_incorpation').style.display = "block";
                               
                           }
                         }
</script>