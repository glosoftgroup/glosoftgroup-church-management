<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Reports Of <?php echo 'Assets  - (' . date('Y') . ')'; ?> </h3>

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
                    <div class="col-md-12">
                        <!-- start: BORDERED TABLE PANEL -->
                        <div class="col-md-12">
                            <br>
                            <h1 class="panel-title">Total Assets Cost KES <abbr  ><?php echo number_format($assets_cost, 2); ?> </abbr  > </h1>
                            </br>

                        </div>


                        <div class="clearfix"></div>
                        <div class="panel panel-default animated fadeIn">

                            <div class="panel-body">

                                <?php if ($assets)
                                    {
                                         ?>
                                         <table class="table table-condensed table-hover" id="">
                                             <thead>
                                                 <tr>
                                                     <th class="center ">#</th>
                                                     <th>Item Name</th>
                                                     <th>Category</th>
                                                     <th>Stock In</th>
                                                     <th>Stock Out</th>
                                                     <th>Remaining Stock</th>
                                                     <th>Total Cost</th>
                                                     <th class="hidden-xs">Action</th>

                                                 </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $i = 0;
                                                  foreach ($assets as $p)
                                                  {

                                                       $i++;
                                                       ?>
                                                      <tr>
                                                          <td><?php echo $i; ?> </td>
                                                          <td><?php echo $items [$p->item]; ?></td>
                                                          <td><?php echo $category [$p->item]; ?></td>
                                                          <td ><?php echo number_format($quantity_in[$p->item]); ?></td>
                                                          <td ><?php
                                                               $gnty = $quantity_in[$p->item];
                                                               $rem = 0;
                                                               if (!empty($rem_stock[$p->item]))
                                                               {
                                                                    $rem = $rem_stock[$p->item];
                                                                    $rem_q = $gnty - $rem;
                                                                    echo number_format($rem_q);
                                                               }
                                                               else
                                                               {
                                                                    echo 0;
                                                               }
                                                               ?></td>
                                                          <td ><?php
                                                               if (!empty($rem_stock[$p->item]))
                                                                    echo number_format($rem_stock[$p->item]);
                                                               else
                                                                    echo number_format($quantity_in[$p->item]);
                                                               ?></td>

                                                          <td><?php echo $item_cost[$p->item]; ?></td>
                                                          <td class="hidden-xs">
                                                              <a href="<?php echo site_url('admin/reports/filter_assets/' . $p->item); ?>" class="btn btn-xs btn-green tooltips" data-placement="top" data-original-title=" Go To"><i class="icon-share"></i> View in Trend</a>
                                                          </td>
                                                      </tr>

         <?php } ?>
                                             </tbody>
                                         </table>
                                         <hr />



                                    <?php } else
                                    {
                                         ?>
                                         <h3 class="panel-title"> No Assets recorded at the moment !!</h3>
    <?php } ?>

                            </div>

                        </div>
                        <!-- end: BORDERED TABLE PANEL -->
                    </div>

                </div>



                <div class="row">

                    <div class="col-md-12">
                        <!-- start: TILTED PIE PANEL -->
                        <div class="panel panel-default animated fadeIn">
                            <div class="panel-heading">
                                <i class="icon-external-link-sign"></i>
                                Assets  Pie
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

    $cc = Count($assets);


    foreach ($assets as $p)
    {
         $data[] = array(
                 'label' => $items[$p->item],
                 'data' => $item_cost[$p->item]
         );
    }

    //print_r ($data);die;
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

<script>

     jQuery(document).ready(function ()
     {
          document.getElementById('months').style.display = 'none';
     });
</script>

<style>
    @media print{

         .modal-header{

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
