<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Announcements </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Announcement" data-width="700" data-toggle="modal" data-placement="top" href="#Add_announcement">
                        <i class="icon-plus"></i> Add Announcement
                    </a>

                    <?php echo anchor('admin/announcements', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Announcements')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($announcements): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Date</th>
                             <th>Title</th>
                             <th>Brief Description</th>
                             <th>Status</th>
                             <th>Uploaded Announcements</th>	
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($announcements as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					

                                          <td><?php echo date('d M Y', $p->date); ?></td>					
                                          <td><a data-toggle="modal" class="tooltips" data-original-title="View Details" data-placement="top" role="button" href="#modal<?php echo $p->id; ?>"><i class="icon-double-angle-right"></i> <?php echo $p->title; ?></a></td>

                                          <td><?php echo $p->brief_description; ?></td>
                                          <td><?php if ($p->status == 1)
                              echo '<span class="label label-success">Live</span>';
                         else
                              echo '<span class="label label-danger">Draft</span>';
                                       ?></td>
                                          <td>
                                              <?php if (!empty($p->file))
                                              {
                                                   ?>
                                                   <a href="<?php echo base_url('uploads/files/' . $p->file); ?>">Download File</a>
                                              <?php
                                              }
                                              else
                                              {
                                                   ?>
                                                   No File Attached
              <?php } ?>
                                          </td>
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
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/announcements/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Remove
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                  <div class="modal fade" id="modal<?php echo $p->id; ?>" tabindex="-1" data-width="700" role="dialog" aria-hidden="true">
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
                                                      <span class="col-sm-7"><?php echo date('d M Y', $p->date); ?></span>
                                                  </p>
                                                  <div class="clearfix"></div>
                                                  <hr>

                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Description:</span> 
                                                      <span class="col-sm-7"><?php echo $p->brief_description; ?></span>
                                                  </p>
                                                  <div class="clearfix"></div>
                                                  <hr>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Status:</span> 
                                                      <span class="col-sm-7"><?php if ($p->status == 1)
                   echo '<span class="label label-success">Live</span>';
              else
                   echo '<span class="label label-danger">Draft</span>';
              ?></span>
                                                  <div class="clearfix"></div>
                                                  <hr>
                                                  </p>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Uploaded Announcement:</span> 
                                                  <span class="col-sm-7"><?php if (!empty($p->file))
                                         {
                                              ?>
                                                           <a href='<?php echo site_url('uploads/files/' . $p->file); ?>' />Download Announcement</a>
              <?php
              }
              else
              {
                   ?>No Announcement Att.<?php } ?></span>
                                                  </p>
                                                  <div class="clearfix"></div>
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
                                  <div class="modal fade" id="Edit_<?php echo $p->id; ?>" tabindex="-1" data-width="700" role="dialog" aria-hidden="true">

              <?php
              $attributes = array('class' => 'form-horizontal', 'id' => '');
              echo form_open_multipart('admin/announcements/edit/' . $p->id . '/1', $attributes);
              ?>
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                  &times;
                                              </button>
                                              <h4 class="modal-title">Edit Announcement</h4>
                                              <div class="clearfix"></div>
                                          </div>
                                          <p>
                                          <div class="clearfix"></div>
                                          <div class="clonedInput">
                                              <label class=' col-sm-3 control-label' for='date'>Date <span class='required'>*</span></label><div class="col-sm-5 input-group">
                                                  <input id='date' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date_joined', $p->date > 0 ? date('d M Y', $p->date) : $p->date); ?>"  />
                                                  <i style="color:red"><?php echo form_error('date'); ?></i>
                                                  <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                                              </div>
                                              </p>

                                              <div class="clearfix"></div>
                                          </div>
                                          <p>
                                          <div class="clearfix"></div>
                                          <div class="clonedInput">
                                              <label class=' col-sm-3 control-label' for='title'>Title <span class='required'>*</span></label><div class="col-sm-5">
              <?php echo form_input('title', $p->title, 'id="title_"  class="form-control" '); ?>
                                                  <i style="color:red"><?php echo form_error('title'); ?></i>
                                              </div>
                                              </p>

                                              <div class="clearfix"></div>
                                          </div>


                                          <p>
                                          <div class="clonedInput">
                                              <label class='col-sm-3 control-label' for='brief_description'>Brief Description </label><div class="col-sm-8 input-group">
                                                  <span class="input-group-addon"> <i class="clip-clip"></i> </span>
                                                  <textarea id="brief_description"  class="autosize-transition form-control "  name="brief_description"  /><?php echo set_value('brief_description', (isset($p->brief_description)) ? htmlspecialchars_decode($p->brief_description) : ''); ?></textarea>
                                                  <i style="color:red"><?php echo form_error('brief_description'); ?></i>
                                              </div>
                                              <div class="clearfix"></div>
                                          </div>
                                          </p>
                                          <p>
                                          <div class="clonedInput">
                                              <label class='col-sm-3 control-label' for='status'>Status </label><div class="col-sm-8 input-group">
                                                  <?php
                                                  $items = array("1" => "Live", "0" => "Draft",);
                                                  echo form_dropdown('status', $items, (isset($result->status)) ? $result->status : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                                                  ?> <i style="color:red"><?php echo form_error('status'); ?></i>
                                              </div>
                                              <div class="clearfix"></div>
                                          </div>
                                          </p>
                                          <p>
                                          <div class="clearfix"></div>
                                          <div class='form-group'>
                                              <label class='col-sm-3 control-label' for='file'>Upload Announcement</label>
                                              <div class="col-sm-8 input-group">
                                                  <input id='file' type='file' name='file' />
                                               <?php if ($updType == 'edit'): ?>
                                                       <a href='/public/uploads/expenses/files/<?php echo $p->file ?>' />Download actual file (file)</a>
              <?php endif ?>

                                                  <br/><i style="color:red"><?php echo form_error('file'); ?></i>
              <?php echo ( isset($upload_error['file'])) ? $upload_error['file'] : ""; ?>
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
<div class="modal fade" id="Add_announcement" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
<?php
    $attributes = array('class' => 'form-horizontal', 'id' => '');
    echo form_open_multipart('admin/announcements/create/', $attributes);
?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Add New Announcement</h4>
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
                <label class='col-sm-3 control-label' for='title'>Status<span class='required'>*</span> </label>
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
                <label class='col-sm-3 control-label' for='brief_description'>Brief Description</label>
                <div class="col-sm-8 input-group">

                    <span class="input-group-addon"> <i class="clip-clip"></i> </span>
                    <textarea id="brief_description" rows="9" class="autosize-transition ckeditor1 form-control "  name="brief_description"  /></textarea>
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
