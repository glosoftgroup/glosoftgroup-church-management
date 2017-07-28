<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Hymns Manager </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Hymn" data-width="700" data-toggle="modal" data-placement="top" href="#Add_hymns_manager">
                        <i class="icon-plus"></i> Add Hymn
                    </a>

                    <?php echo anchor('admin/hymns_manager', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Hymns Manager')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($hymns_manager): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Hymn Title</th>
                             <th>Composer</th>
                             <th>Category</th>
                             <th>Lyrics</th>
                             <th>File</th>	
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($hymns_manager as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>
                                          <td><a data-toggle="modal" class="tooltips" data-original-title="View Details" data-placement="top" role="button" href="#modal<?php echo $p->id; ?>"><i class="icon-double-angle-right"></i> <?php echo $p->hymn_title; ?></a></td>
                                          <td><?php echo $p->composer; ?></td>
                                          <td><?php echo $p->category; ?></td>
                                          <td><?php echo substr($p->lyrics, 0, 700); ?></td>
                                          <td><?php if (!empty($p->file))
                         {
                                            ?>
                                                   <a href='<?php echo site_url('uploads/files/' . $p->file); ?>' />Download </a>
                                              <?php
                                              }
                                              else
                                              {
                                                   ?>
                                                   No Hymn Attached.
              <?php } ?></td>
                                          <td width='100'>
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/hymns_manager/edit/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-edit'></i> Edit
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#modal<?php echo $p->id; ?>"> <i class='icon-edit'></i>View
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/hymns_manager/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Remove
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                  <div class="modal fade" id="modal<?php echo $p->id; ?>" tabindex="-1" data-width="60%" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Hymn Title: <?php echo $p->hymn_title; ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Composer:</span> 
                                                      <span class="col-sm-4"><?php echo $p->composer; ?></span>
                                                  </p>
                                                  <div class="clearfix"></div>
                                                  <p>
                                                  <div class="clearfix"><hr></div>
                                                  <span class="col-sm-2" style="font-weight:bold !important; margin-right:25px;">Lyrics:</span> 
                                                  <div class="clearfix"></div>
                                                  <span class="col-sm-10"><?php echo $p->lyrics; ?></span>
                                                  </p>
                                                  <div class="clearfix"></div>
                                                  <p>
                                                  <div class="clearfix"><hr></div>
                                                  <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Hymn:</span> 
                                                  <span class="col-sm-4"><?php if (!empty($p->file))
              {
                   ?>
                                                           <a href='<?php echo site_url('uploads/files/' . $p->file); ?>' />Download Hymn</a>
                                                      <?php
                                                      }
                                                      else
                                                      {
                                                           ?>
                                                           No Hymn Attached.
              <?php } ?></span>
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



<!-----------------------------ADD MODAL------------------------->
<div class="modal fade" id="Add_hymns_manager" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
<?php
    $attributes = array('class' => 'form-horizontal', 'id' => '');
    echo form_open_multipart('admin/hymns_manager/create/', $attributes);
?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Add New Bible Quote</h4>
                <div class="clearfix"></div>
            </div>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='hymn_title'>Hymn Title<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-bubble-2"></i> </span>
                    <input id='hymn_title' type='text' name='hymn_title' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='composer'>Composer</label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-user"></i> </span>
                    <input id='composer' type='text' name='composer' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='category'>Category<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
<?php
    $items = array('' => '', "Praise" => "Praise", "worship" => "Worship", "other" => "Other",);
    echo form_dropdown('category', $items, (isset($result->category)) ? $result->category : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('category'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='lyrics'>Lyrics<span class='required'>*</span></label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-clip"></i> </span>
                    <textarea id="lyrics" rows="9" class="autosize-transition ckeditor1 form-control "  name="lyrics"  /></textarea>
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