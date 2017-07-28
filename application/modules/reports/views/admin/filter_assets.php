<div class="col-sm-12">
    <div class="panel panel-default"> 
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

                        <div class="clearfix"></div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="icon-external-link-sign"></i>
                                Asset Stock In
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

                                <?php if ($assets_stock)
                                    {
                                         ?>
                                         <table class="table table-condensed table-hover" id="">
                                             <thead>
                                                 <tr>
                                                     <th class="center ">#</th>
                                                     <th>Date</th>
                                                     <th>Item Name</th>
                                                     <th>Category</th>
                                                     <th>Quantity Bought</th>
                                                     <th>Unit Price</th>
                                                     <th>Total Cost</th>
                                                     <th>Supplier</th>
                                                     <th>Person Responsible</th>

                                                 </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $i = 0;
                                                  foreach ($assets_stock as $p)
                                                  {
                                                       $u = $this->ion_auth->get_user($p->person_responsible);
                                                       $i++;
                                                       ?>
                                                      <tr>
                                                          <td><?php echo $i; ?> </td>
                                                          <td><?php echo date('d M Y', $p->date); ?></td>
                                                          <td><?php echo $items [$p->item]; ?></td>
                                                          <td><?php echo $category [$p->item]; ?></td>
                                                          <td ><?php echo number_format($p->quantity); ?></td>
                                                          <td ><?php echo number_format($p->unit_price); ?></td>
                                                          <td ><?php echo number_format($p->total); ?></td>
                                                          <td><?php echo $supplier[$p->supplier]; ?></td>

                                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>

                                                      </tr>

         <?php } ?>
                                             </tbody>
                                         </table>
                                         <hr />

                                         <div class="col-md-12 ">
                                             <br>
                                             <h1 class="panel-title right">Total Assets Cost KES <abbr  ><?php echo number_format($get_specific_cost, 2); ?> </abbr  > </h1>
                                             </br>

                                         </div>

                                    <?php
                                    }
                                    else
                                    {
                                         ?>
                                         <h3 class="panel-title"> No Assets recorded at the moment !!</h3>
    <?php } ?>


                            </div>


                            <!-- end: BORDERED TABLE PANEL -->


                        </div>

                    </div>

                </div>



                <div class="row">

                    <div class="col-md-12">
                        <!-- start: TILTED PIE PANEL -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="icon-external-link-sign"></i>
                                Assets Stock Out
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

<?php if ($assets)
    {
         ?>
                                         <table class="table table-condensed table-hover" id="">
                                             <thead>
                                                 <tr>
                                                     <th class="center ">#</th>
                                                     <th>Date</th>
                                                     <th>Item Name</th>
                                                     <th>Category</th>
                                                     <th>Stock In</th>
                                                     <th>Stock Out</th>
                                                     <th>Remaining Stock</th>
                                                     <th>Total Cost</th>
                                                     <th>Taken By</th>

                                                 </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $i = 0;
                                                  foreach ($assets as $p)
                                                  {
                                                       $u = $this->ion_auth->get_user($p->created_by);
                                                       $i++;
                                                       ?>
                                                      <tr>
                                                          <td><?php echo $i; ?> </td>
                                                          <td><?php echo date('d M Y', $p->date); ?></td>
                                                          <td><?php echo $items [$p->asset_name]; ?></td>
                                                          <td><?php echo $category [$p->asset_name]; ?></td>
                                                          <td ><?php echo number_format($quantity_in[$p->asset_name]); ?></td>
                                                          <td ><?php
                                                               $gnty = $quantity_in[$p->asset_name];
                                                               $rem = 0;
                                                               if (!empty($rem_stock[$p->asset_name]))
                                                               {
                                                                    $rem = $rem_stock[$p->asset_name];
                                                                    $rem_q = $gnty - $rem;
                                                                    echo number_format($rem_q);
                                                               }
                                                               else
                                                               {
                                                                    echo 0;
                                                               }
                                                               ?></td>
                                                          <td ><?php
                                                              if (!empty($rem_stock[$p->asset_name]))
                                                                   echo number_format($rem_stock[$p->asset_name]);
                                                              else
                                                                   echo number_format($quantity_in[$p->asset_name]);
                                                              ?></td>

                                                          <td><?php echo $item_cost[$p->asset_name]; ?></td>

                                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>

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
                        <!-- end: TILTED PIE PANEL -->
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
