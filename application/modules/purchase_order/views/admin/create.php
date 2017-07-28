<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Purchase Orders </h3>
            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/purchase_order/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Purchase Orders')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/purchase_order', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Purchase Orders')) . '</span>', 'class="btn btn-info"'); ?> 
                     <?php echo anchor('admin/purchase_order/voided', '<i class="icon-list">
                </i> Voided Purchase Orders', 'class="btn btn-warning"'); ?>
                </div>
            </div>
        </div>
        <div class="panel-body" style="display: block;">    
            <div class='clearfix'></div>
            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open_multipart(current_url(), $attributes);
            ?>
            <div class="col-sm-4">
                <br>
                <br>
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='purchase_date'>
                        Date
                    </label>
                    <div class="col-sm-8 input-group">
                        <input id='purchase_date' type='text' name='purchase_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('purchase_date', $result->purchase_date > 0 ? date('d M Y', $result->purchase_date) : $result->purchase_date); ?>"  />
                        <i style="color:red"><?php echo form_error('purchase_date'); ?></i>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">	
                <br>
                <br>	
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='date'>
                        Due Date
                    </label>
                    <div class="col-sm-8 input-group">
                        <input id='due_date' type='text' name='due_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('due_date', $result->due_date > 0 ? date('d M Y', $result->due_date) : $result->due_date); ?>"  />
                        <i style="color:red"><?php echo form_error('due_date'); ?></i>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <br>
                <br>
                <div class='form-group'>
                    <div class="col-sm-3" for='supplier'>Supplier <span class='required'>*</span></div>
                    <div class="col-sm-8">
                         <?php echo form_dropdown('supplier', array('' => 'Select Supplier') + $address_book, (isset($result->supplier)) ? $result->supplier : '', ' class="search-select form-control" data-placeholder="Select  Options..." ');
                         ?>		
                         <?php echo form_error('supplier'); ?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <h3>Order Details</h3>
            <table class="table table-striped table-bordered table-hover" >
                <thead>
                    <tr>
                        <td width="4%">
                            #
                        </td>
                        <td width="24%">
                            Description
                        </td>
                        <td width="24%">
                            Quantity
                        </td>
                        <td width="24%">
                            Unit Price (Amount)
                        </td>
                        <td width="24%">
                            Sub Total
                        </td>
                    </tr>
            </table>
            <div id="entry1" class="clonedInput">
                <table class="table table-striped table-bordered table-hover" >
                    <tr>
                        <td width="4%">
                            <span id="reference" name="reference" class="heading-reference">1</span>
                        </td>
                        <td width="24%">
                            <input type="text" style="width:230px;" name="description[]" id="description" class="description">
                            <?php echo form_error('description'); ?>
                        </td>
                        <td width="24%">
                            <input type="text" name="quantity[]" onblur="totals()" id="quantity" class="quantity">
                            <?php echo form_error('quantity'); ?>
                        </td>
                        <td width="24%">
                            <input type="text" name="unit_price[]" onblur="totals()" id="unit_price" class="unit_price">
                            <?php echo form_error('unit_price'); ?>
                        </td>
                        <td width="24%" class="sub_total" id="sub_total">  
                            <?php echo number_format(0, 2); ?>   </td>
                    </tr> 
                    </tbody>
                </table>
            </div>
            <div class="actions">
                <a href="#" id="btnAdd" class="btn btn-success clone">Add New Line</a> 
                <a href="#" id="btnDel" class="btn btn-danger remove">Remove</a>
            </div>
            <div class="clearfix"></div>		
            <div class="col-sm-8">
                <div class='form-group'>
                    <h4 class=' col-sm-12 ' for='comment'>Comment </h4>
                    <div class="col-sm-12">
                        <textarea id="comment"  style="height: 100px;" class="autosize-transition ckeditor1 form-control "  name="comment"  /><?php echo set_value('comment', (isset($result->comment)) ? htmlspecialchars_decode($result->comment) : ''); ?></textarea>
                        <i style="color:red"><?php echo form_error('comment'); ?></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h4 class=' col-sm-12 ' for='comment'> </h4>
                <div class='form-group' style="border:none !important">
                    <div class="col-sm-3" for='vat'>VAT </div>
                    <div class="col-sm-4">
                        <input id='vat' type='radio' name='vat' checked="checked" value='1'  class="" <?php echo preset_radio('vat', '1', (isset($result->vat)) ? $result->vat : '' ) ?> />	<?php echo form_error('vat'); ?> Yes (16%) 
                    </div>
                    <div class="col-sm-3">
                        <input id='vat' type='radio' name='vat' value='2'  class="" <?php echo preset_radio('vat', '2', (isset($result->vat)) ? $result->vat : '' ) ?> />	<?php echo form_error('vat'); ?> No
                        <?php echo form_error('vat'); ?>
                    </div>
                </div>
                <div class='form-group' style="border:none !important">
                    <div class="col-sm-3" for='total'>TOTAL  </div><div class="col-sm-5">
                         <?php echo form_input('total', $result->total, 'id="total_" style="border:none !important" class="total "  '); ?>
                         <?php echo form_error('total'); ?>
                    </div>
                </div>
            </div>
            <div class='form-group'><label class="control-label"></div><div class="span10">
                <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save', (($updType == 'create') ? "id='submit' class='btn btn-primary''" : "id='submit' class='btn btn-primary'")); ?>
                <?php echo anchor('admin/purchase_order', 'Cancel', 'class="btn btn-default"'); ?>
            </div>
        </div>
    </div>   
</div>
<?php echo form_close(); ?>
</div>
<script>
     $(function ()
     {
          $('.unit_price').change(function ()
          {
               q = $(this).parent().prev().find('input.quantity').val();
               p = $(this).val();
               //alert(p);	 alert(q);
               var product = q * p;
               $('td:last', $(this).parents('tr')).html(number_to_currency(product));
               totals = 0;
               $('td.sub_total').each(function ()
               {
                    amt = parseFloat($(this).text().replace(/,/g, ''));
                    totals += amt;
               });
               $('input.total').val(totals);
          });
     });
     function number_to_currency(num)
     {
          return parseFloat(num).toFixed(2);
     }
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
               // subject - select-search
               newElem.find('.quantity').attr('id', 'ID' + newNum + '_quantity').val('');
               // start date name - text
               newElem.find('.description').attr('id', 'ID' + newNum + '_description').val('');
               // end name - text
               newElem.find('.unit_price').attr('id', 'ID' + newNum + '_unit_price').val('');
               newElem.find('.sub_total').attr('id', 'ID' + newNum + '_sub_total').html(number_to_currency(0));
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
