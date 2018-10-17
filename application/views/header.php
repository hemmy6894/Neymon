<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <div style="float: left;">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            </div>
            <div style="float: left; margin-left: 20px; ">

            </div>
            <div style="clear: both;"></div>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <!--<li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <div class="dropdown-messages-box">

                            <a href="profile.html" class="pull-left">
                                <img alt="image" class="img-circle" src="img/a7.jpg">
                            </a>
                            <div class="media-body">
                                <small class="pull-right">46h ago</small>
                                <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="dropdown-messages-box">
                            <a href="profile.html" class="pull-left">
                                <img alt="image" class="img-circle" src="img/a4.jpg">
                            </a>
                            <div class="media-body ">
                                <small class="pull-right text-navy">5h ago</small>
                                <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="dropdown-messages-box">
                            <a href="profile.html" class="pull-left">
                                <img alt="image" class="img-circle" src="img/profile.jpg">
                            </a>
                            <div class="media-body ">
                                <small class="pull-right">23h ago</small>
                                <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="mailbox.html">
                                <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>-->
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" style="color: #ffffff;background: #1ABB9C">
                    <i class="fa fa-calendar"></i> <?php echo active_year() ?>
                </a>
                <ul class="dropdown-menu">
                    <?php
                    $financial_years = $this->finance_model->financial_years();
                    $selectedFY = set_value('financial_year');
                    foreach ($financial_years as $key => $value) {?>
                        <li>
                            <a href="<?php echo site_url("current_year/change_to/".encode_id($value->id)); ?>"><?php echo $value->year; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <li>
                <a href="<?php echo site_url('auth/logout'); ?>">
                    <i class="fa fa-sign-out"></i> <?php echo  lang('logout'); ?>
                </a>
            </li>
        </ul>
    </nav>

    <div style="text-align: right; width: 70%; float: right;margin-right: 50px;">
        <?php
        $all_lang = $this->lang->get_all_languages();
        foreach ($all_lang as $key => $value) {
            echo anchor($this->lang->switch_uri($key), ucwords($value)) . '&nbsp; &nbsp; | &nbsp; &nbsp;';
        }
        ?>
    </div>
</div>