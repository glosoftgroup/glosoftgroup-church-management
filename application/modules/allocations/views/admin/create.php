<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Allocations </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/allocations/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Allocations')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/allocations', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Allocations')) . '</span>', 'class="btn btn-info"'); ?> 
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

                    <input id='date' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date', $result->date);?>"  />
                    <i style="color:red"><?php echo form_error('date'); ?></i>
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='ministry'>Ministry <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('ministry', array('' => 'Select Ministry') + (array) $mins, (isset($result->ministry)) ? $result->ministry : '', ' class="form-control search-select" ');
                         echo form_error('ministry');
                     ?>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='amount'>Amount <span class='required'>*</span></label><div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-money"></i> </span>
                    <?php echo form_input('amount', $result->amount, 'id="amount_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('amount'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='approved_by'>Approved By <span class='required'>*</span></label>
                <div class="col-sm-5">

                    <?php
                        echo form_dropdown('approved_by', array('' => 'Select Member') + $users, (isset($result->approved_by)) ? $result->approved_by : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                    ?> <i style="color:red"><?php echo form_error('approved_by'); ?></i>

                </div></div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='confirmed_by'>Confirmed By </label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('confirmed_by', array('' => 'Select Member') + $users, (isset($result->confirmed_by)) ? $result->confirmed_by : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('confirmed_by'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='description'>Description </label><div class="col-sm-5">
                    <textarea id="description"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('description'); ?></i>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/allocations', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>