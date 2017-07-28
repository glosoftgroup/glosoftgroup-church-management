<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Task Manager </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/task_manager/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Task Manager')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/task_manager', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Task Manager')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($task_manager): ?>
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
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($task_manager as $p):
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
             </div>
         </div>

    <?php else: ?>
         <p class='text'><?php echo lang('web_no_elements'); ?></p>
                   <?php endif ?>