<!-- Main navbar -->
  <div class="navbar navbar-inverse navbar-fixed-top bg-indigo">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo base_url('/') ?>">
                     <?php
                         $ch = $this->settings;
                     ?>
                    <img src="<?php echo site_url('uploads/files/' . $ch->file); ?>">
                    <?php
                        // echo ucwords($ch->name);
                    ?>
                </a>

      <ul class="nav navbar-nav pull-right visible-xs-block">
        <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
      </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
      <ul class="nav navbar-nav">
        <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown dropdown-user">
          <a class="dropdown-toggle" data-toggle="dropdown">
             <?php
               $user = $this->ion_auth->get_user();
               $my_count_sms = $this->portal_m->count_my_sms($user->id);
               $avt = substr($user->first_name, 0, 1);
               $att = array('class' => 'circle-img');
               echo theme_image('m1.png', $att);
           ?>
            <span>
              <?php
              echo trim($this->user->first_name . ' ' . $this->user->last_name);
              ?>
            </span>
            <i class="caret"></i>
          </a>

          <ul class="dropdown-menu dropdown-menu-right">
            
             <?php
                                 if ($this->acl->is_allowed(array('users')))
                                 {
                                      ?>
                                     <li>
                                         <a href="<?php echo base_url('admin/permissions'); ?>">
                                             <i class="clip-users icon-blue"></i>
                                             &nbsp;Permissions
                                         </a>
                                     </li>
                                <?php } ?>
                            <?php
                                if ($this->acl->is_allowed(array('settings')))
                                {
                                     ?>
                                     <li>
                                         <a href="<?php echo base_url('admin/settings/backup'); ?>">
                                             <i class="clip-download-2"></i>
                                             &nbsp;Data Backup
                                         </a>
                                     </li>
                                <?php } ?>
                            <li>
                                <a href="<?php echo base_url('admin/users/profile'); ?>">
                                    <i class="clip-user-2"></i>
                                    &nbsp;My Profile
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/admin/calendar'); ?>">
                                    <i class="clip-calendar"></i>
                                    &nbsp;Full Calendar
                                </a>
                            <li>
                                <a href="<?php echo base_url('admin/sms/my_sms/' . $user->id); ?>">
                                    <i class="clip-bubble-4"></i>
                                    &nbsp;My Messages (<?php echo $my_count_sms ?>)
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/task_manager'); ?>"><i class="icon-list-ol"></i>
                                    &nbsp;My To Do List </a>
                            </li>
            
            <li class="divider"></li>
            <li>
                                <a href="<?php echo base_url('logout'); ?>">
                                    <i class="clip-exit"></i>
                                    &nbsp;Log Out
                                </a>
                            </li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
  <!-- /main navbar -->
