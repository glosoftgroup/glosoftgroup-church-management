 <!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		 <title><?php echo $template['title']; ?></title>
         <?php echo $template['partials']['top']; ?>	
		 
		<!-- end: HEADER -->
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">
			<div class="navbar-content">
				<!-- start: SIDEBAR -->
				 <?php echo $template['partials']['sidebar']; ?>
				<!-- end: SIDEBAR -->
			</div>
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
				<div class="container" >
					<!-- start: PAGE HEADER -->
					<div class="row top-panel-header">
						<div class="col-sm-12">
							<!-- start: STYLE SELECTOR BOX -->
							
							<!-- end: STYLE SELECTOR BOX -->
							<!-- start: PAGE TITLE & BREADCRUMB -->
							  <ol class="breadcrumb ">
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
                              </ol> <!--.breadcrumb--> 
							
							
							<div class="page-header">
								<h1> <?php echo anchor('admin/' . $this->uri->segment(2), humanize($this->uri->segment(2))); ?>
								<small><?php echo $template['title']; ?></small>
								</h1>
							</div>
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
					<div class="row">
						<div class="col-sm-12">
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
                    <i class="icon-thumbs-up"></i> <?php echo $str; //$this->session->flashdata('message'); ?>
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
					</div>
					<!----END LISTING----->
					
						
					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->
		<!-- start: FOOTER -->
<!-- end: MAIN CONTAINER -->
		<!-- start: FOOTER -->
		<div class="footer clearfix">
			<div class="footer-inner">
				<?php echo date('Y')?> &copy; M-Shamba Limited.
			</div>
			<div class="footer-items">
				<span class="go-top"><i class="clip-chevron-up"></i></span>
			</div>
		</div> 
		<!-- end: FOOTER -->
	
	

		
		
		 <script src="<?php echo plugin_path('jquery-ui/jquery-ui-1.10.2.custom.min.js'); ?>"></script>
		<script src="<?php echo plugin_path('bootstrap/js/bootstrap.min.js'); ?>"></script>
		<script src=" <?php echo plugin_path('blockUI/jquery.blockUI.js'); ?>"></script>
		<script src=" <?php echo plugin_path('iCheck/jquery.icheck.min.js'); ?>"></script>
		 <script src="<?php echo plugin_path('perfect-scrollbar/src/jquery.mousewheel.js'); ?>"></script>
		 <script src="<?php echo plugin_path('perfect-scrollbar/src/perfect-scrollbar.js'); ?>"></script>
		
		 <?php echo theme_js('main.js'); ?> 
		
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		
		<script src="<?php echo plugin_path('jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js'); ?>"></script>
		<script src="<?php echo plugin_path('autosize/jquery.autosize.min.js'); ?>"></script>
		<script src="<?php echo plugin_path('select2/select2.min.js'); ?>"></script>
		<script src="<?php echo plugin_path('jquery.maskedinput/src/jquery.maskedinput.js'); ?>"></script>
		<script src="<?php echo plugin_path('bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
		<script src="<?php echo plugin_path('bootstrap-timepicker/js/bootstrap-timepicker.min.js'); ?>"></script>
		<script src="<?php echo plugin_path('bootstrap-daterangepicker/moment.min.js'); ?>"></script>
		<script src="<?php echo plugin_path('bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
		<script src="<?php echo plugin_path('bootstrap-colorpicker/js/bootstrap-colorpicker.js'); ?>"></script>
		<script src="<?php echo plugin_path('bootstrap-colorpicker/js/commits.js'); ?>"></script>
		<script src="<?php echo plugin_path('jQuery-Tags-Input/jquery.tagsinput.js'); ?>"></script>
		<script src="<?php echo plugin_path('bootstrap-fileupload/bootstrap-fileupload.min.js'); ?>"></script>
		<script src="<?php echo plugin_path('summernote/build/summernote.min.js'); ?>"></script>
        <script src="<?php echo plugin_path('ckeditor/ckeditor.js'); ?>"></script>
		<script src="<?php echo plugin_path('ckeditor/adapters/jquery.js'); ?>"></script>
		
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
		 <?php //echo theme_js('charts-custom.js'); ?>
		
		<script>
		
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
				FormWizard.init();
			TableData.init();
			UIModals.init();
			TableExport.init();
			
			});
		</script>


	</body>
	<!-- end: BODY -->
</html>