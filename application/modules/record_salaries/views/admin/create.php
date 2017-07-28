<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title"><?php echo ($updType == 'edit') ? 'Edit ' : 'Add '; ?> Deduction </h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/record_salaries/create', '<i class="icon-plus-sign-alt"></i> <span> ' . lang('web_add_t', array(':name' => 'Advance Salary')) . '</span>', 'class="btn btn-primary"'); ?> 
                     <?php echo anchor('admin/record_salaries', '<i class="icon-list"></i> <span>' . lang('web_list_all', array(':name' => 'Advance Salary')) . '</span>', 'class="btn btn-info"'); ?> 
                </div>
            </div>
        </div>

        <div class="panel-body" style="display: block;">   

            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => '');
                echo form_open_multipart(current_url(), $attributes);
            ?>

            <div class="col-sm-6">

                <div class='form-group'>
                    <label class="col-sm-3 control-label">Process Type </label>

                    <div class="col-sm-9"> 
                        <input type="radio"  id="member" value="0" name="salo" /> Single Employee Salary process  
                        <br>
                        <input type="radio"  name="salo" value="1" id="bulk"/> Bulk Salary Process

                    </div>	

                </div>	


                <div class='form-group' id='mem'>
                    <label class="col-sm-3 control-label">Employee <span class='required'>*</span></label>
                    <div class="col-sm-8">
                         <?php
                             echo form_dropdown('employee', array('' => 'Select Employee') + $employees, (isset($result->employee)) ? $result->employee : '', ' class="search-select form-control " ');
                             echo form_error('employee');
                         ?>
                    </div>
                </div>


                <div class='form-group' >
                    <label class="col-sm-3 control-label">Salary for Month <span class='required'>*</span></label>
                    <div class="col-sm-8">
                         <?php
                             $month = array(
                                     'January' => 'January',
                                     'February' => 'February',
                                     'March' => 'March',
                                     'April' => 'April',
                                     'May' => 'May',
                                     'June' => 'June',
                                     'July' => 'July',
                                     'August' => 'August',
                                     'September' => 'September',
                                     'October' => 'October',
                                     'November' => 'November',
                                     'December' => 'December',
                             );

                             echo form_dropdown('month', array('' => 'Select Month') + $month, (isset($result->month)) ? $result->month : '', ' class="search-select form-control " ');
                             echo form_error('month');
                         ?>
                    </div>
                </div>
                <div class='form-group' >
                    <label class="col-sm-3 control-label">Year <span class='required'>*</span></label>
                    <div class="col-sm-8">

                        <?php
                            $years = array_combine(range(date("Y"), 2008), range(date("Y"), 2008));

                            echo form_dropdown('year', $years, (isset($result->year)) ? $result->year : '', ' class="search-select form-control " ');
                            echo form_error('year');
                        ?>
                    </div>

                </div>

                <div class='form-group'>
                    <label class="col-sm-3 control-label">Salary Processing Date <span class='required'>*</span></label><div class="col-sm-8 input-group">

                        <?php echo form_input('salary_date', $result->salary_date > 0 ? date('d M Y', $result->salary_date) : $result->salary_date, 'class="validate[required] form-control date-picker span4"'); ?>


                        <span class="input-group-addon"> <i class="icon-calendar"></i> </span>


                        <?php echo form_error('salary_date'); ?>

                    </div>
                </div>


            </div>
            <div class="col-sm-6">

                <div class='form-group'>
                    <h4 class=' col-sm-12 ' for='comment'>Comment </h4>
                    <div class="col-sm-12">
                        <textarea id="comment"  style="height: 150px;" class="autosize-transition ckeditor1 form-control "  name="comment"  /><?php echo set_value('comment', (isset($result->comment)) ? htmlspecialchars_decode($result->comment) : ''); ?></textarea>
                        <i style="color:red"><?php echo form_error('comment'); ?></i>
                    </div>
                </div>

            </div>


            <div class="clearfix"></div>
            <hr>
            <div class='form-group'>
                <label class="col-sm-3 control-label"></label><div class="col-sm-8">


                    <?php echo form_submit('submit', ($updType == 'edit') ? 'Update' : 'Process', (($updType == 'create') ? "id='submit' class='btn btn-primary''" : "id='submit' class='btn btn-primary'")); ?>
                    <?php echo anchor('admin/record_salaries', 'Cancel', 'class="btn  btn-default"'); ?>
                </div></div>

            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div>


    <script>



         $(document).ready(function ()
         {
              $('#mem').hide();

              $('#member').click(function ()
              {
                   $('#mem').show();

              });
              $('#bulk').click(function ()
              {
                   $('#mem').hide();
              });
         });

    </script>