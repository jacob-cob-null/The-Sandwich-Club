<?php
include __DIR__ . '/../../db/db_conn.php';
include __DIR__ . '/../../db/db_products.php';

$baseUrl   = '../';
$pageTitle = 'Products — The Sandwich Club';
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
            <h2>Products</h2>
            <a href="new_product.php">
                <button type="button" class="btn btn-success">New Product</button>
            </a>
        </div>

        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th style="width:140px;">Image</th>
                    <th style="width:1%; white-space:nowrap;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = getProducts($conn);
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['ID']) ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td>&#x20B1;<?= htmlspecialchars(number_format($row['price'], 2)) ?></td>
                        <td class="p-0" style="height:80px;">
                            <?php if ($row['imagePath']): ?>
                                <a href="#"
                                   data-bs-toggle="modal"
                                   data-bs-target="#imgModal"
                                   data-src="/<?= htmlspecialchars($row['imagePath']) ?>"
                                   data-label="<?= htmlspecialchars($row['name']) ?>">
                                    <img src="/<?= htmlspecialchars($row['imagePath']) ?>"
                                         alt="<?= htmlspecialchars($row['name']) ?>"
                                         style="width:100%; height:80px; object-fit:cover; display:block;">
                                </a>
                            <?php else: ?>
                                <span class="text-muted fst-italic">None</span>
                            <?php endif; ?>
                        </td>
                        <td style="white-space:nowrap;">
                            <a href="update_product.php?id=<?= $row['ID'] ?>" class="link-dark">
                                <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>
                            </a>
                            <a href="delete_product.php?id=<?= $row['ID'] ?>" class="link-dark"
                               onclick="return confirm('Delete this product? Any menu products using it will also be removed.')">
                                <i class="fa-solid fa-trash fs-5"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
</div>

<!-- Image preview modal -->
<div class="modal fade" id="imgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark border-0">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title text-white" id="imgModalLabel"></h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-2">
                <img id="imgModalSrc" src="" alt="" class="img-fluid rounded" style="max-height:80vh;">
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('imgModal').addEventListener('show.bs.modal', function (e) {
        const trigger = e.relatedTarget;
        document.getElementById('imgModalSrc').src   = trigger.dataset.src;
        document.getElementById('imgModalSrc').alt   = trigger.dataset.label;
        document.getElementById('imgModalLabel').textContent = trigger.dataset.label;
    });
</script>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
