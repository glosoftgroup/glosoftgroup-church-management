<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Advance Salaries </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/record_salaries/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Salary Records')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/record_salaries', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Salary Records')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>

        <div class="panel-body" style="display: block;">   
            <div class="widget-main">

                <?php if ($record_salaries): ?>



                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                             <thead>
                             <th>#</th>
                             <th>Salary For</th>
                             <th>Number of <br>Employees Paid</th>	
                             <th>Total Basic<br> Salary</th>	
                             <th>Comment</th>	
                             <th>Processed By</th>	
                             <th width="30"><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per; // OR  ($this->uri->segment(4)  * $per) -$per;
                                  }

                                  foreach ($record_salaries as $p):
                                       $i++;
                                       $u = $this->ion_auth->get_user($p->created_by);
                                       $emp = $this->record_salaries_m->count_employees($p->salary_date);
                                       $tots = $this->record_salaries_m->total_salo($p->salary_date);
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>
                                          <td><?php echo date('l d F, Y', $p->salary_date); ?></td>
                                          <td><?php if ($emp == 1)
                              echo $emp . ' Employee';
                         else
                              echo $emp . ' Employees';
                         ?> </td>
                                          <td>KES. <?php echo number_format($tots->total, 2); ?></td>
                                          <td><?php echo $p->comment; ?></td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>

                                          <td >
                                              <div class='btn-group'>
                                                  <a class="btn btn-success btn-sm" href='<?php echo site_url('admin/record_salaries/employees/' . $p->salary_date); ?>'><i class='icon-eye-open'></i> View Paid Employees</a>

                                              </div>
                                          </td>
                                      </tr>
         <?php endforeach ?>
                             </tbody>

                         </table>


                     </div>

    <?php else: ?>
                     <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?>
        </div>
    </div>
</div>