<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Take Stock </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/take_stock/create', '<i class="icon-plus-sign-alt"></i> <span> Take Stock</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/take_stock', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Take Stock')) . '</span>', 'class="btn btn-info"'); ?> 
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
                <label class=' col-sm-3 control-label' for='date'>Date <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">

                    <input id='date' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date', $result->date > 0 ? date('d M Y', $result->date) : $result->date); ?>"  />
                    <i style="color:red"><?php echo form_error('date'); ?></i>
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='asset_name'>Asset Name <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('asset_name', $ass_items, (isset($result->asset_name)) ? $result->asset_name : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('asset_name'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='remaining_stock'>Remaining Stock <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('remaining_stock', $result->remaining_stock, 'id="remaining_stock_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('remaining_stock'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='description'>Description </label><div class="col-sm-5">
                    <textarea id="description"  class="autosize-transition ckeditor11 form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('description'); ?></i>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/take_stock', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>