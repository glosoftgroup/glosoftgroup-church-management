<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Prayer Requests </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Prayer Request" data-width="700" data-toggle="modal" data-placement="top" href="#Add_prayer_requests">
                        <i class="icon-plus"></i> Add Prayer Request
                    </a>

                    <?php echo anchor('admin/prayer_requests', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Prayer_Requests')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($prayer_requests): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Request Date</th>
                             <th>Phone Number</th>
                             <th>First Name</th>
                             <th>Second Name</th>
                             <th>Address</th>
                             <th>Membership</th>
                             <th>Prayer Request</th>	
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($prayer_requests as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>
                                          <td><a data-toggle="modal" class="tooltips" data-original-title="View Details" data-placement="top" role="button" href="#modal<?php echo $p->id; ?>"><i class="icon-double-angle-right"></i> <?php echo date('d M Y', $p->request_date); ?></a></td>				
                                          <td><?php echo $p->phone_number; ?></td>
                                          <td><?php echo $p->first_name; ?></td>
                                          <td><?php echo $p->second_name; ?></td>
                                          <td><?php echo $p->address; ?></td>
                                          <td><?php
                                               if ($p->membership == 0)
                                                    echo 'Member';
                                               else
                                                    echo 'Visitor';
                                               ?></td>
                                          <td><?php echo $p->prayer_request; ?></td>
                                          <td >
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#Edit_<?php echo $p->id; ?>"><i class='icon-edit'></i> Edit
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#modal<?php echo $p->id; ?>">
                                                                  <i class='icon-share'></i> View
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/prayer_requests/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Remove
                                                              </a>
                                                          </li>
                                                      </ul>
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
                                                  <h4 class="modal-title">Request Date: <?php echo date('d M Y', $p->request_date); ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Phone Number:</span> 
                                                      <span class="col-sm-4"><?php echo $p->phone_number; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">First Name:</span> 
                                                      <span class="col-sm-4"><?php echo $p->first_name; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Second Name:</span> 
                                                      <span class="col-sm-4"><?php echo $p->second_name; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Address:</span> 
                                                      <span class="col-sm-4"><?php echo $p->address; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Membership:</span> 
                                                      <span class="col-sm-4"><?php echo ucwords($p->membership); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Prayer Request:</span> 
                                                      <span class="col-sm-4"><?php echo $p->prayer_request; ?></span>
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
                                  <div class="modal fade" id="Edit_<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog7">
                                           <?php
                                           $attributes = array('class' => 'form-horizontal', 'id' => '');
                                           echo form_open_multipart('admin/prayer_requests/edit/' . $p->id . '/1', $attributes);
                                           ?>
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Edit Prayer Request</h4>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='request_date'>Request Date
                                                  </label>
                                                  <div class="col-sm-6 input-group">

                                                      <input id='request_date_' type='text' name='request_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('request_date', $p->request_date > 0 ? date('d M Y', $p->request_date) : $p->request_date); ?>"  />
                                                      <i style="color:red"><?php echo form_error('request_date'); ?></i>
                                                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='phone_number'>Phone Number </label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                      <?php echo form_input('phone_number', $p->phone_number, 'id="phone_number_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('phone_number'); ?></i>
                                                  </div>
                                                  </p>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='first_name'>First Name</label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                      <?php echo form_input('first_name', $p->first_name, 'id="first_name_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('first_name'); ?></i>
                                                  </div>
                                                  </p>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div id="entry1" class="clonedInput">
                                                      <label class='col-sm-3 control-label' for='second_name'>Second Name </label>
                                                      <div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                          <?php echo form_input('second_name', $p->second_name, 'id="second_name_"  class="form-control" '); ?>
                                                          <i style="color:red"><?php echo form_error('second_name'); ?></i>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                  </div>
                                                  </p>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div id="entry1" class="clonedInput">
                                                      <label class='col-sm-3 control-label' for='address'>Address </label>
                                                      <div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                          <?php echo form_input('address', $p->address, 'id="address_"  class="form-control" '); ?>
                                                          <i style="color:red"><?php echo form_error('address'); ?></i>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                  </div>
                                                  </p>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div id="entry1" class="clonedInput">
                                                      <label class='col-sm-3 control-label' for='membership'>Membership</label>
                                                      <div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                          <?php
                                                          $items = array('' => '', "member" => "Member", "visitor" => "Visitor",);
                                                          echo form_dropdown('membership', $items, (isset($result->membership)) ? $result->membership : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                                                          ?> <i style="color:red"><?php echo form_error('membership'); ?></i>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                  </div>
                                                  </p>
                                                  <div class="clearfix"></div>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div class='form-group'>
                                                      <label class=' col-sm-3 control-label' for='prayer_request'>Prayer Request </label><div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php echo form_input('prayer_request', $p->prayer_request, 'id="prayer_request_"  class="form-control" '); ?>
                                                          <i style="color:red"><?php echo form_error('prayer_request'); ?></i>
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
<div class="modal fade" id="Add_prayer_requests" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
         <?php
             $attributes = array('class' => 'form-horizontal', 'id' => '');
             echo form_open_multipart('admin/prayer_requests/create/', $attributes);
         ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Add New Prayer Request</h4>
                <div class="clearfix"></div>
            </div>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class=' col-sm-3 control-label' for='request_date'>Request Date<span class='required'>*</span>
                </label>
                <div class="col-sm-8 input-group">
                    <input id='request_date_' type='text' name='request_date' maxlength='' class='form-control date-picker'   />

                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='phone_number'>Phone Number<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-phone"></i> </span>
                    <input id='phone_number' type='text' name='phone_number' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='first_name'>First Name<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-user"></i> </span>
                    <input id='first_name' type='text' name='first_name' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='second_name'>Second Name<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-user"></i> </span>
                    <input id='second_name' type='text' name='second_name' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='address'>Address</label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-location"></i> </span>
                    <input id='address' type='text' name='address' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='membership'>Membership<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                     <?php
                         $items = array('' => '', "member" => "Member", "visitor" => "Visitor",
                         );
                         echo form_dropdown('membership', $items, (isset($result->membership)) ? $result->membership : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('membership'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='prayer_request'>Prayer Request<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-clip"></i> </span>
                    <textarea id="prayer_request"  class="autosize-transition form-control "  name="prayer_request"  /><?php echo set_value('prayer_request', (isset($result->prayer_request)) ? htmlspecialchars_decode($result->prayer_request) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('prayer_request'); ?></i>
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
