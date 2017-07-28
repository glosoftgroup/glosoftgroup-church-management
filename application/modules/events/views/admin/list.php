<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Events </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Event" data-width="700" data-toggle="modal" data-placement="top" href="#Add_event">
                        <i class="icon-plus"></i> Add Event
                    </a>

                    <?php echo anchor('admin/events', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Events')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($events): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Title</th>
                             <th>Start Date</th>
                             <th>End Date</th>
                             <th>Venue</th>
                             <th>File</th>
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

                                  foreach ($events as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><a data-toggle="modal" class="tooltips" data-original-title="View Details" data-placement="top" role="button" href="#modal<?php echo $p->id; ?>"><i class="icon-double-angle-right"></i> <?php echo $p->title; ?></a></td>
                                          <td><?php echo date('d M Y', $p->start_date); ?></td>
                                          <td><?php echo date('d M Y', $p->end_date); ?></td>
                                          <td><?php echo $p->venue; ?></td>
                                          <td>
                                               <?php if (!empty($p->file))
                                               {
                                                    ?>
                                                   <a href='<?php echo site_url('uploads/files/' . $p->file); ?>' />Download file (file)</a>
              <?php } ?>
                                          </td>
                                          <td><?php if ($p->status == 1)
                   echo '<span class="label label-success">Live</span>';
              else
                   echo '<span class="label label-danger">Draft</span>';
              ?></td>
                                          <td><?php echo substr($p->description, 0, 30) . '...'; ?></td>
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
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/events/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Remove
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                      <!------------------VIEW---------------------->
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
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Start Date:</span> 
                                                      <span class="col-sm-4"><?php echo date('d M Y', $p->start_date); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">End Date:</span> 
                                                      <span class="col-sm-4"><?php echo date('d M Y', $p->end_date); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Venue:</span> 
                                                      <span class="col-sm-4"><?php echo $p->venue; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">File:</span> 
                                                      <span class="col-sm-7"><?php if (!empty($p->file))
              {
                   ?><a href='<?php echo site_url('uploads/files/' . $p->file); ?>' />Download file (file)</a><?php } ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Status:</span> 
                                                      <span class="col-sm-4"><?php if ($p->status == 1)
                   echo '<span class="label label-success">Live</span>';
              else
                   echo '<span class="label label-danger">Draft</span>';
              ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Description:</span> 
                                                      <span class="col-sm-4"><?php echo $p->description; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
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
              echo form_open_multipart('admin/events/edit/' . $p->id . '/1', $attributes);
              ?>
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Edit Events</h4>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='title'>Title </label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="clip-bubble-2"></i> </span>
              <?php echo form_input('title', $p->title, 'id="title_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('title'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='start_date'>Start Date
                                                  </label>
                                                  <div class="col-sm-6 input-group">
                                                      <input id='start_date_' type='text' name='start_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('start_date', $p->start_date > 0 ? date('d M Y', $p->start_date) : $p->start_date); ?>"  />
                                                      <i style="color:red"><?php echo form_error('start_date'); ?></i>
                                                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='end_date'>End Date
                                                  </label>
                                                  <div class="col-sm-6 input-group">
                                                      <input id='end_date_' type='text' name='end_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('end_date', $p->end_date > 0 ? date('d M Y', $p->end_date) : $p->end_date); ?>"  />
                                                      <i style="color:red"><?php echo form_error('end_date'); ?></i>
                                                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='venue'>Venue </label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="clip-location"></i> </span>
              <?php echo form_input('venue', $p->venue, 'id="venue_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('venue'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='file'><?php echo lang(($updType == 'edit') ? "web_file_edit" : "web_file_create" ) ?> (file) </label>
                                                  <div class="col-sm-8">
                                                      <input id='file' type='file' name='file' />
              <?php if ($updType == 'edit'): ?>
                                                           <a href='/public/uploads/events/files/<?php echo $result->file ?>' />Download actual file (file)</a><?php endif ?><br/><i style="color:red"><?php echo form_error('file'); ?></i><?php echo ( isset($upload_error['file'])) ? $upload_error['file'] : ""; ?>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='status'>Event Status </label>
                                                  <div class="col-sm-8 input-group">
              <?php
              $items = array("1" => "Live", "0" => "Draft",);
              echo form_dropdown('status', $items, (isset($result->status)) ? $result->status : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
              ?> <i style="color:red"><?php echo form_error('status'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <div class="modal-footer">
                                                  <textarea id="description" rows="9" class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($p->description)) ? htmlspecialchars_decode($p->description) : ''); ?></textarea>
                                                  <i style="color:red"><?php echo form_error('description'); ?></i>
                                                  <br>
                                                  <div class="clearfix"></div>
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
<div class="modal fade" id="Add_event" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
<?php
    $attributes = array('class' => 'form-horizontal', 'id' => '');
    echo form_open_multipart('admin/events/create/', $attributes);
?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Add New Events</h4>
                <div class="clearfix"></div>
            </div>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='title'>Title<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
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
                <div class="col-sm-8 input-group">
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
                <div class="col-sm-8 input-group">
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
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
                    <input id='venue' type='text' name='venue' maxlength='' class='form-control'   />

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
                <label class='col-sm-3 control-label' for='status'>Event Status<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
<?php
    $items = array("1" => "Live", "0" => "Draft",);
    echo form_dropdown('status', $items, '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('status'); ?></i>
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


