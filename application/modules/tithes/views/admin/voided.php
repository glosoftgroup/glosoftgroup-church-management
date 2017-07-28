<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Voided Tithes </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/tithes/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Tithes')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/tithes', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Tithes')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/tithes/voided', '<i class="icon-list-alt"></i> <span> Voided Tithes</span>', 'class="btn btn-warning"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($tithes): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Voided on</th>
                             <th>Member</th>
                             <th>Amount</th>
                             <th>Voided By</th>

                             </thead>
                             <tbody style="color:orange">
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($tithes as $p):
                                       $u = $this->ion_auth->get_user($p->modified_by);
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo date('d M Y', $p->modified_on); ?></td>
                                          <td><?php echo $members[$p->member_id]; ?></td>
                                          <td><?php echo number_format($p->amount, 2); ?></td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>

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