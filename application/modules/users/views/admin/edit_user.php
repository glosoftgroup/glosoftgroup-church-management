<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Users</h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/users/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'User')) . '</span>', 'class="btn btn-primary"'); ?> 

                    <?php echo anchor('admin/users', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Users')) . '</span>', 'class="btn btn-info"'); ?> 


                </div>
            </div>
        </div> 
        <div class="panel-body" style="display: block;">   
            <div class='clearfix'></div>		

            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open_multipart(current_url(), $attributes);
            ?>
            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='first_name'>First Name <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                     <?php echo form_input($first_name, '', 'class="form-control"'); ?>
                     <?php echo form_error('first_name', '<p class="required">', '</p>'); ?>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='last_name'>Last Name <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                     <?php echo form_input($last_name, '', 'class="form-control"'); ?>
                     <?php echo form_error('last_name', '<p class="required">', '</p>'); ?>
                </div>
            </div>
            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='email'>Email <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                     <?php echo form_input($email, '', 'class="form-control"'); ?>
                     <?php echo form_error('email', '<p class="required">', '</p>'); ?>
                </div>
            </div>
            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='email'>Phone <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                     <?php echo form_input($phone, '', 'class="form-control input-mask-phone"'); ?>
                     <?php echo form_error('phone', '<p class="required">', '</p>'); ?>
                </div>
            </div>

            <!--<div class='form-group'>
                <label class=' col-sm-3 control-label' for='company'>Company <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
            <?php //echo $company;?> 
                    <span class="help-inline">Select "Clients" if User is a Client</span>
            <?php //echo form_error('company', '<p class="required">','</p>'); ?>
                </div>
            </div>
            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='last_name'>Client<span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
            <?php //echo $client; ?><span class="help-inline">Leave Blank for a company User</span>
            <?php //echo form_error('client', '<p class="required">','</p>'); ?>
                </div>
            </div>-->
            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='password'>Password  (if changing password) </label><div class="col-sm-5 input-group">
                     <?php echo form_input($password, '', 'class="form-control"'); ?> <?php echo form_error('password', '<p class="required">', '</p>'); ?>
                </div>
            </div>
            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='password_confirm'>Confirm Password (if changing password)  </label><div class="col-sm-5 input-group">
                     <?php echo form_input($password_confirm, '', 'class="form-control"'); ?>
                     <?php echo form_error('password_confirm', '<p class="required">', '</p>'); ?>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='groups'>Groups  </label>
                <div class="col-sm-5 input-group">
                     <?php echo form_dropdown('groups[]', $groups_list, $selected, ' multiple="multiple" class="form-control search-select" placeholder="Select Groups"'); ?>
                </div>
            </div> 

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5 input-group">


                    <?php echo form_submit('submit', 'Update', "id='submit' class='btn btn-info'"); ?> 
                    <?php echo anchor('admin/users', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>


            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

