<div class="span8">
    <div class="head"> 
        <div class="icon"><span class="icosg-target1"></span></div>		
        <h2>  Sandbox  </h2>
        <div class="right"> 
             <?php echo anchor('admin/sandbox/create', '<i class="icon-plus">
                </i> ' . lang('web_add_t', array(':name' => 'Sandbox')), 'class="btn btn-primary"'); ?> 
             <?php echo anchor('admin/sandbox', '<i class="icon-list">
                </i> ' . lang('web_list_all', array(':name' => 'Sandbox')), 'class="btn btn-primary"'); ?> 
        </div>
    </div>

    <div class="block-fluid">
         <?php
             $attributes = array('class' => 'form-horizontal', 'id' => '');
             echo form_open_multipart(current_url(), $attributes);
         ?>
        <div class='row-form'>
            <div class="span2" for='title'>Title <span class='required'>*</span></div><div class="span10">
                 <?php echo form_input('title', $result->title, 'id="title_"  class="form-control" '); ?>
                 <?php echo form_error('title'); ?>
            </div>
        </div>

        <div class='row-form'>
            <div class="span2" for='day'>Day <span class='required'>*</span></div><div class="span10">
                <input id='day' type='text' name='day' maxlength='' class='form-control datepicker' value="<?php echo set_value('day', (isset($result->day)) ? $result->day : ''); ?>"  />
                <?php echo form_error('day'); ?>
            </div>
        </div>

        <div class='row-form'>
            <div class="span2" for='dday'>Dday <span class='required'>*</span></div><div class="span10">
                 <?php echo form_input('dday', $result->dday, 'id="dday_"  class="form-control" '); ?>
                 <?php echo form_error('dday'); ?>
            </div>
        </div>

        <div class='row-form'>
            <div class="span2" for='time'>Time <span class='required'>*</span></div><div class="span10">
                 <?php echo form_input('time', $result->time, 'id="time_"  class="form-control" '); ?>
                 <?php echo form_error('time'); ?>
            </div>
        </div>

        <div class='row-form'>
            <div class="span2" for='slot'>Slot <span class='required'>*</span></div><div class="span10">
                 <?php echo form_input('slot', $result->slot, 'id="slot_"  class="form-control" '); ?>
                 <?php echo form_error('slot'); ?>
            </div>
        </div>

        <div class='row-form'>
            <div class="span2" for='link'>Link <span class='required'>*</span></div><div class="span10">
                 <?php echo form_input('link', $result->link, 'id="link_"  class="form-control" '); ?>
                 <?php echo form_error('link'); ?>
            </div>
        </div>

        <div class='row-form'><div class="span2"></div><div class="span10">


                <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save', (($updType == 'create') ? "id='submit' class='btn btn-primary''" : "id='submit' class='btn btn-primary'")); ?>
                <?php echo anchor('admin/sandbox', 'Cancel', 'class="btn  btn-default"'); ?>
            </div></div>

        <?php echo form_close(); ?>
        <div class="clearfix"></div>
    </div>
</div>