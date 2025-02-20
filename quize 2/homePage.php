<?php
// session_start();
require_once 'connection/conn.php';
require_once 'inc/header.php';


?>
    <h2>Home Page</h2>
    <button onclick="showSection('display')">Display All Products</button>
    <button onclick="showSection('create')">Create New Product</button>
    
    <div id="create" style="display:none;">
        <h2>Create New Product</h2>


        <?php
        if (isset($_SESSION['error'])) {
    
    foreach ($_SESSION['error'] as $err) {?>

        
      <div class="alert alert-denger "> <?php echo $err ."<br>"; ?></div>
      <?php  }
   
      unset($_SESSION['error']);
    
       }?>
        <form method="post" action="handel/addProdect.php" >
            <input type="text" name="name" placeholder="Product Name" required  value="<?php if(isset($_SESSION['name'])) echo($_SESSION['name']) ;unset($_SESSION['name']) ?>">><br>
            <textarea name="description" placeholder="Description" required value="<?php if(isset($_SESSION['description'])) echo($_SESSION['description']) ;unset($_SESSION['description']) ?>"></textarea>></textarea><br>
            <input type="number" name="price" placeholder="Price" step="0.01" required value="<?php if(isset($_SESSION['price'])) echo($_SESSION['price']) ;unset($_SESSION['price']) ?>">><br>
            <input type="number" name="stock" placeholder="Stock" required  value="<?php if(isset($_SESSION['stock'])) echo($_SESSION['stock']) ;unset($_SESSION['stock']) ?>">><br>
            <button type="submit" name="submit">Add Product</button>
        </form>
    </div>

    <div id="display" style="display:none;">
        <h2>All Products</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
            <?php
            $query = "SELECT * FROM products";
            $ranQuery = mysqli_query($conn, $query);
            if (mysqli_num_rows($ranQuery) > 0) {
                $products = mysqli_fetch_all($ranQuery, MYSQLI_ASSOC);
                foreach ($products as $product) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['description']); ?></td>
                        <td><?php echo htmlspecialchars($product['price']); ?></td>
                        <td><?php echo htmlspecialchars($product['stock']); ?></td>
                        <td>
                            <a href="update.php?id=<?php echo $product['id']; ?>">Update</a> |
                            <form action="handel/deleteProdect.php<?php echo '?id=' . $product['id']; ?>" method="POST"> 
                            <button type="submit" name="submit"  class="btn btn-danger" >delete </button>
                            </form>
                        </td>
                    </tr>
                <?php }
            } else {
                echo "<tr><td colspan='5'>No products found.</td></tr>";
            }
            ?>
        </table>
    </div>

   

<?php 
include_once 'inc/footer.php';
?>
