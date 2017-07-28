<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Currently on <span style="color:blue"><?php echo $fld->title; ?> </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a data-toggle="modal" class="btn btn-primary" role="button" href="#file">
                        <i class='icon-plus'></i> Add File
                    </a>
                    <?php echo anchor('admin/folders', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Folders')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div> 

        <?php if ($p): ?>


                 <div class="panel-body" style="display: block;">  
                     <a href="#" class="btn btn-warning btn-sm grid" class=""><i class=" icon-windows"></i> Grid View</a>
                     <a href="#" class="btn btn-success btn-sm list" class=""><i class="icon-list"></i> List View</a>
                     <hr>			   
                     <div class="widget-main" id="list" style="display:none">



                         <div class='clearfix'></div>

                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1" >

                             <thead>
                             <th>#</th>
                             <th>Title</th>
                             <th>type</th>
                             <th>Download</th>	
                             <th>Uploaded By</th>	
                             <th>Uploaded On</th>	
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;

                                  foreach ($p as $post):
                                       $u = $this->ion_auth->get_user($post->created_by);
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo $post->title; ?></td>
                                          <td><?php echo $post->type; ?></td>
                                          <td><a href="<?php echo base_url('uploads/' . $post->fpath . '/' . $post->file) ?>">Download file</a></td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                          <td><?php echo date('d M Y', $post->created_on); ?></td>
                                          <td width='100'>
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:#000' class="" role="button" href="#Edit_<?php echo $post->id; ?>">
                                                                  <i class='icon-edit'></i> Edit
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/folders/view/' . $post->id . '/' . $page); ?>'>
                                                                  <i class='icon-share'></i> View
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/folders/delete/' . $post->id . '/' . $page); ?>'>
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

                    <?php else: ?>
                         <p class='text'><?php echo lang('web_no_elements'); ?></p>
                <?php endif ?>
            </div>
        </div>




        <div class="panel-body">
            <div id="pricing_table_example1" class="row ">
                <div class="col-sm-12">


                    <div id="grid">

                        <?php
                            $i = 0;

                            foreach ($p as $p):
                                 $i++;
                                 ?>

                                 <div class="pricing-table col-sm-3 col-xs-12 <?php
                                 if ($p->type == 'pdf')
                                 {
                                      echo 'pdf';
                                 }
                                 elseif ($p->type == 'word')
                                 {
                                      echo 'word';
                                 }
                                 elseif ($p->type == 'csv' || $p->type == 'excel')
                                 {
                                      echo 'excel';
                                 }
                                 else
                                 {
                                      echo 'pdf';
                                 }
                                 ?> ">
                                     <a href="#" class="">
                                         <br>
                                         <h3><?php echo $p->title; ?></h3>
                                     </a>
                                     <div class="actions">
                                         <a data-toggle="modal" style='color:#000' class="btn btn-sm btn-success" role="button" href="#Share_<?php echo $p->id; ?>">
                                             <i class='icon-share'></i> Share
                                         </a>
                                         &nbsp;&nbsp;
                                         <a class="btn btn-sm btn-primary" href="<?php echo base_url('uploads/' . $p->fpath . '/' . $p->file) ?>"><i class="icon-download"></i> Download file </a>

                                     </div>
                                     <?php if ($i == 4) echo "<br>" ?>
                                     <?php if ($i == 8) echo "<br>" ?>
                                     <?php if ($i == 16) echo "<br>" ?>
                                     <?php if ($i == 20) echo "<br>" ?>
                                     <?php if ($i == 24) echo "<br>" ?>
                                     <?php if ($i == 28) echo "<br>" ?>
                                     <?php if ($i == 32) echo "<br>" ?>
                                     <?php if ($i == 36) echo "<br>" ?>
                                     <?php if ($i == 40) echo "<br>" ?>
                                     <?php if ($i == 44) echo "<br>" ?>
                                     <?php if ($i == 48) echo "<br>" ?>
                                     <?php if ($i == 52) echo "<br>" ?>
                                     <?php if ($i == 56) echo "<br>" ?>
                                     <?php if ($i == 60) echo "<br>" ?>
                                     <?php if ($i == 64) echo "<br>" ?>
                                 </div>




                                 <!-- start: BOOTSTRAP EXTENDED MODALS -->
                                 <div class="modal fade" id="Share_<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                     <div class="modal-dialog7">
                                          <?php
                                          $attributes = array('class' => 'form-horizontal', 'id' => '');
                                          echo form_open_multipart('admin/folders/', $attributes);
                                          ?>


                                         <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                 &times;
                                             </button>
                                             <h4 class="modal-title">Share With</h4>
                                         </div>
                                         <div class="modal-body">
                                             <div class="row">

                                                 <div class="col-md-12">


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

                                             <p>

                                                 <br>
                                                 <button type="submit"  class="btn btn-info">
                                                     <i class='icon-share'></i> Share
                                                 </button>
                                                 <button type="button" data-dismiss="modal" class="btn btn-danger">
                                                     Close
                                                 </button>
                                             </p>
                                         </div>
                                         <?php echo form_close(); ?>	
                                     </div>
                                 </div>

                                 <script>
                                      function show_field(item)
                                      {
         //hide all

         //document.getElementById('cc').style.display='none';
         //document.getElementById('rc_staff').style.display = 'none';

         //document.getElementById('rc_ministry').style.display = 'none';
         // document.getElementById('rc_hbcs').style.display = 'none';

         //document.getElementById('rc_grp').style.display='none';

         //----------------------

                                           if (item == 'ministry')
                                                document.getElementById('rc_ministry').style.display = 'block';
                                           if (item == 'hbc')
                                                document.getElementById('rc_hbcs').style.display = 'block';

                                           if (item == 'group')
                                                document.getElementById('rc_grp').style.display = 'block';

                                           return;

                                      }
         <?php
         if ($this->uri->segment(3) == 'files')
         {
              ?>
                                           show_field('None');
         <?php } ?>
                                 </script>

                            <?php endforeach ?>			

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<!-------------MODAL --------------->

<div class="modal fade" id="file" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
         <?php
             $attributes = array('class' => 'form-horizontal', 'id' => '');
             echo form_open_multipart('admin/folders/upload_file/' . $fld->id . '/1', $attributes);
         ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Upload file</h4>
                <div class="clearfix"></div>
            </div>

            <div class="clearfix"></div>
        </div>
        <p>
             <?php echo form_input('folder', $fld->title, 'id="folder"  class="form-control" style="display:none"'); ?>
             <?php echo form_input('id', $fld->id, 'id="id"  class="form-control" style="display:none" '); ?>

        <div class="clearfix"></div>

        <label class='col-sm-3 control-label' for='voucher_number'>Title </label>
        <div class="col-sm-8 input-group">
            <span class="input-group-addon"> <i class="icon-plus"></i> </span>
            <?php echo form_input('title', '', 'id="title"  class="form-control" '); ?>
            <i style="color:red"><?php echo form_error('title'); ?></i>
        </div>
        </p>

        <div class="clearfix"></div>
        <p>
        <div class="clearfix"></div>

        <label class='col-sm-3 control-label' for='description'>File Type</label>
        <div class="col-sm-8 input-group">
             <?php
                 $items = array('' => 'Select File Type',
                         "pdf" => "PDF",
                         "word" => "Word",
                         "csv" => "CSV",
                         "excel" => "Excel",
                         "image" => "Image",
                         "none" => "None",
                 );
                 echo form_dropdown('type', $items, (isset($result->type)) ? $result->type : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
             ?> <i style="color:red"><?php echo form_error('type'); ?></i>
        </div>
        </p>
        <div class="clearfix"></div>
        <p>
            <br>

            <label class='col-sm-3 control-label' for='voucher_number'>Upload file </label>
        <div class="col-sm-8 input-group">

            <input id='file' type='file' name='file' />
        </div>
        </p>


        <div class="clearfix"></div>


        <div class="modal-footer">
            <button type="submit"  class="btn btn-info">
                Save Changes
            </button>

            <button type="button" data-dismiss="modal" class="btn btn-default">
                Close
            </button>
        </div>
    </div><?php echo form_close(); ?>
</div>		







<script>
     $(document).ready(function ()
     {
          $('.list').click(function ()
          {
               $('#list').show('slow');
               $('#grid').hide();
          });
          $('.grid').click(function ()
          {
               $('#list').hide();
               $('#grid').show('slow');
          });

     });
</script>

