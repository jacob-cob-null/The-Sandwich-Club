<?php
include __DIR__ . '/../../db/db_conn.php';
include __DIR__ . '/../../db/db_products.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header('Location: index.php?msg=Invalid+product+ID');
    exit;
}

$ok = deleteProduct($conn, $id);

if ($ok) {
    header('Location: index.php?msg=Product+deleted+successfully');
} else {
    header('Location: index.php?msg=Failed+to+delete+product');
}
exit;
