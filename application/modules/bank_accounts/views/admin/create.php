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
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Bank Accounts </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/bank_accounts/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Bank Accounts')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/bank_accounts', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Bank Accounts')) . '</span>', 'class="btn btn-primary"'); ?> 
                </div>
            </div>
        </div>

        <div class="panel-body" style="display: block;">    


            <div class='clearfix'></div>

            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open_multipart(current_url(), $attributes);
            ?>
            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='bank_name'>Bank Name <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_dropdown('bank_name', $banks, (isset($result->bank_name)) ? $result->bank_name : '', ' class="form-control search-select" data-placeholder="Select Options..." '); ?>
                    <i style="color:red"><?php echo form_error('bank_name'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='account_name'>Account Name <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="clip-data"></i> </span>
                    <?php echo form_input('account_name', $result->account_name, 'id="account_name_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('account_name'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='account_number'>Account Number <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="clip-key-2"></i> </span>
                    <?php echo form_input('account_number', $result->account_number, 'id="account_number_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('account_number'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='branch'>Branch </label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="clip-location"></i> </span>
                    <?php echo form_input('branch', $result->branch, 'id="branch_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('branch'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='description'>Description </label><div class="col-sm-5">
                    <textarea id="description"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('description'); ?></i>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/bank_accounts', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>