<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Users</h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/users/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'User')) . '</span>', 'class="btn btn-primary"'); ?> 

                    <?php echo anchor('admin/users', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Users')) . '</span>', 'class="btn btn-info"'); ?> 

                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($users): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Name</th>
                             <th>Phone</th>
                             <th>Email</th>
                             <th>Scope</th>
                             <th>Status</th>
                             <th>User Roles</th>
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  foreach ($users as $us)
                                  {
                                       $i++;
                                       $usr = $this->ion_auth->get_user($us->id);
                                       $gs = '';
                                       if (count($usr->groups))
                                       {
                                            $gs = array();
                                            foreach ($usr->groups as $g)
                                            {
                                                 $gs[] = $g->name;
                                            }
                                       }
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '. '; ?></td>
                                          <td>
                                              <a href="<?php echo base_url('admin/users/profile/' . $us->id) ?>">
                                                  <i class="icon-double-angle-right"></i><?php echo $usr->first_name . ' ' . $usr->last_name ?>
                                              </a>
                                          </td>
                                          <td><?php echo $us->phone; ?></td>
                                          <td><?php echo $us->email; ?></td>
                                          <td><span class="ptags" ><?php
                                       ?> </span>
                                          </td>
                                          <td> 
                                               <?php
                                               echo ($us->active) ? anchor("admin/users/deactivate/" . $us->id, 'Deactivate', 'class="btn btn-mini btn-gold"') :
                                                            anchor("admin/users/activate/" . $us->id, 'Activate', 'class="btn btn-mini btn-orange"');
                                               ?></td>
                                          </td>

                                          <td>
                                               <?php
                                               if (!is_array($gs))
                                               {
                                                    echo $gs;
                                               }
                                               else
                                               {
                                                    foreach ($gs as $vtag):
                                                         ?>
                                                        <span class="ptags "><?php echo $vtag; ?></span>
                                                        <?php
                                                   endforeach;
                                              }
                                              ?> </td>
                                          <td width="200">
                                              <div class='btn-group'>
                                                  <a class='btn btn-primary btn-sm' href='<?php echo site_url(); ?>admin/users/edit/<?php echo $us->id ?>/<?php echo $page ?>'><i class='icon-edit'></i> Edit Details</a>
                                                  <a class='btn btn-success btn-sm' href="<?php echo base_url('admin/users/profile/' . $us->id) ?>"><i class='icon-share'></i> Profile</a>
                                              </div>
                                          </td>
                                      </tr>
                                 <?php }
                                 ?>
                             </tbody>

                         </table>

                         <?php echo $links; ?>
                     </div>
                 </div>
             </div>
        <?php else: ?>
             <p class='text'><?php echo lang('web_no_elements'); ?></p>
    <?php endif ?>
</div>



