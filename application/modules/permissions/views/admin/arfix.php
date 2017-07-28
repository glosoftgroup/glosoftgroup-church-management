<?php echo $template['partials']['perms']; ?>
<div class="row">
    <div class="panel panel-default animated fadeIn">
        <div class="panel-heading">
            <i class="clip-checkbox"></i>
            Fix Routes
            <div class="heading-elements">
                <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>
                <a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">  <i class="icon-wrench"></i></a>
            </div>
        </div>
        <div class="panel-body panel-scroll" style="height:400px">
             <?php
                 $attributes = array('class' => 'form-horizontal', 'id' => '');
                 echo form_open_multipart(current_url(), $attributes);
             ?>

            <table class='table table-striped table-bordered table-hover'>
                <tr>
                    <th width="6%">#</th>
                    <th colspan="2" width="20%">Module</th>
                    <th colspan="2" width="20%">Route</th>
                    <th colspan="2" width="40%">Title</th>
                    <th colspan="2" width="20%">in Sidebar?</th>
                </tr>
                <?php
                    $i = 0;
                    foreach ($result as $r):
                         $snam = isset($resources[$r->resource]) ? $resources[$r->resource] : '-';
                         $i++;
                         ?>
                         <tr>
                              <?php
                              $nm = 'description_' . $r->id;
                              $ism = 'is_menu_' . $r->id;
                              ?>
                             <td > <?php echo $i . '. '; ?></td>
                             <td colspan="2"> <?php echo $snam; ?></td>
                             <td colspan="2"> <?php echo $r->method; ?></td>
                             <td colspan="2"  class="bglite">
                                 <span  class="editable remarks" id="<?php echo $nm; ?>"> <?php echo $r->description; ?></span>
                             </td>
                             <td colspan="2"  class="bglite">
                                 <span  class="editable remarks" id="<?php echo $ism; ?>"> <?php echo $r->is_menu; ?></span>
                             </td>
                         </tr>
                    <?php endforeach; ?>         

            </table>

            <?php echo form_close(); ?>

        </div>

    </div>
</div>



<script type="text/javascript">
     $(function ()
     {
          $.fn.editable.defaults.mode = 'inline';
          $.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
          $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>' +
                  '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';
          $('.remarks').editable({
               type: 'text',
          title: 'Enter Title',
               placement: 'right',
               pk: 2,
               url: '<?php echo base_url('admin/permissions/mend_routes/'); ?>',
                              defaultValue: '   ',
               success: function (response, newValue)
                              {
                              //notify('Route Fixer', 'Route Updated: ' + newValue);
                              }
                                   }
          );

     });
</script>
<style>
    .bglite{background-color: #fff;}
</style>