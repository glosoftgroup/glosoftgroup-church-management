<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Hbcs </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/hbcs/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Hbcs')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/hbcs', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Hbcs')) . '</span>', 'class="btn btn-info"'); ?> 
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
                <label class=' col-sm-3 control-label' for='name'>Name <span class='required'>*</span></label><div class="col-sm-5 input-group">
                    <span class="input-group-addon add-on"><i class="icon-thumbs-up"></i></span>
                    <?php echo form_input('name', $result->name, 'id="name_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('name'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='estate'>Estate <span class='required'>*</span></label><div class="col-sm-5 input-group">
                    <span class="input-group-addon add-on"><i class="clip-location"></i></span>
                    <?php echo form_input('estate', $result->estate, 'id="estate_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('estate'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='meeting_day'>Meeting Day <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         $items = array('' => 'Select Day',
                                 "monday" => "Monday",
                                 "tuesday" => "Tuesday",
                                 "wednesday" => "Wednesday",
                                 "thursady" => "Thursday",
                                 "friday" => "Friday",
                                 "saturday" => "Saturday",
                                 "sunday" => "Sunday",
                         );
                         echo form_dropdown('meeting_day', $items, (isset($result->meeting_day)) ? $result->meeting_day : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('meeting_day'); ?></i>
                </div></div>


            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='meeting_time'>Meeting Time <span class='required'>*</span></label>
                <div class="col-sm-5 input-group input-append bootstrap-timepicker">
                     <?php echo form_input('meeting_time', $result->meeting_time, ' class="form-control time-picker" '); ?>

                    <i style="color:red"><?php echo form_error('meeting_time'); ?></i>
                    <span class="input-group-addon add-on"><i class="icon-time"></i></span>


                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='overall_leader'>Overall Leader <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('overall_leader', array('' => 'Select Member') + $host, (isset($result->overall_leader)) ? $result->overall_leader : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('overall_leader'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='description'>Description </label><div class="col-sm-5">
                    <textarea id="description"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('description'); ?></i>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/hbcs', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>