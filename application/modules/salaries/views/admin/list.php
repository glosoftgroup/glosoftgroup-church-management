<?php
    $banks = array('ABC Bank (Kenya)' => 'ABC Bank (Kenya)',
            'Bank of Africa' => 'Bank of Africa',
            'Bank of Baroda' => 'Bank of Baroda',
            'Bank of India' => 'Bank of India',
            'Barclays Bank' => 'Barclays Bank',
            'Century Deposit Taking Microfinance Limited' => 'Century Deposit Taking Microfinance Limited',
            'CFC Stanbic Bank' => 'CFC Stanbic Bank',
            'Chase Bank (Kenya)' => 'Chase Bank (Kenya)',
            'Citibank' => 'Citibank',
            'Commercial Bank of Africa' => 'Commercial Bank of Africa',
            'Consolidated Bank of Kenya' => 'Consolidated Bank of Kenya',
            'Cooperative Bank of Kenya' => 'Cooperative Bank of Kenya',
            'Credit Bank' => 'Credit Bank',
            'Development Bank of Kenya' => 'Development Bank of Kenya',
            'Diamond Trust Bank' => 'Diamond Trust Bank',
            'Dubai Bank Kenya' => 'Dubai Bank Kenya',
            'Ecobank' => 'Ecobank',
            'Equatorial Commercial Bank' => 'Equatorial Commercial Bank',
            'Equity Bank' => 'Equity Bank',
            'Family Bank' => 'Family Bank',
            'Faulu Kenya DTM Limited' => 'Faulu Kenya DTM Limited',
            'Fidelity Commercial Bank Limited' => 'Fidelity Commercial Bank Limited',
            'Fina Bank' => 'Fina Bank',
            'First Community Bank' => 'First Community Bank',
            'Giro Commercial Bank' => 'Giro Commercial Bank',
            'Guardian Bank' => 'Guardian Bank',
            'Gulf African Bank' => 'Gulf African Bank',
            'Habib Bank AG Zurich' => 'Habib Bank AG Zurich',
            'Habib Bank' => 'Habib Bank',
            'Housing Finance Company of Kenya' => 'Housing Finance Company of Kenya',
            'I&M Bank' => 'I&M Bank',
            'Imperial Bank Kenya' => 'Imperial Bank Kenya',
            'Jamii Bora Bank' => 'Jamii Bora Bank',
            'Kenya Commercial Bank' => 'Kenya Commercial Bank',
            'Kenya Women Finance Trust DTM Limited' => 'Kenya Women Finance Trust DTM Limited',
            'K-Rep Bank' => 'K-Rep Bank',
            'Middle East Bank Kenya' => 'Middle East Bank Kenya',
            'National Bank of Kenya' => 'National Bank of Kenya',
            'NIC Bank' => 'NIC Bank',
            'Oriental Commercial Bank' => 'Oriental Commercial Bank',
            'Paramount Universal Bank' => 'Paramount Universal Bank',
            'Prime Bank (Kenya)' => 'Prime Bank (Kenya)',
            'Rafiki Deposit Taking Microfinance' => 'Rafiki Deposit Taking Microfinance',
            'Remu DTM Limited' => 'Remu DTM Limited',
            'SMEP Deposit Taking Microfinance Limited' => 'SMEP Deposit Taking Microfinance Limited',
            'Standard Chartered Kenya' => 'Standard Chartered Kenya',
            'SUMAC DTM Limited' => 'SUMAC DTM Limited',
            'Trans National Bank Kenya' => 'Trans National Bank Kenya',
            'U&I Deposit Taking Microfinance Limited' => 'U&I Deposit Taking Microfinance Limited',
            'United Bank for Africa' => 'United Bank for Africa',
            'UWEZO Deposit Taking Microfinance Limited' => 'UWEZO Deposit Taking Microfinance Limited',
            'Victoria Commercial Bank' => 'Victoria Commercial Bank',
    );
?>


<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">All Salaried Employees </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/salaries/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Salaried Employee')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/salaries', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Salaried Employee')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>

        <div class="panel-body" style="display: block;">   
            <div class="widget-main">

                <?php if ($salaries): ?>



                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                             <thead>
                             <th>#</th>
                             <th>Employee</th>
                             <th>Basic Salary</th>
                             <th>Bank Details</th>
                             <th>Deductions</th>
                             <th>Allowances</th>
                             <th>Method</th>
                             <th>NHIF/NSSF</th>

                             <th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per; // OR  ($this->uri->segment(4)  * $per) -$per;
                                  }

                                  foreach ($salaries as $p):
                                       $i++;
                                       $u = $this->ion_auth->get_user($p->employee);
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><a data-toggle="modal"  class="tooltips" data-original-title="View Profile" data-placement="top" href="#View<?php echo $p->id; ?>">
                                                  <i class="icon-double-angle-right"></i>
                                                  <?php
                                                  $emp = $u->first_name . ' ' . $u->last_name;
                                                  echo isset($emp) ? $emp : ' ';
                                                  ?></a>
                                          </td>					
                                          <td>KES. <?php echo number_format($p->basic_salary, 2); ?></td>
                                          <td><?php echo $p->bank_name . '<br>ACC-';
                                    echo $p->bank_account_no;
                                                  ?></td>
                                          <td>
                                               <?php
                                               $decs = $this->salaries_m->get_deductions($p->id);
                                               echo 'NHIF - KES ' . number_format($p->nhif, 2) . '<br>';
                                               foreach ($decs as $d)
                                               {
                                                    echo $deductions[$d->deduction_id] . '<br>';
                                               }
                                               ?>
                                          </td>
                                          <td>
                                               <?php
                                               $allws = $this->salaries_m->get_allowance($p->id);
                                               foreach ($allws as $d)
                                               {
                                                    echo $allowances[$d->allowance_id] . '<br>';
                                               }
                                               ?>
                                          </td>
                                          <td><?php echo $p->salary_method; ?></td>
                                          <td><?php echo 'NHIF #- ' . $p->nhif_no . '<br> NSSF #- ' . $p->nssf_no; ?></td>

                                          <td width='30'>
                                              <div class='btn-group'>
                                                  <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                      <i class='icon-cog'></i> Action <span class='caret'></span>
                                                  </a>
                                                  <ul role='menu' class='dropdown-menu pull-right'>

                                                      <li role='presentation'>
                                                          <a data-toggle="modal" style='color:green' class="demo" href="#Edit_<?php echo $p->id; ?>">
                                                              <i class='icon-edit'></i> Edit Details
                                                          </a>
                                                      </li>
                                                      <li role='presentation'>
                                                          <a data-toggle="modal" style='color:green' class="demo" href="#View<?php echo $p->id; ?>">
                                                              <i class='icon-share'></i> View Details
                                                          </a>

                                                      </li>
                                                      <li role='presentation'>
                                                          <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/salaries/delete/' . $p->id . '/' . $page); ?>'>
                                                              <i class='icon-remove'></i> Remove
                                                          </a>
                                                      </li>
                                                  </ul>
                                              </div>
                                          </td>
                                      </tr>

                                      <!--------------------------VIEW DETAIL---------------------------->

                                  <div id="View<?php echo $p->id; ?>" class="modal container fade" tabindex="-1" style="display: none;">
                                      <div class="modal-dialog">
                                          <div class="modal-content">

                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Employee Salary Details</h4>

                                              </div>
                                              <div class="modal-body">
                                                  <!--------------BODY DETAILS----------------------------->
                                                  <div class="col-sm-6">
                                                      <div class='form-group'>
                                                          <label class=' col-sm-5 vvtitle' for='employee'>Employee</label>
                                                          <div class="col-sm-7 ">
                                                               <?php
                                                               $emp = $u->first_name . ' ' . $u->last_name;
                                                               echo isset($emp) ? $emp : ' ';
                                                               ?>
                                                          </div></div>
                                                      <div class="clearfix"></div>
                                                      <hr>
                                                      <div class='form-group'>
                                                          <label class=' col-sm-5 vvtitle' for='salary_method'>Salary Method </label>
                                                          <div class="col-sm-7 ">

              <?php echo $p->salary_method; ?>
                                                          </div>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                      <hr>

                                                      <div class='form-group'>
                                                          <label class=' col-sm-5 vvtitle' for='basic_salary'>Basic Salary </label>
                                                          <div class="col-sm-7 ">

              <?php echo $p->basic_salary; ?>
                                                          </div>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                      <hr>
                                                      <div class='form-group'>
                                                          <label class=' col-sm-5 vvtitle' for='bank_name'>Bank Name </label><div class="col-sm-7 ">

              <?php echo $p->bank_account_no; ?>
                                                          </div>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                      <hr>

                                                      <div class='form-group'>
                                                          <label class=' col-sm-5 vvtitle' for='bank_account_no'>Bank Account No </label><div class="col-sm-7 ">

              <?php echo $p->bank_account_no; ?>
                                                          </div>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                      <hr>
                                                  </div>
                                                  <!------------END ONE---------------->
                                                  <div class="col-sm-6">

                                                      <div class='form-group'>
                                                          <label class=' col-sm-5 vvtitle' for='groups'>Deductions  </label>
                                                          <div class="col-sm-7">
                                                               <?php
                                                               $decs = $this->salaries_m->get_deductions($p->id);
                                                               echo 'NHIF - KES ' . number_format($p->nhif, 2) . '<br>';
                                                               foreach ($decs as $d)
                                                               {
                                                                    echo $deductions[$d->deduction_id] . '<br>';
                                                               }
                                                               ?>
                                                          </div>
                                                      </div> 
                                                      <div class="clearfix"></div>
                                                      <hr> 
                                                      <div class='form-group'>
                                                          <label class=' col-sm-5 vvtitle' for='groups'>Allowances  </label>
                                                          <div class="col-sm-7">

                                                              <?php
                                                              $allws = $this->salaries_m->get_allowance($p->id);
                                                              foreach ($allws as $d)
                                                              {
                                                                   echo $allowances[$d->allowance_id] . '<br>';
                                                              }
                                                              ?>
                                                          </div>
                                                      </div> 
                                                      <div class="clearfix"></div>
                                                      <hr>



                                                      <div class='form-group'>
                                                          <label class=' col-sm-5 vvtitle' for='nhif_no'>NHIF Number </label><div class="col-sm-7 ">

              <?php echo $p->nhif_no; ?>
                                                          </div>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                      <hr>

                                                      <div class='form-group'>
                                                          <label class=' col-sm-5 vvtitle' for='nssf_no'>NSSF Number </label><div class="col-sm-7 ">

              <?php echo $p->nssf_no; ?>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="clearfix"></div>

                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" data-dismiss="modal" class="btn btn-default">
                                                      Close
                                                  </button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>	


                                  <!--------------------------EDIT DETAIL---------------------------->

                                  <div id="Edit_<?php echo $p->id; ?>" class="modal container fade" tabindex="-1" style="display: none;">
                                      <div class="modal-dialog">
                                           <?php
                                           $attributes = array('class' => 'form-horizontal', 'id' => '');
                                           echo form_open_multipart('admin/salaries/edit/' . $p->id, $attributes);
                                           ?>
                                          <div class="modal-content">

                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Employee Salary Details</h4>

                                              </div>
                                              <div class="modal-body">			
                                                  <div class="panel-body" style="display: block;">    

                                                      <div class="col-sm-6">
                                                          <div class='form-group'>
                                                              <label class=' col-sm-3 control-label' for='employee'>Employee <span class='required'>*</span></label>
                                                              <div class="col-sm-9 ">
                                                                   <?php
                                                                   echo form_dropdown('employee', array('' => 'Select Employee') + $users, (isset($p->employee)) ? $p->employee : '', ' class="search-select form-control" ');
                                                                   echo form_error('employee');
                                                                   ?>
                                                              </div></div>
                                                          <div class="clearfix"></div>
                                                          <br>
                                                          <br>
                                                          <div class='form-group'>
                                                              <label class=' col-sm-3 control-label' for='salary_method'>Salary Method <span class='required'>*</span></label>
                                                              <div class="col-sm-9 input-group">
                                                                  <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                                                                  <?php
                                                                  $items = array(
                                                                          "Monthly" => "Monthly",
                                                                          "Daily" => "Daily",
                                                                          "Weekly" => "Weekly",
                                                                  );
                                                                  echo form_dropdown('salary_method', $items, (isset($p->salary_method)) ? $p->salary_method : '', ' class="chzn-select form-control" data-placeholder="Select Options..." ');
                                                                  echo form_error('salary_method');
                                                                  ?>
                                                              </div></div>
                                                          <div class="clearfix"></div>
                                                          <br>
                                                          <br>
                                                          <div class='form-group'>
                                                              <label class=' col-sm-3 control-label' for='basic_salary'>Basic Salary <span class='required'>*</span></label>
                                                              <div class="col-sm-9 input-group">
                                                                  <span class="input-group-addon"> <i class="icon-money"></i> </span>
                                                                  <?php echo form_input('basic_salary', $p->basic_salary, 'id="basic_salary_"  class="form-control" '); ?>
              <?php echo form_error('basic_salary'); ?>
                                                              </div>
                                                          </div>
                                                          <div class="clearfix"></div>

                                                          <br>
                                                          <br>
                                                          <div class='form-group'>
                                                              <label class=' col-sm-3 control-label' for='basic_salary'>NHIF Amount <span class='required'>*</span></label>
                                                              <div class="col-sm-9 input-group">
                                                                  <span class="input-group-addon"> <i class="icon-money"></i> </span>
                                                                  <?php echo form_input('nhif', $p->nhif, 'id="nhif"  class="form-control" placeholder="E.g 0" '); ?>
              <?php echo form_error('nhif'); ?>

                                                              </div>
                                                          </div>
                                                          <div class="clearfix"></div>
                                                          <br>
                                                          <br>
                                                          <div class='form-group'>
                                                              <label class=' col-sm-3 control-label' for='groups'>Deductions  </label>
                                                              <div class="col-sm-9">

                                                                  <?php
                                                                  $deds = $this->salaries_m->get_emp_deductions($p->id);
                                                                  $dlist = array();
                                                                  foreach ($deds as $d)
                                                                  {
                                                                       $dlist[] = $d->deduction_id;
                                                                  }
                                                                  echo form_dropdown('deductions[]', $dd, $dlist, ' multiple="multiple" class="form-control search-select"');
                                                                  ?>
                                                              </div>
                                                          </div> 
                                                          <div class="clearfix"></div>
                                                          <br>
                                                          <br>
                                                          <div class='form-group'>
                                                              <label class=' col-sm-3 control-label' for='groups'>Allowances  </label>
                                                              <div class="col-sm-9">

                                                                  <?php
                                                                  $alls = $this->salaries_m->get_emp_allowances($p->id);
                                                                  $alist = array();
                                                                  foreach ($alls as $a)
                                                                  {
                                                                       $alist[] = $a->allowance_id;
                                                                  }
                                                                  echo form_dropdown('allowances[]', $ll, $alist, ' multiple="multiple" class="form-control search-select "');
                                                                  ?>
                                                              </div>
                                                          </div> 
                                                      </div>
                                                      <div class="col-sm-6">

                                                          <div class='form-group'>
                                                              <label class=' col-sm-3 control-label' for='bank_name'>Bank Name </label><div class="col-sm-9 input-group">

                                                                  <?php echo form_dropdown('bank_name', array('' => 'Select Bank') + $banks, '', ' class="form-control search-select"'); ?>
              <?php echo form_error('bank_name'); ?>
                                                              </div>
                                                          </div>
                                                          <div class="clearfix"></div>
                                                          <br>
                                                          <br>
                                                          <div class='form-group'>
                                                              <label class=' col-sm-3 control-label' for='bank_account_no'>Bank Account No </label><div class="col-sm-9 input-group">
                                                                  <span class="input-group-addon"> <i class="icon-list"></i> </span>
                                                                  <?php echo form_input('bank_account_no', $p->bank_account_no, 'id="bank_account_no_"  class="form-control" '); ?>
              <?php echo form_error('bank_account_no'); ?>
                                                              </div>
                                                          </div>
                                                          <div class="clearfix"></div>
                                                          <br>
                                                          <br>
                                                          <div class='form-group'>
                                                              <label class=' col-sm-3 control-label' for='nhif_no'>NHIF Number </label><div class="col-sm-9 input-group">
                                                                  <span class="input-group-addon"> <i class="icon-list"></i> </span>
                                                                  <?php echo form_input('nhif_no', $p->nhif_no, 'id="nhif_no_"  class="form-control" '); ?>
              <?php echo form_error('nhif_no'); ?>
                                                              </div>
                                                          </div>
                                                          <div class="clearfix"></div>
                                                          <br>
                                                          <br>

                                                          <div class='form-group'>
                                                              <label class=' col-sm-3 control-label' for='nssf_no'>NSSF Number </label><div class="col-sm-9 input-group">
                                                                  <span class="input-group-addon"> <i class="icon-list"></i> </span>
                                                                  <?php echo form_input('nssf_no', $p->nssf_no, 'id="nssf_no_"  class="form-control" '); ?>
              <?php echo form_error('nssf_no'); ?>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="clearfix"></div>

                                                  </div>	
                                                  <div class="modal-footer">
              <?php echo form_submit('submit', ($updType == 'edit') ? 'Update Changes' : 'Save Changes', (($updType == 'create') ? "id='submit' class='btn btn-primary''" : "id='submit' class='btn btn-primary'")); ?>
                                                      <button type="button" data-dismiss="modal" class="btn btn-default">
                                                          Close
                                                      </button>
                                                  </div>
                                              </div>
              <?php echo form_close(); ?>
                                          </div>
                                      </div>		



         <?php endforeach ?>
                                 </tbody>

                         </table>


                     </div>

                <?php else: ?>
                     <p class='text'><?php echo lang('web_no_elements'); ?></p>
<?php endif ?>

        </div>
    </div>
</div>
