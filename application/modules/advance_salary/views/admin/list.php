<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Advance Salaries </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/advance_salary/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Deduction')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/advance_salary', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Deduction')) . '</span>', 'class="btn btn-info"'); ?> 
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
                                          <td><a class="tooltips" data-original-title="View Profile" data-placement="top" href='<?php echo site_url('admin/members/profile/' . $p->employee); ?>'><i class="icon-double-angle-right"></i> <?php echo $employees[$p->employee]; ?></a></td>
                                          <td><?php echo number_format($p->amount, 2); ?></td>
                                          <td><?php echo $p->comment; ?></td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>

                                          <td width='30'>
                                              <div class='btn-group'>
                                                  <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                      <i class='icon-cog'></i> Action <span class='caret'></span>
                                                  </a>
                                                  <ul role='menu' class='dropdown-menu pull-right'>

                                                      <li><a  href='<?php echo site_url('admin/advance_salary/edit/' . $p->id . '/' . $page); ?>'><i class='icon-edit'></i> Edit</a></li>

                                                      <li><a  onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/advance_salary/delete/' . $p->id . '/' . $page); ?>'><i class='icon-trash'></i> Trash</a></li>
                                                  </ul>
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

