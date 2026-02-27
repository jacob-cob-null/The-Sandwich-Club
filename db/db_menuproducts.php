<?php
/**
 * Data-access functions for the menuproducts table.
 */

/**
 * Return all menu products joined with menu and product names, newest first.
 */
function getMenuProducts($conn)
{
    $sql = "
        SELECT
            mp.ID,
            mp.menuID,
            mp.productID,
            m.Name        AS menuName,
            p.name        AS productName,
            p.price       AS productPrice
        FROM `menuproducts` mp
        INNER JOIN `menus`    m ON m.ID = mp.menuID
        INNER JOIN `products` p ON p.ID = mp.productID
        ORDER BY mp.ID DESC
    ";
    return mysqli_query($conn, $sql);
}

/**
 * Return a single menu product by ID with joined names, or false if not found.
 */
function getMenuProductById($conn, $id)
{
    $stmt = mysqli_prepare($conn, "
        SELECT
            mp.ID,
            mp.menuID,
            mp.productID,
            m.Name  AS menuName,
            p.name  AS productName
        FROM `menuproducts` mp
        INNER JOIN `menus`    m ON m.ID = mp.menuID
        INNER JOIN `products` p ON p.ID = mp.productID
        WHERE mp.ID = ?
        LIMIT 1
    ");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

/**
 * Add a product to a menu (create a menu product entry).
 */
function createMenuProduct($conn, $menuID, $productID)
{
    $stmt = mysqli_prepare($conn, "INSERT INTO `menuproducts` (menuID, productID) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ii", $menuID, $productID);
    return mysqli_stmt_execute($stmt);
}

/**
 * Update an existing menu product (change the linked menu or product).
 */
function updateMenuProduct($conn, $id, $menuID, $productID)
{
    $stmt = mysqli_prepare($conn, "UPDATE `menuproducts` SET menuID = ?, productID = ? WHERE ID = ?");
    mysqli_stmt_bind_param($stmt, "iii", $menuID, $productID, $id);
    return mysqli_stmt_execute($stmt);
}

/**
 * Hard-delete a menu product by ID.
 */
function deleteMenuProduct($conn, $id)
{
    $stmt = mysqli_prepare($conn, "DELETE FROM `menuproducts` WHERE ID = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}
