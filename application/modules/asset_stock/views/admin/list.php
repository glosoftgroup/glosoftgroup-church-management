<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Asset Stock </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/asset_stock/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Asset Stock')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/asset_stock', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Asset Stock')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($asset_stock): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Date</th>
                             <th>Item</th>
                             <th>Suppliers</th>
                             <th>Quantity</th>
                             <th>Unit Price</th>
                             <th>Total</th>
                             <th>File</th>
                             <th>Description</th>	
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($asset_stock as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo date('d M Y', $p->date); ?></td>
                                          <td><?php echo $asset_items[$p->item]; ?></td>
                                          <td><?php echo $suppliers[$p->supplier]; ?></td>
                                          <td><?php echo $p->quantity; ?></td>
                                          <td><?php echo number_format($p->unit_price, 2); ?></td>
                                          <td><?php echo number_format($p->total, 2); ?></td>
                                          <td>
                                               <?php if (!empty($p->file))
                                               {
                                                    ?>
                                                   <a href="<?php echo site_url('uploads/files/' . $p->file) ?>"><i class='clip-clip'></i>  Download File</a>
                                              <?php
                                              }
                                              else
                                              {
                                                   ?>
                                                   <i>No attachment</i>
              <?php } ?>
                                          </td>
                                          <td><?php echo $p->description; ?></td>
                                          <td width='100'>
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/asset_stock/edit/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-edit'></i> Edit
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/asset_stock/view/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-share'></i> View
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/asset_stock/delete/' . $p->id . '/' . $page); ?>'>
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

