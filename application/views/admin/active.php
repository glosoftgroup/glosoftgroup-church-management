<?php
$dys = 0;
$padl = new Padl\License(true, true, true, true);
if ($key)
{
        $license = $padl->validate($key->license);

        $lc = (object) $license;
        if ($lc->RESULT == 'OK')
        {
                $this->load->library('Dates');
                $first = $this->dates->createFromTimeStamp(now());
                $dt = $this->dates->createFromTimeStamp($lc->DATE['END']);
                $dys = $dt->diffInDays($first);
        }
}
?> 

<div class="row">
    <div class="col-sm-12">
        <div class="row space12">
            <ul class="mini-stats col-sm-12">
                <li class="col-sm-3">
                    <i class="clip-key-2 circle-icon circle-green" title="<?php echo $padl->id_me() ?>"></i>
                    <div class="values">
                        <strong><?php echo isset($lc->RESULT) ? $dys . ' Days Remaining' : ' License not Found'; ?></strong>
                    </div>
                 </li>
                 
            </ul>
        </div>
        <hr/>
    </div>

</div>

<div class="row">
    <div class="col-sm-9">
        <!-- start: TEXT AREA PANEL -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="icon-external-link-sign"></i>
                License
                <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
            </div>
            <div class="panel-body">

                <div>
                    <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                    echo form_open_multipart('admin/do_key', $attributes);
                    ?>
                    <label for="form-field-24">
                        Enter License Code
                    </label>
                    <textarea class="autosize form-control" name="license" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 114px;"></textarea>
                    <?php echo form_error('license'); ?><br>
                    <?php echo form_submit('submit', 'Save', "id='submit' class='btn btn-blue btn-small pull-right'"); ?>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!-- end: TEXT AREA PANEL -->
    </div>

</div>
