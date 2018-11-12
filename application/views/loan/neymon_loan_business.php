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
            <?php echo lang('member_member_id') ?> : <?php echo $basicinfo->memberid_type; ?>
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
        <?php echo form_open_multipart(current_lang() . "/loan_3/loan_business/" . $loanid, 'class="form-horizontal"'); ?>

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
                <input type="text" disabled="disabled" value="<?php echo $loaninfo->loan_id; ?>"  class="form-control"/> 

            </div>
        </div>
        
<div class="form-group"><label class="col-lg-4 control-label"><?php echo 'Business Name'; ?>  : <span class="required">*</span></label>
        <div class="col-lg-7">
            <input type="text"  name="business_name" value="<?php echo (isset($businessinfo) ? $businessinfo->business_name : set_value('business_name')); ?>"  class="form-control  "/> 
            <?php echo form_error('business_name'); ?>
        </div>
    </div>
<div class="form-group"><label class="col-lg-4 control-label"><?php echo 'Business Location'; ?>  : <span class="required">*</span></label>
        <div class="col-lg-7">
            <input type="text"  name="business_location" value="<?php echo (isset($businessinfo) ? $businessinfo->business_location : set_value('business_location')); ?>"  class="form-control  "/> 
            <?php echo form_error('business_location'); ?>
        </div>
    </div>
<div class="form-group"><label class="col-lg-4 control-label"><?php echo 'Business Type'; ?>  : <span class="required">*</span></label>
        <div class="col-lg-7">
            <input type="text"  name="business_type" value="<?php echo (isset($businessinfo) ? $businessinfo->business_type : set_value('business_type')); ?>"  class="form-control  "/> 
            <?php echo form_error('business_type'); ?>
        </div>
    </div>
<div class="form-group"><label class="col-lg-4 control-label"><?php echo 'Location Since'; ?>  : <span class="required">*</span></label>
        <div class="col-lg-7">
            <input type="text"  name="business_location_since" value="<?php echo (isset($businessinfo) ? $businessinfo->location_since : set_value('business_location_since')); ?>"  class="form-control  "/> 
            <?php echo form_error('business_location_since'); ?>
        </div>
    </div>
<div class="form-group"><label class="col-lg-4 control-label"><?php echo 'Business Since'; ?>  : <span class="required">*</span></label>
        <div class="col-lg-7">
            <input type="text"  name="business_since" value="<?php echo (isset($businessinfo) ? $businessinfo->business_since : set_value('business_since')); ?>"  class="form-control  "/> 
            <?php echo form_error('business_since'); ?>
        </div>
    </div>
<div class="form-group">
     <div class="col-lg-11">
            Applicant is Tanzania citizen domiciled in the Country ? <input type="radio"   <?php echo (isset($businessinfo) ? ($businessinfo->is_tz_citizen ==1 ? 'checked="checked"' :''): '') ?> value="1" name="is_tz_citizen"/> YES
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"   <?php echo (isset($businessinfo) ? ($businessinfo->is_tz_citizen ==0 ? 'checked="checked"' :''): '') ?> value="0" name="is_tz_citizen"/> NO
     </div>
    <div style="clear: both;"><br/></div>
    
    <?php if($basicinfo->category == "Company"){ ?>
    <div class="col-lg-11">
            Applicant is a government institution ? <input type="radio"   <?php echo (isset($businessinfo) ? ($businessinfo->is_government_institution ==1 ? 'checked="checked"' :''): '') ?> value="1" name="is_government_institution"/> YES
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"   <?php echo (isset($businessinfo) ? ($businessinfo->is_government_institution ==0 ? 'checked="checked"' :''): '') ?> value="0" name="is_government_institution"/> NO
     </div>
    <div style="clear: both;"><br/></div>
    <?php } ?>
        <div class="col-lg-8">
            Applicant is the owner of the business ? <input type="radio" <?php echo (isset($businessinfo) ? ($businessinfo->is_owner ==1 ? 'checked="checked"' :''): '') ?> value="1" name="is_owner"/> YES
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" <?php echo (isset($businessinfo) ? ($businessinfo->is_owner ==0 ? 'checked="checked"' :''): '') ?> value="0" name="is_owner"/> NO
        </div>
        <div class="col-lg-7">
           Business is in Operating area ? <input type="radio" <?php echo (isset($businessinfo) ? ($businessinfo->is_operate ==1 ? 'checked="checked"' :''): '') ?> value="1" name="is_operate"/> YES
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" <?php echo (isset($businessinfo) ? ($businessinfo->is_operate ==0 ? 'checked="checked"' :''): '') ?> value="0" name="is_operate"/> NO
        </div>
    <div style="clear: both;"><br/></div>
    
        <div class="col-lg-8">
            Applicant is currently exercising activity? <input type="radio" <?php echo (isset($businessinfo) ? ($businessinfo->exercising_activity ==1 ? 'checked="checked"' :''): '') ?> value="1" name="exercising_activity"/> YES
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" <?php echo (isset($businessinfo) ? ($businessinfo->exercising_activity ==0 ? 'checked="checked"' :''): '') ?> value="0" name="exercising_activity"/> NO
        </div>
        <div class="col-lg-10">
           ...and is exercising it consecutively for the past 6 months ? <input type="radio" <?php echo (isset($businessinfo) ? ($businessinfo->activity_past6month ==1 ? 'checked="checked"' :''): '') ?> value="1" name="activity_past6month"/> YES
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" <?php echo (isset($businessinfo) ? ($businessinfo->activity_past6month ==0 ? 'checked="checked"' :''): '') ?> value="0" name="activity_past6month"/> NO
        </div>
    <div style="clear: both;"><br/></div>
        <div class="col-lg-8">
            Applicant is a relative or friend of a <?php echo lang('inner_company_name'); ?> employee ?  <input type="radio" <?php echo (isset($businessinfo) ? ($businessinfo->relative_employee ==1 ? 'checked="checked"' :''): '') ?> value="1" name="relative_employee"/> YES
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" <?php echo (isset($businessinfo) ? ($businessinfo->relative_employee ==0 ? 'checked="checked"' :''): '') ?> value="0" name="relative_employee"/> NO
        </div>
        <div class="col-lg-7">
            ...if yes,Employee Name : <input type="text" value="<?php echo (isset($businessinfo) ? $businessinfo->employee_name: '') ?>" name="employee_name" style="width: 300px;" class="form-control"/>
            <?php echo form_error('employee_name'); ?>
        </div>
    <div style="clear: both;"><br/></div>
   
    </div>
            
        

            <?php if ($loaninfo->edited == 1) { ?>

                <div class="form-group">
                    <label class="col-lg-3 control-label">&nbsp;</label>
                    <div class="col-lg-6">
                        <input class="btn btn-primary" value="<?php echo lang('loan_save_btn'); ?>" type="submit"/>
                    </div>
                </div>

            <?php } ?>

            <?php echo form_close(); ?>

            <script src="<?php echo base_url() ?>media/js/script/moment.js"></script>
            <script src="<?php echo base_url() ?>media/js/plugins/datapicker/bootstrap-datepicker.js"></script>
            <script type="text/javascript">
                $(function() {
                    $('#datetimepicker').datetimepicker({
                        pickTime: false
                    });

                });
            </script>




        </div>
    </div>