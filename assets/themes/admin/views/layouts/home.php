<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <!--[if gt IE 8]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <![endif]-->
        <title><?php echo $template['title']; ?></title>

        <!-- Global stylesheets -->
          <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <?php echo core_css('core/css/icons/icomoon/styles.css'); ?>
        <link rel="stylesheet" href="<?php echo plugin_path('font-awesome/css/font-awesome.min.css'); ?>" >
        
        <?php echo theme_css('fonts/style.css'); ?>
        <?php echo core_css('core/css/bootstrap.css'); ?>
        <?php echo core_css('core/css/core.css'); ?>
        <?php echo core_css('core/css/components.css'); ?>
        <?php echo core_css('core/css/colors.css'); ?>
        <link rel="stylesheet" href="<?php echo plugin_path('iCheck/skins/all.css'); ?>" >
         
         <link rel="stylesheet" href=" <?php echo plugin_path('perfect-scrollbar/src/perfect-scrollbar.css'); ?>">
      
        <?=core_css("core/css/extras/animate.min.css");?>
        <style>.error { color:red; }</style>
          <!-- /global stylesheets -->
        <!--[if lt IE 10]>
            <link href="css/ie.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <script> var BASE_URL = '<?php echo base_url(); ?>';</script>
        <!-- Core JS files -->
        <!-- Core JS files -->
        <?php echo core_js('core/js/plugins/loaders/pace.min.js'); ?>
        <?php echo core_js('core/js/core/libraries/jquery.min.js'); ?>
       
        <?php echo core_js('core/js/core/libraries/bootstrap.min.js'); ?>
        <?php echo core_js('core/js/plugins/loaders/blockui.min.js'); ?>

        <!-- /core JS files -->
        <!-- Theme JS files -->
        <?php echo core_js('core/js/plugins/ui/nicescroll.min.js'); ?>
        <?php echo core_js('core/js/core/app.js'); ?>
        <?php echo core_js('core/js/plugins/forms/selects/select2.min.js'); ?>
        <?php echo core_js('core/js/pages/layout_fixed_custom.js'); ?>
        <?php echo core_js('core/js/plugins/ui/ripple.min.js'); ?>
        <!-- /theme JS files -->
        <!-- datatables -->
        <?php echo core_js('core/js/plugins/tables/datatables/datatables.min.js'); ?>
        <?php echo core_js('core/js/pages/datatables_advanced.js'); ?>
        <!-- ./datatables -->

        <!-- theme scripts -->
        <?php echo core_js('core/js/plugins/pickers/pickadate/picker.js'); ?>

        <?php echo core_js('core/js/plugins/pickers/pickadate/picker.date.js'); ?>

        <?php echo core_js('core/js/plugins/pickers/pickadate/picker.time.js'); ?>
        <!-- Updated stylesheet url -->
        <?=core_js("core/js/core/libraries/jquery_ui/widgets.min.js");?>
        <?=core_js("core/js/pages/animations_css3.js");?>
        <script src="<?php echo plugin_path('jquery.sparkline/jquery.sparkline.js'); ?>"></script>
        <script src="<?php echo plugin_path('flot/jquery.flot.js'); ?>"></script>
    <script src="<?php echo plugin_path('flot/jquery.flot.pie.js'); ?>"></script>
    <script src="<?php echo plugin_path('flot/jquery.flot.resize.min.js'); ?>"></script>
    <?php echo core_js('core/js/plugins/ui/moment/moment.min.js'); ?>
    <?php echo core_js('core/js/plugins/ui/fullcalendar/fullcalendar.min.js'); ?>
        
        <!-- ./theme scripts -->

        <!-- old files -->

       <!-- echo theme_css('sett.css'); ?> -->
        <?php echo theme_css('jquery.dataTables.css'); ?>
        <?php echo theme_css('tableTools.css'); ?>
        <?php echo theme_css('dataTables.colVis.min.css'); ?>


          <!-- echo theme_css('select2/select2.css'); -->
        <link href="<?php echo js_path('plugins/jeditable/bootstrap-editable.css'); ?>" rel="stylesheet">

       
       
     
        
        <link rel="shortcut icon" type="image/ico" href="<?php echo image_path('favicon.ico'); ?>" />
    </head>
    <?php
    $ccls = 'ssRed';
    if ($this->ion_auth->is_in_group($this->user->id, 3))
    {
            $ccls = 'ssGreen';
    }
    ?>
    <body class="navbar-top sidebar-xs has-detached-right" >
        <?php echo $template['partials']['top']; ?>
        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">
          <?php echo $template['partials'][$this->side]; ?>
         <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header page-header-default">
                <?php 
                if (!preg_match('/^(admin\/leaving_certificate)/i', $this->uri->uri_string())){
                ?>
                <!-- breadcrumb -->
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li>
                <i class="icon-home2 position-left"></i>
                <?php echo anchor('/', 'Home'); ?>
              </li>
              <?php  if ($this->uri->segment(2)) { ?>
              <li>
                <?php echo anchor('admin/' . $this->uri->segment(2), humanize($this->uri->segment(2))); ?>
               </li>
              <?php } ?>
                            <li class="active"><?php echo $template['title']; ?></li>
                        </ul>

                        <ul class="breadcrumb-elements">
              <li>
                <?php
                              $user = $this->ion_auth->get_user();
                              $gp = $this->ion_auth->get_users_groups($user->id)->row();
                              ?><small>&nbsp;</small>
                              <span class="label label-success"  ><?php echo ucwords($gp->name); ?></span>

                      </li>
                        </ul>
                    </div>
                    <!-- end breadcrumbs -->
                    <?php } ?>
                </div>
                <!-- /page header -->

                <!-- Content area -->
                <div class="content">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="panel-body">

                            <?php
                            if ($this->session->flashdata('warning'))
                            {
                                    ?>
                                    <div class="alert">
                                        <button type="button" class="close" data-dismiss="alert">                                    
                                            <i class="icon-remove"></i>                                </button>
                                        <strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>
                                    </div>
                            <?php } ?> 
                            <?php
                            if ($this->session->flashdata('warning'))
                            {
                                    ?>
                                    <div class="alert">
                                        <button type="button" class="close" data-dismiss="alert">                                    
                                            <i class="icon-remove"></i>                                </button>
                                        <strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>
                                    </div>
                            <?php } ?>
                            <?php
                            if ($this->session->flashdata('success'))
                            {
                                    ?>
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">  <i class="icon-remove"></i>  </button>
                                        <?php echo $this->session->flashdata('success'); ?>
                                    </div>
                            <?php } ?>
                            <?php
                            if ($this->session->flashdata('info'))
                            {
                                    ?>
                                    <div class="alert alert-info">
                                        <button type="button" class="close" data-dismiss="alert">                                    
                                            <i class="icon-remove"></i>                                </button>
                                        <?php echo $this->session->flashdata('info'); ?>
                                    </div>
                            <?php } ?>
                            <?php
                            if ($this->session->flashdata('message'))
                            {
                                    $message = $this->session->flashdata('message');
                                    $str = is_array($message) ? $message['text'] : $message;
                                    ?>
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">                                   
                                            <i class="icon-remove"></i>                                </button>
                                        <i class="icon-thumbs-up"></i> <?php echo $str; //$this->session->flashdata('message');      ?>
                                    </div>
                            <?php } ?>
                            <?php
                            if ($this->session->flashdata('error'))
                            {
                                    $mess = $this->session->flashdata('error');
                                    $strr = is_array($mess) ? $mess['text'] : $mess;
                                    ?>
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">                                   
                                            <i class="icon-remove"></i>                                </button>
                                        <i class="icon-warning-sign"></i> <?php echo $strr; ?>
                                    </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                </div>

                    <!-- Detached content -->
                    <div class="container-detached">
                        <div class="content-detached">
                        <!-- My messages -->
                            <div class="panel panel-flat border-bottom-lg border-bottom-primary">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Dashboard overview & stats</h6>
                                    <div class="heading-elements">
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
                                        <span class="heading-text"><i class="glyphicon glyphicon-repeat text-warning position-left"></i> Jul 7, 10:30</span>
                                        <span class="label bg-success heading-text">Online</span>
                                    </div>
                                </div>

                                <!-- Numbers -->
                                <div class="container-fluid">
                                    <div class="row text-center">
                                        <div class="col-md-2">
                                           <a href="<?php echo base_url('admin/members'); ?>">
                                            <div class="content-group">
                                                <h6 class="text-semibold no-margin"><i class="icon-group circle-icon circle-green  position-left text-slate"></i> <strong><?php echo number_format($members_count); ?></strong></h6>
                                                <span class="text-muted text-size-small">all members</span>
                                            </div>
                                            </a>
                                        </div>

                                        <div class="col-md-2">
                                           <a href="<?php echo base_url('admin/visitors'); ?>">
                                            <div class="content-group">
                                                <h6 class="text-semibold no-margin"><i class="clip-thumbs-up circle-icon circle-green position-left text-slate"></i> <strong><?php echo number_format($visitors_count); ?></strong></h6>
                                                <span class="text-muted text-size-small">all visitors</span>
                                            </div>
                                           </a>
                                        </div>

                                        <div class="col-md-2">
                                          <a href="<?php echo base_url('admin/sunday_school'); ?>">
                                            <div class="content-group">
                                                <h6 class="text-semibold no-margin"><i class="clip-users circle-icon circle-green position-left text-slate"></i> <strong><?php echo number_format($ss_count); ?></strong></h6>
                                                <span class="text-muted text-size-small">sunday school</span>
                                            </div>
                                          </a>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="content-group">
                                                <h6 class="text-semibold no-margin"><i class="icon-list-ul circle-icon circle-teal  position-left text-slate"></i> <strong><?php echo number_format($hbcs_count); ?></strong></h6>
                                                <span class="text-muted text-size-small">all HBCS</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                         <a href="<?php echo base_url('admin/ministries'); ?>">
                                            <div class="content-group">
                                                <h6 class="text-semibold no-margin"><i class="icon-comments position-left text-slate"></i> <strong><?php echo number_format($ministries_count); ?></strong></h6>
                                                <span class="text-muted text-size-small">all ministries</span>
                                            </div>
                                         </a>
                                        </div>
                                        <div class="col-md-2">
                                          <a href="<?php echo base_url('admin/users'); ?>">
                                            <div class="content-group">
                                                <h6 class="text-semibold no-margin"><i class="clip-users-2 circle-icon circle-black position-left text-slate"></i> <strong><?php echo number_format($users_count); ?></strong></h6>
                                                <span class="text-muted text-size-small">all users</span>
                                            </div>
                                         </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /numbers -->
                                </div>
                          
                          
                            
                            <!-- dashboard panels -->
                             <div class="row">
                            <div class="col-md-12">
                                <!-- start: CONDENSED TABLE PANEL -->
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <i class="icon-external-link-sign"></i>
                                        Recent Collections
                                        <div class="heading-elements">
                                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                                            </a>

                                            <a class="btn btn-xs btn-link panel-refresh" href="#">
                                                <i class="icon-refresh"></i>
                                            </a>
                                            <a class="btn btn-xs btn-link panel-expand" href="#">
                                                <i class="icon-resize-full"></i>
                                            </a>
                                            <a class="btn btn-xs btn-link panel-close" href="#">
                                                <i class="icon-remove"></i>
                                            </a>
                                            <a class="btn btn-xs btn-link" href="<?php echo site_url('admin/logs') ?>">
                                                <i class="icon-list-ol"></i>
                                            </a>

                                        </div>
                                    </div>
                                    <div class="panel-body">
                                         <?php
                                        if ($collection_log)
                                        {
                                                ?>
                                                <table class="table table-condensed table-hover" id="sample-table-3">
                                                    <thead>
                                                        <tr>
                                                            <th class="center hidden-xs">
                                                    <div class="checkbox-table">
                                                        <label>
                                                            <input type="checkbox" class="flat-grey">
                                                        </label>
                                                    </div></th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th class="hidden-xs"><i class="icon-calendar"></i> Date</th>
                                                    <th> Recorded By </th>
                                                    <th class="hidden-xs">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 0;
                                                        foreach ($collection_log as $log)
                                                        {
                                                                $u = $this->ion_auth->get_user($log->created_by);
                                                                if ($i == 8)
                                                                        break;
                                                                $i++;
                                                                ?>
                                                                <tr>
                                                                    <td class="center hidden-xs">
                                                                        <div class="checkbox-table">
                                                                            <label>
                                                                                <input type="checkbox" class="flat-grey">
                                                                            </label>
                                                                        </div></td>
                                                                    <td>
                                                                        <a class="tooltips" data-placement="top" data-original-title="View All" href="<?php echo site_url('admin/' . $log->type); ?>">
                                                                            <?php
                                                                            $tpy = $log->type;
                                                                            $cha = array('_');
                                                                            $sp = array(' ');
                                                                            $tt = str_replace($cha, $sp, $tpy);
                                                                            echo ucwords($tt);
                                                                            ?>
                                                                        </a></td>
                                                                    <td><?php echo number_format($log->amount); ?></td>
                                                                    <td class="hidden-xs">
                                                                        <?php
                                                                        $tm = explode(' ', time_ago($log->created_on));
                                                                        if (time_ago($log->created_on) == 'Yesterday')
                                                                        {
                                                                                echo '<span class="label label-inverse">' . time_ago($log->created_on) . '</span>';
                                                                        }
                                                                        elseif ($tm[1] == 'days')
                                                                        {
                                                                                echo '<span class="label label-orange">' . time_ago($log->created_on) . '</span>';
                                                                        }
                                                                        else
                                                                        {
                                                                                echo '<span class="label label-info">' . time_ago($log->created_on) . '</span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                                                    <td class="hidden-xs">
                                                                        <a href="<?php echo site_url('admin/' . $log->type); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="View All Collections"><i class="icon-share"></i></a>
                                                                        <a href="<?php ?>" class="btn btn-xs btn-danger tooltips" data-placement="top" data-original-title="Change Status"><i class="icon-cut"></i></a>

                                                                    </td>
                                                                </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                        }
                                        else
                                        {
                                                ?>
                                                <h4>No Collection Registered at the moment</h4>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- end: CONDENSED TABLE PANEL -->
                            </div>

                            <div class="col-sm-12">
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <i class="clip-stats"></i>
                                        Contribution Flow For The Year <?php echo date('Y') ?>
                                        <div class="heading-elements">
                                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                                            </a>
                                            <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                                <i class="icon-wrench"></i>
                                            </a>
                                            <a class="btn btn-xs btn-link panel-refresh" href="#">
                                                <i class="icon-refresh"></i>
                                            </a>
                                            <a class="btn btn-xs btn-link panel-close" href="#">
                                                <i class="icon-remove"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="flot-medium-container">
                                            <div id="placeholder-h1" style="height:300px;" class="flot-placeholder"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <i class="icon-external-link-sign"></i>
                                        Pending Pledges
                                        <div class="heading-elements">
                                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                                            </a>
                                            <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                                <i class="icon-wrench"></i>
                                            </a>
                                            <a class="btn btn-xs btn-link panel-refresh" href="#">
                                                <i class="icon-refresh"></i>
                                            </a>
                                            <a class="btn btn-xs btn-link panel-expand" href="#">
                                                <i class="icon-resize-full"></i>
                                            </a>
                                            <a class="btn btn-xs btn-link panel-close" href="#">
                                                <i class="icon-remove"></i>
                                            </a>
                                            <a class="btn btn-xs btn-link" href="<?php echo site_url('admin/pledges') ?>">
                                                <i class="icon-list-ol"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        if ($pledges)
                                        {
                                                ?>
                                                <table class="table table-condensed table-hover" id="sample-table-3">
                                                    <thead>
                                                        <tr>
                                                            <th class="center hidden-xs">#</th>
                                                            <th>Pledge</th>
                                                            <th>Member</th>
                                                            <th> Amount </th>
                                                            <th class="hidden-xs">Status</th>

                                                            <th class="hidden-xs">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 0;
                                                        foreach ($pledges as $p)
                                                        {
                                                                if ($i == 5)
                                                                        break;
                                                                $i++;
                                                                ?>
                                                                <tr>
                                                                    <td class="center hidden-xs"> 
                                                                        <?php echo $i; ?> 
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $p->title; ?>
                                                                    </td>
                                                                    <td><a class="tooltips" data-placement="top" data-original-title="View <?php echo $single_member[$p->member] ?>'s Profile" href="<?php echo site_url('admin/members/profile/' . $p->member); ?>"><?php echo $single_member[$p->member]; ?></a></td>
                                                                    <td class="hidden-xs">
                                                                        <?php echo number_format($p->amount, 2); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        echo '<span class="label label-warning"> Pending</span> ';
                                                                        $now = time(); // or your date as well
                                                                        $p_date = date('Y-m-d', $p->expected_pay_date);
                                                                        $act_date = strtotime($p_date);
                                                                        $datediff = $act_date - $now;
                                                                        $days = floor($datediff / (60 * 60 * 24));
                                                                        if ($days < 0)
                                                                        {
                                                                                echo ' <span class="label label-danger"> Overdue </span>';
                                                                        }
                                                                        elseif (0 == $days)
                                                                        {
                                                                                echo ' <span class="label label-info"> ' . $days . ' Days to go  </span>';
                                                                        }
                                                                        else
                                                                        {
                                                                                echo ' <span class="label label-info">' . $days . ' Day(s) to go </span>';
                                                                        }
                                                                        ?>

                                                                    </td>
                                                                    <td class="hidden-xs">
                                                                        <a href="<?php echo site_url('admin/pledges/'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="View All Pledges"><i class="icon-share"></i></a>

                                                                    </td>
                                                                </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                        }
                                        else
                                        {
                                                ?>
                                                <h4>No Pledges recorded at the moment</h4>
                                        <?php } ?>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <i class="icon-external-link-sign"></i>
                                        Recent Expenses
                                        <div class="heading-elements">
                                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                                            </a>

                                            <a class="btn btn-xs btn-link panel-refresh" href="#">
                                                <i class="icon-refresh"></i>
                                            </a>
                                            <a class="btn btn-xs btn-link panel-expand" href="#">
                                                <i class="icon-resize-full"></i>
                                            </a>
                                            <a class="btn btn-xs btn-link panel-close" href="#">
                                                <i class="icon-remove"></i>
                                            </a>
                                            <a class="btn btn-xs btn-link" href="<?php echo site_url('admin/expenses') ?>">
                                                <i class="icon-list-ol"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        if ($expenses)
                                        {
                                                ?>
                                                <table class="table table-condensed table-hover" id="sample-table-3">
                                                    <thead>
                                                        <tr>
                                                            <th class="center hidden-xs">#</th>
                                                            <th>Title</th>
                                                            <th>Amount</th>
                                                            <th class="hidden-xs"><i class="icon-calendar"></i> Date</th>
                                                            <th> Recorded By </th>
                                                            <th class="hidden-xs">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 0;
                                                        foreach ($expenses as $p)
                                                        {
                                                                $u = $this->ion_auth->get_user($p->person_responsible);
                                                                if ($i == 5)
                                                                        break;
                                                                $i++;
                                                                ?>
                                                                <tr>
                                                                    <td class="center hidden-xs">

                                                                        <?php echo $i; ?>
                                                                    </td>
                                                                    <td>
                                                                        <a class="tooltips" data-placement="top" data-original-title="View All" href="<?php echo site_url('admin/expenses'); ?>">
                                                                            <?php echo $expenses_items[ucwords($p->item)]; ?>
                                                                        </a></td>
                                                                    <td><?php echo number_format($p->amount); ?></td>
                                                                    <td class="hidden-xs">
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
                                                                    </td>
                                                                    <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                                                    <td class="hidden-xs">
                                                                        <a href="<?php echo site_url('admin/expenses'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="View All Expenses"><i class="icon-share"></i></a>
                                                                        <a href="<?php echo site_url('admin/expenses/create'); ?>" class="btn btn-xs btn-primary tooltips" data-placement="top" data-original-title="Add Expense"><i class="icon-plus"></i></a>
                                                                        <a href="<?php ?>" class="btn btn-xs btn-danger tooltips" data-placement="top" data-original-title="Void This"><i class="icon-cut"></i></a>

                                                                    </td>
                                                                </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                        }
                                        else
                                        {
                                                ?>
                                                <h4>No Expenses recorded at the moment</h4>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                         <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <i class="clip-calendar"></i>
                                Calendar
                                <div class="heading-elements">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                                    </a>
                                    <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                        <i class="icon-wrench"></i>
                                    </a>
                                    <a class="btn btn-xs btn-link panel-refresh" href="#">
                                        <i class="icon-refresh"></i>
                                    </a>
                                    <a class="btn btn-xs btn-link panel-expand" href="#">
                                        <i class="icon-resize-full"></i>
                                    </a>
                                    <a class="btn btn-xs btn-link panel-close" href="#">
                                        <i class="icon-remove"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div id='calendar'></div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <!-- start: BORDERED TABLE PANEL -->
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <i class="icon-external-link-sign"></i>
                                Recent Registered Members
                                <div class="heading-elements">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                                    </a>
                                    <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                        <i class="icon-wrench"></i>
                                    </a>
                                    <a class="btn btn-xs btn-link panel-refresh" href="#">
                                        <i class="icon-refresh"></i>
                                    </a>
                                    <a class="btn btn-xs btn-link panel-expand" href="#">
                                        <i class="icon-resize-full"></i>
                                    </a>
                                    <a class="btn btn-xs btn-link panel-close" href="#">
                                        <i class="icon-remove"></i>
                                    </a>
                                    <a class="btn btn-xs btn-link" href="<?php echo site_url('admin/members') ?>">
                                        <i class="icon-list-ol"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <?php
                                if ($members)
                                {
                                        ?>
                                        <table class="table table-condensed table-hover" id="sample-table-3">
                                            <thead>
                                                <tr>
                                                    <th class="center hidden-xs"> #</th>
                                                    <th>Photo</th>
                                                    <th>Name</th>
                                                    <th class="hidden-xs"><i class="icon-calendar"></i> Date</th>
                                                    <th> Phone </th>
                                                    <th class="hidden-xs">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                foreach ($members as $p)
                                                {
                                                        if ($i == 6)
                                                                break;
                                                        $i++;
                                                        ?>
                                                        <tr>
                                                            <td class="center hidden-xs">
                                                                <?php echo $i; ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if (empty($p->passport))
                                                                {
                                                                        ?>
                                                                        <div class="fileupload-new thumbnail" style="width: 28px; height: 28px;">
                                                                            <img src="<?php echo base_url('uploads/files/m1.png'); ?>" alt="">
                                                                        </div>
                                                                        <?php
                                                                }
                                                                else
                                                                {
                                                                        ?>

                                                                        <img alt="" src="<?php echo base_url('uploads/files/' . $p->passport); ?>" style="" class="circle-img" height="28" width="28">
                                                                <?php } ?>
                                                            </td>
                                                            <td><a class="tooltips" data-placement="top" data-original-title="View <?php echo $p->first_name ?>'s Profile" href="<?php echo site_url('admin/members/profile/' . $p->id); ?>         "><?php echo $p->first_name . ' ' . $p->last_name; ?></a></td>
                                                            <td class="hidden-xs">
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
                                                            </td>
                                                            <td><?php echo $p->phone1; ?></td>
                                                            <td class="hidden-xs">
                                                                <a href="<?php echo site_url('admin/members/profile/' . $p->id); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title="View <?php echo $p->first_name ?>'s Profile"><i class="icon-share"></i></a>
                                                                <a href="<?php echo site_url('admin/members/edit/' . $p->id); ?>" class="btn btn-xs btn-info tooltips" data-placement="top" data-original-title="Edit Details"><i class="icon-edit"></i></a>

                                                            </td>
                                                        </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php
                                }
                                else
                                {
                                        ?>
                                        <h4>No Member Registered at the moment</h4>
                                <?php } ?>
                            </div>

                        </div>
                        <!-- end: BORDERED TABLE PANEL -->
                    </div>

                </div>
                            <!-- ./dashbaord panels -->

                            
                           



                        </div>
                    </div>
                    <!-- /detached content -->


                    <!-- Detached sidebar -->
                    <div class="sidebar-detached">
                        <div class="sidebar sidebar-default">
                            <div class="sidebar-content">
                               <!-- start: PAGE HEADER -->
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                        if ($this->acl->is_allowed(array('offerings')))
                        {
                                ?>
                                <!-- start: STYLE SELECTOR BOX -->
                                <div class="panel panel-primary">
                                  <div class="panel-heading">
                                           <span> Contribution For
                                            <?php echo date('M Y', time()); ?></span>
                                    </div>
                                    <div class="panel-body" style="display:block">
 
  <ul class="media-list"> 
    
    <li class="media border-bottom-lg border-bottom">
     <a class="text-slate" href="<?php echo site_url('admin/offerings') ?>">
        <div class="media-left">
            Total Offerings             
        </div>
        <div class="media-body text-right">
            <span class="text-bold ">KES <?php echo number_format($total_offering->total) ?></span> 
            <br>
            <span class="text-muted">
            <?php foreach ($offerings as $p)
                {  echo $p->amount . ',';} ?>
            </span>         
        </div>
          </a>
    </li>

    <li class="media border-bottom-lg border-bottom">
     <a class="text-slate" href="<?php echo site_url('admin/tithes') ?>">
        <div class="media-left">
             Total Tithes            
        </div>
        <div class="media-body text-right">
            <span class="text-bold ">KES <?php echo number_format($total_tithes->total) ?></span> 
            <br>
            <span class="text-muted">
            <?php foreach ($tithes as $p)
                {  echo $p->totals . ',';} ?>
            </span>         
        </div>
          </a>
    </li>
   
    
    <li class="media border-bottom-lg border-bottom">
     <a class="text-slate" href="<?php echo site_url('admin/thanks_giving') ?>">
        <div class="media-left">
            Total Thanks Giving            
        </div>
        <div class="media-body text-right">
            <span class="text-bold ">KES <?php echo number_format($total_thanks->total) ?></span> 
            <br>
            <span class="text-muted">
            <?php foreach ($thanks as $p)
                {  echo $p->totals . ',';} ?>
            </span>         
        </div>
          </a>
    </li>
    

    <li class="media border-bottom-lg border-bottom">
     <a class="text-slate" href="<?php echo site_url('admin/ministry_support') ?>">
        <div class="media-left">
             Total Ministry Support            
        </div>
        <div class="media-body text-right">
            <span class="text-bold ">KES <?php echo number_format($total_support->total) ?></span> 
            <br>
            <span class="text-muted">
            <?php foreach ($support as $p)
                {  echo $p->amount . ',';} ?>
            </span>         
        </div>
          </a>
    </li>
    <li class="media border-bottom-lg border-bottom">
     <a class="text-slate" href="<?php echo site_url('admin/seed_planting') ?>">
        <div class="media-left">
             Total Seed Planting            
        </div>
        <div class="media-body text-right">
            <span class="text-bold ">KES <?php echo number_format($total_seeds->total) ?></span> 
            <br>
            <span class="text-muted">
            <?php foreach ($seeds as $p)
                {  echo $p->amount . ',';} ?>
            </span>         
        </div>
          </a>
    </li>
   
    <li class="media border-bottom-lg border-bottom">
     <a class="text-slate" href="<?php echo site_url('admin/other_contributions') ?>">
        <div class="media-left">
             Other Contributions             
        </div>
        <div class="media-body text-right">
            <span class="text-bold ">KES <?php echo number_format($total_others->total) ?></span> 
            <br>
            <span class="text-muted">
            <?php foreach ($others as $p)
                {  echo $p->amount . ',';} ?>
            </span>         
        </div>
          </a>
    </li>

    
    
   

  </ul>

</div>
<div class="panel-footer panel-footer-condensed">
 <div class="heading-elements">
     <span class="heading-text">Subtotal </span>

                <span class="heading-text pull-right text-bold ">
                    KES
                    <?php
                    $totals = ($total_offering->total + $total_tithes->total + $total_thanks->total + $total_support->total + $total_seeds->total + $total_others->total);
                    echo number_format($totals, 2);
                    ?>
 </div>
    
</div>
                                </div>
                                <!-- end: STYLE SELECTOR BOX -->
                        <?php } ?>
                        
                       
                    </div>
                </div>
                <!-- end: PAGE HEADER -->

                            </div>
                        </div>
                    </div>
                    <!-- /detached sidebar -->


                    <!-- Footer -->
                    <div class="footer text-muted">
                        &copy; <?php date('Y');?>. Glosoft Group<a href="#"></a>
                    </div>
                    <!-- /footer -->

                </div>
                <!-- /content area -->
                
                
                <!-- Content area -->
                <div class="content">
         <!-- modal -->
         <!-- start: PANEL CONFIGURATION MODAL FORM -->
            <div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title">Panel Configuration</h4>
                        </div>
                        <div class="modal-body">
                            Here will be a configuration form
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- end: SPANEL CONFIGURATION MODAL FORM -->
          <div class="row">
           <!-- start: PAGE -->
        <div class="main-content">
            <!-- start: PANEL CONFIGURATION MODAL FORM -->
            <div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title">Panel Configuration</h4>
                        </div>
                        <div class="modal-body">
                            Here will be a configuration form
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- end: SPANEL CONFIGURATION MODAL FORM -->
            <div class="container">
                
                <!-- start: PAGE CONTENT -->
                
               
                <!-- END LISTING -->
                <?php
                if ($this->acl->is_allowed(array('offerings')))
                {
                        ?>
                       <!--END TABLES-->
                <?php } ?>
               

                <!-- end: PAGE CONTENT-->
            </div>
        </div>
        <!-- end: PAGE -->
          </div>

                </div>
                <!-- /content area -->
        <!-- Footer -->
        <div class="footer text-muted">
          &copy; <?=date('Y');?>. <a href="#"></a>
        </div>
        <!-- /footer -->
         <div id="event-management" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">Event Management</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-light-grey">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger remove-event no-display">
                        <i class='icon-trash'></i> Delete Event
                    </button>
                    <button type='submit' class='btn btn-success save-event'>
                        <i class='icon-ok'></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>

            </div>
            <!-- /main content -->
       </div>
     <!-- /page content -->
    </div>
    <!-- /page container -->
    <!-- scripts -->

    <?php echo core_js('core/js/plugins/ui/moment/moment.min.js'); ?>
    <?php echo core_js('core/js/plugins/ui/fullcalendar/fullcalendar.min.js'); ?>
    <?php echo core_js('core/js/plugins/visualization/echarts/echarts.js'); ?>
    <?php echo core_js('core/js/plugins/forms/selects/bootstrap_multiselect.js'); ?>
    
    <script>
     // Default initialization
     $('.select').select2({
         minimumResultsForSearch: Infinity
     });
     $('.multiselect').multiselect({
        onChange: function() {
            $.uniform.update();
        }
    });
    $(".datepicker").datepicker({
      format: "dd MM yyyy",
     
    });
    </script>

   <!-- wysihtml5 wysihtml5-min  -->
   <?=core_js("core/js/plugins/printThis/printThis.js");?>
   <?=core_js("core/js/plugins/printThis/printer.js");?>
   <script src="<?php echo plugin_path('perfect-scrollbar/src/jquery.mousewheel.js'); ?>"></script>
   <script src="<?php echo plugin_path('perfect-scrollbar/src/perfect-scrollbar.js'); ?>"></script>
   
    <!-- limit calender -->
   <?php echo core_js('core/js/plugins/ui/moment/moment.min.js'); ?>   
   <?php echo core_js('core/js/plugins/visualization/echarts/echarts.js'); ?>
   <?=core_js('core/js/plugins/forms/styling/uniform.min.js');?>
   

    <!-- theme js -->
    <script src=" <?php echo plugin_path('iCheck/jquery.icheck.min.js'); ?>"></script>
    <script src="<?php echo plugin_path('perfect-scrollbar/src/jquery.mousewheel.js'); ?>"></script>
    <script src="<?php echo plugin_path('perfect-scrollbar/src/perfect-scrollbar.js'); ?>"></script>

    <?php echo theme_js('main.js'); ?> 

    <!-- end: MAIN JAVASCRIPTS -->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    
    
    <script src="<?php echo plugin_path('jquery-easy-pie-chart/jquery.easy-pie-chart.js'); ?>"></script>
    <script src="<?php echo plugin_path('jquery-ui-touch-punch/jquery.ui.touch-punch.min.js'); ?>"></script>
    <!-- <script src="<?php echo plugin_path('fullcalendar/fullcalendar/fullcalendar.js'); ?>"></script> -->
    <?php echo theme_js('index.js'); ?> 

    <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->

    <?php
    $event_data = array();
    foreach ($events as $event)
    {
            $start_date = $event->start_date;
            $end_date = $event->end_date;
            $current = date('Y-m-d', time());

            if ($end_date < time())
            {
                    $event_data[] = array(
                        'title' => $event->title . ' at ' . $event->venue . ' ( From :' . date('d M Y', $event->start_date) . ' -- To ' . date('d  M Y', $event->end_date) . ' ) ',
                        'start' => date('d M Y H:i', $event->start_date),
                        'end' => date('d M Y H:i', $event->end_date),
                        'venue' => $event->venue,
                        'event_title' => $event->title,
                        'cache' => true,
                        'className' => 'label-teal',
                        'description' => strip_tags($event->description),
                    );
            }
            else
            {
                    $event_data[] = array(
                        'title' => $event->title . ' at ' . $event->venue . ' ( From :' . date('d M Y', $event->start_date) . ' -- To ' . date('d M Y', $event->end_date) . ' ) ',
                        'start' => date('d M Y H:i', $event->start_date),
                        'end' => date('d M Y H:i', $event->end_date),
                        'venue' => $event->venue,
                        'event_title' => $event->title,
                        'cache' => true,
                        'className' => 'label-default',
                        'description' => strip_tags($event->description),
                    );
            }
    }

    $meeting_data = array();
    foreach ($meetings as $event)
    {

            $start_date = $event->start_date;
            $end_date = $event->end_date;
            $current = date('Y-m-d', time());

            if ($end_date < time())
            {
                    $meeting_data[] = array(
                        'title' => $event->title . ' at ' . $event->venue . ' ( From :' . date('d M Y', $event->start_date) . ' -- To ' . date('d  M Y', $event->end_date) . ' ) ',
                        'start' => date('d M Y H:i', $event->start_date),
                        'end' => date('d M Y H:i', $event->end_date),
                        'venue' => $event->venue,
                        'event_title' => $event->title,
                        'cache' => true,
                        'className' => 'label-teal',
                        'description' => strip_tags($event->description),
                    );
            }
            else
            {
                    $meeting_data[] = array(
                        'title' => $event->title . ' at ' . $event->venue . ' ( From :' . date('d M Y', $event->start_date) . ' -- To ' . date('d M Y', $event->end_date) . ' ) ',
                        'start' => date('d M Y H:i', $event->start_date),
                        'end' => date('d M Y H:i', $event->end_date),
                        'venue' => $event->venue,
                        'event_title' => $event->title,
                        'cache' => true,
                        'className' => 'label-green',
                        'description' => strip_tags($event->description),
                    );
            }
    }

    $full_cal = array_merge($meeting_data, $event_data);
    ?>

    <script>
            jQuery(document).ready(function () {
                Main.init();
                Index.init();
<?php
if ($this->acl->is_allowed(array('offerings')))
{
        ?>
                        // function to initiate Chart 1
                        var runChart1 = function () {
                            function randValue() {
                                return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
                            }
                            var tithes = [<?php
        $i = 0;
        $chrts = array();
        foreach ($tithes_chart as $tc)
        {
                $i++;
                ?>

                                        [<?php echo $i ?>, <?php echo (int) $tc->totals; ?>],
        <?php } ?>
                            ];
                            var offerings = [
        <?php
        $i = 0;
        $chrts = array();
        foreach ($offerings_chart as $tc)
        {
                $i++;
                ?>

                                        [<?php echo $i ?>, <?php echo (int) $tc->amount; ?>],
        <?php } ?>

                            ];
                            var thanks = [
        <?php
        $i = 0;
        $chrts = array();
        foreach ($thanks_chart as $tc)
        {
                $i++;
                ?>

                                        [<?php echo $i ?>, <?php echo (int) $tc->totals; ?>],
        <?php } ?>

                            ];
                            var support = [
        <?php
        $i = 0;
        $chrts = array();
        foreach ($support_chart as $tc)
        {

                $i++;
                ?>

                                        [<?php echo $i ?>, <?php echo (int) $tc->totals; ?>],
        <?php } ?>

                            ];
                            var seeds = [
        <?php
        $i = 0;
        $chrts = array();
        foreach ($seeds_chart as $tc)
        {
                $i++;
                ?>

                                        [<?php echo $i ?>, <?php echo (int) $tc->totals; ?>],
        <?php } ?>

                            ];
                            var others = [
        <?php
        $i = 0;
        $chrts = array();
        foreach ($others_chart as $tc)
        {

                $i++;
                ?>

                                        [<?php echo $i ?>, <?php echo (int) $tc->totals; ?>],
        <?php } ?>

                            ];
                            var plot = $.plot($("#placeholder-h1"), [
                                {
                                    data: tithes,
                                    label: "Tithes "
                                },
                                {
                                    data: offerings,
                                    label: "Offerings"
                                },
                                {
                                    data: thanks,
                                    label: "Thanks Giving"
                                },
                                {
                                    data: support,
                                    label: "Ministry Support"
                                },
                                {
                                    data: seeds,
                                    label: "Seeds Planting"
                                },
                                {
                                    data: others,
                                    label: "Other Contributions"
                                }
                            ], {
                                series: {
                                    lines: {
                                        show: true,
                                        lineWidth: 2,
                                        fill: true,
                                        fillColor: {
                                            colors: [{
                                                    opacity: 0.05
                                                }, {
                                                    opacity: 0.01
                                                }]
                                        }
                                    },
                                    points: {
                                        show: false
                                    },
                                    shadowSize: 2
                                },
                                grid: {
                                    hoverable: true,
                                    clickable: true,
                                    tickColor: "#eee",
                                    borderWidth: 0
                                },
                                colors: ["#d12610", "#37b7f3", "#52e136", "#000", "#f0ad4e", "#ffff00"],
                                xaxis: {
                                    ticks: 11,
                                    tickDecimals: 0
                                },
                                yaxis: {
                                    ticks: 11,
                                    tickDecimals: 0
                                }
                            });

                            function number_to_currency(num) {
                                return parseFloat(num).toFixed(2);
                            }

                            function showTooltip(x, y, contents) {
                                $('<div id="tooltip">' + contents + '</div>').css({
                                    position: 'absolute',
                                    display: 'none',
                                    top: y + 5,
                                    left: x + 15,
                                    border: '1px solid #333',
                                    padding: '4px',
                                    color: '#fff',
                                    'border-radius': '3px',
                                    'background-color': '#333',
                                    opacity: 0.80
                                }).appendTo("body").fadeIn(200);
                            }
                            var previousPoint = null;
                            $("#placeholder-h1").bind("plothover", function (event, pos, item) {
                                $("#x").text(pos.x.toFixed(2));
                                $("#y").text(pos.y.toFixed(2));
                                if (item) {
                                    if (previousPoint != item.dataIndex) {
                                        previousPoint = item.dataIndex;
                                        $("#tooltip").remove();
                                        var x = item.datapoint[0],
                                                y = item.datapoint[1].toFixed(2);
                                        showTooltip(item.pageX, item.pageY, item.series.label + " " + x + " Update was KES " + y);
                                    }
                                } else {
                                    $("#tooltip").remove();
                                    previousPoint = null;
                                }
                            });
                        };
                        runChart1();

<?php } ?>

//*********************** CALENDAR *******************  
// function to initiate Full Calendar
                var runFullCalendar = function () {
//calendar
                    /* initialize the calendar
                     -----------------------------------------------------------------*/
                    var $modal = $('#event-management');
                    $('#event-categories div.event-category').each(function () {
// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
// it doesn't need to have a start or end
                        var eventObject = {
                            title: $.trim($(this).text()) // use the element's text as the event title
                        };
// store the Event Object in the DOM element so we can get to it later
                        $(this).data('eventObject', eventObject);
// make the event draggable using jQuery UI
                        $(this).draggable({
                            zIndex: 999,
                            revert: true, // will cause the event to go back to its
                            revertDuration: 50 //  original position after the drag
                        });
                    });
                    /* initialize the calendar
                     -----------------------------------------------------------------*/
                    var date = new Date();
                    var d = date.getDate();
                    var m = date.getMonth();
                    var y = date.getFullYear();
                    var form = '';
                    var calendar = $('#calendar').fullCalendar({
                        
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,agendaWeek,agendaDay'
                        },
                        events:<?php echo json_encode($full_cal); ?>,
                        editable: true,
                        droppable: true, // this allows things to be dropped onto the calendar !!!
                        drop: function (date, allDay) { // this function is called when something is dropped
                            // retrieve the dropped element's stored Event Object
                            var originalEventObject = $(this).data('eventObject');
                            var $categoryClass = $(this).attr('data-class');
                            // we need to copy it, so that multiple events don't have a reference to the same object
                            var copiedEventObject = $.extend({}, originalEventObject);
                            // assign it the date that was reported
                            copiedEventObject.start = date;
                            copiedEventObject.allDay = allDay;
                            if ($categoryClass)
                                copiedEventObject['className'] = [$categoryClass];
                            // render the event on the calendar
                            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                            // is the "remove after drop" checkbox checked?
                            if ($('#drop-remove').is(':checked')) {
                                // if so, remove the element from the "Draggable Events" list
                                $(this).remove();
                            }
                        },
                        selectable: true,
                        selectHelper: true,
                        select: function (start, end, allDay) {
                            $modal.modal({
                                backdrop: 'static'
                            });
                            form = $("<form></form>");
                            form.append("<div class='row'></div>");
                            form.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>New Event Name</label><input class='form-control' placeholder='Insert Event Name' type=text name='title'/></div></div>").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>").find("select[name='category']").append("<option value='label-default'>Work</option>").append("<option value='label-green'>Home</option>").append("<option value='label-purple'>Holidays</option>").append("<option value='label-orange'>Party</option>").append("<option value='label-yellow'>Birthday</option>").append("<option value='label-teal'>Generic</option>").append("<option value='label-beige'>To Do</option>");
                            $modal.find('.remove-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                                form.submit();
                            });
                            $modal.find('form').on('submit', function () {
                                title = form.find("input[name='title']").val();
                                $categoryClass = form.find("select[name='category'] option:checked").val();
                                if (title !== null) {
                                    calendar.fullCalendar('renderEvent', {
                                        title: title,
                                        start: start,
                                        end: end,
                                        allDay: allDay,
                                        className: $categoryClass
                                    }, true // make the event "stick"
                                            );
                                }
                                $modal.modal('hide');
                                return false;
                            });
                            calendar.fullCalendar('unselect');
                        },
                        eventClick: function (calEvent, jsEvent, view) {
                            var form = $("<form></form>");
                            form.append("<label>Change event name</label>");
                            form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success'><i class='icon-ok'></i> Save</button></span></div>");
                            $modal.modal({
                                backdrop: 'static'
                            });
                            $modal.find('.remove-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.remove-event').unbind('click').click(function () {
                                calendar.fullCalendar('removeEvents', function (ev) {
                                    return (ev._id == calEvent._id);
                                });
                                $modal.modal('hide');
                            });
                            $modal.find('form').on('submit', function () {
                                calEvent.title = form.find("input[type=text]").val();
                                calendar.fullCalendar('updateEvent', calEvent);
                                $modal.modal('hide');
                                return false;
                            });
                        }
                    });
                };
                runFullCalendar();

            });
    </script> 


    </body>
</html>
