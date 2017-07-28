<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Offerings </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Offering" data-width="700" data-toggle="modal" data-placement="top" href="#Add_offering">
                        <i class="icon-plus"></i> Add Offering
                    </a>

                    <?php echo anchor('admin/offerings', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Offerings')) . '</span>', 'class="btn btn-info"'); ?> 
                    <?php echo anchor('admin/offerings/voided', '<i class="icon-list-alt"></i> <span> Voided Offerings</span>', 'class="btn btn-warning"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   

            <div class="col-sm-12">
                <div class="col-sm-3">
                    <button class="btn btn-icon btn-block">
                        <i class="clip-database"></i><br>
                        Today's Offering <span class="badge badge-info">KES <?php echo number_format($todays, 2); ?></span>
                    </button>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-icon btn-block">
                        <i class="clip-pie"></i><br>
                        This Month's Offering <span class="badge badge-info">KES <?php echo number_format($months, 2); ?></span>
                    </button>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-icon btn-block">
                        <i class="clip-folder"></i><br>
                        This Year's Offering <span class="badge badge-info">KES <?php echo number_format($years, 2); ?></span>
                    </button>
                </div>
            </div>	


            <div class="widget-main">


                <?php if ($offerings): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Date</th>
                             <th>Amount Collected</th>
                             <th>Treasurer</th>
                             <th>Confirmed By</th>
                             <th>Bank</th>
                             <th>Recorded By</th>
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

                                  foreach ($offerings as $p):
                                       $u = $this->ion_auth->get_user($p->created_by);
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo date('d M Y', $p->date); ?></td>
                                          <td><a data-toggle="modal" class="tooltips" data-original-title="View Details" data-placement="top" role="button" href="#modal<?php echo $p->id; ?>"><i class="icon-double-angle-right"></i> <?php echo number_format($p->amount, 2); ?></a></td>
                                          <td><?php echo $users[$p->treasurer]; ?></td>
                                          <td><?php if (!empty($p->confirmed_by)) echo $users[$p->confirmed_by]; ?></td>
                                          <td><?php
                                               if (!empty($p->bank_deposited))
                                                    echo $banks[$p->bank_deposited];
                                               ?></td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                          <td><?php echo $p->description; ?></td>
                                          <td width='130'>
                                              <div>
                                                  <div class='btn-group'>


                                                      <a data-toggle="modal" class="btn btn-primary btn-sm" style='' role="button" href="#modal<?php echo $p->id; ?>">
                                                          <i class='icon-share'></i> View
                                                      </a>

                                                      <a  class="btn btn-danger btn-sm" onClick="return confirm('Are you sure you want to void this record?')" href='<?php echo site_url('admin/offerings/void/' . $p->id . '/' . $page); ?>'>
                                                          <i class='icon-remove'></i> Void
                                                      </a>

                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                  <div class="modal fade" id="modal<?php echo $p->id; ?>" tabindex="-1" data-width="600" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Offerings Date: <?php echo date('d M Y', $p->date); ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Amount Collected:</span> 
                                                      <span class="col-sm-4"><?php echo number_format($p->amount, 2); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Treasurer:</span> 
                                                      <span class="col-sm-4"><?php echo $users[$p->treasurer]; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Confirmed By:</span> 
                                                      <span class="col-sm-4"><?php if (!empty($p->confirmed_by)) echo $users[$p->confirmed_by]; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Bank:</span> 
                                                      <span class="col-sm-6"><?php if (!empty($p->bank_deposited)) echo $banks[$p->bank_deposited]; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Recorded By:</span> 
                                                      <span class="col-sm-4"><?php echo $u->first_name . ' ' . $u->last_name; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Description:</span> 
                                                      <span class="col-sm-7"><?php echo $p->description; ?></span>
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
                             <?php endforeach ?>
                             </tbody>

                         </table>

                         <?php echo $links; ?>
                     </div>
                 </div>
            <?php else: ?>
                 <p class='text'><?php echo lang('web_no_elements'); ?></p>
        <?php endif ?>
    </div>

</div>


<!-----------------------------ADD MODAL------------------------->
<div class="modal fade" id="Add_offering" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
         <?php
             $attributes = array('class' => 'form-horizontal', 'id' => '');
             echo form_open_multipart('admin/offerings/create/', $attributes);
         ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Add New Offering</h4>
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
                <label class='col-sm-3 control-label' for='treasurer'>Treasurer<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <?php echo form_dropdown('treasurer', array('' => 'Select Person Responsible') + $users, (isset($result->treasurer)) ? $result->treasurer : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('treasurer'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='confirmed_by'>Confirmed By<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <?php echo form_dropdown('confirmed_by', array('' => 'Select Member') + $users, (isset($result->confirmed_by)) ? $result->confirmed_by : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('confirmed_by'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='bank_deposited'>Bank Deposited</label>
                <div class="col-sm-8 input-group">
                    <?php echo form_dropdown('bank_deposited', array('' => 'Select Bank') + $banks, (isset($result->bank_deposited)) ? $result->bank_deposited : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('bank_deposited'); ?></i>
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
