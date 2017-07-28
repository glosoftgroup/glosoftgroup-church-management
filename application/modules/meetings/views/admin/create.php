<div class="col-sm-12">

    <div class="btn-group">

        <button class=" btn btn-sm  <?php if (!$bal->balance == 0)
         echo 'btn-beige';
    else
         echo 'btn-danger';
?>">
            <i class=' clip-question-2'></i> NOTE
        </button> 

        <button class="btn btn-sm btn-dark-grey">Your SMS Account Balance is <span style="text-decoration:underline;
                                                                                   font-weight:bold;"><?php echo $bal->balance; ?></span> sms</button>
        <?php if (!$bal->balance == 0)
            {
                 ?>

    <?php } ?>                 
    </div>

    <div class="panel panel-default animated fadeIn"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Meetings </h3>

            <div class="heading-elements">
                <div class="btn-group">
<?php echo anchor('admin/meetings/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Meetings')) . '</span>', 'class="btn btn-primary"'); ?> 
<?php echo anchor('admin/meetings', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Meetings')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>

        <div class="panel-body" style="display: block;">    

            <div class='clearfix'></div>

<?php
    $attributes = array('class' => 'form-horizontal', 'id' => '');
    echo form_open_multipart(current_url(), $attributes);
?>

            <div class="col-sm-6">
                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='title'>Title <span class='required'>*</span></label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="clip-bubble-2"></i> </span>
<?php echo form_input('title', $result->title, 'id="title_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('title'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='start_date'>Start Date <span class='required'>*</span></label>
                    <div class="col-sm-8 input-group">

                        <input id='start_date' type='text' name='start_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('start_date', $result->end_date > 0 ? date('d M Y', $result->end_date) : $result->end_date); ?>" />
                        <i style="color:red"><?php echo form_error('start_date'); ?></i>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='end_date'>End Date <span class='required'>*</span></label>
                    <div class="col-sm-8 input-group">

                        <input id='end_date' type='text' name='end_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('end_date', $result->end_date > 0 ? date('d M Y', $result->end_date) : $result->end_date); ?>" />
                        <i style="color:red"><?php echo form_error('end_date'); ?></i>
                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='venue'>Venue <span class='required'>*</span></label><div class="col-sm-8 input-group">
                        <span class="input-group-addon"> <i class="clip-location"></i> </span>
<?php echo form_input('venue', $result->venue, 'id="venue_"  class="form-control" '); ?>
                        <i style="color:red"><?php echo form_error('venue'); ?></i>
                    </div>
                </div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='importance'>Importance <span class='required'>*</span></label><div class="col-sm-8">

                        <?php
                            $items = array('' => '',
                                    "Low" => "Low",
                                    "Medium" => "Medium",
                                    "High" => "High",
                            );
                            echo form_dropdown('importance', $items, (isset($result->importance)) ? $result->importance : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                        ?> 
                        <i style="color:red"><?php echo form_error('importance'); ?></i>
                    </div>
                </div>
                <div class='form-group'>
                    <label class='col-sm-3 control-label' for='guests'>Status <span class='required'>*</span></label>
                    <div class="col-sm-8">
                         <?php
                             $items = array(
                                     "0" => "Draft",
                                     "1" => "Live",
                             );
                             echo form_dropdown('status', $items, (isset($result->status)) ? $result->status : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                         ?> <i style="color:red"><?php echo form_error('status'); ?></i>
                    </div></div>

            </div>
            <div class="col-sm-6">

                <div class='form-group'>
                    <label class='col-sm-3 control-label' for='guests'>Guests <span class='required'>*</span></label>
                    <div class="col-sm-8">
                         <?php
                             $items = array(
                                     '' => 'Meeting For',
                                     'all members' => 'All Members',
                                     'all staff' => 'All Staff Members',
                                     'ministry' => 'To Ministry',
                                     'hbc' => 'To HBC',
                             );

                             echo form_dropdown('guests', $items, (isset($result->guests)) ? $result->guests : '', ' id="form-field-select-1" onchange="show_field(this.value)" class="form-control search-select" data-placeholder="Select Options..." ');
                         ?> <i style="color:red"><?php echo form_error('guests'); ?></i>
                    </div>
                </div>

                <div class='form-group' id="rc_ministry">
                    <label class='col-sm-3 control-label' for='guests'></label>
                    <div class="col-sm-8">
<?php
    echo form_dropdown('ministry', array('' => 'Select Ministry') + (array) $ministries, (isset($result->ministry)) ? $result->ministry : '', ' class="form-control search-select" ');
    echo form_error('ministry');
?>

                    </div>
                </div>
                <div class='form-group' id="rc_hbcs">
                    <label class='col-sm-3 control-label' for='guests'></label>
                    <div class="col-sm-8">
<?php
    echo form_dropdown('hbc', array('' => 'Select HBC') + (array) $hbcs, (isset($result->hbc)) ? $result->hbc : '', ' class="form-control search-select" ');
    echo form_error('hbc');
?>

                    </div>
                </div>



                <div class='form-group'>
                    <label class='col-sm-3 control-label' for='sms_alert'>Alert Guest by SMS <span class='required'>*</span></label>
                    <div class="col-sm-8">
                         <?php
                             $items = array(
                                     "0" => "NO",
                                     "1" => "Yes",
                             );
                             echo form_dropdown('sms_alert', $items, (isset($result->sms_alert)) ? $result->sms_alert : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                         ?> <i style="color:red"><?php echo form_error('sms_alert'); ?></i>
                    </div></div>

                <div class='form-group'>
                    <label class=' col-sm-3 control-label' for='description'>Description <span class='required'>*</span></label><div class="col-sm-8">
                        <textarea id="description" rows="8" class="autosize-transition ckeditor11 form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                        <i style="color:red"><?php echo form_error('description'); ?></i>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr>
            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


            <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

<?php echo anchor('admin/meetings', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

<?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>

<script>
     function show_field(item)
     {
//hide all

          document.getElementById('rc_ministry').style.display = 'none';
          document.getElementById('rc_hbcs').style.display = 'none';

          if (item == 'ministry')
               document.getElementById('rc_ministry').style.display = 'block';
          if (item == 'hbc')
               document.getElementById('rc_hbcs').style.display = 'block';

          return;

     }
<?php if ($this->uri->segment(3) == 'create')
    {
         ?>
              show_field('None');
    <?php } ?>
</script>