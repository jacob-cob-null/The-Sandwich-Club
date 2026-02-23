<?php
include '../../db/db_conn.php';
$id = $_GET["id"];
$sql = "DELETE FROM `menus` WHERE ID = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: index.php?msg=Menu deleted successfully");
} else {
    echo "Failed: " . mysqli_error($conn);
}
