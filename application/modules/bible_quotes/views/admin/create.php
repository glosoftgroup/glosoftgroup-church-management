<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Bible Quotes </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/bible_quotes/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Bible Quotes')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/bible_quotes', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Bible Quotes')) . '</span>', 'class="btn btn-primary"'); ?> 
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
                <label class='col-sm-3 control-label' for='status'>Status <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         $items = array('' => '',
                                 "1" => "Live",
                                 "0" => "Draft",
                         );
                         echo form_dropdown('status', $items, (isset($result->status)) ? $result->status : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('status'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='content'>Content <span class='required'>*</span></label><div class="col-sm-5">
                    <textarea id="content"  class="autosize-transition form-control "  name="content"  /><?php echo set_value('content', (isset($result->content)) ? htmlspecialchars_decode($result->content) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('content'); ?></i>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/bible_quotes', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>