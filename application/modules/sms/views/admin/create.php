<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Sms </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/sms/create', '<i class="icon-plus-sign-alt"></i> <span> Send SMS</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/sms', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'SMSs')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>

        <div class="panel-body" style="display: block;">    


            <div class='clearfix'></div>

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
                        'group' => 'Custom Group',
                );
            ?>


            <div class="col-sm-8">
                <div class="form-group">
                    <label class='col-sm-3 control-label' for='recipient'> </label>
                    <div class="col-sm-9">

                        <?php echo form_dropdown('send_to', $items, $result->send_to, ' data-placeholder="Send To:" onchange="show_field(this.value)" id="send_to" class="form-control search-select"  tabindex="4"'); ?>

                    </div>
                </div>


                <div class="form-group" id="rc_staff">
                    <label class='col-sm-3 control-label' for='recipient'> Select Staff Member</label>
                    <div class="col-sm-9">
                        <span class="top title"></span>
                        <?php
                            echo form_dropdown('staff', array('' => 'Select Staff') + $staff, (isset($result->staff)) ? $result->staff : '', ' class="form-control search-select"  ');
                            echo form_error('staff');
                        ?>
                    </div>
                </div> 
                <div class="form-group" id="rc_member">
                    <label class='col-sm-3 control-label' for='recipient'>Select Member </label>
                    <div class="col-sm-9">
                        <span class="top title"></span>
                        <?php
                            echo form_dropdown('member', array('' => 'Select Member') + (array) $members, (isset($result->member)) ? $result->member : '', ' class="form-control search-select" ');
                            echo form_error('member');
                        ?>
                    </div>
                </div> 



                <div class="form-group" id="rc_ministry">
                    <label class='col-sm-3 control-label' for='recipient'> Select Ministry</label>
                    <div class="col-sm-9">
                        <span class="top title"></span>
                        <?php
                            echo form_dropdown('ministry', array('' => 'Select Ministry') + (array) $ministries, (isset($result->ministry)) ? $result->ministry : '', ' class="form-control search-select" ');
                            echo form_error('ministry');
                        ?>
                    </div>
                </div> 

                <div class="form-group" id="rc_hbcs">
                    <label class='col-sm-3 control-label' for='recipient'>Select HBC </label>
                    <div class="col-sm-9">
                        <span class="top title"></span>
                        <?php
                            echo form_dropdown('hbc', array('' => 'Select HBC') + (array) $hbcs, (isset($result->hbc)) ? $result->hbc : '', ' class="form-control search-select" ');
                            echo form_error('hbc');
                        ?>
                    </div>
                </div> 
                <div class="mbm" id="rc_grp"> 
                    <label class='col-sm-3 control-label' for='recipient'>Custom Group</label>
                    <div class="col-sm-9">
                         <?php
                             echo form_dropdown('group', array('' => 'Select Group') + $groups, (isset($result->group)) ? $result->group : '', ' class="form-control search-select" ');
                             echo form_error('group');
                         ?>
                    </div>

                </div>
                <div class="clearfix"></div>				
                <div class="form-group">
                    <br>
                    <br>
                    <label class='col-sm-3 control-label' for='recipient'> </label>
                    <div class="col-sm-9">
                         <?php
                             echo form_textarea(
                                          array(
                                                  'name' => 'message',
                                                  'rows' => '6',
                                                  'placeholder' => "Message to be sent",
                                                  'maxlength' => "320",
                                                  'id' => 'message',
                                                  'class' => 'form-control',
                                          )
                             );
                             echo form_error('message');
                         ?>
                    </div>
                </div>


                <div class="form-group" style="display:none">
                    <label class='col-sm-6 control-label' for='recipient'> </label>
                    <div class="col-sm-2 input-group">


                        <?php
                            $items = array('draft' => 'draft');
                            echo form_dropdown('status', array('' => 'Save as') + (array) $items, (isset($result->status)) ? $result->status : '', ' class="form-control" ');
                            echo form_error('status');
                        ?>


                    </div>
                </div>
            </div>
            <div class="col-sm-4">	
                <div class="form-group" id="rc_multiple">
                    <label class='col-sm-3 control-label' for='recipient'>Select Members </label>
                    <div class="col-sm-8">
                        <span class="top title"></span>
                        <?php
                            echo form_dropdown('members[]', $members, (isset($result->members)) ? $result->members : '', 'multiple="multiple" placeholder="Select Member" class="form-control search-select"');
                            echo form_error('members');
                        ?>
                    </div>
                </div> 
            </div>
            <div class="clearfix"></div>				
            <hr>

            <div class='form-group'>
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/sms', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
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
<?php if ($this->uri->segment(3) == 'create')
    {
         ?>
              show_field('None');
    <?php } ?>
</script>