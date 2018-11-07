<?php
$active = ($this->uri->segment(2)) ? $this->uri->segment(2) : 'X';
$activefunction = ($this->uri->segment(3)) ? $this->uri->segment(3) : 'X';
?>
<div class="sidebar-collapse">
    <ul class="nav" id="side-menu">
        <li class="nav-header">
            <div class="dropdown profile-element" style="margin-top: -30px; text-align: center;"> <span>
                    <img alt="image"  src="<?php echo base_url() ?>logo/<?php echo company_info()->logo; ?>" />
                </span>
            </div>
            <div class="logo-element">
                <?php echo lang('inner_company_name'); ?> LOAN MANAGEMENT
            </div>
        </li>
        <li class="<?php echo ($active == 'X' ? 'active' : ''); ?>">
            <a href="<?php echo site_url($this->lang->lang()); ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
        </li>
        <li class="<?php echo ($active == 'calculator' ? 'active' : ''); ?>">
            <a href="<?php echo site_url($this->lang->lang() . '/calculator/index'); ?>"><i class="fa fa-delicious"></i> <span class="nav-label">Loan Calculator</span></a>
        </li>
        <?php
        if(!is_resseller()){
            if (!$this->ion_auth->in_group('Members')) {
                if (access_module(1)) {
                    ?>
                    <li class="<?php echo ($active == 'member' ? 'active' : ''); ?>">
                        <a href="#"><i class="fa fa-user-md"></i> <span class="nav-label"><?php echo lang('members_home'); ?></span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php if (has_role(1, 'Register_new_member')) { ?>
                                <li class="<?php echo ($activefunction == 'new_member' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/member/new_member'); ?>"><?php echo lang('member_registration'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(1, 'View_member_list')) { ?>
                                <li class="<?php echo ($activefunction == 'memberlist' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/member/member_list'); ?>"><?php echo lang('member_list'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(1, 'Manage_member_group')) { ?>
                                <li class="<?php echo ($activefunction == 'add_group' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/member/add_group'); ?>"><?php echo lang('member_add_group'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(1, 'View_member_group')) { ?>
                                <li class="<?php echo ($activefunction == 'member_group_list' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/member/member_group_list'); ?>"><?php echo lang('member_group_list'); ?></a></li>
                            <?php } ?>
                            <!--open-->
                            <?php if (has_role(1, 'View_dhamana_group')) { ?>
                                <li class="<?php echo ($activefunction == 'member_group_list' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/member/create_dhamana'); ?>"><?php echo lang('create_dhamana'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(1, 'View_company_group')) { ?>
                                <li class="<?php echo ($activefunction == 'member_group_list' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/member/create_dhamana'); ?>"><?php echo lang('create_dhamana'); ?></a></li>
                            <?php } ?>
                            <!--closed-->
                        </ul>
                    </li>
                <?php } ?>

                <?php if (access_module(5)) { ?>
                    <li class="<?php echo ($active == 'loan' ? 'active' : ''); ?>">
                        <a href="#"><i class="fa fa-book"></i> <span class="nav-label"><?php echo lang('page_loan'); ?></span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php if (has_role(5, 'View_loan_list')) { ?>
                                <li class="<?php echo ($activefunction == 'loan_viewlist' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/loan/loan_viewlist'); ?>"><?php echo lang('loan_viewlist').' ('.current_new_loan().')'; ?></a></li>
                            <?php } ?>
                            <?php if (has_role(5, 'Create_new_loan')) { ?>
                                <li class="<?php echo ($activefunction == 'loan_application' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/loan/loan_application'); ?>"><?php echo lang('loan_application'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(5, 'Evaluate_loan')) { ?>
                                <li class="<?php echo ($activefunction == 'loan_evaluation' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/loan/loan_evaluation'); ?>"><?php echo lang('loan_evaluation').' ('.current_loan_toevaluate().')'; ?></a></li>
                            <?php } ?>
                            <?php if (has_role(5, 'Approve_loan')) { ?>
                                <li class="<?php echo ($activefunction == 'loan_approval' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/loan/loan_approval'); ?>"><?php echo lang('loan_approval').' ('.current_loan_toapprove().')'; ?></a></li>
                            <?php } ?>
                            <?php if (has_role(5, 'Disburse_loan')) { ?>
                                <li class="<?php echo ($activefunction == 'loan_disbursement' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/loan/loan_disbursement'); ?>"><?php echo lang('loan_disbursement').' ('.current_loan_todisburse().')'; ?></a></li>
                            <?php } ?>
                            <?php if (has_role(5, 'Loan_repayment')) { ?>
                                <li class="<?php echo ($activefunction == 'loan_repayment' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/loan/loan_repayment'); ?>"><?php echo lang('loan_repayment'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(5, 'automatic_repayment_process')) { ?>
                                <!-- <li class="<?php echo ($activefunction == 'automatic_repayment_process' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/loan/automatic_repayment_process'); ?>"><?php echo 'Automatic Loan Repayment'; ?></a></li>-->
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (access_module(6)) { ?>
                    <li class="<?php echo (($active == 'finance' || $active == 'customer' || $active == 'supplier' ) ? 'active' : ''); ?>">
                        <a href="#"><i class="fa fa-dollar"></i> <span class="nav-label"><?php echo lang('page_finance'); ?></span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php if (has_role(6, 'Manage_account_chart')) { ?>
                                <li class="<?php echo ($activefunction == 'finance_account_list' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/finance/finance_account_list'); ?>"><?php echo lang('finance_account_list'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(6, 'Manage_customer')) { ?>
                                <li class="<?php echo ($activefunction == 'customerlist' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/customer/customerlist'); ?>"><?php echo lang('customer'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(6, 'Create_sales_quote')) { ?>
                                <li class="<?php echo ($activefunction == 'customersales_quote_list' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/customer/customersales_quote_list'); ?>"><?php echo lang('customersales_quote'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(6, 'Create_sales_invoice')) { ?>
                                <li class="<?php echo ($activefunction == 'customersales_invoice_list' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/customer/customersales_invoice_list'); ?>"><?php echo lang('customersales_invoice'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(6, 'Manage_supplier')) { ?>
                                <li class="<?php echo ($activefunction == 'supplier_list' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/supplier/supplier_list'); ?>"><?php echo lang('supplier_list'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(6, 'Create_purchase_orders')) { ?>
                                <li class="<?php echo ($activefunction == 'supplier_purchase_order' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/supplier/supplier_purchase_order'); ?>"><?php echo lang('supplier_purchase_order'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(6, 'Create_purchase_invoice')) { ?>
                                <li class="<?php echo ($activefunction == 'supplier_purchase_invoice' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/supplier/supplier_purchase_invoice'); ?>"><?php echo lang('supplier_purchase_invoice'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(6, 'Journal_entry')) { ?>
                                <li class="<?php echo ($activefunction == 'journalentry' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/finance/journalentry'); ?>"><?php echo lang('journalentry'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(6, 'Close_open_year')) { ?>
                                <li class="<?php echo ($activefunction == 'close_open_year' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/finance/close_open_year'); ?>"><?php echo 'Close && Open Year'; ?></a></li>
                            <?php } ?>
                            <?php if (has_role(6, 'Close_open_year')) { ?>
                                <li class="<?php echo ($activefunction == 'close_open_year' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/finance/close_year'); ?>"><?php echo 'Close Year'; ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (access_module(7)) { ?>
                    <li class="<?php echo ((($active == 'report') || ($active == 'report_loan') || ($active == 'report_share') || ($active == 'report_member') || ($active == 'report_saving') || ($active == 'report_contribution')) ? 'active' : ''); ?>">
                        <a href="<?php echo site_url(current_lang() . '/report/index'); ?>"><i class="fa fa-print"></i> <span class="nav-label"><?php echo lang('page_report'); ?></span></a>
                    </li>
                <?php } ?>
                <?php if (access_module(8)) { ?>
                    <li class="<?php echo ($active == 'sms' ? 'active' : ''); ?>">
                        <a href="#"><i class="fa fa-envelope"></i> <span class="nav-label"><?php echo 'Messaging'; ?></span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="<?php echo ($activefunction == 'senderid' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/sms/senderid'); ?>"><?php echo 'Sender ID'; ?></a></li>
                            <li class="<?php echo ($activefunction == 'group_list' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/sms/group_list'); ?>"><?php echo 'Contact Groups'; ?></a></li>
                            <li class="<?php echo ($activefunction == 'contact_list' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/sms/contact_list'); ?>"><?php echo 'Contact List'; ?></a></li>
                            <li class="<?php echo ($activefunction == 'sendSMS' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/sms/sendSMS'); ?>">Send SMS to Group</a></li>
                            <li class="<?php echo ($activefunction == 'loanreminder' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/sms/loanreminder'); ?>">Loan Reminders</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (access_module(9)) { ?>
                    <li class="<?php echo ($active == 'setting' ? 'active' : ''); ?>">
                        <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label"><?php echo lang('setting_account'); ?></span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <!--  <li class="<?php echo ($activefunction == 'client_account' ? 'active' : ''); ?>"><a href="<?php //echo site_url(current_lang() . '/setting/client_account');         ?>"><?php //echo lang('setting_addaccount');         ?></a></li>
                        <li class="<?php echo ($activefunction == 'clientaccount_list' ? 'active' : ''); ?>"><a href="<?php //echo site_url(current_lang() . '/setting/clientaccount_list');         ?>"><?php //echo lang('seting_clientaccountlist');         ?></a></li>-->
                            <?php if (has_role(9, 'Manage_company_information')) { ?>
                                <li class="<?php echo ($activefunction == 'companyinfo_view' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/setting/companyinfo_view'); ?>"><?php echo lang('seting_accountinfo'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(9, 'Manage_sales_purchase_items')) { ?>
                                <li class="<?php echo ($activefunction == 'items_invoice' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/setting/items_invoice'); ?>"><?php echo lang('items_invoice'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(9, 'Manage_tax_code')) { ?>
                                <li class="<?php echo ($activefunction == 'tax_code_list' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/setting/tax_code_list'); ?>"><?php echo lang('tax_code_list'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(9, 'Global_settings')) { ?>
                                <li class="<?php echo ($activefunction == 'global_setting' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/setting/global_setting'); ?>"><?php echo lang('global_setting'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(9, 'Manage_loan_product')) { ?>
                                <li class="<?php echo ($activefunction == 'loan_product_list' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/setting/loan_product_list'); ?>"><?php echo lang('loan_product_list'); ?></a></li>
                            <?php } ?>
                            <li class="<?php echo ($activefunction == 'mobile_notification' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/setting/mobile_notification'); ?>"><?php echo 'Mobile Notification'; ?></a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (access_module(10)) { ?>
                    <li class="<?php echo ($active == 'auth' ? 'active' : ''); ?>">
                        <a href="#"><i class="fa fa-users"></i> <span class="nav-label"><?php echo lang('user_manager'); ?></span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <?php if (has_role(10, 'Create_user_group')) { ?>
                                <li class="<?php echo ($activefunction == 'create_group' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/auth/create_group') ?>"><?php echo lang('create_group_title'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(10, 'View_users_group')) { ?>
                                <li class="<?php echo ($activefunction == 'grouplist' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/auth/grouplist') ?>"><?php echo lang('view_group_list'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(10, 'Create_users')) { ?>
                                <li class="<?php echo ($activefunction == 'create_user' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/auth/create_user') ?>"><?php echo lang('account_creation_new'); ?></a></li>
                            <?php } ?>
                            <?php if (has_role(10, 'View_users')) { ?>
                                <li class="<?php echo ($activefunction == 'index' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/auth/index') ?>"><?php echo lang('user_manager_list'); ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
                <!--                <li class="<?php echo ($active == 'import' ? 'active' : ''); ?>">
                    <a href="#"><i class="fa fa-book"></i> <span class="nav-label"><?php echo 'Data Migration'; ?></span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                            <li class="<?php echo ($activefunction == 'import_member' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/import/import_member') ?>"><?php echo 'Import Member'; ?></a></li>
                            <li class="<?php echo ($activefunction == 'import_contribution' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/import/import_contribution') ?>"><?php echo 'Import Member Contributions'; ?></a></li>
                            <li class="<?php echo ($activefunction == 'import_share' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/import/import_share') ?>"><?php echo 'Import Member Share'; ?></a></li>
                            <li class="<?php echo ($activefunction == 'import_loan' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/import/import_loan') ?>"><?php echo 'Import Loan Information'; ?></a></li>
                            <li class="<?php echo ($activefunction == 'import_repayment' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/import/import_repayment') ?>"><?php echo 'Import Loan Repayment Schedule'; ?></a></li>
                            <li class="<?php echo ($activefunction == 'import_repay_trans' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/import/import_repay_trans') ?>"><?php echo 'Import Loan Repayment Transactions'; ?></a></li>


                    </ul>
                </li>-->

            <?php } else { ?>
                <li class="<?php echo ($active == 'loan' ? 'active' : ''); ?>">
                    <a href="#"><i class="fa fa-book"></i> <span class="nav-label"><?php echo lang('page_loan'); ?></span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="<?php echo ($activefunction == 'loan_viewlist' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/loan/member_loan_list'); ?>"><?php echo lang('loan_viewlist'); ?></a></li>
                        <li class="<?php echo ($activefunction == 'loan_application' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/loan/loan_application'); ?>"><?php echo lang('loan_application'); ?></a></li>
                        <li class="<?php echo ($activefunction == 'loan_guarantor_request' ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/loan/loan_guarantor_request'); ?>"><?php echo 'Loan guarantor request'; ?></a></li>
                    </ul>
                </li>
                <li class="<?php echo ($active == 'report_member' ? 'active' : ''); ?>">
                    <a href="<?php echo site_url($this->lang->lang() . '/report_member/member_profile/?member=' . current_user()->member_id); ?>"><i class="fa fa-user-md"></i> <span class="nav-label">Profile</span></a>
                </li>
                <li class="<?php echo ($active == 'report_contribution' ? 'active' : ''); ?>">
                    <a href="<?php echo site_url($this->lang->lang() . '/report_contribution/contribution_report/2'); ?>"><i class="fa fa-suitcase"></i> <span class="nav-label">Member Contribution</span></a>
                </li>
                <li class="<?php echo ($active == 'report_share' ? 'active' : ''); ?>">
                    <a href="<?php echo site_url($this->lang->lang() . '/report_share/share_report/2'); ?>"><i class="fa fa-share"></i> <span class="nav-label">Member Shares</span></a>
                </li>
                <li class="<?php echo ($activefunction == 'repayment_schedule' ? 'active' : ''); ?>">
                    <a href="<?php echo site_url($this->lang->lang() . '/report_loan/repayment_schedule'); ?>"><i class="fa fa-book"></i> <span class="nav-label">Loan Repayment schedule</span></a>
                </li>
                <li class="<?php echo ($activefunction == 'loan_statement' ? 'active' : ''); ?>">
                    <a href="<?php echo site_url($this->lang->lang() . '/report_loan/loan_statement'); ?>"><i class="fa fa-delicious"></i> <span class="nav-label">Loan Statement</span></a>
                </li>
            <?php }

            //end of not reseller
        }
        ?>
        <?php if (is_resseller()) { ?>
            <li class="<?php echo ($active == 'account' ? 'active' : ''); ?>">
                <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label"><?php echo lang('client_account'); ?></span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php if (is_super_user()) { ?>
                        <li class="<?php echo (($activefunction == 'reseller_account' || $activefunction = 'create_resseller_account' ) ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/account/reseller_account'); ?>"><?php echo lang('reseller_account_list'); ?></a></li>
                    <?php } ?>
                    <li class="<?php echo ($activefunction == 'client_account_create'   ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/account/client_account_create'); ?>"><?php echo lang('myclient_religion_structure'); ?></a></li>
                    <li class="<?php echo (($activefunction == 'myclients_list')  ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/account/myclients_list'); ?>"><?php echo lang('myclients_list'); ?></a></li>
                    <!--<li class="<?php //echo (($activefunction == 'client_account_create' || $activefunction == 'myclients_list' )  ? 'active' : ''); ?>"><a href="<?php echo site_url(current_lang() . '/setting/companyinfo_view'); ?>"><?php echo lang('myclients_list'); ?></a></li>-->
                </ul>
            </li>
        <?php } ?>
        <li class="<?php echo ($active == 'auth' ? 'active' : ''); ?>">
            <a href="<?php echo site_url($this->lang->lang() . '/auth/change_password'); ?>"><i class="fa fa-paw"></i> <span class="nav-label">Change Password</span></a>
        </li>
    </ul>
</div>
