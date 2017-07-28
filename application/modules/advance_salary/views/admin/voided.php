<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Advance Salaries </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/advance_salary/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Deduction')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/advance_salary', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Deduction')) . '</span>', 'class="btn btn-info"'); ?> 
                     <?php echo anchor('admin/advance_salary/voided', '<i class="icon-list-alt"></i> <span> Voided Advance Salaries</span>', 'class="btn btn-warning"'); ?> 
                </div>
            </div>
        </div>

        <div class="panel-body" style="display: block;">   
            <div class="widget-main">

                <?php if ($advance_salary): ?>



                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                             <thead>
                             <th>#</th>
                             <th>Advance Date</th>
                             <th>Employee</th>
                             <th>Amount</th>
                             <th>Comment</th>	
                             <th>Processed By</th>	
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per; // OR  ($this->uri->segment(4)  * $per) -$per;
                                  }

                                  foreach ($advance_salary as $p):
                                       $u = $this->ion_auth->get_user($p->created_by);
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo date('d M Y', $p->advance_date); ?></td>
                                          <td><?php echo $employees[$p->employee]; ?></td>
                                          <td><?php echo number_format($p->amount, 2); ?></td>
                                          <td><?php echo $p->comment; ?></td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>

                                          <td width='30'>
                                              <div class='btn-group'>
                                                  <a data-toggle="modal" style='color:white' class="btn btn-success btn-sm" role="button" href="#modal<?php echo $p->id; ?>">
                                                      <i class='icon-share'></i> View Details
                                                  </a>
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
                                                  <h4 class="modal-title">Advance Date: <?php echo date('d M Y', $p->advance_date); ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Employee:</span> 
                                                      <span class="col-sm-4"><?php echo $employees[$p->employee]; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Amount:</span> 
                                                      <span class="col-sm-4"><?php echo number_format($p->amount, 2); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Comment:</span> 
                                                      <span class="col-sm-4"><?php echo $p->comment; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Voided By:</span> 
                                                      <span class="col-sm-4"><?php echo $u->first_name . ' ' . $u->last_name; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Description:</span> 
                                                      <span class="col-sm-4"><?php echo $p->description; ?></span>
                                                  </p>

                                              </div>
                                              <div class="modal-footer">
                                                  <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">
                                                      Close
                                                  </button>

                                              </div>
                                          </div>
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