<div class="modal fade" id="editModal<?= $row['member_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="member_db.php" method="POST" class="needs-validation" novalidate>
                <div class="modal-body">
                    <input type="hidden" name="member_id" value="<?= $row['member_id'] ?>">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value=<?= $row['name'] ?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value=<?= $row['email'] ?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Contact No.</label>
                        <input type="text" name="contact_no" value=<?= $row['contact_no'] ?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" value=<?= $row['country'] ?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label>VIP Status</label>
                        <input list="vip_status" name="vip_status" value=<?= $row['vip_status'] ?> class="form-control">
                        <datalist id="vip_status">
                        <option value="True">
                        <option value="False">
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" name="remarks" value=<?= $row['remarks'] ?> class="form-control">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit-member" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
