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
                        <input type="number" name="member-id" value=<?= $row['member_id'] ?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Check-in</label>
                        <!-- https://stackoverflow.com/a/58067507 -->
                        <input type="datetime-local" name="check-in" value=<?= date('Y-m-d\TH:i', strtotime($row['check_in'])); ?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Check-out</label>
                        <input type="datetime-local" name="check-out" value=<?= date('Y-m-d\TH:i', strtotime($row['check_out'])); ?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Extra Items</label>
                        <?php
                            $res2 = $connection->query("SELECT * FROM inventory;");
                            echo $res2->num_rows === 0 ? "<div><a href=\"inventory.php\" class=\"text-warning\">No items found. Click here to create one!</a></div>" : "";
                        ?>
                        <select class="form-control" name="extra-items[]" multiple <?= $res2->num_rows === 0 ? 'disabled' : '' ?>>
                            <?php
                                if ($res2->num_rows > 0) {
                                    while ($row2 = mysqli_fetch_assoc($res2)) {
                            ?>
                                        <option value="<?= $row2['inventory_id'] ?>" <?= stristr($row['extra_items'], $row2['inventory_id']) ? 'selected' : '' ?>><?= $row2['item'] ?></option>";
                            <?php
                                    }
                                }
                            ?>
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