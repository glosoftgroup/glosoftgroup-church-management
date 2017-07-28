	
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


    $countrylist = array(
            "Kenya" => "Kenya",
            "Afghanistan" => "Afghanistan",
            "Albania" => "Albania",
            "Algeria" => "Algeria",
            "Algeria" => "Algeria",
            "Algeria" => "Algeria",
            "Antigua and Barbuda" => "Antigua and Barbuda",
            "Argentina" => "Argentina",
            "Armenia" => "Armenia",
            "Australia" => "Australia",
            "Austria" => "Austria",
            "Azerbaijan" => "Azerbaijan",
            "Bahamas" => "Bahamas",
            "Bahrain" => "Bahrain",
            "Bangladesh" => "Bangladesh",
            "Barbados" => "Barbados",
            "Belarus" => "Belarus",
            "Belgium" => "Belgium",
            "Belize" => "Belize",
            "Benin" => "Benin",
            "Bhutan" => "Bhutan",
            "Bolivia" => "Bolivia",
            "Bosnia and Herzegovina" => "Bosnia and Herzegovina",
            "Botswana" => "Botswana",
            "Brazil" => "Brazil",
            "Brunei" => "Brunei",
            "Bulgaria" => "Bulgaria",
            "Burkina Faso" => "Burkina Faso",
            "Burundi" => "Burundi",
            "Cambodia" => "Cambodia",
            "Cameroon" => "Cameroon",
            "Canada" => "Canada",
            "Cape Verde" => "Cape Verde",
            "Central African Republic" => "Central African Republic",
            "Chad" => "Chad",
            "Chile" => "Chile",
            "China" => "China",
            "Colombi" => "Colombi",
            "Comoros" => "Comoros",
            "Congo (Brazzaville)" => "Congo (Brazzaville)",
            "Congo" => "Congo",
            "Costa Rica" => "Costa Rica",
            "Cote d'Ivoire" => "Cote d'Ivoire",
            "Croatia" => "Croatia",
            "Cuba" => "Cuba",
            "Cyprus" => "Cyprus",
            "Czech Republic" => "Czech Republic",
            "Denmark" => "Denmark",
            "Djibouti" => "Djibouti",
            "Dominica" => "Dominica",
            "Dominican Republic" => "Dominican Republic",
            "East Timor (Timor Timur)" => "East Timor (Timor Timur)",
            "Ecuador" => "Ecuador",
            "Egypt" => "Egypt",
            "El Salvador" => "El Salvador",
            "Equatorial Guinea" => "Equatorial Guinea",
            "Eritrea" => "Eritrea",
            "Estonia" => "Estonia",
            "Ethiopia" => "Ethiopia",
            "Fiji" => "Fiji",
            "Finland" => "Finland",
            "France" => "France",
            "Gabon" => "Gabon",
            "Gambia, The" => "Gambia, The",
            "Georgia" => "Georgia",
            "Germany" => "Germany",
            "Ghana" => "Ghana",
            "Greece" => "Greece",
            "Grenada" => "Grenada",
            "Guatemala" => "Guatemala",
            "Guinea" => "Guinea",
            "Guinea-Bissau" => "Guinea-Bissau",
            "Guyana" => "Guyana",
            "Haiti" => "Haiti",
            "Honduras" => "Honduras",
            "Hungary" => "Hungary",
            "Iceland" => "Iceland",
            "India" => "India",
            "Indonesia" => "Indonesia",
            "Iran" => "Iran",
            "Iraq" => "Iraq",
            "Ireland" => "Ireland",
            "Israel" => "Israel",
            "Italy" => "Italy",
            "Jamaica" => "Jamaica",
            "Japan" => "Japan",
            "Jordan" => "Jordan",
            "Kazakhstan" => "Kazakhstan",
            "Kenya" => "Kenya",
            "Kiribati" => "Kiribati",
            "Korea, North" => "Korea, North",
            "Korea, South" => "Korea, South",
            "Kuwait" => "Kuwait",
            "Kyrgyzstan" => "Kyrgyzstan",
            "Laos" => "Laos",
            "Latvia" => "Latvia",
            "Lebanon" => "Lebanon",
            "Lesotho" => "Lesotho",
            "Liberia" => "Liberia",
            "Libya" => "Libya",
            "Liechtenstein" => "Liechtenstein",
            "Lithuania" => "Lithuania",
            "Luxembourg" => "Luxembourg",
            "Macedonia" => "Macedonia",
            "Madagascar" => "Madagascar",
            "Malawi" => "Malawi",
            "Malaysia" => "Malaysia",
            "Maldives" => "Maldives",
            "Mali" => "Mali",
            "Malta" => "Malta",
            "Marshall Islands" => "Marshall Islands",
            "Mauritania" => "Mauritania",
            "Mauritius" => "Mauritius",
            "Mexico" => "Mexico",
            "Micronesia" => "Micronesia",
            "Moldova" => "Moldova",
            "Monaco" => "Monaco",
            "Mongolia" => "Mongolia",
            "Morocco" => "Morocco",
            "Mozambique" => "Mozambique",
            "Myanmar" => "Myanmar",
            "Namibia" => "Namibia",
            "Nauru" => "Nauru",
            "Nepa" => "Nepa",
            "Netherlands" => "Netherlands",
            "New Zealand" => "New Zealand",
            "Nicaragua" => "Nicaragua",
            "Niger" => "Niger",
            "Nigeria" => "Nigeria",
            "Norway" => "Norway",
            "Oman" => "Oman",
            "Pakistan" => "Pakistan",
            "Palau" => "Palau",
            "Panama" => "Panama",
            "Papua New Guinea" => "Papua New Guinea",
            "Paraguay" => "Paraguay",
            "Peru" => "Peru",
            "Philippines" => "Philippines",
            "Poland" => "Poland",
            "Portugal" => "Portugal",
            "Qatar" => "Qatar",
            "Romania" => "Romania",
            "Russia" => "Russia",
            "Rwanda" => "Rwanda",
            "Saint Kitts and Nevis" => "Saint Kitts and Nevis",
            "Saint Lucia" => "Saint Lucia",
            "Saint Vincent" => "Saint Vincent",
            "Samoa" => "Samoa",
            "San Marino" => "San Marino",
            "Sao Tome and Principe" => "Sao Tome and Principe",
            "Saudi Arabia" => "Saudi Arabia",
            "Senegal" => "Senegal",
            "Serbia and Montenegro" => "Serbia and Montenegro",
            "Seychelles" => "Seychelles",
            "Sierra Leone" => "Sierra Leone",
            "Singapore" => "Singapore",
            "Slovakia" => "Slovakia",
            "Slovenia" => "Slovenia",
            "Solomon Islands" => "Solomon Islands",
            "Somalia" => "Somalia",
            "South Africa" => "South Africa",
            "Spain" => "Spain",
            "Sri Lanka" => "Sri Lanka",
            "Sudan" => "Sudan",
            "Suriname" => "Suriname",
            "Swaziland" => "Swaziland",
            "Sweden" => "Sweden",
            "Switzerland" => "Switzerland",
            "Syria" => "Syria",
            "Taiwan" => "Taiwan",
            "Tajikistan" => "Tajikistan",
            "Tanzania" => "Tanzania",
            "Thailand" => "Thailand",
            "Togo" => "Togo",
            "Tonga" => "Tonga",
            "Trinidad and Tobago" => "Trinidad and Tobago",
            "Tunisia" => "Tunisia",
            "Turkey" => "Turkey",
            "Turkmenistan" => "Turkmenistan",
            "Tuvalu" => "Tuvalu",
            "Uganda" => "Uganda",
            "Ukraine" => "Ukraine",
            "United Arab Emirates" => "United Arab Emirates",
            "United Kingdom" => "United Kingdom",
            "United States" => "United States",
            "Uruguay" => "Uruguay",
            "Uzbekistan" => "Uzbekistan",
            "Vanuatu" => "Vanuatu",
            "Vatican City" => "Vatican City",
            "Venezuela" => "Venezuela",
            "Vietnam" => "Vietnam",
            "Yemen" => "Yemen",
            "Zambia" => "Zambia",
            "Zimbabwe" => "Zimbabwe"
    );
?>


<div class="col-sm-12">
    <!-- start: FORM WIZARD PANEL -->


    <?php $attributes = array('class' => 'smart-wizard form-horizontal', 'id' => 'form');
        echo form_open_multipart(current_url(), $attributes);
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Members </h3>
            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/members/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Members')) . '</span>', 'class="btn btn-primary"'); ?> 
<?php echo anchor('admin/members', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Members')) . '</span>', 'class="btn btn-info"'); ?> 
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
                            <span class="stepDesc"> Member Details
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
                                <small>Any Other Relevant Details</small> </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-3" id="st_3">
                            <div class="stepNumber">
                                3
                            </div>
                            <span class="stepDesc"> Relatives Details
                                <br />
                                <small>Next of Kin</small> </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-4" id="st_4">
                            <div class="stepNumber">
                                4
                            </div>
                            <span class="stepDesc"> Ministries & HBC
                                <br />
                                <small>Member Interest in Ministry</small> </span>
                        </a>
                    </li>
                </ul>
                <div class="progress progress-striped active progress-sm">
                    <div aria-valuemax="100" aria-valuemin="0" role="progressbar" class="progress-bar progress-bar-success step-bar">
                        <span class="sr-only"> 0% Complete (success)</span>
                    </div>
                </div>


                <div id="step-1">
                    <h2 class="StepTitle">Enter Member Details</h2>
                    <div class="col-sm-6">
                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='date_joined'>
                                Date Joined 
                            </label>
                            <div class="col-sm-8 input-group">

                                <input id='date_joined_' type='text' name='date_joined' maxlength='' class='form-control date-picker' value="<?php echo set_value('date_joined', $result->date_joined > 0 ? date('d M Y', $result->date_joined) : $result->date_joined); ?>"  />
                                <i style="color:red"><?php echo form_error('date_joined'); ?></i>
                                <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-sm-3 control-label' for='title'>Title </label>
                            <div class="col-sm-8">
                                 <?php
                                     $items = array(
                                             "" => "",
                                             "Mr." => "Mr.",
                                             "Mrs." => "Mrs.",
                                             "Mss." => "Mss.",
                                             "Ms." => "Ms.",
                                             "Dr." => "Dr.",
                                             "Eng." => "Eng.",
                                     );
                                     echo form_dropdown('title', $items, (isset($result->title)) ? $result->title : '', ' id="title_" class="form-control search-select" data-placeholder="Select Options..." ');
                                 ?> <i style="color:red"><?php echo form_error('title'); ?></i>
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
                            <label class='col-sm-3 control-label'>Gender <span class='required'>*</span></label>
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
                            <label class=' col-sm-3 control-label' for='dob'>Date of Birth <span class='required'>*</span></label>
                            <div class="col-sm-8 input-group">

                                <input id='dob_' type='text' name='dob' maxlength='' class='form-control date-picker' value="<?php echo set_value('dob', $result->dob > 0 ? date('d M Y', $result->dob) : $result->dob); ?>"  />
                                <i style="color:red"><?php echo form_error('dob'); ?></i>
                                <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='phone1'>Phone1 <span class='required'>*</span></label><div class="col-sm-8 input-group">
                                <span class="input-group-addon"> <i class="icon-phone"></i> </span>
<?php echo form_input('phone1', $result->phone1, 'id="phone1_"  class="form-control input-mask-phone" '); ?>
                                <i style="color:red"><?php echo form_error('phone1'); ?></i>
                            </div>
                        </div>


                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='phone2'>Phone2 </label>
                            <div class="col-sm-8 input-group">
                                <span class="input-group-addon"> <i class="icon-phone"></i> </span>
<?php echo form_input('phone2', $result->phone2, 'id="phone2_"  class="form-control input-mask-phone" '); ?>
                                <i style="color:red"><?php echo form_error('phone2'); ?></i>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='email'>Email <span class='required'>*</span></label><div class="col-sm-8">
<?php echo form_input('email', $result->email, 'id="email_"  class="form-control" '); ?>
                                <i style="color:red"><?php echo form_error('email'); ?></i>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class='col-sm-3 control-label' for='country'>Country <span class='required'>*</span></label>
                            <div class="col-sm-8">
                                 <?php
                                    echo form_dropdown('country', $countrylist, (isset($result->country)) ? $result->country : '', ' id="country_" class="form-control search-select" data-placeholder="Select Options..." ');
                                ?> <i style="color:red"><?php echo form_error('country'); ?></i>
                            </div></div>

                    </div>
                    <div class="col-sm-6">

                        <div class='form-group'>
                            <label class='col-sm-3 control-label' for='county'>County <span class='required'>*</span></label>
                            <div class="col-sm-8">
                                 <?php
                                    echo form_dropdown('county', $counties, (isset($result->county)) ? $result->county : '', ' id="county_" class="form-control search-select" data-placeholder="Select Options..." ');
                                ?> <i style="color:red"><?php echo form_error('county'); ?></i>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='location'>Location | Estate <span class='required'>*</span></label><div class="col-sm-8 input-group">
                                <span class="input-group-addon"> <i class="clip-location"></i> </span>
<?php echo form_input('location', $result->location, 'id="location_"  class="form-control" '); ?>
                                <i style="color:red"><?php echo form_error('location'); ?></i>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='address'>Address </label><div class="col-sm-8">
                                <textarea id="address_"  class="autosize-transition form-control "  name="address"  /><?php echo set_value('address', (isset($result->address)) ? htmlspecialchars_decode($result->address) : ''); ?></textarea>
                                <i style="color:red"><?php echo form_error('address'); ?></i>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-sm-3 control-label' for='marital_status'>Marital Status <span class='required'>*</span></label>
                            <div class="col-sm-8">
                                 <?php
                                     $items = array('' => '',
                                             "married" => "Married",
                                             "single" => "Single",
                                             "separated" => "Separated",
                                             "divorced" => "Divorced",
                                             "divorced" => "Divorced",
                                             "single mom" => "Single Mom",
                                             "single dad" => "Single dad",
                                             "widow" => "Widow",
                                             "widower" => "Widower",
                                             "not known" => "Not Known",
                                     );
                                     echo form_dropdown('marital_status', $items, (isset($result->marital_status)) ? $result->marital_status : '', ' id="marital_status_" class="form-control search-select" data-placeholder="Select Options..." ');
                                 ?> <i style="color:red"><?php echo form_error('marital_status'); ?></i>
                            </div></div>

                        <div class='form-group'>
                            <label class='col-sm-3 control-label' for='member_status'>Member Status <span class='required'>*</span></label>
                            <div class="col-sm-8">
                                 <?php
                                     $items = array('' => '',
                                             "active" => "Active",
                                             "inactive" => "Inactive",
                                             "deceased" => "Deceased",
                                             "deceased" => "Deceased",
                                             "prospect" => "Prospect",
                                             "transferred" => "Transferred",
                                             "visitor" => "Visitor",
                                     );
                                     echo form_dropdown('member_status', $items, (isset($result->member_status)) ? $result->member_status : '', ' id="member_status_" class="form-control search-select" data-placeholder="Select Options..." ');
                                 ?> <i style="color:red"><?php echo form_error('member_status'); ?></i>
                            </div></div>

                        <div class='form-group'>
                            <label class='col-sm-3 control-label' for='member_status'>Upload Passport </label>
                            <div class="col-sm-8">

                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <input id='file_' type='file' style="display:none" name='file' />


                                    <?php if (!empty($result->passport))
                                        {
                                             ?>
                                             <div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
                                                 <img src='<?php echo base_url('uploads/files/' . $result->passport) ?>' />
                                             </div>
                                        <?php
                                        }
                                        else
                                        {
                                             ?>
                                             <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"> <img src="<?php echo base_url('uploads/files/m1.png'); ?>" alt="">
                                             </div>
    <?php } ?>

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
                    </div>						
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-8">
                            <a class="btn btn-blue next-step btn-block">
                                Next <i class="icon-circle-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div id="step-2">
                    <h2 class="StepTitle">Other Details</h2>




                    <div class='form-group'>
                        <label class='col-sm-3 control-label' for='how_joined'>How Joined <span class='required'>*</span></label>
                        <div class="col-sm-5">
                             <?php
                                 $items = array('' => '',
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
                        <div class="col-sm-5">
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
                        <div class="col-sm-5">
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
                        <label class='col-sm-3 control-label' for='occupation'>Occupation </label>
                        <div class="col-sm-5">
                             <?php
                                 $items = array('' => '',
                                         "businessman" => "Businessman",
                                         "doctor" => "Doctor",
                                         "electrician" => "Electrician",
                                         "nurse" => "Nurse",
                                         "teacher" => "Teacher",
                                         "banker" => "Banker",
                                         "journalist" => "Journalist",
                                         "programmer" => "Programmer",
                                         "insurance" => "Insurance",
                                         "artist" => "Artist",
                                         "accountant" => "Accountant",
                                         "others" => "Others",
                                 );
                                 echo form_dropdown('occupation', $items, (isset($result->occupation)) ? $result->occupation : '', ' id="occupation_" class="form-control search-select" data-placeholder="Select Options..." ');
                             ?> <i style="color:red"><?php echo form_error('occupation'); ?></i>
                        </div></div>

                    <div class='form-group'>
                        <label class=' col-sm-3 control-label' for='employer'>Employer </label><div class="col-sm-5">
<?php echo form_input('employer', $result->employer, 'id="employer_"  class="form-control" '); ?>
                            <i style="color:red"><?php echo form_error('employer'); ?></i>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label class=' col-sm-3 control-label' for='description'>Any Additional Info </label><div class="col-sm-5">
                            <textarea id="description_"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                            <i style="color:red"><?php echo form_error('description'); ?></i>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-3">
                            <a class="btn btn-light-grey back-step btn-block">
                                <i class="icon-circle-arrow-left"></i> Back
                            </a>
                        </div>
                        <div class="col-sm-2 col-sm-offset-3">
                            <a class="btn btn-blue next-step btn-block">
                                Next <i class="icon-circle-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                </div>


                <!----New Form --->
                <div id="step-3">
                    <h2 class="StepTitle">Relative Details</h2>

                    <!--------NEW FORM---------->


<?php if ($relatives): ?>

                             <table class="table table-striped table-bordered table-hover table-full-width" >

                                 <thead>
                                 <th>#</th>
                                 <th>First Name</th>
                                 <th>Relationship</th>
                                 <th>R/Ship Type</th>
                                 <th>Phone</th>
                                 <th>Email</th>	
                                 <th>Location</th>	
                                 <th width="100"><?php echo lang('web_options'); ?></th>
                                 </thead>
                                 <tbody>
                                      <?php
                                      $i = 0;


                                      foreach ($relatives as $p):
                                           $i++;
                                           ?>
                                          <tr>
                                              <td><?php echo $i . '.'; ?></td>					
                                              <td><?php echo $p->first_name . ' ' . $p->last_name; ?></td>
                                              <td><?php echo $p->relationship; ?></td>
                                              <td><?php echo $p->type; ?></td>
                                              <td><?php echo $p->phone; ?></td>
                                              <td><?php echo $p->email; ?></td>
                                              <td><?php echo $p->location; ?></td>

                                              <td >
                                                  <div>
                                                      <div class='btn-group'>
                                                          <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                              <i class='icon-cog'></i> Action <span class='caret'></span>
                                                          </a>
                                                          <ul role='menu' class='dropdown-menu pull-right'>
                                                              <li role='presentation'>
                                                                  <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/relatives/edit/' . $p->id . '/' . $page); ?>'>
                                                                      <i class='icon-edit'></i> Edit
                                                                  </a>
                                                              </li>
                                                              <li role='presentation'>
                                                                  <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/relatives/view/' . $p->id . '/' . $page); ?>'>
                                                                      <i class='icon-share'></i> View
                                                                  </a>
                                                              </li>
                                                              <li role='presentation'>
                                                                  <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/relatives/delete/' . $p->id . '/' . $page); ?>'>
                                                                      <i class='icon-remove'></i> Remove
                                                                  </a>
                                                              </li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                              </td>
                                          </tr>
                             <?php endforeach ?>
                                 </tbody>

                             </table>

    <?php endif ?>
                    <h2 class="StepTitle">Add Another Relative</h2>
                    <div class="col-sm-6">
                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='first_name'>First Name </label><div class="col-sm-8 input-group">
                                <span class="input-group-addon"> <i class="icon-user"></i> </span>
<?php echo form_input('first_name1', $post->first_name1, 'id="first_name_"  class="form-control" '); ?>
                                <i style="color:red"><?php echo form_error('first_name1'); ?></i>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='last_name'>Last Name </label><div class="col-sm-8 input-group">
                                <span class="input-group-addon"> <i class="icon-user"></i> </span>
<?php echo form_input('last_name1', $post->last_name1, 'id="last_name_"  class="form-control" '); ?>
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
                                     echo form_dropdown('gender1', $items, (isset($post->gender1)) ? $post->gender1 : '', ' id="gender_1" class="form-control search-select" data-placeholder="Select Options..." ');
                                 ?> <i style="color:red"><?php echo form_error('gender'); ?></i>
                            </div>

                        </div>
                        <div class='form-group'>
                            <label class='col-sm-3 control-label' for='type'>Type </label>
                            <div class="col-sm-8">
                                 <?php
                                     $items = array('' => '',
                                             "parent" => "Parent",
                                             "spouse" => "Spouse",
                                             "sibling" => "Sibling",
                                             "guardian" => "Guardian",
                                             "friend" => "Friend",
                                             "others" => "Others",
                                     );
                                     echo form_dropdown('type1', $items, (isset($post->type1)) ? $post->type1 : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                                 ?> <i style="color:red"><?php echo form_error('type'); ?></i>
                            </div></div>

                        <div class='form-group'>
                            <label class='col-sm-3 control-label' for='relationship'>Relationship </label>
                            <div class="col-sm-8">
                                 <?php
                                     $items = array('' => '',
                                             "wife" => "Wife",
                                             "husband" => "Husband",
                                             "father" => "Father",
                                             "mother" => "Mother",
                                             "uncle" => "Uncle",
                                             "aunt" => "Aunt",
                                             "grandparent" => "Grand Parent",
                                             "friend" => "Friend",
                                             "child" => "Child",
                                             "others" => "Others",
                                     );
                                     echo form_dropdown('relationship1', $items, (isset($post->relationship1)) ? $post->relationship1 : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                                 ?> <i style="color:red"><?php echo form_error('relationship'); ?></i>
                            </div></div>
                    </div>
                    <div class="col-sm-6">
                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='phone'>Phone </label>
                            <div class="col-sm-8 input-group">
                                <span class="input-group-addon"> <i class="icon-phone"></i> </span>
<?php echo form_input('phone', $post->phone, 'id="phone_"  class="form-control input-mask-phone" '); ?>
                                <i style="color:red"><?php echo form_error('phone'); ?></i>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='email'>Email </label><div class="col-sm-8">
<?php echo form_input('email1', $post->email1, 'id="email_"  class="form-control" '); ?>
                                <i style="color:red"><?php echo form_error('email'); ?></i>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='location'> Residential </label><div class="col-sm-8 input-group">
                                <span class="input-group-addon"> <i class="clip-location"></i> </span>
<?php echo form_input('location1', $post->location1, 'id="location1_"  class="form-control" '); ?>
                                <i style="color:red"><?php echo form_error('location1'); ?></i>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='additionals'>Additional Info </label><div class="col-sm-8">
                                <textarea id="additionals"  class="autosize-transition  form-control "  name="additionals1"  /><?php echo set_value('additionals', (isset($post->additionals)) ? htmlspecialchars_decode($post->additionals) : ''); ?></textarea>
                                <i style="color:red"><?php echo form_error('additionals'); ?></i>
                            </div>
                        </div>

                    </div>



                    <div class="clearfix"></div>
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
                <div id="step-4">
                    <h2 class="StepTitle">Ministry & HBCs</h2>

                    <!---------LAST FORM HERE---------->

<?php if ($member_ministries)
    {
         ?>
                             <div class='clearfix'></div>
                             <table class="table table-striped table-bordered table-hover table-full-width" id="">

                                 <thead>
                                 <th>#</th>
                                 <th>Name</th>
                                 <th>Leader</th>
                                 <th>Telephone</th>
                                 <th>Mobile</th>
                                 <th>Email</th>
                                 <th ><?php echo lang('web_options'); ?></th>
                                 </thead>
                                 <tbody>
                                      <?php
                                      $i = 0;


                                      foreach ($member_ministries as $pp):
                                           $i++;
                                           ?>
                                          <tr>
                                              <td><?php echo $i . '.'; ?></td>					

                                              <td><?php echo ucwords($pp->name); ?></td>
                                              <td><?php echo ucwords($leader[$pp->leader]); ?></td>
                                              <td><?php echo $pp->telephone; ?></td>
                                              <td><?php echo $pp->mobile; ?></td>
                                              <td><?php echo $pp->email; ?></td>


                                              <td width='100'>
                                                  <div>
                                                      <div class='btn-group' id="delete_ministry">
                                                          <a class='btn btn-danger btn-sm' onClick="return confirm('Are you sure you want to void this pledge. Action is irreversible!!')" href='<?php echo site_url('admin/members/remove_ministry/' . $pp->mmid . '/1001'); ?>'>
                                                              <i class='icon-trash'></i> Remove 
                                                          </a>

                                                      </div>
                                                  </div>
                                              </td>
                                          </tr>
                             <?php endforeach ?>
                                 </tbody>

                             </table>
                             <h2 class="StepTitle">Add Ministries | HBCs</h2>	
    <?php } ?>




                    <div class='form-group'>
                        <label class='col-sm-3 control-label'>Ministries Interested in </label>	
                        <div class="col-sm-5">
<?php
    echo form_dropdown('ministries[]', $ministries, (isset($result->ministries)) ? $result->ministries : '', ' id="form-field-select-4" multiple="multiple" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('ministries'); ?></i>
                        </div>

                    </div>
                    <div class='form-group'>
                        <label class='col-sm-3 control-label'>Member HBC </label>	
                        <div class="col-sm-5">
<?php
    echo form_dropdown('hbc_id', $hbcs, (isset($result->hbc_id)) ? $result->hbc_id : '', ' id="confirmed_" class="form-control search-select" data-placeholder="Select Options..." ');
?> <i style="color:red"><?php echo form_error('hbc_id'); ?></i>
                        </div>

                    </div>


                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-3">
                            <button class="btn btn-light-grey back-step btn-block">
                                <i class="icon-circle-arrow-left"></i> Back
                            </button>
                        </div>
                        <div class="col-sm-2 col-sm-offset-8">
                            <button class="btn btn-success  btn-block">
                                Save Changes <i class="icon-circle-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
<?php echo form_close(); ?>

    <!-- end: FORM WIZARD PANEL -->
</div>

