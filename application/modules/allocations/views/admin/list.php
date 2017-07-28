<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Allocations </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Petty Cash" data-width="700" data-toggle="modal" data-placement="top" href="#add_allocation"> New Allocations</a>
                    <?php //echo anchor( 'admin/allocations/create' , '<i class="icon-plus-sign-alt"></i> <span> '.lang('web_add_t', array(':name' => 'Allocations')).'</span>', 'class="btn btn-primary"');?> 
                    <?php echo anchor('admin/allocations', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Allocations')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($allocations): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Date</th>
                             <th>Ministry</th>
                             <th>Amount</th>
                             <th>Approved By</th>
                             <th>Confirmed By</th>
                             <th>Expenditure</th>
                             <th>Balance</th>
                             <th>Description</th>	
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($allocations as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo date('d M Y', $p->date); ?></td>
                                          <td><?php echo $mins[$p->ministry]; ?></td>
                                          <td><?php echo number_format($p->amount, 2); ?></td>
                                          <td><?php echo $users[$p->approved_by]; ?></td>
                                          <td><?php echo $users[$p->confirmed_by]; ?></td>
                                          <td><?php echo number_format($p->expenditure, 2); ?></td>
                                          <td><?php echo number_format($p->balance, 2); ?></td>
                                          <td><?php echo $p->description; ?></td>
                                          <td width="250">

                                              <div>
                                                  <div class='btn-group'>

                                                      <a class="btn btn-success btn-sm tooltips" data-original-title="New Petty Cash" data-width="700" data-toggle="modal" data-placement="top" href="#record_expenditure">
                                                          <i class='icon-edit'></i> Record Expenditure
                                                      </a>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                           <?php if (empty($p->expenditure))
                                                           {
                                                                ?>
                                                               <li role='presentation'>
                                                                   <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/allocations/edit/' . $p->id . '/' . $page); ?>'>
                                                                       <i class='icon-edit'></i> Edit Details
                                                                   </a>
                                                               </li>
              <?php } ?>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/allocations/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Void
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>


                                              </div>
                                          </td>


                                          <!--------------- Record Expenditure----------------->	
                                          <!-----------------------------ADD MODAL------------------------->
                                  <div class="modal fade" id="record_expenditure" tabindex="-1" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog7">
                                           <?php
                                           $attributes = array('class' => 'form-horizontal', 'id' => '');
                                           echo form_open_multipart('admin/allocations/record_expenditure/' . $p->id, $attributes);
                                           ?>
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Recording Expenditure for <span style="color:blue"><?php echo $mins[$p->ministry]; ?></span> [Amount Given: <?php echo number_format($p->amount, 2); ?> ]</h4>
                                                  <div class="clearfix"></div>
                                              </div>


                                              <p>
                                                  <input style="display:none" id='ministry' type='text' value="<?php echo $p->ministry; ?>" name='ministry' maxlength='' class='form-control '/>
                                              </p>

                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='expenditure'>Total Expenditure<span class='required'>*</span> </label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-money"></i> </span>
                                                      <input type='text' name='expenditure' id="expenditure" onblur="totals()" class="form-control" />
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>

                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='comment'>Description</label>
                                                  <div class="col-sm-8 input-group">

                                                      <span class="input-group-addon"> <i class="clip-clip"></i> </span>
                                                      <textarea id="comment" rows="9" class="autosize-transition ckeditor1 form-control "  name="comment"  /></textarea>
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

                                  <!-----------------END RECORD -------------------->
                                  </tr>


         <?php endforeach ?>
                             </tbody>

                         </table>

                         <?php echo $links; ?>
                    <?php else: ?>
                         <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?>
            </div>
        </div>
    </div>
</div>



<!-----------------------------ADD MODAL------------------------->
<div class="modal fade" id="add_allocation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
         <?php
             $attributes = array('class' => 'form-horizontal', 'id' => '');
             echo form_open_multipart('admin/allocations/create/', $attributes);
         ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Add New Allocation</h4>
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
                <label class='col-sm-3 control-label' for='item'>Ministry<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">

                    <?php
                        echo form_dropdown('ministry', array('' => 'Select Ministry') + (array) $mins, (isset($result->ministry)) ? $result->ministry : '', ' class="form-control search-select" ');
                        echo form_error('ministry');
                    ?>
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
                    <input  id="amount_"  type='text' name='amount' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='authorised_by'>Approved By<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
                    <?php
                        echo form_dropdown('approved_by', array('' => 'Select Member') + $users, (isset($result->approved_by)) ? $result->approved_by : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                    ?> <i style="color:red"><?php echo form_error('approved_by'); ?></i>

                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='authorised_by'>Confirmed By<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
                    <?php
                        echo form_dropdown('confirmed_by', array('' => 'Select Member') + $users, (isset($result->confirmed_by)) ? $result->confirmed_by : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                    ?> <i style="color:red"><?php echo form_error('confirmed_by'); ?></i>

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





