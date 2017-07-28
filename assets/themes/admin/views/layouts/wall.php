<!DOCTYPE html>
<html lang="en">
     <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />

          <title><?php echo $template['title']; ?></title>
          <?php echo theme_css('fonts/linecons/css/linecons.css'); ?>
          <?php echo theme_css('fonts/fontawesome/css/font-awesome.min.css'); ?>
          <?php echo theme_css('bootstrap.css'); ?>
          <?php echo theme_css('cartd/cartd.css'); ?>

          <link rel="stylesheet" href="<?php echo js_path('jquery-ui/jquery-ui.min.css'); ?>">
          <?php echo theme_css('datatables/dataTables.bootstrap.css'); ?>
          <?php echo theme_css('validation_engine/validationEngine.jquery.css'); ?>
          <?php echo theme_css('xenon-core.css'); ?>
          <?php echo theme_css('xenon-forms.css'); ?>
          <?php echo theme_css('xenon-components.css'); ?>
          <?php //echo theme_css('xenon-skins.css'); ?>

          <?php echo theme_css('custom.css'); ?>
          <?php echo theme_css('bracket.css'); ?>
          <?php echo theme_js('jquery-1.11.1.min.js'); ?>

          <script type="text/javascript">
               $(document).ready(function()
               {
                    if (typeof (BASEPATH) === 'undefined' || BASEPATH === null)
                    {
                         BASEPATH = "<?php echo base_url(); ?>";
                    }

               });
               var BASEPATH = "<?php echo base_url(); ?>";
          </script>

          <?php echo theme_js('amct/amcharts.js'); ?>
          <?php echo theme_js('amct/pie.js'); ?>
          <?php echo theme_js('amct/serial.js'); ?>
          <?php echo theme_js('amct/exporting/amexport.js'); ?>
          <?php echo theme_js('amct/exporting/rgbcolor.js'); ?>
          <?php echo theme_js('amct/exporting/canvg.js'); ?>
          <?php echo theme_js('amct/exporting/jspdf.js'); ?>
          <?php echo theme_js('amct/exporting/filesaver.js'); ?>
          <?php echo theme_js('amct/exporting/jspdf.plugin.addimage.js'); ?>
          <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
          <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->

     </head>
     <body class="page-body">

          <div class="page-container"> 
               <?php echo $template['partials']['sidebar']; ?>
               <div class="main-content">
                    <?php echo $template['partials']['top']; ?>	

                    <div class="page-title">

                         <div class="breadcrumb-env">

                              <ol class="breadcrumb bc-1">
                                   <li>
                                        <i class="fa-home"></i>
                                        <?php echo anchor('admin', 'Home'); ?>
                                        <span class="icon-angle-right"></span>
                                   </li>
                                   <?php
                                   if ($this->uri->segment(2))
                                   {
                                        ?>
                                        <li>
                                             <?php echo anchor('admin/' . $this->uri->segment(2), humanize($this->uri->segment(2))); ?>
                                        </li>
                                   <?php } ?>
                                   <li>  <?php echo anchor(current_url(), $template['title']); ?> </li>
                              </ol> <!--.breadcrumb--> 

                         </div>

                    </div>
                    <div class="row">
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
                                   <button type="button" class="close" data-dismiss="alert">  <i class="icon-remove"></i>                             
                                   </button>
                                   <?php echo $this->session->flashdata('success'); ?>
                              </div>
                         <?php } ?>
                         <?php
                         if ($this->session->flashdata('info'))
                         {
                              ?>
                              <div class="alert alert-info">
                                   <button type="button" class="close" data-dismiss="alert">                                    
                                        <i class="icon-remove"></i>                                
                                   </button>
                                   <?php echo $this->session->flashdata('info'); ?>
                              </div>
                         <?php } ?>
                         <?php
                         if ($this->session->flashdata('message'))
                         {
                              $message = $this->session->flashdata('message');
                              $str = is_array($message) ? $message['text'] : $message;
                              $ttl = is_array($message) ? $message['type'] : 'Alert';
                              ?>
                              <script>
                                   $(document).ready(function()
                                   {
                                        notify('<?php echo $str; ?>', '<?php echo ucfirst($ttl); ?>');
                                   });

                              </script>

                         <?php } ?>
                         <?php
                         if ($this->session->flashdata('error'))
                         {
                              ?>
                              <div class="alert alert-error">
                                   <button type="button" class="close" data-dismiss="alert">                                    
                                        <i class="icon-remove"></i>      </button>
                                   <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                              </div>
                         <?php } ?>    
                    </div>


                    <div class="row   ">
                         <div class="col-sm-3">
                              <?php echo theme_image('user-5.png', array('class' => "thumbnail img-responsive")); ?>   
  
                              <ul class="profile-social-list">
                                   <li><i class="fa fa-bookmark"></i> <a href="#">Diagnosis</a></li>
                                   <li><i class="fa fa-apple"></i> <a href="#">Prescriptions</a></li>
                                   <li><i class="fa fa-flask"></i> <a href="#">Lab Tests</a></li>
                                   <li><i class="fa fa-ambulance"></i> <a href="#">Medical Procedures</a></li>
                                   <li><i class="fa fa-file"></i> <a href="#">Bill</a></li>
                                   <li><i class="fa fa-money"></i> <a href="#">Payments</a></li>
                              </ul>
                            
                              <div class="mb30"></div>
  

                         </div><!-- col-sm-3 -->
                         <div class="col-sm-9">
 
                              <?php echo $template['body']; ?>

                         </div><!-- col-sm-9 -->
                    </div>
                    <footer class="main-footer sticky footer-type-1">
                         <div class="footer-inner">
                              <div class="footer-text">
                                   &copy; <?php echo date('Y'); ?> 
                                   <strong>HMS</strong> 
                              </div>
                              <div class="go-up">
                                   <a href="#" rel="go-top">
                                        <i class="fa-angle-up"></i>
                                   </a>
                              </div>
                         </div>

                    </footer>
               </div>

               <?php echo isset($template['partials']['chat']) ? $template['partials']['chat'] : ''; ?>
          </div>

          <div class="page-loading-overlay">
               <div class="loader-2"></div>
          </div>
          <link rel="stylesheet" href="<?php echo js_path('icheck/skins/all.css'); ?>">
          <link rel="stylesheet" href="<?php echo js_path('wall/wall.css'); ?>">
          <!-- Bottom Scripts -->
          <?php echo theme_js('bootstrap.min.js'); ?>
          <?php echo theme_js('TweenMax.min.js'); ?>
          <?php echo theme_js('resizeable.js'); ?>
          <?php echo theme_js('joinable.js'); ?>
          <?php echo theme_js('jquery-ui/jquery-ui.min.js'); ?>
          <?php echo theme_js('datatables/js/jquery.dataTables.min.js'); ?>
          <?php echo theme_js('datatables/dataTables.bootstrap.js'); ?>
          <?php echo theme_js('datatables/yadcf/jquery.dataTables.yadcf.js'); ?>
          <?php echo theme_js('datatables/tabletools/dataTables.tableTools.min.js'); ?>
          <?php echo theme_js('validation_engine/languages/jquery.validationEngine-en.js'); ?>
          <?php echo theme_js('validation_engine/jquery.validationEngine.js'); ?>
          <?php echo theme_js('formwizard/jquery.bootstrap.wizard.min.js'); ?>
          <script>
               $(document).ready(function()
               {
                    // Datepicker
                    if ($.isFunction($.fn.datepicker))
                    {
                         $(".datepicker").datepicker({
                              dateFormat: "dd M yy",
                              changeYear: true,
                              changeMonth: true,
                              yearRange: '<?php echo date('Y') - 120; ?>:<?php echo date('Y'); ?>'}
                                             );
                                        }
                                        $("#rootwizard").validationEngine();
                                   });
          </script>
          <?php echo theme_js('icheck/icheck.min.js'); ?>
          <?php echo theme_js('xenon-api.js'); ?>
          <?php echo theme_js('xenon-toggles.js'); ?>
          <?php echo theme_js('xenon-widgets.js'); ?>
          <?php echo theme_js('devexpress-web-14.1/js/globalize.min.js'); ?>
          <?php echo theme_js('devexpress-web-14.1/js/dx.chartjs.js'); ?>
          <?php echo theme_js('xenon-custom.js'); ?>
          <?php echo theme_js('toastr/toastr.min.js'); ?>

          <?php echo theme_js('wall/plugins.js'); ?>
          <?php echo theme_js('wall/wall.js'); ?>
          <?php echo theme_js('wall/bracket.js'); ?>
          <?php echo theme_js('custom.js'); ?>
          <?php echo theme_js('cartd/cartd.js'); ?>

     </body>
</html>

