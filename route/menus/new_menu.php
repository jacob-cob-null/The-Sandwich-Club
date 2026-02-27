<?php
include __DIR__ . '/../../db/db_conn.php';
include __DIR__ . '/../../db/db_menus.php';

if (isset($_POST['submit'])) {
    $menuName = trim($_POST['menu_name'] ?? '');

    if ($menuName === '') {
        $error = 'Menu name cannot be empty.';
    } else {
        $ok = createMenu($conn, $menuName);
        if ($ok) {
            header('Location: index.php?msg=New+menu+created+successfully');
            exit;
        } else {
            $error = 'Failed: ' . mysqli_error($conn);
        }
    }
}

$baseUrl   = '../';
$pageTitle = 'New Menu — The Sandwich Club';
include __DIR__ . '/../../includes/navbar.php';
?>

<div class="container">
    <div class="text-center mb-4 mt-4">
        <h3>Add New Menu</h3>
        <p class="text-muted">Ready to spice things up? Add a new menu to the club!</p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Menu Name:</label>
                    <input type="text"
                           class="form-control"
                           name="menu_name"
                           placeholder='The "Good Sandwiches"'
                           value="<?= htmlspecialchars($_POST['menu_name'] ?? '') ?>"
                           maxlength="128"
                           required>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . '/../../includes/footer.php'; ?>