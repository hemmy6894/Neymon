<?php echo form_open_multipart(current_lang() . "/calculator/index", 'class="form-horizontal"'); ?>
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
echo validation_errors();
?>
<div class="col-lg-12">
    <div class="form-group">
        <label class="col-lg-2 control-label"><?php echo 'Base Amount'; ?>  : <span class="required">*</span></label>
        <div class="col-lg-2">
            <input type="text"  name="base_amount" value="<?php echo set_value('base_amount'); ?>"  class="form-control amountformat"/>
        </div>
        <label class="col-lg-3 control-label"><?php echo 'Installment Number'; ?>  : <span class="required">*</span></label>
        <div class="col-lg-2">
            <input type="text"  name="install_no" value="<?php echo set_value('install_no'); ?>"  class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 control-label"><?php echo lang('loan_product'); ?>  : <span class="required">*</span></label>
        <div class="col-lg-5">
            <select name="product" class="form-control" id="loan_product_id">
                <option value=""><?php echo lang('select_default_text'); ?></option>
                <?php
                //$selected = set_value('product');
                $selected = "";
                foreach ($loan_product_list as $key => $value) {
                    ?>
                    <option <?php echo ($value->id == $selected ? 'selected="selected"' : ''); ?> value="<?php echo $value->id; ?>"><?php echo $value->name ?></option>
                <?php } ?>
            </select>
            <?php echo form_error('product'); ?>
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div  id="interest_rate_id">
    </div>
</div>
<div class="col-lg-7">
    <label class="col-lg-3 control-label">&nbsp;&nbsp;&nbsp;</label>
    <div class="col-lg-3">
        <input type="submit"  name="submit" value="Calculate"  class="btn btn-primary"/>
    </div>
</div>
<div style="clear: both;"></div>
<?php
if(isset($return_data)){
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Calculator Report</h3>
        </div>
        <div class="panel-body">
            <table>
                <tr>
                    <td style="width: 150px;"><strong>Base Amount</strong> </td>
                    <td style="width: 200px;"><?php echo number_format($return_data['base_amount'],2); ?></td>
                    <td style="width: 150px;"><strong>Installment Number</strong> </td>
                    <td style="width: 200px;"><?php echo number_format($return_data['installment_no']); ?></td>
                </tr>
                <tr>
                    <td style="width: 150px;"><strong>Product Name</strong> </td>
                    <td style="width: 200px;"><?php echo $return_data['product']->name; ?></td>
                    <td style="width: 150px;"><strong>Rate</strong> </td>
                    <td style="width: 200px;"><?php echo $return_data['interest_rate'].'%'; ?></td>
                </tr>
                <tr>
                    <td style="width: 150px;"><strong>Installment Amount</strong> </td>
                    <td style="width: 200px;"><?php echo number_format($return_data['installment_amount'],2); ?></td>
                    <td style="width: 150px;"><strong>Total Interest</strong> </td>
                    <td style="width: 200px;"><?php echo number_format($return_data['interest_amount'],2); ?></td>
                </tr>
                <tr>
                    <td style="width: 150px;"><strong>Total Loan</strong> </td>
                    <td style="width: 200px;"><?php echo number_format(($return_data['base_amount'] + $return_data['interest_amount']),2); ?></td>
                </tr>
            </table>
        </div>
    </div>
    </div>
    <?php
}
?>
<script type="text/javascript">
    $(document).ready(function(){
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
    });
</script>