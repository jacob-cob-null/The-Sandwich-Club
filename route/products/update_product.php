<?php
include __DIR__ . '/../../db/db_conn.php';
include __DIR__ . '/../../db/db_products.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php?msg=Invalid+product+ID');
    exit;
}

$product = getProductById($conn, $id);
if (!$product) {
    header('Location: index.php?msg=Product+not+found');
    exit;
}

define('UPLOAD_DIR', __DIR__ . '/../../uploads/');
define('UPLOAD_MAX_BYTES', 5 * 1024 * 1024);
define('ALLOWED_MIME', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);

$errors = [];

if (isset($_POST['submit'])) {
    $name      = trim($_POST['name']  ?? '');
    $price     = trim($_POST['price'] ?? '');
    // Start with the current saved path; overwrite only if a new file is uploaded
    $imagePath = $product['imagePath'];

    if ($name === '')                        $errors[] = 'Product name is required.';
    if ($name !== '' && strlen($name) > 128) $errors[] = 'Product name must be 128 characters or fewer.';
    if (!is_numeric($price) || $price < 0)   $errors[] = 'Price must be a valid positive number.';

    // --- image upload (optional on update) ---
    $newFilename = null;
    if (!empty($_FILES['image']['name'])) {
        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Upload failed (error code ' . $_FILES['image']['error'] . ').';
        } elseif ($_FILES['image']['size'] > UPLOAD_MAX_BYTES) {
            $errors[] = 'Image must be 5 MB or smaller.';
        } else {
            $mime = mime_content_type($_FILES['image']['tmp_name']);
            if (!in_array($mime, ALLOWED_MIME, true)) {
                $errors[] = 'Only JPEG, PNG, GIF, or WebP images are accepted.';
            } else {
                $ext         = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $newFilename = uniqid('prod_', true) . '.' . strtolower($ext);
                $imagePath   = 'uploads/' . $newFilename;
            }
        }
    }

    if (empty($errors)) {
        if ($newFilename !== null) {
            move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_DIR . $newFilename);
        }
        $ok = updateProduct($conn, $id, $name, (float) $price, $imagePath);
        if ($ok) {
            header('Location: index.php?msg=Product+updated+successfully');
            exit;
        } else {
            $errors[] = 'Database error: ' . mysqli_error($conn);
        }
    }
}

$baseUrl   = '../';
$pageTitle = 'Update Product — The Sandwich Club';
include __DIR__ . '/../../includes/navbar.php';
?>

<div class="container">
    <div class="text-center mb-4 mt-4">
        <h3>Update Product</h3>
        <p class="text-muted">Revise the details for this product.</p>
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
        <form action="" method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
            <div class="mb-3">
                <label class="form-label">Product Name:</label>
                <input type="text"
                       class="form-control"
                       name="name"
                       value="<?= htmlspecialchars($_POST['name'] ?? $product['name']) ?>"
                       maxlength="128"
                       required>
            </div>
            <div class="mb-3">
                <label class="form-label">Price (&#x20B1;):</label>
                <input type="number"
                       class="form-control"
                       name="price"
                       value="<?= htmlspecialchars($_POST['price'] ?? $product['price']) ?>"
                       step="0.01"
                       min="0"
                       max="999.99"
                       required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Image:</label>
                <?php if (!empty($product['imagePath'])): ?>
                    <div class="mb-2">
                        <img src="/<?= htmlspecialchars($product['imagePath']) ?>"
                             alt="Current product image"
                             style="height:80px; border-radius:6px; object-fit:cover;">
                        <div class="form-text">
                            Current: <code><?= htmlspecialchars($product['imagePath']) ?></code>
                        </div>
                    </div>
                <?php endif; ?>
                <input type="file"
                       class="form-control"
                       name="image"
                       accept="image/jpeg,image/png,image/gif,image/webp">
                <div class="form-text">Leave blank to keep the current image. JPEG, PNG, GIF, or WebP &mdash; max 5 MB.</div>
            </div>
            <div>
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
