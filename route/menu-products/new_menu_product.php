<?php
include __DIR__ . '/../../db/db_conn.php';
include __DIR__ . '/../../db/db_menuproducts.php';
include __DIR__ . '/../../db/db_menus.php';
include __DIR__ . '/../../db/db_products.php';

if (isset($_POST['submit'])) {
    $menuID    = (int) ($_POST['menuID']    ?? 0);
    $productID = (int) ($_POST['productID'] ?? 0);

    $errors = [];
    if ($menuID    <= 0) $errors[] = 'Please select a menu.';
    if ($productID <= 0) $errors[] = 'Please select a product.';

    if (empty($errors)) {
        $ok = createMenuProduct($conn, $menuID, $productID);
        if ($ok) {
            header('Location: index.php?msg=Menu+Product+created+successfully');
            exit;
        } else {
            $errors[] = 'Database error: ' . mysqli_error($conn);
        }
    }
}

$menus    = mysqli_fetch_all(getMenus($conn),    MYSQLI_ASSOC);
$products = getProductsList($conn);

$baseUrl   = '../';
$pageTitle = 'New Menu Product — The Sandwich Club';
include __DIR__ . '/../../includes/navbar.php';
?>

<div class="container">
    <div class="text-center mb-4 mt-4">
        <h3>Add New Menu Product</h3>
        <p class="text-muted">Assign a product to a menu.</p>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="mb-3">
                <label class="form-label">Menu:</label>
                <select class="form-select" name="menuID" required>
                    <option value="" disabled selected>— Select a menu —</option>
                    <?php foreach ($menus as $menu): ?>
                        <option value="<?= $menu['ID'] ?>"
                            <?= isset($_POST['menuID']) && $_POST['menuID'] == $menu['ID'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($menu['Name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Product:</label>
                <select class="form-select" name="productID" required>
                    <option value="" disabled selected>— Select a product —</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= $product['ID'] ?>"
                            <?= isset($_POST['productID']) && $_POST['productID'] == $product['ID'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($product['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
