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
        <?=core_js('core/js/plugins/forms/wizards/stepy.min.js');?>
        <?=core_js('core/js/plugins/forms/styling/uniform.min.js');?>
        <?=core_js('core/js/core/libraries/jasny_bootstrap.min.js');?>
        <?=core_js('core/js/plugins/forms/validation/validate.min.js');?>
        <?=core_js('core/js/pages/wizard_stepy.js');?>
        <?php echo core_js('core/js/pages/layout_fixed_custom.js'); ?>
        <?php echo core_js('core/js/plugins/ui/ripple.min.js'); ?>
        <!-- /theme JS files -->
       
        <!-- ./datatables -->

        <!-- theme scripts -->
        <?php echo core_js('core/js/plugins/pickers/pickadate/picker.js'); ?>

        <?php echo core_js('core/js/plugins/pickers/pickadate/picker.date.js'); ?>

        <?php echo core_js('core/js/plugins/pickers/pickadate/picker.time.js'); ?>
        <!-- Updated stylesheet url -->
        <?=core_js("core/js/core/libraries/jquery_ui/widgets.min.js");?>
        <?=core_js("core/js/pages/animations_css3.js");?>
        
        <!-- ./theme scripts -->

        <!-- old files -->

       <!-- echo theme_css('sett.css'); ?> -->
       

       
        <!-- limit calender -->
       <?php echo core_js('core/js/plugins/ui/moment/moment.min.js'); ?>
       <?php echo core_js('core/js/plugins/ui/fullcalendar/fullcalendar.min.js'); ?>
       <?php echo core_js('core/js/plugins/visualization/echarts/echarts.js'); ?>
     
        
        <link rel="shortcut icon" type="image/ico" href="<?php echo image_path('favicon.ico'); ?>" />
    </head>
    <?php
    $ccls = 'ssRed';
    if ($this->ion_auth->is_in_group($this->user->id, 3))
    {
            $ccls = 'ssGreen';
    }
    ?>
    <body class="navbar-top " >
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
          <?php echo $template['body']; ?>
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
   


    </body>
</html>
