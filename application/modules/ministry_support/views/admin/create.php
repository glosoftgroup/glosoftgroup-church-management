<?php
    $attributes = array('class' => 'form-horizontal', 'id' => '');
    echo form_open_multipart(current_url(), $attributes);
?>
<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Ministry Support </h3>
            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/ministry_support/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Ministry Support')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/ministry_support', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Ministry Support')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/ministry_support/voided', '<i class="icon-list-alt"></i> <span> Voided Ministry Support</span>', 'class="btn btn-warning"'); ?> 
                </div>
            </div>
        </div>
        <div class="panel-body" style="display: block;">    
            <div class='col-sm-6'>           
                <div class='clearfix'></div>
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='date'>Date <span class='required'>*</span></label>
                    <div class="col-sm-8 input-group">
                        <input id='date' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date', $result->date > 0 ? date('d M Y', $result->date) : $result->date); ?>"  />
                        <i style="color:red"><?php echo form_error('date'); ?></i>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                    </div>
                </div>
                <div class='form-group'>
                    <label class='col-sm-3 control-label' for='bank'>Bank Deposited</label>
                    <div class="col-sm-8">
                         <?php
                             echo form_dropdown('bank', array('' => 'Select Bank') + $banks, (isset($result->bank)) ? $result->bank : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                         ?> <i style="color:red"><?php echo form_error('bank'); ?></i>
                    </div></div>
                <div class='form-group'>
                    <label class='col-sm-3 control-label' for='treasurer'>Treasurer <span class='required'>*</span></label>
                    <div class="col-sm-8">
                         <?php
                             echo form_dropdown('treasurer', array('' => 'Select Person Responsible') + $users, (isset($result->treasurer)) ? $result->treasurer : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                         ?> <i style="color:red"><?php echo form_error('treasurer'); ?></i>
                    </div></div>
                <div class='form-group'>
                    <label class='col-sm-3 control-label' for='confirmed_by'>Confirmed By <span class='required'>*</span></label>
                    <div class="col-sm-8">
                         <?php
                             echo form_dropdown('confirmed_by', array('' => 'Select Member') + $users, (isset($result->confirmed_by)) ? $result->confirmed_by : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                         ?> <i style="color:red"><?php echo form_error('confirmed_by'); ?></i>
                    </div></div>
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='description'>Description </label><div class="col-sm-8">
                        <textarea id="description"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                        <i style="color:red"><?php echo form_error('description'); ?></i>
                    </div>
                </div>
            </div>
            <div class='col-sm-6'>
                <h3>Members Giving Ministry Support</h3>
                <table class="table table-striped table-bordered table-hover" id="">
                    <thead>
                        <tr>
                            <th width="3%">
                                #
                            </th>
                            <th width="20%">
                                Member
                            </th>
                            <th width="20%">
                                Amount
                            </th>
                            <th width="20%">
                                Type
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
                                     <?php
                                         echo form_dropdown('member[]', array('' => 'Select Member') + $members, (isset($result->member)) ? $result->member : '', ' id="member" class="select member" data-placeholder="Select Options..." ');
                                     ?> <i style="color:red"><?php echo form_error('member'); ?></i>
                                </td>
                                <td width="20%"> 
                                     <?php echo form_input('amount[]', $result->amount, 'id="amount" class="form-control amount" style=""'); ?>
                                    <i style="color:red"><?php echo form_error('amount'); ?></i>
                                </td>
                                <td width="20%">
                                     <?php
                                         $items = array('Cash' => 'Cash', 'Cheque' => 'Cheque', 'Bank Slip' => 'Bank Slip', 'M-Pesa' => 'M-Pesa');
                                         echo form_dropdown('type[]', $items, (isset($result->type)) ? $result->type : '', ' id="type" class="select type" data-placeholder="Select Options..." ');
                                     ?> <i style="color:red"><?php echo form_error('type'); ?></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="btn-group">
                    <a href="#" id="btnAdd" class="btn btn-success btn-sm clone">Add New Line</a> 
                    <a href="#" id="btnDel" class="btn btn-danger btn-sm remove">Remove</a>
                </div> 
            </div>
            <div class="clearfix"></div>
            <hr /> 
            <div class="clearfix"></div>
            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-8">
                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>
                    <?php echo anchor('admin/ministry_support', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div>
            </div>
        </div>
    </div> 
</div>
<?php echo form_close(); ?>
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
               newElem.find('.member').attr('id', 'ID' + newNum + '_member').val('');
               newElem.find('.amount').attr('id', 'ID' + newNum + '_amount').val('');
               newElem.find('.type').attr('id', 'ID' + newNum + '_type').val('');
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
