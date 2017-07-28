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


                <div class="toolbar-fluid">
                    <div class="information">
                        <div class="col-sm-3">
                            <div class="core-box">
                                <div class="heading">
                                    <i class=" circle-icon circle-green"><?php echo $count_months_lpo; ?></i>

                                    <h2>This month's orders </h2>
                                    <h5>KES. <?php echo number_format($months_lpo->total, 2); ?> </h5>
                                </div>


                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="core-box">
                                <div class="heading">
                                    <i class=" circle-icon circle-black"><?php echo $count_unpaid; ?></i>

                                    <h2>Awaiting Payment </h2>
                                    <h5>KES. <?php echo number_format($total_unpaid->total + $total_balance->total, 2); ?> </h5>
                                </div>


                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="core-box">
                                <div class="heading">
                                    <i class=" circle-icon circle-bricky"><?php echo $count_overdue; ?></i>

                                    <h2>Overdue orders </h2>
                                    <h5>KES. <?php echo number_format($total_overdue->total, 2); ?> </h5>
                                </div>


                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="core-box">
                                <div class="heading">
                                    <i class=" circle-icon circle-teal"><?php echo $count_paid; ?></i>

                                    <h2>Total Paid orders </h2>
                                    <h5>KES. <?php echo number_format($total_paid->total, 2); ?> </h5>
                                </div>


                            </div>
                        </div>



                    </div>
                </div>

                <div class='clearfix'></div>      
                <?php if ($purchase_order): ?>

                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">


                             <thead>
                             <th>#</th>
                             <th>Order Date</th>
                             <th>Supplier</th>
                             <th>Vat</th>
                             <th>Total Due</th>
                             <th>By</th>
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
                                       $i++;
                                       $payment = (object) $p->payment;
                                       $amount_paid = (object) $p->amount_paid;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>
                                          <td><?php echo date('d/m/Y', $p->purchase_date); ?></td>
                                          <td><?php echo $address_book[$p->supplier]; ?></td>
                                          <td><?php if ($p->vat == 1)
                              echo $tax->amount;
                         else
                              echo 0;
                                       ?> %</td>
                                          <td>
                                               <?php
                                               $vat = $tax->amount;
                                               if ($p->vat == 1)
                                               {
                                                    $t = ($p->total * $vat) / 100; //echo $vat;
                                                    echo 'KES ' . number_format($t + $p->total, 2);
                                               }
                                               else
                                               {
                                                    echo 'KES ' . number_format($p->total, 2);
                                               }

                                               if ($p->balance > 0)
                                                    echo '<br><b>Balance due</b> ' . number_format($p->balance, 2);
                                               ?>

                                               <?php //echo number_format($p->total,2); ?></td>
                                          <td><?php echo $u->first_name . ' ' . $u->last_name; ?></td>
                                          <td width="250">
              <?php if ($p->status == 3): ?>

                                                   <a data-toggle="modal"  class="demo btn btn-primary btn-sm" href="#View<?php echo $p->id; ?>">
                                                       <i class='icon-share'></i> View 
                                                   </a>
                   <?php if ($p->balance > 0): ?>
                                                        <a data-toggle="modal"  class="btn btn-success btn-sm" role="button" href="#modal<?php echo $p->id; ?>"> Pay </a>
                   <?php endif; ?>
                                                   <div class="btn-group">
                                                       <button class="btn btn-inverse btn-sm dropdown-toggle" data-toggle="dropdown">Payment Details <i class="icon-caret-down"></i></button>
                                                       <ul class="dropdown-menu pull-right">
                                                           <li><a href="#"><i class="icon-chevron-right"></i> <b>Date :</b> <?php echo date('d M Y', $payment->date); ?></a></li>
                                                           <li><a href="#"><i class="icon-chevron-right"></i>  <b>Amount:</b>  <?php echo number_format($amount_paid->total, 2); ?></a></li>

                                                           <li><a href="#"><i class="icon-chevron-right"></i>  <b>Type:</b>  <?php echo $payment->pay_type ?></a></li>
                                                           <li><a href='#'><i class="icon-chevron-right"></i>  <b>By:</b> <?php
                                                  $us = $this->ion_auth->get_user($payment->created_by);
                                                  echo $us->first_name . ' ' . $us->last_name;
                                                  ?></a></li>
                                                       </ul>

                                                   </div>

              <?php else: ?>
                                                   <div class='btn-group'>
                                                       <a data-toggle="modal" class="demo btn btn-primary btn-sm" href="#View<?php echo $p->id; ?>">
                                                           <i class='icon-share'></i> View 
                                                       </a>


                                                       <a data-toggle="modal"  class="btn btn-success btn-sm" role="button" href="#modal<?php echo $p->id; ?>">

                                                           <i class='icon-money'></i> Make Payment
                                                       </a>

                                                       <a class="btn btn-danger btn-sm" onClick="return confirm('<?php echo "Are you sure you want to void the purchase" ?>')" href='<?php echo site_url('admin/purchase_order/void/' . $p->id . '/' . $page); ?>'><i class="icon-trash"></i> Void</a>
              <?php endif; ?>

                                              </div>
                                          </td>
                                      </tr>


                                      <!-- Modal -->
                                  <div class="modal fade" id="modal<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">

                                      <form action="<?php echo site_url('admin/purchase_order/make_pay/' . $p->id); ?>" class='form-horizontal' method="POST" >

                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Payment To <span style="color:blue; text-decoration:underline"><?php echo $address_book[$p->supplier]; ?> </span><br>
                                                      Order Date <span style="color:blue; text-decoration:underline"><?php echo date('d/m/Y', $p->purchase_date); ?></span>

                                                      Due Date <span style="color:blue; text-decoration:underline"><?php echo date('d/m/Y', $p->due_date); ?></span>

                                                  </h4>
                                              </div>
                                              <div class="modal-body">

                                                  <div class='form-group'>
                                                      <label class=' col-sm-4 control-label' for='description'> Amount </label>
                                                      <div class="col-sm-5 input-group">
                                                           <?php
                                                           $vat = $tax->amount;
                                                           if ($p->vat == 1)
                                                           {
                                                                $t = ($p->total * $vat) / 100; //echo $vat;
                                                                echo 'KES ' . number_format($t + $p->total, 2);
                                                           }
                                                           else
                                                           {
                                                                echo 'KES ' . number_format($p->total, 2);
                                                           }
                                                           ?>
              <?php
              if ($p->balance > 0):
                   ?>
                                                               <dt>Balance Due</dt>
                                                               <dd> KES. <?php echo number_format($p->balance, 2); ?></dd>
              <?php endif; ?>
                                                      </div>
                                                  </div>

                                                  <div class="clearfix"></div>
                                                  <br>
                                                  <div class='form-group'>
                                                      <label class=' col-sm-4 control-label' for='description'>Payment Date<span class='required'>*</span></label>
                                                      <div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="icon-calendar"></i> </span>

                                                          <input type="text" name="pay_date" id="pay_date" class="form-control date-picker" >
                                                      </div>
                                                  </div>

                                                  <div class="clearfix"></div>
                                                  <br>
                                                  <div class='form-group'>
                                                      <label class=' col-sm-4 control-label' for='description'>Amount Paid<span class='required'>*</span></label>
                                                      <div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="icon-money"></i> </span>
                                                          <input type="text" name="amount" id="amount" value="" class="form-control" placeholder="Enter amount paid">
                                                      </div>
                                                  </div>
                                                  <div class="clearfix"></div>
                                                  <br>
                                                  <div class='form-group'>
                                                      <label class=' col-sm-4 control-label' for='description'>Payment Method<span class='required'>*</span></label>
                                                      <div class="col-sm-8 input-group">
                                                          <select name="pay_type" class="form-control search-select" >
                                                              <option value="Cash">Cash</option>
                                                              <option value="M-Pesa">M-Pesa</option>
                                                              <option value="Cheque">Cheque</option>
                                                              <option value="Bank Slip">Bank Slip</option>
                                                          </select>
                                                      </div>
                                                  </div>


                                                  <div class="clearfix"></div>
                                                  <br>
                                                  <div class='form-group'>
                                                      <label class=' col-sm-4 control-label' for='remarks'>Remarks </label><div class="col-sm-8">
                                                          <textarea id="remarks"  class="autosize-transition ckeditor1 form-control "  name="remarks"  /><?php echo set_value('remarks', (isset($result->remarks)) ? htmlspecialchars_decode($result->remarks) : ''); ?></textarea>
                                                          <i style="color:red"><?php echo form_error('remarks'); ?></i>
                                                      </div>
                                                  </div>
                                                  <br>

                                              </div>
                                              <div class="modal-footer">

                                                  <button type="submit" class="btn btn-info">
                                                      Save Changes
                                                  </button>
                                              </div>
                                          </div>
                                      </form>

                                  </div>

                                  <!--------------------------VIEW DETAIL---------------------------->
                                  <div id="View<?php echo $p->id; ?>" class="modal container fade" tabindex="-1" style="display: none;">

                                      <?php
                                      $details = $this->purchase_order_m->purchase_details($p->id);
                                      $supplier = $this->purchase_order_m->get_supplier($p->supplier);
                                      $tax = $this->purchase_order_m->tax();
                                      $address_book = $this->purchase_order_m->suppliers();
                                      ?>

                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                              &times;
                                          </button>
                                          <h4 class="modal-title">Purchase Order Details</h4>
                                          <div class="heading-elements">
                                              <button onClick="window.print();
                                                        return false" class="btn btn-primary" type="button"><span class="icon-print"></span> Print </button>

                                          </div>
                                      </div>
                                      <div class="modal-body">

                                          <!--------------BODY ------------------------------>

                                          <div class="slip col-sm-12">
                                              <div class="slip-content">
                                                  <div class="widget-main">

                                                      <div class="col-sm-12">

                                                          <div class="clearfix"></div>

                                                          <div class="date left">
                                                              <b>Purchase Order #<?php
                                                                   if ($p->id < 99)
                                                                        echo '0' . $p->id;
                                                                   else
                                                                        echo $p->id;
                                                                   ?></b><br>

                                                          </div>

                                                          <div class="clearfix"></div>
                                                          <br>

                                                          <div class="widget-main">

                                                              <div class="col-sm-6">
                                                                  <b style="text-decoration:underline">To:  <?php echo $supplier->business_name; ?></b>
                                                                  <br>
                                                                  <address>
                                                                      <strong>Contact Person: </strong><?php echo $supplier->contact_person; ?><br>
              <?php echo $supplier->address; ?> <br>
                                                                      Email: <?php echo $supplier->email; ?><br>

                                                                      <abbr title="Cell"><b>Cell:</b></abbr> <?php echo $supplier->phone; ?>
                                                                  </address>                                
                                                              </div>

                                                              <div class="col-sm-6 ">
                                                                  <div class="right">
                                                                      <b style="text-decoration:underline">Purchase Order</b><br>
                                                                      <br>
                                                                      <strong>Date: </strong> <?php echo date('M d, Y ', $p->purchase_date); ?><br>
                                                                      <strong>Reference:</strong> #<?php
                                                                      if ($p->id < 99)
                                                                           echo '0' . $p->id;
                                                                      else
                                                                           echo $p->id;
                                                                      ?><br>
                                                                      <strong>Payment due: </strong> <?php echo date('d M Y', $p->due_date); ?>

                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <div class="clearfix"></div>
                                                          <b>Attention:</b> <abbr title="name"><?php echo $supplier->contact_person; ?></abbr>
                                                          <br>
                                                          <br>
                                                          <b style="text-decoration:underline">Description</b>
                                                          <p>

                                                              <strong>We are pleased to confirm our purchase of the following Items:</strong>

                                                          </p>

                                                          <div class="col-sm-12 order-span headers">

                                                              <span width="3">No.</span>
                                                              <span width="67%">Description</span>

                                                              <span width="10%">Quantity</span>
                                                              <span width="10%">Amount</span>
                                                              <span width="10%">Total</span>
                                                          </div>
                                                          <div class="col-sm-12 order-span">
                                                               <?php
                                                               $i = 0;

                                                               foreach ($details as $post):

                                                                    $i++;
                                                                    ?>

                                                                   <span width="3%" ><?php echo $i; ?></span>
                                                                   <span width="67%"><?php echo $post->description; ?></span>
                                                                   <span width="10%"><?php echo $post->quantity; ?></span>
                                                                   <span width="10%"><?php echo number_format($post->unit_price, 2); ?></span>
                                                                   <span width="10%"><?php echo number_format($post->totals, 2); ?></span>

              <?php endforeach; ?>                                         

                                                          </div>

                                                          <div class="clearfix"></div>

                                                          <div class="widget-main">
                                                              <div class="col-sm-6">
                                                                  <b style="text-decoration:underline">Comment:</b><br>
              <?php echo $p->comment; ?>
                                                              </div>
                                                              <div class="col-sm-6">
                                                                  <div class="right">
                                                                      <strong><span>Subtotal:</span></strong>
                                                                      <strong> <?php echo number_format($p->total, 2); ?><em> KES</em></strong>
                                                                      <br>
                                                                      <strong><span>VAT: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></strong>
                                                                      <strong><?php
                                                                           $vat = $tax->amount;
                                                                           if ($p->vat == 1)
                                                                           {
                                                                                echo $tax->amount; //echo $vat;
                                                                           }
                                                                           else
                                                                           {
                                                                                echo 0; //echo $vat;
                                                                           }
                                                                           ?>  %</strong>
                                                                      <br>
                                                                      <strong><span>Total: </span></strong>

                                                                      <b style="border-bottom:1px solid #333"><span></span>
                                                                           <?php
                                                                           $vat = $tax->amount;
                                                                           if ($p->vat == 1)
                                                                           {
                                                                                $t = ($p->total * $vat) / 100; //echo $vat;
                                                                                echo number_format($t + $p->total, 2);
                                                                           }
                                                                           else
                                                                           {
                                                                                echo number_format($p->total, 2);
                                                                           }
                                                                           ?> <em> KES</em></b>


                                                                  </div>


                                                              </div>
                                                          </div>
                                                      </div>
                                                      <h3></h3>
                                                      <p>
                                                      </p>


                                                  </div>


                                                  <div class="widget-main">
                                                      <div class="col-sm-6">
                                                          <br>
                                                          <br>
                                                          <strong style="border-top:1px solid #000"> Prepared By</strong>

                                                      </div>
                                                      <div class="col-sm-6">
                                                          <br>
                                                          <br>
                                                          <strong class="right" style="border-top:1px solid #000"> Approved By </strong>
                                                      </div>


                                                  </div>
                                                  <div class="widget-main">

                                                      <br>
                                                      <div class="span11 center">
                                                          <b>NB:</b> Purchase Order only accepted when stamped and signed.
                                                      </div>
                                                  </div>
                                                  <div class="center" style="border-top:1px solid #ccc">		
                                                      <span class="center" style="font-size:0.8em !important;text-align:center !important;">Box 1254 Nairobi Tel:12548 Cell 254 7545858</span>
                                                  </div>

                                              </div>  
                                          </div>  


                                      </div>	
                                      <div class="modal-footer">
                                          <button type="button" data-dismiss="modal" class="btn btn-default">
                                              Close
                                          </button>

                                      </div>
                                  </div>	




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