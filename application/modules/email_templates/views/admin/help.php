<div class="row-fluid">
    <div class="span12">

        <!-- Page Heading and Search -->
        <div class="page-header">
            <h1>Email Templates</h1>
        </div>
    </div><!--/span-->
</div><!--/row-->

<div class="row-fluid">
    <div class="span12">
        <!-- Buttons -->
        <?php echo anchor('admin/email_templates/create', '<i class="icon-plus-sign"></i> Add New Item', ' class="btn btn-large btn-success" '); ?>
        <?php echo anchor('admin/email_templates', '<i class="icon-th-list"></i> List All Items', ' class="btn btn-large " '); ?>
        <?php echo anchor('admin/email_templates/export', '<i class="icon-download"></i> Export Records', ' class="btn btn-large btn-info" '); ?>
        <?php echo anchor('admin/email_templates/import', '<i class="icon-upload"></i> Import Records', ' class="btn btn-large btn-warning" '); ?>
    </div><!--/span-->
    <div class="span12">
        <p>&nbsp;</p>
    </div><!--/span-->
</div><!--/row-->
<div class="row-fluid">
    <div class="span12">
        <!-- Pagination Links -->
        <div class="pagination">
             <?php if (!empty($pagination['links'])): ?>
                      <?php echo $pagination['links']; ?>
                 <?php endif; ?>
        </div>
    </div><!--/span-->
</div><!--/row-->

<div class="row-fluid">
    <div class="span12">
        <!-- Paging Description and Field Selector -->
        <p>Showing from <span class="badge">100</span> to <span class="badge badge-info">150</span> of <span class="badge badge-success">233</span> Items</p>
    </div><!--/span-->
</div><!--/row-->
<div class="row-fluid">
    <div class="span12">
         <?php echo form_open('admin/email_templates/action', ' id="form"  class="form-horizontal"'); ?> 
        <table class="table table-striped table-bordered table-condensed"> 
            <thead>
                <tr>
                    <td align="center"><input type="checkbox" class="checkall" /></td>
                    <th>Title</th>											<th>Slug</th>
                    <th class="width-10"><span>Actions</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                </tr>
                <?php foreach ($posts as $post): ?>
                         <tr>
                             <td><?php echo form_checkbox('action_to[]', $post->id); ?></td>
                             <td><?php echo $post->title ?></td>											<td><?php echo $post->slug ?></td>
                             <td>

                                 <?php echo anchor('admin/email_templates/delete/' . $post->id, '<i class="icon-remove-circle"></i> Delete', ' class="btn btn-small btn-danger" onclick="return confirm(\'Are you sure?\nThis Action is not Reversible!\')" '); ?> |
                                 <?php echo anchor('admin/email_templates/edit/' . $post->id, '<i class="icon-edit"></i> Edit', ' class="btn btn-small btn-info"'); ?>
                             </td>
                         </tr>
                    <?php endforeach; ?>
            </tbody>
            <tr>
            </tr>
        </table>
        <div class="form-actions">
            <!--<button type="submit" name="btnAction" value="delete" class="btn btn-danger">Delete</button>
            <button type="submit" name="btnAction" value="publish" class="btn btn-warning">Publish</button>-->

        </div>
        <?php echo form_close(); ?>    
    </div><!--/span-->
</div><!--/row-->
