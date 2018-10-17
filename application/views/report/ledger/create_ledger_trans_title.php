<!-- Gritter -->
<link href="<?php echo base_url(); ?>media/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<?php echo form_open_multipart(current_lang() . "/report/create_ledger_trans_title/".$link_cat.'/'.$id, 'class="form-horizontal"'); ?>
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

<?php  if($link_cat == 1){  ?>
<div class="form-group"><label class="col-lg-3 control-label"><?php echo 'Account Name'; ?>  : <span class="required">*</span></label>
    <div class=" col-lg-6">
        
             <select name="ac" class="form-control">
                    <!--<option value=""><?php //echo lang('select_default_text'); ?></option>-->
                   <?php if (!is_null($id)) { ?>
                 <option value="<?php echo $account_no; ?>"><?php echo $account_name; ?></option>
                   <?php } else { ?>
                    <option value="ALL">ALL</option>                    
                   <?php }
                    $selected = set_value('loan_disburse_account');
                    foreach ($account_list2['toplevel'] as $key => $value) {
                        foreach ($account_list2['sublevel'][$key] as $key_sub => $value_sub) {
                            ?>
                            <optgroup style="padding-left: 10px;" label="<?php echo $value->name . ' - ' . $value_sub->name; ?>">
                                <?php foreach ($account_list2['account_list'][$key][$key_sub] as $key1 => $value1) { ?>
                                    <option <?php echo ($value1->account == $selected ? 'selected="selected"' : ''); ?> value="<?php echo $value1->account; ?>"><?php echo $value1->name; ?></option>
                                <?php } ?>
                            </optgroup>

                        <?php }
                    } ?>
                </select>
       
        <?php echo form_error('ac'); ?>
    </div>
</div>


<?php }  ?>

<div class="form-group"><label class="col-lg-3 control-label"><?php echo 'Financial Year'; ?>  : <span class="required">*</span></label>
    <div class=" col-lg-6">
        
             <select name="year" class="form-control">
                    <!--<option value=""><?php //echo lang('select_default_text'); ?></option>-->
                   <?php if (!is_null($id)) { ?>
                 <option value="<?php echo $reportinfo->year; ?>"><?php echo $reportinfo->year; ?></option>
                   <?php } else { ?>
                 <option value="<?php echo active_year(); ?>"><?php  echo active_year(); ?></option>                    
                   <?php }
                   
                      foreach ($other_years as $key2 => $value2) { ?>
                                    <option  value="<?php echo $value2->year; ?>" <?php echo set_select('year', $value2->year); ?> ><?php echo $value2->year; ?></option>
                                <?php } ?>
                          
                </select>
       
        <?php echo form_error('year'); ?>
    </div>
</div>

<div class="form-group"><label class="col-lg-3 control-label"><?php echo ($link_cat != 5 ? 'From':'Date'); ?>  : <span class="required">*</span></label>
    <div class=" col-lg-6">
        <div class="input-group date" id="datetimepicker" >
            <input type="text" name="fromdate" placeholder="<?php echo lang('hint_date'); ?>" value="<?php echo (isset($reportinfo) ? format_date($reportinfo->fromdate,false) : set_value('fromdate')); ?>"  data-date-format="DD-MM-YYYY" class="form-control"/> 
            <span class="input-group-addon">
                <span class="fa fa-calendar "></span>
            </span>
        </div>
        <?php echo form_error('fromdate'); ?>
    </div>
</div>
<?php if($link_cat != 5){ ?>
<div class="form-group"><label class="col-lg-3 control-label"><?php echo 'Until'; ?>  : <span class="required">*</span></label>
    <div class=" col-lg-6">
        <div class="input-group date" id="datetimepicker2" >
            <input type="text" name="todate" placeholder="<?php echo lang('hint_date'); ?>" value="<?php echo (isset($reportinfo) ? format_date($reportinfo->todate,false) :set_value('todate')); ?>"  data-date-format="DD-MM-YYYY" class="form-control"/> 
            <span class="input-group-addon">
                <span class="fa fa-calendar "></span>
            </span>
        </div>
        <?php echo form_error('todate'); ?>
    </div>
</div>
<?php } ?>



<div class="form-group"><label class="col-lg-3 control-label"><?php echo 'Description'; ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <textarea type="text" name="description" class="form-control"><?php echo (isset($reportinfo) ? $reportinfo->description : set_value('description')); ?> </textarea>
        <?php echo form_error('description'); ?>
    </div>
</div>
<div class="form-group"><label class="col-lg-3 control-label"><?php echo 'Page Orientation'; ?>  : <span class="required">*</span></label>
    <div class="col-lg-6">
        <input name="page" type="radio" <?php echo (isset($reportinfo) ? ($reportinfo->page == 'A4' ? 'checked="checked"':'') : ''); ?> value="A4" class="radio-inline"/> Portrait     
        <input name="page" type="radio" <?php echo (isset($reportinfo) ? ($reportinfo->page == 'A4-L' ? 'checked="checked"':'') : ''); ?> value="A4-L" class="radio-inline"/> Landscape     
        
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">&nbsp;</label>
    <div class="col-lg-6">
        <input class="btn btn-primary" value="<?php echo 'Save Report Information'; ?>" type="submit"/>
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
    });
</script>