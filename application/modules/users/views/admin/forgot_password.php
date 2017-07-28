 
<div class="row-fluid">
    <div class="position-relative">

        <div id="forgost-box" class="forgot-box visible widget-box no-border">
            <div class="widget-body">
                <div class="widget-main">
                    <h4 class="header red lighter bigger">
                        <i class="icon-key"></i>
                        Retrieve Password
                    </h4>

                    <div class="space-6"></div>
                    <p>
                        Enter your <?php echo $identity_human; ?>  to receive instructions
                    </p>
                    <?php
                        $str = is_array($message) ? $message['text'] : $message;
                        echo (isset($message) && !empty($message)) ? '<div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="icon-remove"></i>
                </button>
                <strong>   <i class="icon-remove"></i>
                    Oh snap!  </strong>' . $str . '   
            </div>' : '';
                    ?> 

                    <?php echo form_open("admin/forgot_password"); ?>
                    <fieldset>
                        <label>
                            <span class="block input-icon input-icon-right">
                                <input type="email" class="span12" name="email" placeholder="Email" />
                                <i class="icon-envelope"></i>
                            </span>
                        </label>

                        <div class="clearfix">
                            <button   class="width-35 pull-right btn btn-small btn-danger ">
                                <i class="icon-lightbulb"></i>
                                Send Me!
                            </button>
                        </div>
                    </fieldset>

                    <?php echo form_close(); ?>
                </div><!--/widget-main-->

                <div class="toolbar center">
                    <a href="<?php echo base_url('admin/login'); ?>"  class="back-to-login-link">
                        Back to login
                        <i class="icon-arrow-right"></i>
                    </a>
                </div>
            </div><!--/widget-body-->
        </div><!--/forgot-box-->


    </div><!--/position-relative-->
</div>




