<?php







require_once 'conn.php';
require_once 'function.php';

if($_SERVER['REQUEST_METHOD']=="POST"){

   
    $data= json_decode(file_get_contents("php://input"));

    $name= $data->name;
    $description = $data-> description ;
    $price= $data->price;
    $stock=$data->$stock;
      //valedation
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

    if (!is_numeric($price) || $price <= 0) {
        $errors[] = "Price must be a positive number";
    }

    if (!is_numeric($stock) || $stock < 0) {
        $errors[] = "Stock must be a non-negative number";
    }
      
    if (!empty($errors)) {
        msg(["errors" => $errors], 400);
        exit;
    }
    
   
    $query="INSERT INTO `products`( `name`, `description`, `price`,`stock`)
    VALUES ('$name','$description','$price','$stock') ";
    $ruselt=mysqli_query($conn,$query) ;
    if($ruselt){
      
       

       msg("prodects created succsess",200);
    }else{
        msg("error while insert" , 404);
    }
}else{
    msg("not mthoed allowed",501);
}