<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Accounts</h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/accounts/create', '<i class="icon-plus">
                </i> ' . lang('web_add_t', array(':name' => 'Accounts')), 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/accounts', '<i class="icon-list">
                </i> ' . lang('web_list_all', array(':name' => 'Accounts')), 'class="btn btn-primary"'); ?> 
                </div>
            </div>
        </div>

        <div class="panel-body" style="display: block;">    



            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open_multipart(current_url(), $attributes);
            ?>
            <div class='form-group'>
                <label class="col-sm-3" for='name'>Name <span class='required'>*</span></label><div class="col-sm-5 ">
                     <?php echo form_input('name', $result->name, 'id="name_"  class="form-control" '); ?>
                     <?php echo form_error('name'); ?>
                </div>
            </div>

            <div class='form-group'>
                <label class="col-sm-3" for='code'>Code <span class='required'>*</span></label><div class="col-sm-5 ">
                     <?php echo form_input('code', $result->code, 'id="code_"  class="form-control" '); ?>
                     <?php echo form_error('code'); ?>
                </div>
            </div>

            <div class='form-group'>
                <label class="col-sm-3" for='account_type'>Account Type <span class='required'>*</span></label>
                <div class="col-sm-5 ">
                     <?php echo form_dropdown('account_type', $account_types, (isset($result->account_type)) ? $result->account_type : '', ' class="select form-control"  ');
                     ?>		
                     <?php echo form_error('account_type'); ?>
                </div>
            </div>

            <div class='form-group'>
                <label class="col-sm-3" for='tax'>Tax <span class='required'>*</span></label>
                <div class="col-sm-5 ">
                     <?php echo form_dropdown('tax', array('0' => 'Tax Exempt') + $tax_config, (isset($result->tax)) ? $result->tax : '', ' class="select form-control" ');
                     ?>		
                     <?php echo form_error('tax'); ?>
                </div>
            </div>

            <div class='form-group'>
                <label class="col-sm-3" for='balance'>Balance <span class='required'>*</span></label><div class="col-sm-5 ">
                     <?php echo form_input('balance', $result->balance, 'id="balance_"  class="form-control" '); ?>
                     <?php echo form_error('balance'); ?>
                </div>
            </div>

            <div class='form-group'><div class="col-sm-3"></div><div class="col-sm-5 ">

                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save', (($updType == 'create') ? "id='submit' class='btn btn-primary''" : "id='submit' class='btn btn-primary'")); ?>
                    <?php echo anchor('admin/accounts', 'Cancel', 'class="btn  btn-default"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div>