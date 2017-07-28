<?php
    $counties = array(
            '' => 'Select County',
            'Baringo' => 'Baringo',
            'Bomet' => 'Bomet',
            'Bungoma' => 'Bungoma',
            'Busia' => 'Busia',
            'Elgeyo Marakwet' => 'Elgeyo Marakwet',
            'Embu' => 'Embu',
            'Garissa' => 'Garissa',
            'Homa Bay' => 'Homa Bay',
            'Isiolo' => 'Isiolo',
            'Kajiado' => 'Kajiado',
            'Kakamega' => 'Kakamega',
            'Kericho' => 'Kericho',
            'Kiambu' => 'Kiambu',
            'Kilifi' => 'Kilifi',
            'Kirinyaga' => 'Kirinyaga',
            'Kisii' => 'Kisii',
            'Kisumu' => 'Kisumu',
            'Kitui' => 'Kitui',
            'Kwale' => 'Kwale',
            'Laikipia' => 'Laikipia',
            'Lamu' => 'Lamu',
            'Machakos' => 'Machakos',
            'Makueni' => 'Makueni',
            'Mandera' => 'Mandera',
            'Marsabit' => 'Marsabit',
            'Meru' => 'Meru',
            'Migori' => 'Migori',
            'Mombasa' => 'Mombasa',
            'Muranga' => 'Muranga',
            'Nairobi' => 'Nairobi',
            'Nakuru' => 'Nakuru',
            'Nandi' => 'Nandi',
            'Narok' => 'Narok',
            'Nyamira' => 'Nyamira',
            'Nyandarua' => 'Nyandarua',
            'Nyeri' => 'Nyeri',
            'Samburu' => 'Samburu',
            'Siaya' => 'Siaya',
            'Taita Taveta' => 'Taita Taveta',
            'Tana River' => 'Tana River',
            'Tharaka Nithi' => 'Tharaka Nithi',
            'Trans Nzoia' => 'Trans Nzoia',
            'Turkana' => 'Turkana',
            'Uasin Gishu' => 'Uasin Gishu',
            'Vihiga' => 'Vihiga',
            'Wajir' => 'Wajir',
            'West Pokot' => 'West Pokot');
?>

<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Church Settings </h3>


        </div>

        <div class="panel-body" style="display: block;">    


            <div class='clearfix'></div>

            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open_multipart(current_url(), $attributes);
            ?>

            <div class="col-sm-6">
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='date'>Formation Date <span class='required'>*</span></label>
                    <div class="col-sm-8 input-group">

                        <input id='date' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date', $result->date > 0 ? date('d M Y', $result->date) : $result->date); ?>"  />
                        <i style="color:red"><?php echo form_error('date'); ?></i>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='name'>Church Name <span class='required'>*</span></label>
                    <div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-home"></i> </span>
                        <?php echo form_input('name', $result->name, 'id="name_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('name'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='address'>Address </label>
                    <div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="clip-clip"></i> </span>
                        <textarea id="address"  class="autosize-transition ckeditor11 form-control "  name="address"  /><?php echo set_value('address', (isset($result->address)) ? htmlspecialchars_decode($result->address) : ''); ?></textarea>
                        <i style="color:red"><?php echo form_error('address'); ?></i>
                    </div>
                </div>
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='telephone'>Telephone <span class='required'>*</span></label>
                    <div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-phone"></i> </span>
                        <?php echo form_input('phone', $result->phone, 'id="phone"  class="form-control input-mask-phone" '); ?>
                        <i style="color:red"><?php echo form_error('phone'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='other_phones'>Other Phones </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-phone"></i> </span>
                        <?php echo form_input('other_phones', $result->other_phones, 'id="other_phones_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('other_phones'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='email'>Email </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-envelope"></i> </span>
                        <?php echo form_input('email', $result->email, 'id="email_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('email'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class='col-sm-3 control-label' for='county'>County <span class='required'>*</span></label>
                    <div class="col-sm-8">
                         <?php
                             echo form_dropdown('county', $counties, (isset($result->county)) ? $result->county : '', ' id="county_" class="form-control search-select" data-placeholder="Select Options..." ');
                         ?> <i style="color:red"><?php echo form_error('county'); ?></i>
                    </div>
                </div>




            </div>
            <div class="col-sm-6">

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='town'>Town | Location </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="clip-location"></i> </span>
                        <?php echo form_input('town', $result->town, 'id="town_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('town'); ?></i>
                    </div>
                </div>
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='sms_initial'>SMS Initial </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-text-width"></i> </span>
                        <?php echo form_input('sms_initial', $result->sms_initial, 'id="sms_initial_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('sms_initial'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='member_code_initial'>Member Code Initial <span class='required'>*</span></label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-text-height"></i> </span>
                        <?php echo form_input('member_code_initial', $result->member_code_initial, 'id="member_code_initial_" placeholder="E.g MLC, DCU, MK etc" class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('member_code_initial'); ?></i>
                    </div>
                </div>
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='sender_id'>Sender ID <span class='required'>*</span></label>
                    <div class="col-sm-8">

                        <input id='sender_id' type='text' name='sender_id' class="form-control" value="<?php echo $result->sender_id; ?>"  />[<b style="color:red"> Note: </b><i style="color:green">Change this Only if you have a registered Sender ID</i>]
                        <?php echo form_error('sender_id'); ?>
                    </div>
                </div>


                <div class='form-group'>
                    <label class='col-sm-3 control-label' for='member_status'>Upload Church Logo </label>
                    <div class="col-sm-8">

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <input id='file_' type='file' style="display:none" name='file' />
                            <?php if ($updType == 'create'): ?>
                                     <div class="fileupload-new thumbnail" style="width: 150px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=no+image" alt="">
                                     </div>
                                <?php endif ?>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 150px; line-height: 1px;"></div>
                            <?php if ($updType == 'edit'): ?>
                                     <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                                         <img src='<?php echo base_url('uploads/files/' . $result->file) ?>' />
                                     </div>
                                <?php endif ?>

                            <br/><i style="color:red"><?php echo form_error('file'); ?></i>
                            <?php echo ( isset($upload_error['file'])) ? $upload_error['file'] : ""; ?>
                            <div>
                                <span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="icon-picture"></i> Select image</span><span class="fileupload-exists"><i class="icon-picture"></i> Change</span>
                                    <input type="file">
                                </span>
                                <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                                    <i class="icon-remove"></i> Remove
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-8 ">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update Changes' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/settings', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>