<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Ss Parents </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/ss_parents/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Ss Parents')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/ss_parents', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Ss Parents')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($ss_parents): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th> Name</th>
                             <th>Gender</th>
                             <th>Relationship</th>
                             <th>Phone1</th>
                             <th>Email</th>
                             <th>Address</th>
                             <th>County</th>
                             <th>Location</th>
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($ss_parents as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo ucwords($p->first_name . ' ' . $p->last_name); ?></td>
                                          <td><?php echo ucwords($p->gender); ?></td>
                                          <td><?php echo ucwords($p->relationship); ?></td>
                                          <td><?php echo $p->phone1 . ' - ' . $p->phone2; ?></td>
                                          <td><?php echo $p->email; ?></td>
                                          <td><?php echo $p->address; ?></td>
                                          <td><?php echo $p->county; ?></td>
                                          <td><?php echo $p->location; ?></td>
                                          <td width='100'>
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/ss_parents/edit/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-edit'></i> Edit
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#modal<?php echo $p->id; ?>">
                                                                  <i class='icon-share'></i> View
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/ss_parents/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Remove
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                  <div class="modal fade" id="modal<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Name: <?php echo ucwords($p->first_name . ' ' . $p->last_name); ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p >
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Gender:</span> 
                                                      <span class="col-sm-4"><?php echo ucwords($p->gender); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Relationship:</span> 
                                                      <span class="col-sm-4"><?php echo ucwords($p->relationship); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Phone:</span> 
                                                      <span class="col-sm-4"><?php echo $p->phone1 . ' - ' . $p->phone2; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Email:</span> 
                                                      <span class="col-sm-4"><?php echo $p->email; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Address:</span> 
                                                      <span class="col-sm-4"><?php echo $p->address; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">County:</span> 
                                                      <span class="col-sm-4"><?php echo $p->county; ?></span>
                                                  </p>
                                                  <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Location:</span> 
                                                  <span class="col-sm-4"><?php echo $p->location; ?></span>
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