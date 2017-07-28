<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Events </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/events/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Events')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/events', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Events')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>

        <div class="panel-body" style="display: block;">    


            <div class='clearfix'></div>

            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open_multipart(current_url(), $attributes);
            ?>


            <div class="col-sm-6">
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='title'>Title <span class='required'>*</span></label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="clip-bubble-2"></i> </span>
                        <?php echo form_input('title', $result->title, 'id="title_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('title'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='start_date'>Start Date <span class='required'>*</span></label>
                    <div class="col-sm-8 input-group">

                        <input id='start_date' type='text' name='start_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('start_date', $result->end_date > 0 ? date('d M Y', $result->end_date) : $result->end_date); ?>" />
                        <i style="color:red"><?php echo form_error('start_date'); ?></i>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='end_date'>End Date <span class='required'>*</span></label>
                    <div class="col-sm-8 input-group">

                        <input id='end_date' type='text' name='end_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('end_date', $result->end_date > 0 ? date('d M Y', $result->end_date) : $result->end_date); ?>" />
                        <i style="color:red"><?php echo form_error('end_date'); ?></i>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='venue'>Venue <span class='required'>*</span></label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="clip-location"></i> </span>
                        <?php echo form_input('venue', $result->venue, 'id="venue_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('venue'); ?></i>
                    </div>
                </div>


                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='file'><?php echo lang(($updType == 'edit') ? "web_file_edit" : "web_file_create" ) ?> (file) </label>
                    <div class="col-sm-8">
                        <input id='file' type='file' name='file' />

                        <?php if ($updType == 'edit'): ?>
                                 <a href='/public/uploads/events/files/<?php echo $result->file ?>' />Download actual file (file)</a>
                            <?php endif ?>

                        <br/><i style="color:red"><?php echo form_error('file'); ?></i>
                        <?php echo ( isset($upload_error['file'])) ? $upload_error['file'] : ""; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">

                <div class='form-group'>
                    <label class='col-sm-3 control-label' for='status'>Event Status </label>
                    <div class="col-sm-8">
                         <?php
                             $items = array(
                                     "1" => "Live",
                                     "0" => "Draft",
                             );
                             echo form_dropdown('status', $items, (isset($result->status)) ? $result->status : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                         ?> <i style="color:red"><?php echo form_error('status'); ?></i>
                    </div></div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label'  for='description'>Description </label><div class="col-sm-8">
                        <textarea id="description" rows="9" class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                        <i style="color:red"><?php echo form_error('description'); ?></i>
                    </div>
                </div>

            </div>
            <div class="clearfix"></div>

            <hr>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/events', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>