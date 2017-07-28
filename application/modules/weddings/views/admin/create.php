<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Weddings </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/weddings/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Weddings')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/weddings', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Weddings')) . '</span>', 'class="btn btn-primary"'); ?> 
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
                <label class=' col-sm-3 control-label' for='wedding_date'>Wedding Date <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">

                    <input id='wedding_date' type='text' name='wedding_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('wedding_date', (isset($result->wedding_date)) ? $result->wedding_date : ''); ?>"  />
                    <i style="color:red"><?php echo form_error('wedding_date'); ?></i>
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='bride'>Bride <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('bride', array('' => 'Select Bride') + $member, (isset($result->bride)) ? $result->bride : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('bride'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='bridegroom'>Bridegroom <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('bridegroom', array('' => 'Select Bridegroom') + $member, (isset($result->bridegroom)) ? $result->bridegroom : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('bridegroom'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='venue'>Venue <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('venue', $result->venue, 'id="venue_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('venue'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='status'>Status </label>
                <div class="col-sm-5">
                     <?php
                         $items = array('' => '',
                                 "0" => "Live",
                                 "1" => "Draft",
                         );
                         echo form_dropdown('status', $items, (isset($result->status)) ? $result->status : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('status'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='brief_description'>Brief Description <span class='required'>*</span></label><div class="col-sm-5">
                    <textarea id="brief_description"  class="autosize-transition form-control "  name="brief_description"  /><?php echo set_value('brief_description', (isset($result->brief_description)) ? htmlspecialchars_decode($result->brief_description) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('brief_description'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='file'><?php echo lang(($updType == 'edit') ? "web_file_edit" : "web_file_create" ) ?> (file) </label>
                <div class="col-sm-5">
                    <input id='file' type='file' name='file' />

                    <?php if ($updType == 'edit'): ?>
                             <a href='/public/uploads/weddings/files/<?php echo $result->file ?>' />Download actual file (file)</a>
                        <?php endif ?>

                    <br/><i style="color:red"><?php echo form_error('file'); ?></i>
                    <?php echo ( isset($upload_error['file'])) ? $upload_error['file'] : ""; ?>
                </div>
            </div>

            <div class='form-group'><label class="col-sm-3 control-label"></label><div class="col-sm-5">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>

                    <?php echo anchor('admin/weddings', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>