<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <!--[if gt IE 8]>
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <![endif]-->
        <title>ksdas<?php echo $template['title']; ?></title>

        <!-- start: MAIN CSS -->

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
   
    <body class="navbar-top " >
        <?php echo $template['partials']['top']; ?>
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
        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">
           <?php echo $template['partials'][$this->side]; ?>
         <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header page-header-default">
               
                <!-- breadcrumb -->
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li>
                                <i class="clip-home-3"></i>
                                <?php echo anchor('admin', 'Home'); ?>

                            </li>
                            <?php
                            if ($this->uri->segment(2))
                            {
                                    ?>
                                    <li>
                                        <?php echo anchor('admin/' . $this->uri->segment(2), humanize($this->uri->segment(2))); ?>
                                    </li>
                            <?php } ?>
                            <li class="active">  <?php echo anchor(current_url(), $template['title']); ?> </li>
                            <li class="search-box">
                                <form class="sidebar-search">
                                    <div class="form-group">
                                        <input type="text" placeholder="Start Searching...">
                                        <button class="submit">
                                            <i class="clip-search-3"></i>
                                        </button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- end breadcrumbs -->
                  
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">
         
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
                                        <i class="icon-thumbs-up"></i> <?php echo $str; //$this->session->flashdata('message');       ?>
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

                            <?php echo $template['body']; ?>
                        </div>

                </div>
                <!-- /content area -->
        <!-- Footer -->
        <div class="footer text-muted">
          &copy; <?=date('Y');?>. <a href="#">Glosoft Group</a>
        </div>
        <!-- /footer -->

            </div>
            <!-- /main content -->
       </div>
     <!-- /page content -->
    </div>
    <!-- /page container -->
    <!-- scripts -->

   <script>  var BASE_PATH = '<?php echo base_url(); ?>';</script>
    <script src="<?php echo plugin_path('jquery-ui/jquery-ui-1.10.2.custom.min.js'); ?>"></script>
    <script src="<?php echo plugin_path('bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src=" <?php echo plugin_path('blockUI/jquery.blockUI.js'); ?>"></script>
    <script src=" <?php echo plugin_path('iCheck/jquery.icheck.min.js'); ?>"></script>
    <script src="<?php echo plugin_path('perfect-scrollbar/src/jquery.mousewheel.js'); ?>"></script>
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

    <!--------Form and Form Wizard JS--------->
    <script src="<?php echo plugin_path('jquery-validation/dist/jquery.validate.min.js'); ?>"></script>  
    <script src="<?php echo plugin_path('jQuery-Smart-Wizard/js/jquery.smartWizard.js'); ?>"></script>  
    <?php echo theme_js('form-wizard.js'); ?> 
    <!--------Data tables JS--------->
    <script src="<?php echo plugin_path('DataTables/media/js/jquery.dataTables.min.js'); ?>"></script>  
    <script src="<?php echo plugin_path('DataTables/media/js/DT_bootstrap.js'); ?>"></script>  
    <?php echo theme_js('table-data.js'); ?> 

    <!------MODAL JS----------->
    <script src="<?php echo plugin_path('bootstrap-modal/js/bootstrap-modal.js'); ?>"></script>  
    <script src="<?php echo plugin_path('bootstrap-modal/js/bootstrap-modalmanager.js'); ?>"></script>  
    <?php echo theme_js('ui-modals.js'); ?> 

    <!----TABLE Export JS-------------->
    <script src="<?php echo plugin_path('tableExport/tableExport.js'); ?>"></script>  
    <script src="<?php echo plugin_path('tableExport/jquery.base64.js'); ?>"></script>  
    <script src="<?php echo plugin_path('tableExport/html2canvas.js'); ?>"></script>  
    <script src="<?php echo plugin_path('tableExport/jquery.base64.js'); ?>"></script>  
    <script src="<?php echo plugin_path('tableExport/jspdf/libs/sprintf.js'); ?>"></script>  
    <script src="<?php echo plugin_path('tableExport/jspdf/jspdf.js'); ?>"></script>  
    <script src="<?php echo plugin_path('tableExport/jspdf/libs/base64.js'); ?>"></script>  
    <?php echo theme_js('table-export.js'); ?> 
    <!------CHARTS ---------------->
    <script src="<?php echo plugin_path('flot/jquery.flot.js'); ?>"></script>  
    <script src="<?php echo plugin_path('flot/jquery.flot.resize.js'); ?>"></script>  
    <script src="<?php echo plugin_path('flot/jquery.flot.categories.js'); ?>"></script>  
    <script src="<?php echo plugin_path('flot/jquery.flot.pie.js'); ?>"></script> 

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
