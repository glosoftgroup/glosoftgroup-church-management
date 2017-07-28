<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Pledges </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/pledges/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Pledges')) . '</span>', 'class="btn btn-primary"'); ?> 

                    <?php echo anchor('admin/pledges', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Pledges')) . '</span>', 'class="btn btn-primary"'); ?> 

                    <?php echo anchor('admin/pledges/paid', '<i class="icon-money"></i> <span> Paid Pledges</span>', 'class="btn btn-success"'); ?> 

                    <?php echo anchor('admin/pledges/pending', '<i class="icon-list-alt"></i> <span> Pending Pledges</span>', 'class="btn btn-info"'); ?> 

                    <?php echo anchor('admin/pledges/voided', '<i class="icon-list-alt"></i> <span> Voided Pledges</span>', 'class="btn btn-warning"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($pledges): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Date</th>
                             <th>Title</th>
                             <th>Member</th>
                             <th>Amount</th>
                             <th>Expected Pay Date</th>			
                             <th>Voided By</th>
                             <th>Voided On</th>
                             <th>Remarks</th>	

                             </thead>
                             <tbody style="color:orange">
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($pledges as $p):
                                       $u = $this->ion_auth->get_user($p->modified_by);
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo date('d M Y', $p->date); ?></td>
                                          <td><?php echo $p->title; ?></td>
                                          <td>
                                               <?php if (is_numeric($p->member))
                                               {
                                                    ?>
                                                    <?php echo $members[$p->member]; ?>
                                               <?php
                                               }
                                               else
                                               {
                                                    ?>
                   <?php echo $p->member; ?>
              <?php } ?>
                                          </td>
                                          <td><?php echo number_format($p->amount, 2); ?></td>
                                          <td><?php echo date('d M Y', $p->expected_pay_date); ?></td>

                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                          <td><?php echo date('d M Y', $p->modified_on); ?></td>
                                          <td><?php echo $p->remarks; ?></td>

                                      </tr>
         <?php endforeach ?>
                             </tbody>

                         </table>

         <?php echo $links; ?>
                     </div>
                 </div>
             </div>
         </div>

    <?php else: ?>
         <p class='text'><?php echo lang('web_no_elements'); ?></p>
                   <?php endif ?>