<div class="modal fade" id="editModal<?= $row['inventory_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="inventory_db.php" method="POST" class="needs-validation" novalidate>
                <div class="modal-body">
                    <input type="hidden" name="item-id" value="<?= $row['inventory_id'] ?>">
                    <div class="form-group">
                        <label>Category</label>
                        <?php
                            $invCat = $connection->query("SELECT * FROM inventory_category;");
                            echo $invCat->num_rows === 0 ? "<div><a href=\"inventory_categories.php\" class=\"text-warning\">No categories found. Click here to create one!</a></div>" : "";
                        ?>
                        <select class="form-control" name="category" required <?= $invCat->num_rows === 0 ? 'disabled' : '' ?>>
                            <option value="" hidden>None</option>
                            <?php
                                if ($invCat->num_rows > 0) {
                                    while ($row2 = mysqli_fetch_assoc($invCat)) {
                            ?>
                                        <option value="<?= $row2['category_id'] ?>" <?= $row2['category_id'] === $row['category'] ? 'selected' : '' ?>><?= $row2['category_name'] ?></option>";
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Item</label>
                        <input type="text" name="item" value="<?= $row['item'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="quantity" value="<?= $row['quantity'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea class="form-control" name="remarks" rows="3"><?= $row['remarks'] ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit-item" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>