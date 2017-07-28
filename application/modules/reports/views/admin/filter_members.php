<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Reports Of <?php 'Members  - (' . date('Y') . ')'; ?> </h3>

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
                    <div class="col-md-12">
                        <!-- start: BORDERED TABLE PANEL -->
                        <div class="col-md-3">
                            <br>
                            <h1 class="panel-title">All Registered Members <abbr  ><?php echo number_format($count_members); ?> </abbr  > </h1>
                            </br>

                        </div>
                        <div class="col-md-4 filter-panel">
                            <h3 class="panel-title filter-panel">


                                <?php
                                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                                    echo form_open_multipart('admin/reports/members_custom_filter/', $attributes);
                                ?>


                                <div class="col-sm-12 input-group">						
                                     <?php
                                         $items = array(
                                                 "active" => "Active",
                                                 "deceased" => "Deceased",
                                                 "prospect" => "Prospect",
                                                 "transferred" => "transferred",
                                                 "male" => "Male",
                                                 "female" => "Female",
                                                 "married" => "Married",
                                                 "single" => "Single",
                                                 "divorced" => "Divorced",
                                                 "separated" => "Separated",
                                                 "widow" => "Widow",
                                                 "widower" => "Widower",
                                                 "single mom" => "Single mom",
                                                 "single dad" => "Single dad"
                                         );

                                         echo form_dropdown('field_name', array('' => 'Custom Filter') + $items, '', ' id="field_name" class="form-control"');
                                     ?>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-success">
                                            <i class="icon-search"></i>
                                            By Field
                                        </button> </span>
                                </div>

                                <?php echo form_close(); ?>	
                        </div>
                        <div class="col-md-5 filter-panel">
                             <?php
                                 $attributes = array('class' => 'form-horizontal', 'id' => '');
                                 echo form_open_multipart('admin/reports/members_byDate/', $attributes);
                             ?>


                            <div class="col-sm-6 input-group">
                                 <?php
                                     $months = array(01 => "January", 02 => "February", 03 => "March", 04 => "April", 05 => "May", 06 => "June", 07 => "July", 08 => "August", 09 => "September", 10 => "October", 11 => "November", 12 => "December");


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

                            </h3>


                        </div>
                        <div class="clearfix"></div>
                        <div class="panel panel-default animated fadeIn">

                            <div class="panel-body">

                                <?php if ($members)
                                    {
                                         ?>
                                         <table class="table table-condensed table-hover" id="">
                                             <thead>
                                                 <tr>
                                                     <th class="center hidden-xs">#</th>
                                                     <th>Name</th>
                                                     <th>Date Joined</th>
                                                     <th>Gender</th>
                                                     <th>Mobile</th>
                                                     <th>Email</th>
                                                     <th>County</th>
                                                     <th>Location</th>
                                                     <th>Status</th>

                                                 </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $i = 0;
                                                  foreach ($members as $p)
                                                  {
                                                       $i++;
                                                       ?>
                                                      <tr>
                                                          <td class="center"><?php echo $i; ?> </td>
                                                          <td>
              <?php echo $p->title . ' ' . $p->first_name . ' ' . $p->last_name; ?>
                                                          </td>
                                                          <td><?php echo date('d M Y', $p->date_joined); ?></td>		

                                                          <td><?php echo $p->gender; ?></td>
                                                          <td><?php
                                                               $ph = $p->phone1;
                                                               $cha = array('(', ')', '-');
                                                               $sp = array('', '', '');
                                                               echo str_replace($cha, $sp, $ph);
                                                               ?></td>

                                                          <td><?php echo $p->email; ?></td>
                                                          <td><?php echo $p->county; ?></td>
                                                          <td><?php echo $p->location; ?></td>
                                                          <td><?php echo ucwords($p->member_status); ?></td>
                                                      </tr>

         <?php } ?>
                                             </tbody>
                                         </table>
                                         <hr />

                                         <div class="pull-right" id="months"  <?php echo preg_match('/^(admin\/reports\/members_byDate)$/i', $this->uri->uri_string()) ? 'style="display:block !important;" ' : ''; ?>>

                                             <h1 class="panel-title">Total Registered Members. <abbr  > 
         <?php echo number_format($count_per_date); ?> 

                                                 </abbr  >
                                                 <?php if ($the_month)
                                                 {
                                                      ?>
                                                      Month of <abbr  ><?php echo $months[$the_month]; ?></abbr  >
         <?php } ?>
                                             </h1>

                                             </br>

                                         </div>

                                    <?php
                                    }
                                    else
                                    {
                                         ?>
                                         <h3 class="panel-title"> No members recorded at the moment !!</h3>
    <?php } ?>

                            </div>

                        </div>
                        <!-- end: BORDERED TABLE PANEL -->
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-12">
                        <!-- start: CATEGORIES PANEL -->
                        <div class="panel panel-default animated fadeIn">
                            <div class="panel-heading">
                                <i class="icon-external-link-sign"></i>
                                Members Registration Graph
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

                <!-----END WIDGET ----------->
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
