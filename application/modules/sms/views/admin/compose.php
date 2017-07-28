<!-- start: BOOTSTRAP EXTENDED MODALS -->
<div id="create_" class="modal fade" tabindex="-1" data-width="760" style="display: none;">

    <?php
        $attributes = array('class' => 'form-horizontal', 'id' => '');
        echo form_open_multipart('admin/sms/create', $attributes);
    ?>
    <?php
        $items = array(
                '' => 'Send To:',
                'all members' => 'All Members',
                'multiple members' => 'Multiple Members Members',
                'church member' => 'A Church Member',
                'all staff' => 'All Staff Members',
                'staff member' => 'Staff Member',
                'ministry' => 'To Ministry',
                'hbc' => 'To HBC',
                'group' => 'To Custom Group',
        );
    ?>

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            &times;
        </button>
        <h4 class="modal-title">Message Details</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-5">



                <p>
                     <?php echo form_dropdown('send_to', $items, $result->send_to, ' data-placeholder="Send To:" onchange="show_field(this.value)" id="send_to"  class="form-control search-select"  tabindex="4"'); ?>


                </p>



            </div>
            <div class="col-md-7">
                <p id="rc_staff" >
                     <?php
                         echo form_dropdown('staff', array('' => 'Select Staff') + $staff, (isset($result->staff)) ? $result->staff : '', ' class="form-control search-select"  ');
                         echo form_error('staff');
                     ?>
                </p>

                <p id="rc_member" >
                     <?php
                         echo form_dropdown('member', array('' => 'Select Member') + (array) $mms, (isset($result->member)) ? $result->member : '', ' class="form-control search-select" ');
                         echo form_error('member');
                     ?>
                </p>

                <p id="rc_ministry" >
                     <?php
                         echo form_dropdown('ministry', array('' => 'Select Ministry') + (array) $mins, (isset($result->ministry)) ? $result->ministry : '', ' class="form-control search-select" ');
                         echo form_error('ministry');
                     ?>
                </p>
                <p id="rc_hbcs" >
                     <?php
                         echo form_dropdown('hbc', array('' => 'Select HBC') + (array) $hbs, (isset($result->hbc)) ? $result->hbc : '', ' class="form-control search-select" ');
                         echo form_error('hbc');
                     ?>
                </p>
                <p id="rc_multiple" >
                     <?php
                         echo form_dropdown('members[]', $mms, (isset($result->members)) ? $result->members : '', 'multiple="multiple" placeholder="Select Member" class="form-control search-select" ');
                         echo form_error('members');
                     ?>
                </p>

                <div class="mbm" id="rc_grp"> 
                     <?php
                         echo form_dropdown('group', array('' => 'Select Group') + $groups, (isset($result->group)) ? $result->group : '', ' class="form-control search-select" ');
                         echo form_error('group');
                     ?>
                </div>



            </div>
        </div>

    </div>
    <div class="modal-footer">

        <?php
            echo form_textarea(
                         array(
                                 'name' => 'message',
                                 'rows' => '10',
                                 'placeholder' => "Message to be sent",
                                 'maxlength' => "320",
                                 'id' => 'message',
                                 'class' => 'form-control',
                         )
            );
            echo form_error('message');
        ?>
        <p style="display:none">
             <?php
                 $items = array('draft' => 'draft');
                 echo form_dropdown('status', array('' => 'Save as') + (array) $items, (isset($result->status)) ? $result->status : '', ' class="form-control col-sm-2"');
                 echo form_error('status');
             ?>
        </p>
        <p>

            <br>
            <?php echo form_submit('submit', ($updType == 'edit') ? 'Update Message' : 'Send Message', (($updType == 'create') ? "id='submit' class='btn btn-primary''" : "id='submit' class='btn btn-primary'")); ?>
            <button type="button" data-dismiss="modal" class="btn btn-danger">
                Close
            </button>
        </p>
    </div>
    <?php echo form_close(); ?>	
</div>

<div class="col-sm-12">

    <div class="btn-group">

        <button class=" btn btn-sm  
        <?php
            if ($bal->balance > 5)
                 echo 'btn-beige';
            else
                 echo 'btn-danger';
        ?>">
            <i class=' clip-question-2'></i> NOTE
        </button> 

        <button class="btn btn-sm btn-dark-grey">Your SMS Account Balance is <span style="text-decoration:underline;
                                                                                   font-weight:bold;"><?php echo $bal->balance; ?></span> SMS</button>
                                                                                   <?php if (!$bal->balance == 0)
                                                                                       {
                                                                                            ?>
                 <button href="#create_" data-toggle="modal" class=" btn btn-sm btn-success">
                     <i class="clip-bubble-3"></i> Send SMS
                 </button> 
    <?php } ?>                 
    </div>


    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Sms </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php
                         if (!$bal->balance == 0)
                         {
                              ?>
                             <a href="#create_" data-toggle="modal" class=" btn btn-primary">
                                 <i class='icon-comments-alt'></i> <i class='icon-envelope'></i> Send Message
                             </a> 
                        <?php } ?>   
<?php echo anchor('admin/sms', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'SMSs')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


<?php if ($sms): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Date</th>
                             <th>Sent To</th>
                             <th>Status</th>
                             <th>Message</th>
                             <th></th>
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($sms as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo date('d M Y', $p->created_on); ?></td>
                                          <td><?php echo ucwords($p->sent_to); ?></td>
                                          <td><?php if ($p->status == 1) echo '<span class="label label-warning">Sent</span>'; ?></td>
                                          <td><?php echo substr($p->message, 0, 50) . '...'; ?></td>
                                          <td><?php
                                               $tm = explode(' ', time_ago($p->created_on));
                                               if (time_ago($p->created_on) == 'Yesterday')
                                               {
                                                    echo '<span class="label label-inverse">' . time_ago($p->created_on) . '</span>';
                                               }
                                               elseif ($tm[1] == 'days')
                                               {
                                                    echo '<span class="label label-orange">' . time_ago($p->created_on) . '</span>';
                                               }
                                               else
                                               {
                                                    echo '<span class="label label-info">' . time_ago($p->created_on) . '</span>';
                                               }
                                               ?>
                                          </td>
                                          <td width='100'>
                                              <div>
                                                  <a href="#View_<?php echo $p->id; ?>" data-toggle="modal" class=" btn-sm btn-success">
                                                      <i class='icon-share'></i> View Details
                                                  </a>

                                              </div>
                                          </td>
                                      </tr>



                                      <!-- start: BOOTSTRAP EXTENDED MODALS -->
                                  <div id="View_<?php echo $p->id; ?>" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                              &times;
                                          </button>
                                          <h4 class="modal-title">Message Details</h4>
                                      </div>
                                      <div class="modal-body">
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <h4>Details</h4>
                                                  <p>
                                                      <span class="vvtitle">Date: </span> <?php echo date('d M Y', $p->created_on); ?>
                                                  </p>
                                                  <p>
                                                      <span class="vvtitle">Sent To: </span> <?php echo ucwords($p->sent_to); ?>
                                                  </p>
                                                  <p>
                                                      <span class="vvtitle">SMS Status: </span> <?php echo '<span class="label label-warning">Sent</span>'; ?>
                                                  </p>

                                                  <p>
                                                      <span class="vvtitle">Time counter: </span> 
                                                      <?php
                                                      $tm = explode(' ', time_ago($p->created_on));
                                                      if (time_ago($p->created_on) == 'Yesterday')
                                                      {
                                                           echo '<span class="label label-inverse">' . time_ago($p->created_on) . '</span>';
                                                      }
                                                      elseif ($tm[1] == 'days')
                                                      {
                                                           echo '<span class="label label-orange">' . time_ago($p->created_on) . '</span>';
                                                      }
                                                      else
                                                      {
                                                           echo '<span class="label label-info">' . time_ago($p->created_on) . '</span>';
                                                      }
                                                      ?>
                                                  </p>


                                              </div>
                                              <div class="col-md-6">
                                                  <h4>Recipient(s)</h4><p>
                                                       <?php
                                                       $members = $this->sms_m->by_group($p->group_type);
                                                       $j = 0;
                                                       foreach ($members as $mm):

                                                            $m = $this->ion_auth->get_single_member($mm->recipient);
                                                            if ($mm->sent_to == 'all staff')
                                                            {
                                                                 $m = $this->ion_auth->get_user($mm->recipient);
                                                            }
                                                            elseif ($mm->sent_to == 'staff member')
                                                            {
                                                                 $m = $this->ion_auth->get_user($mm->recipient);
                                                            }
                                                            elseif ($p->sent_to == 'church visitor')
                                                            {
                                                                 $m = $this->ion_auth->get_single_visitor($p->recipient);
                                                            }

                                                            $j++;
                                                            ?>

                                                           <?php echo '<b>(' . $j . ').</b> ' . $m->first_name . ' ' . $m->last_name . ' '; ?>

              <?php endforeach ?></p>

                                              </div>
                                              <div class="clearfix"></div>
                                              <p>
                                                  <span class="vvtitle">Message: </span> <br><?php echo $p->message; ?>

                                              </p>
                                          </div>
                                      </div>
                                      <div class="modal-footer">

                                          <button type="button" data-dismiss="modal" class="btn btn-danger">
                                              Close
                                          </button>

                                      </div>
                                  </div>

         <?php endforeach ?>
                             </tbody>

                         </table>

         <?php // echo $links;      ?>
                     </div>
                 </div><?php else: ?>
                 <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?>
    </div>
</div>




<script>
     function show_field(item)
     {
          //hide all

          //document.getElementById('cc').style.display='none';
          document.getElementById('rc_staff').style.display = 'none';
          document.getElementById('rc_member').style.display = 'none';
          document.getElementById('rc_ministry').style.display = 'none';
          document.getElementById('rc_hbcs').style.display = 'none';
          document.getElementById('rc_multiple').style.display = 'none';
          document.getElementById('rc_grp').style.display = 'none';

          if (item == 'staff member')
               document.getElementById('rc_staff').style.display = 'block';
          if (item == 'church member')
               document.getElementById('rc_member').style.display = 'block';
          if (item == 'ministry')
               document.getElementById('rc_ministry').style.display = 'block';
          if (item == 'hbc')
               document.getElementById('rc_hbcs').style.display = 'block';
          if (item == 'multiple members')
               document.getElementById('rc_multiple').style.display = 'block';
          if (item == 'group')
               document.getElementById('rc_grp').style.display = 'block';

          return;

     }
<?php
    if ($this->uri->segment(3) == 'compose')
    {
         ?>
              show_field('None');
    <?php } ?>
</script>