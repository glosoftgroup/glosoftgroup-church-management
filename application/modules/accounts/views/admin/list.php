<div class="col-sm-12">
    <div class="panel panel-default"> 
        <div class="panel-heading">
            <i class="icon-external-link-sign"></i>
            <h3 class="panel-title">Accounts Chart</h3>

            <div class="heading-elements">
                <div class="btn-group">
                     <?php echo anchor('admin/accounts/create/' . $page, '<i class="icon-plus"></i> ' . lang('web_add_t', array(':name' => 'Accounts')), 'class="btn btn-info"'); ?>

                    <?php echo anchor('admin/accounts', '<i class="icon-list">
                </i> ' . lang('web_list_all', array(':name' => 'Accounts')), 'class="btn btn-primary"'); ?> 
                </div>
            </div>
        </div>             
        <div class="panel-body" style="display: block;">   
            <div class="widget-main">

                <table class="table table-condensed table-hover"  id="accstable">
                    <thead>
                    <th>#</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Tax</th>
                    <th>Balance</th>
                    <th ><?php echo lang('web_options'); ?></th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    </tfoot>

                </table>


            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
     $(document).ready(function ()
     {
          var oTable;
          oTable = $('#accstable').dataTable({
               "dom": 'TC lfrtip',
               "tableTools": {
                    "sSwfPath": "<?php echo js_path('plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf') ?>"
               },
               "bProcessing": true,
               "bServerSide": true,
               "sServerMethod": "GET",
               "sAjaxSource": "<?php echo base_url('admin/accounts/get_table'); ?>",
               "iDisplayLength": <?php echo $this->list_size; ?>,
               "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
               "aaSorting": [[0, 'asc']],
               "fnRowCallback": function (nRow, aData, iDisplayIndex)
               {
                    var oSettings = oTable.fnSettings();
                    var preff = oSettings._iDisplayStart + iDisplayIndex + 1;
                    $("td:first", nRow).html(preff + '. ');
                    $("td:last", nRow).html("  <div class='btn-group'><a class='btn btn-success btn-sm' href ='<?php echo base_url('admin/accounts/edit/'); ?>" + "/" + aData[0] + "' >Edit Details</a> " + '</div>');
                    $("td:nth-child(6)", nRow).addClass('rttb');
                    return nRow;
               },
               "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url('assets/ico/ajax-loader.gif'); ?>'>"
               },
               "aoColumns": [
                    {"bVisible": true, "bSearchable": false, "bSortable": false},
                    {"bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": true, "bSortable": true},
                    {"bVisible": true, "bSearchable": false, "bSortable": false}
               ],
               "columnDefs": [{
                         "targets": -1,
                         "data": null,
                         "defaultContent": " "
                    }
               ]
          });//.fnSetFilteringDelay(700);
     });
</script>

