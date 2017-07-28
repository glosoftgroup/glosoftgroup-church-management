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
            <h3>Are you sure you want to deactivate the user '<?php echo $user['username']; ?>'</h3>

            <?php echo form_open("admin/users/deactivate/" . $user['id']); ?>

            <div class="form-group">
                <label class=' col-sm-3 control-label' for='last_name'></label>
                <label class=' col-sm-6 control-label'>
                    <input type="radio" name="confirm" value="yes" checked="checked" />
                    <span class="lbl">Yes</span>

                    <input type="radio" name="confirm" value="no" />
                    <span class="lbl"> No</span>
                </label>

            </div>
            <div class='clearfix'></div>
            <?php echo form_hidden($csrf); ?>
            <?php echo form_hidden(array('id' => $user['id'])); ?>
            <label class=' col-sm-3 control-label' for='last_name'></label>
            <label class=' col-sm-6 control-label'>
                <p><?php echo form_submit('submit', 'Submit', 'class="btn btn-blue btn-small"'); ?></p>
            </label>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>


