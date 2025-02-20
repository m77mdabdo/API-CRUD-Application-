<?php
require_once 'conn.php';



// api (meethod (git ,post) ,json ,content type , access control )
header("Content-Type:application/json utf-8");  // 3
 

if($_SERVER['REQUEST_METHOD']=="GET"){    // 1
$query="select * from products where id=5 ";
$ruselt= mysqli_query($conn,$query);
if(mysqli_num_rows($ruselt)>0){
    $prodect=json_encode(mysqli_fetch_all($ruselt,MYSQLI_ASSOC)); // 2 
   
    var_dump($prodect);

}else{
    echo json_encode("data not founded");
    http_response_code(404);  // 4
}

}else{
    echo json_encode("not mthoed allowed");
    http_response_code(501);     //4 
}