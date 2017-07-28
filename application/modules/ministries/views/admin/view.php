<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Ministries </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/ministries/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Ministries')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/ministries', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Ministries')) . '</span>', 'class="btn btn-primary"'); ?> 
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
                                          <td><a href='<?php echo site_url('admin/members/profile/' . $p->member_id); ?>'><?php echo $members[$p->member_id]; ?><i class="icon-double-angle-right"></i><?php echo ucwords($leader[$p->leader]); ?></a></td>
                                          <td><?php echo $p->telephone; ?></td>
                                          <td><?php echo $p->mobile; ?></td>
                                          <td><?php echo $p->email; ?></td>
                                          <td><?php echo $p->congregation_size; ?></td>

                                          <td width=''>
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
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/ministries/edit/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-edit'></i> Edit Details
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/ministries/view/' . $p->id . '/' . $page); ?>'>
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