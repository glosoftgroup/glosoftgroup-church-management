<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Meetings </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Meeting" data-width="700" data-toggle="modal" data-placement="top" href="#Add_meeting">
                        <i class="icon-plus"></i> Add Meeting
                    </a>

                    <?php echo anchor('admin/meetings', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Meetings')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($meetings): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>

                             <th>Title</th>
                             <th>Start Date</th>
                             <th>End Date</th>
                             <th>Venue</th>
                             <th>Guests</th>
                             <th>Importance</th>
                             <th>SMS Alert</th>

                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($meetings as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><a data-toggle="modal" class="tooltips" data-original-title="View Details" data-placement="top" role="button" href="#modal<?php echo $p->id; ?>"><i class="icon-double-angle-right"></i> <?php echo $p->title; ?></a></td>
                                          <td><?php echo date('d M Y', $p->start_date); ?></td>
                                          <td><?php echo date('d M Y', $p->end_date); ?></td>
                                          <td><?php echo $p->venue; ?></td>
                                          <td><?php echo ucwords($p->guests); ?></td>
                                          <td><?php echo $p->importance; ?></td>
                                          <td><?php if ($p->sms_alert == 1)
                              echo '<span class="label label-success">SMS sent</span>';
                         else
                              echo '<span class="label label-danger">No</span>';
                         ?></td>

                                          <td width='100'>
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>

                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#modal<?php echo $p->id; ?>">
                                                                  <i class='icon-share'></i>View Details
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/meetings/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Remove
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>

                                      <!------------------VIEW---------------------->
                                  <div class="modal fade" id="modal<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Title: <?php echo $p->title; ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Start Date:</span> 
                                                      <span class="col-sm-7"><?php echo date('d M Y', $p->start_date); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">End Date:</span> 
                                                      <span class="col-sm-7"><?php echo date('d M Y', $p->end_date); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Venue:</span> 
                                                      <span class="col-sm-7"><?php echo $p->venue; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Guests:</span> 
                                                      <span class="col-sm-7"><?php echo ucwords($p->guests); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Importance:</span> 
                                                      <span class="col-sm-7"><?php echo $p->importance; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">SMS Alert:</span> 
                                                      <span class="col-sm-7"><?php if ($p->sms_alert == 1)
                              echo '<span class="label label-success">SMS sent</span>';
                         else
                              echo '<span class="label label-danger">No</span>';
                         ?></span>
                                                  </p>
                                                  <p>
                                                  <div class="clearfix"><hr></div>
                                                  <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Description</span> <br>
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
<div class="modal fade" id="Add_meeting" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
<?php
    $attributes = array('class' => 'form-horizontal', 'id' => '');
    echo form_open_multipart('admin/meetings/create/', $attributes);
?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Add New Meeting</h4>
                <div class="clearfix"></div>
            </div>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='title'>Title<span class='required'>*</span> </label>
                <div class="col-sm-7 input-group">
                    <span class="input-group-addon"> <i class="clip-bubble-2"></i> </span>
                    <input id='title' type='text' name='title' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class=' col-sm-3 control-label' for='start_date'>Start Date<span class='required'>*</span>
                </label>
                <div class="col-sm-7 input-group">
                    <input id='start_date_' type='text' name='start_date' maxlength='' class='form-control date-picker'   />

                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class=' col-sm-3 control-label' for='end_date'>End Date<span class='required'>*</span>
                </label>
                <div class="col-sm-7 input-group">
                    <input id='end_date_' type='text' name='end_date' maxlength='' class='form-control date-picker' v />

                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='venue'>Venue<span class='required'>*</span> </label>
                <div class="col-sm-7 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
                    <input id='venue' type='text' name='venue' maxlength='' class='form-control'   />

                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='importance'>Importance<span class='required'>*</span> </label>
                <div class="col-sm-7 input-group">
                    <span class="input-group-addon"> <i class="clip-bubble-2"></i> </span>
<?php
    $items = array('' => '', "Low" => "Low", "Medium" => "Medium", "High" => "High",);
    echo form_dropdown('importance', $items, (isset($result->importance)) ? $result->importance : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('importance'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='status'>Status<span class='required'>*</span> </label>
                <div class="col-sm-7 input-group">
                    <span class="input-group-addon"> <i class="clip-bubble-2"></i> </span>
<?php
    $items = array("0" => "Draft", "1" => "Live",);
    echo form_dropdown('status', $items, (isset($result->status)) ? $result->status : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('status'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='guests'>Guests<span class='required'>*</span> </label>
                <div class="col-sm-7 input-group">
                    <span class="input-group-addon"> <i class="icon-group"></i> </span>
<?php
    $items = array('' => 'Meeting For', 'all members' => 'All Members', 'all staff' => 'All Staff Members', 'ministry' => 'To Ministry', 'hbc' => 'To HBC',);
    echo form_dropdown('guests', $items, (isset($result->guests)) ? $result->guests : '', ' id="form-field-select-1" onchange="show_field(this.value)" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('guests'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='title'>Alert Guest By SMS<span class='required'>*</span> </label>
                <div class="col-sm-7 input-group">
                    <span class="input-group-addon"> <i class="clip-mobile"></i> </span>
<?php
    $items = array("0" => "NO", "1" => "Yes",);
    echo form_dropdown('sms_alert', $items, (isset($result->sms_alert)) ? $result->sms_alert : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('sms_alert'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='description'>Description<span class='required'>*</span></label>
                <div class="col-sm-7 input-group">
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

