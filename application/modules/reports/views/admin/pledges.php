<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Pledges </h3>

            <div class="heading-elements">
                <button class="btn btn-info ppaid"><i class="icon-money"></i> <span>  List paid</span></button>
                <button class="btn btn-primary ppending"><i class="icon-list"></i> <span> List Pending</span></button>

                <button onClick="window.print();return false" class="btn btn-success" type="button"><span class="icon-print"></span> Print </button>
                <button onClick="window.print();return false" class="btn btn-warning" type="button"><span class="clip-clip"></span> Download PDF </button>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">

                <div class="col-md-9 ppie">
                    <!-- start: TILTED PIE PANEL -->
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="flot-small-container">

                                <div id="placeholder11" class="flot-placeholder"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ppie">
                    <br>
                    <h1 class="panel-title">Total Paid Pledges <abbr  ><?php echo number_format($total_paid->total, 2); ?> </abbr><br> Year <?php echo date('Y'); ?></h1>
                    <hr>
                    <h1 class="panel-title">Total Pending <abbr  ><?php echo number_format($total_pending->total, 2); ?> </abbr><br> Year <?php echo date('Y'); ?></h1>
                    <br>
                    <!-- end: TILTED PIE PANEL -->
                </div>


                <div class="paid" style="display:none">			                       
                     <?php if ($paid): ?>
                             <div class='clearfix'></div>
                             <table class="table table-striped table-bordered table-hover table-full-width" id="sample_2">

                                 <thead>
                                 <th>#</th>
                                 <th>Paid On</th>
                                 <th>Title</th>
                                 <th>Member</th>
                                 <th>Amount Paid</th>

                                 </thead>
                                 <tbody>
                                      <?php
                                      $i = 0;
                                      if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                      {
                                           $i = ($this->uri->segment(4) - 1) * $per;
                                      }

                                      foreach ($paid as $p):
                                           $i++;
                                           ?>
                                          <tr>
                                              <td><?php echo $i . '.'; ?></td>
                                              <td><?php echo date('d M Y', $p->date); ?></td>				
                                              <td><?php echo $pledge[$p->pledge_id]; ?></td>
                                              <td><?php echo $members[$mem[$p->pledge_id]]; ?></td>
                                              <td><?php echo number_format($p->amount, 2); ?></td>

                                          </tr>
                                     <?php endforeach ?>
                                 </tbody>

                             </table>


                        <?php else: ?>
                             <p class='text'>No Pending pledge at the moment</p>
                    <?php endif ?>
                </div>
                <div class="pending"  style="display:none">


                    <?php if ($pending): ?>
                             <div class='clearfix'></div>
                             <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                                 <thead>
                                 <th>#</th>
                                 <th>Paid On</th>
                                 <th>Title</th>
                                 <th>Member</th>
                                 <th>Amount </th>
                                 <th>Status</th>

                                 </thead>
                                 <tbody>
                                      <?php
                                      $i = 0;
                                      if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                      {
                                           $i = ($this->uri->segment(4) - 1) * $per;
                                      }

                                      foreach ($pending as $p):
                                           $i++;
                                           ?>
                                          <tr>
                                              <td><?php echo $i . '.'; ?></td>
                                              <td><?php echo date('d M Y', $p->date); ?></td>				
                                              <td><?php echo $p->title; ?></td>
                                              <td><?php echo $members[$p->member]; ?></td>
                                              <td><?php echo number_format($p->amount, 2); ?></td>
                                              <td><?php
                                                   if ($p->status == 1)
                                                   {
                                                        echo '<span class="label label-warning"> Pending</span> ';

                                                        $now = time(); // or your date as well
                                                        $p_date = date('Y-m-d', $p->expected_pay_date);
                                                        $act_date = strtotime($p_date);
                                                        $datediff = $act_date - $now;
                                                        $days = floor($datediff / (60 * 60 * 24));
                                                        if ($days < 0)
                                                        {
                                                             echo ' <span class="label label-danger"> Overdue </span>';
                                                        }
                                                        elseif (0 == $days)
                                                        {
                                                             echo ' <span class="label label-info"> ' . $days . ' Days to go  </span>';
                                                        }
                                                        else
                                                        {
                                                             echo ' <span class="label label-info">' . $days . ' Day(s) to go </span>';
                                                        }
                                                   }
                                                   elseif ($p->status == 2)
                                                   {
                                                        echo '<span class="label label-success">Paid</span>';
                                                   }
                                                   else
                                                   {
                                                        echo '<span class="label label-inverse">Voided</span>';
                                                   }
                                                   ?></td>

                                          </tr>
                                     <?php endforeach ?>
                                 </tbody>

                             </table>


                        <?php else: ?>
                             <p class='text'>No Paid pledge at the moment</p>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    $data = array();

    $cc = Count($pledges_pie);


    foreach ($pledges_pie as $key => $val)
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

          $('.ppaid').click(function ()
          {
               $('.paid').show('slow');
               $('.pending').hide();
               $('.ppie').hide();
          });
          $('.ppending').click(function ()
          {
               $('.paid').hide();
               $('.ppie').hide();
               $('.pending').show('slow');
          });

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

         .modal-footer{

              display:none !important;
         }
         .action{

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
         .dataTables_length{
              display:none;
         }
         .dataTables_filter{
              display:none;
         }
         .pagination{
              display:none;
         }
         .dataTables_info{
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


