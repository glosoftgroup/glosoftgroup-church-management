


<!-- start: BOOTSTRAP EXTENDED MODALS -->
<div id="responsive" class="modal fade" tabindex="-1" data-width="760" style="display: none;">

    <?php
        $attributes = array('class' => 'form-horizontal', 'id' => '');
        echo form_open_multipart(current_url(), $attributes);
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
                     <?php echo form_dropdown('send_to', $items, $emails_m->send_to, ' data-placeholder="Send To:" onchange="show_field(this.value)" id="send_to"  class="form-control search-select"  tabindex="4"'); ?>


                </p>

            </div>
            <div class="col-md-7">
                <p id="rc_staff" >
                     <?php
                         echo form_dropdown('staff', array('' => 'Select Staff') + $staff, (isset($emails_m->staff)) ? $emails_m->staff : '', ' class="form-control search-select"  ');
                         echo form_error('staff');
                     ?>  <b class='btn btn-primary cc'>Add Cc</b>
                </p>

                <p id="rc_member" >
                     <?php
                         echo form_dropdown('member', array('' => 'Select Parent') + (array) $members, (isset($emails_m->member)) ? $emails_m->member : '', ' class="form-control search-select" ');
                         echo form_error('member');
                     ?><b class='btn btn-primary cc'>Add Cc</b>
                </p>

                <p id="rc_ministry" >
                     <?php
                         echo form_dropdown('ministry', array('' => 'Select Ministry') + (array) $ministries, (isset($result->ministry)) ? $result->ministry : '', ' class="form-control search-select" ');
                         echo form_error('ministry');
                     ?>
                    <b class='btn btn-primary cc'>Add Cc</b>
                </p>
                <p id="rc_hbcs" >
                     <?php
                         echo form_dropdown('hbc', array('' => 'Select HBC') + (array) $hbcs, (isset($result->hbc)) ? $result->hbc : '', ' class="form-control search-select" ');
                         echo form_error('hbc');
                     ?>
                    <b class='btn btn-primary cc'>Add Cc</b>
                </p>
                <p id="rc_multiple" >
                     <?php
                         echo form_dropdown('members[]', $members, (isset($result->members)) ? $result->members : '', 'multiple="multiple" class="form-control search-select" placeholder="Select Member"');
                         echo form_error('members');
                     ?>
                    <b class='btn btn-primary cc'>Add Cc</b>
                </p>



            </div>
        </div>

    </div>
    <div class="modal-footer">
         <?php echo form_input('cc', $emails_m->cc, 'id="cc" placeholder="cc"  class="form-control"  '); ?>
         <?php echo form_error('cc'); ?>
         <?php echo form_input('subject', $emails_m->subject, 'id="subject_" placeholder="Subject" class="form-control" '); ?>
         <?php echo form_error('subject'); ?>

        <?php
            echo form_textarea(
                         array(
                                 'name' => 'description',
                                 'rows' => '10',
                                 'placeholder' => "Message to be sent",
                                 'maxlength' => "320",
                                 'id' => 'description',
                                 'class' => 'form-control',
                         )
            );
            echo form_error('description');
        ?>
        <p style="display:none">
             <?php
                 $items = array('draft' => 'draft');
                 echo form_dropdown('status', array('' => 'Save as') + (array) $items, (isset($emails_m->status)) ? $emails_m->status : '', ' class="form-control col-sm-2"');
                 echo form_error('status');
             ?>
        </p>
        <input type="file" name="attachment" class=""/>
        <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Send Mail', (($updType == 'create') ? "id='submit' class='btn btn-primary''" : "id='submit' class='btn btn-primary'")); ?>
        <button type="button" data-dismiss="modal" class="btn btn-danger">
            Close
        </button>

    </div>
    <?php echo form_close(); ?>	
</div>

<div class="col-md-12">

    <div class="head dark">

        <button href="#responsive" data-toggle="modal" class=" btn btn-success">
            <i class='icon-comments-alt'></i> <i class='icon-envelope'></i> Compose
        </button> 
    </div>

    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Inbox</h3>
            <div class="heading-elements">

                <div class="btn-group">

                    <button class="btn btn-small btn-primary tip" title="Forward"><span class="icon-share-alt icon-white"></span></button>
                    <button class="btn btn-small btn-primary tip" title="Reply"><span class="icon-arrow-right icon-white"></span></button>
                    <button class="btn btn-small btn-warning tip" title="Spam"><span class="icon-warning-sign icon-white"></span></button>
                </div> 
                <button class="btn btn-small btn-danger tip" title="Remove"><span class="icon-trash icon-white"></span></button>

                <div class="btn-group">                                
                    <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">More <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Forward all</a></li>
                        <li><a href="#">Reply to all</a></li>                                    
                        <li class="divider"></li>
                        <li><a href="#">Mask as unread</a></li>
                        <li><a href="#">Mask as read</a></li>
                    </ul>
                </div>

                <div class="right TAR">
                    <button class="btn btn-small"><span class="icon-book"></span> Contacts</button>
                </div>
            </div>
        </div>    					

        <div class="panel-body" style="display: block;">   
            <div class="widget-main">
                 <?php if ($emails): ?>

                         <table class="table table-striped table-hover table-full-width" id="sample_1">
                             <thead>
                                 <tr>
                                     <th><input type="checkbox" class="checkall"/></th>
                                     <th width="30%">Message From</th>
                                     <th width="40%">Description</th>
                                     <th width="15%">Date</th>
                                     <th width="15%">Attachment</th>
                                     <th width="15%"></th>
                                 </tr>
                             </thead>
                             <tbody>
                                  <?php $i = 1;
                                  foreach ($emails as $emails_m): $user = $this->ion_auth->get_user($emails_m->created_by)
                                       ?>
                                      <tr class="new">
                                          <td><input type="checkbox" name="checkbox"/></td>
                                          <td>
                                              <i class="icon-stackexchange"> </i>
                                              <a href="#" class="name"> <?php echo $user->first_name . ' ' . $user->last_name; ?></a> <a href="#"><?php echo $user->email; ?></a>
                                          </td>
                                          <td><?php echo '<b style="text-decoration:underline">REF: ' . $emails_m->subject . '</b><br> ' . substr($emails_m->description, 0, 70) . '...'; ?></td>
                                          <td><?php echo time_ago($emails_m->created_on); ?></td>
                                          <td><?php if (!empty($emails_m->attachment)): ?>
                                                   <a href='<?php echo base_url(); ?>uploads/files/<?php echo $emails_m->attachment ?>' />Download File</a>
                                              <?php else: ?>.....
              <?php endif ?>
                                          </td>
                                          <td>
                                              <a onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/emails/delete/' . $emails_m->id . '/' . $page); ?>' class="btn btn-sm btn-danger tip" title="Remove"><span class="icon-trash icon-white"></span></a>
                                          </td>
                                      </tr>
                                      <?php $i++;
                                 endforeach
                                 ?>                                                                       
                             </tbody>
                         </table>
                         <div class="toolbar bottom">

                             <div class="right">
                                 <div class="pagination pagination-right pagination-mini">
         <?php echo $links; ?>

                                 </div><br>

                             </div>

                         </div>
                     </div>
                 </div>




             </div>

        <?php else: ?>
             <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?> 




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


              document.getElementById('cc').style.display = 'none';

              $('.cc').click(function ()
              {
                   $('#cc').show();

              });


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

              return;

         }
<?php if ($this->uri->segment(3) == 'create')
    {
         ?>
                  show_field('None');
    <?php } ?>
    </script>


