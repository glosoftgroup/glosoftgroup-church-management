<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Address Book </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/address_book/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Contact')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/address_book', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Contacts')) . '</span>', 'class="btn btn-info"'); ?> 
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
                <label class=' col-sm-3 control-label' for='address_book'>Address Book <span class='required'>*</span></label><div class="col-sm-5">
                     <?php
                         $items = array('' => 'Select Option',
                                 "customers" => "Customers",
                                 "suppliers" => "Suppliers",
                                 "others" => "Others",
                         );
                         echo form_dropdown('address_book', $items, (isset($result->address_book)) ? $result->address_book : '', 'id="address_book_"  class="form-control search-select" ');
                     ?>
                    <i style="color:red"><?php echo form_error('address_book'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='category'>Category <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                     <?php
                         echo form_dropdown('category', $category, (isset($result->category)) ? $result->category : '', ' id="form-field-select-1" class="form-control search-select" placeholder="Select Options..." ');
                     ?> 
                    <span data-toggle="modal"  role="button" href="#myModal2" class="input-group-addon btn btn-primary btn-squared"> <i class="icon-plus"></i> Add Category </span>
                    <i style="color:red"><?php echo form_error('category'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='contact_person'>Contact Person <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('contact_person', $result->contact_person, 'id="contact_person_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('contact_person'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='business_name'>Business Name </label><div class="col-sm-5">
                     <?php echo form_input('business_name', $result->business_name, 'id="business_name_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('business_name'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='phone'>Phone <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('phone', $result->phone, 'id="phone_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('phone'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='email'>Email </label><div class="col-sm-5">
                     <?php echo form_input('email', $result->email, 'id="email_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('email'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='address'>Address </label><div class="col-sm-5">
                    <textarea id="address"  class="autosize-transition ckeditor11 form-control "  name="address"  /><?php echo set_value('address', (isset($result->address)) ? htmlspecialchars_decode($result->address) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('address'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='additional_info'>Additional Info </label><div class="col-sm-5">
                    <textarea id="additional_info"  class="autosize-transition ckeditor1 form-control "  name="additional_info"  /><?php echo set_value('additional_info', (isset($result->additional_info)) ? htmlspecialchars_decode($result->additional_info) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('additional_info'); ?></i>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/address_book', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>


<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo site_url('admin/address_book_category/quick_add'); ?>" class='form-horizontal' method="POST" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">Add Address Category</h4>
                </div>
                <div class="modal-body">
                    <div class='form-group'>
                        <label class=' col-sm-4 control-label' for='description'>Category Name <span class='required'>*</span></label>
                        <div class="col-sm-8">
                            <input name="name" id="name" class="form-control" placeholder="E.g Stationary, Electronics, Foodstuff etc" >						

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