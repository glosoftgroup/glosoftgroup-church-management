<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Sms Subscriptions </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/sms_subscriptions/create', '<i class="icon-plus-sign-alt"></i> <span> Subscribe Member</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/sms_subscriptions', '<i class="icon-list"></i> <span> All Subscriptions</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($sms_subscriptions): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>	

                             <th >Member</th>
                             <th >Bible Quote</th>
                             <th >Daily Inspiration</th>
                             <th >Added On</th>
                             <th >Added By</th>
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($sms_subscriptions as $p):
                                       $u = $this->ion_auth->get_user($p->created_by);
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?>
                                          <td><?php echo $member[$p->member]; ?></td>
                                          <td>
                                               <?php if ($p->bible_quotes == 1)
                                                    echo '<span class="label label-success">Yes</span>';
                                               else
                                                    echo '<span class="label label-orange">No</span>';
                                               ?>
                                          </td>
                                          <td><?php if ($p->daily_inspirations == 1)
                                                    echo '<span class="label label-success">Yes</span>';
                                               else
                                                    echo '<span class="label label-orange">No</span>';
                                               ?></td>
                                          <td><?php echo date('d M Y', $p->created_on); ?></td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                          <td width='100'>
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/sms_subscriptions/edit/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-edit'></i> Edit
                                                              </a>
                                                          </li>

                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/sms_subscriptions/delete/' . $p->id . '/' . $page); ?>'>
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

         <?php echo $links; ?>
                     </div>
                 </div><?php else: ?>
                 <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?>
    </div>
</div>

