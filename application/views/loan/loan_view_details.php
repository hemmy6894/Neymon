<style type="text/css">
    table tr td{
        line-height: 20px;

    }
</style>

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
    <!-- basic information -->
    <?php $memberinfo = $this->member_model->member_basic_info(null, $loaninfo->PID)->row(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?php echo lang('member_basic_info'); ?></h4>
        </div>
        <div class="panel-body">
            <table>
                <tr>
                    <td><img  style="width: 100px; height: 100px;" src="<?php echo base_url() ?>uploads/memberphoto/<?php echo $memberinfo->photo; ?>"/></td>
                    <td valign='top'><div style="padding-left: 30px;">
                             <?php if($memberinfo->category == "Company"){ ?>
                            <strong><?php echo lang('companyname') ?> : </strong> <?php echo $memberinfo->firstname; ?><br/>
                            <strong><?php echo lang('member_type_id_tin') ?> : </strong> <?php echo $memberinfo->TIN; ?><br/>
                            <strong><?php echo lang('certificate_of_incorpation') ?> : </strong> <?php echo $memberinfo->incorporation_certificate; ?><br/>
                            <strong><?php echo lang('member_doi') ?> : </strong> <?php echo format_date($memberinfo->dob, FALSE); ?><br/>
                           
                             <?php } ?>
                            <?php if($memberinfo->category == "Individual"){ ?>
                            <strong><?php echo lang('member_firstname') ?> : </strong> <?php echo $memberinfo->firstname; ?><br/>
                            <strong><?php echo lang('member_middlename') ?> : </strong> <?php echo $memberinfo->middlename; ?><br/>
                            <strong><?php echo lang('member_lastname') ?> : </strong> <?php echo $memberinfo->lastname; ?><br/>
                            <strong><?php echo lang('member_gender') ?> : </strong> <?php echo $memberinfo->gender; ?><br/>
                            <strong><?php echo lang('member_dob') ?> : </strong> <?php echo format_date($memberinfo->dob, FALSE); ?><br/>
                            <?php } ?>
                        </div></td>
                    <td valign="top"><div style="padding-left: 40px;">
                            <strong><?php echo lang('member_pid') ?> : </strong> <?php echo $memberinfo->PID; ?><br/>
                            <strong><?php echo lang('member_member_id') ?> : </strong> <?php echo $memberinfo->member_id; ?><br/>
                            <strong><?php echo lang('member_join_date') ?> : </strong> <?php echo format_date($memberinfo->joiningdate, FALSE); ?><br/>
                        </div></td>

                    

                </tr>
            </table>
        </div>
    </div>

    <!-- basic loan information -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?php echo lang('loan_info'); ?></h4>
        </div>
        <div class="panel-body">
            <table>
                <tr>
                    <?php
                    $product = $this->setting_model->loanproduct($loaninfo->product_type)->row();
                    $interval = $this->setting_model->intervalinfo($loaninfo->interval)->row();
                    ?>
                    <td valign='top'><div style="padding-left: 30px;">
                            <strong><?php echo lang('loan_product') ?> : </strong> <?php echo $product->name; ?><br/>
                            <strong><?php echo lang('loanproduct_interest') ?> : </strong> <?php echo $loaninfo->rate; ?><br/>
                            <strong><?php echo lang('loan_installment') ?> : </strong> <?php echo $loaninfo->number_istallment . ' ' . $interval->name; ?><br/>
                            <strong><?php echo lang('loan_paysource') ?> : </strong> <?php echo $loaninfo->pay_source; ?><br/>

                        </div></td>
                    <td valign="top"><div style="padding-left: 40px;">
                            <strong><?php echo lang('loan_applicationdate') ?> : </strong> <?php echo format_date($loaninfo->applicationdate, FALSE); ?><br/>
                            <strong><?php echo lang('loan_installment_amount') ?> : </strong> <?php echo number_format($loaninfo->installment_amount, 2); ?><br/>
                            <strong><?php echo lang('loan_total_interest') ?> : </strong> <?php echo number_format($loaninfo->total_interest_amount, 2); ?><br/>
                            <strong><?php echo lang('loan_applied_amount') ?> : </strong> <?php echo number_format($loaninfo->basic_amount, 2); ?><br/>

                        </div></td>
                    <td valign="top"><div style="padding-left: 40px;">
                            <strong><?php echo lang('loan_LID') ?> : </strong> <?php echo $loaninfo->LID; ?><br/>

                            <strong><?php echo lang('loan_total') ?> : </strong> <?php echo number_format($loaninfo->total_loan, 2); ?><br/>

                        </div></td>

                </tr>
            </table>
        </div>
    </div>
  
    
    
    <!-- Business Information-->

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?php echo 'Business Information'; ?></h4>
        </div>
        <div class="panel-body">
            <table>
                <tr>
                    <?php
                    $businessinfo = $this->loan_model->get_loanbusinessinfo($loaninfo->LID);
                    ?>
                    <td valign='top'><div style="padding-left: 40px;">
                            <strong><?php echo 'Business Name' ?> : </strong> <?php echo ($businessinfo ? $businessinfo->business_name : ''); ?><br/>
                            <strong><?php echo 'Business Location' ?> : </strong> <?php echo ($businessinfo ? $businessinfo->business_location : ''); ?><br/>
                            <strong><?php echo 'Business Type' ?> : </strong> <?php echo ($businessinfo ? $businessinfo->business_type : ''); ?><br/>
                            <strong><?php echo 'Location Since' ?> : </strong> <?php echo ($businessinfo ? $businessinfo->location_since: ''); ?><br/>
                            <strong><?php echo 'Business Since' ?> : </strong> <?php echo ($businessinfo ? $businessinfo->business_since : ''); ?><br/>
                            
                        </div></td>
                    <td valign="top"><div style="padding-left: 40px;">
                          Applicant is Tanzania citizen domiciled in the Country ?  <strong><?php echo ($businessinfo ? ($businessinfo->is_tz_citizen == 1 ? 'Yes':'No'): 'N/A'); ?></strong> <br/> 
                          <?php if($memberinfo->category == "Company"){ ?>
                          Applicant is a government institution ?  <strong><?php echo ($businessinfo ? ($businessinfo->is_government_institution == 1 ? 'Yes':'No'): 'N/A'); ?></strong> <br/> 
                          <?php } ?>
                          Applicant is the owner of the business ?  <strong><?php echo ($businessinfo ? ($businessinfo->is_owner == 1 ? 'Yes':'No'): 'N/A'); ?></strong> <br/> 
                          Business is in Operating area ?  <strong><?php echo ($businessinfo ? ($businessinfo->is_operate == 1 ? 'Yes':'No'): 'N/A'); ?></strong> <br/> 
                          Applicant is currently exercising activity?  <strong><?php echo ($businessinfo ? ($businessinfo->exercising_activity == 1 ? 'Yes':'No'): 'N/A'); ?></strong> <br/> 
                          ...and is exercising it consecutively for the past 6 months ?  <strong><?php echo ($businessinfo ? ($businessinfo->activity_past6month == 1 ? 'Yes':'No'): 'N/A'); ?></strong> <br/> 
                          Applicant is a relative or friend of a <?php echo lang('inner_company_name'); ?> employee ?  <strong><?php echo ($businessinfo ? ($businessinfo->relative_employee == 1 ? 'Yes':'No'): 'N/A'); ?></strong> <br/> 
                          ...if yes,Employee Name :  <strong><?php echo ($businessinfo ? $businessinfo->employee_name : ''); ?></strong> <br/> 
                            
                        </div></td>
                    

                </tr>
            </table>
        </div>
    </div>
    
    


    <!-- basic loan information -->
<?php $declaration = $this->loan_model->get_declaration($loaninfo->LID); ?>
<?php $supporting_doc = $this->loan_model->get_supporting_doc($loaninfo->LID); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?php echo lang('loan_info_header'); ?></h4>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                <div class="col-lg-5"> <strong><?php echo lang('loan_security_declaration'); ?></strong> <br/> <?php echo $declaration->declaration; ?></div>
                <div class="col-lg-6"> <strong><?php echo lang('loan_info_sopport'); ?></strong> <br/>
<?php if (count($supporting_doc) > 0) { ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('loan_supporting_document_comment'); ?></th>
                                        <th><?php echo lang('loan_supporting_document_doc'); ?></th>

                                    </tr>

                                </thead>
                                <tbody>
    <?php foreach ($supporting_doc as $key => $value) { ?>

                                        <tr>
                                            <td><?php echo $value->comment; ?></td>
                                            <td><?php echo anchor(base_url() . 'uploads/document/' . $value->file, lang('loan_supporting_document_view')); ?></td>

                                        </tr>
                        <?php } ?>
                                </tbody></table>
                        </div>
                        <?php
                    } else {
                        echo lang('loan_doc_not_found');
                    }
                    ?>


                </div>
            </div>
            <div class="col-lg-12">

                <div style="border-bottom: 1px solid #ccc; margin-bottom: 20px;  font-weight: bold; padding-top: 20px;"><?php echo lang('loan_info_guarantor'); ?></div>



                <?php
                $guarantor_list = $this->loan_model->get_guarantor(null, $loaninfo->LID)->result();
                if (count($guarantor_list) > 0) {
                    ?>
                    <div class="col-lg-12">
    <?php foreach ($guarantor_list as $key => $value) { ?>
                            <div class="col-lg-6" style="float: left;">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                       
                                        <strong>  <?php echo lang('contribution_member_name') ?> :</strong> <?php echo $value->name; ?> <br/>
                                        <strong>  <?php echo 'Mobile' ?> :</strong> <?php echo $value->mobile; ?> <br/>
                                        <strong>  <?php echo 'Email' ?> :</strong> <?php echo $value->email; ?> <br/>
                                        <strong>  <?php echo lang('loan_quarantor_relationship') ?> :</strong> <?php echo $value->relationship; ?> <br/>
                                        <strong> <?php echo lang('loan_quarantor_asset') ?> :</strong> <?php echo $value->declaration; ?> <br>
                                        <strong> <?php echo lang('loan_quarantor_attachment') ?> :</strong> <?php echo ($value->file <> '' ? anchor(base_url() . 'uploads/document/' . $value->file, lang('loan_quarantor_attachment_view')) : ''); ?> <br>

                                        </p>

                                    </div>
                                </div>
                            </div>
                    <?php } ?>
                    </div>

                    <?php
                } else {
                    echo lang('loan_guarantor_not_found');
                }
                ?>






            </div>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?php echo lang('evaluation_comment'); ?></h4>

        </div>
        <div class="panel-body">
            <?php
            $evaluation_histry = $this->loan_model->loan_evaluation_history($loaninfo->LID)->result();
            foreach ($evaluation_histry as $key => $value) {
                ?>
                <div style="border-bottom: 1px solid #ccc; margin-bottom: 20px; <?php echo ($loaninfo->evaluated == $value->status ? 'color:blue' : ''); ?>">
                    <strong><?php echo lang('loan_status'); ?></strong> : <?php echo $value->name; ?><br/>
                    <strong><?php echo lang('loan_comment'); ?></strong> : <?php echo $value->comment; ?><br/>
                    <strong><?php echo lang('loan_recorder'); ?></strong> : <?php echo $value->first_name . ' ' . $value->last_name . ' &nbsp; &nbsp; ' . $value->createdon; ?>
                </div>
<?php } ?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?php echo lang('loan_approval_comment'); ?></h4>

        </div>
        <div class="panel-body">
            <?php
            $evaluation_histry = $this->loan_model->loan_approval_history($loaninfo->LID)->result();
            foreach ($evaluation_histry as $key => $value) {
                ?>
                <div style="border-bottom: 1px solid #ccc; margin-bottom: 20px; <?php echo ($loaninfo->evaluated == $value->status ? 'color:blue' : ''); ?>">
                    <strong><?php echo lang('loan_status'); ?></strong> : <?php echo $value->name; ?><br/>
                    <strong><?php echo lang('loan_comment'); ?></strong> : <?php echo $value->comment; ?><br/>
                    <strong><?php echo lang('loan_recorder'); ?></strong> : <?php echo $value->first_name . ' ' . $value->last_name . ' &nbsp; &nbsp; ' . $value->createdon; ?>
                </div>
<?php } ?>
        </div>
    </div>



    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?php echo lang('loan_disburse_info'); ?></h4>

        </div>
        <div class="panel-body">


            <?php
            $evaluation_histry = $this->loan_model->loan_disburse_history($loaninfo->LID)->result();
            foreach ($evaluation_histry as $key => $value) {
                ?>
                <div style="border-bottom: 1px solid #ccc; margin-bottom: 20px;">
                    <strong><?php echo lang('loan_startrepay_date'); ?></strong> : <?php echo format_date($this->loan_model->loan_disburse_date($loaninfo->LID), false); ?><br/>
                    <strong><?php echo lang('loan_amount_todisburse'); ?></strong> : <?php echo number_format($value->disburseamount, 2); ?><br/>
                    <strong><?php echo lang('loan_startdisburse_date'); ?></strong> : <?php echo format_date($value->disbursedate, false); ?><br/>
                    <strong><?php echo lang('loan_comment'); ?></strong> : <?php echo $value->comment; ?><br/>
                    <strong><?php echo lang('loan_recorder'); ?></strong> : <?php echo $value->first_name . ' ' . $value->last_name . ' &nbsp; &nbsp; ' . $value->createdon; ?>
                </div>
<?php } ?>

        </div>
    </div>


</div>

 <div style="text-align: center">
     <a href="<?php echo site_url(current_lang().'/report_loan/view_indetail_print/'.encode_id($loaninfo->LID)); ?>" class="btn btn-primary">Print</a>
  </div>
