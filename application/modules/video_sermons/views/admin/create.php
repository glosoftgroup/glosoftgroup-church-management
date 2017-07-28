<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Video Sermons </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/video_sermons/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Video Sermons')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/video_sermons', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Video Sermons')) . '</span>', 'class="btn btn-info"'); ?> 
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
                <label class=' col-sm-3 control-label' for='title'>Title <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('title', $result->title, 'id="title_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('title'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='value'>Value </label><div class="col-sm-5">
                     <?php echo form_input('value', $result->value, 'id="value_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('value'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='file'><?php echo lang(($updType == 'edit') ? "web_file_edit" : "web_file_create" ) ?> (file) </label>
                <div class="col-sm-5">
                    <input id='file' type='file' name='file' />

                    <?php if ($updType == 'edit'): ?>
                             <a href='uploads/files/<?php echo $result->file ?>' />Download actual file (file)</a>
                        <?php endif ?>

                    <br/><i style="color:red"><?php echo form_error('file'); ?></i>
                    <?php echo ( isset($upload_error['file'])) ? $upload_error['file'] : ""; ?>
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

                    <?php echo anchor('admin/video_sermons', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>