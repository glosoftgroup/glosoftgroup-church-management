<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Daily Inspirations </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Daily Inspiration" data-width="700" data-toggle="modal" data-placement="top" href="#Add_daily_inspiration">
                        <i class="icon-plus"></i> Add Daily Inspiration
                    </a>

                    <?php echo anchor('admin/daily_inspirations', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Daily_Inspirations')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($daily_inspirations): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Title</th>
                             <th>Message</th>	
                             <th>Status</th>
                             <th>Created On</th>	
                             <th>Created By</th>	
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($daily_inspirations as $p):
                                       $u = $this->ion_auth->get_user($p->created_by);
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><a data-toggle="modal" class="tooltips" data-original-title="View Details" data-placement="top" role="button" href="#modal<?php echo $p->id; ?>"><i class="icon-double-angle-right"></i> <?php echo $p->title; ?></a></td>
                                          <td><?php echo substr($p->message, 0, 89); ?></td>
                                          <td><?php if ($p->status == 1)
                              echo '<span class="label label-success">Live</span>';
                         else
                              echo '<span class="label label-orange">Draft</span>';
                         ?></td>
                                          <td><?php echo date('d M Y', $p->created_on); ?></td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                          <td >
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#Edit_<?php echo $p->id; ?>"><i class='icon-edit'></i> Edit
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#modal<?php echo $p->id; ?>">
                                                                  <i class='icon-share'></i> View
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/daily_inspirations/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Remove
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                  <div class="modal fade" id="modal<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Title: <?php echo $p->title; ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Status</span> 
                                                      <span class="col-sm-5"><?php if ($p->status == 1)
                              echo '<span class="label label-success">Live</span>';
                         else
                              echo '<span class="label label-orange">Draft</span>';
                         ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Message:</span> </p>
                                                  <hr /><?php echo $p->message; ?>


                                              </div>
                                              <div class="modal-footer">
                                                  <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">
                                                      Close
                                                  </button>

                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <!-----------------------------EDIT MODAL------------------------->	
                                  <div class="modal fade" id="Edit_<?php echo $p->id; ?>" tabindex="-1" data-width="600" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
              <?php
              $attributes = array('class' => 'form-horizontal', 'id' => '');
              echo form_open_multipart('admin/daily_inspirations/edit/' . $p->id . '/1', $attributes);
              ?>
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Edit Daily Inspirations</h4>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class=' col-sm-3 control-label' for='title'>Title <span class='required'>*</span></label><div class="col-sm-5">
              <?php echo form_input('title', $p->title, 'id="title_"  class="form-control" '); ?><i style="color:red"><?php echo form_error('title'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='first_name'>Status</label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
              <?php $items = array(1 => 'Live', 0 => 'Draft');
              echo form_dropdown('status', $items, (isset($result->status)) ? $result->status : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
              ?> <i style="color:red"><?php echo form_error('status'); ?></i>
                                                  </div>
                                                  </p>
                                                  <div class="clearfix"></div>															
                                                  <div class="modal-footer">

                                                      <textarea id="message"  class="autosize-transition form-control "  name="message"  /><?php echo set_value('message', (isset($p->message)) ? htmlspecialchars_decode($p->message) : ''); ?></textarea> <i style="color:red"><?php echo form_error('message'); ?></i>

                                                      <div class="clearfix"></div>
                                                      <br>

              <?php echo form_submit('submit', ($updType == 'edit') ? 'Update Changes' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                                                      <button type="button" data-dismiss="modal" class="btn btn-default">
                                                          Close
                                                      </button>
                                                  </div>
                                              </div><?php echo form_close(); ?>
                                          </div>

                                      </div>	
         <?php endforeach ?>
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
<div class="modal fade" id="Add_daily_inspiration" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
<?php
    $attributes = array('class' => 'form-horizontal', 'id' => '');
    echo form_open_multipart('admin/daily_inspirations/create/', $attributes);
?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Add New Daily Inspiration</h4>
                <div class="clearfix"></div>
            </div>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='title'>Title<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-bubble-2"></i> </span>
                    <input id='title' type='text' name='title' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='message'>Message<span class='required'>*</span></label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-clip"></i> </span>
                    <textarea id="message"  class="autosize-transition form-control "  name="message"  /><?php echo set_value('message', (isset($result->message)) ? htmlspecialchars_decode($result->message) : ''); ?></textarea><i style="color:red"><?php echo form_error('message'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='posted_by'>Posted By<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-user"></i> </span>
<?php echo form_dropdown('posted_by', $leader, (isset($result->posted_by)) ? $result->posted_by : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." '); ?> <i style="color:red"><?php echo form_error('posted_by'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <div class="modal-footer">


                <button type="submit" class="btn btn-primary">
                    Save Changes
                </button>
                <button type="button" data-dismiss="modal" class="btn btn-default">
                    Close
                </button>
            </div>
        </div><?php echo form_close(); ?>
    </div>

</div>
