<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Reports Of <?php echo 'Sent SMS  - (' . date('Y') . ')'; ?> </h3>

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
                        <div class="col-md-4">
                            <br>
                            <h1 class="panel-title">All Sent SMS <abbr  ><?php echo number_format($count_sms); ?> </abbr  > </h1>
                            </br>

                        </div>
                        <div class="col-md-1 filter-panel">

                        </div>
                        <div class="col-md-7 filter-panel">
                             <?php
                                 $attributes = array('class' => 'form-horizontal', 'id' => '');
                                 echo form_open_multipart('admin/reports/sms_byDate/', $attributes);
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

                                <?php if ($sms)
                                    {
                                         ?>
                                         <table class="table table-condensed table-hover" id="">
                                             <thead>
                                                 <tr>
                                                     <th class="center ">#</th>

                                                     <th>Date</th>
                                                     <th>Sent As</th>
                                                     <th>Recipient</th>
                                                     <th>Message</th>
                                                     <th>Cost</th>

                                                 </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $i = 0;
                                                  foreach ($sms as $p)
                                                  {

                                                       $m = $this->ion_auth->get_single_member($p->recipient);
                                                       if ($p->sent_to == 'all staff')
                                                       {
                                                            $m = $this->ion_auth->get_user($p->recipient);
                                                       }
                                                       elseif ($p->sent_to == 'staff member')
                                                       {
                                                            $m = $this->ion_auth->get_user($p->recipient);
                                                       }
                                                       elseif ($p->sent_to == 'church visitor')
                                                       {
                                                            $m = $this->ion_auth->get_single_visitor($p->recipient);
                                                       }


                                                       $i++;
                                                       ?>
                                                      <tr>
                                                          <td class=""><?php echo $i; ?> </td>
                                                          <td width="100"><?php echo date('d M Y', $p->created_on); ?></td>
                                                          <td><?php echo ucwords($p->sent_to); ?></td>												
                                                          <td>
              <?php echo $m->first_name . ' ' . $m->last_name; ?>
                                                          </td>
                                                          <td><?php echo $p->message; ?></td>
                                                          <td><?php echo $p->cost; ?></td>
                                                      </tr>

         <?php } ?>
                                             </tbody>
                                         </table>
                                         <hr />

                                         <div class="pull-right" id="months"  <?php echo preg_match('/^(admin\/reports\/sms_byDate)$/i', $this->uri->uri_string()) ? 'style="display:block !important;" ' : ''; ?>>

                                             <h1 class="panel-title">Total Sent SMS. <abbr  > 
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
                                         <h3 class="panel-title"> No SMS Sent at the moment !!</h3>
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
