<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Baptism </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/baptism/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Baptism')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/baptism', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Baptism')) . '</span>', 'class="btn btn-info"'); ?> 
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
                    Date
                </label>
                <div class="col-sm-5 input-group">

                    <input id='date_' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date', $result->date > 0 ? date('d M Y', $result->date) : $result->date); ?>"  />
                    <i style="color:red"><?php echo form_error('date'); ?></i>
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-2 control-label'> <span class='required'>*</span></label>
                <div class="col-sm-8">

                    <label id="xx" class=' col-sm-5 control-labelinline' for='paro1'><b> Select From Sunday School</b><br>
                        <input type='radio' name='option' id='paro1' value='1' <?php echo preset_radio('option', '1', (isset($result->option)) ? $result->option : '0' ); ?> >
                    </label>
                    <label id="nn" class=' col-sm-5 control-labelinline' for='paro2'><b> Select From Members </b><br>
                        <input type='radio' name='option' id='paro2' value='0' <?php echo preset_radio('option', '0', (isset($result->option)) ? $result->option : '1' ); ?> >

                    </label>
                    <i style="color:red"><?php echo form_error('type'); ?></i>
                </div>
            </div>

            <div id="existing">
                <div class='form-group'>
                    <label class='col-sm-3 control-label' for='member'>Select Child <span class='required'>*</span></label>
                    <div class="col-sm-5">
                         <?php
                             echo form_dropdown('sunday_school', array('' => 'Select Child') + $ss, (isset($result->sunday_school)) ? $result->sunday_school : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                         ?> <i style="color:red"><?php echo form_error('sunday_school'); ?></i>
                    </div></div>
            </div>
            <div  id="non_existing">	
                <div class='form-group'>
                    <label class='col-sm-3 control-label' for='member'>Select Member <span class='required'>*</span></label>
                    <div class="col-sm-5">
                         <?php
                             echo form_dropdown('member', array('' => 'Select Member') + $members, (isset($result->member)) ? $result->member : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                         ?> <i style="color:red"><?php echo form_error('member'); ?></i>
                    </div></div>
            </div>

            <hr>
            <h2 class="panel-title">Parents Details </h2>

            <hr>

            <div class="col-sm-6">
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='gff_name'></label><div class="col-sm-8">
                        <h2 class="panel-title">Fathers Details </h2>
                    </div>
                </div>
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='ff_name'>First Name </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-user"></i> </span>
                        <?php echo form_input('ff_name', $result->ff_name, 'id="ff_name_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('ff_name'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='fl_name'>Last Name </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-user"></i> </span>
                        <?php echo form_input('fl_name', $result->fl_name, 'id="fl_name_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('fl_name'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='father_religion'> Religion </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-home"></i> </span>
                        <?php echo form_input('father_religion', $result->father_religion, 'id="father_religion_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('father_religion'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='father_phone'> Phone </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-phone"></i> </span>
                        <?php echo form_input('father_phone', $result->father_phone, 'id="father_phone_"  class="form-control input-mask-phone" '); ?>
                        <i style="color:red"><?php echo form_error('father_phone'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='father_email'>Email </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-envelope"></i> </span>
                        <?php echo form_input('father_email', $result->father_email, 'id="father_email_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('father_email'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='father_address'> Address </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="clip-location"></i> </span>
                        <textarea id="father_address"  class="autosize-transition ckeditor11 form-control "  name="father_address"  /><?php echo set_value('father_address', (isset($result->father_address)) ? htmlspecialchars_decode($result->father_address) : ''); ?></textarea>
                        <i style="color:red"><?php echo form_error('father_address'); ?></i>
                    </div>
                </div>

            </div>                                               
            <div class="col-sm-6">												
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='gff_name'></label><div class="col-sm-8">
                        <h2 class="panel-title">Mother Details </h2>
                    </div>								
                </div>								
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='mf_name'>First Name </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-user"></i> </span>
                        <?php echo form_input('mf_name', $result->mf_name, 'id="mf_name_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('mf_name'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='ml_name'>Last Name </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-user"></i> </span>
                        <?php echo form_input('ml_name', $result->ml_name, 'id="ml_name_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('ml_name'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='mother_religion'> Religion </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-home"></i> </span>
                        <?php echo form_input('mother_religion', $result->mother_religion, 'id="mother_religion_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('mother_religion'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='mother_phone'> Phone </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-phone"></i> </span>
                        <?php echo form_input('mother_phone', $result->mother_phone, 'id="mother_phone_"  class="form-control input-mask-phone" '); ?>
                        <i style="color:red"><?php echo form_error('mother_phone'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='mother_email'> Email </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-envelope"></i> </span>
                        <?php echo form_input('mother_email', $result->mother_email, 'id="mother_email_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('mother_email'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='mother_address'> Address </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="clip-location"></i> </span>
                        <textarea id="mother_address"  class="autosize-transition ckeditor11 form-control "  name="mother_address"  /><?php echo set_value('mother_address', (isset($result->mother_address)) ? htmlspecialchars_decode($result->mother_address) : ''); ?></textarea>
                        <i style="color:red"><?php echo form_error('mother_address'); ?></i>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr>
            <h2 class="panel-title">God Parents Details </h2>

            <hr>
            <div class="col-sm-6">

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='gff_name'></label><div class="col-sm-8">
                        <h2 class="panel-title">God Fathers Details </h2>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='gff_name'>First Name <span class='required'>*</span></label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-user"></i> </span>
                        <?php echo form_input('gff_name', $result->gff_name, 'id="gff_name_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('gff_name'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='gfl_name'>Last Name <span class='required'>*</span></label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-user"></i> </span>
                        <?php echo form_input('gfl_name', $result->gfl_name, 'id="gfl_name_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('gfl_name'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='gf_age'> Age <span class='required'>*</span></label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-edit"></i> </span>
                        <?php echo form_input('gf_age', $result->gf_age, 'id="gf_age_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('gf_age'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='gf_phone'>Phone <span class='required'>*</span></label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-phone"></i> </span>
                        <?php echo form_input('gf_phone', $result->gf_phone, 'id="gf_phone_"  class="form-control input-mask-phone" '); ?>
                        <i style="color:red"><?php echo form_error('gf_phone'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='gf_address'>Address </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="clip-location"></i> </span>
                        <textarea id="gf_address"  class="autosize-transition ckeditor11 form-control "  name="gf_address"  /><?php echo set_value('gf_address', (isset($result->gf_address)) ? htmlspecialchars_decode($result->gf_address) : ''); ?></textarea>
                        <i style="color:red"><?php echo form_error('gf_address'); ?></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='gff_name'></label><div class="col-sm-8">
                        <h2 class="panel-title">God Mother Details </h2>
                    </div>
                </div>
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='gmf_name'>First Name </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-user"></i> </span>
                        <?php echo form_input('gmf_name', $result->gmf_name, 'id="gmf_name_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('gmf_name'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='gml_name'>Last Name </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-user"></i> </span>
                        <?php echo form_input('gml_name', $result->gml_name, 'id="gml_name_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('gml_name'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='gm_age'>Age </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-edit"></i> </span>
                        <?php echo form_input('gm_age', $result->gm_age, 'id="gm_age_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('gm_age'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='gm_phone'> Phone </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-phone"></i> </span>
                        <?php echo form_input('gm_phone', $result->gm_phone, 'id="gm_phone_"  class="form-control input-mask-phone" '); ?>
                        <i style="color:red"><?php echo form_error('gm_phone'); ?></i>
                    </div>
                </div>
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='gm_address'>Address </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="clip-location"></i> </span>
                        <textarea id="gm_address"  class="autosize-transition ckeditor11 form-control "  name="gm_address"  /><?php echo set_value('gm_address', (isset($result->gm_address)) ? htmlspecialchars_decode($result->gm_address) : ''); ?></textarea>
                        <i style="color:red"><?php echo form_error('gm_address'); ?></i>
                    </div>
                </div>




            </div>
            <div class="clearfix"></div>
            <hr>
            <div class='form-group'>
                <h4 class=' col-sm-12 ' for='description'>Any Additional Info </h4>
                <div class="col-sm-12">
                    <textarea id="description"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('description'); ?></i>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr>
            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/baptism', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>

<script>
     $(document).ready(function ()
     {
          $('#existing').hide();
          $('#non_existing').hide();


          $('#xx').click(function ()
          {
               $('#existing').show();
               $('#non_existing').hide();
          });
          $('#nn').click(function ()
          {
               $('#existing').hide();
               $('#non_existing').show();
               $('#member').val('');
          });
     });

</script>