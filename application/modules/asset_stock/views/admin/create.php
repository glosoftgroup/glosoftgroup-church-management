<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Asset Stock </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/asset_stock/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Asset Stock')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/asset_stock', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Asset Stock')) . '</span>', 'class="btn btn-info"'); ?> 
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
                <label class='col-sm-3 control-label' for='supplier'>Supplier <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                     <?php
                         echo form_dropdown('supplier', $suppliers, (isset($result->supplier)) ? $result->supplier : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('supplier'); ?></i>
                    <span data-toggle="modal"  role="button" href="#Add_supplier" class="input-group-addon btn btn-primary btn-squared"> <i class="icon-plus"></i> Add Supplier </span>
                </div></div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='item'>Item <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('item', array('' => 'Select Item') + $asset_items, (isset($result->item)) ? $result->item : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> 

                    <i style="color:red"><?php echo form_error('item'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='quantity'>Quantity <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('quantity', $result->quantity, 'id="quantity" onblur="totals()" class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('quantity'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='unit_price'>Unit Price <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('unit_price', $result->unit_price, 'id="unit_price" onblur="totals()" class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('unit_price'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='total'>Total <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('total', $result->total, 'id="total"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('total'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='person_responsible'>Person Responsible </label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('person_responsible', array('' => 'Select Person Responsible') + $users, (isset($result->person_responsible)) ? $result->person_responsible : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('person_responsible'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='file'><?php echo lang(($updType == 'edit') ? "web_file_edit" : "web_file_create" ) ?> (file) </label>
                <div class="col-sm-5">
                    <input id='file' type='file' name='file' />

                    <?php if ($updType == 'edit'): ?>
                             <a href='/public/uploads/expenses/files/<?php echo $result->file ?>' />Download actual file (file)</a>
                        <?php endif ?>

                    <br/><i style="color:red"><?php echo form_error('file'); ?></i>
                    <?php echo ( isset($upload_error['file'])) ? $upload_error['file'] : ""; ?>
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

                    <?php echo anchor('admin/asset_stock', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>



<!-- Modal -->
<div class="modal fade" id="Add_supplier" tabindex="-1" data-width="800" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo site_url('admin/address_book/quick_add'); ?>" class='form-horizontal' method="POST" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">Add Expense Item</h4>
                </div>
                <div class="modal-body">

                    <div class='form-group'>
                        <label class='col-sm-3 control-label' for='category'>Category <span class='required'>*</span></label>
                        <div class="col-sm-5 input-group">
                             <?php
                                 echo form_dropdown('category', $category, '', ' id="form-field-select-1" class="form-control search-select" ');
                             ?> 
                            <i style="color:red"><?php echo form_error('category'); ?></i>
                        </div></div>

                    <div class='form-group'>
                        <label class=' col-sm-3 control-label' for='contact_person'>Contact Person <span class='required'>*</span></label><div class="col-sm-5">
                             <?php echo form_input('contact_person', '', 'id="contact_person_"  class="form-control" '); ?>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label class=' col-sm-3 control-label' for='business_name'>Business Name </label><div class="col-sm-5">
                             <?php echo form_input('business_name', '', 'id="business_name_"  class="form-control" '); ?>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label class=' col-sm-3 control-label' for='phone'>Phone <span class='required'>*</span></label><div class="col-sm-5">
                             <?php echo form_input('phone', '', 'id="phone_"  class="form-control" '); ?>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label class=' col-sm-3 control-label' for='email'>Email </label><div class="col-sm-5">
                             <?php echo form_input('email', '', 'id="email_"  class="form-control" '); ?>

                        </div>
                    </div>

                    <div class='form-group'>
                        <label class=' col-sm-3 control-label' for='address'>Address </label><div class="col-sm-5">
                            <textarea id="address"  class="autosize-transition ckeditor11 form-control "  name="address"  /></textarea>
                            <i style="color:red"><?php echo form_error('address'); ?></i>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class=' col-sm-3 control-label' for='additional_info'>Additional Info </label><div class="col-sm-5">
                            <textarea id="additional_info"  class="autosize-transition ckeditor1 form-control "  name="additional_info"  /></textarea>
                            <i style="color:red"><?php echo form_error('additional_info'); ?></i>
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





<script type="text/javascript">
     function totals()
     {
          //grab the values
          quantity = document.getElementById('quantity').value;
          unit_price = document.getElementById('unit_price').value;

          document.getElementById('total').value = number_to_currency(parseFloat(quantity) * parseFloat(unit_price));
     }


     function number_to_currency(num)
     {
          return parseFloat(num).toFixed(2);
     }

</script>