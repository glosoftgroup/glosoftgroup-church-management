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
            <h3 class="panel-title">All Bank Accounts </h3>

            <div class="heading-elements">
                <div class="btn-group">
                    <a class="btn btn-primary tooltips" data-original-title="New Bank Account" data-width="700" data-toggle="modal" data-placement="top" href="#Add_bank_account">
                        <i class="icon-plus"></i> Add Bank Account
                    </a>

                    <?php echo anchor('admin/bank_accounts', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Bank_Accounts')) . '</span>', 'class="btn btn-info"'); ?>  
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">


                <?php if ($bank_accounts): ?>
                         <div class='clearfix'></div>
                         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

                             <thead>
                             <th>#</th><th>Bank Name</th><th>Account Name</th><th>Account Number</th><th>Branch</th><th>Description</th>	<th ><?php echo lang('web_options'); ?></th>
                             </thead>
                             <tbody>
                                  <?php
                                  $i = 0;
                                  if ($this->uri->segment(4) && ( (int) $this->uri->segment(4) > 0))
                                  {
                                       $i = ($this->uri->segment(4) - 1) * $per;
                                  }

                                  foreach ($bank_accounts as $p):
                                       $i++;
                                       ?>
                                      <tr>
                                          <td><?php echo $i . '.'; ?></td>					
                                          <td><a data-toggle="modal" class="tooltips" data-original-title="View Details" data-placement="top" role="button" href="#modal<?php echo $p->id; ?>"><i class="icon-double-angle-right"></i> <?php echo $p->bank_name; ?></a></td>
                                          <td><?php echo $p->account_name; ?></td>
                                          <td><?php echo $p->account_number; ?></td>
                                          <td><?php echo $p->branch; ?></td>
                                          <td><?php echo $p->description; ?></td>
                                          <td width='100'>
                                              <div>
                                                  <div class='btn-group'>
                                                      <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                          <i class='icon-cog'></i> Action <span class='caret'></span>
                                                      </a>
                                                      <ul role='menu' class='dropdown-menu pull-right'>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#Edit_<?php echo $p->id; ?>"><i class='icon-edit'></i> Edit
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a data-toggle="modal" style='color:green' class="" role="button" href="#modal<?php echo $p->id; ?>">
                                                                  <i class='icon-share'></i> View
                                                              </a>
                                                          </li>
                                                          <li role='presentation'>
                                                              <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/bank_accounts/delete/' . $p->id . '/' . $page); ?>'>
                                                                  <i class='icon-remove'></i> Remove
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                  <div class="modal fade" id="modal<?php echo $p->id; ?>" tabindex="-1" data-width="600"  role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Bank Name: <?php echo $p->bank_name; ?></h4>
                                              </div>
                                              <div class="modal-body">
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Account Name:</span> 
                                                      <span class="col-sm-4"><?php echo $p->account_name; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Account Number:</span> 
                                                      <span class="col-sm-4"><?php echo $p->account_number; ?></span>
                                                  </p>
                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Branch:</span> 
                                                      <span class="col-sm-4"><?php echo $p->branch; ?></span>
                                                  </p>

                                                  <div class="clearfix"><hr></div>
                                                  <p>
                                                      <span class="col-sm-4" style="font-weight:bold !important; margin-right:25px;">Description:</span> 
                                                      <span class="col-sm-7"><?php echo $p->description; ?></span>
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

                                  <!-----------------------------EDIT MODAL------------------------->
                                  <div class="modal fade" id="Edit_<?php echo $p->id; ?>" tabindex="-1" data-width="600" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
                                           <?php
                                           $attributes = array('class' => 'form-horizontal', 'id' => '');
                                           echo form_open_multipart('admin/bank_accounts/edit/' . $p->id . '/1', $attributes);
                                           ?>
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                      &times;
                                                  </button>
                                                  <h4 class="modal-title">Edit Bank Account Details</h4>
                                                  <div class="clearfix"></div>
                                              </div>
                                              <p>
                                              <div class="clearfix"></div>
                                              <div id="entry1" class="clonedInput">
                                                  <label class='col-sm-3 control-label' for='bank_name'>Bank Name<span class='required'>*</span></label>
                                                  <div class="col-sm-8 input-group">
                                                      <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                      <?php echo form_dropdown('bank_name', $banks, (isset($result->bank_name)) ? $result->bank_name : '', ' class="form-control search-select" data-placeholder="Select Options..." '); ?>
                                                      <i style="color:red"><?php echo form_error('bank_name'); ?></i>
                                                  </div>
                                                  </p>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div id="entry1" class="clonedInput">
                                                      <label class='col-sm-3 control-label' for='account_name'>Account Name <span class='required'>*</span></label>
                                                      <div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                          <?php echo form_input('account_name', $p->account_name, 'id="account_name_"  class="form-control" '); ?>
                                                          <i style="color:red"><?php echo form_error('account_name'); ?></i>
                                                      </div>
                                                      </p>
                                                      <div class="clearfix"></div>
                                                  </div>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div id="entry1" class="clonedInput">
                                                      <label class='col-sm-3 control-label' for='account_number'>Account Number<span class='required'>*</span></label>
                                                      <div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="clip-key-2"></i> </span>
                                                          <?php echo form_input('account_number', $p->account_number, 'id="account_number_"  class="form-control" '); ?>
                                                          <i style="color:red"><?php echo form_error('account_number'); ?></i>
                                                      </div>
                                                      </p>
                                                      <div class="clearfix"></div>
                                                  </div>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div id="entry1" class="clonedInput">
                                                      <label class='col-sm-3 control-label' for='confirmed_by'>Branch</label>
                                                      <div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="clip-location"></i> </span>
                                                          <?php echo form_input('branch', $p->branch, 'id="branch_"  class="form-control" '); ?>
                                                          <i style="color:red"><?php echo form_error('branch'); ?></i>
                                                      </div>
                                                      </p>
                                                      <div class="clearfix"></div>
                                                  </div>
                                                  <p>
                                                  <div class="clearfix"></div>
                                                  <div class='form-group'>
                                                      <label class=' col-sm-3 control-label' for='description'>Description </label><div class="col-sm-8 input-group">
                                                          <span class="input-group-addon"> <i class="icon-user"></i> </span>
                                                          <?php echo form_input('description', $p->description, 'id="description_"  class="form-control" '); ?>
                                                          <i style="color:red"><?php echo form_error('description'); ?></i>
                                                      </div>
                                                      <div class="clearfix"></div>
                                                  </div>
                                                  </p>


                                                  <div class="modal-footer">
                                                       <?php echo form_submit('submit', ($updType == 'edit') ? 'Update Changes' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                                                      <button type="button" data-dismiss="modal" class="btn btn-default">
                                                          Close
                                                      </button>
                                                  </div>
                                              </div><?php echo form_close(); ?>
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



<!-----------------------------ADD MODAL------------------------->
<div class="modal fade" id="Add_bank_account" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog7">
         <?php
             $attributes = array('class' => 'form-horizontal', 'id' => '');
             echo form_open_multipart('admin/bank_accounts/create/', $attributes);
         ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Add New Bank Account</h4>
                <div class="clearfix"></div>
            </div>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='bank_name'>Bank Name<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-bubble-2"></i> </span>
                    <?php echo form_dropdown('bank_name', $banks, (isset($result->bank_name)) ? $result->bank_name : '', ' class="form-control search-select" data-placeholder="Select Options..." '); ?><i style="color:red"><?php echo form_error('bank_name'); ?></i>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='account_name'>Account Name<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-data"></i> </span>
                    <input id='account_name' type='text' name='account_name' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='account_number'>Account Number<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-key"></i> </span>
                    <input id='account_number' type='text' name='account_number' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='branch'>Branch<span class='required'>*</span> </label>
                <div class="col-sm-8 input-group">
                    <span class="input-group-addon"> <i class="clip-location"></i> </span>
                    <input id='branch' type='text' name='branch' maxlength='' class='form-control '/>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <p>
            <div class="clearfix"></div>
            <div id="entry1" class="clonedInput">
                <label class='col-sm-3 control-label' for='description'>Description</label>
                <div class="col-sm-8 input-group">

                    <span class="input-group-addon"> <i class="clip-clip"></i> </span>
                    <textarea id="description" rows="9" class="autosize-transition ckeditor1 form-control "  name="description"  /></textarea>
                </div>
                <div class="clearfix"></div>
            </div>
            </p>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    Save Changes
                </button>
                <button type="button" data-dismiss="modal" class="btn btn-default">
                    Close
                </button>
            </div>
        </div><?php echo form_close(); ?>
    </div>

</div>