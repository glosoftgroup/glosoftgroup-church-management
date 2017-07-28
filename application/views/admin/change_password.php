<div class="row-fluid">
    <div class="span10">
        <div class="widget-box centered" style="opacity: 1; z-index: 0;">   
            <div class="widget-header"> <h3>  Change Password </h3>
                <div class="widget-toolbar"> 
                    <a href="#" data-action="collapse"> <i class="icon-chevron-up"></i> </a>
                </div>
            </div>

            <div class="widget-body">    
                <div class="widget-main">

                    <?php echo form_open("admin/change_password", 'class="form-horizontal" '); ?>
                    <div class='control-group'>
                        <label class=' control-label' for='old_password'>Old Password: <span class='required'>*</span></label><div class="controls">
                            <?php echo form_input($old_password); ?>
                            <?php echo form_error('old', '<p class="required">', '</p>'); ?>
                        </div>
                    </div>
                    <div class='control-group'>
                        <label class=' control-label' for='old_password'>New Password (at least <?php echo $min_password_length; ?> characters long): <span class='required'>*</span></label><div class="controls">
                            <?php echo form_input($new_password); ?>
                            <?php echo form_error('new', '<p class="required">', '</p>'); ?>
                        </div>
                    </div>
                    <div class='control-group'>
                        <label class=' control-label' for='new_confirm'>Confirm New Password:<span class='required'>*</span></label>
                        <div class="controls">
                            <?php echo form_input($new_password_confirm); ?>
                            <?php echo form_error('new_confirm', '<p class="required">', '</p>'); ?>
                        </div>
                    </div>
                    <?php echo form_input($user_id); ?>
                    <div class='control-group'><label class="control-label"></label>
                        <div class="controls">
                            <?php echo anchor('admin/', 'Cancel', 'class="btn  btn-small"'); ?>
                            <?php echo form_submit('submit', 'Change', "id='submit' class='btn btn-blue btn-small'"); ?>
                        </div></div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
 
 