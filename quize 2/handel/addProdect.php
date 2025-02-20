<?php 
// session_start();
require_once '../connection/conn.php';

if(isset($_POST ['submit'])){
    $name=trim(htmlspecialchars($_POST['name']));
    $description=trim(htmlspecialchars($_POST['description']));
    $price=trim(htmlspecialchars($_POST['price']));
    $stock=trim(htmlspecialchars($_POST['stock']));

    $error=[];
     // validation 

     //name 
     if(empty($name)){
        $error[]="name is empty";
     }elseif(strlen($name)<3){
        $error[]="name must be at least 3 characters";
     }elseif(strlen($name)>50){
        $error[]="name must be less than 50 characters";
     }elseif(!preg_match("/^[a-zA-Z\s]+$/", $name)){
        $error[]="name must contain only letters and spaces";
     }


     // description 
      
     if( empty($description)){
        $error[]=" description is empty";
     }elseif(strlen($description)<3){
        $error[]="description must be at least 3 characters";
     }elseif(strlen($description)>1000){
        $error[]="description must be less than 1000 characters";
     }elseif(!preg_match("/^[a-zA-Z\s]+$/", $description)){
        $error[]="description must contain only letters and spaces";
     }
     //price
     if(empty($price)){
        $error[]=" price is empty";
     }elseif($price <= 0){
        $error[]= " price must be a positve number ";
     }elseif(!is_numeric($price)){
        $error[]= " price must be a number ";
     }elseif(!preg_match("/^[0-9.]+$/", $price)){
        $error[]= " price must be a number ";
     }

     // stock 
     if(empty($stock)){
        $error[]=" stock is empty";
     }elseif($stock < 0){
        $error[]= " stock must be a positve number ";
     }elseif(!is_numeric($stock)){
        $error[]= " stock must be a number ";
     }

     if(empty($error)){
      $query="INSERT INTO products (name,description,price,stock) VALUES('$name','$description','$price','$stock')";
      $ranQuery=mysqli_query($conn,$query);
      if($ranQuery){
         $_SESSION['success']=['data inserted successfully'];
        header("location:../homePage.php");

      }
     }else{
       $_SESSION ['error']=$error;
       $_SESSION['name']=$name;
       $_SESSION['description']=$description;
       $_SESSION['price']=$price;
       $_SESSION['stock']=$stock;

       header("location:../homePage.php");
      

   
     }

}else{
    header("location: ../inc/404.php");
}
