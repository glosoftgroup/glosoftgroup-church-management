<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Purchase Orders </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/purchase_order/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Purchase Orders')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/purchase_order', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Purchase Orders')) . '</span>', 'class="btn btn-info"'); ?> 
                     <?php echo anchor('admin/purchase_order/voided', '<i class="icon-list">
                </i> Voided Purchase Orders', 'class="btn btn-warning"'); ?>
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">




                <div class='clearfix'></div>      
                <?php if ($purchase_order): ?>

                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th>
                             <th>Order Date</th>
                             <th>Voided On</th>
                             <th>Supplier</th>
                             <th>Vat</th>
                             <th>Total Amount</th>
                             <th>Prepared By</th>
                             <th>Voided By</th>
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per; // OR  ($this->uri->segment(4)  * $per) -$per;
                                  }

                                  foreach ($purchase_order as $p):
                                       $u = $this->ion_auth->get_user($p->created_by);
                                       $m = $this->ion_auth->get_user($p->modified_by);
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>
                                          <td><?php echo date('d/m/Y', $p->purchase_date); ?></td>
                                          <td><?php echo date('d/m/Y', $p->modified_on); ?></td>
                                          <td><?php echo $address_book[$p->supplier]; ?></td>
                                          <td><?php if ($p->vat == 1)
                              echo $tax->amount . '%';
                         else
                              echo 0.00;
                         ?></td>
                                          <td><?php echo number_format($p->total, 2); ?></td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                          <td><?php echo $m->first_name . ' ' . $m->last_name; ?></td>
                                          <td width="30">
                                              <div class='btn-group'>
                                                  <a class="btn btn-success btn-sm" href="<?php echo site_url('admin/purchase_order/order/' . $p->id . '/' . $page); ?>"><i class="icon-eye-open"></i> View Purchase Order </a>

                                              </div>
                                          </td></tr>
         <?php endforeach ?>
                             </tbody>

                         </table>

         <?php echo $links; ?>
                     </div>
                 </div>


    <?php else: ?>
                 <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?>
    </div>
</div>