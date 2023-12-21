<?php
session_start();

if(isset($_SESSION["user_id"])){
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="global.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Create Project</title>
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

    <?php
    
    if(isset($_POST['btnsave'])){
        $productname = $_POST['productname'];
        $mysqli = require __DIR__ . "/database.php";

        $query = "INSERT INTO products (product_name)
        SELECT * FROM (SELECT '$productname') AS tmp
        WHERE NOT EXISTS (
            SELECT product_name FROM products WHERE product_name = '$productname'
        ) LIMIT 1";

        $sqlresult= $mysqli->query($query);
        if(!$sqlresult){
            die("something went wrong".mysqli_error());
        }else{
            die("New product Added");
        }

    }
    
    ?>

    <form action="create_equipment_page.php" method="post">
    <div>
        <label for="productname">Product Name</label>
        <input type="text" id="productname" name="productname">
    </div>
    <button name="btnsave" style="margin-right: 25px;">Save</button>
    </form>

    <div class="footer">
        <p>&copy; 2023 Indstrual Control</p>
        <div class="footer-links">
            <p>USER : <?= $user["name"] ?></p>
        </div>
    </div>
</body>
</html>