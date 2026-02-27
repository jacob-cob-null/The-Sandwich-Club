<?php
include __DIR__ . '/../../db/db_conn.php';
include __DIR__ . '/../../db/db_menuproducts.php';

$baseUrl   = '../';
$pageTitle = 'Menu Products — The Sandwich Club';
include __DIR__ . '/../../includes/navbar.php';
?>

<div class="container-fluid">
    <?php
        if (isset($_GET['msg'])) {
            $msg = htmlspecialchars($_GET['msg']);
            echo '
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                ' . $msg . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <div class="d-flex justify-content-between align-items-center my-3">
            <h2>Menu Products</h2>
            <a href="new_menu_product.php">
                <button type="button" class="btn btn-success">New Menu Product</button>
            </a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Menu</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = getMenuProducts($conn);
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['ID']) ?></td>
                        <td><?= htmlspecialchars($row['menuName']) ?></td>
                        <td><?= htmlspecialchars($row['productName']) ?></td>
                        <td>&#x20B1;<?= htmlspecialchars(number_format($row['productPrice'], 2)) ?></td>
                        <td class="d-flex justify-content-center align-items-center">
                            <a href="update_menu_product.php?id=<?= $row['ID'] ?>" class="link-dark">
                                <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>
                            </a>
                            <a href="delete_menu_product.php?id=<?= $row['ID'] ?>" class="link-dark"
                               onclick="return confirm('Remove this menu product?')">
                                <i class="fa-solid fa-trash fs-5"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
