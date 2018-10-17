<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title><?php echo lang('inner_company_name'); ?> | Login</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="<?php echo base_url() ?>login/css/style1.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>login/css/style2.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>login/css/style3.css" rel="stylesheet">

        <style type="text/css">
            div.error_message{
                color: red;
                margin: 0px;
                padding: 0px;
            }
            #hed{
                border-bottom: 4px solid #e7eaec;
                margin-bottom: 30px;
                background-color: #f3f3f4;
            }
            .clear-form .form-body input[type="text"],.clear-form .form-body input[type="password"]{
             margin-bottom : 5px;
             margin-top: 20px;
            } 
            .clear-form .form-heading{
                padding-bottom: 0px;
            }
        </style>
    </head>
    <div id="hed">	
        <div class="container">
            <div class="row">
             <img style=" height: 100px;" src="<?php echo base_url() ?>uploads/final.png"/> 
               
            </div>
        </div>
    </div>


    <div class="block white">
        <div class="container">
            <div class="row">
                <div class="span6">
                    <h4><?php echo lang('inner_company_name'); ?> LOAN MANAGEMENT</h4>
                    <hr/>
                    <ul>
                        <li><?php echo lang('inner_company_name'); ?> Loan Management is an end-to-end information system which enables <?php echo lang('inner_company_name'); ?> in a manner that provides seamless information flow of all  the activities and transactions.</li><br/>
                        <li><?php echo lang('inner_company_name'); ?> Loan Management come with a wide range of financial reports which aid accurate planning, forecast and decision making</li><br/>
                       
                    </ul>
                </div>
                <div class="offset1 span5">
                    <div class="clear-form">                        
                        <?php echo form_open('auth/login'); ?>              
                            <div class="form-heading">
                                <h3>Sign In</h3>                               
                            </div>  
                            <div class="form-body">
                                <?php
                                if (isset($message) && !empty($message)) {
                                    echo '<div class="error_message">' . $message . '</div>';
                                } else if ($this->session->flashdata('message') != '') {
                                    echo '<div class="error_message">' . $this->session->flashdata('message') . '</div>';
                                } else if (isset($warning) && !empty($warning)) {
                                    echo '<div class="error_message">' . $warning . '</div>';
                                } else if ($this->session->flashdata('warning') != '') {
                                    echo '<div class="error_message">' . $this->session->flashdata('warning') . '</div>';
                                }
                                ?>

                                <input type="text" name="identity" class="input-block-level" placeholder="Username">
                                 <?php echo form_error('identity'); ?>
                                <input type="password" name="password" class="input-block-level" placeholder="Password">    
                                <?php echo form_error('password'); ?>
                                <div class="body-split">
                                    <div class="left-col">
                                        <label class="checkbox">
                                            <input type="checkbox" value="remember-me"> Remember me
                                        </label>
                                    </div>
                                    <div class="right-col">                         
                                        <button class="btn btn-blue pull-right" type="submit">Login</button>
                                    </div>
                                </div>                
                            </div>                                 
                            <div class="form-footer">                          
                                <hr/>
                                <p class="center">
                                    <a href="#">Forgot your password?</a>
                                </p>
                            </div>                
                        </form>
                    </div>
                </div>
            </div>
            <div style="border-top : 2px solid #e7eaec; text-align: center; margin-top: 20px; padding-top: 10px;">
                <div id="copyright">© <?php echo date("Y"); ?>&nbsp; &nbsp; <?php echo lang('inner_company_name'); ?> . All right reserved</div>
                <div>
                    <span> Designed and Developed by :</span>
                    <a href="http://datavision.co.tz/" target="_blank"> DATAVISION INTERNATIONAL LTD</a>
                </div>
            </div>
        </div>
    </div>



</body>
</html>
