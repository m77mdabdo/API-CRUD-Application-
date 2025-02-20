<?php
require_once '../connection/conn.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query="DELETE FROM products WHERE id=$id";
    $ranQuery=mysqli_query($conn,$query);
    if($ranQuery){
        $_SESSION['success']=['data deleted successfully'];
        header("location:../homePage.php");
    }
}else{
    header("location:../inc/404.php");
}