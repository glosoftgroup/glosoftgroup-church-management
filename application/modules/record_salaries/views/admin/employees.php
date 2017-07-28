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
                             <th>Pay Date</th>
                             <th>Employee</th>
                             <th>Basic Salary</th>
                             <th>Bank Details</th>
                             <th>Deductions</th>
                             <th>Allowances</th>

                             <th>NHIF/NSSF<br> Numbers</th>

                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;


                                  foreach ($record_salaries as $p):
                                       $i++;
                                       $u = $this->ion_auth->get_user($p->employee);
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>
                                          <td><?php echo date('l d F, Y', $p->salary_date); ?></td>				
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>					
                                          <td>KES. <?php echo number_format($p->basic_salary, 2); ?></td>
                                          <td><?php echo $p->bank_details; ?></td>
                                          <td>
                                               <?php
                                               echo 'NHIF - KES ' . number_format($p->nhif, 2) . '<br>';
                                               if (!empty($p->deductions))
                                               {
                                                    $dec = array();
                                                    $dec = explode(',', $p->deductions);

                                                    foreach ($dec as $d)
                                                    {
                                                         $vals = explode(':', $d);
                                                         echo $vals[0] . ' KES.' . number_format($vals[1], 2) . '<br>';
                                                    }
                                               }
                                               ?>
                                          </td>
                                          <td>
                                               <?php
                                               if (!empty($p->allowances))
                                               {
                                                    $all = array();
                                                    $all = explode(',', $p->allowances);

                                                    foreach ($all as $l)
                                                    {
                                                         $vals = explode(':', $l);
                                                         echo $vals[0] . ' KES.' . number_format($vals[1], 2) . '<br>';
                                                    }
                                               }
                                               ?>
                                          </td>

                                          <td><?php echo 'NHIF - ' . $p->nhif_no . '<br> NSSF - ' . $p->nssf_no; ?></td>

                                          <td width='30'>
                                              <div class='btn-group'>
                                                  <a class="btn btn-success btn-sm" href='<?php echo site_url('admin/record_salaries/slip/' . $p->id); ?>'><i class='icon-eye-open'></i> Pay Slip</a>
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