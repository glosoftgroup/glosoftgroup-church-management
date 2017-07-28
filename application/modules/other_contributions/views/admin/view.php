<div class="col-sm-12 main-rec">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Other Contributions Per Member </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/other_contributions/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Other Contributions')) . '</span>', 'class="btn btn-primary"'); ?> 

                    <?php echo anchor('admin/other_contributions', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Other Contributions')) . '</span>', 'class="btn btn-info"'); ?> 

                    <?php echo anchor('admin/other_contributions/voided', '<i class="icon-list-alt"></i> <span> Voided Other Contributions</span>', 'class="btn btn-warning"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">

                <div class="col-sm-7">
                     <?php if ($members_other_contributions): ?>

                             <h3>Collection Date <span style="color:blue; text-decoration:underline"><?php echo date('d M Y', $post->date); ?></span></h3>
                             <hr />

                             <div class='clearfix'></div>
                             <table class="table table-striped table-bordered table-hover table-full-width" id="sample_2">

                                 <thead>
                                 <th>#</th>
                                 <th>Member</th>
                                 <th>Amount</th>
                                 <th>Type</th>
                                 <th ><?php echo lang('web_options'); ?></th>
                                 </thead>
                                 <tbody>
                                      <?php
                                      $i = 0;

                                      foreach ($members_other_contributions as $p):
                                           $i++;
                                           if ($i == 6)
                                                break;
                                           ?>
                                          <tr>
                                              <td><?php echo $i . '.'; ?></td>					

                                              <td><?php echo $members[$p->member_id]; ?></td>				
                                              <td><?php echo number_format($p->amount, 2); ?></td>
                                              <td><?php echo $p->type; ?></td>


                                              <td width=''>
                                                  <div>
                                                      <div class='btn-group'>
                                                          <a data-toggle="modal" class='btn btn-success btn-sm' role="button" href="#Receipt<?php echo $p->id; ?>">
                                                              <i class='icon-share'></i> Receipt
                                                          </a>

                                                          <a class='btn btn-danger btn-sm' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/other_contributions/void/' . $p->id . '/' . $page); ?>'>
                                                              <i class='icon-share'></i> Void Tithe
                                                          </a>
                                                      </div>
                                                  </div>
                                              </td>
                                          </tr>
                                     <?php endforeach ?>
                                 </tbody>

                             </table>

                             <?php echo $links; ?> 
                        <?php else: ?>
                             <p class='text'><?php echo lang('web_no_elements'); ?></p>
                    <?php endif ?>

                </div>

                <div class="col-sm-5">                     
                     <?php if ($other_contributions): ?>

                             <h3>List of Other Contributions</h3>
                             <hr />
                             <div class='clearfix'></div>
                             <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                                 <thead>
                                 <th>#</th>
                                 <th>Date</th>				
                                 <th>Total</th>

                                 <th ><?php echo lang('web_options'); ?></th>
                                 </thead>
                                 <tbody>
                                      <?php
                                      $i = 0;

                                      foreach ($other_contributions as $p):
                                           $i++;
                                           if ($i == 6)
                                                break;
                                           ?>
                                          <tr>
                                              <td><?php echo $i . '.'; ?></td>					
                                              <td><?php echo date('d M Y', $p->date); ?></td>				
                                              <td><?php echo number_format($p->totals, 2); ?></td>

                                              <td width=''>
                                                  <div>
                                                      <div class='btn-group'>

                                                          <a class='btn btn-success btn-sm' href='<?php echo site_url('admin/other_contributions/view_members/' . $p->id . '/' . $page); ?>'>
                                                              <i class='icon-share'></i> View Members
                                                          </a>
                                                      </div>
                                                  </div>
                                              </td>
                                          </tr>
                                     <?php endforeach ?>
                                 </tbody>

                             </table>

                             <?php echo $links; ?> 
                        <?php else: ?>
                             <p class='text'><?php echo lang('web_no_elements'); ?></p>
                    <?php endif ?>
                </div>

            </div>
        </div>
    </div>
</div>


<?php
    foreach ($members_other_contributions as $p):
         ?>

         <!---------------BEGIN MODAL--------------------->
         <div class="modal fade" id="Receipt<?php echo $p->id; ?>" tabindex="-1" data-width="1000" role="dialog" aria-hidden="true">

             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                         &times;
                     </button>
                     <h4 class="modal-title">
                         <button onClick="window.print();return false" class="btn btn-success" type="button"><span class="icon-print"></span> Print </button>
                         <a href="#" class="btn btn-info" type="button"><span class="icon-envelope"></span> Email Receipt </a>
                     </h4>
                 </div>
                 <div class="modal-body">
                      <?php
                      $post = $this->other_contributions_m->get_member_giving($p->id);
                      $member = $this->ion_auth->get_single_member($p->member_id);
                      ?>		 
                     <div class=" receipt"> 

                         <div class="col-sm-12">
                             <div class="col-sm-8">

                                 <span >
                                      <?php
                                      $ch = $this->settings;
                                      ?>
                                     <img src="<?php echo site_url('uploads/files/' . $ch->file); ?>">

                                 </span>
                                 <span class="receipt-title">

                                     Tithe Receipt </span>
                             </div>
                             <div class="col-sm-4 ref">
                                 Receipt No. <abbr ><?php echo '00' . $post->id; ?></abbr ><br>
                                 Date <abbr ><?php echo date('d M Y', $post->created_on); ?></abbr >
                             </div>

                         </div>
                         <div class="clearfix"></div>

                         <div class="col-sm-12">
                             Received From <abbr ><?php echo $member->title . ' ' . $member->first_name . ' ' . $member->last_name . ' [ Code: ' . $member->member_code . ' ]'; ?></abbr> The Amount of KES <abbr  ><?php echo number_format($post->amount, 2) ?></abbr > 
                             Being given as <abbr  >Thanks Giving</abbr >

                         </div>

                         <div class="clearfix"></div>
                         <div class="col-sm-12">
                             <br>
                             Amount in words: <abbr  ><?php
                                  $words = convert_number_to_words($post->amount);
                                  echo ucwords($words);
                                  ?> Kenyan Shilling Only </abbr>
                             <br>
                             <span class="pull-right">Payment Method: <abbr style="text-decoration:line-through" ><?php echo $post->type ?> </abbr  ></span>
                         </div>

                         <div class="col-sm-12 center">
                             <hr>				
                             <span class="center" style="font-size:0.8em !important;text-align:center !important;">
                                 Thank you for supporting the ministry<br>
                                 <?php echo $ch->address . ' Tel ' . $ch->phone . ' Email ' . $ch->email; ?></span>
                         </div>


                     </div>

                 </div>
                 <div class="modal-footer">
                     <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">
                         Close
                     </button>

                 </div>

             </div>
         </div>


         <!---------------END MODAL--------------------->

    <?php endforeach ?>



<style>
    @media print{

         .modal-header{

              display:none !important;
         }

         .modal-footer{

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
              sroll:none;

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

<script>

     $(document).ready(function ()
     {
          $('div').removeClass('modal-scrollable');
     });



</script>