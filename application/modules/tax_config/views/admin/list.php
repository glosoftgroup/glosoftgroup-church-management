<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Advance Salaries </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/tax_config/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Tax')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/tax_config', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Taxes')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>

        <div class="panel-body" style="display: block;">   
            <div class="widget-main">

                <?php if ($tax_config): ?>



                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                             <thead>
                             <th>#</th>
                             <th>Name</th>
                             <th>Percentage(%)</th>
                             <th>Created On </th>	
                             <th>Created By </th>					
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per; // OR  ($this->uri->segment(4)  * $per) -$per;
                                  }

                                  foreach ($tax_config as $p):
                                       $u = $this->ion_auth->get_user($p->created_by);
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo $p->name; ?></td>
                                          <td><?php echo $p->amount; ?> %</td>
                                          <td><?php echo date('d M Y', $p->created_on); ?></td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                          <td width='150'>
                                              <div class='btn-group'>
                                                  <a data-toggle="modal" style='color:white' class="btn btn-primary btn-sm" role="button" href="#Edit_<?php echo $p->id; ?>"><i class='icon-edit'></i>Edit</a>
                                                  <?php if ($p->name == "VAT" OR $p->name == "PAYE"): ?>


                                                  <?php else: ?>
                                                       <a class="btn btn-danger  btn-sm" onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/tax_config/delete/' . $p->id . '/' . $page); ?>'><i class='icon-trash'></i> Trash</a>
                                                  <?php endif ?>
                                              </div>
                                          </td>
                                      </tr>

                                  <div class="modal fade" id="Edit_<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
                                           <?php
                                           $attributes = array('class' => 'form-horizontal', 'id' => '');
                                           echo form_open_multipart('admin/tax_config/edit/' . $p->id . '/1', $attributes);
                                           ?>
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Edit Tax</h4>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='name'>Name </label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                      <?php echo form_input('name', $p->name, 'id="name_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('name'); ?></i>
                                                  </div>
                                                  </p>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div class='form-group'>
                                                  <label class=' col-sm-3 control-label' for='amount'>Percentage %</label><div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                      <?php echo form_input('amount', $p->amount, 'id="amount_"  class="form-control" '); ?>
                                                      <i style="color:red"><?php echo form_error('amount'); ?></i>
                                                  </div>
                                                  <div class="clearfix"></div>
                                              </div>
                                              </p>


                                              <div class="modal-footer">
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


                     </div>

                <?php else: ?>
                     <p class='text'><?php echo lang('web_no_elements'); ?></p>
            <?php endif ?>
        </div>