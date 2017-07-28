<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Baptism </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/baptism/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Baptism')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/baptism', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Baptism')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($baptism): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Reg Date</th>
                             <th>Name</th>
                             <th>Parents</th>
                             <th>Parents Religion</th>
                             <th>Parents Phone</th>
                             <th>Parents Email</th>
                             <th>God Father/Mother</th>


                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($baptism as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo date('d M Y', $p->date); ?></td>					
                                          <td><a data-toggle="modal" class="tooltips" data-original-title="View Profile" data-placement="top" href="#full-width<?php echo $p->id; ?>"><i class="icon-double-angle-right"></i> <?php
                                                    if ($p->type == 1)
                                                         echo $members[$p->member];
                                                    elseif ($p->type == 2)
                                                         echo $ss[$p->member];
                                                    ?>
                                              </a>
                                          </td>					
                                          <td>
                                               <?php
                                               echo $p->ff_name . ' ' . $p->fl_name;
                                               echo '<br>' . $p->mf_name . ' ' . $p->ml_name;
                                               ?>
                                          </td>
                                          <td><?php echo $p->father_religion . ' <br>' . $p->mother_religion; ?></td>
                                          <td>
                                               <?php
                                               echo $p->father_phone . '<br>' . $p->mother_phone . '<br>';
                                               ?>
                                          </td>
                                          <td>
                                               <?php
                                               echo $p->father_email . '<br>' . $p->mother_email;
                                               ?>
                                          </td>
                                          <td>
                                               <?php
                                               echo $p->gff_name . ' ' . $p->gfl_name . ' - (' . $p->gf_phone . ')<br>';
                                               if (!empty($p->gmf_name))
                                               {
                                                    echo $p->gmf_name . ' ' . $p->gml_name . ' - (' . $p->gm_phone . ')';
                                               }
                                               ?>
                                          </td>



                                          <td width='100'>
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="demo " href="#Edit_<?php echo $p->id; ?>">
                                                                  <i class='icon-edit'></i> Edit Details
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="demo " href="#full-width<?php echo $p->id; ?>">
                                                                  <i class='icon-share'></i> View Details
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/baptism/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Remove
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>



                                      <!------------START MODAL-------------------------------->

                                  <div id="full-width<?php echo $p->id; ?>" class="modal container fade" tabindex="-1" style="display: none;">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                              &times;
                                          </button>
                                          <h4 class="modal-title">Baptism Registration Details</h4>
                                      </div>
                                      <div class="modal-body">
                                          <div class="col-sm-6">

                                              <?php if ($p->type == 2)
                                              {
                                                   ?>
                                                   <div class='form-group'>
                                                       <label class='col-sm-4 vtitle' for='member'> Child's Names:</label>
                                                       <div class="col-sm-5">
                                                           <span class="form-control vdetails" ><?php echo $ss[$p->member]; ?></span>	

                                                       </div></div>
                                              <?php
                                              }
                                              elseif ($p->type == 1)
                                              {
                                                   ?>
                                                   <div class='form-group'>
                                                       <label class='col-sm-4 vtitle' for='member'>Member Name </label>
                                                       <div class="col-sm-5">
                                                           <span class="form-control vdetails" ><?php echo $members[$p->member]; ?></span>	

                                                       </div></div>
              <?php } ?>

                                          </div>
                                          <div class="col-sm-6">
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='date'>
                                                      Baptism Date
                                                  </label>
                                                  <div class="col-sm-5 ">
                                                      <span class="form-control vdetails" ><?php echo date('d M Y', $p->date); ?></span>	

                                                  </div>
                                              </div>
                                          </div>

                                          <div class="clearfix"></div>
                                          <hr>
                                          <div class="col-sm-6">
                                              <div class='form-group'>
                                                  <div class="col-sm-12">
                                                      <h2 class="panel-title">Fathers Details </h2>
                                                      <hr>
                                                  </div>
                                              </div>
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='ff_name'>Names :</label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->ff_name . ' ' . $p->fl_name; ?></span>		

                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='father_religion'> Religion </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->father_religion; ?></span>

                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='father_phone'> Phone </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->father_phone; ?></span>		

                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='father_email'>Email </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->father_email; ?></span>		

                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='father_address'> Address </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->father_address; ?></span>			

                                                  </div>
                                              </div>

                                          </div>                                               
                                          <div class="col-sm-6">												
                                              <div class='form-group'>
                                                  <div class="col-sm-12">
                                                      <h2 class="panel-title">Mother Details </h2>
                                                      <hr>
                                                  </div>								
                                              </div>								
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='mf_name'>Names : </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->mf_name . ' ' . $p->ml_name; ?></span>					

                                                  </div>
                                              </div>


                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='mother_religion'> Religion </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->mother_religion; ?></span>		

                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='mother_phone'> Phone </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->mother_phone; ?></span>				

                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='mother_email'> Email </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->mother_email; ?></span>				

                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='mother_address'> Address </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->mother_address; ?></span>						


                                                  </div>
                                              </div>
                                          </div>
                                          <div class="clearfix"></div>
                                          <hr>
                                          <div class="col-sm-6">

                                              <div class='form-group'>
                                                  <div class="col-sm-12">
                                                      <h2 class="panel-title">God Fathers Details </h2>
                                                      <hr>
                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='gff_name'>Names :</label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->gff_name . ' ' . $p->gfl_name; ?></span>		

                                                  </div>
                                              </div>


                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='gf_age'> Age </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->gf_age; ?></span>			

                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='gf_phone'>Phone </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->gf_phone; ?></span>		

                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='gf_address'>Address </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->gf_address; ?></span>			

                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-sm-6">
                                              <div class='form-group'>
                                                  <div class="col-sm-12">
                                                      <h2 class="panel-title">God Mother Details </h2>
                                                      <hr>
                                                  </div>
                                              </div>
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='gmf_name'>Names :</label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->gmf_name . ' ' . $p->gml_name; ?></span>		

                                                  </div>
                                              </div>



                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='gm_age'>Age </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->gm_age; ?></span>		

                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='gm_phone'> Phone </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->gm_phone; ?></span>		

                                                  </div>
                                              </div>
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='gm_address'>Address </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->gm_address; ?></span>			

                                                  </div>
                                              </div>




                                          </div>
                                          <div class="clearfix"></div>
                                          <hr>
                                          <div class='form-group'>
                                              <h4 class=' col-sm-12 ' for='description'>Additional Info </h4>
                                              <div class="col-sm-12">
                                                  <span class="form-control vdetails" ><?php echo $p->description; ?></span>

                                              </div>
                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" data-dismiss="modal" class="btn btn-default">
                                              Close
                                          </button>

                                      </div>
                                  </div>

                                  <!-----------------------------END MODAL------------------------->
                                  <!-----------------------------EDIT MODAL------------------------->

                                  <div id="Edit_<?php echo $p->id; ?>" class="modal container fade" tabindex="-1" style="display: none;">
                                       <?php
                                       $attributes = array('class' => 'form-horizontal', 'id' => '');
                                       echo form_open_multipart('admin/baptism/edit/' . $p->id . '/1', $attributes);
                                       ?>
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                              &times;
                                          </button>
                                          <h4 class="modal-title">Edit Baptism Registration Details</h4>
                                      </div>
                                      <div class="modal-body">


                                          <div class="col-sm-6">
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='date'>
                                                      Date
                                                  </label>
                                                  <div class="col-sm-6 input-group">

                                                      <input id='date_' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date', $p->date > 0 ? date('d M Y', $p->date) : $p->date); ?>"  />
                                                      <i style="color:red"><?php echo form_error('date'); ?></i>
                                                      <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-sm-6">
              <?php if ($p->type == 2)
              {
                   ?>
                                                   <div class='form-group'>
                                                       <label class='col-sm-4 control-label' for='member'>Select Child <span class='required'>*</span></label>
                                                       <div class="col-sm-6">
                                                   <?php
                                                   echo form_dropdown('member', array('' => 'Select Child') + $ss, (isset($p->member)) ? $p->member : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                                                   ?> <i style="color:red"><?php echo form_error('member'); ?></i>
                                                       </div></div>
              <?php
              }
              elseif ($p->type == 1)
              {
                   ?>
                                                   <div class='form-group'>
                                                       <label class='col-sm-4 control-label' for='member'>Select Member <span class='required'>*</span></label>
                                                       <div class="col-sm-6">
                   <?php
                   echo form_dropdown('member', array('' => 'Select Member') + $members, (isset($p->member)) ? $p->member : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                   ?> <i style="color:red"><?php echo form_error('member'); ?></i>
                                                       </div></div>
              <?php } ?>
                                          </div>
                                          <div class="clearfix"></div>
                                          <hr>
                                          <h2 class="panel-title">Parents Details </h2>

                                          <hr>

                                          <div class="col-sm-6">
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='gff_name'></label><div class="col-sm-8">
                                                      <h2 class="panel-title">Fathers Details </h2>
                                                  </div>
                                              </div>
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='ff_name'>First Name </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php echo form_input('ff_name', $p->ff_name, 'id="ff_name_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('ff_name'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='fl_name'>Last Name </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php echo form_input('fl_name', $p->fl_name, 'id="fl_name_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('fl_name'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='father_religion'> Religion </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-home"></i> </span>
              <?php echo form_input('father_religion', $p->father_religion, 'id="father_religion_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('father_religion'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='father_phone'> Phone </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-phone"></i> </span>
              <?php echo form_input('father_phone', $p->father_phone, 'id="father_phone_"  class="form-control input-mask-phone" '); ?>
                                                      <i style="color:red"><?php echo form_error('father_phone'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='father_email'>Email </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-envelope"></i> </span>
              <?php echo form_input('father_email', $p->father_email, 'id="father_email_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('father_email'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='father_address'> Address </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="clip-location"></i> </span>
                                                      <textarea id="father_address"  class="autosize-transition ckeditor11 form-control "  name="father_address"  /><?php echo set_value('father_address', (isset($p->father_address)) ? htmlspecialchars_decode($p->father_address) : ''); ?></textarea>
                                                      <i style="color:red"><?php echo form_error('father_address'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                          </div>                                               
                                          <div class="col-sm-6">												
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='gff_name'></label><div class="col-sm-8">
                                                      <h2 class="panel-title">Mother Details </h2>
                                                  </div>								
                                              </div>								
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='mf_name'>First Name </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php echo form_input('mf_name', $p->mf_name, 'id="mf_name_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('mf_name'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='ml_name'>Last Name </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php echo form_input('ml_name', $p->ml_name, 'id="ml_name_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('ml_name'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='mother_religion'> Religion </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-home"></i> </span>
              <?php echo form_input('mother_religion', $p->mother_religion, 'id="mother_religion_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('mother_religion'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='mother_phone'> Phone </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-phone"></i> </span>
              <?php echo form_input('mother_phone', $p->mother_phone, 'id="mother_phone_"  class="form-control input-mask-phone" '); ?>
                                                      <i style="color:red"><?php echo form_error('mother_phone'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='mother_email'> Email </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-envelope"></i> </span>
              <?php echo form_input('mother_email', $p->mother_email, 'id="mother_email_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('mother_email'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='mother_address'> Address </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="clip-location"></i> </span>
                                                      <textarea id="mother_address"  class="autosize-transition ckeditor11 form-control "  name="mother_address"  /><?php echo set_value('mother_address', (isset($p->mother_address)) ? htmlspecialchars_decode($p->mother_address) : ''); ?></textarea>
                                                      <i style="color:red"><?php echo form_error('mother_address'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                          </div>
                                          <div class="clearfix"></div>
                                          <hr>
                                          <h2 class="panel-title">God Parents Details </h2>

                                          <hr>
                                          <div class="col-sm-6">

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='gff_name'></label><div class="col-sm-8">
                                                      <h2 class="panel-title">God Fathers Details </h2>
                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='gff_name'>First Name <span class='required'>*</span></label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php echo form_input('gff_name', $p->gff_name, 'id="gff_name_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('gff_name'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='gfl_name'>Last Name <span class='required'>*</span></label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php echo form_input('gfl_name', $p->gfl_name, 'id="gfl_name_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('gfl_name'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='gf_age'> Age <span class='required'>*</span></label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-edit"></i> </span>
              <?php echo form_input('gf_age', $p->gf_age, 'id="gf_age_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('gf_age'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='gf_phone'>Phone <span class='required'>*</span></label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-phone"></i> </span>
              <?php echo form_input('gf_phone', $p->gf_phone, 'id="gf_phone_"  class="form-control input-mask-phone" '); ?>
                                                      <i style="color:red"><?php echo form_error('gf_phone'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='gf_address'>Address </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="clip-location"></i> </span>
                                                      <textarea id="gf_address"  class="autosize-transition ckeditor11 form-control "  name="gf_address"  /><?php echo set_value('gf_address', (isset($p->gf_address)) ? htmlspecialchars_decode($p->gf_address) : ''); ?></textarea>
                                                      <i style="color:red"><?php echo form_error('gf_address'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                          </div>
                                          <div class="col-sm-6">
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='gff_name'></label><div class="col-sm-8">
                                                      <h2 class="panel-title">God Mother Details </h2>
                                                  </div>
                                              </div>
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='gmf_name'>First Name </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php echo form_input('gmf_name', $p->gmf_name, 'id="gmf_name_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('gmf_name'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='gml_name'>Last Name </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php echo form_input('gml_name', $p->gml_name, 'id="gml_name_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('gml_name'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='gm_age'>Age </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-edit"></i> </span>
              <?php echo form_input('gm_age', $p->gm_age, 'id="gm_age_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('gm_age'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='gm_phone'> Phone </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-phone"></i> </span>
              <?php echo form_input('gm_phone', $p->gm_phone, 'id="gm_phone_"  class="form-control input-mask-phone" '); ?>
                                                      <i style="color:red"><?php echo form_error('gm_phone'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='gm_address'>Address </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="clip-location"></i> </span>
                                                      <textarea id="gm_address"  class="autosize-transition ckeditor11 form-control "  name="gm_address"  /><?php echo set_value('gm_address', (isset($p->gm_address)) ? htmlspecialchars_decode($p->gm_address) : ''); ?></textarea>
                                                      <i style="color:red"><?php echo form_error('gm_address'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>								

                                          </div>
                                          <div class="clearfix"></div>
                                          <hr>
                                          <div class='form-group'>
                                              <h4 class=' col-sm-12 ' for='description'>Any Additional Info </h4>
                                              <div class="col-sm-12">
                                                  <textarea id="description"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($p->description)) ? htmlspecialchars_decode($p->description) : ''); ?></textarea>
                                                  <i style="color:red"><?php echo form_error('description'); ?></i>
                                              </div>
                                          </div>
                                          <div class="clearfix"></div>

                                      </div>
                                      <div class="modal-footer">
                                      <?php echo form_submit('submit', ($updType == 'edit') ? 'Update Changes' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                                          <button type="button" data-dismiss="modal" class="btn btn-default">
                                              Close
                                          </button>

                                      </div>
                                  <?php echo form_close(); ?>
                                  </div>

                                  <!-----------------------------END MODAL------------------------->


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


