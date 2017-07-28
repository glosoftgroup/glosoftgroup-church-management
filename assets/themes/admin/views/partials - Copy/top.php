<!-- start: META -->
<meta charset="utf-8" />
<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta content="" name="description" />
<!-- end: META -->
<!-- start: MAIN CSS -->
<link rel="stylesheet" href="<?php echo plugin_path('bootstrap/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo plugin_path('font-awesome/css/font-awesome.min.css'); ?>" >
<?php echo theme_css('fonts/style.css'); ?>

<!-- echo theme_css('main-responsive.css'); ?> -->
<link rel="stylesheet" href="<?php echo plugin_path('iCheck/skins/all.css'); ?>" >
<!-- echo theme_css('main.css'); ?> -->
<!-- echo theme_css('custom.css'); ?> -->
<link rel="stylesheet" href=" <?php echo plugin_path('perfect-scrollbar/src/perfect-scrollbar.css'); ?>">
 <!-- echo theme_css('theme_light.css'); ?> -->
<?php echo core_css('core/css/icons/icomoon/styles.css'); ?>
        <?php echo core_css('core/css/bootstrap.css'); ?>
        <?php echo core_css('core/css/core.css'); ?>
        <?php echo core_css('core/css/components.css'); ?>
        <?php echo core_css('core/css/colors.css'); ?>
        <?=core_css("core/css/extras/animate.min.css");?>
<!--[if IE 7]>
<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<!-- end: MAIN CSS -->
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->

<!-- start: CSS REQUIRED FOR THIS Forms PAGE ONLY -->
<link rel="stylesheet" href="<?php echo plugin_path('select2/select2.css'); ?>" >
<link rel="stylesheet" href="<?php echo plugin_path('datepicker/css/datepicker.css'); ?>" >
<link rel="stylesheet" href="<?php echo plugin_path('bootstrap-timepicker/css/bootstrap-timepicker.min.css'); ?>" >
<link rel="stylesheet" href="<?php echo plugin_path('bootstrap-daterangepicker/daterangepicker-bs3.css'); ?>" >
<link rel="stylesheet" href="<?php echo plugin_path('bootstrap-colorpicker/css/bootstrap-colorpicker.css'); ?>" >
<link rel="stylesheet" href="<?php echo plugin_path('jQuery-Tags-Input/jquery.tagsinput.css'); ?>" >
<link rel="stylesheet" href="<?php echo plugin_path('bootstrap-fileupload/bootstrap-fileupload.min.css'); ?>" >
<link rel="stylesheet" href="<?php echo plugin_path('summernote/build/summernote.css'); ?>" >
<link rel="stylesheet" href="<?php echo plugin_path('ckeditor/contents.css'); ?>" >

<link rel="stylesheet" href="<?php echo plugin_path('fullcalendar/fullcalendar/fullcalendar.css'); ?>" >

<!-- Datatable CSS -->
<link rel="stylesheet" href="<?php echo plugin_path('DataTables/media/css/DT_bootstrap.css'); ?>" >


<link rel="stylesheet" href="<?php echo plugin_path('bootstrap-modal/css/bootstrap-modal-bs3patch.css'); ?>" >
<link rel="stylesheet" href="<?php echo plugin_path('bootstrap-modal/css/bootstrap-modal.css'); ?>" >
<link href="<?php echo plugin_path('jeditable/bootstrap-editable.css'); ?>" rel="stylesheet">


<link href="<?php echo plugin_path('jquery-ui/jquery-ui-1.10.1.custom.min.css'); ?>" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo plugin_path('dynatree/src/skin-vista/ui.dynatree.css'); ?>">

<!-------MAIN JQUERY FILE------->
<?php echo theme_js('jquery.min.js'); ?>
<?php echo theme_js('ajaxfileupload.js'); ?>

<!-- end: Favicon Image -->
<link rel="shortcut icon" href="<?php echo plugin_path('favicon.png'); ?>" />
 
</head>
<!-- end: HEAD -->
<!-- start: BODY -->
<body>
    <!-- start: HEADER -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <!-- start: TOP NAVIGATION CONTAINER -->
        <div class="container">
            <div class="navbar-header">
                <!-- start: RESPONSIVE MENU TOGGLER -->
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="clip-list-2"></span>
                </button>
                <!-- end: RESPONSIVE MENU TOGGLER -->
                <!-- start: LOGO -->
                <a class="navbar-brand" href="<?php echo base_url('/') ?>">
                     <?php
                         $ch = $this->settings;
                     ?>
                    <img src="<?php echo site_url('uploads/files/' . $ch->file); ?>">
                    <?php
                        // echo ucwords($ch->name);
                    ?>
                </a>
                <!-- end: LOGO -->
            </div>
            <div class="navbar-tools">
                <!-- start: TOP NAVIGATION MENU -->
                <ul class="nav navbar-right">
                    <!-- start: TO-DO DROPDOWN -->
                    <li>
                        <br>
                        <div class="btn-group">

                            <button class=" btn btn-sm  
                            <?php
                                $bal = $this->portal_m->get_counter_balance();
                                if ($bal->balance > 5)
                                     echo 'btn-beige';
                                else
                                     echo 'btn-danger';
                            ?>">
                                <i class=' clip-question-2'></i> NOTE
                            </button> 

                            <button class="btn btn-sm btn-dark-grey">Your SMS Account Balance is <span style="text-decoration:underline;
                                                                                                       font-weight:bold;"><?php echo $bal->balance; ?></span> SMS</button>

                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </li>

                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="clip-list-5"></i>
                            <span class="badge"> <?php echo $this->portal_m->count_tasks(); ?></span>
                        </a>
                        <ul class="dropdown-menu todo">
                            <li>
                                <span class="dropdown-menu-title"> You have  <?php echo $this->portal_m->count_tasks(); ?> pending task(s)</span>
                            </li>
                            <li>
                                <div class="drop-down-wrapper">
                                    <ul>
                                         <?php
                                             $get_tasks = $this->portal_m->get_tasks();

                                             if ($get_tasks)
                                             {

                                                  foreach ($get_tasks as $p)
                                                  {
                                                       ?>
                                                      <li>
                                                          <a class="todo-actions" href="javascript:void(0)">
                                                              <i class="icon-check-empty"></i>
                                                              <span class="desc" style="opacity: 1; text-decoration: none;"><?php echo $p->title; ?></span>
                                                              <span class="" style="opacity: 1;">

                                                                  <?php
                                                                  $tm = explode(' ', time_ago($p->created_on));
                                                                  if (time_ago($p->created_on) == 'Yesterday')
                                                                  {
                                                                       echo '<span class="label label-inverse">' . time_ago($p->created_on) . '</span>';
                                                                  }
                                                                  elseif ($tm[1] == 'days')
                                                                  {
                                                                       echo '<span class="label label-orange">' . time_ago($p->created_on) . '</span>';
                                                                  }
                                                                  else
                                                                  {
                                                                       echo '<span class="label label-info">' . time_ago($p->created_on) . '</span>';
                                                                  }
                                                                  ?>
                                                              </span>
                                                          </a>
                                                      </li>

                                                      <?php
                                                 }
                                            }
                                            else
                                            {

                                                 echo "<h5>No ongoing Tasks at the moment</5>";
                                            }
                                        ?>	

                                    </ul>
                                </div>
                            </li>
                            <li class="view-all">
                                <a href="javascript:void(0)">
                                    See all tasks <i class="icon-circle-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end: TO-DO DROPDOWN-->
                    <!-- start: NOTIFICATION DROPDOWN -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                            <i class="clip-notification-2"></i>
                            <span class="badge"> <?php echo $this->portal_m->count_overdue_pledges(); ?></span>
                        </a>
                        <ul class="dropdown-menu notifications">
                            <li>
                                <span class="dropdown-menu-title"> Overdue Pledges</span>
                            </li>
                            <li>
                                <div class="drop-down-wrapper">
                                    <ul>
                                         <?php
                                             $pledges = $this->portal_m->pending();

                                             if ($pledges)
                                             {

                                                  foreach ($pledges as $p)
                                                  {
                                                       $u = $this->ion_auth->get_single_member($p->member);
                                                       ?>
                                                      <li>
                                                          <a  class="tooltips" data-original-title="View Profile" data-placement="top" href="<?php echo site_url('admin/members/profile/' . $p->member) ?>">
                                                              <span class="label label-primary"><i class="icon-user"></i></span>
                                                              <span class="message"> 

                                                                  <i class="icon-double-angle-right"></i> 
                                                                  <?php echo $u->first_name . ' ' . $u->last_name; ?>

                                                              </span>
                                                              <span class="time">KES.<?php echo number_format($p->amount, 2); ?></span>
                                                          </a>
                                                      </li>
                                                      <?php
                                                 }
                                            }
                                            else
                                            {

                                                 echo "<h5>No Overdue Pledges at the moment</5>";
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="view-all">
                                <a href="<?php echo base_url('admin/pledges/pending') ?>">
                                    See All Pending Pledges <i class="icon-circle-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end: NOTIFICATION DROPDOWN -->
                    <!-- start: MESSAGE DROPDOWN -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#">
                            <i class="clip-bubble-3"></i>
                            <span class="badge"> <?php echo $this->portal_m->count_sms(); ?></span>
                        </a>
                        <ul class="dropdown-menu posts">
                            <li>
                                <span class="dropdown-menu-title"> Recent Sent Messages</span>
                            </li>
                            <li>
                                <div class="drop-down-wrapper">
                                    <ul>
                                         <?php
                                             $sms = $this->portal_m->get_sms();
                                             if ($sms)
                                             {

                                                  foreach ($sms as $p)
                                                  {
                                                       ?>

                                                      <li>
                                                          <a href="javascript:;">
                                                              <div class="clearfix">
                                                                  <div class="thread-image">
                                                                       <?php echo theme_image('sms.png'); ?>

                                                                  </div>
                                                                  <div class="thread-content">
                                                                      <span class="author"><?php echo ucwords($p->sent_to); ?></span>
                                                                      <span class="preview"><?php echo substr($p->message, 0, 100) . '...'; ?></span>
                                                                      <span class="time"> 
                                                                           <?php
                                                                           $tm = explode(' ', time_ago($p->created_on));
                                                                           if (time_ago($p->created_on) == 'Yesterday')
                                                                           {
                                                                                echo '<span class="label label-inverse">' . time_ago($p->created_on) . '</span>';
                                                                           }
                                                                           elseif ($tm[1] == 'days')
                                                                           {
                                                                                echo '<span class="label label-orange">' . time_ago($p->created_on) . '</span>';
                                                                           }
                                                                           else
                                                                           {
                                                                                echo '<span class="label label-info">' . time_ago($p->created_on) . '</span>';
                                                                           }
                                                                           ?>
                                                                      </span>
                                                                  </div>
                                                              </div>
                                                          </a>
                                                      </li>
                                                      <?php
                                                 }
                                            }
                                            else
                                            {

                                                 echo "<h5>No SMS Sent at the moment</5>";
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="view-all">
                                <a href="<?php echo base_url('admin/sms/') ?>">
                                    See All Sent Messages <i class="icon-circle-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end: MESSAGE DROPDOWN -->
                    <!-- start: USER DROPDOWN -->
                    <li class="dropdown current-user">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                             <?php
                                 $user = $this->ion_auth->get_user();
                                 $my_count_sms = $this->portal_m->count_my_sms($user->id);
                                 $avt = substr($user->first_name, 0, 1);
                                 $att = array('class' => 'circle-img');
                                 echo theme_image('m1.png', $att);
                             ?>

                            <span class="username"><?php echo trim($user->first_name . ' ' . $user->last_name); ?></span>
                            <i class="clip-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu">
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
                            <li>
                                <a href="<?php echo base_url('logout'); ?>">
                                    <i class="clip-exit"></i>
                                    &nbsp;Log Out
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end: USER DROPDOWN -->
                </ul>
                <!-- end: TOP NAVIGATION MENU -->
            </div>
        </div>
        <!-- end: TOP NAVIGATION CONTAINER -->
    </div>