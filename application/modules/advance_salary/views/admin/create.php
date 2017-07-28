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
            <!-- BEGIN TABLE DATA -->
            <table class="table table-striped table-bordered table-hover" >
                <!-- BEGIN -->
                <thead>
                    <tr >
                        <td width="3%">#</td>
                        <td width="20%" >Date</td>
                        <td width="20%" >Employee</td>
                        <td width="20%">Amount</td>
                        <td width="37%">comment</td>
                    </tr>
                </thead>
            </table>
            <div id="entry1" class="clonedInput">
                <table class="table table-striped table-bordered table-hover" >
                    <tbody>
                        <tr >
                            <td width="3%">
                                <span id="reference" name="reference" class="heading-reference">1</span>
                            </td>
                            <td width="20%" class="input-group">
                                <input type="text" name="advance_date[]" id="advance_date" style="width:150px;" class=" form-control advance_date date-picker" value="<?php
                                    if (!empty($result->advance_date))
                                    {
                                         echo $result->advance_date;
                                    }
                                ?>">
                                <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                                <?php echo form_error('employee'); ?>
                            </td> 
                            <td width="20%">
                                 <?php
                                     echo form_dropdown('employee[]', array('' => 'Select Employee') + $employees, (isset($result->employee)) ? $result->employee : '', ' class="employee select" style=" " id="employee"  ');
                                     echo form_error('employee');
                                 ?>
                                 <?php echo form_error('employee'); ?>
                            </td> 
                            <td width="20%">
                                <input type="text" name="amount[]" id="amount" class="amount form-control" value="<?php
                                    if (!empty($result->amount))
                                    {
                                         echo $result->amount;
                                    }
                                ?>">
                                       <?php echo form_error('amount'); ?>
                            </td>
                            <td width="37%">
                                <textarea name="comment[]" cols="45" rows="1" class="form-control comment  validate[required]" style="resize:vertical;" id="comment"><?php echo set_value('comment', (isset($result->comment)) ? htmlspecialchars_decode($result->comment) : ''); ?></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="actions">
                <a id="btnAdd" class="btn btn-success clone">Add New Line</a> 
                <a  id="btnDel" class="btn btn-danger remove">Remove</a>
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
<script type="text/javascript">
     $(function ()
     {
          $('.select').select2({'width': '100%'});
          $('#btnAdd').click(function ()
          {
//$('input.timepicker').eq(0).clone().removeClass("hasTimepicker").prependTo('#entry2');
               var num = $('.clonedInput').length, // howmany "duplicatable" input fields we currently have
                       newNum = new Number(num + 1), // the numeric ID of the new input field being added
                       newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
// manipulate the name/id values of the input inside the new element
// H2 - section
               newElem.find('.heading-reference').attr('id', 'reference').attr('name', 'reference').html(' ' + newNum);
               // subject - select
               newElem.find('.employee').attr('id', 'ID' + newNum + '_employee').val('');
               newElem.find('.advance_date').attr('id', 'ID' + newNum + '_advance_date').val('').removeClass("hasDatepicker").datepicker({format: "dd MM yyyy",
               }).focus();
               ;
               newElem.find('.amount').attr('id', 'ID' + newNum + '_amount').val('');
               newElem.find('.comment').attr('id', 'ID' + newNum + '_comment').val(
                       '');
               // insert the new element after the last "duplicatable" input field
               $('#entry' + num).after(newElem);
               /**** ******BEGIN SELECT2 CLONE**************/
               newElem.find('.select2-container').remove();
               newElem.find('select').select2({'width': '100%'});
               /*********END SELECT2 CLONE*****************/
// enable the "remove" button
               $('#btnDel').attr('disabled', false);
               // right now you can only add 5 sections. change '5' below to the max number of times the form can be duplicated
               if (newNum == 100)
                    $('#btnAdd').attr('disabled', true).prop('value', "You've reached the limit");
          });
          $('#btnDel').click(function ()
          {
// confirmation
               if (confirm("Are you sure you wish to remove this section? This cannot be undone."))
               {
                    var num = $('.clonedInput').length;                 // how many "duplicatable" input fields we currently have
                    $('#entry' + num).slideUp('slow', function ()
                    {
                         $(this).remove();                  // if only one element remains, disable the "remove" button
                         if (num - 1 === 1)
                              $('#btnDel').attr('disabled', true)
                                      ;
                         // enable the "add" button
                         $('#btnAdd').attr('disabled', false).prop('value', "add section ");
                    });
               }
               return false;
               // remove the last element
               // enable the "add" button
               $('#btnAdd').attr('disabled', false);
          });
          $('#btnDel').at
          tr('disabled', true);
     });
</script>  