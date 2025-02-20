<?php

require_once 'conn.php';
require_once 'function.php';

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    
   
    $uri_array = explode("/", $_SERVER['REQUEST_URI']);
    $id = end($uri_array);

    if (!is_numeric($id) || $id <= 0) {
        msg("Invalid ID", 400);
        exit;
    }


    $query = "SELECT id FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) == 1) {
  
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        $deleteResult = mysqli_stmt_execute($stmt);

        if ($deleteResult) {
            msg("User deleted successfully", 200);
        } else {
            msg("Error deleting user", 500);
        }
    } else {
        msg("Data not found", 404);
    }

} else {
    msg("Method not allowed", 405);
}
?>
