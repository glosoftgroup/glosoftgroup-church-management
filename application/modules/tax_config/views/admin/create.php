<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Deduction </h3>
            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/tax_config/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Tax')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/tax_config', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Taxes')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>
        <div class="panel-body" style="display: block;">   
             <?php
                 $attributes = array('class' => 'form-horizontal', 'id' => '');
                 echo form_open_multipart(current_url(), $attributes);
             ?>
            <!-- END ADVANCED SEARCH EXAMPLE -->
            <!-- BEGIN TABLE DATA -->
            <div class="col-sm-8">
                <table class="table table-striped table-bordered table-hover" >
                    <!-- BEGIN -->
                    <thead>
                        <tr role="row">
                            <th width="3%">#</th>
                            <th width="50%" >Name</th>
                            <th width="50%">Percentage(%)</th>
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
                                <td width="50%">
                                    <input type="text" name="name[]" id="name" class="name" value="<?php
                                        if (!empty($result->name))
                                        {
                                             echo $result->name;
                                        }
                                    ?>">
                                           <?php echo form_error('name'); ?>
                                </td> 
                                <td width="50%">
                                    <input type="text" name="amount[]" id="amount" placeholder="E.g 16" class="amount" value="<?php
                                        if (!empty($result->amount))
                                        {
                                             echo $result->amount;
                                        }
                                    ?>">
                                           <?php echo form_error('amount'); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="actions">
                    <a href="#" id="btnAdd" class="btn btn-success clone">Add New Line</a> 
                    <a href="#" id="btnDel" class="btn btn-danger remove">Remove</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr>
            <div class='row-form'><div class="span2"></div><div class="span10">
                      <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save', (($updType == 'create') ? "id='submit' class='btn btn-primary''" : "id='submit' class='btn btn-primary'")); ?>
                      <?php echo anchor('admin/tax_config', 'Cancel', 'class="btn  btn-default"'); ?>
                </div></div>
            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div>
    <script type="text/javascript">
         $(function ()
         {
              $('#btnAdd').click(function ()
              {
                   //$('input.timepicker').eq(0).clone().removeClass("hasTimepicker").prependTo('#entry2');
                   var num = $('.clonedInput').length, // how many "duplicatable" input fields we currently have
                           newNum = new Number(num + 1), // the numeric ID of the new input field being added
                           newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
                   // manipulate the name/id values of the input inside the new element
                   // H2 - section
                   newElem.find('.heading-reference').attr('id', 'reference').attr('name', 'reference').html(' ' + newNum);
                   // subject - select
                   newElem.find('.name').attr('id', 'ID' + newNum + '_name').val('');
                   newElem.find('.amount').attr('id', 'ID' + newNum + '_amount').val('');
                   // insert the new element after the last "duplicatable" input field
                   $('#entry' + num).after(newElem);
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