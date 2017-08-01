<?=core_js('core/js/plugins/tables/datatables/datatables.min.js');?>

<?=core_js('core/js/pages/datatables_sorting.js');?> 

<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
          <h3 class="panel-title">
            <i class="position-left icon-external-link-sign"></i>
            All Members </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/members/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Members')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/members', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Members')) . '</span>', 'class="btn btn-info"'); ?> 
                    <a data-toggle="modal" style='' class="btn btn-warning" role="button" href="#Upload">
                        <i class='icon-share'></i> Upload Members
                    </a>
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="table-responsive widget-main">


                <?php if ($members): ?>
                        


                         <table class="table table-striped table-condensed table-bordered table-hover  table-full-width datatable-sorting" id="">

                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Passport</th>

                                     <th>Name</th>
                                     <th>Code</th>
                                     <th>Date Joined</th>
                                     <th>Gender</th>
                                     <th>Mobile</th>
                                     <th>Email</th>
                                     <th>County</th>
                                     <th>Location</th>
                                     <th>Status</th>

                                     <th ><?php echo lang('web_options'); ?></th>
                                 </tr>
                             </thead>
                             <tbody>
                                  <?php
                                  $j = 1;


                                  foreach ($members as $p):
                                       ?>
                                      <tr>
                                          <td><?php echo $j . '.'; ?></td>
                                          <td>
                                               <?php if (empty($p->passport))
                                               {
                                                    ?>
                                                   <div class="fileupload-new thumbnail" style="width: 40px; height: 40px;">
                                                       <img src="<?php echo base_url('uploads/files/m1.png'); ?>" alt="">
                                                   </div>
                                              <?php
                                              }
                                              else
                                              {
                                                   ?>

                                                   <img alt="" src="<?php echo base_url('uploads/files/' . $p->passport); ?>" style="" class="circle-img" height="40" width="40">
                                                  <?php } ?>
                                          </td>	
                                          <td><a class="tooltips" data-original-title="View <?php echo $p->first_name ?>'s Profile" data-placement="top" href='<?php echo site_url('admin/members/profile/' . $p->id); ?>'>
                                                  <i class="icon-double-angle-right"></i> 
              <?php echo $p->title . ' ' . $p->first_name . ' ' . $p->last_name; ?></a>
                                          </td>
                                          <td><?php echo $p->member_code; ?></td>		
                                          <td><?php echo date('d M Y', $p->date_joined); ?></td>		

                                          <td><?php echo $p->gender; ?></td>
                                          <td><?php
                                               $ph = $p->phone1;
                                               $cha = array('(', ')', '-');
                                               $sp = array('', '', '');
                                               echo str_replace($cha, $sp, $ph);
                                               ?></td>

                                          <td><?php echo $p->email; ?></td>
                                          <td><?php echo $p->county; ?></td>
                                          <td><?php echo $p->location; ?></td>
                                          <td><?php echo ucwords($p->member_status); ?></td>

                                          <td >

                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:green' href='<?php echo site_url('admin/members/edit/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-edit'></i> Edit Details
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:green' href='<?php echo site_url('admin/members/profile/' . $p->id); ?>'>
                                                                  <i class='icon-share'></i> View Profile
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a  style='color:green'  data-toggle="modal" href='#add_groups_<?php echo $p->id; ?>'>
                                                                  <i class="icon-group"></i> Add To Groups
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:red' tabindex='-1'onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/members/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Suspend
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div></td>
                                      </tr>


                                      <!-----------ADD TI GROUP MODAL------------------------->			


                                  <div id="add_groups_<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-responsive-label" aria-hidden="true" class="modal fade">

                                      <?php
                                      $attributes = array('class' => 'form-horizontal', 'id' => '');
                                      echo form_open_multipart('admin/members/add_groups/' . $p->id, $attributes);
                                      ?>
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" data-dismiss="modal" aria-hidden="true"
                                                          class="close">&times;</button>
                                                  <h4 id="modal-responsive-label" class="modal-title">Add To Group</h4></div>
                                              <div class="modal-body">
                                                  <div class="row">
                                                      <div class="col-md-12">


                                                          <div class="mbm" > 
              <?php
              echo form_dropdown('member_groups[]', $groups_list, '', 'multiple="multiple" placeholder="Select Group" class="form-control search-select" ');
              ?> <i style="color:red"><?php echo form_error('member_groups'); ?></i>
                                                          </div>
                                                      </div>

                                                  </div>
                                              </div>
                                              <div class="modal-footer">

                                                  <button type="submit" class="btn btn-success">Save changes</button> 
                                                  <button type="button" data-dismiss="modal" class="btn btn-default">Close
                                                  </button>
                                              </div>
                                          </div>
                                      </div>
              <?php echo form_close(); ?>	
                                  </div>






              <?php $j++;
         endforeach
         ?>
                             </tbody>

                         </table>

                 <?php echo $links; ?>
                     </div>
                 </div><?php else: ?>
                 <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?>
    </div>
</div>




<!-----------------------------ADD MODAL------------------------->
<div class="modal fade" id="Upload" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
        <form action="<?php echo base_url('admin/members/upload_members'); ?>" method="post" enctype="multipart/form-data" name="form1" id="form1"> 

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">Upload Members</h4>
                    <div class="clearfix"></div>
                </div>


                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='survey_date'>Choose CSV File <span class='error'>*</span></label><div class="col-sm-9">
                        <input name="csv" type="file" id="csv" /> <br>

                    </div>
                </div>




                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Save Changes
                    </button>
                    <button type="button" data-dismiss="modal" class="btn btn-default">
                        Close
                    </button>
                </div>
        </form> 
    </div>
</div>
</div>