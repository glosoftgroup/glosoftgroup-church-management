	
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
<?php $attributes = array('class' => 'smart-wizard form-horizontal', 'id' => 'form');
    echo form_open_multipart(current_url(), $attributes);
?>
<div class="col-sm-12">
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Dedications </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/dedications/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Dedications')) . '</span>', 'class="btn btn-primary"'); ?> 
<?php echo anchor('admin/dedications', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Dedications')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>


        <div class="panel-body" style="display: block;">    

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
                            <span class="stepDesc"> Parent Details
                                <br />
                                <small>Info about Father and Mother</small> </span>
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
                            <label class=' col-sm-3 control-label' for='date'>
                                Date
                            </label>
                            <div class="col-sm-8 input-group">

                                <input id='date_' type='text' name='date' maxlength='' class='form-control date-picker' value="<?php echo set_value('date', $result->date > 0 ? date('d M Y', $result->date) : $result->date); ?>"  />
                                <i style="color:red"><?php echo form_error('date'); ?></i>
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
                            <label class=' col-sm-3 control-label' for='middle_name'>Middle Name </label>
                            <div class="col-sm-8 input-group">
                                <span class="input-group-addon"> <i class="icon-user"></i> </span>
<?php echo form_input('middle_name', $result->middle_name, 'id="middle_name_"  class="form-control" '); ?>
                                <i style="color:red"><?php echo form_error('middle_name'); ?></i>
                            </div>
                        </div>


                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='last_name'>Last Name <span class='required'>*</span></label>
                            <div class="col-sm-8 input-group">
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
                    </div>
                    <!----------------------------NEW LINE---------------------------->
                    <div class="col-sm-6">
                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='location'>Place of Birth (Hospital etc) <span class='required'>*</span></label>
                            <div class="col-sm-8 input-group">
                                <span class="input-group-addon"> <i class="clip-location"></i> </span>
<?php echo form_input('location', $result->location, 'id="location_"  class="form-control" '); ?>
                                <i style="color:red"><?php echo form_error('location'); ?></i>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-sm-3 control-label' for='country'>Country <span class='required'>*</span></label>
                            <div class="col-sm-8">
                                 <?php
                                    echo form_dropdown('country', $countrylist, (isset($result->country)) ? $result->country : '', ' id="country_" class="form-control search-select" data-placeholder="Select Options..." ');
                                ?> <i style="color:red"><?php echo form_error('country'); ?></i>
                            </div></div>

                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='city'>City | Town <span class='required'>*</span></label>
                            <div class="col-sm-8 input-group">
                                <span class="input-group-addon"> <i class="clip-location"></i> </span>
<?php echo form_input('city', $result->city, 'id="city_"  class="form-control" '); ?>
                                <i style="color:red"><?php echo form_error('city'); ?></i>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='expected_dedication_date'>
                                Expected Dedication Date
                            </label>
                            <div class="col-sm-8 input-group">

                                <input id='expected_dedication_date_' type='text' name='expected_dedication_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('expected_dedication_date', $result->expected_dedication_date > 0 ? date('d M Y', $result->expected_dedication_date) : $result->expected_dedication_date); ?>"  />
                                <i style="color:red"><?php echo form_error('expected_dedication_date'); ?></i>
                                <span class="input-group-addon"> <i class="icon-calendar"></i> </span>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label class='col-sm-3 control-label'>Service Type <span class='required'>*</span></label>
                            <div class="col-sm-8">
                                 <?php
                                     $items = array(
                                             "" => "",
                                             "First Service" => "First Service",
                                             "Second Service" => "Second Service",
                                             "Third Service" => "Third Service",
                                             "Fourth Service" => "Fourth Service",
                                     );
                                     echo form_dropdown('service_type', $items, (isset($result->service_type)) ? $result->service_type : '', ' id="gender_1" class="form-control search-select" data-placeholder="Select Options..." ');
                                 ?> <i style="color:red"><?php echo form_error('service_type'); ?></i>
                            </div>
                        </div>                                    

                        <div class='form-group'>
                            <label class=' col-sm-3 control-label' for='description'>Any Additional Info </label><div class="col-sm-8">
                                <textarea id="description"  class="autosize-transition ckeditor1 form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                                <i style="color:red"><?php echo form_error('description'); ?></i>
                            </div>
                        </div>
                    </div>	
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-5">
                            <a class="btn btn-primary next-step btn-block">
                                Next <i class="icon-circle-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                </div>
                <!--------OTHER RELEVANT INFORMATION-------->
                <div id="step-2">
                    <h2 class="StepTitle">Parents Details</h2>

<?php if ($cfd_parents): ?>
                             <div class='clearfix'></div>
                             <table class="table table-striped table-bordered table-hover table-full-width" id="">

                                 <thead>
                                 <th>#</th>
                                 <th>Name</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Address</th>
                                 <th ><?php echo lang('web_options'); ?></th>
                                 </thead>
                                 <tbody>
                                      <?php
                                      $i = 0;
                                      foreach ($cfd_parents as $p):
                                           $i++;
                                           ?>
                                          <tr>
                                              <td><?php echo $i . '.'; ?></td>					

                                              <td><?php echo $p->first_name . ' ' . $p->last_name; ?></td>					
                                              <td><?php echo $p->phone; ?></td>
                                              <td><?php echo $p->email; ?></td>
                                              <td><?php echo $p->address; ?></td>
                                              <td width='100'>
                                                  <div>
                                                      <div class='btn-group'>
                                                          <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                              <i class='icon-cog'></i> Action <span class='caret'></span>
                                                          </a>
                                                          <ul role='menu' class='dropdown-menu pull-right'>
                                                              <li role='presentation'>
                                                                  <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/cfd_parents/edit/' . $p->id . '/' . $page); ?>'>
                                                                      <i class='icon-edit'></i> Edit Details
                                                                  </a>
                                                              </li>

                                                              <li role='presentation'>
                                                                  <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/cfd_parents/delete/' . $p->id . '/' . $page); ?>'>
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
            </div>

        </div>



<?php echo form_close(); ?>
        <div class="clearfix"></div>
    </div>
</div> 
