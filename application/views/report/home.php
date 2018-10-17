<style type="text/css">

    .panel-heading {
        padding: 5px 0px 5px 15px;
    }
    .panel-body {
        padding: 0px;
    }

    div.inside_content{
        display: block;
    }


    div.inside_content a{
        display: block;
        border-bottom: 1px solid #ccc;
        line-height: 30px;
        text-indent: 20px;
        font-size: 13px;
        font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
    }
    div.inside_content a:last-child{
        border-bottom: 0px;  
    }
</style>


<!-- ============================================================================ -->
<div class="row">
    <div class="col-xs-6 ">
        <!-- ==================General Ledger===============================   -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>General Ledger & Financial Statement</h4>
            </div>
            <div class="panel-body">
                <div class="inside_content">
                    <a href="<?php echo site_url(current_lang().'/report/general_leger_transaction/5'); ?>">Balance Sheet</a>
                    <a href="<?php echo site_url(current_lang().'/report/general_leger_transaction/4'); ?>">Income Statement</a>
                    <a href="<?php echo site_url(current_lang().'/report/general_leger_transaction/3'); ?>">Trial Balance</a>
                    <a href="<?php echo site_url(current_lang().'/report/general_leger_transaction/2'); ?>">General Ledger Summary</a>
                    <a href="<?php echo site_url(current_lang().'/report/general_leger_transaction/1'); ?>">General Ledger Transactions</a>
                </div>

            </div>
        </div>
        
        

        
                                <!-- ===================== Contributions===================================== -->
 <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Loans</h4>
            </div>
            <div class="panel-body">
                <div class="inside_content">
                    <a href="<?php echo site_url(current_lang().'/report_loan/loan_report/1'); ?>">Loan List</a>
                    <a href="<?php echo site_url(current_lang().'/report_loan/repayment_schedule'); ?>">Loan Repayment Schedule</a>
                    <a href="<?php echo site_url(current_lang().'/report_loan/loan_statement'); ?>">Loan Statement</a>
                    <a href="<?php echo site_url(current_lang().'/report_loan/loan_statement_custom'); ?>">Loan Statement (Custom)</a>
                    <a href="<?php echo site_url(current_lang().'/report_loan/loan_account_statement'); ?>">Loan Account Statement</a>
                    <a href="<?php echo site_url(current_lang().'/report_loan/loan_report/3'); ?>">Interest & Penalty</a>
                    <a href="<?php echo site_url(current_lang().'/report_loan/loan_report/2'); ?>">Loan Balance</a>
                    <a href="<?php echo site_url(current_lang().'/report_loan/loan_report/6'); ?>">Loan Arrears Report</a>
                    <a href="<?php echo site_url(current_lang().'/report_loan/loan_report/7'); ?>">Maturity Report</a>
                    <a href="<?php echo site_url(current_lang().'/report_loan/loan_classification_view'); ?>">Classification Report</a>
                    <a href="<?php echo site_url(current_lang().'/report_loan/loan_report/4'); ?>">Loan Transaction</a>
                    <a href="<?php echo site_url(current_lang().'/report_loan/loan_report/5'); ?>">Loan Transaction Summary</a>
                    
                    <?php
						$data = site_url(current_lang().'/report_loan/balance_nextinstall');
					?>
					<a  onclick="printJS('<?=$data;?>')">Balance for the Next Installment</a>
					
                    
                </div>

            </div>
        </div>
                
                
                
        
    </div>
    
    
    
    
    <!-- =================================================RIGHT SIDE -============================ -->
    
    <div class="col-xs-5 col-xs-offset-1">
        
        <!-- ===========================Member Reports=============================== -->
        
          <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Clients</h4>
            </div>
            <div class="panel-body">
                <div class="inside_content">
                    <a href="<?php echo site_url(current_lang().'/report_member/member_report_title/1'); ?>">Client List</a>
                    <a href="<?php echo site_url(current_lang().'/report_member/member_profile/'); ?>">Client Profile</a>
                    <a href="<?php echo site_url(current_lang().'/report_member/member_report_title/2'); ?>">Registration Fee Collection</a>
                    
                </div>

            </div>
        </div>
        
        <!-- =======================Journal Transactions============================== -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Journals Transactions</h4>
            </div>
            <div class="panel-body">
                <?php $journal = $this->db->get('journal')->result(); ?>
                <div class="inside_content">
                    <?php foreach ($journal as $key => $value) { ?>
                        <a href="<?php echo site_url(current_lang().'/report/journal_entry/'.$value->id); ?>"><?php echo $value->type; ?></a>
                  <?php  } ?>
                </div>
            </div>
        </div>
        
        
        
        
        
        
        
    </div>
</div>