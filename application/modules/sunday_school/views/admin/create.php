	
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
     <?php $attributes = array('class' => 'smart-wizard form-horizontal', 'id' => 'form');
         echo form_open_multipart(current_url(), $attributes);
     ?>
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Sunday School Child </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/sunday_school/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Child')) . '</span>', 'class="btn btn-primary"'); ?> 
<?php echo anchor('admin/sunday_school', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Children')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>

        <div class="panel-body">


            <div id="wizard" class="swMain">
                <ul>
                    <li>
                        <a href="#step-1" id="st_1">
                            <div class="stepNumber">
                                1
                            </div>
                            <span class="stepDesc"> Child Details
                                <br />
                                <small>Personal Details</small> </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-2" id="st_2">
                            <div class="stepNumber">
                                2
                            </div>
                            <span class="stepDesc"> Other Details
                                <br />
                                <small>Any Other Relevant Information</small> </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-3" id="st_3">
                            <div class="stepNumber">
                                3
                            </div>
                            <span class="stepDesc"> Parent | Guardian Details
                                <br />
                                <small>Parent or Guardian Details</small> </span>
                        </a>
                    </li>

                </ul>
                <div class="progress progress-striped active progress-sm">
                    <div aria-valuemax="100" aria-valuemin="0" role="progressbar" class="progress-bar progress-bar-success step-bar">
                        <span class="sr-only"> 0% Complete (success)</span>
                    </div>
                </div>


                <div id="step-1">

                    <h2 class="StepTitle">Enter Child's Details</h2>

                    <div class="col-sm-6">
                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='date_joined'>
                                Date Joined 
                            </label>
                            <div class="col-sm-8 input-group">

                                <input id='date_joined_' type='text' name='date_joined' maxlength='' class='form-control date-picker' value="<?php echo set_value('date_joined', (isset($result->date_joined)) ? $result->date_joined : ''); ?>"  />
                                <i style="color:red"><?php echo form_error('date_joined'); ?></i>
                                <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='first_name'>First Name <span class='required'>*</span></label><div class="col-sm-8 input-group">
                                <span class="input-group-addon"> <i class="icon-user"></i> </span>
<?php echo form_input('first_name', $result->first_name, 'id="first_name_"  class="form-control" '); ?>
                                <i style="color:red"><?php echo form_error('first_name'); ?></i>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='last_name'>Last Name <span class='required'>*</span></label><div class="col-sm-8 input-group">
                                <span class="input-group-addon"> <i class="icon-user"></i> </span>
<?php echo form_input('last_name', $result->last_name, 'id="last_name_"  class="form-control" '); ?>
                                <i style="color:red"><?php echo form_error('last_name'); ?></i>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='dob'>Date of Birth <span class='required'>*</span></label>
                            <div class="col-sm-8 input-group">

                                <input id='dob_' type='text' name='dob' maxlength='' class='form-control date-picker' value="<?php echo set_value('dob', (isset($result->dob)) ? $result->dob : ''); ?>"  />
                                <i style="color:red"><?php echo form_error('dob'); ?></i>
                                <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                            </div>
                        </div>


                        <div class='form-group'>
                            <label class='col-sm-3 control-label'>Gender <span class='required'>*</span></label>
                            <div class="col-sm-8">
                                 <?php
                                     $items = array(
                                             '' => '',
                                             "Male" => "Male",
                                             "Female" => "Female",
                                             "Transgender" => "Transgender",
                                     );
                                     echo form_dropdown('gender', $items, (isset($result->gender)) ? $result->gender : '', ' id="gender_1" class="form-control search-select" data-placeholder="Select Options..." ');
                                 ?> <i style="color:red"><?php echo form_error('gender'); ?></i>
                            </div>

                        </div>


                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='home_phone'>Home Telephone </label>
                            <div class="col-sm-8 input-group">
                                <span class="input-group-addon"> <i class="icon-phone"></i> </span>
<?php echo form_input('home_phone', $result->home_phone, 'id="home_phone"  class="form-control input-mask-phone" '); ?>
                                <i style="color:red"><?php echo form_error('home_phone'); ?></i>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='location'>Residential | Estate <span class='required'>*</span></label><div class="col-sm-8 input-group">
                                <span class="input-group-addon"> <i class="clip-location"></i> </span>
<?php echo form_input('residential', $result->residential, 'id="residential"  class="form-control" '); ?>
                                <i style="color:red"><?php echo form_error('residential'); ?></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class='form-group'>
                            <label class='col-sm-3 control-label' for='how_joined'>How Joined <span class='required'>*</span></label>
                            <div class="col-sm-8">
                                 <?php
                                     $items = array('' => '',
                                             "Through Parent" => "Through Parent",
                                             "Through Guardian" => "Through Guardian",
                                             "baptised" => "Baptised",
                                             "confession of faith" => "Confession of Faith",
                                             "transferred" => "Transferred",
                                             "others" => "Others",
                                     );
                                     echo form_dropdown('how_joined', $items, (isset($result->how_joined)) ? $result->how_joined : '', ' id="how_joined_" class="form-control search-select" data-placeholder="Select Options..." ');
                                 ?> <i style="color:red"><?php echo form_error('how_joined'); ?></i>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-sm-3 control-label'>Baptised <span class='required'>*</span></label>
                            <div class="col-sm-8">
                                 <?php
                                     $items = array('' => '',
                                             "yes" => "Yes",
                                             "no" => "NO",
                                     );
                                     echo form_dropdown('baptised', $items, (isset($result->baptised)) ? $result->baptised : '', ' id="baptised_" class="form-control search-select" data-placeholder="Select Options..." ');
                                 ?> <i style="color:red"><?php echo form_error('baptised'); ?></i>
                            </div>

                        </div>

                        <div class='form-group'>
                            <label class='col-sm-3 control-label'>Confirmed <span class='required'>*</span></label>	
                            <div class="col-sm-8">
                                 <?php
                                     $items = array('' => '',
                                             "yes" => "Yes",
                                             "no" => "NO",
                                     );
                                     echo form_dropdown('confirmed', $items, (isset($result->confirmed)) ? $result->confirmed : '', ' id="confirmed_" class="form-control search-select" data-placeholder="Select Options..." ');
                                 ?> <i style="color:red"><?php echo form_error('confirmed'); ?></i>
                            </div>

                        </div>


                        <div class='form-group'>
                            <label class='col-sm-3 control-label' for='member_status'>Upload Passport </label>
                            <div class="col-sm-8">

                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <input id='file_' type='file' style="display:none" name='file' />
<?php if ($updType == 'create'): ?>
                                             <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=no+image" alt="">
                                             </div>
                                        <?php endif ?>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
<?php if ($updType == 'edit'): ?>
                                             <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                                                 <img src='<?php echo base_url('uploads/files/' . $result->passport) ?>' />
                                             </div>
    <?php endif ?>

                                    <br/><i style="color:red"><?php echo form_error('passport'); ?></i>
<?php echo ( isset($upload_error['passport'])) ? $upload_error['passport'] : ""; ?>
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



                        <div class="form-group">
                            <div class="col-sm-3 col-sm-offset-5">
                                <a class="btn btn-blue next-step btn-block">
                                    Next <i class="icon-circle-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>	
                </div>
                <!--------OTHER RELEVANT INFORMATION-------->
                <div id="step-2">
                    <h2 class="StepTitle">Other Details</h2>


                    <div class='form-group'>
                        <label class=' col-sm-3 control-label' for='special_interest'>Special Interest </label><div class="col-sm-5">
                            <textarea id="special_interest"  class="autosize-transition ckeditor1 form-control "  name="special_interest"  /><?php echo set_value('special_interest', (isset($result->special_interest)) ? htmlspecialchars_decode($result->special_interest) : ''); ?></textarea>
                            <i style="color:red"><?php echo form_error('special_interest'); ?></i>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class=' col-sm-3 control-label' for='strengths'>Strengths </label><div class="col-sm-5">
                            <textarea id="strengths"  class="autosize-transition ckeditor1 form-control "  name="strengths"  /><?php echo set_value('strengths', (isset($result->strengths)) ? htmlspecialchars_decode($result->strengths) : ''); ?></textarea>
                            <i style="color:red"><?php echo form_error('strengths'); ?></i>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class=' col-sm-3 control-label' for='weaknesses'>Weaknesses </label><div class="col-sm-5">
                            <textarea id="weaknesses"  class="autosize-transition ckeditor1 form-control "  name="weaknesses"  /><?php echo set_value('weaknesses', (isset($result->weaknesses)) ? htmlspecialchars_decode($result->weaknesses) : ''); ?></textarea>
                            <i style="color:red"><?php echo form_error('weaknesses'); ?></i>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class=' col-sm-3 control-label' for='health'>Health </label><div class="col-sm-5">
                            <textarea id="health"  class="autosize-transition ckeditor1 form-control "  name="health"  /><?php echo set_value('health', (isset($result->health)) ? htmlspecialchars_decode($result->health) : ''); ?></textarea>
                            <i style="color:red"><?php echo form_error('health'); ?></i>
                        </div>
                    </div>



                    <div class='form-group'>
                        <label class=' col-sm-3 control-label' for='additionals'>Additional Info </label><div class="col-sm-5">
                            <textarea id="additionals"  class="autosize-transition ckeditor1 form-control "  name="additionals"  /><?php echo set_value('additionals', (isset($result->additionals)) ? htmlspecialchars_decode($result->additionals) : ''); ?></textarea>
                            <i style="color:red"><?php echo form_error('additionals'); ?></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-3">
                            <a class="btn btn-light-grey back-step btn-block">
                                <i class="icon-circle-arrow-left"></i> Back
                            </a>
                        </div>
                        <div class="col-sm-2 col-sm-offset-3">
                            <button class="btn btn-blue next-step btn-block">
                                Next <i class="icon-circle-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-----------STEP THREE-------------->
                <div id="step-3">
                    <h2 class="StepTitle">Parent | Guardian Details</h2>	
                    <div class='form-group'>
                        <label class='col-sm-2 control-label'> <span class='required'>*</span></label>
                        <div class="col-sm-8">

                            <label id="xx" class=' col-sm-5 control-labelinline' for='paro1'><b> Existing Parent (Church Member)</b><br>
                                <input type='radio' name='type' id='paro1' value='1' <?php echo preset_radio('type', '1', (isset($result->type)) ? $result->type : '0' ); ?> >
                            </label>
                            <label id="nn" class=' col-sm-2 control-labelinline' for='paro2'><b> Non Member </b><br>
                                <input type='radio' name='type' id='paro2' value='0' <?php echo preset_radio('type', '0', (isset($result->type)) ? $result->type : '1' ); ?> >

                            </label>
                            <i style="color:red"><?php echo form_error('type'); ?></i>
                        </div>
                    </div>
                    <hr>
                    <div id="existing">
                        <div class='form-group' >
                            <label class='col-sm-3 control-label' for='parent_id'>Select Parent | Guardian <span class='required'>*</span></label>
                            <div class="col-sm-5">
                                 <?php
                                    echo form_dropdown('parent_id', array('' => 'Select Member') + $parents, (isset($result->parent_id)) ? $result->parent_id : '', ' id="parent_id" class="form-control search-select" data-placeholder="Select Options..." ');
                                ?> <i style="color:red"><?php echo form_error('parent_id'); ?></i>
                            </div>
                        </div>	

                        <div class='form-group'>
                            <label class='col-sm-3 control-label' for='relationship'>Relationship </label>
                            <div class="col-sm-5">
                                 <?php
                                     $items = array('' => '',
                                             "father" => "Father",
                                             "mother" => "Mother",
                                             "uncle" => "Uncle",
                                             "aunt" => "Aunt",
                                             "grandparent" => "Grand Parent",
                                             "others" => "Others",
                                     );
                                     echo form_dropdown('relationship', $items, (isset($post->relationship)) ? $post->relationship : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                                 ?> <i style="color:red"><?php echo form_error('relationship'); ?></i>
                            </div>
                        </div>
                    </div>


                    <div  id="non_existing">	
                        <div class="col-sm-6">	
                            <div class='form-group'>
                                <label class=' col-sm-3 control-label' for='first_name1'>First Name </label>
                                <div class="col-sm-8 input-group">
                                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
<?php echo form_input('first_name1', $result->first_name1, 'id="first_name_"  class="form-control" '); ?>
                                    <i style="color:red"><?php echo form_error('first_name1'); ?></i>
                                </div>
                            </div>

                            <div class='form-group'>
                                <label class=' col-sm-3 control-label' for='last_name1'>Last Name </label>
                                <div class="col-sm-8 input-group">
                                    <span class="input-group-addon"> <i class="icon-user"></i> </span>
<?php echo form_input('last_name1', $result->last_name1, 'id="last_name_"  class="form-control" '); ?>
                                    <i style="color:red"><?php echo form_error('last_name1'); ?></i>
                                </div>
                            </div>

                            <div class='form-group'>
                                <label class='col-sm-3 control-label' for='relationship1'>Relationship </label>
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
                                         echo form_dropdown('relationship1', $items, (isset($result->relationship1)) ? $result->relationship1 : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                                     ?> <i style="color:red"><?php echo form_error('relationship1'); ?></i>
                                </div></div>

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
                                         echo form_dropdown('gender1', $items, (isset($result->gender1)) ? $result->gender1 : '', ' id="gender_1" class="form-control search-select" data-placeholder="Select Options..." ');
                                     ?> <i style="color:red"><?php echo form_error('gender'); ?></i>
                                </div>

                            </div>
                            <div class='form-group'>
                                <label class=' col-sm-3 control-label' for='phone1'>Phone1 </label><div class="col-sm-8 input-group">
                                    <span class="input-group-addon"> <i class="icon-phone"></i> </span>
<?php echo form_input('phone11', $result->phone11, 'id="phone1_"  class="form-control input-mask-phone" '); ?>
                                    <i style="color:red"><?php echo form_error('phone11'); ?></i>
                                </div>
                            </div>

                            <div class='form-group'>
                                <label class=' col-sm-3 control-label' for='phone2'>Phone2 </label><div class="col-sm-8 input-group">
                                    <span class="input-group-addon"> <i class="icon-phone"></i> </span>
<?php echo form_input('phone2', $result->phone2, 'id="phone2_"  class="form-control input-mask-phone" '); ?>
                                    <i style="color:red"><?php echo form_error('phone2'); ?></i>
                                </div>
                            </div>


                        </div>
                        <div class="col-sm-6">	

                            <div class='form-group'>
                                <label class=' col-sm-3 control-label' for='email1'>Email </label><div class="col-sm-8 input-group">
                                    <span class="input-group-addon"> <i class="icon-envelope"></i> </span>
<?php echo form_input('email1', $result->email1, 'id="email_"  class="form-control" '); ?>
                                    <i style="color:red"><?php echo form_error('email1'); ?></i>
                                </div>
                            </div>

                            <div class='form-group'>
                                <label class=' col-sm-3 control-label' for='address1'>Address </label><div class="col-sm-8 input-group">
                                    <span class="input-group-addon"> <i class="icon-envelope"></i> </span>
                                    <textarea id="address1"  class="autosize-transition ckeditor1 form-control "  name="address1"  /><?php echo set_value('address1', (isset($result->address1)) ? htmlspecialchars_decode($result->address1) : ''); ?></textarea>
                                    <i style="color:red"><?php echo form_error('address1'); ?></i>
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

                            <div class='form-group'>
                                <label class=' col-sm-3 control-label' for='location1'>Location | Estate</label><div class="col-sm-8 input-group">
                                    <span class="input-group-addon"> <i class="clip-location"></i> </span>
<?php echo form_input('location1', $result->location1, 'id="location_"  class="form-control" '); ?>
                                    <i style="color:red"><?php echo form_error('location1'); ?></i>
                                </div>
                            </div>

                            <div class='form-group'>
                                <label class=' col-sm-3 control-label' for='additionals1'>Additional Information </label><div class="col-sm-8">
                                    <textarea id="additionals1"  class="autosize-transition ckeditor1 form-control "  name="additionals1"  /><?php echo set_value('additionals1', (isset($result->additionals1)) ? htmlspecialchars_decode($result->additionals1) : ''); ?></textarea>
                                    <i style="color:red"><?php echo form_error('additionals1'); ?></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-3">
                            <button class="btn btn-light-grey back-step btn-block">
                                <i class="icon-circle-arrow-left"></i> Back
                            </button>
                        </div>
                        <div class="col-sm-2 col-sm-offset-5">
                            <button class="btn btn-success  btn-block">
                                Save Changes <i class="icon-circle-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                </div>
                <!-----------STEP FOUR-------------->

<?php echo form_close(); ?>
                <div class="clearfix"></div>
            </div>
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
               $('select#parent_id').val('');
          });
     });

</script>