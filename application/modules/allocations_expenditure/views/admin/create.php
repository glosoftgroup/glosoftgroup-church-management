<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Allocations Expenditure </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/allocations_expenditure/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Allocations Expenditure')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/allocations_expenditure', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Allocations Expenditure')) . '</span>', 'class="btn btn-info"'); ?> 
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
                <label class='col-sm-3 control-label' for='ministry'>Ministry <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('ministry', array('' => 'Select Ministry') + $mins, (isset($result->ministry)) ? $result->ministry : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('ministry'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='expenditure'>Expenditure <span class='required'>*</span></label><div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-money"></i> </span>
                    <?php echo form_input('expenditure', $result->expenditure, 'id="expenditure" onblur="totals()" class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('expenditure'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='balance'>Balance </label><div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-thumbs-up"></i> </span>
                    <?php echo form_input('balance', $result->balance, 'id="balance"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('balance'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='description'>Description </label><div class="col-sm-5">
                    <textarea id="description"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('description'); ?></i>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/allocations_expenditure', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>

<script type="text/javascript">
     function totals()
     {
//grab the values
          expenditure = document.getElementById('expenditure').value;

          document.getElementById('balance').value = number_to_currency(parseFloat(expenditure) * parseFloat(expenditure));
     }


     function number_to_currency(num)
     {
          return parseFloat(num).toFixed(2);
     }

</script>	