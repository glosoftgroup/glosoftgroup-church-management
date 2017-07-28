<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Hymns Manager </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/hymns_manager/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Hymns Manager')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/hymns_manager', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Hymns Manager')) . '</span>', 'class="btn btn-info"'); ?> 
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
                <label class=' col-sm-3 control-label' for='hymn_title'>Hymn Title <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('hymn_title', $result->hymn_title, 'id="hymn_title_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('hymn_title'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='composer'>Composer </label><div class="col-sm-5">
                     <?php echo form_input('composer', $result->composer, 'id="composer_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('composer'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='category'>Category <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         $items = array('' => '',
                                 "Praise" => "Praise",
                                 "worship" => "Worship",
                                 "other" => "Other",
                         );
                         echo form_dropdown('category', $items, (isset($result->category)) ? $result->category : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('category'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='lyrics'>Lyrics </label><div class="col-sm-5">
                    <textarea id="lyrics"  class="autosize-transition form-control "  name="lyrics"  /><?php echo set_value('lyrics', (isset($result->lyrics)) ? htmlspecialchars_decode($result->lyrics) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('lyrics'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='file'><?php echo lang(($updType == 'edit') ? "web_file_edit" : "web_file_create" ) ?> (file) </label>
                <div class="col-sm-5">
                    <input id='file' type='file' name='file' />

                    <?php if ($updType == 'edit'): ?>
                             <a href='/public/uploads/expenses/files/<?php echo $result->file ?>' />Download actual file (file)</a>
                        <?php endif ?>

                    <br/><i style="color:red"><?php echo form_error('file'); ?></i>
                    <?php echo ( isset($upload_error['file'])) ? $upload_error['file'] : ""; ?>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/hymns_manager', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>