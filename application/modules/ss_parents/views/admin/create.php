	
<?php
    $counties = array(
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
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Sunday School Child Parent </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/ss_parents/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Ss Parents')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/ss_parents', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Ss Parents')) . '</span>', 'class="btn btn-primary"'); ?> 
                </div>
            </div>
        </div>

        <div class="panel-body" style="display: block;">    


            <div class='clearfix'></div>

            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open_multipart(current_url(), $attributes);
            ?>

            <!----------------------------NEW LINE---------------------------->
            <div class="col-sm-6">		
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='first_name'>First Name </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-user"></i> </span>
                        <?php echo form_input('first_name', $result->first_name, 'id="first_name_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('first_name'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='last_name'>Last Name </label>
                    <div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-user"></i> </span>
                        <?php echo form_input('last_name', $result->last_name, 'id="last_name_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('last_name'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class='col-sm-3 control-label'>Gender </label>
                    <div class="col-sm-8">
                         <?php
                             $items = array(
                                     "" => "",
                                     "Male" => "Male",
                                     "Female" => "Female",
                                     "Transgender" => "Transgender",
                             );
                             echo form_dropdown('gender', $items, (isset($result->gender)) ? $result->gender : '', ' id="gender_1" class="form-control search-select" data-placeholder="Select Options..." ');
                         ?> <i style="color:red"><?php echo form_error('gender'); ?></i>
                    </div>

                </div>

                <div class='form-group'>
                    <label class='col-sm-3 control-label' for='relationship'>Relationship </label>
                    <div class="col-sm-8">
                         <?php
                             $items = array('' => '',
                                     "father" => "Father",
                                     "mother" => "Mother",
                                     "uncle" => "Uncle",
                                     "aunt" => "Aunt",
                                     "grandparent" => "Grand Parent",
                                     "others" => "Others",
                             );
                             echo form_dropdown('relationship', $items, (isset($result->relationship)) ? $result->relationship : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                         ?> <i style="color:red"><?php echo form_error('relationship'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='phone1'>Phone1 </label>
                    <div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-phone"></i> </span>
                        <?php echo form_input('phone1', $result->phone1, 'id="phone1_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('phone1'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='phone2'>Phone2 </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-phone"></i> </span>
                        <?php echo form_input('phone2', $result->phone2, 'id="phone2_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('phone2'); ?></i>
                    </div>
                </div>

            </div>
            <!----------------------------NEW LINE---------------------------->
            <div class="col-sm-6">
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='email'>Email </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-envelope"></i> </span>
                        <?php echo form_input('email', $result->email, 'id="email_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('email'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='address'>Address </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="icon-envelope"></i> </span>
                        <textarea id="address"  class="autosize-transition ckeditor1 form-control "  name="address"  /><?php echo set_value('address', (isset($result->address)) ? htmlspecialchars_decode($result->address) : ''); ?></textarea>
                        <i style="color:red"><?php echo form_error('address'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class='col-sm-3 control-label' for='county1'>County <span class='required'>*</span></label>
                    <div class="col-sm-8">
                         <?php
                             echo form_dropdown('county', $counties, (isset($post->county)) ? $post->county : '', ' id="county_" class="form-control search-select" data-placeholder="Select Options..." ');
                         ?> <i style="color:red"><?php echo form_error('county1'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='location'>Location </label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="clip-location"></i> </span>
                        <?php echo form_input('location', $result->location, 'id="location_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('location'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='additionals'>Additional Info </label><div class="col-sm-8">
                        <textarea id="additionals"  class="autosize-transition ckeditor1 form-control "  name="additionals"  /><?php echo set_value('additionals', (isset($result->additionals)) ? htmlspecialchars_decode($result->additionals) : ''); ?></textarea>
                        <i style="color:red"><?php echo form_error('additionals'); ?></i>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/ss_parents', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>