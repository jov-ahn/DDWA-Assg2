<div class="modal fade" id="editModal<?= $row['category_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Expense Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="expenses_categories_db.php" method="POST" class="needs-validation" novalidate>
                <div class="modal-body">
                    <input type="hidden" name="category-id" value="<?= $row['category_id'] ?>">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="category-name" value="<?= $row['category_name'] ?>" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit-expense-category" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>