<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Children For Dedication </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/dedications/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Dedications')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/dedications', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Dedications')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($dedications): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Date</th>
                             <th>Baby's Names</th>
                             <th>Date of Birth</th>
                             <th>Gender</th>
                             <th>Place of Birth</th>
                             <th>Country</th>
                             <th>City</th>
                             <th>Exptd Dedication Date</th>
                             <th>Service Type</th>
                             <th>Status</th>


                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($dedications as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>
                                          <td><?php echo date('d M Y', $p->date); ?></td>				
                                          <td><a data-toggle="modal" class="tooltips" data-original-title="View <?php echo $p->first_name ?>'s Profile" data-placement="top" href="#full-width<?php echo $p->id; ?>"><i class="icon-double-angle-right"></i> <?php echo $p->first_name . ' ' . $p->middle_name . ' ' . $p->last_name; ?></a></td>
                                          <td><?php echo date('d M Y', $p->dob); ?></td>
                                          <td><?php echo $p->gender; ?></td>
                                          <td><?php echo $p->location; ?></td>
                                          <td><?php echo $p->country; ?></td>
                                          <td><?php echo $p->city; ?></td>
                                          <td><?php echo date('d M Y', $p->expected_dedication_date); ?></td>
                                          <td><?php echo $p->service_type; ?></td>
                                          <td><?php if ($p->status == 0)
                              echo '<span class="label label-warning">Pending</span>';
                         else
                              echo '<span class="label label-success">Dedicated </span>'
                              ?></td>

                                          <td width='100'>
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/dedications/edit/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-edit'></i> Edit Details
                                                              </a>
                                                          </li>
              <?php if ($p->status == 0)
              {
                   ?>
                                                               <li role='presentation'>
                                                                   <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/dedications/dedicate/' . $p->id . '/' . $page); ?>'>
                                                                       <i class='icon-ok'></i> Mark as Dedicated
                                                                   </a>
                                                               </li>
              <?php } ?>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="demo " href="#full-width<?php echo $p->id; ?>">
                                                                  <i class='icon-share'></i> View Details
                                                              </a>
                                                          </li>
              <?php if ($p->status == 0)
              {
                   ?>
                                                               <li role='presentation'>
                                                                   <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/dedications/delete/' . $p->id . '/' . $page); ?>'>
                                                                       <i class='icon-remove'></i> Remove
                                                                   </a>
                                                               </li>
              <?php } ?>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>			

                                      <!------------START MODAL-------------------------------->

                                  <div id="full-width<?php echo $p->id; ?>" class="modal container fade" data-width="1000" tabindex="-1" style="display: none;">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                              &times;
                                          </button>
                                          <h4 class="modal-title">Dedication Registration Details</h4>
                                      </div>
                                      <div class="modal-body">
                                          <div class="col-sm-6">
                                              <div class='form-group'>
                                                  <label class='col-sm-4 vtitle' for='babys_name'> Baby's Names:</label>
                                                  <div class="col-sm-8">
                                                      <span class="form-control vdetails" ><?php echo $p->first_name . ' ' . $p->middle_name . ' ' . $p->last_name; ?></span>	

                                                  </div>
                                              </div>

                                          </div>
                                          <div class="col-sm-6">
                                              <div class='form-group'>
                                                  <label class=' col-sm-4 vtitle' for='date'>
                                                      Registration Date
                                                  </label>
                                                  <div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo date('d M Y', $p->date); ?></span>	

                                                  </div>
                                              </div>
                                          </div>

                                          <div class="clearfix"></div>
                                          <hr>
                                          <div class="col-sm-6">
                                              <div class='form-group'>
                                                  <div class="col-sm-12">
                                                      <h2 class="panel-title">Birth Details </h2>
                                                      <hr>
                                                  </div>
                                              </div>
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='place_of_birth'>DoB:</label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo date('d M Y', $p->dob); ?></span>		

                                                  </div>
                                              </div>
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='place_of_birth'>Place:</label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->location; ?></span>		

                                                  </div>
                                              </div>
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='gender'>Gender :</label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->gender; ?></span>		

                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='county'> County </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->country; ?></span>

                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='city'> City </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->city; ?></span>		

                                                  </div>
                                              </div>
                                          </div>                                               
                                          <div class="col-sm-6">												
                                              <div class='form-group'>
                                                  <div class="col-sm-12">
                                                      <h2 class="panel-title">Dedication Details </h2>
                                                      <hr>
                                                  </div>								
                                              </div>								
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='date'>Date : </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo date('d M Y', $p->expected_dedication_date); ?></span></div>
                                              </div>
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='service'> Service </label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php echo $p->service_type; ?></span>		

                                                  </div>
                                              </div>

                                              <div class='form-group'>
                                                  <label class=' col-sm-3 vtitle' for='status'> Status</label><div class="col-sm-8 ">
                                                      <span class="form-control vdetails" ><?php if ($p->status == 0)
                   echo '<span class="label label-warning">Pending</span>';
              else
                   echo '<span class="label label-success">Dedicated </span>'
                   ?></span>				

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
                                          <div class="clearfix"></div>
                                          <hr>
                                          <h4 class="StepTitle">Parents Details</h4>

                                          <?php
                                          if ($p->type == 0)
                                          {
                                               $cfd_parents = $this->dedications_m->get_parents($p->id);
                                          }
                                          elseif ($p->type == 1)
                                          {
                                               $cfd_parents = $this->dedications_m->get_mmparents($p->father, $p->mother);
                                          }
                                          if ($cfd_parents):
                                               ?>
                                               <div class='clearfix'></div>



                   <?php
                   $i = 0;
                   foreach ($cfd_parents as $p):
                        $i++;
                        ?>
                                                    <div class="col-sm-12 order-span">
                                                        <span width="3%" ><?php echo $i . '.'; ?></span>					

                                                        <span width="3%" ><?php echo $p->first_name . ' ' . $p->last_name; ?></span>					
                                                        <span width="3%" ><?php echo $p->phone; ?></span>
                                                        <span width="3%" ><?php echo $p->email; ?></span>

                                                    </div> 

                   <?php endforeach ?>


              <?php endif ?>

                                      </div>		
                                      <div class="modal-footer">
                                          <button type="button" data-dismiss="modal" class="btn btn-default">
                                              Close
                                          </button>
                                      </div>
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

