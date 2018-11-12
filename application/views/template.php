<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo lang('inner_company_name'); ?> |  <?php echo $current_title; ?></title>
    <link href="<?php echo base_url(); ?>media/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>media/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Morris -->
    <link href="<?php echo base_url(); ?>media/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="<?php echo base_url(); ?>media/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>media/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>media/css/style.css" rel="stylesheet">
    <link href="https://printjs-4de6.kxcdn.com/print.min.css" rel="stylesheet">
    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>media/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url(); ?>media/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>media/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url(); ?>media/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url(); ?>media/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>media/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo base_url(); ?>media/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo base_url(); ?>media/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url(); ?>media/js/plugins/flot/jquery.flot.pie.js"></script>
    <!-- Peity -->
    <script src="<?php echo base_url(); ?>media/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo base_url(); ?>media/js/demo/peity-demo.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>media/js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>media/js/plugins/pace/pace.min.js"></script>
    <!-- jQuery UI -->
    <script src="<?php echo base_url(); ?>media/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- GITTER -->
    <script src="<?php echo base_url(); ?>media/js/plugins/gritter/jquery.gritter.min.js"></script>
    <!-- EayPIE -->
    <script src="<?php echo base_url(); ?>media/js/plugins/easypiechart/jquery.easypiechart.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>media/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url(); ?>media/js/plugins/chartJs/Chart.min.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>media/js/jquery.autocomplete.js" ></script>
	<link href="<?php echo base_url(); ?>media/css/select/select2.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>media/css/jquery.autocomplete.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>media/css/plugins/datapicker/datepicker3.css" rel="stylesheet"/>
		
	<script src="<?php echo base_url() ?>media/js/script/moment.js"></script>
	<script src="<?php echo base_url() ?>media/js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url() ?>media/js/plugins/select/select2.full.js"></script>
    <style type="text/css">
        div#member_info img{
            height: 50px;
            width: 100px;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <?php $this->load->view('menu'); ?>
    </nav>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <?php $this->load->view('header'); ?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2><?php echo (isset ($title) ? $title : $current_title); ?></h2>
                <?php if(!isset ($dashboard)){ ?>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo site_url(current_lang()); ?>"><?php echo lang('home'); ?></a>
                        </li>
                        <li>
                            <a><?php echo $current_title; ?></a>
                        </li>
                        <li class="active">
                            <strong><?php echo (isset ($title) ? $title : $current_title); ?></strong>
                        </li>
                    </ol>
                <?php } ?>
            </div>
            <div class="col-lg-2">
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title"><h3><strong><?php echo (isset ($title) ? $title : $current_title). (isset ($subtitle) ? $subtitle:'');  ?></strong></h3></div>
                        <div class="ibox-content">
                            <div class="row">
                                <?php
                                if (isset($content) && isset($data)) {
                                    $this->load->view($content, $data);
                                } else {
                                    $this->load->view($content);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<footer style="position:absolute;bottom:0px;width:95%">
			<div class="row" >
				<div class="col-lg-12">
					<div class="footer">
						<div class="pull-right">
							<strong><?php echo lang('software_name'); ?></strong>
						</div>
						<div>
							<strong>&copy; NEYMON INVESTMENT LIMITED  <?php echo date('Y'); ?> </strong>
						</div>
					</div>
				</div>
			</div>
		</footer>
    </div>
</div>
<script>
    $(document).ready(function() {
        paceOptions = {
            // Disable the 'elements' source
            elements: false,
            // Only show the progress on regular and ajax-y page navigation,
            // not every request
            restartOnRequestAfter: false
        }
    });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/js/script/script.js"></script>
</body>
</html>
