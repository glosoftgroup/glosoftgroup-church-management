<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Accounts Reports [ As at  <?php echo date('M d Y') ?> ] </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <button onClick="window.print();return false" class="btn btn-success" type="button"><span class="icon-print"></span> Print </button>

                    <?php echo anchor('admin/reports/accounts_reports', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Account Reports')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <div class="row">

                    <div class="col-md-6 links">
                        <!-- start: BORDERED TABLE PANEL -->
                        <div class="panel panel-default animated fadeIn">
                            <div class="panel-heading">
                                <i class="icon-external-link-sign"></i>
                                Church Accounts Report
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
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-condensed table-hover" id="sample-table-3">
                                    <thead>
                                        <tr>
                                            <th class="center hidden-xs">#</th>
                                            <th>Category</th>
                                            <th> Amount </th>

                                            <th class="hidden-xs">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="center hidden-xs">1. </td>												
                                            <td><a class="tooltips" href="<?php echo site_url('admin/reports/filter_account/offerings/'); ?>" data-placement="top" data-original-title="View in Details">Offerings</a></td>

                                            <td class="hidden-xs"><?php echo number_format($sum_offerings, 2) ?></td>

                                            <td class="hidden-xs">
                                                <a href="<?php echo site_url('admin/reports/filter_account/offerings'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i> View in Details</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="center hidden-xs">2. </td>												
                                            <td><a class="tooltips" href="<?php echo site_url('admin/reports/filter_account/tithes'); ?>" data-placement="top" data-original-title="View in Details">Tithes</a></td>

                                            <td class="hidden-xs"><?php echo number_format($sum_tithes, 2) ?></td>

                                            <td class="hidden-xs">
                                                <a href="<?php echo site_url('admin/reports/filter_account/tithes/'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i> View in Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">3. </td>												
                                            <td><a class="tooltips" href="<?php echo site_url('admin/reports/filter_account/thanks_giving/'); ?>" data-placement="top" data-original-title="View in Details">Thanks Giving</a></td>

                                            <td class="hidden-xs"><?php echo number_format($sum_thanks, 2) ?></td>

                                            <td class="hidden-xs">
                                                <a href="<?php echo site_url('admin/reports/filter_account/thanks_giving/'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i> View in Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">4. </td>												
                                            <td><a class="tooltips" href="<?php echo site_url('admin/reports/filter_account/ministry_support/'); ?>" data-placement="top" data-original-title="View in Details">Ministry Support</a></td>

                                            <td class="hidden-xs"><?php echo number_format($sum_support, 2) ?></td>

                                            <td class="hidden-xs">
                                                <a href="<?php echo site_url('admin/reports/filter_account/ministry_support/'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i> View in Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">5. </td>												
                                            <td><a class="tooltips" href="<?php echo site_url('admin/reports/filter_account/seed_planting/'); ?>" data-placement="top" data-original-title="View in Details">Seed Planting</a></td>

                                            <td class="hidden-xs"><?php echo number_format($sum_seeds, 2) ?></td>

                                            <td class="hidden-xs">
                                                <a href="<?php echo site_url('admin/reports/filter_account/reports/filter_account/seed_planting/'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i> View in Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">6. </td>												
                                            <td><a class="tooltips" href="<?php echo site_url('admin/reports/filter_account/other_contributions/'); ?>" data-placement="top" data-original-title="View in Details">Other Contributions</a></td>

                                            <td class="hidden-xs"><?php echo number_format($sum_others, 2) ?></td>

                                            <td class="hidden-xs">
                                                <a href="<?php echo site_url('admin/reports/filter_account/other_contributions/'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i> View in Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">7. </td>												
                                            <td><a class="tooltips" href="<?php echo site_url('admin/pledges/paid'); ?>" data-placement="top" data-original-title="View in Details">Paid Pledges</a></td>

                                            <td class="hidden-xs"><?php echo number_format($sum_paid_pledges, 2) ?></td>

                                            <td class="hidden-xs">
                                                <a href="<?php echo site_url('admin/reports/pledges'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i> View in Details</a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- end: BORDERED TABLE PANEL -->
                    </div>
                    <div class="col-md-6 print-links" style="display:none">
                        <!-- start: BORDERED TABLE PANEL -->
                        <div class="panel panel-default animated fadeIn">
                            <div class="panel-heading">
                                <i class="icon-external-link-sign"></i>
                                Church Accounts Report
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
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-condensed table-hover" id="sample-table-3">
                                    <thead>
                                        <tr>
                                            <th class="center hidden-xs">#</th>
                                            <th>Category</th>
                                            <th> Amount </th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="center hidden-xs">1. </td>												
                                            <td>Offerings</td>

                                            <td><?php echo number_format($sum_offerings, 2) ?></td>


                                        </tr>

                                        <tr>
                                            <td class="center hidden-xs">2. </td>												
                                            <td>Tithes</td>

                                            <td ><?php echo number_format($sum_tithes, 2) ?></td>


                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">3. </td>												
                                            <td>Thanks Giving</td>

                                            <td ><?php echo number_format($sum_thanks, 2) ?></td>


                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">4. </td>												
                                            <td>Ministry Support</td>

                                            <td ><?php echo number_format($sum_support, 2) ?></td>

                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">5. </td>												
                                            <td>Seed Planting</td>

                                            <td ><?php echo number_format($sum_seeds, 2) ?></td>

                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">6. </td>												
                                            <td>Other Contributions</td>

                                            <td ><?php echo number_format($sum_others, 2) ?></td>


                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">7. </td>												
                                            <td>Paid Pledges</td>

                                            <td ><?php echo number_format($sum_paid_pledges, 2) ?></td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- end: BORDERED TABLE PANEL -->
                    </div>

                    <div class="col-md-6">
                        <!-- start: TILTED PIE PANEL -->
                        <div class="panel panel-default animated fadeIn">
                            <div class="panel-heading">
                                <i class="icon-external-link-sign"></i>
                                Contributions Pie
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
                                <div class="flot-small-container">

                                    <div id="placeholder11" class="flot-placeholder"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end: TILTED PIE PANEL -->
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-12">
                        <!-- start: CATEGORIES PANEL -->
                        <div class="panel panel-default animated fadeIn">
                            <div class="panel-heading">
                                <i class="icon-external-link-sign"></i>
                                Contributions Flow Chart
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

                                <div class="flot-small-container">
                                    <div id="placeholder-h1" class="flot-placeholder"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end: CATEGORIES PANEL -->
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>




<?php
    $data = array();

    $cc = Count($pie_data);


    foreach ($pie_data as $key => $val)
    {
         $data[] = array(
                 'label' => $key,
                 'data' => $val
         );
    }

    //echo ($pie_data);die;
?>


<script>

     jQuery(document).ready(function ()
     {

          //***********START CHARTS *************

          var runCharts = function ()
          {

// Default Pie 
               var data_pie = [];
               data_pie = <?php echo json_encode($data); ?>;



// Tilted Pie 
               $.plot('#placeholder11', data_pie, {
                    series: {
                         pie: {
                              show: true,
                              radius: 1,
                              tilt: 0.5,
                              label: {
                                   show: true,
                                   radius: 1,
                                   formatter: labelFormatter,
                                   background: {
                                        opacity: 0.8
                                   }
                              },
                              combine: {
                                   color: '#999',
                                   threshold: 0.1
                              }
                         }
                    },
                    legend: {
                         show: false
                    }
               });

               function labelFormatter(label, series)
               {
                    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
               }
          };

          runCharts();



          // function to initiate Chart 1
          var runChart1 = function ()
          {
               function randValue()
               {
                    return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
               }
               ;
               var tithes = [

<?php
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

               function number_to_currency(num)
               {

                    return parseFloat(num).toFixed(2);
               }

               function showTooltip(x, y, contents)
               {
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
               $("#placeholder-h1").bind("plothover", function (event, pos, item)
               {
                    $("#x").text(pos.x.toFixed(2));
                    $("#y").text(pos.y.toFixed(2));
                    if (item)
                    {
                         if (previousPoint != item.dataIndex)
                         {
                              previousPoint = item.dataIndex;
                              $("#tooltip").remove();
                              var x = item.datapoint[0],
                                      y = item.datapoint[1].toFixed(2);
                              showTooltip(item.pageX, item.pageY, item.series.label + " " + x + " Update was KES " + y);
                         }
                    }
                    else
                    {
                         $("#tooltip").remove();
                         previousPoint = null;
                    }
               });
          };
          runChart1();



     });
</script>

<style>
    @media print{

         .modal-header{

              display:none !important;
         }

         .links{

              display:none !important;
         }
         .print-links{

              display:block !important;
         }


         .modal-footer{

              display:none !important;
         }

         .main-rec{

              display:none !important;
         }

         .receipt{
              width:1000px !important;

         }
         .modal-body{
              width:1000px !important;

         }


         .col-sm-3 {
              width: 300px !important;
              float: left !important;
         }
         .col-sm-6 {
              width: 600px !important;
              float: left !important;
         }
         .col-sm-7 {
              width: 700px !important;
              float: left !important;
         }
         .col-sm-9 {
              width: 900px !important;
              float: left !important;
         }

         .col-sm-8 {
              width: 800px !important;
              float: left !important;
         }


         .navigation{
              display:none;
         }
         .alert{
              display:none;
         }
         .panel-heading{
              display:none !important;
         }

         .top-panel-header{
              display:none !important;
         }

         .footer {
              display:none !important;
         }
         .main-content .container{

              border:none !important;
         }

         .print{
              display:none !important;
         }

         .header{display:none}

         .smf .content {
              margin-left: 0px;
         }
         .content {
              margin-left: 0px;
              padding: 0px;
         }
    }
</style>  

