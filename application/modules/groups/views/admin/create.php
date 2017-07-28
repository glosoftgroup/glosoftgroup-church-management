<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Users</h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/groups/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Group')) . '</span>', 'class="btn btn-primary"'); ?> 

                    <?php echo anchor('admin/groups', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Groups')) . '</span>', 'class="btn btn-info"'); ?> 


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
                <label class=' col-sm-3 control-label' for='name'>Name </label><div class="col-sm-5">
                     <?php echo form_input('name', $result->name, 'id="name_"  class="form-control" '); ?>
                     <?php echo form_error('name'); ?>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='description'>Description </label><div class="col-sm-5">
                    <textarea id="description"  class="autosize-transition form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                    <?php echo form_error('description'); ?>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">



                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save', (($updType == 'create') ? "id='submit' class='btn btn-info btn-small''" : "id='submit' class='btn btn-info btn-small'")); ?>

                    <?php echo anchor('admin/pledges', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>


            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>