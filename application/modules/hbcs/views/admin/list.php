<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Hbcs </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Hbc" data-width="700" data-toggle="modal" data-placement="top" href="#Add_hbc">
                        <i class="icon-plus"></i> Add Hbc
                    </a>

                    <?php echo anchor('admin/hbcs', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Hbcs')) . '</span>', 'class="btn btn-info"'); ?>  
                    <a data-toggle="modal" style='' class="btn btn-warning" role="button" href="#HBCS">
                        <i class='icon-share'></i> Upload HBCs
                    </a>


                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($hbcs): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Name</th>
                             <th>Estate</th>
                             <th>Meeting Day</th>
                             <th>Meeting Time</th>
                             <th>Overall Leader</th>
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

                                  foreach ($hbcs as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><a data-toggle="modal"  class="tooltips" data-original-title="View Details" data-placement="top" role="button" href="#modal<?php echo $p->id; ?>" ><i class="icon-double-angle-right"></i> <?php echo ucwords($p->name); ?></a></td>
                                          <td><?php echo ucwords($p->estate); ?></td>
                                          <td><?php echo ucwords($p->meeting_day); ?></td>
                                          <td><?php echo $p->meeting_time; ?></td>
                                          <td>
                                              <a class="tooltips" data-original-title="View Profile" data-placement="top"href='<?php echo site_url('admin/members/profile/' . $p->overall_leader); ?>'><i class="icon-double-angle-right"></i> 
                                                  <?php if (!empty($p->overall_leader)) echo $host[$p->overall_leader]; ?></a></td>
                                          <td><?php echo $p->description; ?></td>

                                          <td width="100">
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#Edit_<?php echo $p->id; ?>"><i class='icon-edit'></i> Edit Details
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#modal<?php echo $p->id; ?>">
                                                                  <i class='icon-share'></i> View Details
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a style='color:green' href='<?php echo site_url('admin/hbc_meetings/meetings/' . $p->id); ?>'>
                                                                  <i class='icon-eye-open'></i> View Meetings
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:green' href='<?php echo site_url('admin/hbc_meetings/add/' . $p->id); ?>'>
                                                                  <i class='icon-calendar'></i> Add HBC Meeting
                                                              </a>
                                                          </li>


                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>

                                  <div class="modal fade" id="modal<?php echo $p->id; ?>" tabindex="-1" data-width="800" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Name: <span style="color:blue"><?php echo $p->name; ?></span> HBC</h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Estate:</span> 
                                                      <span class="col-sm-4"><?php echo $p->estate; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Meeting Day:</span> 
                                                      <span class="col-sm-4"><?php echo ucwords($p->meeting_day); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Meeting Time:</span> 
                                                      <span class="col-sm-4"><?php echo $p->meeting_time; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Overall Leader:</span> 
                                                      <span class="col-sm-7"><?php if (!empty($p->overall_leader)) echo ucwords($host[$p->overall_leader]); ?></span>
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

                                  <!-----------------------------EDIT MODAL------------------------->	
                                  <div class="modal fade" id="Edit_<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
                                           <?php
                                           $attributes = array('class' => 'form-horizontal', 'id' => '');
                                           echo form_open_multipart('admin/hbcs/edit/' . $p->id . '/1', $attributes);
                                           ?>
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Edit Home Based Church</h4>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='name'>Name <span class='required'>*</span></label><div class="col-sm-5">
                                                      <?php echo form_input('name', $p->name, 'id="name_"  class="form-control" '); ?><i style="color:red"><?php echo form_error('name'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='estate'>Estate <span class='required'>*</span></label><div class="col-sm-5">
                                                       <?php echo form_input('estate', $p->estate, 'id="estate_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('estate'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='meeting_day'>Meeting Day <span class='required'>*</span></label><div class="col-sm-5">
                                                       <?php
                                                       $items = array('' => 'Select Day',
                                                               "monday" => "Monday",
                                                               "tuesday" => "Tuesday",
                                                               "wednesday" => "Wednesday",
                                                               "thursady" => "Thursday",
                                                               "friday" => "Friday",
                                                               "saturday" => "Saturday",
                                                               "sunday" => "Sunday",);
                                                       echo form_dropdown('meeting_day', $items, (isset($result->meeting_day)) ? $result->meeting_day : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                                                       ?> <i style="color:red"><?php echo form_error('meeting_day'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='meeting_time'>Meeting Time <span class='required'>*</span></label><div class="col-sm-5 input-group input-append bootstrap-timepicker">
                                                      <?php echo form_input('meeting_time', $p->meeting_time, ' class="form-control time-picker" '); ?>	<i style="color:red"><?php echo form_error('meeting_time'); ?></i>
                                                      <span class="input-group-addon add-on"><i class="icon-time"></i></span>

                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='overall_leader'>Overall Leader <span class='required'>*</span></label><div class="col-sm-5">
                                                      <?php echo form_dropdown('overall_leader', array('' => 'Select Member') + $host, (isset($result->overall_leader)) ? $result->overall_leader : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('overall_leader'); ?></i>
                                                  </div>
                                                  <div class="clearfix"><br></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='description'>Description <span class='required'>*</span></label><div class="col-sm-5">
                                                       <?php echo form_input('description', $p->description, 'id="description_"  class="form-control" '); ?>
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
<div class="modal fade" id="Add_hbc" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
         <?php
             $attributes = array('class' => 'form-horizontal', 'id' => '');
             echo form_open_multipart('admin/hbcs/create/', $attributes);
         ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Add New HBC</h4>
                <div class="clearfix"></div>
            </div>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='name'>Name<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-bubble-2"></i> </span>
                    <input id='name' type='text' name='name' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='estate'>Estate<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-location"></i> </span>
                    <input id='estate' type='text' name='estate' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='meeting_day'>Meeting Day<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-calendar"></i> </span>
                    <?php
                        $items = array('' => 'Select Day', "monday" => "Monday", "tuesday" => "Tuesday",
                                "wednesday" => "Wednesday", "thursday" => "Thursday", "friday" => "Friday", "saturday" => "Saturday", "sunday" => "Sunday",);
                        echo form_dropdown('meeting_day', $items, (isset($result->meeting_day)) ? $result->meeting_day : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                    ?> <i style="color:red"><?php echo form_error('meeting_day'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='meeting_time'>Meeting Time<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group input-append bootstrap-timepicker">
                    <span class="input-group-addon add-on"><i class="icon-time"></i></span>
<?php echo form_input('meeting_time', '', ' class="form-control time-picker" '); ?>

                    <i style="color:red"><?php echo form_error('meeting_time'); ?></i>



                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='overall_leader'>Overall Leader<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
<?php echo form_dropdown('overall_leader', array('' => 'Select Member') + $host, (isset($result->overall_leader)) ? $result->overall_leader : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('overall_leader'); ?></i>
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


<!-----------------------------ADD MODAL------------------------->
<div class="modal fade" id="HBCS" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
        <form action="<?php echo base_url('admin/hbcs/upload_hbcsc'); ?>" method="post" enctype="multipart/form-data" name="form1" id="form1"> 

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">Add New HBC</h4>
                    <div class="clearfix"></div>
                </div>


                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='survey_date'>Choose CSV File <span class='error'>*</span></label><div class="col-sm-9">
                        <input name="csv" type="file" id="csv" /> <br>

                    </div>
                </div>




                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Save Changes
                    </button>
                    <button type="button" data-dismiss="modal" class="btn btn-default">
                        Close
                    </button>
                </div>
        </form> 
    </div>
</div>
</div>


</div>


