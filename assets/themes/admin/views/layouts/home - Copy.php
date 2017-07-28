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
        
        <link rel="stylesheet" href="<?php echo plugin_path('font-awesome/css/font-awesome.min.css'); ?>" >
        <?php echo core_css('core/css/icons/icomoon/styles.css'); ?>
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
    <?=core_js("core/js/plugins/editors/wysihtml5/wysihtml5.min.js");?>
    <?=core_js("core/js/plugins/editors/wysihtml5/toolbar.js");?>
    <?=core_js("core/js/plugins/editors/wysihtml5/parsers.js");?>

    <?=core_js("core/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js");?>
   <?=core_js("core/js/pages/editor_wysihtml5.js");?> 
   <!-- wysihtml5 wysihtml5-min  -->
   <?=core_js("core/js/plugins/printThis/printThis.js");?>
   <?=core_js("core/js/plugins/printThis/printer.js");?>
    
    
    <style>
    .uppercase {
    font-family: sans-serif;
    line-height: 250%;
    word-spacing: 3px;
    font-size: 1.3em;
}

</style>

<!-- theme js -->
    <script src=" <?php echo plugin_path('iCheck/jquery.icheck.min.js'); ?>"></script>
    <script src="<?php echo plugin_path('perfect-scrollbar/src/jquery.mousewheel.js'); ?>"></script>
    <script src="<?php echo plugin_path('perfect-scrollbar/src/perfect-scrollbar.js'); ?>"></script>

    <?php echo theme_js('main.js'); ?> 

    <!-- end: MAIN JAVASCRIPTS -->
    <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
    <script src="<?php echo plugin_path('flot/jquery.flot.js'); ?>"></script>
    <script src="<?php echo plugin_path('flot/jquery.flot.pie.js'); ?>"></script>
    <script src="<?php echo plugin_path('flot/jquery.flot.resize.min.js'); ?>"></script>
    <script src="<?php echo plugin_path('jquery.sparkline/jquery.sparkline.js'); ?>"></script>
    <script src="<?php echo plugin_path('jquery-easy-pie-chart/jquery.easy-pie-chart.js'); ?>"></script>
    <script src="<?php echo plugin_path('jquery-ui-touch-punch/jquery.ui.touch-punch.min.js'); ?>"></script>
    <script src="<?php echo plugin_path('fullcalendar/fullcalendar/fullcalendar.js'); ?>"></script>
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
</html>
