<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h4 class="panel-title">All Ministries </h4>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Ministry" data-width="700" data-toggle="modal" data-placement="top" href="#Add_ministry">
                        <i class="icon-plus"></i> Add Ministry
                    </a>

                    <?php echo anchor('admin/ministries', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Ministries')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($ministries): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Code</th>
                             <th>Name</th>
                             <th>Leader</th>
                             <th>Telephone</th>
                             <th>Mobile</th>
                             <th>Email</th>
                             <th>Congregation Size</th>

                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($ministries as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td width="70"><?php echo $p->code; ?></td>
                                          <td><?php echo ucwords($p->name); ?></td>
                                          <td><a class="tooltips" data-original-title="View Profile" data-placement="top" href='<?php echo site_url('admin/members/profile/' . $p->leader); ?>'><i class="icon-double-angle-right"></i> <?php echo ucwords($leader[$p->leader]); ?></a></td>
                                          <td><?php echo $p->telephone; ?></td>
                                          <td><?php echo $p->mobile; ?></td>
                                          <td><?php echo $p->email; ?></td>
                                          <td><?php echo $p->congregation_size; ?></td>

                                          <td style="min-width:200px;">
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-success  btn-sm'  href='<?php echo site_url('admin/ministries/members/' . $p->id); ?>'>
                                                          <i class='icon-chevron-right'></i> View Members 
                                                      </a>
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
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/ministries/delete/' . $p->id . '/' . $page); ?>'>
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
                                                  <h4 class="modal-title">Name: <?php echo ucwords($p->name); ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p >
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Code:</span> 
                                                      <span class="col-sm-4"><?php echo ucwords($p->code); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>

                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Leader:</span> 
                                                      <span class="col-sm-7"><?php echo ucwords($leader[$p->leader]); ?></span>
                                                  </p>
                                                  <div class="clearfix"></div><hr>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Telephone:</span> 
                                                      <span class="col-sm-4"><?php echo $p->telephone; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Mobile:</span> 
                                                      <span class="col-sm-4"><?php echo $p->mobile; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Email:</span> 
                                                      <span class="col-sm-4"><?php echo $p->email; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Max Size:</span> 
                                                      <span class="col-sm-4"><?php echo $p->congregation_size; ?></span>
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
                                           echo form_open_multipart('admin/ministries/edit/' . $p->id . '/1', $attributes);
                                           ?>
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Edit Ministries</h4>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='code'>Code </label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                      <?php echo form_input('code', $p->code, 'id="code_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('code'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='name'>Name </label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                      <?php echo form_input('name', $p->name, 'id="name_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('name'); ?></i>
                                                  </div>
                                                  </p>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='leader'>Leader<span class='required'>*</span></label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                      <?php echo form_dropdown('leader', array('' => 'Select Leader') + $leader, (isset($result->leader)) ? $result->leader : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('leader'); ?></i>
                                                  </div>
                                              </div>
                                              </p>
                                              <div class="clearfix"></div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='telephone'>Telephone </label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-phone"></i> </span>
                                                      <?php echo form_input('telephone', $p->telephone, 'id="telephone_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('telephone'); ?></i>
                                                  </div>
                                                  </p>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='mobile'>Mobile </label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-phone"></i> </span>
                                                      <?php echo form_input('mobile', $p->mobile, 'id="mobile_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('mobile'); ?></i>
                                                  </div>
                                                  </p>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='email'>Email</label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-envelope"></i> </span>
                                                      <?php echo form_input('email', $p->email, 'id="email_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('email'); ?></i>
                                                  </div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='congregation_size'>Congregation Size</label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-group"></i> </span>
                                                      <?php echo form_input('congregation_size', $p->congregation_size, 'id="congregation_size_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('congregation_size'); ?></i>
                                                  </div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='description'>Description</label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                      <?php echo form_input('description', $p->description, 'id="description_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('description'); ?></i>
                                                  </div>
                                              </div>
                                              </p>
                                              <div class="clearfix"></div>

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
<div class="modal fade" id="Add_ministry" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
         <?php
             $attributes = array('class' => 'form-horizontal', 'id' => '');
             echo form_open_multipart('admin/ministries/create/', $attributes);
         ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Add New Ministry</h4>
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
                <label class='col-sm-3 control-label' for='code'>Code<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-key"></i> </span>
                    <input id='code' type='text' name='code' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='leader'>Leader<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-user"></i> </span>
                    <?php echo form_dropdown('leader', array('' => 'Select Leader') + $leader, (isset($result->leader)) ? $result->leader : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('leader'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='mobile'>Mobile<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-mobile"></i> </span>
                    <input id='mobile' type='text' name='mobile' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='telephone'>Telephone</label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-phone"></i> </span>
                    <input id='telephone' type='text' name='telephone' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='email'>Email<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="icon-envelope"></i> </span>
                    <input id='email' type='text' name='email' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='congregation_size'>Expected Congregation Size </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="icon-group"></i> </span>
                    <input id='congregation_size' type='text' name='congregation_size' maxlength='' class='form-control '/>
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