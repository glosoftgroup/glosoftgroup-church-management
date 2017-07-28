<div class="panel-heading">
    <i class="icon-external-link-sign"></i>
    <h3 class="panel-title">Member Profile </h3>

    <div class="heading-elements">
        <div class="btn-group">
             <?php echo anchor('admin/members/create', '<i class="icon-plus-sign-alt"></i> <span> </span>', 'class="btn btn-primary"'); ?> 
             <?php echo anchor('admin/members', '<i class="icon-list"></i> <span></span>', 'class="btn btn-info"'); ?> 
        </div>
    </div>
</div>   
<div class="tabbable">
    <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">
        <li class="active">
            <a data-toggle="tab" href="#panel_overview">
                Overview
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#panel_edit_account">
                Edit Details
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#panel_kin_account">
                Relative | Next of Kin
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#panel_contributions">
                Contribution History
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#panel_sms">
                My Messages
            </a>
        </li>
        <div class="col-sm-4 panel-tools">
            <li class="heading-elements">
                 <?php
                     $attributes = array('class' => 'form-horizontal', 'id' => '');
                     echo form_open_multipart('admin/members/search', $attributes);
                 ?>


                <a class="input-group ">
                     <?php
                         echo form_dropdown('mem_id', array('' => 'Find Member') + $all_members, (isset($result->mem_id)) ? $result->mem_id : '', ' id="child_id" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?>
                    <span class="input-group-btn" style="">
                        <button type="submit" class="btn btn-success">
                            <i class="icon-search"></i>
                            View Details
                        </button> </span>
                </a>

                <?php echo form_close(); ?>	
            </li>
        </div>
    </ul>
    <div class="tab-content">
        <div id="panel_overview" class="tab-pane in active">
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <div class="user-left">
                        <div class="center">
                            <h5>Member From: <span style="color:blue"><?php echo date('d M Y', $p->date_joined); ?></span></h5>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="user-image">
                                    <div class="fileupload-new thumbnail">

                                        <?php if (empty($p->passport))
                                            {
                                                 ?>

                                                 <img src="<?php echo base_url('uploads/files/m1.png'); ?>" alt="">

                                            <?php
                                            }
                                            else
                                            {
                                                 ?>

                                                 <img alt="" src="<?php echo base_url('uploads/files/' . $p->passport); ?>" style="" class="" >
    <?php } ?>

                                    </div>

                                </div>
                            </div>
                            <h4><span style="color:blue"><?php echo $p->first_name . ' ' . $p->last_name; ?></span></h4>
                            <hr>
                        </div>
<?php if ($get_member_groups)
    {
         ?>

                                 <table class="table table-condensed table-hover">
                                     <thead>
                                         <tr>
                                             <th colspan="3">My Groups</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
         <?php foreach ($get_member_groups as $pp)
         {
              ?>
                                              <tr><td><a href="<?php echo base_url('admin/groups') ?>"><i class="icon-double-angle-right"></i>  <?php echo $groups[$pp->group_id]; ?></a></td></tr>
                                 <?php } ?>
                                     <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>

                                     </tbody>
                                 </table>
    <?php } ?>
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">My Home Based Church</th>
                                </tr>
                            </thead>
                            <tbody>
<?php echo isset($my_hbc[$p->hbc_id]) ? $my_hbc[$p->hbc_id] : ''; ?>
                            <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>

                            </tbody>
                        </table>

                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">My Ministries</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($mm as $mm)
                                    {
                                         ?>
         <?php echo $mini[$mm->ministry_id]; ?>
                                         </tr>
                                         <tr><td><hr></td><td><hr></td></tr>
    <?php } ?>

                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="col-sm-8 col-md-9">
                    <div class="col-md-4">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">Personal Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Name:</td>
                                    <td>
                                        <a href="#">
<?php echo ucwords($p->title . ' ' . $p->first_name . ' ' . $p->last_name); ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>

                                <tr>
                                    <td>Code</td>
                                    <td>
                                        <a href="">
<?php echo $p->member_code; ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>

                                <tr>
                                    <td>Gender</td>
                                    <td>
                                        <a href="">
<?php echo $p->gender; ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>

                                <tr>
                                    <td>ID No.</td>
                                    <td>
                                        <a href="">
<?php echo $p->id_no; ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>

                                    <td>Birthday</td>

                                    <td>
                                        <a href="">
<?php if ($p->dob) echo date('d M Y', $p->dob); ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Marital Status</td>
                                    <td>
                                        <a href="">
<?php echo ucwords($p->marital_status); ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Member Status</td>
                                    <td><span class="label label-sm label-info"><?php echo ucwords($p->member_status); ?></span></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>

                                <tr>
                                    <td>Date Joined</td>
                                    <td><span class="label label-sm label-warning"><?php echo date('d M Y', $p->date_joined); ?></span></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-condensed table-hover ">
                            <thead>
                                <tr>
                                    <th colspan="3">Contact Information</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Email:</td>
                                    <td>
                                        <a href="">
<?php echo $p->email; ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td><a href=""><?php echo $p->phone1 . '<br> ' . $p->phone2 ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Residential:</td>
                                    <td><a href=""><?php echo ucwords($p->location) ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Country:</td>
                                    <td><a href=""><?php echo ucwords($p->country) ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>County:</td>
                                    <td><a href=""><?php echo ucwords($p->county) ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td><a href=""><?php echo $p->address ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">Additional information</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Baptised</td>

                                    <td><a href=""><?php echo ucwords($p->baptised) ?></a></td>

                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Confirmed</td>

                                    <td><a href=""><?php echo ucwords($p->confirmed) ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>How Joined</td>

                                    <td><a href=""><?php echo ucwords($p->how_joined) ?></a></td>

                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Education Level</td>

                                    <td><a href=""><?php echo ucwords($p->education_level) ?></a></td>

                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>

                                <tr>
                                    <td>Occupation</td>

                                    <td><a href=""><?php echo ucwords($p->occupation) ?></a></td>

                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Employer</td>

                                    <td><a href=""><?php echo ucwords($p->employer) ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>


                    <div class="clearfix"></div>
                    <hr>
<?php echo $p->description ?>

                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <i class="clip-checkmark-2"></i>
                            Recent Contributions
                            <div class="heading-elements">
                                <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                                </a>
                                <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="btn btn-xs btn-link panel-refresh" href="#">
                                    <i class="fa fa-refresh"></i>
                                </a>
                                <a class="btn btn-xs btn-link panel-close" href="#">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body panel-scroll" style="height:800px">
                            <div class="col-md-6">
                                <h4>Recent Tithes </h4>
                                <table class="table table-condensed table-hover" id="sample-table-3">
                                    <thead>
                                        <tr>
                                            <th class="center">
                                                <div class="checkbox-table">
                                                    <label>
                                                        <input type="checkbox" class="flat-grey">
                                                    </label>
                                                </div></th>
                                            <th><i class="icon-calendar"></i> Date</th>
                                            <th class="hidden-xs">Amount</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

<?php
    $i = 0;
    foreach ($tithes as $th)
    {
         $i++;
         if ($i == 6)
              break;
         ?>
                                                 <tr>
                                                     <td class="center">
                                                         <div class="checkbox-table">
                                                             <label>
                                                                 <input type="checkbox" class="flat-grey">
                                                             </label>
                                                         </div></td>
                                                     <td><?php echo date('d M Y', $th->created_on); ?></td>
                                                     <td class="hidden-xs"><?php echo number_format($th->amount, 2); ?></td>


                                                     <td class="center hidden-xs"><span class=""><?php
                                                               $tm = explode(' ', time_ago($th->created_on));
                                                               if (time_ago($th->created_on) == 'Yesterday')
                                                               {
                                                                    echo '<span class="label label-inverse">' . time_ago($th->created_on) . '</span>';
                                                               }
                                                               elseif ($tm[1] == 'days')
                                                               {
                                                                    echo '<span class="label label-orange">' . time_ago($th->created_on) . '</span>';
                                                               }
                                                               else
                                                               {
                                                                    echo '<span class="label label-info">' . time_ago($th->created_on) . '</span>';
                                                               }
                                                               ?></span></td>
                                                 </tr>
    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4>Recent Thanks Giving </h4>
                                <table class="table table-condensed table-hover" id="sample-table-3">
                                    <thead>
                                        <tr>
                                            <th class="center">
                                                <div class="checkbox-table">
                                                    <label>
                                                        <input type="checkbox" class="flat-grey">
                                                    </label>
                                                </div></th>
                                            <th><i class="icon-calendar"></i> Date</th>
                                            <th class="hidden-xs">Amount</th>


                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

<?php
    $i = 0;
    foreach ($tg as $tgs)
    {
         $i++;
         if ($i == 6)
              break;
         ?>
                                                 <tr>
                                                     <td class="center">
                                                         <div class="checkbox-table">
                                                             <label>
                                                                 <input type="checkbox" class="flat-grey">
                                                             </label>
                                                         </div></td>
                                                     <td><?php echo date('d M Y', $tgs->created_on); ?></td>
                                                     <td class="hidden-xs"><?php echo number_format($tgs->amount, 2); ?></td>


                                                     <td class="center hidden-xs"><span class="label"><?php
                                                               $tm = explode(' ', time_ago($tgs->created_on));
                                                               if (time_ago($tgs->created_on) == 'Yesterday')
                                                               {
                                                                    echo '<span class="label label-inverse">' . time_ago($tgs->created_on) . '</span>';
                                                               }
                                                               elseif ($tm[1] == 'days')
                                                               {
                                                                    echo '<span class="label label-orange">' . time_ago($tgs->created_on) . '</span>';
                                                               }
                                                               else
                                                               {
                                                                    echo '<span class="label label-info">' . time_ago($tgs->created_on) . '</span>';
                                                               }
                                                               ?></span></td>
                                                 </tr>
    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <hr />
                                <h4>Recent Pledges </h4>
                                <table class="table table-condensed table-hover" id="sample-table-3">
                                    <thead>
                                        <tr>
                                            <th class="center">
                                                <div class="checkbox-table">
                                                    <label>
                                                        <input type="checkbox" class="flat-grey">
                                                    </label>
                                                </div></th>
                                            <th><i class="icon-calendar"></i> Title</th>
                                            <th class="hidden-xs">Amount</th>


                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
    $i = 0;
    foreach ($pl as $p)
    {
         $paids = (object) $p->paid;
         $i++;
         if ($i == 6)
              break;
         ?>
                                                 <tr>
                                                     <td class="center">
                                                         <div class="checkbox-table">
                                                             <label>
                                                                 <input type="checkbox" class="flat-grey">
                                                             </label>
                                                         </div></td>
                                                     <td><?php echo date('d M Y', $p->created_on); ?></td>
                                                     <td class="hidden-xs">
                                                          <?php
                                                          if ($p->status == 2)
                                                               echo number_format($paids->total);
                                                          else
                                                               echo number_format($p->amount, 2);
                                                          ?>
                                                     </td>

                                                     <td><?php
                                                          if ($p->status == 1)
                                                          {
                                                               echo '<span class="label label-warning"> Pending</span> ';

                                                               $now = time(); // or your date as well
                                                               $p_date = date('Y-m-d', $p->expected_pay_date);
                                                               $act_date = strtotime($p_date);
                                                               $datediff = $act_date - $now;
                                                               $days = floor($datediff / (60 * 60 * 24));
                                                               if ($days < 0)
                                                               {
                                                                    echo ' <span class="label label-danger"> Overdue </span>';
                                                               }
                                                               elseif (0 == $days)
                                                               {
                                                                    echo ' <span class="label label-info"> ' . $days . ' Days to go  </span>';
                                                               }
                                                               else
                                                               {
                                                                    echo ' <span class="label label-info">' . $days . ' Day(s) to go </span>';
                                                               }
                                                          }
                                                          elseif ($p->status == 2)
                                                          {
                                                               echo '<span class="label label-success">Paid</span>';
                                                          }
                                                          else
                                                          {
                                                               echo '<span class="label label-inverse">Voided</span>';
                                                          }
                                                          ?></td>


                                                 </tr>
    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <hr />
                                <h4>Recent Ministry Supports </h4> 
                                <table class="table table-condensed table-hover" id="sample-table-3">
                                    <thead>
                                        <tr>
                                            <th class="center">
                                                <div class="checkbox-table">
                                                    <label>
                                                        <input type="checkbox" class="flat-grey">
                                                    </label>
                                                </div></th>
                                            <th><i class="icon-calendar"></i> Date</th>
                                            <th class="hidden-xs">Amount</th>


                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

<?php
    $i = 0;
    foreach ($ms as $tgs)
    {
         $i++;
         if ($i == 6)
              break;
         ?>
                                                 <tr>
                                                     <td class="center">
                                                         <div class="checkbox-table">
                                                             <label>
                                                                 <input type="checkbox" class="flat-grey">
                                                             </label>
                                                         </div></td>
                                                     <td><?php echo date('d M Y', $tgs->created_on); ?></td>
                                                     <td class="hidden-xs"><?php echo number_format($tgs->amount, 2); ?></td>


                                                     <td class="center hidden-xs"><span class="label "><?php
                                                      $tm = explode(' ', time_ago($tgs->created_on));
                                                      if (time_ago($tgs->created_on) == 'Yesterday')
                                                      {
                                                           echo '<span class="label label-inverse">' . time_ago($tgs->created_on) . '</span>';
                                                      }
                                                      elseif ($tm[1] == 'days')
                                                      {
                                                           echo '<span class="label label-orange">' . time_ago($tgs->created_on) . '</span>';
                                                      }
                                                      else
                                                      {
                                                           echo '<span class="label label-info">' . time_ago($tgs->created_on) . '</span>';
                                                      }
                                                      ?></span></td>


                                                 </tr>
    <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <hr />
                                <h4>Recent Seed Planting </h4> 
                                <table class="table table-condensed table-hover" id="sample-table-3">
                                    <thead>
                                        <tr>
                                            <th class="center">
                                                <div class="checkbox-table">
                                                    <label>
                                                        <input type="checkbox" class="flat-grey">
                                                    </label>
                                                </div></th>
                                            <th><i class="icon-calendar"></i> Date</th>
                                            <th class="hidden-xs">Amount</th>


                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

<?php
    $i = 0;
    foreach ($sp as $tgs)
    {
         $i++;
         if ($i == 6)
              break;
         ?>
                                                 <tr>
                                                     <td class="center">
                                                         <div class="checkbox-table">
                                                             <label>
                                                                 <input type="checkbox" class="flat-grey">
                                                             </label>
                                                         </div></td>
                                                     <td><?php echo date('d M Y', $tgs->created_on); ?></td>
                                                     <td class="hidden-xs"><?php echo number_format($tgs->amount, 2); ?></td>


                                                     <td class="center hidden-xs"><span class="label"><?php
                                                    $tm = explode(' ', time_ago($tgs->created_on));
                                                    if (time_ago($tgs->created_on) == 'Yesterday')
                                                    {
                                                         echo '<span class="label label-inverse">' . time_ago($tgs->created_on) . '</span>';
                                                    }
                                                    elseif ($tm[1] == 'days')
                                                    {
                                                         echo '<span class="label label-orange">' . time_ago($tgs->created_on) . '</span>';
                                                    }
                                                    else
                                                    {
                                                         echo '<span class="label label-info">' . time_ago($tgs->created_on) . '</span>';
                                                    }
                                                    ?></span></td>


                                                 </tr>
    <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <hr />
                                <h4>Other Recent  Contributions </h4> 
                                <table class="table table-condensed table-hover" id="sample-table-3">
                                    <thead>
                                        <tr>
                                            <th class="center">
                                                <div class="checkbox-table">
                                                    <label>
                                                        <input type="checkbox" class="flat-grey">
                                                    </label>
                                                </div></th>
                                            <th><i class="icon-calendar"></i> Date</th>
                                            <th class="hidden-xs">Amount</th>


                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                      <?php
                                                          $i = 0;
                                                          foreach ($oc as $tgs)
                                                          {
                                                               $i++;
                                                               if ($i == 6)
                                                                    break;
                                                               ?>
                                                 <tr>
                                                     <td class="center">
                                                         <div class="checkbox-table">
                                                             <label>
                                                                 <input type="checkbox" class="flat-grey">
                                                             </label>
                                                         </div></td>
                                                     <td><?php echo date('d M Y', $tgs->created_on); ?></td>
                                                     <td class="hidden-xs"><?php echo number_format($tgs->amount, 2); ?></td>


                                                     <td class="center hidden-xs"><span class="label"><?php
                                        $tm = explode(' ', time_ago($tgs->created_on));
                                        if (time_ago($tgs->created_on) == 'Yesterday')
                                        {
                                             echo '<span class="label label-inverse">' . time_ago($tgs->created_on) . '</span>';
                                        }
                                        elseif ($tm[1] == 'days')
                                        {
                                             echo '<span class="label label-orange">' . time_ago($tgs->created_on) . '</span>';
                                        }
                                        else
                                        {
                                             echo '<span class="label label-info">' . time_ago($tgs->created_on) . '</span>';
                                        }
                                                               ?></span></td>


                                                 </tr>
                <?php } ?>
                                    </tbody>
                                </table>
                            </div>


                            <!---------------------END ------------------------>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="panel_edit_account" class="tab-pane">

            <?php
                $counties = array(
                        '' => 'Select County',
                        'Baringo' => 'Baringo',
                        'Bomet' => 'Bomet',
                        'Bungoma' => 'Bungoma',
                        'Busia' => 'Busia',
                        'Elgeyo Marakwet' => 'Elgeyo Marakwet',
                        'Embu' => 'Embu',
                        'Garissa' => 'Garissa',
                        'Homa Bay' => 'Homa Bay',
                        'Isiolo' => 'Isiolo',
                        'Kajiado' => 'Kajiado',
                        'Kakamega' => 'Kakamega',
                        'Kericho' => 'Kericho',
                        'Kiambu' => 'Kiambu',
                        'Kilifi' => 'Kilifi',
                        'Kirinyaga' => 'Kirinyaga',
                        'Kisii' => 'Kisii',
                        'Kisumu' => 'Kisumu',
                        'Kitui' => 'Kitui',
                        'Kwale' => 'Kwale',
                        'Laikipia' => 'Laikipia',
                        'Lamu' => 'Lamu',
                        'Machakos' => 'Machakos',
                        'Makueni' => 'Makueni',
                        'Mandera' => 'Mandera',
                        'Marsabit' => 'Marsabit',
                        'Meru' => 'Meru',
                        'Migori' => 'Migori',
                        'Mombasa' => 'Mombasa',
                        'Muranga' => 'Muranga',
                        'Nairobi' => 'Nairobi',
                        'Nakuru' => 'Nakuru',
                        'Nandi' => 'Nandi',
                        'Narok' => 'Narok',
                        'Nyamira' => 'Nyamira',
                        'Nyandarua' => 'Nyandarua',
                        'Nyeri' => 'Nyeri',
                        'Samburu' => 'Samburu',
                        'Siaya' => 'Siaya',
                        'Taita Taveta' => 'Taita Taveta',
                        'Tana River' => 'Tana River',
                        'Tharaka Nithi' => 'Tharaka Nithi',
                        'Trans Nzoia' => 'Trans Nzoia',
                        'Turkana' => 'Turkana',
                        'Uasin Gishu' => 'Uasin Gishu',
                        'Vihiga' => 'Vihiga',
                        'Wajir' => 'Wajir',
                        'West Pokot' => 'West Pokot');


                $countrylist = array(
                        "Kenya" => "Kenya",
                        "Afghanistan" => "Afghanistan",
                        "Albania" => "Albania",
                        "Algeria" => "Algeria",
                        "Algeria" => "Algeria",
                        "Algeria" => "Algeria",
                        "Antigua and Barbuda" => "Antigua and Barbuda",
                        "Argentina" => "Argentina",
                        "Armenia" => "Armenia",
                        "Australia" => "Australia",
                        "Austria" => "Austria",
                        "Azerbaijan" => "Azerbaijan",
                        "Bahamas" => "Bahamas",
                        "Bahrain" => "Bahrain",
                        "Bangladesh" => "Bangladesh",
                        "Barbados" => "Barbados",
                        "Belarus" => "Belarus",
                        "Belgium" => "Belgium",
                        "Belize" => "Belize",
                        "Benin" => "Benin",
                        "Bhutan" => "Bhutan",
                        "Bolivia" => "Bolivia",
                        "Bosnia and Herzegovina" => "Bosnia and Herzegovina",
                        "Botswana" => "Botswana",
                        "Brazil" => "Brazil",
                        "Brunei" => "Brunei",
                        "Bulgaria" => "Bulgaria",
                        "Burkina Faso" => "Burkina Faso",
                        "Burundi" => "Burundi",
                        "Cambodia" => "Cambodia",
                        "Cameroon" => "Cameroon",
                        "Canada" => "Canada",
                        "Cape Verde" => "Cape Verde",
                        "Central African Republic" => "Central African Republic",
                        "Chad" => "Chad",
                        "Chile" => "Chile",
                        "China" => "China",
                        "Colombi" => "Colombi",
                        "Comoros" => "Comoros",
                        "Congo (Brazzaville)" => "Congo (Brazzaville)",
                        "Congo" => "Congo",
                        "Costa Rica" => "Costa Rica",
                        "Cote d'Ivoire" => "Cote d'Ivoire",
                        "Croatia" => "Croatia",
                        "Cuba" => "Cuba",
                        "Cyprus" => "Cyprus",
                        "Czech Republic" => "Czech Republic",
                        "Denmark" => "Denmark",
                        "Djibouti" => "Djibouti",
                        "Dominica" => "Dominica",
                        "Dominican Republic" => "Dominican Republic",
                        "East Timor (Timor Timur)" => "East Timor (Timor Timur)",
                        "Ecuador" => "Ecuador",
                        "Egypt" => "Egypt",
                        "El Salvador" => "El Salvador",
                        "Equatorial Guinea" => "Equatorial Guinea",
                        "Eritrea" => "Eritrea",
                        "Estonia" => "Estonia",
                        "Ethiopia" => "Ethiopia",
                        "Fiji" => "Fiji",
                        "Finland" => "Finland",
                        "France" => "France",
                        "Gabon" => "Gabon",
                        "Gambia, The" => "Gambia, The",
                        "Georgia" => "Georgia",
                        "Germany" => "Germany",
                        "Ghana" => "Ghana",
                        "Greece" => "Greece",
                        "Grenada" => "Grenada",
                        "Guatemala" => "Guatemala",
                        "Guinea" => "Guinea",
                        "Guinea-Bissau" => "Guinea-Bissau",
                        "Guyana" => "Guyana",
                        "Haiti" => "Haiti",
                        "Honduras" => "Honduras",
                        "Hungary" => "Hungary",
                        "Iceland" => "Iceland",
                        "India" => "India",
                        "Indonesia" => "Indonesia",
                        "Iran" => "Iran",
                        "Iraq" => "Iraq",
                        "Ireland" => "Ireland",
                        "Israel" => "Israel",
                        "Italy" => "Italy",
                        "Jamaica" => "Jamaica",
                        "Japan" => "Japan",
                        "Jordan" => "Jordan",
                        "Kazakhstan" => "Kazakhstan",
                        "Kenya" => "Kenya",
                        "Kiribati" => "Kiribati",
                        "Korea, North" => "Korea, North",
                        "Korea, South" => "Korea, South",
                        "Kuwait" => "Kuwait",
                        "Kyrgyzstan" => "Kyrgyzstan",
                        "Laos" => "Laos",
                        "Latvia" => "Latvia",
                        "Lebanon" => "Lebanon",
                        "Lesotho" => "Lesotho",
                        "Liberia" => "Liberia",
                        "Libya" => "Libya",
                        "Liechtenstein" => "Liechtenstein",
                        "Lithuania" => "Lithuania",
                        "Luxembourg" => "Luxembourg",
                        "Macedonia" => "Macedonia",
                        "Madagascar" => "Madagascar",
                        "Malawi" => "Malawi",
                        "Malaysia" => "Malaysia",
                        "Maldives" => "Maldives",
                        "Mali" => "Mali",
                        "Malta" => "Malta",
                        "Marshall Islands" => "Marshall Islands",
                        "Mauritania" => "Mauritania",
                        "Mauritius" => "Mauritius",
                        "Mexico" => "Mexico",
                        "Micronesia" => "Micronesia",
                        "Moldova" => "Moldova",
                        "Monaco" => "Monaco",
                        "Mongolia" => "Mongolia",
                        "Morocco" => "Morocco",
                        "Mozambique" => "Mozambique",
                        "Myanmar" => "Myanmar",
                        "Namibia" => "Namibia",
                        "Nauru" => "Nauru",
                        "Nepa" => "Nepa",
                        "Netherlands" => "Netherlands",
                        "New Zealand" => "New Zealand",
                        "Nicaragua" => "Nicaragua",
                        "Niger" => "Niger",
                        "Nigeria" => "Nigeria",
                        "Norway" => "Norway",
                        "Oman" => "Oman",
                        "Pakistan" => "Pakistan",
                        "Palau" => "Palau",
                        "Panama" => "Panama",
                        "Papua New Guinea" => "Papua New Guinea",
                        "Paraguay" => "Paraguay",
                        "Peru" => "Peru",
                        "Philippines" => "Philippines",
                        "Poland" => "Poland",
                        "Portugal" => "Portugal",
                        "Qatar" => "Qatar",
                        "Romania" => "Romania",
                        "Russia" => "Russia",
                        "Rwanda" => "Rwanda",
                        "Saint Kitts and Nevis" => "Saint Kitts and Nevis",
                        "Saint Lucia" => "Saint Lucia",
                        "Saint Vincent" => "Saint Vincent",
                        "Samoa" => "Samoa",
                        "San Marino" => "San Marino",
                        "Sao Tome and Principe" => "Sao Tome and Principe",
                        "Saudi Arabia" => "Saudi Arabia",
                        "Senegal" => "Senegal",
                        "Serbia and Montenegro" => "Serbia and Montenegro",
                        "Seychelles" => "Seychelles",
                        "Sierra Leone" => "Sierra Leone",
                        "Singapore" => "Singapore",
                        "Slovakia" => "Slovakia",
                        "Slovenia" => "Slovenia",
                        "Solomon Islands" => "Solomon Islands",
                        "Somalia" => "Somalia",
                        "South Africa" => "South Africa",
                        "Spain" => "Spain",
                        "Sri Lanka" => "Sri Lanka",
                        "Sudan" => "Sudan",
                        "Suriname" => "Suriname",
                        "Swaziland" => "Swaziland",
                        "Sweden" => "Sweden",
                        "Switzerland" => "Switzerland",
                        "Syria" => "Syria",
                        "Taiwan" => "Taiwan",
                        "Tajikistan" => "Tajikistan",
                        "Tanzania" => "Tanzania",
                        "Thailand" => "Thailand",
                        "Togo" => "Togo",
                        "Tonga" => "Tonga",
                        "Trinidad and Tobago" => "Trinidad and Tobago",
                        "Tunisia" => "Tunisia",
                        "Turkey" => "Turkey",
                        "Turkmenistan" => "Turkmenistan",
                        "Tuvalu" => "Tuvalu",
                        "Uganda" => "Uganda",
                        "Ukraine" => "Ukraine",
                        "United Arab Emirates" => "United Arab Emirates",
                        "United Kingdom" => "United Kingdom",
                        "United States" => "United States",
                        "Uruguay" => "Uruguay",
                        "Uzbekistan" => "Uzbekistan",
                        "Vanuatu" => "Vanuatu",
                        "Vatican City" => "Vatican City",
                        "Venezuela" => "Venezuela",
                        "Vietnam" => "Vietnam",
                        "Yemen" => "Yemen",
                        "Zambia" => "Zambia",
                        "Zimbabwe" => "Zimbabwe"
                );
            ?>


            <div class="col-sm-12">
                <!-- start: FORM WIZARD PANEL -->


<?php
    $attributes = array('class' => 'smart-wizard form-horizontal', 'id' => 'form');
    echo form_open_multipart(site_url('admin/members/edit/' . $pid->id . '/01'), $attributes);
?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="icon-external-link-sign"></i>
                        <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Members </h3>
                        <div class="heading-elements">
                            <div class="btn-group">
<?php echo anchor('admin/members/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Members')) . '</span>', 'class="btn btn-primary"'); ?> 
<?php echo anchor('admin/members', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Members')) . '</span>', 'class="btn btn-primary"'); ?> 
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">


                        <div id="wizard" class="swMain">
                            <ul>
                                <li>
                                    <a href="#step-1" id="st_1">
                                        <div class="stepNumber">
                                            1
                                        </div>
                                        <span class="stepDesc"> Member Details
                                            <br />
                                            <small>Personal Details</small> </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-2" id="st_2">
                                        <div class="stepNumber">
                                            2
                                        </div>
                                        <span class="stepDesc"> Other Details
                                            <br />
                                            <small>Any Other Relevant Details</small> </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-3" id="st_3">
                                        <div class="stepNumber">
                                            3
                                        </div>
                                        <span class="stepDesc"> Relatives Details
                                            <br />
                                            <small>Next of Kin</small> </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-4" id="st_4">
                                        <div class="stepNumber">
                                            4
                                        </div>
                                        <span class="stepDesc"> Ministries & HBC
                                            <br />
                                            <small>Member Interest in Ministry</small> </span>
                                    </a>
                                </li>
                            </ul>
                            <div class="progress progress-striped active progress-sm">
                                <div aria-valuemax="100" aria-valuemin="0" role="progressbar" class="progress-bar progress-bar-success step-bar">
                                    <span class="sr-only"> 0% Complete (success)</span>
                                </div>
                            </div>


                            <div id="step-1">
                                <h2 class="StepTitle">Enter Member Details</h2>
                                <div class="col-sm-6">
                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='date_joined'>
                                            Date Joined 
                                        </label>
                                        <div class="col-sm-8 input-group">

                                            <input id='date_joined_' type='text' name='date_joined' maxlength='' class='form-control date-picker' value="<?php echo set_value('date_joined', $result->date_joined > 0 ? date('d M Y', $result->date_joined) : $result->date_joined); ?>"  />
                                            <i style="color:red"><?php echo form_error('date_joined'); ?></i>
                                            <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <label class='col-sm-3 control-label' for='title'>Title </label>
                                        <div class="col-sm-8">
<?php
    $items = array(
            "" => "",
            "Mr." => "Mr.",
            "Mrs." => "Mrs.",
            "Mss." => "Mss.",
            "Ms." => "Ms.",
            "Dr." => "Dr.",
            "Eng." => "Eng.",
    );
    echo form_dropdown('title', $items, (isset($result->title)) ? $result->title : '', ' id="title_" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('title'); ?></i>
                                        </div>
                                    </div>


                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='first_name'>First Name <span class='required'>*</span></label><div class="col-sm-8 input-group">
                                            <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                             <?php echo form_input('first_name', $result->first_name, 'id="first_name_"  class="form-control" '); ?>
                                            <i style="color:red"><?php echo form_error('first_name'); ?></i>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='last_name'>Last Name <span class='required'>*</span></label><div class="col-sm-8 input-group">
                                            <span class="input-group-addon"> <i class="icon-user"></i> </span>
<?php echo form_input('last_name', $result->last_name, 'id="last_name_"  class="form-control" '); ?>
                                            <i style="color:red"><?php echo form_error('last_name'); ?></i>
                                        </div>
                                    </div>



                                    <div class='form-group'>
                                        <label class='col-sm-3 control-label'>Gender <span class='required'>*</span></label>
                                        <div class="col-sm-8">
<?php
    $items = array(
            "" => "",
            "Male" => "Male",
            "Female" => "Female",
            "Transgender" => "Transgender",
    );
    echo form_dropdown('gender', $items, (isset($result->gender)) ? $result->gender : '', ' id="gender_1" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('gender'); ?></i>
                                        </div>

                                    </div>

                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='dob'>Date of Birth <span class='required'>*</span></label>
                                        <div class="col-sm-8 input-group">

                                            <input id='dob_' type='text' name='dob' maxlength='' class='form-control date-picker' value="<?php echo set_value('dob', $result->dob > 0 ? date('d M Y', $result->dob) : $result->dob); ?>"  />
                                            <i style="color:red"><?php echo form_error('dob'); ?></i>
                                            <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='phone1'>Phone1 <span class='required'>*</span></label><div class="col-sm-8 input-group">
                                            <span class="input-group-addon"> <i class="icon-phone"></i> </span>
<?php echo form_input('phone1', $result->phone1, 'id="phone1_"  class="form-control input-mask-phone" '); ?>
                                            <i style="color:red"><?php echo form_error('phone1'); ?></i>
                                        </div>
                                    </div>


                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='phone2'>Phone2 </label>
                                        <div class="col-sm-8 input-group">
                                            <span class="input-group-addon"> <i class="icon-phone"></i> </span>
<?php echo form_input('phone2', $result->phone2, 'id="phone2_"  class="form-control input-mask-phone" '); ?>
                                            <i style="color:red"><?php echo form_error('phone2'); ?></i>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='email'>Email <span class='required'>*</span></label><div class="col-sm-8">
<?php echo form_input('email', $result->email, 'id="email_"  class="form-control" '); ?>
                                            <i style="color:red"><?php echo form_error('email'); ?></i>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class='col-sm-3 control-label' for='country'>Country <span class='required'>*</span></label>
                                        <div class="col-sm-8">
<?php
    echo form_dropdown('country', $countrylist, (isset($result->country)) ? $result->country : '', ' id="country_" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('country'); ?></i>
                                        </div></div>

                                </div>
                                <div class="col-sm-6">

                                    <div class='form-group'>
                                        <label class='col-sm-3 control-label' for='county'>County <span class='required'>*</span></label>
                                        <div class="col-sm-8">
<?php
    echo form_dropdown('county', $counties, (isset($result->county)) ? $result->county : '', ' id="county_" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('county'); ?></i>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='location'>Location | Estate <span class='required'>*</span></label><div class="col-sm-8 input-group">
                                            <span class="input-group-addon"> <i class="clip-location"></i> </span>
                                             <?php echo form_input('location', $result->location, 'id="location_"  class="form-control" '); ?>
                                            <i style="color:red"><?php echo form_error('location'); ?></i>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='address'>Address </label><div class="col-sm-8">
                                            <textarea id="address_"  class="autosize-transition form-control "  name="address"  /><?php echo set_value('address', (isset($result->address)) ? htmlspecialchars_decode($result->address) : ''); ?></textarea>
                                            <i style="color:red"><?php echo form_error('address'); ?></i>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <label class='col-sm-3 control-label' for='marital_status'>Marital Status <span class='required'>*</span></label>
                                        <div class="col-sm-8">
                                             <?php
                                                 $items = array('' => '',
                                                         "married" => "Married",
                                                         "single" => "Single",
                                                         "separated" => "Separated",
                                                         "divorced" => "Divorced",
                                                         "divorced" => "Divorced",
                                                         "single mom" => "Single Mom",
                                                         "single dad" => "Single dad",
                                                         "widow" => "Widow",
                                                         "widower" => "Widower",
                                                         "not known" => "Not Known",
                                                 );
                                                 echo form_dropdown('marital_status', $items, (isset($result->marital_status)) ? $result->marital_status : '', ' id="marital_status_" class="form-control search-select" data-placeholder="Select Options..." ');
                                             ?> <i style="color:red"><?php echo form_error('marital_status'); ?></i>
                                        </div></div>

                                    <div class='form-group'>
                                        <label class='col-sm-3 control-label' for='member_status'>Member Status <span class='required'>*</span></label>
                                        <div class="col-sm-8">
                                                <?php
                                                    $items = array('' => '',
                                                            "active" => "Active",
                                                            "inactive" => "Inactive",
                                                            "deceased" => "Deceased",
                                                            "deceased" => "Deceased",
                                                            "prospect" => "Prospect",
                                                            "transferred" => "Transferred",
                                                            "visitor" => "Visitor",
                                                    );
                                                    echo form_dropdown('member_status', $items, (isset($result->member_status)) ? $result->member_status : '', ' id="member_status_" class="form-control search-select" data-placeholder="Select Options..." ');
                                                ?> <i style="color:red"><?php echo form_error('member_status'); ?></i>
                                        </div></div>

                                    <div class='form-group'>
                                        <label class='col-sm-3 control-label' for='member_status'>Upload Passport </label>
                                        <div class="col-sm-8">

                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <input id='file_' type='file' style="display:none" name='file' />


<?php if (!empty($result->passport))
    {
         ?>
                                                         <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                                                             <img src='<?php echo base_url('uploads/files/' . $result->passport) ?>' />
                                                         </div>
    <?php
    }
    else
    {
         ?>
                                                         <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo base_url('uploads/files/m1.png'); ?>" alt="">
                                                         </div>
    <?php } ?>

                                                <br/><i style="color:red"><?php echo form_error('passport'); ?></i>
<?php echo ( isset($upload_error['passport'])) ? $upload_error['passport'] : ""; ?>
                                                <div>
                                                    <span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="icon-picture"></i> Select image</span><span class="fileupload-exists"><i class="icon-picture"></i> Change</span>
                                                        <input type="file">
                                                    </span>
                                                    <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                                                        <i class="icon-remove"></i> Remove
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>						
                                </div>						
                                <div class="form-group">
                                    <div class="col-sm-2 col-sm-offset-8">
                                        <a class="btn btn-blue next-step btn-block">
                                            Next <i class="icon-circle-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div id="step-2">
                                <h2 class="StepTitle">Other Details</h2>




                                <div class='form-group'>
                                    <label class='col-sm-3 control-label' for='how_joined'>How Joined <span class='required'>*</span></label>
                                    <div class="col-sm-5">
<?php
    $items = array('' => '',
            "baptised" => "Baptised",
            "confession of faith" => "Confession of Faith",
            "transferred" => "Transferred",
            "others" => "Others",
    );
    echo form_dropdown('how_joined', $items, (isset($result->how_joined)) ? $result->how_joined : '', ' id="how_joined_" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('how_joined'); ?></i>
                                    </div>
                                </div>

                                <div class='form-group'>
                                    <label class='col-sm-3 control-label'>Baptised <span class='required'>*</span></label>
                                    <div class="col-sm-5">
<?php
    $items = array('' => '',
            "yes" => "Yes",
            "no" => "NO",
    );
    echo form_dropdown('baptised', $items, (isset($result->baptised)) ? $result->baptised : '', ' id="baptised_" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('baptised'); ?></i>
                                    </div>

                                </div>

                                <div class='form-group'>
                                    <label class='col-sm-3 control-label'>Confirmed <span class='required'>*</span></label>	
                                    <div class="col-sm-5">
                                         <?php
                                             $items = array('' => '',
                                                     "yes" => "Yes",
                                                     "no" => "NO",
                                             );
                                             echo form_dropdown('confirmed', $items, (isset($result->confirmed)) ? $result->confirmed : '', ' id="confirmed_" class="form-control search-select" data-placeholder="Select Options..." ');
                                         ?> <i style="color:red"><?php echo form_error('confirmed'); ?></i>
                                    </div>

                                </div>

                                <div class='form-group'>
                                    <label class='col-sm-3 control-label' for='occupation'>Occupation </label>
                                    <div class="col-sm-5">
<?php
    $items = array('' => '',
            "businessman" => "Businessman",
            "doctor" => "Doctor",
            "electrician" => "Electrician",
            "nurse" => "Nurse",
            "teacher" => "Teacher",
            "banker" => "Banker",
            "journalist" => "Journalist",
            "programmer" => "Programmer",
            "insurance" => "Insurance",
            "artist" => "Artist",
            "accountant" => "Accountant",
            "others" => "Others",
    );
    echo form_dropdown('occupation', $items, (isset($result->occupation)) ? $result->occupation : '', ' id="occupation_" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('occupation'); ?></i>
                                    </div></div>

                                <div class='form-group'>
                                    <label class=' col-sm-3 control-label' for='employer'>Employer </label><div class="col-sm-5">
<?php echo form_input('employer', $result->employer, 'id="employer_"  class="form-control" '); ?>
                                        <i style="color:red"><?php echo form_error('employer'); ?></i>
                                    </div>
                                </div>

                                <div class='form-group'>
                                    <label class=' col-sm-3 control-label' for='description'>Any Additional Info </label><div class="col-sm-5">
                                        <textarea id="description_"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                                        <i style="color:red"><?php echo form_error('description'); ?></i>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-sm-2 col-sm-offset-3">
                                        <a class="btn btn-light-grey back-step btn-block">
                                            <i class="icon-circle-arrow-left"></i> Back
                                        </a>
                                    </div>
                                    <div class="col-sm-2 col-sm-offset-3">
                                        <a class="btn btn-blue next-step btn-block">
                                            Next <i class="icon-circle-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>


                            <!----New Form --->
                            <div id="step-3">
                                <h2 class="StepTitle">Relative Details</h2>

                                <!--------NEW FORM---------->


<?php if ($relatives): ?>

                                         <table class="table table-striped table-bordered table-hover table-full-width" >

                                             <thead>
                                             <th>#</th>
                                             <th>First Name</th>
                                             <th>Relationship</th>
                                             <th>R/Ship Type</th>
                                             <th>Phone</th>
                                             <th>Email</th>	
                                             <th>Location</th>	
                                             <th width="100"><?php echo lang('web_options'); ?></th>
                                             </thead>
                                             <tbody>
         <?php
         $i = 0;


         foreach ($relatives as $p):
              $i++;
              ?>
                                                      <tr>
                                                          <td><?php echo $i . '.'; ?></td>					
                                                          <td><?php echo $p->first_name . ' ' . $p->last_name; ?></td>
                                                          <td><?php echo $p->relationship; ?></td>
                                                          <td><?php echo $p->type; ?></td>
                                                          <td><?php echo $p->phone; ?></td>
                                                          <td><?php echo $p->email; ?></td>
                                                          <td><?php echo $p->location; ?></td>

                                                          <td >
                                                              <div>
                                                                  <div class='btn-group'>
                                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                                      </a>
                                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                                          <li role='presentation'>
                                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/relatives/edit/' . $p->id . '/1'); ?>'>
                                                                                  <i class='icon-edit'></i> Edit
                                                                              </a>
                                                                          </li>
                                                                          <li role='presentation'>
                                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/relatives/view/' . $p->id . '/1'); ?>'>
                                                                                  <i class='icon-share'></i> View
                                                                              </a>
                                                                          </li>
                                                                          <li role='presentation'>
                                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/relatives/delete/' . $p->id . '/1'); ?>'>
                                                                                  <i class='icon-remove'></i> Remove
                                                                              </a>
                                                                          </li>
                                                                      </ul>
                                                                  </div>
                                                              </div>
                                                          </td>
                                                      </tr>
                                                      <?php endforeach ?>
                                             </tbody>

                                         </table>

                                                 <?php endif ?>
                                <h2 class="StepTitle">Add Another Relative</h2>
                                <div class="col-sm-6">
                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='first_name'>First Name </label><div class="col-sm-8 input-group">
                                            <span class="input-group-addon"> <i class="icon-user"></i> </span>
<?php echo form_input('first_name1', $post->first_name1, 'id="first_name_"  class="form-control" '); ?>
                                            <i style="color:red"><?php echo form_error('first_name1'); ?></i>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='last_name'>Last Name </label><div class="col-sm-8 input-group">
                                            <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                             <?php echo form_input('last_name1', $post->last_name1, 'id="last_name_"  class="form-control" '); ?>
                                            <i style="color:red"><?php echo form_error('last_name'); ?></i>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class='col-sm-3 control-label'>Gender </label>
                                        <div class="col-sm-8">
                                            <?php
                                                $items = array(
                                                        "" => "",
                                                        "Male" => "Male",
                                                        "Female" => "Female",
                                                        "Transgender" => "Transgender",
                                                );
                                                echo form_dropdown('gender1', $items, (isset($post->gender1)) ? $post->gender1 : '', ' id="gender_1" class="form-control search-select" data-placeholder="Select Options..." ');
                                            ?> <i style="color:red"><?php echo form_error('gender'); ?></i>
                                        </div>

                                    </div>
                                    <div class='form-group'>
                                        <label class='col-sm-3 control-label' for='type'>Type </label>
                                        <div class="col-sm-8">
                                             <?php
                                                 $items = array('' => '',
                                                         "parent" => "Parent",
                                                         "spouse" => "Spouse",
                                                         "sibling" => "Sibling",
                                                         "guardian" => "Guardian",
                                                         "friend" => "Friend",
                                                         "others" => "Others",
                                                 );
                                                 echo form_dropdown('type1', $items, (isset($post->type1)) ? $post->type1 : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                                             ?> <i style="color:red"><?php echo form_error('type'); ?></i>
                                        </div></div>

                                    <div class='form-group'>
                                        <label class='col-sm-3 control-label' for='relationship'>Relationship </label>
                                        <div class="col-sm-8">
<?php
    $items = array('' => '',
            "wife" => "Wife",
            "husband" => "Husband",
            "father" => "Father",
            "mother" => "Mother",
            "uncle" => "Uncle",
            "aunt" => "Aunt",
            "grandparent" => "Grand Parent",
            "friend" => "Friend",
            "child" => "Child",
            "others" => "Others",
    );
    echo form_dropdown('relationship1', $items, (isset($post->relationship1)) ? $post->relationship1 : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('relationship'); ?></i>
                                        </div></div>
                                </div>
                                <div class="col-sm-6">
                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='phone'>Phone </label>
                                        <div class="col-sm-8 input-group">
                                            <span class="input-group-addon"> <i class="icon-phone"></i> </span>
<?php echo form_input('phone', $post->phone, 'id="phone_"  class="form-control input-mask-phone" '); ?>
                                            <i style="color:red"><?php echo form_error('phone'); ?></i>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='email'>Email </label><div class="col-sm-8">
<?php echo form_input('email1', $post->email1, 'id="email_"  class="form-control" '); ?>
                                            <i style="color:red"><?php echo form_error('email'); ?></i>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='location'> Residential </label><div class="col-sm-8 input-group">
                                            <span class="input-group-addon"> <i class="clip-location"></i> </span>
<?php echo form_input('location1', $post->location1, 'id="location1_"  class="form-control" '); ?>
                                            <i style="color:red"><?php echo form_error('location1'); ?></i>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <label class=' col-sm-3 control-label' for='additionals'>Additional Info </label><div class="col-sm-8">
                                            <textarea id="additionals"  class="autosize-transition  form-control "  name="additionals1"  /><?php echo set_value('additionals', (isset($post->additionals)) ? htmlspecialchars_decode($post->additionals) : ''); ?></textarea>
                                            <i style="color:red"><?php echo form_error('additionals'); ?></i>
                                        </div>
                                    </div>

                                </div>



                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <div class="col-sm-2 col-sm-offset-3">
                                        <a class="btn btn-light-grey back-step btn-block">
                                            <i class="icon-circle-arrow-left"></i> Back
                                        </a>
                                    </div>
                                    <div class="col-sm-2 col-sm-offset-3">
                                        <button class="btn btn-blue next-step btn-block">
                                            Next <i class="icon-circle-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="step-4">
                                <h2 class="StepTitle">Ministry & HBCs</h2>

                                <!---------LAST FORM HERE---------->

<?php if ($member_ministries)
    {
         ?>
                                         <div class='clearfix'></div>
                                         <table class="table table-striped table-bordered table-hover table-full-width" id="">

                                             <thead>
                                             <th>#</th>
                                             <th>Name</th>
                                             <th>Leader</th>
                                             <th>Telephone</th>
                                             <th>Mobile</th>
                                             <th>Email</th>
                                             <th ><?php echo lang('web_options'); ?></th>
                                             </thead>
                                             <tbody>
         <?php
         $i = 0;


         foreach ($member_ministries as $p):
              $i++;
              ?>
                                                      <tr>
                                                          <td><?php echo $i . '.'; ?></td>					

                                                          <td><?php echo ucwords($p->name); ?></td>
                                                          <td><?php echo ucwords($leader[$p->leader]); ?></td>
                                                          <td><?php echo $p->telephone; ?></td>
                                                          <td><?php echo $p->mobile; ?></td>
                                                          <td><?php echo $p->email; ?></td>


                                                          <td width='100'>
                                                              <div>
                                                                  <div class='btn-group' id="delete_ministry">
                                                                      <a class='btn btn-danger btn-sm' onClick="return confirm('Are you sure you want to void this pledge. Action is irreversible!!')" href='<?php echo site_url('admin/members/remove_ministry/' . $pp->mmid . '/1005'); ?>'>
                                                                          <i class='icon-trash'></i> Remove 
                                                                      </a>

                                                                  </div>
                                                              </div>
                                                          </td>
                                                      </tr>
         <?php endforeach ?>
                                             </tbody>

                                         </table>
                                         <h2 class="StepTitle">Add Ministries | HBCs</h2>	
    <?php } ?>




                                <div class='form-group'>
                                    <label class='col-sm-3 control-label'>Ministries Interested in </label>	
                                    <div class="col-sm-5">
<?php
    echo form_dropdown('ministries[]', $ministries, (isset($result->ministries)) ? $result->ministries : '', ' id="form-field-select-4" multiple="multiple" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('ministries'); ?></i>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class='col-sm-3 control-label'>Member HBC </label>	
                                    <div class="col-sm-5">
<?php
    echo form_dropdown('hbc_id', $hbcs, (isset($result->hbc_id)) ? $result->hbc_id : '', ' id="confirmed_" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('hbc_id'); ?></i>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="col-sm-2 col-sm-offset-3">
                                        <button class="btn btn-light-grey back-step btn-block">
                                            <i class="icon-circle-arrow-left"></i> Back
                                        </button>
                                    </div>
                                    <div class="col-sm-2 col-sm-offset-8">
                                        <button class="btn btn-success  btn-block">
                                            Save Changes <i class="icon-circle-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                     <?php echo form_close(); ?>

                <!-- end: FORM WIZARD PANEL -->
            </div>



        </div>
        <div id="panel_kin_account" class="tab-pane">
            <h2 class="StepTitle">Relative Details</h2>

<?php if ($relatives): ?>

                     <table class="table table-striped table-bordered table-hover table-full-width" >

                         <thead>
                         <th>#</th>
                         <th>First Name</th>
                         <th>Relationship</th>
                         <th>R/Ship Type</th>
                         <th>Phone</th>
                         <th>Email</th>	
                         <th>Location</th>	
                         <th width="100"><?php echo lang('web_options'); ?></th>
                         </thead>
                         <tbody>
         <?php
         $i = 0;


         foreach ($relatives as $p):
              $i++;
              ?>
                                  <tr>
                                      <td><?php echo $i . '.'; ?></td>					
                                      <td><?php echo ucwords($p->first_name . ' ' . $p->last_name); ?></td>
                                      <td><?php echo ucfirst($p->relationship); ?></td>
                                      <td><?php echo ucfirst($p->type); ?></td>
                                      <td><?php echo $p->phone; ?></td>
                                      <td><?php echo $p->email; ?></td>
                                      <td><?php echo ucwords($p->location); ?></td>

                                      <td >
                                          <div>
                                              <div class='btn-group'>
                                                  <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                      <i class='icon-cog'></i> Action <span class='caret'></span>
                                                  </a>
                                                  <ul role='menu' class='dropdown-menu pull-right'>
                                                      <li role='presentation'>
                                                          <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/relatives/edit/' . $p->id . '/1'); ?>'>
                                                              <i class='icon-edit'></i> Edit
                                                          </a>
                                                      </li>
                                                      <li role='presentation'>
                                                          <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/relatives/view/' . $p->id . '/1'); ?>'>
                                                              <i class='icon-share'></i> View
                                                          </a>
                                                      </li>
                                                      <li role='presentation'>
                                                          <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/relatives/delete/' . $p->id . '/1'); ?>'>
                                                              <i class='icon-remove'></i> Remove
                                                          </a>
                                                      </li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </td>
                                  </tr>
         <?php endforeach ?>
                         </tbody>

                     </table>

    <?php endif ?>
        </div>
        <!--------------------END KIN ACCOUNT------>
        <div id="panel_contributions" class="tab-pane">
            <div class="col-md-6"> 
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <i class="clip-note"></i>
                        Tithes Contribution

                        <div class="heading-elements">
                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                            </a>
                            <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-refresh" href="#">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-close" href="#">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>

                    <div class="panel-body panel-scroll" style="height:300px">


<?php if ($tithes): ?>


                                 <table class="table table-striped table-bordered table-hover table-full-width sample_2">

                                     <thead>
                                     <th>#</th>
                                     <th>Date</th>
                                     <th>Amount</th>
                                     <th>Recorded By</th>
                                     <th></th>

                                     </thead>
                                     <tbody>
                                                       <?php
                                                     $i = 0;

                                                     foreach ($tithes as $p):
                                                          $u = $this->ion_auth->get_user($p->created_by);
                                                          $i++;
                                                          ?>
                                              <tr>

                                                  <td><?php echo $i . '.'; ?></td>					
                                                  <td><?php echo date('d M Y', $p->created_on); ?></td>										
                                                  <td><?php echo number_format($p->amount, 2); ?></td>
                                                  <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                                  <td class="center hidden-xs"><span class="label"><?php
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
                        ?></span></td>

                                              </tr>

         <?php endforeach ?>
                                     </tbody>

                                 </table>

    <?php else: ?>
                                 <p class='text'><?php echo lang('web_no_elements'); ?></p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <i class="clip-note"></i>
                        Thanks Giving Contribution
                        <div class="heading-elements">
                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                            </a>
                            <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-refresh" href="#">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-close" href="#">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body panel-scroll" style="height:300px">


<?php if ($tg): ?>


                                 <table class="table table-striped table-bordered table-hover table-full-width sample_2" >

                                     <thead>
                                     <th>#</th>
                                     <th>Date</th>
                                     <th>Amount</th>
                                     <th>Recorded By</th>
                                     <th></th>

                                     </thead>
                                     <tbody>
                                                       <?php
                                                     $i = 0;

                                                     foreach ($tg as $p):
                                                          $u = $this->ion_auth->get_user($p->created_by);
                                                          $i++;
                                                          ?>
                                              <tr>

                                                  <td><?php echo $i . '.'; ?></td>					
                                                  <td><?php echo date('d M Y', $p->created_on); ?></td>										
                                                  <td><?php echo number_format($p->amount, 2); ?></td>
                                                  <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                                  <td class="center hidden-xs"><span class="label "><?php
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
                        ?></span></td>

                                              </tr>

         <?php endforeach ?>
                                     </tbody>

                                 </table>

    <?php else: ?>
                                 <p class='text'><?php echo lang('web_no_elements'); ?></p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class='clearfix'></div>				
            <div class="col-md-6">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <i class="clip-note"></i>
                        My Pledges
                        <div class="heading-elements">
                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                            </a>
                            <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-refresh" href="#">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-close" href="#">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body panel-scroll" style="height:300px">


                                 <?php if ($pl): ?>


                                 <table class="table table-striped table-bordered table-hover table-full-width sample_2" >

                                     <thead>
                                         <tr>
                                             <th class="center">
                                                 <div class="checkbox-table">
                                                     <label>
                                                         <input type="checkbox" class="flat-grey">
                                                     </label>
                                                 </div></th>
                                             <th><i class="icon-calendar"></i> Title</th>
                                             <th class="hidden-xs">Amount</th>


                                             <th>Status</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                                  <?php
                                                  $i = 0;
                                                  foreach ($pl as $p)
                                                  {
                                                       $paids = (object) $p->paid;
                                                       $i++;
                                                       if ($i == 6)
                                                            break;
                                                       ?>
                                              <tr>
                                                  <td class="center">
                                                      <div class="checkbox-table">
                                                          <label>
                                                              <input type="checkbox" class="flat-grey">
                                                          </label>
                                                      </div></td>
                                                  <td><?php echo date('d M Y', $p->created_on); ?></td>
                                                  <td class="hidden-xs"><?php
                                                       if ($p->status == 2)
                                                            echo number_format($paids->total);
                                                       else
                                                            echo number_format($p->amount, 2);
                                                       ?></td>


                                                  <td><?php
                                                       if ($p->status == 1)
                                                       {
                                                            echo '<span class="label label-warning"> Pending</span> ';

                                                            $now = time(); // or your date as well
                                                            $p_date = date('Y-m-d', $p->expected_pay_date);
                                                            $act_date = strtotime($p_date);
                                                            $datediff = $act_date - $now;
                                                            $days = floor($datediff / (60 * 60 * 24));
                                                            if ($days < 0)
                                                            {
                                                                 echo ' <span class="label label-danger"> Overdue </span>';
                                                            }
                                                            elseif (0 == $days)
                                                            {
                                                                 echo ' <span class="label label-info"> ' . $days . ' Days to go  </span>';
                                                            }
                                                            else
                                                            {
                                                                 echo ' <span class="label label-info">' . $days . ' Day(s) to go </span>';
                                                            }
                                                       }
                                                       elseif ($p->status == 2)
                                                       {
                                                            echo '<span class="label label-success">Paid</span>';
                                                       }
                                                       else
                                                       {
                                                            echo '<span class="label label-inverse">Voided</span>';
                                                       }
                                                       ?></td>


                                              </tr>
         <?php } ?>
                                     </tbody>

                                 </table>

    <?php else: ?>
                                 <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <i class="clip-note"></i>
                        Ministry Support
                        <div class="heading-elements">
                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                            </a>
                            <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-refresh" href="#">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-close" href="#">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body panel-scroll" style="height:300px">


                                              <?php if ($ms): ?>


                                 <table class="table table-striped table-bordered table-hover table-full-width sample_2" >

                                     <thead>
                                     <th>#</th>
                                     <th>Date</th>
                                     <th>Amount</th>
                                     <th>Recorded By</th>
                                     <th></th>

                                     </thead>
                                     <tbody>
         <?php
         $i = 0;

         foreach ($ms as $p):
              $u = $this->ion_auth->get_user($p->created_by);
              $i++;
              ?>
                                              <tr>

                                                  <td><?php echo $i . '.'; ?></td>					
                                                  <td><?php echo date('d M Y', $p->created_on); ?></td>										
                                                  <td><?php echo number_format($p->amount, 2); ?></td>
                                                  <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                                  <td class="center hidden-xs"><span class="label "><?php
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
                        ?></span></td>

                                              </tr>

         <?php endforeach ?>
                                     </tbody>

                                 </table>

    <?php else: ?>
                                 <p class='text'><?php echo lang('web_no_elements'); ?></p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class='clearfix'></div>


            <div class="col-md-6">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <i class="clip-note"></i>
                        Seed Plating
                        <div class="heading-elements">
                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                            </a>
                            <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-refresh" href="#">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-close" href="#">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body panel-scroll" style="height:300px">


                                              <?php if ($sp): ?>


                                 <table class="table table-striped table-bordered table-hover table-full-width sample_2" >

                                     <thead>
                                     <th>#</th>
                                     <th>Date</th>
                                     <th>Amount</th>
                                     <th>Recorded By</th>
                                     <th></th>

                                     </thead>
                                     <tbody>
         <?php
         $i = 0;

         foreach ($sp as $p):
              $u = $this->ion_auth->get_user($p->created_by);
              $i++;
              ?>
                                              <tr>

                                                  <td><?php echo $i . '.'; ?></td>					
                                                  <td><?php echo date('d M Y', $p->created_on); ?></td>										
                                                  <td><?php echo number_format($p->amount, 2); ?></td>
                                                  <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                                  <td class="center hidden-xs"><span class="label "><?php
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
                        ?></span></td>

                                              </tr>

         <?php endforeach ?>
                                     </tbody>

                                 </table>

                            <?php else: ?>
                                 <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <i class="clip-note"></i>
                        Other Contributions
                        <div class="heading-elements">
                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                            </a>
                            <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-refresh" href="#">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a class="btn btn-xs btn-link panel-close" href="#">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body panel-scroll" style="height:300px">


                                              <?php if ($oc): ?>


                                 <table class="table table-striped table-bordered table-hover table-full-width sample_2" >

                                     <thead>
                                     <th>#</th>
                                     <th>Date</th>
                                     <th>Amount</th>
                                     <th>Recorded By</th>
                                     <th></th>

                                     </thead>
                                     <tbody>
         <?php
         $i = 0;

         foreach ($oc as $p):
              $u = $this->ion_auth->get_user($p->created_by);
              $i++;
              ?>
                                              <tr>

                                                  <td><?php echo $i . '.'; ?></td>					
                                                  <td><?php echo date('d M Y', $p->created_on); ?></td>										
                                                  <td><?php echo number_format($p->amount, 2); ?></td>
                                                  <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                                  <td class="center hidden-xs"><span class="label "><?php
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
                        ?></span></td>

                                              </tr>

         <?php endforeach ?>
                                     </tbody>

                                 </table>

    <?php else: ?>
                                 <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?>
                    </div>
                </div>
            </div>
            <div class='clearfix'></div>

            <!---------------------------------END TABLES---------------------------->
        </div>

        <div id="panel_sms" class="tab-pane">

            <div class="panel panel-white">
                <div class="panel-heading">
                    <i class="clip-checkmark-2"></i>
                    SMS Messages sent to me
                    <div class="heading-elements">
                        <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                        </a>
                        <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <a class="btn btn-xs btn-link panel-refresh" href="#">
                            <i class="fa fa-refresh"></i>
                        </a>
                        <a class="btn btn-xs btn-link panel-close" href="#">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="panel-body panel-scroll" style="height:500px">
                    <!-------SMS DETAILS----------------->

                                     <?php if ($sms): ?>
                             <div class='clearfix'></div>
                             <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                                 <thead>
                                 <th>#</th>
                                 <th>Date</th>
                                 <th>Sending Type</th>
                                 <th>Status</th>
                                 <th>Message</th>
                                 <th></th>

                                 </thead>
                                 <tbody>
                                     <?php
                                     $i = 0;

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

                                          </tr>	
         <?php endforeach ?>

                                 </tbody>

                             </table>


    <?php else: ?>
                             <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?>

                </div>
            </div>


        </div>

    </div>
</div>

<!-- end: PAGE CONTENT-->