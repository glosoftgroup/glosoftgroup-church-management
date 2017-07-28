<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Pledges </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/pledges/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Pledges')) . '</span>', 'class="btn btn-primary"'); ?> 

                    <?php echo anchor('admin/pledges', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Pledges')) . '</span>', 'class="btn btn-info"'); ?> 

                    <?php echo anchor('admin/pledges/paid', '<i class="icon-money"></i> <span> Paid Pledges</span>', 'class="btn btn-success"'); ?> 

                    <?php echo anchor('admin/pledges/pending', '<i class="icon-list-alt"></i> <span> Pending Pledges</span>', 'class="btn btn-dark-grey"'); ?> 

                    <?php echo anchor('admin/pledges/voided', '<i class="icon-list-alt"></i> <span> Voided Pledges</span>', 'class="btn btn-warning"'); ?> 

                    <button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
                        Export Data <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-light pull-right">
                        <li>
                            <a href="#" class="export-pdf" data-table="#sample_1" data-ignoreColumn ="3,4"> Save as PDF </a>
                        </li>
                        <li>
                            <a href="#" class="export-csv" data-table="#sample_1" data-ignoreColumn ="3,4"> Save as CSV </a>
                        </li>													
                        <li>
                            <a href="#" class="export-excel" data-table="#sample_1" data-ignoreColumn ="3,4"> Export to Excel </a>
                        </li>
                        <li>
                            <a href="#" class="export-doc" data-table="#sample_1" data-ignoreColumn ="3,4"> Export to Word </a>
                        </li>
                    </ul>
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
                             <th>Status</th>
                             <th>Remarks</th>	
                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($pledges as $p):
                                       $i++;
                                       $paids = (object) $p->paid;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><?php echo date('d M Y', $p->date); ?></td>
                                          <td><a class="tooltips" data-original-title="View Details" data-placement="top" data-toggle="modal" href="#modal_<?php echo $p->id; ?>"><i class="icon-double-angle-right"></i> <?php echo $p->title; ?></a></td>
                                          <td>
                                               <?php if (is_numeric($p->member))
                                               {
                                                    ?>
                                                   <a class="tooltips" data-original-title="View Profile" data-placement="top" href="<?php echo site_url('admin/members/profile/' . $p->member) ?>"><i class="icon-double-angle-right"></i> <?php echo $members[$p->member]; ?></a>
                                              <?php
                                              }
                                              else
                                              {
                                                   ?>
                                                    <?php echo $p->member . ' [' . $p->others . ']'; ?>
                                               <?php } ?>
                                          </td>
                                          <td>
                                               <?php
                                               if ($p->status == 2)
                                                    echo number_format($paids->total);
                                               else
                                                    echo number_format($p->amount, 2);
                                               ?>
                                          </td>
                                          <td><?php echo date('d M Y', $p->expected_pay_date); ?></td>
                                          <td><?php
                                               if ($p->status == 1)
                                               {
                                                    echo '<span class="label label-warning"> Pending</span> ';

                                                    $now = time(); // or your date as well
                                                    $p_date = date('Y-m-d', $p->expected_pay_date);
                                                    $act_date = strtotime($p_date);
                                                    $datediff = $act_date - $now;
                                                    $days = floor($datediff / (60 * 60 * 24));
                                                    if ($days < 0)
                                                    {
                                                         echo ' <span class="label label-danger"> Overdue </span>';
                                                    }
                                                    elseif (0 == $days)
                                                    {
                                                         echo ' <span class="label label-info"> ' . $days . ' Days to go  </span>';
                                                    }
                                                    else
                                                    {
                                                         echo ' <span class="label label-info">' . $days . ' Day(s) to go </span>';
                                                    }
                                               }
                                               elseif ($p->status == 2)
                                               {
                                                    echo '<span class="label label-success">Paid</span>';
                                               }
                                               else
                                               {
                                                    echo '<span class="label label-inverse">Voided</span>';
                                               }
                                               ?></td>
                                          <td><?php echo $p->remarks; ?></td>
                                          <td width='100'>
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
              <?php if ($p->status == 1)
              {
                   ?>
                                                               <li role='presentation'>
                                                                   <a data-toggle="modal" style='color:green' role="button" href="#Pay<?php echo $p->id; ?>">

                                                                       <i class='icon-money'></i> Make Payment
                                                                   </a>
                                                               </li>
              <?php } ?>
                                                          <li role='presentation'>

                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#modal_<?php echo $p->id; ?>">
                                                                  <i class='icon-share'></i> View Details

                                                              </a>
                                                          </li>
              <?php if ($p->status == 1)
              {
                   ?>
                                                               <li role='presentation'>
                                                                   <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('Are you sure you want to void this pledge. Action is irreversible!!')" href='<?php echo site_url('admin/pledges/void/' . $p->id . '/' . $page); ?>'>
                                                                       <i class='icon-trash'></i> Void
                                                                   </a>
                                                               </li>
              <?php } ?>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>

                                      </tr>

                                      <!-- Modal -->
                                  <div class="modal fade" id="Pay<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <form action="<?php echo site_url('admin/pledges/payment/' . $p->id); ?>" class='form-horizontal' method="POST" >

                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                          &times;
                                                      </button>
                                                      <h4 class="modal-title">Payment Made By <span style="color:blue; text-decoration:underline"><?php if (is_numeric($p->member))
              {
                   ?>
                   <?php echo $members[$p->member]; ?>
              <?php
              }
              else
              {
                   ?>
                                                                    <?php echo $p->member . ' [' . $p->others . ']'; ?>
                                                               <?php } ?></span>
                                                          For <span style="color:blue; text-decoration:underline"><?php echo $p->title; ?></span></h4>
                                                  </div>
                                                  <div class="modal-body">

                                                      <div class='form-group'>
                                                          <label class=' col-sm-4 control-label' for='description'>Pledged Balance </label>
                                                          <div class="col-sm-5 input-group">
              <?php echo number_format($p->amount, 2); ?>
                                                          </div>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                      <br>
                                                      <div class='form-group'>
                                                          <label class=' col-sm-4 control-label' for='description'>Amount Paid<span class='required'>*</span></label>
                                                          <div class="col-sm-8 input-group">
                                                              <span class="input-group-addon"> <i class="icon-money"></i> </span>
                                                              <input type="text" name="amount" id="amount" value="<?php echo $p->amount; ?>" class="form-control" placeholder="Enter amount paid">
                                                          </div>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                      <br>
                                                      <div class='form-group'>
                                                          <label class=' col-sm-4 control-label' for='description'>Payment Method<span class='required'>*</span></label>
                                                          <div class="col-sm-8 input-group">
                                                              <select name="payment_method" class="form-control search-select" >
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
                                                          <label class=' col-sm-4 control-label' for='description'>Bank Deposited</label>
                                                          <div class="col-sm-8 input-group">
              <?php
              echo form_dropdown('bank', array('' => 'Select Bank') + $banks, (isset($result->bank)) ? $result->bank : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
              ?>

                                                          </div>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                      <br>
                                                      <div class='form-group'>
                                                          <label class=' col-sm-4 control-label' for='description'>Transaction No.<span class='required'>*</span></label>
                                                          <div class="col-sm-8 input-group">
                                                              <span class="input-group-addon"> <i class="clip-link"></i> </span>
                                                              <input type="text" name="transaction_no" id="transaction_no" class="form-control" placeholder="Enter transaction no.">
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
                                  </div>

                                  <div class="modal fade" id="modal_<?php echo $p->id; ?>" tabindex="-1" data-width="600" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Pledge Date: <?php echo date('d M Y', $p->date); ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Title:</span> 
                                                      <span class="col-sm-4"><?php echo $p->title; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Member:</span> 
                                                      <span class="col-sm-4"><?php if (is_numeric($p->member))
                                             {
                                                  ?>
                   <?php echo $members[$p->member]; ?>
                                                           <?php
                                                           }
                                                           else
                                                           {
                                                                ?>
                                                               <?php echo $p->member . ' [' . $p->others . ']'; ?>
              <?php } ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Amount:</span> 
                                                      <span class="col-sm-4"><?php
              if ($p->status == 2)
                   echo number_format($paids->total);
              else
                   echo number_format($p->amount, 2);
              ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Expected Pay Date:</span> 
                                                      <span class="col-sm-4"><?php echo date('d M Y', $p->expected_pay_date); ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Status:</span> 
                                                      <span class="col-sm-6">
                                                           <?php
                                                           if ($p->status == 1)
                                                           {
                                                                echo '<span class="label label-warning"> Pending</span> ';

                                                                $now = time(); // or your date as well
                                                                $p_date = date('Y-m-d', $p->expected_pay_date);
                                                                $act_date = strtotime($p_date);
                                                                $datediff = $act_date - $now;
                                                                $days = floor($datediff / (60 * 60 * 24));
                                                                if ($days < 0)
                                                                {
                                                                     echo ' <span class="label label-danger"> Overdue </span>';
                                                                }
                                                                elseif (0 == $days)
                                                                {
                                                                     echo ' <span class="label label-info"> ' . $days . ' Days to go  </span>';
                                                                }
                                                                else
                                                                {
                                                                     echo ' <span class="label label-info">' . $days . ' Day(s) to go </span>';
                                                                }
                                                           }
                                                           elseif ($p->status == 2)
                                                           {
                                                                echo '<span class="label label-success">Paid</span>';
                                                           }
                                                           else
                                                           {
                                                                echo '<span class="label label-inverse">Voided</span>';
                                                           }
                                                           ?>

                                                      </span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Remarks:</span> 
                                                      <span class="col-sm-4"><?php echo $p->remarks; ?></span>
                                                  </p>

                                              </div>
                                              <div class="modal-footer">
                                                  <button aria-hidden="true" data-dismiss="modal" class="btn btn-danger">
                                                      Close
                                                  </button>

                                              </div>
                                          </div>
                                      </div>
                                  </div>

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





