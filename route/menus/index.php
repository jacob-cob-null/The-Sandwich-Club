<?php
include __DIR__ . '/../../db/db_conn.php';
include __DIR__ . '/../../db/db_menus.php';

$baseUrl   = '../';
$pageTitle = 'Menus — The Sandwich Club';
include __DIR__ . '/../../includes/navbar.php';
?>

<div class="container-fluid">
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <?= htmlspecialchars($_GET['msg']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
        <h2>Menus</h2>
    <div class="d-flex justify-content-between align-items-center my-3">
        <ul class="nav nav-tabs border-0 mb-0" id="menuTabs">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#activeMenus">Active</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#archivedMenus">Archive</button>
            </li>
        </ul>
        <a href="new_menu.php">
            <button type="button" class="btn btn-success">New Menu</button>
        </a>
    </div>

    <div class="tab-content">

        <!-- Active -->
        <div class="tab-pane fade show active" id="activeMenus">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date Created</th>
                        <th>Date Updated</th>
                        <th style="width:1%; white-space:nowrap;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = getMenus($conn);
                    while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['ID']) ?></td>
                            <td><?= htmlspecialchars($row['Name']) ?></td>
                            <td><?= htmlspecialchars($row['DateCreated']) ?></td>
                            <td><?= htmlspecialchars($row['DateUpdated']) ?></td>
                            <td style="white-space:nowrap;">
                                <a href="update_menu.php?id=<?= $row['ID'] ?>" class="link-dark">
                                    <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>
                                </a>
                                <a href="delete_menu.php?id=<?= $row['ID'] ?>" class="link-dark"
                                   onclick="return confirm('Soft-delete this menu?')">
                                    <i class="fa-solid fa-trash fs-5"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Archive -->
        <div class="tab-pane fade" id="archivedMenus">
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date Created</th>
                        <th>Date Updated</th>
                        <th>Date Deleted</th>
                        <th style="width:1%; white-space:nowrap;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $archived = getArchivedMenus($conn);
                    while ($row = mysqli_fetch_assoc($archived)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['ID']) ?></td>
                            <td><?= htmlspecialchars($row['Name']) ?></td>
                            <td><?= htmlspecialchars($row['DateCreated']) ?></td>
                            <td><?= htmlspecialchars($row['DateUpdated']) ?></td>
                            <td class="text-danger"><?= htmlspecialchars($row['DateDeleted']) ?></td>
                            <td style="white-space:nowrap;">
                                <a href="restore_menu.php?id=<?= $row['ID'] ?>" class="link-dark"
                                   onclick="return confirm('Restore this menu?')">
                                    <i class="fa-solid fa-rotate-left fs-5"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php include __DIR__ . '/../../includes/footer.php'; ?>