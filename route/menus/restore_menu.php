<?php
include __DIR__ . '/../../db/db_conn.php';
include __DIR__ . '/../../db/db_menus.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    header('Location: index.php?msg=Invalid+menu+ID');
    exit;
}

$ok = restoreMenu($conn, $id);

if ($ok) {
    header('Location: index.php?msg=Menu+restored+successfully');
} else {
    header('Location: index.php?msg=Failed+to+restore+menu');
}
exit;
