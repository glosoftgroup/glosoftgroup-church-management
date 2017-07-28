<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Relatives </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/relatives/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Relatives')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/relatives', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Relatives')) . '</span>', 'class="btn btn-primary"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($relatives): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Member</th>
                             <th>Relative</th>
                             <th>Gender</th>
                             <th>Type</th>
                             <th>Relationship</th>
                             <th>Phone</th>
                             <th>Email</th>
                             <th>Additional Info</th>
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($relatives as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td>
                                              <a href='<?php echo site_url('admin/members/profile/' . $p->member_id); ?>'>
                                                  <i class="icon-double-angle-right"></i> 
                                                  <?php echo $member[$p->member_id]; ?></a>
                                          </td>					
                                          <td><?php echo $p->first_name . ' ' . $p->last_name; ?></td>
                                          <td><?php echo $p->gender; ?></td>
                                          <td><?php echo $p->type; ?></td>
                                          <td><?php echo $p->relationship; ?></td>
                                          <td><?php echo $p->phone; ?></td>
                                          <td><?php echo $p->email; ?></td>
                                          <td><?php echo $p->additionals; ?></td>
                                          <td >
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/relatives/edit/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-edit'></i> Edit
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/relatives/view/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-share'></i> View
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/relatives/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Remove
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
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