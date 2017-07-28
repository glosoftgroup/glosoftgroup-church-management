<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Pledges </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/pledges/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Pledges')) . '</span>', 'class="btn btn-primary"'); ?> 

                    <?php echo anchor('admin/pledges', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Pledges')) . '</span>', 'class="btn btn-info"'); ?> 

                    <?php echo anchor('admin/pledges/paid', '<i class="icon-money"></i> <span> Paid Pledges</span>', 'class="btn btn-success"'); ?> 

                    <?php echo anchor('admin/pledges/pending', '<i class="icon-list-alt"></i> <span> Pending Pledges</span>', 'class="btn btn-dark-grey"'); ?> 

                    <?php echo anchor('admin/pledges/voided', '<i class="icon-list-alt"></i> <span> Voided Pledges</span>', 'class="btn btn-warning"'); ?> 
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
                <label class=' col-sm-3 control-label' for='date'>Date <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">

                    <input id='date' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date', $result->date > 0 ? date('d M Y', $result->date) : $result->date); ?>"  />
                    <i style="color:red"><?php echo form_error('date'); ?></i>
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='title'>Title <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="clip-clip"></i> </span>
                    <?php echo form_input('title', $result->title, 'id="title_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('title'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='member'>Member <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                     <?php
                         echo form_dropdown('member', array('
	 ' => 'Select Option') + $members + array('Others' => 'Others'), (isset($result->member)) ? $result->member : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('member'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='amount'>If Others Specify</label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
                    <?php echo form_input('others', $result->others, 'id="others"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('others'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='amount'>Amount <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">
                    <span class="input-group-addon"> <i class="icon-money"></i> </span>
                    <?php echo form_input('amount', $result->amount, 'id="amount_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('amount'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='expected_pay_date'>Expected Pay Date </label>
                <div class="col-sm-5 input-group">
                    <input id='expected_pay_date' type='text' name='expected_pay_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('expected_pay_date', $result->expected_pay_date > 0 ? date('d M Y', $result->expected_pay_date) : $result->expected_pay_date); ?>"  />

                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                </div>
            </div>



            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='remarks'>Remarks </label><div class="col-sm-5">
                    <textarea id="remarks"  class="autosize-transition ckeditor1 form-control "  name="remarks"  /><?php echo set_value('remarks', (isset($result->remarks)) ? htmlspecialchars_decode($result->remarks) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('remarks'); ?></i>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/pledges', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>