<?php

require_once 'conn.php';
require_once 'function.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   
    $uri = $_SERVER['REQUEST_URI'];
    $uriArray = explode("/", $uri);
    $id = end($uriArray);

    if (!is_numeric($id) || $id <= 0) {
        msg("Invalid ID", 400);
        exit;
    }

 
    $name = trim(htmlspecialchars($_POST['name'] ?? ''));
    $description = trim(htmlspecialchars($_POST['description'] ?? ''));
    $price = trim(htmlspecialchars($_POST['price'] ?? ''));
    $stock = trim(htmlspecialchars($_POST['stock'] ?? ''));

 
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (strlen($name) < 3) {
        $errors[] = "Name must be at least 3 characters";
    } elseif (strlen($name) > 50) {
        $errors[] = "Name must be less than 50 characters";
    }

    if (empty($description)) {
        $errors[] = "Description is required";
    } elseif (strlen($description) < 3) {
        $errors[] = "Description must be at least 3 characters";
    } elseif (strlen($description) > 1000) {
        $errors[] = "Description must be less than 1000 characters";
    }

    if (empty($price) || !is_numeric($price) || $price <= 0) {
        $errors[] = "Price must be a positive number";
    }

    if (empty($stock) || !is_numeric($stock) || $stock < 0) {
        $errors[] = "Stock must be a non-negative number";
    }


    if (!empty($errors)) {
        msg(["errors" => $errors], 400);
        exit;
    }

  
    $query = "SELECT id FROM products WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
      
        $query = "UPDATE products SET name='$name', description='$description', price='$price', stock='$stock' WHERE id=$id";
        $updateResult = mysqli_query($conn, $query);

        if ($updateResult) {
            msg("Product updated successfully", 200);
        } else {
            msg("Failed to update product", 500);
        }
    } else {
        msg("Product not found", 404);
    }
} else {
    msg("Method not allowed", 405);
}
?>
