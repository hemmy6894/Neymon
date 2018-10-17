<link href="<?php echo base_url(); ?>media/css/bootstrap.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>media/js/jquery-1.10.2.js"></script>
<link href="https://printjs-4de6.kxcdn.com/print.min.css" rel="stylesheet">
<div class="container">
	<?php
		$this->load->view('member/view_member');
		$this->load->view('member/view_member_loan');
	?>
</div>