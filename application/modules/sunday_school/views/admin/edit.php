	
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
    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Sunday School Child </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/sunday_school/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Sunday School Child')) . '</span>', 'class="btn btn-primary"'); ?> 
<?php echo anchor('admin/sunday_school', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Sunday School Children')) . '</span>', 'class="btn btn-info"'); ?> 
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
                        <a href="#step-3" id="st_3"
<?php if (preg_match('/^(admin\/sunday_school\/edit\/' . $result->id . '\/1\/1001)$/i', $this->uri->uri_string())) echo 'class="selected"'; ?>
                           >
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
                    <div aria-valuemax="100" aria-valuemin="0" role="progressbar" 

                         class="progress-bar progress-bar-success step-bar" <?php if (preg_match('/^(admin\/sunday_school\/edit\/' . $result->id . '\/1\/1001)$/i', $this->uri->uri_string())) echo'style="width: 100%;"'; ?>>
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

                                <input id='date_joined_' type='text' name='date_joined' maxlength='' class='form-control date-picker' value="<?php echo set_value('date_joined', $result->date_joined > 0 ? date('d M Y', $result->date_joined) : $result->date_joined); ?>"  />
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

                                <input id='dob_' type='text' name='dob' maxlength='' class='form-control date-picker' value="<?php echo set_value('dob', $result->dob > 0 ? date('d M Y', $result->dob) : $result->dob); ?>"  />
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



                        <div class="form-group">
                            <div class="col-sm-3 col-sm-offset-8">
                                <a class="btn btn-primary next-step btn-block">
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
                            <button class="btn btn-primary next-step btn-block">
                                Next <i class="icon-circle-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-----------STEP THREE-------------->
                <div id="step-3">
                    <h2 class="StepTitle">Parent | Guardian Details</h2>

                    <div class="widget-main" id="vals">


<?php if (!empty($p_details)): ?>
                                 <div class='clearfix'></div>
                                 <table class="table table-striped table-bordered table-hover table-full-width" id="">

                                     <thead>
                                     <th>#</th>
                                     <th>Name</th>								
                                     <th>Gender</th>
                                     <th>Relationship</th>
                                     <th>Phone1</th>
                                     <th>Email</th>
                                     <th>Address</th>
                                     <th>County</th>
                                     <th>Location</th>
                                     <th ><?php echo lang('web_options'); ?></th>
                                     </thead>
                                     <tbody>
                                          <?php
                                          $i = 0;


                                          foreach ($p_details as $p):
                                               $i++;
                                               ?>
                                              <tr>
                                                  <td><?php echo $i . '.'; ?></td>					
                                                  <td><?php echo $p->first_name . ' ' . $p->last_name; ?></td>
                                                  <td><?php echo $p->gender; ?></td>
                                                  <td><?php
                                                       if ($result->type == 1)
                                                       {
                                                            echo ucwords($result->relationship);
                                                       }
                                                       else
                                                       {
                                                            echo ucwords($p->relationship);
                                                       }
                                                       ?></td>
                                                  <td><?php echo $p->phone1 . ' or ' . $p->phone2; ?></td>
                                                  <td><?php echo $p->email; ?></td>
                                                  <td><?php echo $p->address; ?></td>
                                                  <td><?php echo $p->county; ?></td>
                                                  <td><?php echo $p->location; ?></td>
                                                  <td width='100'>
                                                      <div>
              <?php if ($result->type == 0)
              {
                   ?>
                                                               <div class='btn-group'>
                                                                   <a class='btn btn-primary dropdown-toggle btn-sm' data-toggle='dropdown' href='#'>
                                                                       <i class='icon-cog'></i> Action <span class='caret'></span>
                                                                   </a>
                                                                   <ul role='menu' class='dropdown-menu pull-right'>
                                                                       <li role='presentation'>
                                                                           <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/ss_parents/edit/' . $p->id . '/' . $page); ?>'>
                                                                               <i class='icon-edit'></i> Edit
                                                                           </a>
                                                                       </li>
                                                                       <li role='presentation'>
                                                                           <a role='menuitem' style='color:green' tabindex='-1' href='<?php echo site_url('admin/ss_parents/view/' . $p->id . '/' . $page); ?>'>
                                                                               <i class='icon-share'></i> View
                                                                           </a>
                                                                       </li>
                                                                       <li role='presentation'>
                                                                           <a role='menuitem' tabindex='-1' style='color:red' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/ss_parents/delete/' . $p->id . '/' . $page); ?>'>
                                                                               <i class='icon-remove'></i> Remove
                                                                           </a>
                                                                       </li>
                                                                   </ul>
                                                              <?php
                                                              }
                                                              else
                                                              {
                                                                   ?>
                                                                   <a id="remove" class='btn btn-danger btn-sm' onClick="return confirm('<?php echo lang('web_confirm_delete') ?>')" href='<?php echo site_url('admin/sunday_school/remove_parent/' . $result->id); ?>'>
                                                                       <i class='icon-trash'></i> Remove 
                                                                   </a>
              <?php } ?>
                                                          </div>
                                                      </div>
                                                  </td>
                                              </tr>
         <?php endforeach ?>
                                     </tbody>

                                 </table>

    <?php endif; ?>
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

          $('#vals').click(function ()
          {
               $('#remove').hide();

          });
     });

</script>