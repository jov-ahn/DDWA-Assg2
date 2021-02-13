<div class="modal fade" id="editModal<?= $row['bill_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Bill Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="bill_db.php" method="POST" class="needs-validation" novalidate>
                <div class="modal-body">
                    <input type="hidden" name="bill_id" value="<?= $row['bill_id'] ?>">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" value=<?= $row['date'] ?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Member name</label>
                        <input type="text" name="name" value=<?= $row['member_name'] ?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value=<?= $row['member_email'] ?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" name="amount" value=<?= $row['amount'] ?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" name="remarks" value=<?= $row['remarks'] ?> class="form-control">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit-bill" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>