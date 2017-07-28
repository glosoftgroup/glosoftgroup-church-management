<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Expenses </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Expense" data-width="700" data-toggle="modal" data-placement="top" href="#Add_expense">
                        <i class="icon-plus"></i> Add Expense
                    </a>

                    <?php echo anchor('admin/expenses', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Expenses')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;"> 
            <div class="col-sm-12">
                <div class="col-sm-3">
                    <button class="btn btn-icon btn-block">
                        <i class="clip-database"></i><br>
                        Today's Expenses <span class="badge badge-info">KES <?php echo number_format($todays); ?></span>
                    </button>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-icon btn-block">
                        <i class="clip-pie"></i><br>
                        This Month's Expenses <span class="badge badge-info">KES <?php echo number_format($months); ?></span>
                    </button>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-icon btn-block">
                        <i class="clip-folder"></i><br>
                        This Year's Expenses <span class="badge badge-info">KES <?php echo number_format($years); ?></span>
                    </button>
                </div>
            </div>


            <div class="widget-main">


                <?php if ($expenses): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Date</th>
                             <th>Item</th>
                             <th>Category</th>
                             <th>Amount</th>
                             <th>Person Responsible</th>
                             <th>Receipt</th>
                             <th>Recorded By</th>

                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($expenses as $p):
                                       $u = $this->ion_auth->get_user($p->created_by);
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><a data-toggle="modal" class="tooltips" data-original-title="View Details" data-placement="top" role="button" href="#modal<?php echo $p->id; ?>"><i class="icon-double-angle-right"></i> <?php echo date('d M Y', $p->date); ?></a></td>

                                          <td><a class="tooltips" data-original-title="View only <?php echo isset($p->item) ? $expenses_items[$p->item] : ''; ?> Items" href="<?php echo base_url('admin/expenses/by_item/' . $p->item); ?>"><i class="icon-double-angle-right"></i> <?php echo $expenses_items[$p->item]; ?></a></td>

                                          <td>
                                              <a class="tooltips" data-original-title="View only <?php echo isset($p->category) ? $expenses_category[$p->category] : ''; ?> Category" href="<?php echo base_url('admin/expenses/by_category/' . $p->category); ?>"> 
                                                  <i class="icon-double-angle-right"></i> <?php echo $expenses_category[$p->category]; ?>
                                              </a>
                                          </td>
                                          <td><?php echo number_format($p->amount, 2); ?></td>
                                          <td><?php echo $users[$p->person_responsible]; ?></td>
                                          <td>
                                               <?php if (!empty($p->file))
                                               {
                                                    ?>
                                                   <a href='<?php echo site_url('uploads/files/' . $p->file); ?>' />Download Receipt</a>
                                              <?php
                                              }
                                              else
                                              {
                                                   ?>
                                                   No Receipt Att.
              <?php } ?>
                                          </td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>

                                          <td width='100'>
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#Edit_<?php echo $p->id; ?>"><i class='icon-edit'></i>  Edit
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#modal<?php echo $p->id; ?>">
                                                                  <i class='icon-share'></i> View
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/expenses/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Remove
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                  <div class="modal fade" id="modal<?php echo $p->id; ?>" tabindex="-1" data-width="700" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Expense Date: <?php echo date('d M Y', $p->date); ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Item:</span> 
                                                      <span class="col-sm-4"><?php echo $expenses_items[$p->item]; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Category:</span> 
                                                      <span class="col-sm-4"><?php echo $expenses_category[$p->category]; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Amount:</span> 
                                                      <span class="col-sm-4"><?php echo number_format($p->amount, 2); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Person Responsible:</span> 
                                                      <span class="col-sm-4"><?php echo $users[$p->person_responsible]; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Receipt:</span> 
                                                      <span class="col-sm-4"><?php if (!empty($p->file))
              {
                   ?>
                                                               <a href='<?php echo site_url('uploads/files/' . $p->file); ?>' />Download Receipt</a>
                                                          <?php
                                                          }
                                                          else
                                                          {
                                                               ?>
                                                               No Receipt Att.
              <?php } ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Recorded By:</span> 
                                                      <span class="col-sm-4"><?php echo $u->first_name . ' ' . $u->last_name; ?></span>
                                                  </p>

                                              </div>
                                              <div class="modal-footer">
                                                  <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">
                                                      Close
                                                  </button>

                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <!-----------------------------EDIT MODAL------------------------->
                                  <div class="modal fade" id="Edit_<?php echo $p->id; ?>" tabindex="-1" data-width="700" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog7">
              <?php
              $attributes = array('class' => 'form-horizontal', 'id' => '');
              echo form_open_multipart('admin/expenses/edit/' . $p->id . '/1', $attributes);
              ?>
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Edit Expense Entries</h4>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='date'>
                                                      Date
                                                  </label>
                                                  <div class="col-sm-6 input-group">

                                                      <input id='date_' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date', $p->date > 0 ? date('d M Y', $p->date) : $p->date); ?>"  />
                                                      <i style="color:red"><?php echo form_error('date'); ?></i>
                                                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                                                  </div>
                                                  </p>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='item'>Item</label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php echo form_dropdown('item', $expenses_items, (isset($result->item)) ? $result->item : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> 
                                                      <i style="color:red"><?php echo form_error('item'); ?></i>
                                                  </div>
                                                  </p>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div id="entry1" class="clonedInput">
                                                      <label class='col-sm-3 control-label' for='category'>Category </label>
                                                      <div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php echo form_dropdown('category', $expenses_category, (isset($result->category)) ? $result->category : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> 
                                                          <i style="color:red"><?php echo form_error('category'); ?></i>
                                                      </div>
                                                      </p>
                                                      <div class="clearfix"></div>
                                                  </div>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div id="entry1" class="clonedInput">
                                                      <label class='col-sm-3 control-label' for='amount'>Amount </label>
                                                      <div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php echo form_input('amount', $p->amount, 'id="amount_"  class="form-control" '); ?>
                                                          <i style="color:red"><?php echo form_error('amount'); ?></i>
                                                      </div>
                                                      </p>
                                                      <div class="clearfix"></div>
                                                  </div>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div id="entry1" class="clonedInput">
                                                      <label class='col-sm-3 control-label' for='person_responsible'>Person Responsible</label>
                                                      <div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php echo form_input('person_responsible', $users[$p->person_responsible], 'id="person_responsible_"  class="form-control" '); ?>
                                                          <i style="color:red"><?php echo form_error('person_responsible'); ?></i>
                                                      </div>
                                                      </p>
                                                      <div class="clearfix"></div>
                                                  </div>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div id="entry1" class="clonedInput">
                                                      <label class='col-sm-3 control-label' for='file'>Receipt</label>
                                                      <div class="col-sm-8 input-group">
                                                          <input id='file' type='file' name='file' />
              <?php if ($updType == 'edit'): ?>
                                                               <a href='/public/uploads/expenses/files/<?php echo $result->file ?>' />Download actual file (file)</a>
              <?php endif ?>

                                                          <br/><i style="color:red"><?php echo form_error('file'); ?></i>
                                                           <?php echo ( isset($upload_error['file'])) ? $upload_error['file'] : ""; ?>
                                                      </div>
                                                      </p>
                                                      <div class="clearfix"></div>

                                                      <div class="modal-footer">
              <?php echo form_submit('submit', ($updType == 'edit') ? 'Update Changes' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                                                          <button type="button" data-dismiss="modal" class="btn btn-default">
                                                              Close
                                                          </button>
                                                      </div>
                                                  </div><?php echo form_close(); ?>
                                              </div>

                                          </div>
         <?php endforeach ?>
                                     </tbody>

                                     </table>

         <?php echo $links; ?>
                                 </div>
                             </div><?php else: ?>
                             <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?>
            </div>
        </div>



        <!-----------------------------ADD MODAL------------------------->
        <div class="modal fade" id="Add_expense" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog7">
<?php
    $attributes = array('class' => 'form-horizontal', 'id' => '');
    echo form_open_multipart('admin/expenses/create/', $attributes);
?>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title">Add New Expense</h4>
                        <div class="clearfix"></div>
                    </div>
                    <p>
                    <div class="clearfix"></div>
                    <div id="entry1" class="clonedInput">
                        <label class=' col-sm-3 control-label' for='date'>Date<span class='required'>*</span>
                        </label>
                        <div class="col-sm-8 input-group">
                            <input id='date_' type='text' name='date' maxlength='' class='form-control date-picker'   />

                            <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </p>
                    <p>
                    <div class="clearfix"></div>
                    <div id="entry1" class="clonedInput">
                        <label class='col-sm-3 control-label' for='item'>Item<span class='required'>*</span> </label>
                        <div class="col-sm-8 input-group">
                            <span class="input-group-addon"> <i class="clip-bubble-2"></i> </span>
<?php echo form_dropdown('item', $expenses_items, (isset($result->item)) ? $result->item : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> 
                            <span data-toggle="modal"  role="button" href="#myModal1" class="input-group-addon btn btn-primary btn-squared"> <i class="icon-plus"></i> Add Item </span><i style="color:red"><?php echo form_error('item'); ?></i>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </p>
                    <p>
                    <div class="clearfix"></div>
                    <div id="entry1" class="clonedInput">
                        <label class='col-sm-3 control-label' for='category'>Category<span class='required'>*</span> </label>
                        <div class="col-sm-8 input-group">
                            <span class="input-group-addon"> <i class="clip-bubble-2"></i> </span>
<?php echo form_dropdown('category', $expenses_category, (isset($result->category)) ? $result->category : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> 
                            <span data-toggle="modal"  role="button" href="#myModal2" class="input-group-addon btn btn-primary btn-squared"> <i class="icon-plus"></i> Add Category </span><i style="color:red"><?php echo form_error('category'); ?></i>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </p>
                    <p>
                    <div class="clearfix"></div>
                    <div id="entry1" class="clonedInput">
                        <label class='col-sm-3 control-label' for='amount'>Amount<span class='required'>*</span> </label>
                        <div class="col-sm-8 input-group">
                            <span class="input-group-addon"> <i class="icon-money"></i> </span>
                            <input id='amount' type='text' name='amount' maxlength='' class='form-control '/>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </p>
                    <p>
                    <div class="clearfix"></div>
                    <div id="entry1" class="clonedInput">
                        <label class='col-sm-3 control-label' for='person_responsible'>Person Responsible<span class='required'>*</span> </label>
                        <div class="col-sm-8 input-group">
                            <span class="input-group-addon"> <i class="icon-user"></i> </span>
<?php echo form_dropdown('person_responsible', array('' => 'Select Person Responsible') + $users, (isset($result->person_responsible)) ? $result->person_responsible : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('person_responsible'); ?></i>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </p>
                    <p>
                    <div class="clearfix"></div>
                    <div id="entry1" class="clonedInput">
                        <label class=' col-sm-3 control-label' for='file'>Upload (file) </label>
                        <div class="col-sm-8">
                            <input id='file' type='file' name='file' />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </p>
                    <p>
                    <div class="clearfix"></div>
                    <div id="entry1" class="clonedInput">
                        <label class='col-sm-3 control-label' for='description'>Description</label>
                        <div class="col-sm-8 input-group">

                            <span class="input-group-addon"> <i class="clip-clip"></i> </span>
                            <textarea id="description" rows="9" class="autosize-transition ckeditor1 form-control "  name="description"  /></textarea>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </p>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                        <button type="button" data-dismiss="modal" class="btn btn-default">
                            Close
                        </button>
                    </div>
                </div><?php echo form_close(); ?>
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?php echo site_url('admin/expenses_items/quick_add'); ?>" class='form-horizontal' method="POST" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title">Add Expense Item</h4>
                        </div>
                        <div class="modal-body">
                            <div class='form-group'>
                                <label class=' col-sm-4 control-label' for='description'>Item Name <span class='required'>*</span></label>
                                <div class="col-sm-6"> 
<?php echo form_input('name', '', 'id="name"  class="form-control" '); ?>
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

        <!-- Modal -->
        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?php echo site_url('admin/expenses_category/quick_add'); ?>" class='form-horizontal' method="POST" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title">Add Expense Category</h4>
                        </div>
                        <div class="modal-body">
                            <div class='form-group'>
                                <label class=' col-sm-4 control-label' for='description'>Category Name <span class='required'>*</span></label>
                                <div class="col-sm-6"> 
<?php echo form_input('name', '', 'id="name"  class="form-control" '); ?>
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
