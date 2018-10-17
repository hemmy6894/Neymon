<script type="text/javascript" src="<?php echo base_url(); ?>media/js/jquery.autocomplete.js" ></script>
<link href="<?php echo base_url(); ?>media/css/select/select2.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>media/css/jquery.autocomplete.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>media/css/plugins/datapicker/datepicker3.css" rel="stylesheet"/>
<?php echo form_open_multipart(current_lang() . "/loan/loan_application", 'class="form-horizontal"'); ?>
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
<div class="col-lg-12">
    <div class="col-lg-7">
        <div class="form-group">
            <label class="control-label col-lg-4">Search Client</label>
            <div class="col-lg-7">
                <select class="select2_single form-control" tabindex="-1">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('member_pid'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                    <?php
                    if (!$this->ion_auth->in_group('Members')) {
                        ?>
                        <input type="text" id="pid"  name="pid" value="<?php echo set_value('pid'); ?>"  class="form-control" readonly="readonly"/>
                    <?php }else{
                        $users = current_user();
                        $member = $this->db->get_where('members',array('member_id'=>$users->member_id))->row();
                        set_value('pid', $member->PID);
                        ?>
                        <input type="text" disabled="disabled" value="<?php echo $member->PID; ?>"  class="form-control"/>
                        <input type="hidden" id="pid"   name="pid" value="<?php echo $member->PID; ?>"  class="form-control"/>
                    <?php } ?>
                <?php echo form_error('pid'); ?>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('member_member_id'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                    <?php
                    if (!$this->ion_auth->in_group('Members')) {
                        ?>
                        <input type="text" id="member_id" name="member_id" value="<?php echo set_value('member_id'); ?>"  class="form-control" readonly="readonly"/>
                    <?php }else{
                        $users = current_user();
                        $member = $this->db->get_where('members',array('member_id'=>$users->member_id))->row();
                        ?>
                        <input type="text" disabled="disabled" value="<?php echo $member->member_id; ?>"  class="form-control"/>
                        <input type="hidden" id="member_id" name="member_id" value="<?php echo $member->member_id; ?>"  class="form-control"/>
                    <?php } ?>
                <?php echo form_error('member_id'); ?>
            </div>
        </div>

        <div class="form-group"><label class="col-lg-4 control-label">Existing Loan: </label>
            <div class="col-lg-7">
                <input type="checkbox" class="flat" name="is_existing_loan" id="myCheck" value="1" <?php if(set_value('is_existing_loan')==1) echo 'checked';?>>
            </div>
        </div>

        <div class="hide_existing_loan" style="display: <?php if(set_value('existing_loan')==1) echo 'block'; else echo 'none';?>">
            <div class="form-group"><label class="col-lg-4 control-label"> Original Amount  : <span class="required">*</span> </label>
                <div class="col-lg-7">
                    <input type="text" name="original_amount" value="<?php echo set_value('original_amount',''); ?>"  class="form-control"/>
                    <?php echo form_error('original_amount'); ?>
                </div>
            </div>

            <div class="form-group"><label class="col-lg-4 control-label">Original Date : <span class="required">*</span></label>
                <div class=" col-lg-7">
                    <div class="input-group date datetimepicker" >
                        <input type="text" name="original_date" placeholder="<?php echo lang('hint_date'); ?>" value="<?php echo set_value('original_date'); ?>"  data-date-format="DD-MM-YYYY" class="form-control"/>
                        <span class="input-group-addon">
                        <span class="fa fa-calendar "></span>
                    </span>
                    </div>
                    <?php echo form_error('original_date'); ?>
                </div>
            </div>
        </div>

        <div style="color: brown;margin: 20px; font-weight: bold; font-size: 13px; border-bottom: 1px solid #ccc;">
            <?php echo lang('loan_basic_info'); ?>
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
        <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_product'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                <select name="product" class="form-control" id="loan_product_id">
                    <option value=""><?php echo lang('select_default_text'); ?></option>
                    <?php
                    $selected = set_value('product');
                    foreach ($loan_product_list as $key => $value) {
                        ?>
                        <option <?php echo ($value->id == $selected ? 'selected="selected"' : ''); ?> value="<?php echo $value->id; ?>"><?php echo $value->name ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('product'); ?>
            </div>
        </div>
        <div  id="interest_rate_id">
        </div>
        <div  id="penalt_percent_id">
        </div>
        <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_applied_amount'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                <input type="text"  name="amount" value="<?php echo set_value('amount'); ?>"  class="form-control  amountformat"/>
                <?php echo form_error('amount'); ?>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('requested_amount'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                <input type="text"  name="requested_amount" value="<?php echo set_value('requested_amount'); ?>"  class="form-control  amountformat"/>
                <?php echo form_error('requested_amount'); ?>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_installment'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                <input type="text"  name="installment" value="<?php echo set_value('installment'); ?>"  class="form-control  amountformat"/>
                <?php echo form_error('installment'); ?>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-4 control-label"><?php echo 'Monthly Income'; ?>  : </label>
            <div class="col-lg-7">
                <input type="text"  name="income" value="<?php echo set_value('income'); ?>"  class="form-control  amountformat"/>
                <?php echo form_error('income'); ?>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_paysource'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                <select name="source" class="form-control">
                    <option value=""><?php echo lang('select_default_text'); ?></option>
                    <?php
                    $selected = set_value('source');
                    foreach ($paysource_list as $key => $value) {
                        ?>
                        <option <?php echo ($value->name == $selected ? 'selected="selected"' : ''); ?> value="<?php echo $value->name; ?>"><?php echo $value->name ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('source'); ?>
            </div>
        </div>

        <div class="form-group"><label class="col-lg-4 control-label"><?php echo 'Loan Processing Fee'; ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                <input type="text"  name="procesingfee" value="<?php echo set_value('procesingfee'); ?>"  class="form-control  amountformat"/>
                <?php echo form_error('procesingfee'); ?>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('grace_period'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-4">
                <input  type="text"  name="grace_period" value="<?php echo set_value('grace_period'); ?>"  class="form-control  amountformat" />
                <?php echo form_error('grace_period_unit'); ?>
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
            </div>
        </div>

        <div class="form-group"><label class="col-lg-4 control-label"><?php echo lang('loan_purpose'); ?>  : <span class="required">*</span></label>
            <div class="col-lg-7">
                <textarea rows="3" name="purpose" class="form-control" > <?php echo set_value('purpose'); ?> </textarea>
                <?php echo form_error('purpose'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-6">
                <input class="btn btn-primary" value="<?php echo lang('loan_addbtn'); ?>" type="submit"/>
            </div>
        </div>
    </div>
    <div class="col-lg-5" id="member_info">
    </div>
</div>
<?php echo form_close(); ?>
<script src="<?php echo base_url() ?>media/js/script/moment.js"></script>
<script src="<?php echo base_url() ?>media/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>media/js/plugins/select/select2.full.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
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

        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        var pid = '<?php echo set_value('pid'); ?>';
        if (pid.length > 0) {
            $('#member_info').html('<?php echo lang("please_wait"); ?>');
            $.ajax({
                url: '<?php echo site_url(current_lang() . '/saving/search_member/'); ?>',
                type: 'POST',
                data: {
                    value: pid,
                    column: 'PID'
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json['success'].toString() == 'N') {
                        $('#member_info').html('<div style="color:red;">' + json['error'].toString() + '</div>');
                    } else {
                        var userdata = json['data'];
                        var contact = json['contact'];
                        $("#member_id").val(userdata["member_id"]);
                        if(userdata["category"] == 'Company'){
                            var output = '<div style="border:1px solid  #ccc;font-size:15px;"><table style="width:100%;"><tr><td style="width:70%;">';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_fullname'); ?> : </strong> ' + userdata["firstname"] + ' ' + userdata["middlename"] + ' ' + userdata["lastname"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_doi'); ?> : </strong> ' + userdata["dob"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_join_date'); ?> : </strong> ' + userdata["joiningdate"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_contact_phone1'); ?> : </strong> ' + contact["phone1"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_contact_phone2'); ?> : </strong> ' + contact["phone2"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_contact_email'); ?> : </strong> ' + contact["email"] + '</div>';
                            output += '</td><td>  <img style=" height:120px;" src="<?php echo base_url(); ?>uploads/memberphoto/' + userdata["photo"].toString() + '"/></td></tr></table>       </div>'
                            $('#member_info').html(output);
                        } else {
                            var output = '<div style="border:1px solid  #ccc;font-size:15px;"><table style="width:100%;"><tr><td style="width:70%;">';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_fullname'); ?> : </strong> ' + userdata["firstname"] + ' ' + userdata["middlename"] + ' ' + userdata["lastname"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_gender'); ?> : </strong> ' + userdata["gender"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_doi'); ?> : </strong> ' + userdata["dob"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_join_date'); ?> : </strong> ' + userdata["joiningdate"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_contact_phone1'); ?> : </strong> ' + contact["phone1"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_contact_phone2'); ?> : </strong> ' + contact["phone2"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_contact_email'); ?> : </strong> ' + contact["email"] + '</div>';
                            output += '</td><td>  <img style=" height:120px;" src="<?php echo base_url(); ?>uploads/memberphoto/' + userdata["photo"].toString() + '"/></td></tr></table>       </div>'
                            $('#member_info').html(output);
                        }
                    }

                },
                error: function(xhr, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });

        }

        $('#loan_product_id').change(function(){
            var loan_product_id = $('#loan_product_id').val();
            if(loan_product_id != '')
            {
                $.ajax({
                    type:'post',
                    url:'<?php echo site_url(current_lang().'/loan/search_interest_rate/'); ?>',
                    data:{id:loan_product_id},
                    cache:false,
                    success: function(returndata){
                        $('#interest_rate_id').html(returndata);
                    }
                });
            }
        });

        $('#loan_product_id').change(function(){
            var loan_product_id = $('#loan_product_id').val();
            if(loan_product_id != '')
            {
                $.ajax({
                    type:'post',
                    url:'<?php echo site_url(current_lang().'/loan/search_penalt_percent/'); ?>',
                    data:{id:loan_product_id},
                    cache:false,
                    success: function(returndata){
                        $('#penalt_percent_id').html(returndata);
                    }
                });
            }
        });
    });

    function selectFind(pid) {
        if (pid.length > 0) {
            $('#member_info').html('<?php echo lang("please_wait"); ?>');
            $.ajax({
                url: '<?php echo site_url(current_lang() . '/saving/search_member/'); ?>',
                type: 'POST',
                data: {
                    value: pid,
                    column: 'PID'
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json['success'].toString() == 'N') {
                        $('#member_info').html('<div style="color:red;">' + json['error'].toString() + '</div>');
                    } else {
                        var userdata = json['data'];
                        var contact = json['contact'];
                        $("#member_id").val(userdata["member_id"]);
                        $("#pid").val(userdata["PID"]);
                        if(userdata["category"] == 'Company'){
                            var output = '<div style="border:1px solid  #ccc;font-size:15px;"><table style="width:100%;"><tr><td style="width:70%;">';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_fullname'); ?> : </strong> ' + userdata["firstname"] + ' ' + userdata["middlename"] + ' ' + userdata["lastname"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_doi'); ?> : </strong> ' + userdata["dob"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_join_date'); ?> : </strong> ' + userdata["joiningdate"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_contact_phone1'); ?> : </strong> ' + contact["phone1"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_contact_phone2'); ?> : </strong> ' + contact["phone2"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_contact_email'); ?> : </strong> ' + contact["email"] + '</div>';
                            output += '</td><td>  <img style=" height:120px;" src="<?php echo base_url(); ?>uploads/memberphoto/' + userdata["photo"].toString() + '"/></td></tr></table>       </div>'
                            $('#member_info').html(output);
                        } else {
                            var output = '<div style="border:1px solid  #ccc;font-size:15px;"><table style="width:100%;"><tr><td style="width:70%;">';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_fullname'); ?> : </strong> ' + userdata["firstname"] + ' ' + userdata["middlename"] + ' ' + userdata["lastname"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_gender'); ?> : </strong> ' + userdata["gender"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_dob'); ?> : </strong> ' + userdata["dob"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_join_date'); ?> : </strong> ' + userdata["joiningdate"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_contact_phone1'); ?> : </strong> ' + contact["phone1"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_contact_phone2'); ?> : </strong> ' + contact["phone2"] + '</div>';
                            output += '<div style="border-bottom:1px dashed #ccc;"><strong><?php echo lang('member_contact_email'); ?> : </strong> ' + contact["email"] + '</div>';
                            output += '</td><td>  <img style=" height:120px;" src="<?php echo base_url(); ?>uploads/memberphoto/' + userdata["photo"].toString() + '"/></td></tr></table>       </div>'
                            $('#member_info').html(output);
                        }
                    }

                },
                error: function(xhr, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });

        } else {
            alert('<?php echo lang("alert_pid"); ?>');
        }
    }
</script>