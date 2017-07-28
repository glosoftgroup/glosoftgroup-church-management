<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Petty Cash Reports</h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <button onClick="window.print();return false" class="btn btn-success" type="button"><span class="icon-print"></span> Print </button>
                    <button onClick="window.print();return false" class="btn btn-warning" type="button"><span class="clip-clip"></span> Download PDF </button>
                    <?php echo anchor('admin/reports/petty_cash', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Petty Cash Reports')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">
                <div class="row">
                    <div class="col-md-12">
                        <!-- start: BORDERED TABLE PANEL -->
                        <div class="col-md-6">
                            <br>
                            <h1 class="panel-title">Total Petty Cash KES. <abbr  ><?php echo number_format($total_petty_cash->total, 2); ?> </abbr  > Year <?php echo date('Y'); ?></h1>
                            </br>

                        </div>
                        <div class="col-md-6">
                            <h3 class="panel-title filter-panel">



                                <?php
                                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                                    echo form_open_multipart('admin/reports/petty_cash/', $attributes);
                                ?>

                                <div class="col-sm-6 input-group">
                                     <?php
                                         $months = array('01' => "January", '02' => "February", '03' => "March", '04' => "April", '05' => "May", '06' => "June", '07' => "July", '08' => "August", '09' => "September", '10' => "October", '11' => "November", '12' => "December");


                                         echo form_dropdown('month', array('' => 'Select Month') + $months, (isset($result->month)) ? $result->month : '', ' id="month" class="form-control"');
                                     ?>
                                </div>
                                <div class="col-sm-6 input-group">						
                                     <?php
                                         $time = strtotime('1/1/2010');
                                         $dates = array();

                                         for ($i = 0; $i < 29; $i++)
                                         {
                                              $dates[date('Y', mktime(0, 0, 0, date('m', $time), date('d', $time), date('Y', $time) + $i))] = date('Y', mktime(0, 0, 0, date('m', $time), date('d', $time), date('Y', $time) + $i));
                                         }

                                         echo form_dropdown('year', array('' => 'Year') + $dates, '', ' id="year" class="form-control"');
                                     ?>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-success">
                                            <i class="icon-search"></i>
                                            Filter
                                        </button> </span>
                                </div>	
                                <?php echo form_close(); ?>

                                <?php
                                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                                    echo form_open_multipart('admin/reports/petty_range/', $attributes);
                                ?>

                                <div class="col-sm-12 input-group"><hr>	</div>	 
                                <div class="col-sm-6 input-group">		 
                                    <input id='dtae' type='text' name='from' placeholder="Date From" class='form-control date-picker' value="<?php echo set_value('dtae', (isset($result->dtae)) ? $result->dtae : ''); ?>"  />
                                </div>
                                <div class="col-sm-6 input-group">	
                                    <input id='dtae' type='text' name='to' placeholder="Date To"class='form-control date-picker' value="<?php echo set_value('dtae', (isset($result->dtae)) ? $result->dtae : ''); ?>"  />
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-success">
                                            <i class="icon-search"></i>
                                            Filter
                                        </button> </span>
                                </div>

                                <?php echo form_close(); ?>	


                            </h3>


                        </div>
                        <div class="clearfix"></div><hr>
                        <div class="panel panel-default col-md-8">



                            <div class="col-sm-4">
                                <button class="btn btn-icon btn-block">
                                    <i class="clip-database"></i><br>
                                    Today's Petty Cash <span class="badge badge-info">KES <?php echo number_format($todays); ?></span>
                                </button>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-icon btn-block">
                                    <i class="clip-pie"></i><br>
                                    This Month's Petty Cash <span class="badge badge-info">KES <?php echo number_format($mnths); ?></span>
                                </button>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-icon btn-block">
                                    <i class="clip-folder"></i><br>
                                    This Year's Petty Cash <span class="badge badge-info">KES <?php echo number_format($years); ?></span>
                                </button>
                            </div>




                            <div class="panel-body">

                                <?php if ($post)
                                    {
                                         ?>
                                         <table class="table table-condensed table-hover" id="">
                                             <thead>
                                                 <tr>
                                                     <th width="3%">#</th>
                                                     <th width="">Item</th>
                                                     <th width="">Amount</th> 
                                                     <th width="">Date Recorded</th>
                                                     <th width="">Last Recorded by</th>
                                                     <th class="action">Action</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $i = 0;
                                                  $ext = 0;
                                                  foreach ($post as $p)
                                                  {
                                                       $petty_cash_total = (object) $p->petty_cash_total;
                                                       $u = $this->ion_auth->get_user($p->created_by);

                                                       $i++;
                                                       $ext += $p->amount;
                                                       ?>

                                                      <tr>
                                                          <td><?php echo $i . '. '; ?></td>
                                                          <td><?php echo $items[$p->item]; ?></td>
                                                          <td class="rttb"><b > <?php echo number_format($p->amount, 2) ?></b></td>
                                                          <td><?php echo date('d M Y', $p->date) ?></td>
                                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                                          <td class="action">
                                                              <a class="tooltips" data-original-title="View All" href="<?php echo base_url('admin/petty_cash/'); ?>"> 
                                                                  <i class="icon-double-angle-right"></i> View All
                                                              </a></td>
                                                      </tr>
                                                      <?php
                                                 }
                                                 ?>
                                                 <tr>
                                                     <td colspan="2" > <h1 class="panel-title">Total Petty Cash </h1></td>
                                                     <td class="rttbd">
                                                         <h1 class="panel-title">KES.<?php echo number_format($ext, 2); ?></h1></td>
                                                     <td colspan="2" > </td>
                                                     <td colspan="2" class="action"> </td>
                                                 </tr>
                                             </tbody>
                                         </table>
                                         <hr />



                                    <?php
                                    }
                                    else
                                    {
                                         ?>
                                         <h3 class="panel-title"> No petty cash Recorded at the moment !!</h3>
    <?php } ?>

                            </div>

                        </div>

                        <div class="col-md-4">
                            <!-- start: TILTED PIE PANEL -->
                            <div class="panel panel-default pies">
                                <div class="panel-heading">
                                    <i class="icon-external-link-sign"></i>
                                    Petty Cash Pie
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
                        <!-- end: BORDERED TABLE PANEL -->
                    </div>






                </div>
            </div>

        </div>
    </div>
</div>




<?php
    $data = array();

    $cc = Count($post);


    foreach ($post as $p)
    {
         $data[] = array(
                 'label' => $items[$p->item],
                 'data' => $p->petty_cash_total
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





     });
</script>

<style>
    @media print{

         .modal-header{

              display:none !important;
         }

         .pies{

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
