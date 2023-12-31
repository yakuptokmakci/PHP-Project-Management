<?php

include 'database.php';


$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0; 

// Product information from database
$product_id = intval($product_id); 

$query = "SELECT product_id, product_name, address, product_owner_id FROM products WHERE product_id = $product_id";
$result = $mysqli->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    if ($row) {
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $address = $row['address'];
        $product_owner_id = $row['product_owner_id'];
    }
    $result->close();
}

// If the form has been submitted, update the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from form
    $product_id = intval($_POST['product_id']); 
    $product_name = $mysqli->real_escape_string($_POST['product_name']);
    $address = $mysqli->real_escape_string($_POST['address']);  
    $product_owner_id = intval($_POST['product_owner_id']); 
    $amount = $_POST['amount'];

    $updateQuery = "UPDATE products SET product_name='$product_name', amount='$amount', address='$address' WHERE product_id='$product_id'";


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
        <a href="create_project_page.php?user_id=<?php echo $_SESSION["user_id"]; ?>">Create New Project</a>
        <a href="create_equipment_page.php?user_id=<?php echo $_SESSION["user_id"]; ?>">Define Equipment</a>
        <a href="create_operations_page.php?user_id=<?php echo $_SESSION["user_id"]; ?>">Define Operation</a>
        <a href="help.php">Help</a>
        <a href="logout.php"><span class="material-symbols-outlined">logout</span></a>
    </div>
    <div class="burger-menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>
    <h1>Edit</h1>
    
    
<form action="edit_equipment.php" method="post">
    <label for="product_id">Product ID:</label>
    <input type="text" id="product_id" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>" readonly><br>

    <label for="product_name">Product Name:</label>
    <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product_name); ?>"><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>"><br>

    <label for="amount">Amount of Equipment or(set):</label>
    <input type="number" id="amount" name="amount" oninput="validateInput(this)" >

    <input type="submit" value="Update" class="button">
    <input type="text" id="product_owner_id" name="product_owner_id" value="<?php echo htmlspecialchars($product_owner_id); ?>" readonly hidden><br>
</form>
    <script>
        function validateInput(input) {
            if (input.value < 0) {
                input.value = 0;
            }
        }
    </script>
</body>
</html>