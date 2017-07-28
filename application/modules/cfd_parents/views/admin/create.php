<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Cfd Parents </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/cfd_parents/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Cfd Parents')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/cfd_parents', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Cfd Parents')) . '</span>', 'class="btn btn-info"'); ?> 
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
                <label class=' col-sm-3 control-label' for='type'>Type </label><div class="col-sm-5">
                     <?php
                         $items = array(
                                 "Father" => "Father",
                                 "Mother" => "Mother",
                         );

                         echo form_dropdown('type', $items, $result->type, 'id="type_"  class="form-control search-select" ');
                     ?>
                    <i style="color:red"><?php echo form_error('type'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='first_name'>First Name <span class='required'>*</span></label><div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
                    <?php echo form_input('first_name', $result->first_name, 'id="first_name_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('first_name'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='last_name'>Last Name <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
                    <?php echo form_input('last_name', $result->last_name, 'id="last_name_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('last_name'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='phone1'>Phone <span class='required'>*</span></label><div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-phone"></i> </span>
                    <?php echo form_input('phone', $result->phone, 'id="phone_"  class="form-control input-mask-phone" '); ?>
                    <i style="color:red"><?php echo form_error('phone'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='email'>Email </label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-envelope"></i> </span>
                    <?php echo form_input('email', $result->email, 'id="email_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('email'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='address'>Address </label><div class="col-sm-5">
                    <textarea id="address"  class="autosize-transition ckeditor1 form-control "  name="address"  /><?php echo set_value('address', (isset($result->address)) ? htmlspecialchars_decode($result->address) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('address'); ?></i>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/cfd_parents', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>