<!------------START MODAL-------------------------------->

<div id="Edit_<?php echo $p->id; ?>" class="modal container fade" tabindex="-1" style="display: none;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            &times;
        </button>
        <h4 class="modal-title">Baptism Registration Details</h4>
    </div>
    <div class="modal-body">

        <!---BODY DATA HERE-------------->

    </div>
    <div class="modal-footer">
         <?php echo form_submit('submit', ($updType == 'edit') ? 'Update Changes' : 'Save Changes', (($updType == 'create') ? "id='submit' class=' btn btn-info''" : "id='submit' class='btn btn-info'")); ?>
        <button type="button" data-dismiss="modal" class="btn btn-default">
            Close
        </button>

    </div>
</div>