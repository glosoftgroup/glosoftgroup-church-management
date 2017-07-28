<div class="span8">
    <div class="head"> 
        <div class="icon"><span class="icosg-target1"></span></div>		
        <h2>  Permissions  </h2>
        <div class="right"> 
             <?php echo anchor('admin/permissions/create', '<i class="icon-plus  icon-white">
                </i> ' . lang('web_add_t', array(':name' => 'Permissions')), 'class="btn btn-primary"'); ?> 
             <?php echo anchor('admin/permissions', '<i class="icon-list icon-white">
                </i> ' . lang('web_list_all', array(':name' => 'Permissions')), 'class="btn btn-primary"'); ?> 

        </div>
    </div>


    <div class="block-fluid">

        <?php
            $attributes = array('class' => 'form-horizontal', 'id' => '');
            echo form_open_multipart(current_url(), $attributes);
        ?>
        <div class='row-form'>
            <div class="span2" for='name'>Name <span class='required'>*</span></div><div class="span10">
                 <?php echo form_input('resource', $result->resource, 'id="name_"  class="form-control" '); ?>
                 <?php echo form_error('resource'); ?>
            </div>
        </div>

        <div class='row-form'>

        </div>

        <div class='widget'>
            <div class='head dark'>
                <div class='icon'><i class='icos-pencil'></i></div>
                <h2>Description </h2></div>
            <div class="block-fluid editor">
                <textarea id="description"   style="height: 300px;" class=" wysiwyg "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                <?php echo form_error('description'); ?>
            </div>
        </div>

        <div class='row-form'><div class="span2"></div><div class="span10">


                <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save', (($updType == 'create') ? "id='submit' class='btn btn-primary''" : "id='submit' class='btn btn-primary'")); ?>
                <?php echo anchor('admin/permissions', 'Cancel', 'class="btn  btn-default"'); ?>
            </div></div>

        <?php echo form_close(); ?>
        <div class="clearfix"></div>
    </div>
</div>