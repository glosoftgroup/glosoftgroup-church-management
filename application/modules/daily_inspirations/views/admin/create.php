<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Daily Inspirations </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/daily_inspirations/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Daily Inspirations')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/daily_inspirations', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Daily Inspirations')) . '</span>', 'class="btn btn-primary"'); ?> 
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
                         $items = array(1 => 'Live', 0 => 'Draft');
                         echo form_dropdown('status', $items, (isset($result->status)) ? $result->status : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('status'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='message'>Inspiration <span class='required'>*</span></label><div class="col-sm-5">
                    <textarea id="message"  class="autosize-transition form-control "  name="message"  /><?php echo set_value('message', (isset($result->message)) ? htmlspecialchars_decode($result->message) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('message'); ?></i>
                </div>
            </div>



            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/daily_inspirations', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>