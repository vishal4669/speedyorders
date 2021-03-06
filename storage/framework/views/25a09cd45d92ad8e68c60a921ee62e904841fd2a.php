<div class="modal" id="delete-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <strong>If you delete this item you won't be able to undo in the future, do you want to
                    continue?</strong>
            </div>
            <div class="modal-footer">
                <form action="" id="delete-form" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="modal-submit">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/speedyorders/public_html/modban.com/resources/views/commons/delete_modal.blade.php ENDPATH**/ ?>