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

        <link href="<?php echo base_url(); ?>media/css/choosen/chosen.css" rel="stylesheet">

        <?php echo form_open_multipart(current_lang() . "/loan/loan_guarantor/" . $loanid, 'class="form-horizontal"'); ?>

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
                <input type="text" disabled="disabled" value="<?php echo $loaninfo->LID; ?>"  class="form-control"/> 

            </div>
        </div>
        
        <?php
        if(count($guarantor_list) > 0){ ?>
        <div class="col-lg-12">
        <?php
            foreach ($guarantor_list as $key => $value) { ?>
            <div class="col-lg-6" style="float: left;">
                 <div class="panel panel-default">
            <div class="panel-heading">
                <h4><?php
                  
                    echo $value->name;
                    ?></h4>
            </div>
            <div class="panel-body">
                <p>
                    <strong>  <?php echo lang('loan_quarantor_relationship')?> :</strong> <?php echo $value->relationship; ?> <br/>
                    <strong>  <?php echo 'Mobile';?> :</strong> <?php echo $value->mobile; ?> <br/>
                    <strong>  <?php echo 'Email';?> :</strong> <?php echo $value->email; ?> <br/>
                    <strong> <?php echo lang('loan_quarantor_asset')?> :</strong> <?php echo $value->declaration; ?> <br>
                    <strong> <?php echo lang('loan_quarantor_attachment')?> :</strong> <?php echo ($value->file <> '' ? anchor(base_url().'uploads/document/'.$value->file,  lang('loan_quarantor_attachment_view')):''); ?> <br>
                   <?php
                   if($value->photo <> ''){ ?>
                    Guarantor Photo:
                    <img style="width: 80px; height: 80px;" src="<?php echo base_url(); ?>uploads/guarantor/<?php echo $value->photo; ?>"/>  
                 <?php  }
                   ?>
                </p>
                <?php if ($loaninfo->edit == 0) { ?>
                <div style="text-align: right;"><?php echo anchor(current_lang().'/loan/remove_guarantor/'.$loanid.'/'.$value->id,  lang('loan_supporting_document_remove')); ?></div>
                <?php } ?>
            </div>
        </div>
            </div>
          <?php  } ?>
        </div>
         <div style="color: brown; border-bottom: 1px solid #ccc; font-size: 15px; padding-top: 10px;  font-weight: bold">
                <?php echo lang('loan_quarantor'); ?>
            </div>
            <br/>
        <?php } ?>
        
        
        
        <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_quarantor_name'); ?>  : <span class="required">*</span></label>

            <div class="col-lg-7">
                <?php
                $selected = set_value('customerid');
                ?>
                <input name="customerid" type="text"  value="<?php echo set_value('customerid'); ?>"  class="form-control"/> 
                
                <?php echo form_error('customerid'); ?>
            </div>
        </div>
        
        <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_quarantor_relationship'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                <input name="relationship" type="text"  value="<?php echo set_value('relationship'); ?>"  class="form-control"/> 
                <?php echo form_error('relationship'); ?>
            </div>
        </div>
             <div class="form-group"><label class="col-lg-4 control-label"><?php echo 'Mobile Number'; ?>  : <span class="required">*</span></label>

            <div class="col-lg-7">
                <?php
                $selected = set_value('mobile');
                ?>
                <input name="mobile" type="text"  value="<?php echo set_value('mobile'); ?>" placeholder="e.g 255712765538"  class="form-control"/> 
                
                <?php echo form_error('mobile'); ?>
            </div>
        </div>
             <div class="form-group"><label class="col-lg-4 control-label"><?php echo 'Email'; ?>  : </label>

            <div class="col-lg-7">
                <input name="email" type="text"  value="<?php echo set_value('email'); ?>"  class="form-control"/> 
                
                <?php echo form_error('email'); ?>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_quarantor_asset'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                <textarea name="asset" class="form-control"><?php echo set_value('asset'); ?></textarea>
                <?php echo form_error('asset'); ?>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_quarantor_declaration'); ?>  : </label>
            <div class="col-lg-7">
                <input name="file" type="file" class="form-control" />
                <?php
                if (isset($logo_error)) {
                    echo '<div class="error_message">' . $logo_error . '</div>';
                }
                ?>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-4 control-label"><?php echo 'Photo'; ?>  : </label>
            <div class="col-lg-7">
                <input name="photo" type="file" class="form-control" />
                <?php
                if (isset($logo_error1)) {
                    echo '<div class="error_message">' . $logo_error1 . '</div>';
                }
                ?>
            </div>
        </div>
<?php  if ($loaninfo->edit == 0) { ?>

            <div class="form-group">
                <label class="col-lg-3 control-label">&nbsp;</label>
                <div class="col-lg-6">
                    <input class="btn btn-primary" value="<?php echo lang('loan_save_btn'); ?>" type="submit"/>
                </div>
            </div>

        <?php } ?>

        <?php echo form_close(); ?>






    </div>
</div>
<script src="<?php echo base_url() ?>media/js/chosen.jquery.js"></script>
<script type="text/javascript">
    var config = {
        no_results_text: 'Oops, nothing found!'
    }
    $("#customerid").chosen(config);

</script>