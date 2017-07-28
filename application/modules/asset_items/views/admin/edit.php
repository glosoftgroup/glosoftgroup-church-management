<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Asset Items </h3>
            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/asset_items/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Asset Items')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/asset_items', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Asset Items')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>
        <div class="panel-body" style="display: block;">    
            <div class='clearfix'></div>
            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open_multipart(current_url(), $attributes);
            ?>
            <div class='col-sm-12'>
                <h3>Add Multiple Asset Items</h3>
                <table class="table table-striped table-bordered table-hover" id="">
                    <thead>
                        <tr>
                            <th width="3%">
                                #
                            </th>
                            <th width="20%">
                                Name
                            </th>
                            <th width="20%">
                                Category								 
                            </th>
                            <th width="50%">
                                Description
                            </th>
                        </tr>
                    </thead>
                </table>
                <div id="entry1" class="clonedInput">	
                    <table class="table table-striped table-bordered table-hover" >
                        <tbody>
                            <tr>
                                <td width="3%">
                                    <span id="reference" name="reference" class="heading-reference">1</span>
                                </td>
                                <td width="20%">
                                     <?php echo form_input('name', $result->name, 'id="name_"  class="form-control" '); ?>
                                    <i style="color:red"><?php echo form_error('name'); ?></i>
                                </td>
                                <td width="20%"> 
                                     <?php
                                         echo form_dropdown('category', $categories, (isset($result->category)) ? $result->category : '', ' id="form-field-select-1" class="select search-select1 category" data-placeholder="Select Options..." ');
                                     ?> <i style="color:red"><?php echo form_error('category'); ?></i>
                                </td>
                                <td width="50%">
                                    <textarea id="description"  class="autosize-transition ckeditor11 form-control description"  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                                    <i style="color:red"><?php echo form_error('description'); ?></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php
                    if ($updType == 'create')
                    {
                         ?>
                         <div class="btn-group">
                             <a href="#" id="btnAdd" class="btn btn-success btn-sm clone">Add New Line</a> 
                             <a href="#" id="btnDel" class="btn btn-danger btn-sm remove">Remove</a>
                         </div> 
    <?php } ?>
            </div>
            <div class="clearfix"></div>
            <hr />
            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">
                      <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>
            <?php echo anchor('admin/asset_items', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>
<?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>
<script>
     $(function ()
     {
          $('.select').select2({'width': '100%'});
          $('#btnAdd').click(function ()
          {
               //$('input.timepicker').eq(0).clone().removeClass("hasTimepicker").prependTo('#entry2');
               var num = $('.clonedInput').length, // how many "duplicatable" input fields we currently have
                       newNum = new Number(num + 1), // the numeric ID of the new input field being added
                       newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
               // manipulate the name/id values of the input inside the new element
               // H2 - section
               newElem.find('.heading-reference').attr('id', 'reference').attr('name', 'reference').html(' ' + newNum);
               //Data
               newElem.find('.name').attr('id', 'ID' + newNum + '_member').val('');
               newElem.find('.category').attr('id', 'ID' + newNum + '_daily_inspirations').val('');
               newElem.find('.description').attr('id', 'ID' + newNum + '_bible_quotes').val('');
               // insert the new element after the last "duplicatable" input field
               $('#entry' + num).after(newElem);
               /**** ******BEGIN SELECT2 CLONE**************/
               newElem.find('.select2-container').remove();
               newElem.find('select').select2({'width': '100%'});
               /*********END SELECT2 CLONE*****************/
               // enable the "remove" button
               $('#btnDel').attr('disabled', false);
               // right now you can only add 8 sections. change '8' below to the max number of times the form can be duplicated
               if (newNum == 100)
                    $('#btnAdd').attr('disabled', true).prop('value', "You've reached the limit");
          });
          $('#btnDel').click(function ()
          {
               // confirmation
               if (confirm("Are you sure you wish to remove this section? This cannot be undone."))
               {
                    var num = $('.clonedInput').length;
                    // how many "duplicatable" input fields we currently have
                    $('#entry' + num).slideUp('slow', function ()
                    {
                         $(this).remove();
                         // if only one element remains, disable the "remove" button
                         if (num - 1 === 1)
                              $('#btnDel').attr('disabled', true);
                         // enable the "add" button
                         $('#btnAdd').attr('disabled', false).prop('value', "add section");
                    });
               }
               return false;
               // remove the last element
               // enable the "add" button
               $('#btnAdd').attr('disabled', false);
          });
          $('#btnDel').attr('disabled', true);
     });
</script> 