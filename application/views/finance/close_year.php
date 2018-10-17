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
<div style="clear: both;"></div>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Year</th>
            <th>Status</th>
            <th>Closed/Open</th>
            <th>Action</th>
        </tr>

        </thead>
        <tbody>
        <?php $i = 0; ?>
        <?php foreach ($years as $key => $value) { ?>

            <tr>
                <td><?php echo ++$i; ?></td>
                <td><?php echo htmlspecialchars($value->year, ENT_QUOTES, 'UTF-8'); ?></td>
                <td>
                    <span class="label <?php echo $value->status?'label-success':'label-default';?>">
                        <?php echo $value->status?'Current Year':'Previous Year';?>
                    </span>
                </td>
                <td>
                    <span class="label <?php echo $value->closed?'label-danger':'label-primary';?>">
                        <?php echo $value->closed?'Closed Year': 'Open Year';?>
                    </span>
                </td>
                <td>
                    <?php if(!$value->status){ ?>
                    <?php if(!$value->closed){ ?>
                    <a href="<?php echo site_url("finance/close_year/".encode_id($value->id)); ?>">Close</a>
                    <?php } }?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>