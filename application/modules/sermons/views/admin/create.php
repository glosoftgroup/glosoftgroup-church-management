<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Sermons </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/sermons/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Sermons')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/sermons', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Sermons')) . '</span>', 'class="btn btn-primary"'); ?> 
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
                <label class=' col-sm-3 control-label' for='service_date'>Service Date <span class='required'>*</span></label>
                <div class="col-sm-5 input-group">

                    <input id='service_date' type='text' name='service_date' maxlength='' class='form-control date-picker' value="<?php echo set_value('service_date', (isset($result->service_date)) ? $result->service_date : ''); ?>"  />
                    <i style="color:red"><?php echo form_error('service_date'); ?></i>
                    <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='title'>Title <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('title', $result->title, 'id="title_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('title'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='service_leader'>Service Leader <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('service_leader', $result->service_leader, 'id="service_leader_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('service_leader'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='first_service'>First Service <span class='required'>*</span></label><div class="col-sm-5">
                     <?php echo form_input('first_service', $result->first_service, 'id="first_service_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('first_service'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='second_service'>Second Service </label><div class="col-sm-5">
                     <?php echo form_input('second_service', $result->second_service, 'id="second_service_"  class="form-control" '); ?>
                    <i style="color:red"><?php echo form_error('second_service'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class='col-sm-3 control-label' for='pastor_on_duty'>Pastor On Duty <span class='required'>*</span></label>
                <div class="col-sm-5">
                     <?php
                         echo form_dropdown('pastor_on_duty', $leader, (isset($result->pastor_on_duty)) ? $result->pastor_on_duty : '', ' id="form-field-select-1" class="form-control search-select" data-placeholder="Select Options..." ');
                     ?> <i style="color:red"><?php echo form_error('pastor_on_duty'); ?></i>
                </div></div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='sermon_theme'>Sermon Theme <span class='required'>*</span></label><div class="col-sm-5">
                    <textarea id="sermon_theme"  class="autosize-transition form-control "  name="sermon_theme"  /><?php echo set_value('sermon_theme', (isset($result->sermon_theme)) ? htmlspecialchars_decode($result->sermon_theme) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('sermon_theme'); ?></i>
                </div>
            </div>

            <div class='form-group'>
                <label class=' col-sm-3 control-label' for='description'>Description </label><div class="col-sm-5">
                    <textarea id="description"  class="autosize-transition form-control "  name="description"  /><?php echo set_value('description', (isset($result->description)) ? htmlspecialchars_decode($result->description) : ''); ?></textarea>
                    <i style="color:red"><?php echo form_error('description'); ?></i>
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

                    <?php echo anchor('admin/sermons', 'Cancel', 'class="btn btn-light-grey"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>