<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Petty Cash </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/petty_cash/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Petty Cash')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/petty_cash', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Petty Cash')) . '</span>', 'class="btn btn-info"'); ?> 
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

                    <input id='date' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date_joined', $result->date > 0 ? date('d M Y', $result->date) : $result->date); ?>"  />
                    <i style="color:red"><?php echo form_error('date'); ?></i>
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='voucher_number'>Item Name <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="clip-bubble-2"></i> </span>
                    <?php echo form_dropdown('item', $expenses_items, (isset($result->item)) ? $result->item : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> 
                    <span data-toggle="modal"  role="button" href="#myModal1" class="input-group-addon btn btn-primary btn-squared"> <i class="icon-plus"></i> Add Item </span><i style="color:red"><?php echo form_error('item'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='voucher_number'>Voucher Number <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="clip-clip"></i> </span>
                    <?php echo form_input('voucher_number', $vn, 'id="voucher_number_" disabled class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('voucher_number'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='amount'>Amount <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-money"></i> </span>
                    <?php echo form_input('amount', $result->amount, 'id="amount_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('amount'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='authorised_by'>Authorised By <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('authorised_by', array('' => 'Select Person Responsible') + $users, (isset($result->authorised_by)) ? $result->authorised_by : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('authorised_by'); ?></i>
                </div></div>



            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='description'>Description </label><div class="col-sm-5">
                    <textarea id="description"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('description'); ?></i>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/petty_cash', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>

<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo site_url('admin/expenses_items/petty_add'); ?>" class='form-horizontal' method="POST" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">Add Expense Item</h4>
                </div>
                <div class="modal-body">
                    <div class='form-group'>
                        <label class=' col-sm-4 control-label' for='description'>Item Name <span class='required'>*</span></label>
                        <div class="col-sm-6"> 
                             <?php echo form_input('name', '', 'id="name"  class="form-control" '); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-default">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>