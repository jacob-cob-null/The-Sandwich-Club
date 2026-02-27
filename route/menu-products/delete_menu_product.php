<?php
include __DIR__ . '/../../db/db_conn.php';
include __DIR__ . '/../../db/db_menuproducts.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header('Location: index.php?msg=Invalid+menu+product+ID');
    exit;
}

$ok = deleteMenuProduct($conn, $id);

if ($ok) {
    header('Location: index.php?msg=Menu+Product+deleted+successfully');
} else {
    header('Location: index.php?msg=Failed+to+delete+menu+product');
}
exit;
