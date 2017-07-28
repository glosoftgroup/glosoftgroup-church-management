<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Members Reports </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <button onClick="window.print();return false" class="btn btn-success" type="button"><span class="icon-print"></span> Print </button>
                    <button onClick="window.print();return false" class="btn btn-warning" type="button"><span class="clip-clip"></span> Download PDF </button>
                    <?php echo anchor('admin/reports/members_reports', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Members Reports')) . '</span>', 'class="btn btn-info"'); ?> 
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
                                Members Management Report
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
                                            <th> Total Number </th>
                                            <th class="hidden-xs"><i class="icon-calendar"></i> Date As At</th>

                                            <th class="hidden-xs">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="center hidden-xs">1. </td>												
                                            <td><a class="tooltips" href="<?php echo site_url('admin/reports/filter_members/'); ?>" data-placement="top" data-original-title="View in Details">Registered Members</a></td>

                                            <td class="hidden-xs"><?php echo number_format($count_members) ?></td>
                                            <td><?php echo date('d M Y') ?></td>
                                            <td class="hidden-xs">
                                                <a href="<?php echo site_url('admin/reports/filter_members/'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i>View in Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">2. </td>												
                                            <td><a class="tooltips" href="<?php echo site_url('admin/reports/filter_visitors/'); ?>" data-placement="top" data-original-title="View in Details">Registered Visitor</a></td>

                                            <td class="hidden-xs"><?php echo number_format($count_visitors) ?></td>
                                            <td><?php echo date('d M Y') ?></td>
                                            <td class="hidden-xs">
                                                <a href="<?php echo site_url('admin/reports/filter_visitors/'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i>View in Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">3. </td>												
                                            <td><a class="tooltips" href="<?php echo site_url('admin/reports/filter_ssSchool/'); ?>" data-placement="top" data-original-title="View in Details">Sunday School</a></td>

                                            <td class="hidden-xs"><?php echo number_format($count_sSchool) ?></td>
                                            <td><?php echo date('d M Y') ?></td>
                                            <td class="hidden-xs">
                                                <a href="<?php echo site_url('admin/reports/filter_ssSchool/'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i>View in Details</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="center hidden-xs">5. </td>												
                                            <td><a class="tooltips" href="<?php echo site_url('admin/reports/filter_baptism/'); ?>" data-placement="top" data-original-title="View in Details">Baptisms Recorded</a></td>

                                            <td class="hidden-xs"><?php echo number_format($count_baptism) ?></td>
                                            <td><?php echo date('d M Y') ?></td>
                                            <td class="hidden-xs">
                                                <a href="<?php echo site_url('admin/reports/filter_baptism/'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i>View in Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">6. </td>												
                                            <td><a class="tooltips" href="<?php echo site_url('admin/reports/filter_dedications/'); ?>" data-placement="top" data-original-title="View in Details">Children Dedication</a></td>

                                            <td class="hidden-xs"><?php echo number_format($count_dedicated) ?></td>
                                            <td><?php echo date('d M Y') ?></td>
                                            <td class="hidden-xs">
                                                <a href="<?php echo site_url('admin/reports/filter_dedications/'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i>View in Details</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="center hidden-xs">8. </td>												
                                            <td><a class="tooltips" href="<?php echo site_url('admin/reports/filter_hbc_members/'); ?>" data-placement="top" data-original-title="View in Details">Members in HBCs</a></td>

                                            <td class="hidden-xs"><?php echo number_format($count_hbc_members) ?></td>
                                            <td><?php echo date('d M Y') ?></td>
                                            <td class="hidden-xs">
                                                <a href="<?php echo site_url('admin/reports/filter_hbc_members/'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i>View in Details</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">9. </td>												
                                            <td><a class="tooltips" href="<?php echo site_url('admin/reports/filter_ministry_members/'); ?>" data-placement="top" data-original-title="View in Details">Members in Ministries</a></td>

                                            <td class="hidden-xs"><?php echo number_format($count_ministry_members) ?></td>
                                            <td><?php echo date('d M Y') ?></td>
                                            <td class="hidden-xs">
                                                <a href="<?php echo site_url('admin/reports/filter_ministry_members'); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i>View in Details</a>
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
                                Members Management Report
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
                                            <th> Total Number </th>
                                            <th class=""><i class="icon-calendar"></i> Date As At</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="center hidden-xs">1. </td>												
                                            <td>Registered Members</td>

                                            <td ><?php echo number_format($count_members) ?></td>
                                            <td><?php echo date('d M Y') ?></td>

                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">2. </td>												
                                            <td>Registered Visitor</td>

                                            <td ><?php echo number_format($count_visitors) ?></td>
                                            <td><?php echo date('d M Y') ?></td>

                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">3. </td>												
                                            <td>Sunday School</td>

                                            <td ><?php echo number_format($count_sSchool) ?></td>
                                            <td><?php echo date('d M Y') ?></td>

                                        </tr>

                                        <tr>
                                            <td class="center hidden-xs">5. </td>												
                                            <td>Baptisms Recorded</td>

                                            <td><?php echo number_format($count_baptism) ?></td>
                                            <td><?php echo date('d M Y') ?></td>

                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">6. </td>												
                                            <td>Children Dedication</td>

                                            <td ><?php echo number_format($count_dedicated) ?></td>
                                            <td><?php echo date('d M Y') ?></td>

                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">7. </td>												
                                            <td>Children Dedication</td>

                                            <td ><?php echo number_format($count_dedicated) ?></td>
                                            <td><?php echo date('d M Y') ?></td>

                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">8. </td>												
                                            <td>Members in HBCs</td>

                                            <td ><?php echo number_format($count_hbc_members) ?></td>
                                            <td><?php echo date('d M Y') ?></td>

                                        </tr>
                                        <tr>
                                            <td class="center hidden-xs">9. </td>												
                                            <td>Members in Ministries</td>

                                            <td ><?php echo number_format($count_ministry_members) ?></td>
                                            <td><?php echo date('d M Y') ?></td>

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
                                Registration Pie
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
                                Registration Per Month
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
                                <div class="reg">
                                    <h4>Registration of Members bar [ Year <?php echo date('Y') ?>] </h4>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="flot-small-container">
                                    <div id="placeholder5" class="flot-placeholder"></div>
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
    $pie_data = array();

    $cc = Count($load_pie_data);


    foreach ($load_pie_data as $key => $val)
    {
         $pie_data[] = array(
                 'label' => $key,
                 'data' => $val
         );
    }
?>


<script>

     jQuery(document).ready(function ()
     {

          //***********START CHARTS *************

          var runCharts = function ()
          {


//Categories 

<?php
    $arr_ol = array(
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December'
    );
    $arr = array(
            '01',
            '02',
            '03',
            '04',
            '05',
            '06',
            '07',
            '08',
            '09',
            '10',
            '11',
            '12'
    );
    $i = 0;
    $cc = count($arr);

    $new = array();
    foreach ($reg_members_bar as $key => $val)
    {
         $pp = (object) $val;
         $new[] = $pp->the_month;
    }

    foreach ($arr as $item)
    {
         if (!in_array($item, $new))
         {
              $reg_members_bar[] = array('count' => 0, 'the_month' => $item);
         }
    }
    $final = aasort($reg_members_bar, 'the_month');
    $dt = array();

    $str = "[";
    foreach ($final as $fg)
    {
         $f = (object) $fg;
         $mt = isset($arr_ol[$f->the_month]) ? $arr_ol[$f->the_month] : 0;
         $dt[$mt] = (int) $f->count;

         $str .= '["' . $mt . '",' . (int) $f->count . '],';
    }$str .= "]";
?>
               var data_category = <?php echo $str; ?>;
               $.plot("#placeholder5", [data_category], {
                    series: {
                         bars: {
                              show: true,
                              barWidth: 0.6,
                              align: "center",
                              fillColor: "#4DBEF4",
                              lineWidth: 0,
                         }
                    },
                    xaxis: {
                         mode: "categories",
                         tickLength: 0
                    }
               });
// Annotations
               var d_1 = [];
               for (var i = 0; i < 20; ++i)
               {
                    d_1.push([i, Math.sin(i)]);
               }
               var data_annotation = [{
                         data: d_1,
                         label: "Pressure",
                         color: "#333"
                    }];
               var markings = [{
                         color: "#f6f6f6",
                         yaxis: {
                              from: 1
                         }
                    }, {
                         color: "#f6f6f6",
                         yaxis: {
                              to: -1
                         }
                    }, {
                         color: "#000",
                         lineWidth: 1,
                         xaxis: {
                              from: 2,
                              to: 2
                         }
                    }, {
                         color: "#000",
                         lineWidth: 1,
                         xaxis: {
                              from: 8,
                              to: 8
                         }
                    }];

// Default Pie 
               var data_pie = [];
               data_pie = <?php echo json_encode($pie_data); ?>;



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


         .details-title{

              display:block !important;
         }
         .btns{

              display:none !important;
         }

         .modal-footer{

              display:none !important;
         }

         .filter-panel{

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


