<?php echo $template['partials']['perms']; ?>
<div class="row">
    <div class="col-sm-9">
        <div class="panel panel-default animated fadeIn">
            <div class="panel-heading">
                <i class="clip-users-2"></i>
                Assign Permissions
                <div class="heading-elements">
                    <a class="btn btn-xs btn-link panel-collapse collapses" href="#">  </a>
                    <a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="icon-refresh"></i>  </a>
                </div>
            </div>
            <?php echo form_open(current_url(), 'class="form-inline" id="fextra"'); ?>
            <div class="panel-body panel-scroll" style="min-height:400px">
                <table class='table table-striped table-bordered table-hover' id="lis_table" width='95%' >
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th> Name</th>
                            <th>Desc</th>
                            <th width="5%">Check</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot></tfoot>
                </table>

            </div>
            <div class="panel-footer">
                 <?php echo form_error('sids', '<p class="error" >', '</p>'); ?>
                <div class="col-sm-6">  <?php
                         echo form_dropdown('group', array('' => 'Select Group') + $groups, '', ' class="fsel validate[required]"');
                         echo form_error('group');
                     ?>
                </div>
                <div class="col-sm-6">
                    <?php echo form_submit('submit', 'Save', "id='submit' class='btn btn-primary' "); ?>
                    <?php echo anchor('admin/permissions/', 'Cancel', 'class="btn  btn-default"'); ?>
                </div>
                <p>&nbsp;</p>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

</div>

<script type = "text/javascript">
     $(document).ready(function ()
     {
          var oTable;
          oTable = $('#lis_table').dataTable({
               "dom": 'TC lfrtip <"clear">',
               "bProcessing": true,
               "bServerSide": true,
               "sServerMethod": "GET",
               "sAjaxSource": "<?php echo base_url('admin/permissions/get_list'); ?>",
               "iDisplayLength": 50,
               "aLengthMenu": [[10, 25, 50, 250], [10, 25, 50, 250]],
               "aaSorting": [[0, 'asc']],
               "fnRowCallback": function (nRow, aData, iDisplayIndex)
               {
                    var oSettings = oTable.fnSettings();
                    var preff = oSettings._iDisplayStart + iDisplayIndex + 1;
                    $("td:first", nRow).html(preff + '. ');
                    $("td:last", nRow).html('<input type="checkbox" name="sids[]" value="' + aData[0] + '"/>');
                    return nRow;
               },
               "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url('assets/ico/loader.gif'); ?>' >"
               },
               "aoColumns": [
                    {"bVisible": true, "bSearchable": false, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": false},
               ],
               "columnDefs": [{
                         "targets": -1,
                         "data": null,
                         "defaultContent": " "
                    }
               ]
          });

          $(".fsel").select2({'placeholder': 'Please Select', 'width': '100%'});


          $(".fsel").on("change", function (e)
          {
               notify('Select', 'Value changed: ' + e.val);
          });

          $("#entry1 table tr td").children("select").select2({'width': '100%'});
     });
</script>