<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Other Revenues </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Revenue" data-width="700" data-toggle="modal" data-placement="top" href="#Add_payment">
                        <i class="icon-plus"></i> Add Revenue
                    </a>


                    <?php echo anchor('admin/other_revenues', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Other Revenues')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($other_revenues): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Date</th>
                             <th>Project</th>
                             <th>Amount</th>
                             <th>Collected By</th>				
                             <th>Bank</th>
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

                                  foreach ($other_revenues as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>				
                                          <td><?php echo date('d M Y', $p->date); ?></td>
                                          <td><?php echo $projects[$p->project]; ?></td>
                                          <td><?php echo number_format($p->amount, 2); ?></td>
                                          <td><?php echo $users[$p->collected_by]; ?></td>
                                          <td><?php echo isset($banks[$p->bank]) ? $banks[$p->bank] : ' '; ?></td>
                                          <td><?php echo $p->description; ?></td>
                                          <td width='100'>
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-danger dropdown-toggle btn-sm' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/other_revenues/delete/' . $p->id . '/' . $page); ?>'>
                                                          <i class='icon-trash'></i> Void 
                                                      </a>

                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                 <?php endforeach ?>
                             </tbody>

                         </table>

                         <?php echo $links; ?><?php else: ?>
                         <p class='text'><?php echo lang('web_no_elements'); ?></p>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>


<!-----------------------------ADD MODAL------------------------->
<div class="modal fade" id="Add_payment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
         <?php
             $attributes = array('class' => 'form-horizontal', 'id' => '');
             echo form_open_multipart('admin/other_revenues/create/', $attributes);
         ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Add New Revenue</h4>
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
                <label class='col-sm-3 control-label' for='confirmed_by'>Project<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                     <?php
                         echo form_dropdown('project', array('' => 'Select Project') + $projects + array('0' => 'Others'), (isset($result->project)) ? $result->project : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('project'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>

            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='amount'>Amount Collected<span class='required'>*</span> </label>
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
                <label class='col-sm-3 control-label' for='collected_by'>Collected By<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <?php echo form_dropdown('collected_by', array('' => 'Select Person Responsible') + $users, (isset($result->collected_by)) ? $result->collected_by : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('collected_by'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>

            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='bank'>Bank Deposited</label>
                <div class="col-sm-8 input-group">
                    <?php echo form_dropdown('bank', array('' => 'Select Bank') + $banks, (isset($result->bank)) ? $result->bank : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('bank'); ?></i>
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


