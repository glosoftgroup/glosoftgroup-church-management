

<div class="clearfix"></div>


<div class="panel-heading">
    <i class="icon-external-link-sign"></i>
    <h3 class="panel-title">Child Profile </h3>

    <div class="heading-elements">

        <div class="btn-group">
             <?php echo anchor('admin/sunday_school/create', '<i class="icon-plus-sign-alt"></i> <span> </span>', 'class="btn btn-primary"'); ?> 
             <?php echo anchor('admin/sunday_school', '<i class="icon-list"></i> <span></span>', 'class="btn btn-info"'); ?> 
        </div>
    </div>
</div>   
<div class="tabbable">
    <ul class="nav nav-tabs tab-padding tab-space-3 tab-blue" id="myTab4">

        <li class="active ">
            <a data-toggle="tab" href="#panel_overview">
                Overview
            </a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#panel_edit_account">
                Edit Details
            </a>
        </li>

        <div class="col-sm-6 panel-tools">
            <li class="heading-elements">
                 <?php
                     $attributes = array('class' => 'form-horizontal', 'id' => '');
                     echo form_open_multipart('admin/sunday_school/search', $attributes);
                 ?>


                <a class="input-group ">
                     <?php
                         echo form_dropdown('child_id', array('' => 'Find a Child') + $children, (isset($result->child_id)) ? $result->child_id : '', ' id="child_id" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?>
                    <span class="input-group-btn" style="width:300px !important;">
                        <button type="submit" class="btn btn-success">
                            <i class="icon-search"></i>
                            View Details
                        </button> </span>
                </a>

                <?php echo form_close(); ?>	
            </li>
        </div>
    </ul>
    <div class="tab-content">
        <div id="panel_overview" class="tab-pane in active">
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <div class="user-left">
                        <div class="center">
                            <h4>Date Joined: <span style="color:blue"><?php echo date('d M Y', $p->date_joined); ?></span></h4>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="user-image">
                                    <div class="fileupload-new thumbnail">

                                        <?php if (empty($p->passport))
                                            {
                                                 ?>

                                                 <img src="<?php echo base_url('uploads/files/m1.png'); ?>" alt="">

                                            <?php
                                            }
                                            else
                                            {
                                                 ?>

                                                 <img alt="" src="<?php echo base_url('uploads/files/' . $p->passport); ?>" style="" class="" >
    <?php } ?>

                                    </div>

                                </div>
                            </div>
                            <h4>Names:<span style="color:blue"><?php echo $p->first_name . ' ' . $p->last_name; ?></span></h4>
                            <hr>
                        </div>
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">Child's Strengths</th>
                                </tr>
                            </thead>
                            <tbody>
                            <td>
<?php echo ucwords($p->strengths); ?>
                            </td>

                            </tbody>
                        </table>

                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">Special Interests</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo ucwords($p->special_interest); ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">Weaknesses</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo ucwords($p->weaknesses); ?></td>
                                </tr>

                            </tbody>
                        </table>
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">Health Records</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo ucwords($p->health); ?></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="col-sm-8 col-md-9">
                    <div class="col-md-4">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">Personal Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>First Name:</td>
                                    <td>
                                        <a href="#">
<?php echo $p->first_name . ' ' . $p->last_name; ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>

                                <tr>
                                    <td>Gender</td>
                                    <td>
                                        <a href="">
<?php echo $p->gender; ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>DOB</td>
                                    <td>
                                        <a href="">
<?php echo date('d M Y', $p->dob); ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Home Phone:</td>
                                    <td><a href=""><?php
    echo $p->home_phone;
?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Residential:</td>
                                    <td><a href=""><?php
    echo $p->residential;
?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>

                                <tr>
                                    <td>Member Since</td>
                                    <td><span class="label label-sm label-info"><?php echo date('d M Y', $p->date_joined); ?></span></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!--------------------END LISTING---------------------->
                    <div class="col-md-4">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th colspan="3">Additional information</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Baptised</td>
                                    <td><a href="">	<?php echo ucwords($p->baptised); ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Confirmed</td>
                                    <td><a href=""><?php echo ucwords($p->confirmed); ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>How Joined</td>
                                    <td><a href=""><?php echo ucwords($p->how_joined); ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>


                            </tbody>
                        </table>
                    </div>

                    <!------------------END----------------------->
                    <div class="col-md-4">
                        <table class="table table-condensed table-hover ">
                            <thead>
                                <tr>
                                    <th colspan="3">Parent/Guardian Information</th>
                                </tr>
                            </thead>


                            <tbody>
                                <tr>
                                    <td>Names:</td>
                                    <td>
                                        <a href="">
<?php echo ucwords($post->first_name . ' ' . $post->last_name); ?>
                                        </a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Relationship:</td>
                                    <td><a href=""><?php
                                                  if ($p->type == 1)
                                                       echo ucwords($p->relationship);
                                                  else
                                                       echo ucwords($post->relationship);
                                              ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td><a href=""><?php
                                                  echo $post->phone1 . "<br>" . $post->phone2;
                                              ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><a href=""><?php
                                                  echo $post->email;
                                              ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td><a href=""><?php
                                                  echo $post->address;
                                              ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>County:</td>
                                    <td><a href=""><?php
                                                  echo $post->county;
                                              ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Location:</td>
                                    <td><a href=""><?php
                                                  echo $post->location;
                                              ?></a></td>
                                    <td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>



                    <div class="clearfix"></div>
                    <hr>
                    Additional Information: <a href="">
                         <?php
                             if ($p->type == 1)
                                  echo $p->additionals;
                             else
                                  echo $post->additionals;
                         ?></a>
                    <hr>


                </div>
            </div>
        </div>
        <div id="panel_edit_account" class="tab-pane">

            <div class="col-sm-12">
<?php $attributes = array('class' => 'smart-wizard form-horizontal', 'id' => 'form');
    echo form_open_multipart('admin/sunday_school/edit/' . $p->id, $attributes);
?>
                <div class="panel panel-default animated fadeIn"> 
                    <div class="panel-heading">
                        <i class="icon-external-link-sign"></i>
                        <h3 class="panel-title">Edit Sunday School Child </h3>

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



        </div>



        <div id="panel_contributions" class="tab-pane">
            <table class="table table-striped table-bordered table-hover" id="projects">
                <thead>
                    <tr>
                        <th class="center">
                            <div class="checkbox-table">
                                <label>
                                    <input type="checkbox" class="flat-grey">
                                </label>
                            </div></th>
                        <th>Project Name</th>
                        <th class="hidden-xs">Client</th>
                        <th>Proj Comp</th>
                        <th class="hidden-xs">%Comp</th>
                        <th class="hidden-xs center">Priority</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="center">
                            <div class="checkbox-table">
                                <label>
                                    <input type="checkbox" class="flat-grey">
                                </label>
                            </div></td>
                        <td>IT Help Desk</td>
                        <td class="hidden-xs">Master Company</td>
                        <td>11 november 2014</td>
                        <td class="hidden-xs">
                            <div class="progress progress-striped active progress-sm">
                                <div style="width: 70%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar" class="progress-bar progress-bar-warning">
                                    <span class="sr-only"> 70% Complete (danger)</span>
                                </div>
                            </div></td>
                        <td class="center hidden-xs"><span class="label label-danger">Critical</span></td>
                        <td class="center">
                            <div class="visible-md visible-lg hidden-sm hidden-xs">
                                <a href="#" class="btn btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                <a href="#" class="btn btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                            </div>
                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                        <i class="fa fa-cog"></i> <span class="caret"></span>
                                    </a>
                                    <ul role="menu" class="dropdown-menu pull-right">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-share"></i> Share
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-times"></i> Remove
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div></td>
                    </tr>
                    <tr>
                        <td class="center">
                            <div class="checkbox-table">
                                <label>
                                    <input type="checkbox" class="flat-grey">
                                </label>
                            </div></td>
                        <td>PM New Product Dev</td>
                        <td class="hidden-xs">Brand Company</td>
                        <td>12 june 2014</td>
                        <td class="hidden-xs">
                            <div class="progress progress-striped active progress-sm">
                                <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-info">
                                    <span class="sr-only"> 40% Complete</span>
                                </div>
                            </div></td>
                        <td class="center hidden-xs"><span class="label label-warning">High</span></td>
                        <td class="center">
                            <div class="visible-md visible-lg hidden-sm hidden-xs">
                                <a href="#" class="btn btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                <a href="#" class="btn btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                            </div>
                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                        <i class="fa fa-cog"></i> <span class="caret"></span>
                                    </a>
                                    <ul role="menu" class="dropdown-menu pull-right">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-share"></i> Share
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-times"></i> Remove
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div></td>
                    </tr>
                    <tr>
                        <td class="center">
                            <div class="checkbox-table">
                                <label>
                                    <input type="checkbox" class="flat-grey">
                                </label>
                            </div></td>
                        <td>ClipTheme Web Site</td>
                        <td class="hidden-xs">Internal</td>
                        <td>11 november 2014</td>
                        <td class="hidden-xs">
                            <div class="progress progress-striped active progress-sm">
                                <div style="width: 90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar" class="progress-bar progress-bar-success">
                                    <span class="sr-only"> 90% Complete</span>
                                </div>
                            </div></td>
                        <td class="center hidden-xs"><span class="label label-success">Normal</span></td>
                        <td class="center">
                            <div class="visible-md visible-lg hidden-sm hidden-xs">
                                <a href="#" class="btn btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                <a href="#" class="btn btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                            </div>
                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                        <i class="fa fa-cog"></i> <span class="caret"></span>
                                    </a>
                                    <ul role="menu" class="dropdown-menu pull-right">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-share"></i> Share
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-times"></i> Remove
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div></td>
                    </tr>
                    <tr>
                        <td class="center">
                            <div class="checkbox-table">
                                <label>
                                    <input type="checkbox" class="flat-grey">
                                </label>
                            </div></td>
                        <td>Local Ad</td>
                        <td class="hidden-xs">UI Fab</td>
                        <td>15 april 2014</td>
                        <td class="hidden-xs">
                            <div class="progress progress-striped active progress-sm">
                                <div style="width: 50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar" class="progress-bar progress-bar-warning">
                                    <span class="sr-only"> 50% Complete</span>
                                </div>
                            </div></td>
                        <td class="center hidden-xs"><span class="label label-success">Normal</span></td>
                        <td class="center">
                            <div class="visible-md visible-lg hidden-sm hidden-xs">
                                <a href="#" class="btn btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                <a href="#" class="btn btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                            </div>
                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                        <i class="fa fa-cog"></i> <span class="caret"></span>
                                    </a>
                                    <ul role="menu" class="dropdown-menu pull-right">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-share"></i> Share
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-times"></i> Remove
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div></td>
                    </tr>
                    <tr>
                        <td class="center">
                            <div class="checkbox-table">
                                <label>
                                    <input type="checkbox" class="flat-grey">
                                </label>
                            </div></td>
                        <td>Design new theme</td>
                        <td class="hidden-xs">Internal</td>
                        <td>2 october 2014</td>
                        <td class="hidden-xs">
                            <div class="progress progress-striped active progress-sm">
                                <div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-success">
                                    <span class="sr-only"> 20% Complete (warning)</span>
                                </div>
                            </div></td>
                        <td class="center hidden-xs"><span class="label label-danger">Critical</span></td>
                        <td class="center">
                            <div class="visible-md visible-lg hidden-sm hidden-xs">
                                <a href="#" class="btn btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                <a href="#" class="btn btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                            </div>
                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                        <i class="fa fa-cog"></i> <span class="caret"></span>
                                    </a>
                                    <ul role="menu" class="dropdown-menu pull-right">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-share"></i> Share
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-times"></i> Remove
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div></td>
                    </tr>
                    <tr>
                        <td class="center">
                            <div class="checkbox-table">
                                <label>
                                    <input type="checkbox" class="flat-grey">
                                </label>
                            </div></td>
                        <td>IT Help Desk</td>
                        <td class="hidden-xs">Designer TM</td>
                        <td>6 december 2014</td>
                        <td class="hidden-xs">
                            <div class="progress progress-striped active progress-sm">
                                <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning">
                                    <span class="sr-only"> 40% Complete (warning)</span>
                                </div>
                            </div></td>
                        <td class="center hidden-xs"><span class="label label-warning">High</span></td>
                        <td class="center">
                            <div class="visible-md visible-lg hidden-sm hidden-xs">
                                <a href="#" class="btn btn-teal tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-green tooltips" data-placement="top" data-original-title="Share"><i class="fa fa-share"></i></a>
                                <a href="#" class="btn btn-bricky tooltips" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
                            </div>
                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                                        <i class="fa fa-cog"></i> <span class="caret"></span>
                                    </a>
                                    <ul role="menu" class="dropdown-menu pull-right">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-share"></i> Share
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">
                                                <i class="fa fa-times"></i> Remove
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- end: PAGE CONTENT-->