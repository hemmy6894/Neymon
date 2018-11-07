<?php echo form_open(current_lang() . "/loan_3/view", 'class="form-horizontal"'); ?>

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

							class dataClass{
								public $memberid_type = "";
								public $firstname = "";
								public $middlename = "";
								public $lastname = "";
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
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><?php echo lang('loan_LID'); ?></th>
                <th><?php echo lang('member_name'); ?></th>
                <th><?php echo lang('loan_applied_amount'); ?></th>
                <th><?php echo lang('loan_installment'); ?></th>
                <th><?php echo lang('loan_installment_amount'); ?></th>
                <th><?php echo lang('loan_total_interest'); ?></th>
                <th><?php echo lang('loan_total'); ?></th>
                <th><?php echo lang('loan_status'); ?></th>
                <th><?php echo lang('index_action_th'); ?></th>

            </tr>

        </thead>
        <tbody>
            <?php if (count($loan_list) > 0) {
				//print_r($loan_list);
				
                foreach ($loan_list as $value) {
                    ?>
            <tr>
                <td><?php echo $value->loan_id;?></td>
                <td><?php 
						if($value->user_id != ""){
							$info = $this->member_model->member_basic_info(null,$value->user_id)->row();
						}else{
							$info = new dataClass();//(object)array('member_id' => "",'firstname' => '', 'middlename' => '', 'lastname' => '');
						}
							
							echo $info->memberid_type.'  '.$info->firstname.' '.$info->middlename.' '.$info->lastname; 
						
					?>
				</td>
                <td style="text-align: right;"><?php echo number_format($value->loan_amount,2) ?></td>
                <td style="text-align: center;"><?php 
                //$interval = $this->setting_model->intervalinfo(3)->row();
                echo $value->loan_period.' '. $value->loan_period_mark; ?></td>
                <td style="text-align: right;"><?php echo number_format($value->installment_payed,2) ?></td>
                <td style="text-align: right;"><?php echo number_format($value->loan_amount_rate,2) ?></td>
                <td style="text-align: right;"><?php echo number_format($value->loan_amount_total,2) ?></td>
                <td ><?php echo $value->d_loan_status; ?></td>
                 <td><?php echo anchor(current_lang() . "/loan_3/view_indetail/" . encode_id($value->loan_id), ' <i class="fa fa-folder-open"></i> ' . lang('loan_view_detail'));
                 if($value->edited == 0){
                     echo anchor(current_lang().'/loan/loan_editing/'.encode_id($value->loan_id),' |  <i class="fa fa-edit"></i> ' . lang('button_edit'));
                 }
                 if($value->evaluated == 0){
                 ?>
                     
                 |<a onClick="return pushtoevaluation('<?php echo base_url().'index.php/'.current_lang() . "/loan/push_to_evaluation/".encode_id($value->loan_id) ?>','<?php echo $value->loan_id; ?>' ,'<?php echo '  '.$info->memberid_type.' : '.$info->firstname.' '.$info->middlename.' '.$info->lastname; ?>')" ><i class="fa fa-arrow-right"></i> <?php echo lang('button_pushtoevaluation'); ?> </a>
                 <?php } ?>
                 </td>
            </tr>
            
            <script type="text/javascript">
             function pushtoevaluation(link, l, m)
                        {
                        var answer = confirm('Are you sure you want to forward loan ' + l + ' of member' + m + ' for evaluation process?')
                        if (answer){
                        window.location = link;
                        }
                        return false;
                        }
            </script>
                <?php }
                ?>

<?php } ?>
        </tbody>

    </table>
       <?php echo $links; ?>
    <div style="margin-right: 20px; text-align: right;"> <?php page_selector(); ?></div> 
   
    
</div>