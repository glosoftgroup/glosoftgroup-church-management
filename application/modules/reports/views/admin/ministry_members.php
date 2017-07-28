<div class="col-sm-12">



    <div class='clearfix'></div>	
    <div class="panel panel-default"> 

        <div class="panel-heading">

            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo $title; ?> </h3>
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

                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                    echo form_open_multipart('admin/reports/ministry_search', $attributes);
                ?>


                <div class="input-group ">
                     <?php
                         echo form_dropdown('ministry_id', array('' => 'Search Ministry') + $ministries, (isset($result->ministry_id)) ? $result->ministry_id : '', ' id="ministry_id" class="form-control search-select1" data-placeholder="Select Options..." ');
                     ?>
                    <span class="input-group-btn" style="width:300px !important;">
                        <button type="submit" class="btn btn-success">
                            <i class="icon-search"></i>
                            View Members
                        </button> </span>
                </div>

                <?php echo form_close(); ?>	

                <div class='clearfix'></div>
                <hr>



                <?php if ($members): ?>
                         <div class='clearfix'></div>

                         <h3 class="panel-title details-title" style="display:none"><?php echo $title; ?> <hr></h3>



                         <table class="table table-condensed table-hover" id="sample-table-3">     

                             <thead>
                                 <tr>
                                     <th>#</th>

                                     <th>Name</th>
                                     <th>Date Joined</th>
                                     <th>Gender</th>
                                     <th>Mobile</th>
                                     <th>Email</th>
                                     <th>Location</th>
                                     <th>Status</th>

                                 </tr>
                             </thead>
                             <tbody>
                                  <?php
                                  $j = 1;

                                  foreach ($members as $p):

                                       $u = $this->ion_auth->get_single_member($p->member_id)
                                       ?>
                                      <tr>
                                          <td><?php echo $j . '.'; ?></td>

                                          <td><?php echo $u->title . ' ' . $u->first_name . ' ' . $u->last_name; ?></td>
                                          <td><?php echo date('d M Y', $u->date_joined); ?></td>
                                          <td><?php echo $u->gender; ?></td>
                                          <td><?php
                                               $ph = $u->phone1;
                                               $cha = array('(', ')', '-');
                                               $sp = array('', '', '');
                                               echo str_replace($cha, $sp, $ph);
                                               ?></td>

                                          <td><?php echo $u->email; ?></td>
                                          <td><?php echo $u->location; ?></td>
                                          <td><?php echo ucwords($u->member_status); ?></td>


                                      </tr>
                                      <?php $j++;
                                 endforeach
                                 ?>
                             </tbody>

                         </table>

                     </div>
                 </div>
             </div>
         </div>

    <?php else: ?>
         <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?>


<style>
    @media print{

         .modal-header{

              display:none !important;
         }

         .input-group{

              display:none !important;
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

