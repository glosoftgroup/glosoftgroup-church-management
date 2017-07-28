<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Testmodes </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/testmodes/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Testmodes')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/testmodes', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Testmodes')) . '</span>', 'class="btn btn-primary"'); ?> 
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
                <label class='col-sm-3 control-label' for='status'>Status </label>
                <div class="col-sm-5">
                     <?php
                         $items = array('' => '',
                                 "0" => "Live",
                                 "1" => "Draft",
                         );
                         echo form_dropdown('status', $items, (isset($result->status)) ? $result->status : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('status'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='brief_description'>Brief Description </label><div class="col-sm-5">
                    <textarea id="brief_description"  class="autosize-transition ckeditor form-control "  name="brief_description"  /><?php echo set_value('brief_description', (isset($result->brief_description)) ? htmlspecialchars_decode($result->brief_description) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('brief_description'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='file'><?php echo lang(($updType == 'edit') ? "web_file_edit" : "web_file_create" ) ?> (file) </label>
                <div class="col-sm-5">
                    <input id='file' type='file' name='file' />

                    <?php if ($updType == 'edit'): ?>
                             <a href='/public/uploads/testmodes/files/<?php echo $result->file ?>' />Download actual file (file)</a>
                        <?php endif ?>

                    <br/><i style="color:red"><?php echo form_error('file'); ?></i>
                    <?php echo ( isset($upload_error['file'])) ? $upload_error['file'] : ""; ?>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/testmodes', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>