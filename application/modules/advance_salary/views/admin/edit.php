<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Deduction </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/advance_salary/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Advance Salary')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/advance_salary', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Advance Salary')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>

        <div class="panel-body" style="display: block;">   

            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open_multipart(current_url(), $attributes);
            ?>

            <div class='form-group'>
                <label class="col-sm-3 control-label" for='advance_date'> Date <span class='required'>*</span></label><div class="col-sm-4 input-group">

                    <?php echo form_input('advance_date', $result->advance_date > 0 ? date('d M Y', $result->advance_date) : $result->advance_date, 'class="form-control datepicker"'); ?>
                    <?php echo form_error('advance_date'); ?>
                    <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>


                </div>
            </div>


            <div class='form-group'>
                <label class="col-sm-3 control-label" for='employee'>Employee <span class='required'>*</span></label><div class="col-sm-4">
                     <?php
                         echo form_dropdown('employee', array('' => 'Select Employee') + $employees, (isset($result->employee)) ? $result->employee : '', ' class="select form-control " ');
                         echo form_error('employee');
                     ?>
                </div>
            </div>


            <div class='form-group'>
                <label class="col-sm-3 control-label" for='amount'>Amount <span class='required'>*</span></label><div class="col-sm-4">
                     <?php echo form_input('amount', $result->amount, 'id="amount_"  class="form-control" '); ?>
                     <?php echo form_error('amount'); ?>
                </div>
            </div>

            <div class='form-group'>
                <label class="col-sm-3 control-label" for='amount'>Comment <span class='required'>*</span></label><div class="col-sm-4">
                    <textarea id="comment"  class=" wysiwyg "  name="comment"  /><?php echo set_value('comment', (isset($result->comment)) ? htmlspecialchars_decode($result->comment) : ''); ?></textarea>
                    <?php echo form_error('comment'); ?>
                </div>
            </div>

            <div class="clearfix"></div>
            <hr>
            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-8">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/advance_salary', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div>
            </div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div> 
        </div>
    </div>
</div>