<?php

include 'database.php';


$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0; 

// Product information from database
$product_id = intval($product_id); 

$query = "SELECT product_id, product_name, location_first, location_second, creator_id FROM products WHERE product_id = $product_id";
$result = $mysqli->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    if ($row) {
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $location_first = $row['location_first'];
        $location_second = $row['location_second'];
        $creator_id = $row['creator_id'];
    }
    $result->close();
}

// If the form has been submitted, update the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from form
    $product_id = intval($_POST['product_id']); 
    $product_name = $mysqli->real_escape_string($_POST['product_name']);
    $location_first = doubleval($_POST['location_first']); 
    $location_second = doubleval($_POST['location_second']); 
    $creator_id = intval($_POST['creator_id']); 

    // Database update query 
    $updateQuery = "UPDATE products SET product_name='$product_name', location_first=$location_first, location_second=$location_second, creator_id=$creator_id WHERE product_id=$product_id";

    // Execute the query
    $updateResult = $mysqli->query($updateQuery);

    if ($updateResult) {
        // If the update is successful, redirect to index.php
        header("Location: index.php");
        exit;
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="global.css">
</head>
<body>
<nav class="navbar">
        <div class="logo">
            <h1>Indstrual Control</h1>
        </div>
        <div class="navbar-links">
            <a href="index.php">Home</a>
            <a href="#">Add New Product</a>
            <a href="help.html">Help</a>
            <a href="logout.php"><span class="material-symbols-outlined">logout</span></a>
        </div>
        <div class="burger-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    <h1>Edit</h1>
    
    
    <form action="edit.php" method="post">
        <label for="product_id">Product ID:</label>
        <input type="text" id="product_id" name="product_id" value="<?php echo $product_id; ?>" readonly><br>

        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo $product_name; ?>"><br>

        <label for="location_first">First Location:</label>
        <input type="text" id="location_first" name="location_first" value="<?php echo $location_first; ?>"><br>

        <label for="location_second">Second Location:</label>
        <input type="text" id="location_second" name="location_second" value="<?php echo $location_second; ?>"><br>

        <label for="creator_id">Creator ID:</label>
        <input type="text" id="creator_id" name="creator_id" value="<?php echo $creator_id; ?>" readonly><br>

        <input type="submit" value="Update" class="submit-button">

    </form>
</body>
</html>