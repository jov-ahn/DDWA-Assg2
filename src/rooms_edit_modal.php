<div class="modal fade" id="editModal<?= $row['room_no'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Room <?= $row['room_no'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="rooms_db.php" method="POST" class="needs-validation" novalidate>
                <div class="modal-body">
                    <input type="hidden" name="room-no" value="<?= $row['room_no'] ?>">
                    <div class="form-group">
                        <label>Member ID</label>
                        <input type="number" name="member-id" value=<?= $row['member_id'] ?> class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Extra Items</label>
                        <!-- https://stackoverflow.com/a/25267392 -->
                        <select class="form-control selectpicker" name="extra-items[]" title="None" data-live-search="true" multiple>
                            <option>Pillow</option>
                            <option>Blanket</option>
                            <option>Towel</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit-room" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>