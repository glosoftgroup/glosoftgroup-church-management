<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Seed Planting </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/seed_planting/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Seed Planting')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/seed_planting', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Seed Planting')) . '</span>', 'class="btn btn-info"'); ?> 
                     <?php echo anchor('admin/seed_planting/voided', '<i class="icon-list-alt"></i> <span> Voided Seed Planting</span>', 'class="btn btn-warning"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   

            <div class="col-sm-12">
                <div class="col-sm-3">
                    <button class="btn btn-icon btn-block">
                        <i class="clip-database"></i><br>
                        Today's Seed Planting <span class="badge badge-info">KES <?php echo number_format($todays, 2); ?></span>
                    </button>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-icon btn-block">
                        <i class="clip-pie"></i><br>
                        This Month's  Seed Planting <span class="badge badge-info">KES <?php echo number_format($months, 2); ?></span>
                    </button>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-icon btn-block">
                        <i class="clip-folder"></i><br>
                        This Year's  Seed Planting <span class="badge badge-info">KES <?php echo number_format($years, 2); ?></span>
                    </button>
                </div>
            </div>	
            <div class="widget-main">


                <?php if ($seed_planting): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Date</th>

                             <th>Bank Deposited</th>
                             <th>Total</th>
                             <th>Treasurer</th>
                             <th>Confirmed By</th>
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

                                  foreach ($seed_planting as $p):
                                       $u = $this->ion_auth->get_user($p->created_by);
                                       $i++;
                                       ?>
                                      <tr>

                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo date('d M Y', $p->date); ?></td>
                                          <td><?php if (!empty($p->bank)) echo $banks[$p->bank]; ?></td>
                                          <td><a class="tooltips" data-original-title="View Details" data-placement="top" href='<?php echo site_url('admin/seed_planting/view_members/' . $p->id . '/' . $page); ?>'><i class="icon-double-angle-right"></i> <?php echo number_format($p->totals, 2); ?></a></td>
                                          <td><?php echo $users[$p->treasurer]; ?></td>
                                          <td><?php echo $users[$p->confirmed_by]; ?></td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                          <td><?php echo $p->description; ?></td>
                                          <td width=''>

                                              <div>
                                                  <div class='btn-group'>
                                                      <a data-toggle="modal" style='color:white' class="btn btn-primary btn-sm" role="button" href="#Edit_<?php echo $p->id; ?>"><i class='icon-edit'></i>Edit

                                                      </a>
                                                      <a class='btn btn-success btn-sm' href='<?php echo site_url('admin/seed_planting/view_members/' . $p->id . '/' . $page); ?>'>
                                                          <i class='icon-share'></i> View Members
                                                      </a>

                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                  <div class="modal fade" id="modal<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Member:</span> 
                                                      <span class="col-sm-4"><?php echo $members[$p->member]; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Amount:</span> 
                                                      <span class="col-sm-4"><?php echo number_format($p->amount, 2); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Bank:</span> 
                                                      <span class="col-sm-4"><?php if (!empty($p->bank_deposited)) echo $banks[$p->bank_deposited]; ?></span>
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
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Recorded By:</span> 
                                                      <span class="col-sm-4"><?php echo $u->first_name . ' ' . $u->last_name; ?></span>
                                                  </p>									
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Description:</span> 
                                                      <span class="col-sm-4"><?php echo $p->description; ?></span>
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
                                  <div class="modal fade" id="Edit_<?php echo $p->id; ?>" tabindex="-1" data-width="600" role="dialog" aria-hidden="true">

                                      <?php
                                      $attributes = array('class' => 'form-horizontal', 'id' => '');
                                      echo form_open_multipart('admin/seed_planting/edit/' . $p->id . '/1', $attributes);
                                      ?>
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                  &times;
                                              </button>
                                              <h4 class="modal-title">Edit Seed Planting Details</h4>
                                              <div class="clearfix"></div>
                                          </div>
                                          <p>
                                          <div class="clearfix"></div>
                                          <div id="entry1" class="clonedInput">
                                              <label class='col-sm-3 control-label' for='date'>Date </label>
                                              <div class="col-sm-8 input-group">
                                                  <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                                                  <input id='date' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date', $p->date > 0 ? date('d M Y', $p->date) : $p->date); ?>"  />
                                                  <i style="color:red"><?php echo form_error('date'); ?></i>
                                              </div>
                                              </p>
                                              <div class="clearfix"></div>
                                          </div>
                                          <p>
                                          <div class="clearfix"></div>
                                          <div id="entry1" class="clonedInput">
                                              <label class='col-sm-3 control-label' for='bank'>Amount </label>
                                              <div class="col-sm-8 input-group">
                                                  <span class="input-group-addon"> <i class="icon-money"></i> </span>
                                                  <?php
                                                  echo form_input('totals', number_format($p->totals, 2), 'id="totals" disabled class="form-control" ');
                                                  ?> <i style="color:red"><?php echo form_error('totals'); ?></i>
                                              </div>
                                              </p>

                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='bank'>Bank Deposited </label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-home"></i> </span>
                                                      <?php
                                                      echo form_dropdown('bank', array('' => 'Select Bank') + $banks, (isset($p->bank)) ? $p->bank : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                                                      ?> <i style="color:red"><?php echo form_error('bank'); ?></i>
                                                  </div>
                                                  </p>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div id="entry1" class="clonedInput">
                                                      <label class='col-sm-3 control-label' for='treasurer'>Treasurer<span class='required'>*</span> </label>
                                                      <div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                          <?php
                                                          echo form_dropdown('treasurer', array('' => 'Select Person Responsible') + $users, (isset($p->treasurer)) ? $p->treasurer : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                                                          ?> <i style="color:red"><?php echo form_error('treasurer'); ?></i>
                                                      </div>
                                                      </p>
                                                      <div class="clearfix"></div>
                                                  </div>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div id="entry1" class="clonedInput">
                                                      <label class='col-sm-3 control-label' for='confirmed_by'>Confirmed By<span class='required'>*</span> </label>
                                                      <div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                          <?php
                                                          echo form_dropdown('confirmed_by', array('' => 'Select Member') + $users, (isset($p->confirmed_by)) ? $p->confirmed_by : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                                                          ?> <i style="color:red"><?php echo form_error('confirmed_by'); ?></i>
                                                      </div>
                                                      </p>
                                                      <div class="clearfix"></div>
                                                  </div>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div class='form-group'>
                                                      <label class=' col-sm-3 control-label' for='description'>Description </label><div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="clip-clip"></i> </span>
                                                          <textarea id="description"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($p->description)) ? htmlspecialchars_decode($p->description) : ''); ?></textarea>
                                                          <i style="color:red"><?php echo form_error('description'); ?></i>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                  </div>
                                                  </p>


                                                  <div class="modal-footer">
                                                       <?php echo form_submit('submit', ($updType == 'edit') ? 'Update Changes' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                                                      <button type="button" data-dismiss="modal" class="btn btn-default">
                                                          Close
                                                      </button>
                                                  </div>
                                              </div><?php echo form_close(); ?>

                                          </div>
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

