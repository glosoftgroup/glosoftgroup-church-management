<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Hbc Meetings </h3>

            <div class="heading-elements">
                <div class="btn-group">

                    <?php echo anchor('admin/hbc_meetings', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Meetings')) . '</span>', 'class="btn btn-primary"'); ?> 

                    <?php echo anchor('admin/hbcs', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'HBCs')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($hbc_meetings): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Meeting Date</th>
                             <th>HBC</th>
                             <th>Host</th>
                             <th>Hosts Phone No</th>
                             <th>House Number</th>
                             <th>Preacher</th>
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

                                  foreach ($hbc_meetings as $p):
                                       $u = $this->ion_auth->get_single_member($p->host);
                                       $pp = $this->ion_auth->get_single_member($p->preacher);
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo date('d M Y', $p->date); ?></td>
                                          <td><?php echo $hbc[$p->hbc]; ?></td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                          <td><?php echo $p->hosts_phone_no; ?></td>
                                          <td><?php echo $p->house_number; ?></td>
                                          <td><a class="tooltips" data-original-title="View <?php echo $pp->first_name ?>'s Profile" data-placement="top" href='<?php echo site_url('admin/members/profile/' . $pp->id); ?>'><i class="icon-double-angle-right"></i> <?php echo $pp->first_name . ' ' . $pp->last_name; ?></a></td>
                                          <td><?php echo substr($p->brief_description, 0, 30) . '...'; ?></td>
                                          <td >
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/hbc_meetings/edit/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-edit'></i> Edit
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#modal<?php echo $p->id; ?>">
                                                                  <i class='icon-share'></i> View
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/hbc_meetings/delete/' . $p->id . '/' . $page); ?>'>
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
                                                  <h4 class="modal-title">Date: <?php echo date('d M Y', $p->date); ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p >
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">HBC:</span> 
                                                      <span class="col-sm-4"><?php echo $hbc[$p->hbc]; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>

                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Host:</span> 
                                                      <span class="col-sm-7"><?php echo $u->first_name . ' ' . $u->last_name; ?></span>
                                                  </p>
                                                  <div class="clearfix"></div><hr>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Hosts Phone No.:</span> 
                                                      <span class="col-sm-4"><?php echo $p->hosts_phone_no; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">House No:</span> 
                                                      <span class="col-sm-4"><?php echo $p->house_number; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Preacher:</span> 
                                                      <span class="col-sm-4"><?php echo $pp->first_name . ' ' . $pp->last_name; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Description:</span>
                                                      <span class="col-sm-4"><?php echo $p->brief_description; ?></span>
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
                 </div> 
            <?php else: ?>
                 <p class='text'><?php echo lang('web_no_elements'); ?></p>
        <?php endif ?>
    </div>
</div>
</div>
