<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Sunday School </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/sunday_school/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Child')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/sunday_school', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Children')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($sunday_school): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Passport</th>

                             <th>Name</th>
                             <th>Date Joined</th>
                             <th>Gender</th>				
                             <th>Birthday</th>
                             <th>Parent/Guardian</th>
                             <th>Home Contacts</th>
                             <th>Residential</th>

                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $j = 1;

                                  foreach ($sunday_school as $p):

                                       $paro = $this->ion_auth->get_members();
                                       ?>
                                      <tr>
                                          <td><?php echo $j . '.'; ?></td>
                                          <td>
                                               <?php if (empty($p->passport))
                                               {
                                                    ?>
                                                   <div class="fileupload-new thumbnail" style="width: 40px; height: 40px;">
                                                       <img src="<?php echo base_url('uploads/files/m1.png'); ?>" alt="">
                                                   </div>
                                              <?php
                                              }
                                              else
                                              {
                                                   ?>

                                                   <img alt="" src="<?php echo base_url('uploads/files/' . $p->passport); ?>" style="" class="circle-img" height="40" width="40">
              <?php } ?>
                                          </td>		

                                          <td><a class="tooltips" data-original-title="View <?php echo $p->first_name ?>'s Profile" data-placement="top" href='<?php echo site_url('admin/sunday_school/profile/' . $p->id); ?>'>
                                                  <i class="icon-double-angle-right"></i> <?php echo $p->first_name . ' ' . $p->last_name; ?></a></td>
                                          <td><?php echo date('d M Y', $p->date_joined); ?></td>
                                          <td><?php echo $p->gender; ?></td>
                                          <td><?php echo date('d M Y', $p->dob); ?></td>

                                          <td><?php
                                               if ($p->type == 1)
                                               {
                                                    echo $paro[$p->parent_id];
                                               }
                                               else
                                               {
                                                    echo $parent[$p->id];
                                               }
                                               ?></td>

                                          <td><?php
                                               $ph = $p->home_phone;
                                               $cha = array('(', ')', '-');
                                               $sp = array('', '', '');
                                               echo str_replace($cha, $sp, $ph);
                                               ?></td>

                                          <td><?php echo $p->residential; ?></td>

                                          <td width='100'>
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/sunday_school/edit/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-edit'></i> Edit
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' href='<?php echo site_url('admin/sunday_school/profile/' . $p->id); ?>'>
                                                                  <i class='icon-share'></i> View
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/sunday_school/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Remove
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>

              <?php $j++;
         endforeach
         ?>
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
