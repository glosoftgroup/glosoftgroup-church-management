<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Sermons </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Sermon" data-width="700" data-toggle="modal" data-placement="top" href="#Add_sermon">
                        <i class="icon-plus"></i> Add Sermon
                    </a>

                    <?php echo anchor('admin/sermons', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Sermons')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($sermons): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Service Date</th>
                             <th>Title</th>
                             <th>Service Leader</th>
                             <th>First Service</th>
                             <th>Second Service</th>
                             <th>Pastor on Duty</th>
                             <th>Sermon Theme</th>
                             <th>Description</th>
                             <th>Upload Sermon</th>	
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($sermons as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>
                                          <td><?php echo date('d M Y', $p->service_date); ?></td>				
                                          <td><a data-toggle="modal" class="tooltips" data-original-title="View Details" data-placement="top"role="button" href="#modal<?php echo $p->id; ?>"><i class="icon-double-angle-right"></i> <?php echo $p->title; ?></a></td>
                                          <td><?php echo $p->service_leader; ?></td>
                                          <td><?php echo $p->first_service; ?></td>
                                          <td><?php echo $p->second_service; ?></td>
                                          <td><?php echo $leader[$p->pastor_on_duty]; ?></td>
                                          <td><?php echo $p->sermon_theme; ?></td>
                                          <td><?php echo $p->description; ?></td>
                                          <td><img src="<?php echo base_url('uploads/files/' . $p->file); ?>" style="" class="circle-img" height="40" width="40"></td>
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
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/sermons/delete/' . $p->id . '/' . $page); ?>'>
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
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Service Date:</span> 
                                                      <span class="col-sm-4"><?php echo date('d M Y', $p->service_date); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Service Leader:</span> 
                                                      <span class="col-sm-4"><?php echo $p->service_leader; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">First Service:</span> 
                                                      <span class="col-sm-4"><?php echo $p->first_service; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Second Service:</span> 
                                                      <span class="col-sm-4"><?php echo $p->second_service; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Pastor on Duty:</span> 
                                                      <span class="col-sm-4"><?php echo ucwords($leader[$p->pastor_on_duty]); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Sermon Theme:</span> 
                                                      <span class="col-sm-7"><?php echo $p->sermon_theme; ?></span>
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
                                           echo form_open_multipart('admin/sermons/edit/' . $p->id . '/1', $attributes);
                                           ?>
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Edit Sermon</h4>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='service_date'>Service Date
                                                  </label>
                                                  <div class="col-sm-6 input-group">

                                                      <input id='date_' type='text' name='service_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('service_date', $p->service_date > 0 ? date('d M Y', $p->service_date) : $p->service_date); ?>"  />
                                                      <i style="color:red"><?php echo form_error('service_date'); ?></i>
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
                                                      <?php echo form_input('title', $p->title, 'id="title_"  class="form-control" '); ?><i style="color:red"><?php echo form_error('title'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='service_leader'>Service Leader </label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                      <?php echo form_input('service_leader', $p->service_leader, 'id="service_leader_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('service_leader'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='first_service'>First Service</label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                      <?php echo form_input('first_service', $p->first_service, 'id="first_service_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('first_service'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='second_service'>Second Service</label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                      <?php echo form_input('second_service', $p->second_service, 'id="second_service_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('second_service'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='pastor_on_duty'>Pastor on Duty</label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                      <?php echo form_dropdown('pastor_on_duty', $leader, (isset($result->pastor_on_duty)) ? $result->pastor_on_duty : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('pastor_on_duty'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='sermon_theme'>Sermon Theme</label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                      <?php echo form_input('sermon_theme', $p->sermon_theme, 'id="sermon_theme_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('sermon_theme'); ?></i>
                                                  </div>
                                                  </p>
                                                  <div class="clearfix"></div>
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
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div class='form-group'>
                                                      <label class='col-sm-3 control-label' for='file'>Sermon Notes</label>
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
                 </div> 
            <?php else: ?>
                 <p class='text'><?php echo lang('web_no_elements'); ?></p>
        <?php endif ?>
    </div>
</div>


<!-----------------------------ADD MODAL------------------------->
<div class="modal fade" id="Add_sermon" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
         <?php
             $attributes = array('class' => 'form-horizontal', 'id' => '');
             echo form_open_multipart('admin/sermons/create/', $attributes);
         ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Add New Sermon</h4>
                <div class="clearfix"></div>
            </div>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class=' col-sm-3 control-label' for='service_date'>Service Date<span class='required'>*</span>
                </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                    <input id='service_date_' type='text' name='service_date' maxlength='' class='form-control date-picker'   />

                </div>
                <div class="clearfix"></div>
            </div>
            </p>
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
                <label class='col-sm-3 control-label' for='service_leader'>Service Leader<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
                    <input id='service_leader' type='text' name='service_leader' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='first_service'>First Service<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
                    <input id='first_service' type='text' name='first_service' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='second_service'>Second Service</label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
                    <input id='second_service' type='text' name='second_service' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='pastor_on_duty'>Pastor on Duty<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <?php echo form_dropdown('pastor_on_duty', $leader, (isset($result->pastor_on_duty)) ? $result->pastor_on_duty : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('pastor_on_duty'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='sermon_theme'>Sermon Theme<span class='required'>*</span></label>
                <div class="col-sm-8 input-group">
                    <textarea id="sermon_theme"  class="autosize-transition form-control "  name="sermon_theme"  /><?php echo set_value('sermon_theme', (isset($result->sermon_theme)) ? htmlspecialchars_decode($result->sermon_theme) : ''); ?></textarea><i style="color:red"><?php echo form_error('sermon_theme'); ?></i>
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
