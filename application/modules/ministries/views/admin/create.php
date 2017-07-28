<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Ministries </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/ministries/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Ministries')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/ministries', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Ministries')) . '</span>', 'class="btn btn-info"'); ?> 
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
                <label class=' col-sm-3 control-label' for='code'>Code </label><div class="col-sm-5">
                     <?php echo form_input('code', $result->code, 'id="code_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('code'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='name'>Name <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('name', $result->name, 'id="name_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('name'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='leader'>Leader <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('leader', array('' => 'Select Leader') + $leader, (isset($result->leader)) ? $result->leader : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('leader'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='telephone'>Telephone</label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-phone"></i> </span>
                    <?php echo form_input('telephone', $result->telephone, 'id="telephone_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('telephone'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='mobile'>Mobile  <span class='required'>*</span></label><div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-phone"></i> </span>
                    <?php echo form_input('mobile', $result->mobile, 'id="mobile_"  class="form-control input-mask-phone" '); ?>
                    <i style="color:red"><?php echo form_error('mobile'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='email'>Email <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-envelope"></i> </span>
                    <?php echo form_input('email', $result->email, 'id="email_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('email'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='congregation_size'>Expected  Congregation Size </label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-group"></i> </span>
                    <?php echo form_input('congregation_size', $result->congregation_size, 'id="congregation_size_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('congregation_size'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='description'>Description </label><div class="col-sm-5">
                    <textarea id="description"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('description'); ?></i>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/ministries', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>