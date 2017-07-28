<div class="head"> 
    <div class="icon"><span class="icosg-target1"></span> </div>
    <h2>  Account Types  </h2>
    <div class="right">  
         <?php echo anchor('admin/account_types/create/' . $page, '<i class="icon-plus"></i> ' . lang('web_add_t', array(':name' => 'Account Types')), 'class="btn btn-primary"'); ?>

        <?php echo anchor('admin/account_types', '<i class="icon-list">
                </i> ' . lang('web_list_all', array(':name' => 'Account Types')), 'class="btn btn-primary"'); ?> 

    </div>
</div>


<?php if ($account_types): ?>
         <div class="block-fluid">
             <table class="fpTable" cellpadding="0" cellspacing="0" width="100%">
                 <thead>
                 <th>#</th><th>Name</th><th>Description</th>	<th ><?php echo lang('web_options'); ?></th>
                 </thead>
                 <tbody>
                      <?php
                      $i = 0;
                      if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                      {
                           $i = ($this->uri->segment(4) - 1) * $per; // OR  ($this->uri->segment(4)  * $per) -$per;
                      }

                      foreach ($account_types as $p):
                           $i++;
                           ?>
                          <tr>
                              <td><?php echo $i . '.'; ?></td>					<td><?php echo $p->name; ?></td>
                              <td><?php echo $p->description; ?></td>

                              <td width='30'>
                                  <div class='btn-group'>
                                      <button class='btn dropdown-toggle' data-toggle='dropdown'>Action <i class='icon-caret-down'></i></button>
                                      <ul class='dropdown-menu pull-right'>
                                          <li><a href='<?php echo site_url('admin/account_types/edit/' . $p->id . '/' . $page); ?>'><i class='icon-eye-open'></i> View</a></li>
                                          <li><a  href='<?php echo site_url('admin/account_types/edit/' . $p->id . '/' . $page); ?>'><i class='icon-edit'></i> Edit</a></li>

                                          <li><a  onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/account_types/delete/' . $p->id . '/' . $page); ?>'><i class='icon-trash'></i> Trash</a></li>
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