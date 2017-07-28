<div class="col-sm-12">



    <div class='clearfix'></div>	
    <div class="panel panel-default animated fadeIn"> 

        <div class="panel-heading">

            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo $title; ?> </h3>


            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/ministries/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Ministries')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/ministries', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Ministries')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">

                <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                    echo form_open_multipart('admin/ministries/search', $attributes);
                ?>


                <div class=" input-group">
                     <?php
                         echo form_dropdown('ministry_id', array('' => 'Search Ministry') + $ministries, (isset($result->ministry_id)) ? $result->ministry_id : '', ' id="ministry_id" class="form-control search-select1" data-placeholder="Select Options..." ');
                     ?>
                    <span class="input-group-btn" style="width:300px !important;">
                        <button type="submit" class="btn btn-success">
                            <i class="icon-search"></i>
                            View Details
                        </button> </span>
                </div>

                <?php echo form_close(); ?>	


                <?php if ($members): ?>
                         <div class='clearfix'></div>




                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Passport</th>
                                     <th>Name</th>
                                     <th>Date Joined</th>
                                     <th>Gender</th>
                                     <th>Mobile</th>
                                     <th>Email</th>
                                     <th>Location</th>
                                     <th>Status</th>

                                     <th ><?php echo lang('web_options'); ?></th>
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
                                          <td>
                                               <?php if (empty($u->passport))
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

                                                   <img alt="" src="<?php echo base_url('uploads/files/' . $u->passport); ?>" style="" class="circle-img" height="40" width="40">
                                                  <?php } ?>
                                          </td>				
                                          <td><a href='<?php echo site_url('admin/members/profile/' . $u->member_id); ?>'>
                                                  <i class="clip-chevron-right"></i> 
              <?php echo $u->title . ' ' . $u->first_name . ' ' . $u->last_name; ?></a>
                                          </td>
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

                                          <td width="100">

                                              <div>
                                                  <div class='btn-group'>
                                                      <a onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" class='btn btn-danger btn-sm' href='<?php echo site_url('admin/ministries/remove_member/' . $p->mem_min_id . '/' . $p->ministry_id); ?>'>
                                                          <i class='icon-trash'></i> Remove
                                                      </a>
                                                  </div>
                                              </div></td>
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