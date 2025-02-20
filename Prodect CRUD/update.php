<?php 
// session_start();
require_once 'connection/conn.php';
require_once 'inc/header.php';


if(isset($_GET['id'])){
    $id = trim($_GET['id']); 
    $query = "SELECT * FROM products WHERE id = $id";
    $ranQuery = mysqli_query($conn, $query);

    if(mysqli_num_rows($ranQuery) == 1){
        $product = mysqli_fetch_assoc($ranQuery);
    } else {
        header("Location: inc/404.php");
     
    }
} else {
    header("Location: inc/404.php");
 
}
?>

<h2>Update Product</h2>

<?php

if (isset($_SESSION['error'])) {
    foreach ($_SESSION['error'] as $err) { ?>
        <div class="alert alert-danger"><?php echo $err . "<br>"; ?></div>
    <?php }
    unset($_SESSION['error']);
}
?>

<form method="post" action="handel/updateProdect.php">
   
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <input type="text" name="name" placeholder="Product Name" required 
           value="<?php echo $product['name']; ?>"><br>

    <textarea name="description" placeholder="Description" required><?php echo $product['description']; ?></textarea><br>

    <input type="number" name="price" placeholder="Price" step="0.01" required 
           value="<?php echo $product['price']; ?>"><br>

    <input type="number" name="stock" placeholder="Stock" required 
           value="<?php echo $product['stock']; ?>"><br>

    <button type="submit" name="submit">Update Product</button>
</form>

<?php 
include_once 'inc/footer.php';
?>
