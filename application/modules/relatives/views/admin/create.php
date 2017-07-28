<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Relatives </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/relatives/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Relatives')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/relatives', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Relatives')) . '</span>', 'class="btn btn-primary"'); ?> 
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
                <label class=' col-sm-3 control-label' for='first_name'>First Name <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('first_name', $result->first_name, 'id="first_name_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('first_name'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='last_name'>Last Name <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('last_name', $result->last_name, 'id="last_name_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('last_name'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label'>Gender <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         $items = array(
                                 "Male" => "Male",
                                 "Female" => "Female",
                                 "Transgender" => "Transgender",
                         );
                         echo form_dropdown('gender', $items, (isset($result->gender)) ? $result->gender : '', ' id="gender_1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('gender'); ?></i>
                </div>

            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='type'>Type <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         $items = array('' => 'Select Type',
                                 "parent" => "Parent",
                                 "spouse" => "Spouse",
                                 "sibling" => "Sibling",
                                 "others" => "Others",
                         );
                         echo form_dropdown('type', $items, (isset($result->type)) ? $result->type : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('type'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='relationship'>Relationship <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         $items = array('' => '',
                                 "father" => "Father",
                                 "mother" => "Mother",
                                 "uncle" => "Uncle",
                                 "aunt" => "Aunt",
                                 "grandparent" => "Grand Parent",
                                 "friend" => "Friend",
                                 "others" => "Others",
                         );
                         echo form_dropdown('relationship', $items, (isset($result->relationship)) ? $result->relationship : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('relationship'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='phone'>Phone <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-phone"></i> </span>
                    <?php echo form_input('phone', $result->phone, 'id="phone_"  class="form-control input-mask-phone" '); ?>
                    <i style="color:red"><?php echo form_error('phone'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='email'>Email </label><div class="col-sm-5">
                     <?php echo form_input('email', $result->email, 'id="email_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('email'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='additionals'>Additional Info </label><div class="col-sm-5">
                    <textarea id="additionals"  class="autosize-transition  form-control "  name="additionals"  /><?php echo set_value('additionals', (isset($result->additionals)) ? htmlspecialchars_decode($result->additionals) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('additionals'); ?></i>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/relatives', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>