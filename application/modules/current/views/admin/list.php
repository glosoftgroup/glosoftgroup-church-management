<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Current </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/current/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Current')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/current', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Current')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($current): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Date</th>
                             <th>Purchased</th>
                             <th>Posted on</th>
                             <th>Posted By</th>
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($current as $p):
                                       $i++;
                                       $u = $this->ion_auth->get_user($p->created_by);
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo date('d M Y', $p->date); ?></td>
                                          <td><?php echo number_format($p->total); ?> SMS</td>
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
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/current/edit/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-edit'></i> Edit
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/current/view/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-share'></i> View
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/current/delete/' . $p->id . '/' . $page); ?>'>
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
                 </div>
             </div>
         </div>

    <?php else: ?>
         <p class='text'><?php echo lang('web_no_elements'); ?></p>
                   <?php endif ?>