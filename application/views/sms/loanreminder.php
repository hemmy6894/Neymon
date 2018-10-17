
<?php echo form_open(current_lang() . "/sms/loanreminder", 'class="form-horizontal"'); ?>

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

<div class="form-group col-lg-10">

    <div class="col-lg-5">
        <input type="text" class="form-control" name="key" value="<?php echo (isset($_GET['key']) ? $_GET['key'] : ''); ?>"/> 
    </div>
    <div class="col-lg-2">
        <input type="submit" value="<?php echo lang('button_search'); ?>" class="btn btn-primary"/>
    </div>

</div>


<?php echo form_close(); ?>
</div>


<div class="table-responsive" style="overflow: auto;">
   
    <table class="table table-bordered table-striped">
        <thead>
           
            <tr>
                <th style="width: 50px;"><?php echo lang('sno'); ?></th>
                <th>Message ID</th>
                <th>Sender ID</th>
                <th>Recipient</th>
                <th>Message</th>
                <th style="width: 140px;">Date</th>
                <th>Status</th>
                
            </tr>

        </thead>
        <tbody>
            <?php
            $i= $serial + 1;
            if(count($loanreminders) > 0){
                foreach ($loanreminders as $key => $value) { ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $value->message_id; ?></td>
                <td><?php echo $value->sender; ?></td>
                <td><?php if($value->media == 'EMAIL'){ echo $value->email; } else { echo $value->mobile; } ?></td>
                <td><?php echo $value->message; ?></td>
                <td><?php echo $value->date; ?></td>
                <td><?php echo $value->delivery_status; ?></td>
                
            </tr>
               <?php }
            }else{
            ?>
            <tr>
                <td colspan="3">No data found !</td>
            </tr>
            <?php } ?>
        </tbody>
        
    </table>
     <?php echo $links; ?>
    <div style="margin-right: 20px; text-align: right;"> <?php page_selector(); ?></div>    

</div>