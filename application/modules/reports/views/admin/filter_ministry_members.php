<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h4 class="panel-title">All Ministries </h4>

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


                <?php if ($ministries): ?>
                         <div class='clearfix'></div>
                         <table class="table table-condensed table-hover" id="sample-table-3">        	
                             <thead>
                             <th>#</th>
                             <th>Code</th>
                             <th>Name</th>
                             <th>Leader</th>
                             <th>Telephone</th>
                             <th>Mobile</th>
                             <th>Email</th>
                             <th>Max Size</th>
                             <th  class="btns"></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($ministries as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td width="70"><?php echo $p->code; ?></td>
                                          <td><?php echo ucwords($p->name); ?></td>
                                          <td> <?php echo ucwords($leader[$p->leader]); ?></td>
                                          <td><?php echo $p->telephone; ?></td>
                                          <td><?php echo $p->mobile; ?></td>
                                          <td><?php echo $p->email; ?></td>
                                          <td><?php echo $p->congregation_size; ?></td>
                                          <td class="btns">
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-success  btn-sm'  href='<?php echo site_url('admin/reports/ministry_members/' . $p->id); ?>'>
                                                          <i class='icon-chevron-right'></i> View Members 
                                                      </a>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                 <?php endforeach ?>
                             </tbody>

                         </table>

                         <?php echo $links; ?>
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

