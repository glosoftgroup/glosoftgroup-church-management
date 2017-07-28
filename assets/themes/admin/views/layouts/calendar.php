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
			
						<!-----------------------------EDIT MODAL------------------------->
			<div class="modal fade" id="Event_m" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog7">
				<?php 
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo   form_open_multipart('admin/events/create/', $attributes); 
                ?>
				<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title">Add New Events</h4>
				<div class="clearfix"></div>
			</div>
								<p>
								<div class="clearfix"></div>
								<div id="entry1" class="clonedInput">
										<label class='col-sm-3 control-label' for='title'>Title </label>
								<div class="col-sm-8 input-group">
													<span class="input-group-addon"> <i class="icon-user"></i> </span>
									<input id='title' type='text' name='title' maxlength='' class='form-control '/>
								</div>
								<div class="clearfix"></div>
								</div>
								</p>
								<p>
								<div class="clearfix"></div>
								<div id="entry1" class="clonedInput">
										<label class=' col-sm-3 control-label' for='start_date'>Start Date
								</label>
								<div class="col-sm-8 input-group">
								<input id='start_date_' type='text' name='start_date' maxlength='' class='form-control date-picker'   />
								
								<span class="input-group-addon"> <i class="icon-calendar"></i> </span>
								</div>
								<div class="clearfix"></div>
								</div>
								</p>
								<p>
								<div class="clearfix"></div>
								<div id="entry1" class="clonedInput">
										<label class=' col-sm-3 control-label' for='end_date'>End Date
								</label>
								<div class="col-sm-8 input-group">
								<input id='end_date_' type='text' name='end_date' maxlength='' class='form-control date-picker' v />
							
								<span class="input-group-addon"> <i class="icon-calendar"></i> </span>
								</div>
								<div class="clearfix"></div>
								</div>
								</p>
								<p>
								<div class="clearfix"></div>
								<div id="entry1" class="clonedInput">
										<label class='col-sm-3 control-label' for='venue'>Venue </label>
								<div class="col-sm-8 input-group">
													<span class="input-group-addon"> <i class="icon-user"></i> </span>
									<input id='venue' type='text' name='venue' maxlength='' class='form-control'   />
										
								</div>
								<div class="clearfix"></div>
								</div>
								</p>
								<p>
								<div class="clearfix"></div>
								<div id="entry1" class="clonedInput">
										<label class=' col-sm-3 control-label' for='file'>Upload (file) </label>
										<div class="col-sm-8">
										<input id='file' type='file' name='file' />
											
										</div>
										<div class="clearfix"></div>
								</div>
								</p>
								<p>
								<div class="clearfix"></div>
								<div id="entry1" class="clonedInput">
										<label class='col-sm-3 control-label' for='status'>Event Status </label>
								<div class="col-sm-8 input-group">
									<span class="input-group-addon"> <i class="icon-user"></i> </span>
										<?php $items = array( "1"=>"Live","0"=>"Draft",);		
										echo form_dropdown('status', $items,'',' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');?> <i style="color:red"><?php echo form_error('status'); ?></i>
								</div>
								<div class="clearfix"></div>
								</div>
								</p>
								<p>
								<div class="clearfix"></div>
								<div id="entry1" class="clonedInput">
										<label class='col-sm-3 control-label' for='description'>Description</label>
								<div class="col-sm-8 input-group">
											
										  <span class="input-group-addon"> <i class="clip-clip"></i> </span>
										<textarea id="description" rows="9" class="autosize-transition ckeditor1 form-control "  name="description"  /></textarea>
								</div>
								<div class="clearfix"></div>
								</div>
								</p>
								<div class="modal-footer">
			
			
				<button type="submit" class="btn btn-primary">
					Save Changes
				</button>
				<button type="button" data-dismiss="modal" class="btn btn-default">
					Close
				</button>
				</div>
			</div><?php echo form_close(); ?>
			</div>
			
		</div>
			
			
			<!-- start: PAGE -->
			<div class="main-content">
				<!-- start: PANEL CONFIGURATION MODAL FORM -->
					
				<!-- /.modal -->
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<div class="container">
					<!-- start: PAGE HEADER -->
					<div class="row">
						<div class="col-sm-12">
							<!-- start: PAGE TITLE & BREADCRUMB -->
							<ol class="breadcrumb">
								<li>
									<i class="clip-home-3"></i>
									<a href="#">
										Home
									</a>
								</li>
								<li class="active">
									Calendar
								</li>
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
							</ol>
							<div class="page-header">
								<h1>Church Calendar  <small>Calendar of Events </small></h1>
							</div>
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>
					<!-- end: PAGE HEADER -->
					<!-- start: PAGE CONTENT -->
			
					<div class="row">
					<div class="col-sm-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="clip-calendar"></i>
									Church Calendar
									<div class="panel-tools">
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
										
									   <div class="btn-group">
									   <a class="btn btn-success tooltips" data-original-title="Add Event" data-toggle="modal" data-placement="top" href="#Event_m">
											<i class="icon-plus"></i>
										</a>
										<a class="btn btn-primary tooltips" data-original-title="List Events" data-placement="top" href="<?php echo site_url('admin/events/')?>">
											<i class="icon-list-ol"></i>
										</a>
										
										</div>
										 <div class="btn-group">
										<a class="btn btn-success tooltips" data-original-title="Add Meeting" data-placement="top" href="<?php echo site_url('admin/meetings/create')?>">
											<i class="icon-plus"></i>
										</a>
										<a class="btn btn-primary tooltips" data-original-title="List Meeting" data-placement="top" href="<?php echo site_url('admin/meetings')?>">
											<i class="icon-list-ol"></i>
										</a>
									 
									  
									  </div>
           
									</div>
								</div>
								<div class="panel-body">
									<div id='calendar'></div>
								</div>
							</div>
							
						</div>
						
					</div>
					
					<!-- end: PAGE CONTENT-->
				</div>
			</div>
			<!-- end: PAGE -->
		</div>
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
		
		
		
		
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<![endif]-->
		 <?php echo theme_js('jquery-1.11.1.min.js'); ?>
		 <script src="<?php echo plugin_path('jquery-ui/jquery-ui-1.10.2.custom.min.js'); ?>"></script>
		<script src="<?php echo plugin_path('bootstrap/js/bootstrap.min.js'); ?>"></script>
		<script src=" <?php echo plugin_path('blockUI/jquery.blockUI.js'); ?>"></script>
		<script src=" <?php echo plugin_path('iCheck/jquery.icheck.min.js'); ?>"></script>
		 <script src="<?php echo plugin_path('perfect-scrollbar/src/jquery.mousewheel.js'); ?>"></script>
		 <script src="<?php echo plugin_path('perfect-scrollbar/src/perfect-scrollbar.js'); ?>"></script>
		 
		 
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
		
		 <?php echo theme_js('main.js'); ?> 
		 <?php echo theme_js('form-elements.js'); ?> 

		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		 <script src="<?php echo plugin_path('flot/jquery.flot.js'); ?>"></script>
		 <script src="<?php echo plugin_path('jquery.flot.pie.js'); ?>"></script>
		 <script src="<?php echo plugin_path('flot/jquery.flot.resize.min.js'); ?>"></script>
		 <script src="<?php echo plugin_path('jquery.sparkline/jquery.sparkline.js'); ?>"></script>
		 <script src="<?php echo plugin_path('jquery-easy-pie-chart/jquery.easy-pie-chart.js'); ?>"></script>
		 <script src="<?php echo plugin_path('jquery-ui-touch-punch/jquery.ui.touch-punch.min.js'); ?>"></script>
		 <script src="<?php echo plugin_path('fullcalendar/fullcalendar/fullcalendar.js'); ?>"></script>
		  <?php echo theme_js('index.js'); ?> 
		
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		
		<!------MODAL JS----------->
		
		 <script src="<?php echo plugin_path('bootstrap-modal/js/bootstrap-modal.js'); ?>"></script>  
		 <script src="<?php echo plugin_path('bootstrap-modal/js/bootstrap-modalmanager.js'); ?>"></script>  
		<?php echo theme_js('ui-modals.js'); ?> 
		
		 
	    <?php 
		   $event_data = array();
			foreach($events as $event){
				
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
			foreach($meetings as $event){
				
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
			
			$full_cal= array_merge($meeting_data,$event_data);
			
			
		?>

		
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Index.init();
				FormElements.init();
				UIModals.init();
	
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
            buttonText: {
                prev: '<i class="icon-chevron-left"></i>',
                next: '<i class="icon-chevron-right"></i>'
            },
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
	<!-- end: BODY -->
</html>