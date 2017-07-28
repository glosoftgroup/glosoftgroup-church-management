<?php
    $attributes = array('class' => 'form-horizontal', 'id' => '');
    echo form_open_multipart(current_url(), $attributes);
?>

<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Other Contributions </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/other_contributions/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Other Contributions')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/other_contributions', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Other Contributions')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/other_contributions/voided', '<i class="icon-list-alt"></i> <span> Voided Other Contributions</span>', 'class="btn btn-warning"'); ?> 
                </div>
            </div>
        </div>

        <div class="panel-body" style="display: block;">    

            <div class='clearfix'></div>


            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='date'>Date <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">

                    <input id='date' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date', $result->date > 0 ? date('d M Y', $result->date) : $result->date); ?>"  />
                    <i style="color:red"><?php echo form_error('date'); ?></i>
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                </div>
            </div>
            <div class='form-group'>
                <label class='col-sm-3 control-label' for='bank'>Bank Deposited</label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('bank', array('' => 'Select Bank') + $banks, (isset($result->bank)) ? $result->bank : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('bank'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='treasurer'>Treasurer (Person Responsible) <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('treasurer', array('' => 'Select Person Responsible') + $users, (isset($result->treasurer)) ? $result->treasurer : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('treasurer'); ?></i>
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






            <div class="clearfix"></div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/other_contributions', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div>
            </div>
        </div>
    </div> 
</div>

<?php echo form_close(); ?>
		



