<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Wages Reports</h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <button onClick="window.print();return false" class="btn btn-success" type="button"><span class="icon-print"></span> Print </button>
                    <button onClick="window.print();return false" class="btn btn-warning" type="button"><span class="clip-clip"></span> Download PDF </button>
                    <?php echo anchor('admin/reports/wages', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Wages Reports')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">
                <div class="row">
                    <div class="col-md-12">
                        <div class="clearfix"></div>
                        <div class="panel panel-default ">

                            <div class="panel-body">

                                <?php if ($post): ?>
                                         <table class="table table-condensed table-hover" id="">
                                             <thead>
                                                 <tr>
                                                     <th width="3%">#</th>
                                                     <th width="">Month / Year</th>
                                                     <th width="">No. of Employees Paid</th> 
                                                     <th width="">Pay Date</th>
                                                     <th width="">Processed Salary</th>
                                                     <th width="">Total Advance</th>
                                                     <th width="">Total Paid</th>
                                                     <th width="">Paid By</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $i = 0;
                                                  foreach ($post as $p)
                                                  {
                                                       $total_paid = (object) $p->total_paid;
                                                       $no_employees = (object) $p->no_employees;
                                                       $u = $this->ion_auth->get_user($p->created_by);
                                                       $i++;
                                                       ?>

                                                      <tr>
                                                          <td><?php echo $i . '. '; ?></td>
                                                          <td><?php echo $p->month . ' - ' . $p->year; ?></td>
                                                          <td><?php
                                                               if ($p->employee == 1)
                                                                    echo $p->no_employees . ' Employee';
                                                               else
                                                                    echo $p->no_employees . ' Employees';
                                                               ?></td> 
                                                          <td><?php echo date('d M Y', $p->salary_date); ?></td>
                                                          <td><b >KES. <?php echo number_format($p->total_paid, 2) ?></b></td>
                                                          <td><b >KES. <?php echo number_format($p->advance, 2) ?></b></td>
                                                          <td><b >KES. <?php
                                                                    $tt = $p->total_paid + $p->advance;
                                                                    echo number_format($tt, 2)
                                                                    ?></b></td>

                                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>

                                                      </tr>
                                                      <?php
                                                 }
                                                 ?>
                                             </tbody>
                                         </table>
                                    <?php else: ?>
                                         <h3>No Salaries processed at the moment</h3>
                                <?php endif; ?>
                                <div class="row-fluid">
                                    <div class="span9"></div>
                                    <div class="span3">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
