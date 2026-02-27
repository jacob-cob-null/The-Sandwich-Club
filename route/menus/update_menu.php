<?php
include __DIR__ . '/../../db/db_conn.php';
include __DIR__ . '/../../db/db_menus.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php?msg=Invalid+menu+ID');
    exit;
}

$menu = getMenuById($conn, $id);
if (!$menu) {
    header('Location: index.php?msg=Menu+not+found');
    exit;
}

if (isset($_POST['submit'])) {
    $menuName = trim($_POST['menu_name'] ?? '');

    if ($menuName === '') {
        $error = 'Menu name cannot be empty.';
    } else {
        $ok = updateMenu($conn, $id, $menuName);
        if ($ok) {
            header('Location: index.php?msg=Menu+updated+successfully');
            exit;
        } else {
            $error = 'Failed: ' . mysqli_error($conn);
        }
    }
}

$baseUrl   = '../';
$pageTitle = 'Update Menu — The Sandwich Club';
include __DIR__ . '/../../includes/navbar.php';
?>

<div class="container">
    <div class="text-center mb-4 mt-4">
        <h3>Update Menu</h3>
        <p class="text-muted">Ready to spice things up? Update an existing menu in the club!</p>
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
                           value="<?= htmlspecialchars($_POST['menu_name'] ?? $menu['Name']) ?>"
                           placeholder='The "Good Sandwiches"'
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