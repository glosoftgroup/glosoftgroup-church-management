<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Folders </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a data-toggle="modal" class="btn btn-primary" role="button" href="#New">
                        <i class='icon-plus'></i> Add Folder
                    </a>
                    <?php echo anchor('admin/folders', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Folders')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div> 

        <?php if ($folders): ?>

                 <div class="panel-body">
                     <div id="pricing_table_example1" class="row ">
                         <div class="col-sm-12">
                             <a href="#" class="btn btn-warning btn-sm grid" class=""><i class=" icon-windows"></i> Grid View</a>
                             <a href="#" class="btn btn-success btn-sm list" class=""><i class="icon-list"></i> List View</a>
                             <hr>

                             <div id="grid">

                                 <?php
                                 $i = 0;
                                 if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                 {
                                      $i = ($this->uri->segment(4) - 1) * $per;
                                 }
                                 foreach ($folders as $p):
                                      $i++;
                                      ?>

                                      <div class="pricing-table col-sm-3 col-xs-12 folder">
                                          <a href="#" class="">
                                              <br>
                                              <h3><?php echo $p->title; ?>
                                                  <br>
                                                  <br>
                                                  <a data-toggle="modal" style='color:#000; font-size:12px;' class="" role="button" href="#file_<?php echo $p->id; ?>">
                                                      <i class='icon-plus'></i> Add Files
                                                  </a>
                                              </h3>
                                          </a>
                                          <a data-toggle="modal" style='color:#000' class="" role="button" href="#Edit_<?php echo $p->id; ?>">
                                              <i class='icon-edit'></i> Edit Folder
                                          </a>
                                          &nbsp;&nbsp;
                                          <a role='menuitem' style='color:#000' tabindex='-1' href='<?php echo site_url('admin/folders/files/' . $p->id . '/' . $page); ?>'>
                                              <i class='icon-share'></i> View Files
                                          </a>

                                      </div>

                                      <!-----------------------------EDIT MODAL------------------------->
                                      <div class="modal fade" id="Edit_<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                          <div class="modal-dialog7">
                                               <?php
                                               $attributes = array('class' => 'form-horizontal', 'id' => '');
                                               echo form_open_multipart('admin/folders/edit/' . $p->id . '/1', $attributes);
                                               ?>
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                          &times;
                                                      </button>
                                                      <h4 class="modal-title">Edit Folder Details</h4>
                                                      <div class="clearfix"></div>
                                                  </div>

                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='voucher_number'>Title </label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-plus"></i> </span>
                                                      <?php echo form_input('title', $p->title, 'id="title"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('title'); ?></i>
                                                  </div>
                                                  </p>

                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='description'>Description</label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-edit"></i> </span>
                                                      <textarea id="description"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($p->description)) ? htmlspecialchars_decode($p->description) : ''); ?></textarea>
                                                      <i style="color:red"><?php echo form_error('description'); ?></i>
                                                  </div>
                                                  </p>
                                                  <div class="clearfix"></div>
                                              </div>

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


                                      <div class="modal fade" id="file_<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                          <div class="modal-dialog7">
                                               <?php
                                               $attributes = array('class' => 'form-horizontal', 'id' => '');
                                               echo form_open_multipart('admin/folders/upload_file/' . $p->id . '/1', $attributes);
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
                                                   <?php echo form_input('folder', $p->title, 'id="folder"  class="form-control" style="display:none"'); ?>
                                                   <?php echo form_input('id', $p->id, 'id="id"  class="form-control" style="display:none"'); ?>

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


                                 <?php endforeach ?>			

                             </div>
                         </div>
                     </div>
                 </div>


                 <div class="panel-body" style="display: block;">   
                     <div class="widget-main" id="list" style="display:none">



                         <div class='clearfix'></div>

                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1" >

                             <thead>
                             <th>#</th>
                             <th>Title</th>
                             <th>Description</th>	
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($folders as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					<td><?php echo $p->title; ?></td>
                                          <td><?php echo $p->description; ?></td>
                                          <td width='100'>
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:#000' class="" role="button" href="#Edit_<?php echo $p->id; ?>">
                                                                  <i class='icon-edit'></i> Edit
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/folders/files/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-share'></i> View
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/folders/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Remove
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>

                                      <!-----------------------------EDIT MODAL------------------------->
                                  <div class="modal fade" id="Edit_<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog7">
                                           <?php
                                           $attributes = array('class' => 'form-horizontal', 'id' => '');
                                           echo form_open_multipart('admin/folders/edit/' . $p->id . '/1', $attributes);
                                           ?>
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Edit Folder Details</h4>
                                                  <div class="clearfix"></div>
                                              </div>

                                              <div class="clearfix"></div>
                                          </div>
                                          <p>
                                          <div class="clearfix"></div>
                                          <div id="entry1" class="clonedInput">
                                              <label class='col-sm-3 control-label' for='voucher_number'>Title </label>
                                              <div class="col-sm-8 input-group">
                                                  <span class="input-group-addon"> <i class="icon-plus"></i> </span>
                                                  <?php echo form_input('title', $p->title, 'id="title"  class="form-control" '); ?>
                                                  <i style="color:red"><?php echo form_error('title'); ?></i>
                                              </div>
                                              </p>

                                              <div class="clearfix"></div>
                                          </div>
                                          <p>
                                          <div class="clearfix"></div>
                                          <div id="entry1" class="clonedInput">
                                              <label class='col-sm-3 control-label' for='description'>Description</label>
                                              <div class="col-sm-8 input-group">
                                                  <span class="input-group-addon"> <i class="icon-edit"></i> </span>
                                                  <textarea id="description"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($p->description)) ? htmlspecialchars_decode($p->description) : ''); ?></textarea>
                                                  <i style="color:red"><?php echo form_error('description'); ?></i>
                                              </div>
                                              </p>
                                              <div class="clearfix"></div>
                                          </div>

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




                             <?php endforeach ?>
                             </tbody>

                         </table>

                         <?php echo $links; ?><?php else: ?>
                         <p class='text'><?php echo lang('web_no_elements'); ?></p>
                <?php endif ?>
            </div>
        </div>



    </div>
</div>


<!-----------------------------EDIT MODAL------------------------->
<div class="modal fade" id="New" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
         <?php
             $attributes = array('class' => 'form-horizontal', 'id' => '');
             echo form_open_multipart('admin/folders/create', $attributes);
         ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Edit Folder Details</h4>
                <div class="clearfix"></div>
            </div>

            <div class="clearfix"></div>
        </div>
        <p>
        <div class="clearfix"></div>
        <div id="entry1" class="clonedInput">
            <label class='col-sm-3 control-label' for='voucher_number'>Title </label>
            <div class="col-sm-8 input-group">
                <span class="input-group-addon"> <i class="icon-plus"></i> </span>
                <?php echo form_input('title', '', 'id="title"  class="form-control" '); ?>
                <i style="color:red"><?php echo form_error('title'); ?></i>
            </div>
            </p>

            <div class="clearfix"></div>
        </div>
        <p>
        <div class="clearfix"></div>
        <div id="entry1" class="clonedInput">
            <label class='col-sm-3 control-label' for='description'>Description</label>
            <div class="col-sm-8 input-group">
                <span class="input-group-addon"> <i class="icon-edit"></i> </span>
                <textarea id="description"  class="autosize-transition ckeditor1 form-control "  name="description"  /></textarea>
                <i style="color:red"><?php echo form_error('description'); ?></i>
            </div>
            </p>
            <div class="clearfix"></div>
        </div>

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

