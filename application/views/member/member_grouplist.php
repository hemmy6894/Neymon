<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="width:80px;"><?php echo lang('sno'); ?></th>
                <th><?php echo lang('group_id'); ?></th>
                <th><?php echo lang('company_name'); ?></th>
                <th><?php echo lang('company_slp'); ?></th>
                <th><?php echo lang('company_city'); ?></th>
                <th><?php echo lang('company_district'); ?></th>
                <th><?php echo lang('company_ward'); ?></th>
                <th><?php echo lang('company_street'); ?></th>
                <th><?php echo lang('company_phone'); ?></th>
                <th><?php echo lang('company_email'); ?></th>
                <th><?php echo lang('actioncolumn'); ?></th>
            </tr>
        </thead>
        <tbody>
           <?php
           $i=1;
           foreach ($grouplist as $key => $value) { ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $value->GID ?></td>
                <td><?php echo $value->company_name ?></td>
                <td><?php echo $value->company_slp ?></td>
                <td><?php echo $value->company_city ?></td>
                <td><?php echo $value->company_distrit ?></td>
                <td><?php echo $value->company_ward ?></td>
                <td><?php echo $value->company_street ?></td>
                <td><?php echo $value->company_phone ?></td>
                <td><?php echo $value->company_email ?></td>
                <td><a href="<?php echo site_url(current_lang().'/member/member_group_edit/'.encode_id($value->id)); ?>"><i class="fa fa-edit"></i> <?php echo lang('button_edit'); ?> </a></td>
            </tr>
           <?php }
           ?>
        </tbody>
    </table>

</div>