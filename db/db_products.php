<?php
/**
 * Data-access functions for the products table.
 * Products use hard delete (no DateDeleted column).
 */

/**
 * Return all products, newest first.
 */
function getProducts($conn)
{
    $sql = "SELECT * FROM `products` ORDER BY ID DESC";
    return mysqli_query($conn, $sql);
}

/**
 * Return all products as a simple key→value array suitable for dropdowns.
 * Returns [ [ID => ..., name => ...], ... ]
 */
function getProductsList($conn)
{
    $result = mysqli_query($conn, "SELECT ID, name FROM `products` ORDER BY name ASC");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Return a single product by ID, or false if not found.
 */
function getProductById($conn, $id)
{
    $stmt = mysqli_prepare($conn, "SELECT * FROM `products` WHERE ID = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

/**
 * Insert a new product and return true on success.
 */
function createProduct($conn, $name, $price, $imagePath)
{
    $stmt = mysqli_prepare($conn, "INSERT INTO `products` (name, price, imagePath) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sds", $name, $price, $imagePath);
    return mysqli_stmt_execute($stmt);
}

/**
 * Update an existing product.
 */
function updateProduct($conn, $id, $name, $price, $imagePath)
{
    $stmt = mysqli_prepare($conn, "UPDATE `products` SET name = ?, price = ?, imagePath = ? WHERE ID = ?");
    mysqli_stmt_bind_param($stmt, "sdsi", $name, $price, $imagePath, $id);
    return mysqli_stmt_execute($stmt);
}

/**
 * Hard-delete a product by ID.
 */
function deleteProduct($conn, $id)
{
    $stmt = mysqli_prepare($conn, "DELETE FROM `products` WHERE ID = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}
