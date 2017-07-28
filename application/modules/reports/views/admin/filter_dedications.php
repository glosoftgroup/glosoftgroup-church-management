<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Reports Of <?php 'Dedications  - (' . date('Y') . ')'; ?> </h3>

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
                        <div class="col-md-4">
                            <br>
                            <h1 class="panel-title">All Registered Dedications <abbr  ><?php echo number_format($count_dedicated); ?> </abbr  > </h1>
                            </br>

                        </div>
                        <div class="col-md-2 filter-panel">
                            <h3 class="panel-title filter-panel">

                        </div>
                        <div class="col-md-6 filter-panel">
                             <?php
                                 $attributes = array('class' => 'form-horizontal', 'id' => '');
                                 echo form_open_multipart('admin/reports/dedications_byDate/', $attributes);
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
                        <div class="panel panel-default">

                            <div class="panel-body">

                                <?php if ($members)
                                    {
                                         ?>
                                         <table class="table table-condensed table-hover" id="">
                                             <thead>
                                                 <tr>
                                                     <th class="center hidden-xs">#</th>
                                                     <th>Name</th>
                                                     <th>Date</th>
                                                     <th>Gender</th>
                                                     <th>DOB</th>
                                                     <th>Place of Birth</th>
                                                     <th>Town</th>
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
              <?php echo $p->first_name . ' ' . $p->last_name; ?>
                                                          </td>
                                                          <td><?php echo date('d M Y', $p->date); ?></td>		

                                                          <td><?php echo $p->gender; ?></td>
                                                          <td><?php echo date('d M Y', $p->dob); ?></td>
                                                          <td><?php echo $p->location; ?></td>
                                                          <td><?php echo $p->city; ?></td>
                                                          <td><?php if ($p->status == 1)
                   echo 'Dedicated';
              else
                   echo 'Pending';
              ?></td>

                                                      </tr>

         <?php } ?>
                                             </tbody>
                                         </table>
                                         <hr />

                                         <div class="pull-right" id="months"  <?php echo preg_match('/^(admin\/reports\/dedications_byDate)$/i', $this->uri->uri_string()) ? 'style="display:block !important;" ' : ''; ?>>

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

            </div>

        </div>
    </div>
</div>


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
