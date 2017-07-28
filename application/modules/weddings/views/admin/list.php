<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Weddings </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Wedding" data-width="700" data-toggle="modal" data-placement="top" href="#Add_wedding">
                        <i class="icon-plus"></i> Add Wedding
                    </a>

                    <?php echo anchor('admin/weddings', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Weddings')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($weddings): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Wedding Date</th>
                             <th>Bride</th>
                             <th>Bridegroom</th>
                             <th>Venue</th>
                             <th>Brief Description</th>
                             <th>Wedding Photo</th>
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($weddings as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>				
                                          <td><a data-toggle="modal" class="tooltips" data-original-title="View Details" data-placement="top" role="button" href="#modal<?php echo $p->id; ?>"><i class="icon-double-angle-right"></i> <?php echo date('d M Y', $p->wedding_date); ?></a></td>
                                          <td><a class="tooltips" data-original-title="View Profile" data-placement="top" href='<?php echo site_url('admin/members/profile/' . $p->bride); ?>'><i class="icon-double-angle-right"></i> <?php echo $member[$p->bride]; ?></a></td>
                                          <td><a class="tooltips" data-original-title="View Profile" data-placement="top" href='<?php echo site_url('admin/members/profile/' . $p->bridegroom); ?>'><i class="icon-double-angle-right"></i> <?php echo $member[$p->bridegroom]; ?></a></td>
                                          <td><?php echo $p->venue; ?></td>
                                          <td><?php echo $p->brief_description; ?></td>
                                          <td><img src="<?php echo base_url('uploads/files/' . $p->file); ?>" style="" class="circle-img" height="40" width="40"></td>
                                          <td >
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#Edit_<?php echo $p->id; ?>"><i class='icon-edit'></i>  Edit
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#modal<?php echo $p->id; ?>">
                                                                  <i class='icon-share'></i> View
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/weddings/delete/' . $p->id . '/' . $page); ?>'>
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
                                                  <h4 class="modal-title">Wedding Date: <?php echo date('d M Y', $p->wedding_date); ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p >
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Bride:</span> 
                                                      <span class="col-sm-7"><?php echo $member[$p->bride]; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>

                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Bridegroom:</span> 
                                                      <span class="col-sm-7"><?php echo $member[$p->bridegroom]; ?></span>
                                                  </p>
                                                  <div class="clearfix"></div>
                                                  <hr>
                                                  <div class="clearfix"></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Venue:</span> 
                                                      <span class="col-sm-4"><?php echo $p->venue; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Brief Description:</span> 
                                                      <span class="col-sm-6"><?php echo $p->brief_description; ?></span>
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
                                           echo form_open_multipart('admin/weddings/edit/' . $p->id . '/1', $attributes);
                                           ?>
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Edit Weddings</h4>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='wedding_date'> Wedding Date<span class='required'>*</span>
                                                  </label>
                                                  <div class="col-sm-6 input-group">

                                                      <input id='wedding_date_' type='text' name='wedding_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('wedding_date', $p->wedding_date > 0 ? date('d M Y', $p->wedding_date) : $p->wedding_date); ?>"  />
                                                      <i style="color:red"><?php echo form_error('wedding_date'); ?></i>
                                                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                                                  </div>
                                                  </p>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='bride'>Bride <span class='required'>*</span></label><div class="col-sm-5">
                                                      <?php echo form_dropdown('bride', array('' => 'Select Bride') + $member, (isset($result->bride)) ? $result->bride : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('bride'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='bridegroom'>Bridegroom <span class='required'>*</span></label><div class="col-sm-5">
                                                      <?php echo form_dropdown('bridegroom', array('' => 'Select Bridegroom') + $member, (isset($result->bridegroom)) ? $result->bridegroom : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('bridegroom'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='venue'>Venue <span class='required'>*</span></label><div class="col-sm-5">
                                                       <?php echo form_input('venue', $p->venue, 'id="venue_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('venue'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='brief_description'>Description</label><div class="col-sm-5">
                                                       <?php echo form_input('brief_description', $p->brief_description, 'id="brief_description_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('brief_description'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div class='form-group'>
                                                  <label class='col-sm-3 control-label' for='file'>Wedding Photo</label>
                                                  <div class="col-sm-8 input-group">
                                                      <input id='file' type='file' name='file' />
                                                      <?php if ($updType == 'edit'): ?>
                                                           <a href='/public/uploads/expenses/files/<?php echo $result->file ?>' />Download actual file (file)</a>
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
<div class="modal fade" id="Add_wedding" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
         <?php
             $attributes = array('class' => 'form-horizontal', 'id' => '');
             echo form_open_multipart('admin/weddings/create/', $attributes);
         ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Add New Wedding</h4>
                <div class="clearfix"></div>
            </div>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class=' col-sm-3 control-label' for='wedding_date'>Wedding Date<span class='required'>*</span>
                </label>
                <div class="col-sm-8 input-group">
                    <input id='wedding_date_' type='text' name='wedding_date' maxlength='' class='form-control date-picker'   />

                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='bride'>Bride<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
                    <?php echo form_dropdown('bride', array('' => 'Select Bride') + $member, (isset($result->bride)) ? $result->bride : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                    ?> <i style="color:red"><?php echo form_error('bride'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='bride'>Bridegroom<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
                    <?php echo form_dropdown('bridegroom', array('' => 'Select Bridegroom') + $member, (isset($result->bridegroom)) ? $result->bridegroom : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('bridegroom'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='venue'>Venue<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-location"></i> </span>
                    <input id='venue' type='text' name='venue' maxlength='' class='form-control'   />

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
