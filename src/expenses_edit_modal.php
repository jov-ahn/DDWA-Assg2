<div class="modal fade" id="editModal<?= $row['expense_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Expense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="expenses_db.php" method="POST" class="needs-validation" novalidate>
                <div class="modal-body">
                    <input type="hidden" name="expense-id" value="<?= $row['expense_id'] ?>">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" value=<?= date('Y-m-d', strtotime($row['date'])); ?> class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <?php
                            $expCat = $connection->query("SELECT * FROM expense_category;");
                            echo $expCat->num_rows === 0 ? "<div><a href=\"expenses_categories.php\" class=\"text-warning\">No categories found. Click here to create one!</a></div>" : "";
                        ?>
                        <select class="form-control" name="category" required <?= $expCat->num_rows === 0 ? 'disabled' : '' ?>>
                            <option value="" hidden>None</option>
                            <?php
                                if ($expCat->num_rows > 0) {
                                    while ($row2 = mysqli_fetch_assoc($expCat)) {
                            ?>
                                        <option value="<?= $row2['category_id'] ?>" <?= $row2['category_id'] === $row['category'] ? 'selected' : '' ?>><?= $row2['category_name'] ?></option>";
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" value="<?= $row['description'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" name="amount" value="<?= $row['amount'] ?>" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit-expense" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>