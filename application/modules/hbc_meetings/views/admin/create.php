<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Hbc Meetings </h3>

            <div class="heading-elements">
                <div class="btn-group">

                    <?php echo anchor('admin/hbc_meetings', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Hbc Meetings')) . '</span>', 'class="btn btn-info"'); ?> 
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
                <label class=' col-sm-3 control-label' for='date'>
                    Meeting Date <span class='required'>*</span>
                </label>
                <div class="col-sm-5 input-group">

                    <input id='date_' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date', $result->date > 0 ? date('d M Y', $result->date) : $result->date); ?>"  />
                    <i style="color:red"><?php echo form_error('date'); ?></i>
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                </div>
            </div>


            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='host'>Host Member<span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('host', array('' => 'Select Member') + $members, (isset($result->host)) ? $result->host : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('host'); ?></i>
                </div>
            </div>



            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='house_number'>House Number <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('house_number', $result->house_number, 'id="house_number_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('house_number'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='hosts_phone_no'>Alternative Phone No. </label><div class="col-sm-5">
                     <?php echo form_input('hosts_phone_no', $result->hosts_phone_no, 'id="hosts_phone_no_"  class="form-control input-mask-phone" '); ?>
                    <i style="color:red"><?php echo form_error('hosts_phone_no'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='service_leader'>Service Leader <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('service_leader', array('' => 'Select Member') + $members, (isset($result->service_leader)) ? $result->service_leader : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('service_leader'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='preacher'>Preacher of the day</label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('preacher', array('' => 'Select Member') + $members, (isset($result->preacher)) ? $result->preacher : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('preacher'); ?></i>
                </div>	</div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='brief_description'>Brief Description </label><div class="col-sm-5">
                    <textarea id="brief_description"  class="autosize-transition form-control "  name="brief_description"  /><?php echo set_value('brief_description', (isset($result->brief_description)) ? htmlspecialchars_decode($result->brief_description) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('brief_description'); ?></i>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/hbc_meetings', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>