<!-- start: PAGE CONTENT -->
<?php $me = $this->ion_auth->get_user($id); ?>
<div class="panel-heading">
    <i class="icon-external-link-sign"></i>
    <h3 class="panel-title">User Profile </h3>

    <div class="heading-elements">
        <div class="btn-group">
             <?php echo anchor('admin/users/create', '<i class="icon-plus-sign-alt"></i> <span> </span>', 'class="btn btn-primary"'); ?> 
             <?php echo anchor('admin/users', '<i class="icon-list"></i> <span></span>', 'class="btn btn-info"'); ?> 
        </div>
    </div>
</div>   

<div class="tabbable">
    <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
        <li class="active">
            <a data-toggle="tab" href="#panel_overview">
                Personal Details
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#panel_edit_account">
                Edit Account
            </a>
        </li>

    </ul>
    <div class="tab-content">
        <div id="panel_overview" class="tab-pane in active">
            <div class="row">
                <div class="col-sm-5 col-md-4">
                    <div class="user-left">
                        <div class="center">
                            <h4> <?php echo $me->first_name . ' ' . $me->last_name; ?></h4>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="user-image">
                                    <div class="fileupload-new thumbnail">
                                        <img src="<?php echo base_url('uploads/files/m1.png'); ?>" alt="">
                                    </div>

                                </div>
                            </div>

                        </div>
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">Contact Information</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>
                                        <a href="#">
                                             <?php echo $me->first_name . ' ' . $me->last_name; ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>email:</td>
                                    <td>
                                        <a href="">
                                             <?php echo $me->email ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>phone:</td>
                                    <td><?php echo $me->phone; ?></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <a href="">
                                             <?php
                                                 if ($me->active == 1)
                                                 {
                                                      echo '<span class="label label-sm label-info">Active</span>';
                                                 }
                                                 else
                                                 {

                                                      '<span class="label label-sm label-danger">Deactivated</span>';
                                                 }
                                             ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">General information</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Position</td>
                                    <td>
                                         <?php
                                             if ($me->group_id == 1)
                                             {
                                                  echo '<span class="label label-sm label-success">Administrator</span>';
                                             }
                                             else
                                             {

                                                  '<span class="label label-sm label-primary">Others</span>';
                                             }
                                         ?>
                                    </td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Date Joined</td>
                                    <td><?php echo date('d M Y', $me->created_on); ?></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Last Logged In</td>
                                    <td><?php echo date('d M Y', $me->last_login); ?></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>

                                <tr>
                                    <td>Activation Code</td>
                                    <td>
                                        <a href="#">
                                             <?php echo $me->activation_code; ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="col-sm-7 col-md-8">
                    <h4>My Bio</h4>
                    <p>
                         <?php echo $me->bio; ?>
                    </p>
                    <div class="row">
                        <div class="col-sm-3">
                            <a href="<?php echo site_url('admin/task_manager'); ?>">
                                <button class="btn btn-icon btn-block">
                                    <i class="clip-clip"></i>
                                    All Tasks <span class="badge badge-info"> <?php echo $count_tasks; ?> </span>
                                </button>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="<?php echo site_url('admin/sms'); ?>">
                                <button class="btn btn-icon btn-block pulsate">
                                    <i class="clip-bubble-2"></i>
                                    My Messages <span class="badge badge-info"> <?php echo $my_count_sms; ?> </span>
                                </button>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="<?php echo site_url('admin/admin/calendar'); ?>">
                                <button class="btn btn-icon btn-block">
                                    <i class="clip-calendar"></i>
                                    Calendar <span class="badge badge-info"><?php echo $events + $meetings; ?> </span>
                                </button>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-icon btn-block">
                                <i class="clip-list-3"></i>
                                Notifications <span class="badge badge-info"> 9 </span>
                            </button>
                        </div>
                    </div>
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <i class="clip-checkmark-2"></i>
                            To Do
                            <div class="heading-elements">
                                <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                                </a>
                                <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="btn btn-xs btn-link panel-refresh" href="#">
                                    <i class="fa fa-refresh"></i>
                                </a>
                                <a class="btn btn-xs btn-link panel-close" href="#">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body panel-scroll" style="height:380px">

                            <div class="widget-main">


                                <?php if ($tasks): ?>
                                         <div class='clearfix'></div>
                                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                                             <thead>
                                             <th>#</th>
                                             <th>Date</th>
                                             <th>Title</th>
                                             <th>Status</th>
                                             <th>Description</th>	
                                             <th ><?php echo lang('web_options'); ?></th>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $i = 0;


                                                  foreach ($tasks as $p):
                                                       $i++;
                                                       ?>
                                                      <tr>
                                                          <td><?php echo $i . '.'; ?></td>
                                                          <td><?php echo date('d M Y', $p->date); ?></td>				
                                                          <td><?php echo $p->title; ?></td>
                                                          <td><?php
                                                               if ($p->status == "Completed")
                                                                    echo '<span class="label label-success">Completed</span>';
                                                               else if ($p->status == "Ongoing")
                                                                    echo '<span class="label label-info">Ongoing</span>';else if ($p->status == "Stalled")
                                                                    echo '<span class="label label-warning">Stalled</span>';
                                                               else
                                                                    echo '<span class="label label-danger">Cancelled</span>';
                                                               ?></td>
                                                          <td><?php echo $p->description; ?></td>
                                                          <td width='100'>
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
                                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/task_manager/delete/' . $p->id . '/' . $page); ?>'>
                                                                                  <i class='icon-remove'></i> Remove
                                                                              </a>
                                                                          </li>
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
                                                                  <h4 class="modal-title">Title: <?php echo $p->title; ?></h4>
                                                              </div>
                                                              <div class="modal-body">
                                                                  <p>
                                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Date:</span> 
                                                                      <span class="col-sm-4"><?php echo date('d M Y', $p->date); ?></span>
                                                                  </p>
                                                                  <div class="clearfix"><hr></div>
                                                                  <p>
                                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Status:</span> 
                                                                      <span class="col-sm-4" ><?php
                                                             if ($p->status == "Completed")
                                                                  echo '<span class="label label-success">Completed</span>';
                                                             else if ($p->status == "Ongoing")
                                                                  echo '<span class="label label-info">Ongoing</span>';else if ($p->status == "Stalled")
                                                                  echo '<span class="label label-warning">Stalled</span>';
                                                             else
                                                                  echo '<span class="label label-danger">Cancelled</span>';
                                                             ?></span>
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
                                                      <div class="modal-dialog7">
              <?php
              $attributes = array('class' => 'form-horizontal', 'id' => '');
              echo form_open_multipart('admin/task_manager/edit/' . $p->id . '/1', $attributes);
              ?>
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                                      &times;
                                                                  </button>
                                                                  <h4 class="modal-title">Edit Task</h4>
                                                                  <div class="clearfix"></div>
                                                              </div>
                                                              <p>
                                                              <div class="clearfix"></div>
                                                              <div id="entry1" class="clonedInput">
                                                                  <label class=' col-sm-3 control-label' for='date'>Date<span class='required'>*</span></label>
                                                                  <div class="col-sm-6 input-group">								
                                                                      <input id='date_' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date', $p->date > 0 ? date('d M Y', $p->date) : $p->date); ?>"/><i style="color:red"><?php echo form_error('date'); ?></i>
                                                                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                                                                  </div>
                                                                  </p>
                                                                  <div class="clearfix"></div>
                                                              </div>
                                                              <p>
                                                              <div class="clearfix"></div>
                                                              <div id="entry1" class="clonedInput">
                                                                  <label class='col-sm-3 control-label' for='title'>Title </label>
                                                                  <div class="col-sm-8 input-group">
                                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                                      <?php echo form_input('title', $p->title, 'id="title_"  class="form-control" '); ?>
                                                                      <i style="color:red"><?php echo form_error('title'); ?></i>
                                                                  </div>
                                                                  <div class="clearfix"></div>
                                                              </div>
                                                              </p>
                                                              <p>
                                                              <div class="clearfix"></div>
                                                              <div id="entry1" class="clonedInput">
                                                                  <label class='col-sm-3 control-label' for='status'>Status</label>
                                                                  <div class="col-sm-8 input-group">
                                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php
              $items = array('' => '', "Completed" => "Completed",
                      "Ongoing" => "Ongoing",
                      "Stalled" => "Stalled",
                      "Cancelled" => "Cancelled",);
              echo form_dropdown('status', $items, (isset($result->status)) ? $result->status : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
              ?> <i style="color:red"><?php echo form_error('status'); ?></i>
                                                                  </div>
                                                                  <div class="clearfix"></div>
                                                              </div>
                                                              </p>
                                                              <p>
                                                              <div class="clearfix"></div>
                                                              <div id="entry1" class="clonedInput">
                                                                  <label class='col-sm-3 control-label' for='description'>Description </label>
                                                                  <div class="col-sm-8 input-group">
                                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php echo form_input('description', $p->description, 'id="description_"  class="form-control" '); ?>
                                                                      <i style="color:red"><?php echo form_error('description'); ?></i>
                                                                  </div>
                                                                  <div class="clearfix"></div>
                                                              </div>
                                                              </p>

                                                              <div class="modal-footer">
                                                                  <button type="submit"class="btn btn-info">
                                                                      Save Changes
                                                                  </button>

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
                                     </div>

    <?php else: ?>
                                     <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="panel_edit_account" class="tab-pane">

            <!-----Body ------------->
        </div>
    </div>
</div>

<!-- end: PAGE CONTENT-->