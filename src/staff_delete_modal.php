<div class="modal fade" id="deleteModal<?= $row['staff_id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="staff_db.php" method="POST" class="needs-validation" novalidate>
                <div class="modal-body">
                    <input type="hidden" name="staff_id" value="<?= $row['staff_id'] ?>">
                    <h4>Delete "<?= $row['name'] ?>"?</h4>
                    <h6>This action cannot be undone.</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="delete-staff" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>