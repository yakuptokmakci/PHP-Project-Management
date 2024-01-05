<?php
session_start();

// Ensure user is logged in and fetch user details if logged in
if(isset($_SESSION["user_id"])){
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    // Fetch operation details based on ID from URL
    if(isset($_GET['id'])) {
        $operationId = $_GET['id'];
        $operationSql = "SELECT * FROM operations WHERE operation_id = $operationId";
        $operationResult = $mysqli->query($operationSql);
        $operation = $operationResult->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="global.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
            <a href="create_operations_page.php">Define Operation</a>
            <a href="help.php">Help</a>
            <a href="logout.php"><span class="material-symbols-outlined">logout</span></a>
        </div>
        <div class="burger-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <?php if (isset($user) && isset($operation)): ?>
        <h2>Edit Operation: <?php echo $operation['operation_name']; ?></h2>
        <form method="POST" action="update_operation.php">
            <label for="operation_name">Operation Name:</label>
            <input type="text" id="operation_name" name="operation_name" value="<?php echo $operation['operation_name']; ?>">
            <!--
            <label  for="operation_owner">Operation Owner:</label>
            -->
            <input type="hidden" id="operation_owner" name="operation_owner" value="<?php echo $operation['operation_owner']; ?>">
            
            <label for="address" >Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $operation['address']; ?>">
            
            <input type="hidden" name="operation_id" value="<?php echo $operation['operation_id']; ?>">
            <input type="submit" value="Update Operation">
        </form>
    <?php else: ?>
        <p>Operation details not found or user not logged in.</p>
    <?php endif; ?>

 
</body>
</html>
