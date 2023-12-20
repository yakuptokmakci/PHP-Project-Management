<?php
session_start();
$mysqli = require __DIR__ . "/database.php";
$userid = isset($_GET['user_id']) ? $_GET['user_id'] : null;

if(isset($_GET['id'])){
    $product_id = $_GET['id'];
    $query = "DELETE FROM products WHERE product_id = '$product_id' AND creator_id = '$userid'";
    
    $result = mysqli_query($mysqli, $query);

    if(!$result){
        die("SQL Error: " . mysqli_error($mysqli));
    }
}else{
    die("success");
}


?>
