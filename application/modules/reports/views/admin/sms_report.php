<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">SMS Report </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <button onClick="window.print();return false" class="btn btn-success" type="button"><span class="icon-print"></span> Print </button>
                    <button onClick="window.print();return false" class="btn btn-warning" type="button"><span class="clip-clip"></span> Download PDF </button>
                    <?php echo anchor('admin/reports/sms_reports', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'SMS Reports')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <div class="row">

                    <div class="col-sm-12">
                        <div class="row space12">
                            <ul class="mini-stats col-sm-12">
                                <li class="col-sm-3 ">
                                    <a href="<?php echo base_url('admin/reports/filter_sms'); ?>">
                                        <i class="clip-bubbles circle-icon circle-green col-sm-8 "></i>
                                        <div class="values alert alert-success col-sm-7">
                                            <strong><?php echo number_format($count_sms); ?></strong>
                                            All Sent SMSs<br>
                                            <span style="color:#000;">View In Details <i class="clip-arrow-right-2"></i></span>
                                        </div>

                                    </a>

                                </li>

                                <li class="col-sm-3">
                                    <a href="<?php echo base_url('admin/reports/sms_purchased'); ?>">
                                        <i class="clip-database circle-icon circle-teal col-sm-5"></i>
                                        <div class="values alert alert-info fade in col-sm-7">
                                            <strong>KES. <?php echo number_format($count_purchased_sms->total, 2); ?></strong>
                                            Total Purchased SMSs<br>
                                            <span style="color:#000;">View In Details <i class="clip-arrow-right-2"></i></span>
                                        </div>
                                    </a>
                                </li>
                                <li class="col-sm-3">
                                    <a href="<?php echo base_url('admin/reports/filter_sms'); ?>">
                                        <i class="icon-money circle-icon circle-teal col-sm-5"></i>
                                        <div class="values alert alert-info fade in col-sm-7">
                                            <strong>KES. <?php echo number_format($sms_cost, 2); ?></strong>
                                            Total SMS Cost<br>
                                            <span style="color:#000;">View In Details <i class="clip-arrow-right-2"></i></span>
                                        </div>
                                    </a>
                                </li>
                                <li class="col-sm-3">
                                    <a href="<?php echo base_url('admin/reports/current_monthSMS'); ?>">
                                        <i class="clip-calendar circle-icon circle-black col-sm-5"></i>
                                        <div class="values alert alert-warning col-sm-7">
                                            <strong><?php echo number_format($sms_sent_per_month); ?></strong>
                                            SMSs sent this Month<br>
                                            <span style="color:#000;">View In Details <i class="clip-arrow-right-2"></i></span>
                                        </div>
                                    </a>
                                </li>


                            </ul>
                        </div>
                        <hr />
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-12">
                        <!-- start: TILTED PIE PANEL -->
                        <div class="panel panel-default animated fadeIn">
                            <div class="panel-heading">
                                <i class="icon-external-link-sign"></i>
                                SMS Communication Pie
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

    //print_r($data);die;
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


