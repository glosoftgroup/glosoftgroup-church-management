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
        <?php echo theme_css('church.css'); ?>
        <link rel="stylesheet" href="<?php echo plugin_path('bootstrap-modal/css/bootstrap-modal-bs3patch.css'); ?>" >
<link rel="stylesheet" href="<?php echo plugin_path('bootstrap-modal/css/bootstrap-modal.css'); ?>" >

<link rel="stylesheet" href="<?php echo plugin_path('bootstrap-fileupload/bootstrap-fileupload.min.css'); ?>" >
         <link rel="stylesheet" href="<?php echo plugin_path('iCheck/skins/all.css'); ?>" >
          <?php echo theme_css('jquery.dataTables.css'); ?>
        <?php echo theme_css('tableTools.css'); ?>
        <?php echo theme_css('dataTables.colVis.min.css'); ?>
        <?= theme_css('custom.css'); ?>
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
        
        <!-- ./theme scripts -->

        <!-- old files -->

       <!-- echo theme_css('sett.css'); ?> -->
        <?php echo theme_css('jquery.dataTables.css'); ?>
        <?php echo theme_css('tableTools.css'); ?>
        <?php echo theme_css('dataTables.colVis.min.css'); ?>


          <!-- echo theme_css('select2/select2.css'); -->
        <link href="<?php echo js_path('plugins/jeditable/bootstrap-editable.css'); ?>" rel="stylesheet">

       
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
    <!-- scripts -->
    <?=base_url('plugins/forms/styling/uniform.min.js');?>
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
    $(".date-picker").datepicker({
      format: "dd MM yyyy",
     
    });
    </script>

    
    
    <style>
    .uppercase {
    font-family: sans-serif;
    line-height: 250%;
    word-spacing: 3px;
    font-size: 1.3em;
}

</style>

<script src=" <?php echo plugin_path('blockUI/jquery.blockUI.js'); ?>"></script>
    <script src=" <?php echo plugin_path('iCheck/jquery.icheck.min.js'); ?>"></script>
    <script src="<?php echo plugin_path('perfect-scrollbar/src/jquery.mousewheel.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.css">
    <script src="<?php echo plugin_path('perfect-scrollbar/src/perfect-scrollbar.js'); ?>"></script>
   
    <?php echo theme_js('main.js'); ?> 
    <script src="<?php echo plugin_path('jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js'); ?>"></script>
    <script src="<?php echo plugin_path('autosize/jquery.autosize.min.js'); ?>"></script>
    <script src="<?php echo plugin_path('select2/select2.min.js'); ?>"></script>
    <script src="<?php echo plugin_path('jquery.maskedinput/src/jquery.maskedinput.js'); ?>"></script>
    <script src="<?php echo plugin_path('bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
    <script src="<?php echo plugin_path('bootstrap-timepicker/js/bootstrap-timepicker.min.js'); ?>"></script>
    <script src="<?php echo plugin_path('bootstrap-daterangepicker/moment.min.js'); ?>"></script>
    <script src="<?php echo plugin_path('bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>

    <script src="<?php echo plugin_path('jQuery-Tags-Input/jquery.tagsinput.js'); ?>"></script>
    <script src="<?php echo plugin_path('bootstrap-fileupload/bootstrap-fileupload.min.js'); ?>"></script>
    <script src="<?php echo plugin_path('summernote/build/summernote.min.js'); ?>"></script>
    <script src="<?php echo plugin_path('ckeditor/ckeditor.js'); ?>"></script>
    <script src="<?php echo plugin_path('ckeditor/adapters/jquery.js'); ?>"></script>
    <script src="<?php echo plugin_path('jeditable/bootstrap-editable.min.js'); ?>"></script>
    <?php echo theme_js('form-elements.js'); ?> 

    <!-- Form and Form Wizard JS -->
    <script src="<?php echo plugin_path('jquery-validation/dist/jquery.validate.min.js'); ?>"></script>  
    <script src="<?php echo plugin_path('jQuery-Smart-Wizard/js/jquery.smartWizard.js'); ?>"></script>  
    <?php echo theme_js('form-wizard.js'); ?> 
    
    <?php echo theme_js('table-data.js'); ?> 

    <!--  MODAL JS  -->
    <script src="<?php echo plugin_path('bootstrap-modal/js/bootstrap-modal.js'); ?>"></script>  
    <script src="<?php echo plugin_path('bootstrap-modal/js/bootstrap-modalmanager.js'); ?>"></script>  
    <?php echo theme_js('ui-modals.js'); ?>
    
    <!-- table export -->
    <script src="<?php echo plugin_path('tableExport/tableExport.js'); ?>"></script>  
    <script src="<?php echo plugin_path('tableExport/jquery.base64.js'); ?>"></script>  
    <script src="<?php echo plugin_path('tableExport/html2canvas.js'); ?>"></script>  
    <script src="<?php echo plugin_path('tableExport/jquery.base64.js'); ?>"></script>  
    <script src="<?php echo plugin_path('tableExport/jspdf/libs/sprintf.js'); ?>"></script>  
    <script src="<?php echo plugin_path('tableExport/jspdf/jspdf.js'); ?>"></script>  
    <script src="<?php echo plugin_path('tableExport/jspdf/libs/base64.js'); ?>"></script>  
    <?php echo theme_js('table-export.js'); ?> 
    <!-- end table export -->
    <script src="<?php echo plugin_path('DataTables/media/js/jquery.dataTables.min.js'); ?>"></script>  
    <script src="<?php echo plugin_path('DataTables/media/js/DT_bootstrap.js'); ?>"></script>  
    <?php echo theme_js('table-data.js'); ?> 

    <script>
            jQuery(document).ready(function () {
                Main.init();
                FormElements.init();
                FormWizard.init();
                TableData.init();
                UIModals.init();
                TableExport.init();
            });
    </script>
    </body>
</html>
