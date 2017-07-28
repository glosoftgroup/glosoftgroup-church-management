<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Prayer Requests </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/prayer_requests/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Prayer Requests')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/prayer_requests', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Prayer Requests')) . '</span>', 'class="btn btn-primary"'); ?> 
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
                <label class=' col-sm-3 control-label' for='request_date'>Request Date <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">

                    <input id='request_date' type='text' name='request_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('request_date', (isset($result->request_date)) ? $result->request_date : ''); ?>"  />
                    <i style="color:red"><?php echo form_error('request_date'); ?></i>
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='phone_number'>Phone Number <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('phone_number', $result->phone_number, 'id="phone_number_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('phone_number'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='first_name'>First Name <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('first_name', $result->first_name, 'id="first_name_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('first_name'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='second_name'>Second Name <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('second_name', $result->second_name, 'id="second_name_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('second_name'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='address'>Address </label><div class="col-sm-5">
                     <?php echo form_input('address', $result->address, 'id="address_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('address'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='membership'>Membership <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         $items = array('' => '',
                                 "member" => "Member",
                                 "visitor" => "Visitor",
                         );
                         echo form_dropdown('membership', $items, (isset($result->membership)) ? $result->membership : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('membership'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='prayer_request'>Prayer Request <span class='required'>*</span></label><div class="col-sm-5">
                    <textarea id="prayer_request"  class="autosize-transition form-control "  name="prayer_request"  /><?php echo set_value('prayer_request', (isset($result->prayer_request)) ? htmlspecialchars_decode($result->prayer_request) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('prayer_request'); ?></i>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/prayer_requests', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>