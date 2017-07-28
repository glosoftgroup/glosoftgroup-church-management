<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Users</h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/groups/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Group')) . '</span>', 'class="btn btn-primary"'); ?> 

                    <?php echo anchor('admin/groups', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Groups')) . '</span>', 'class="btn btn-info"'); ?> 


                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($groups): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Name</th>
                             <th>Description</th>
                             <th>Members</th>
                             <th>Created On</th>
                             <th>Created By</th>
                             <th><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($groups as $p):
                                       $u = $this->ion_auth->get_user($p->created_by);
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo $p->name; ?></td>
                                          <td><?php echo $p->description; ?></td>
                                          <td><?php echo date('d M Y', $p->created_on); ?></td>
                                          <td></td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                          <td ><a class='btn-primary btn btn-sm' href='<?php echo site_url('admin/groups/edit/' . $p->id . '/' . $page); ?>'><?php echo lang('web_edit'); ?></a></td>

                                      </tr>
                                 <?php endforeach ?>
                             </tbody>

                         </table>

                         <?php echo $links; ?>
                     </div>
                 </div>
             </div>
        <?php else: ?>
             <p class='text'><?php echo lang('web_no_elements'); ?></p>
    <?php endif ?>
</div>

