<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    if (isset($_GET['id'])) {
        $operationId = $_GET['id'];

        // Fetch operation details
        $operationSql = "SELECT * FROM operations WHERE operation_id = $operationId";
        $operationResult = $mysqli->query($operationSql);
        $operation = $operationResult->fetch_assoc();

        // Fetch associated projects for the operation
        $projectsSql = "SELECT projects.project_name FROM projects
                        INNER JOIN operation_projects ON projects.project_id = operation_projects.project_id
                        WHERE operation_projects.operation_id = $operationId";
        $projectsResult = $mysqli->query($projectsSql);
        $projects = $projectsResult->fetch_all(MYSQLI_ASSOC);

        // Fetch associated products for the operation
        $productsSql = "SELECT products.product_name FROM products
                        INNER JOIN operation_products ON products.product_id = operation_products.product_id
                        WHERE operation_products.operation_id = $operationId";
        $productsResult = $mysqli->query($productsSql);
        $products = $productsResult->fetch_all(MYSQLI_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Operation Details</title>
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
    <?php if (isset($operation)): ?>
        <h2>Operation Details: <?php echo $operation['operation_name']; ?></h2>
        <p><strong>Operation ID:</strong> <?php echo $operation['operation_id']; ?></p>
        <p><strong>Address:</strong> <?php echo $operation['address']; ?></p>
        
        <h3>Associated Projects:</h3>
        <ul>
            <?php foreach ($projects as $project): ?>
                <li><?php echo $project['project_name']; ?></li>
            <?php endforeach; ?>
        </ul>
        
        <h3>Associated Products:</h3>
        <ul>
            <?php foreach ($products as $product): ?>
                <li><?php echo $product['product_name']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Operation details not found or user not logged in.</p>
    <?php endif; ?>
</body>
</html>
