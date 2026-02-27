<?php

/**
 * Return all DB actions for menus table
 */

function getMenus($conn)
{
    $sql  = "SELECT * FROM `menus` WHERE DateDeleted IS NULL ORDER BY ID DESC";
    return mysqli_query($conn, $sql);
}

/**
 * Return a single active menu by ID, or false if not found.
 */
function getMenuById($conn, $id)
{
    $stmt = mysqli_prepare($conn, "SELECT * FROM `menus` WHERE ID = ? AND DateDeleted IS NULL LIMIT 1");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

/**
 * Insert a new menu and return true on success.
 */
function createMenu($conn, $name)
{
    $stmt = mysqli_prepare($conn, "INSERT INTO `menus` (Name, DateCreated, DateUpdated) VALUES (?, NOW(), NOW())");
    mysqli_stmt_bind_param($stmt, "s", $name);
    return mysqli_stmt_execute($stmt);
}

/**
 * Update the name of an existing menu and refresh DateUpdated.
 */
function updateMenu($conn, $id, $name)
{
    $stmt = mysqli_prepare($conn, "UPDATE `menus` SET Name = ?, DateUpdated = NOW() WHERE ID = ?");
    mysqli_stmt_bind_param($stmt, "si", $name, $id);
    return mysqli_stmt_execute($stmt);
}

/**
 * Soft-delete a menu by stamping DateDeleted with the current timestamp.
 */
function softDeleteMenu($conn, $id)
{
    $stmt = mysqli_prepare($conn, "UPDATE `menus` SET DateDeleted = NOW() WHERE ID = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}

/**
 * Restore a soft-deleted menu by clearing DateDeleted.
 */
function restoreMenu($conn, $id)
{
    $stmt = mysqli_prepare($conn, "UPDATE `menus` SET DateDeleted = NULL WHERE ID = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}

/**
 * Return all soft-deleted menus, most recently deleted first.
 */
function getArchivedMenus($conn)
{
    $sql = "SELECT * FROM `menus` WHERE DateDeleted IS NOT NULL ORDER BY DateDeleted DESC";
    return mysqli_query($conn, $sql);
}
