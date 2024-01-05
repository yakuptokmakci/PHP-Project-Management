<?php
session_start();

if(isset($_SESSION["user_id"])){
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

$tableresult = mysqli_query($mysqli, "SELECT * FROM `operations`WHERE operation_owner = {$_SESSION["user_id"]}");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GridPage</title>
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
    <?php if (isset($user)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <td>Options</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if(!$tableresult){
                    die("something went wrong" . mysqli_error());
                } else {
                    while($row = mysqli_fetch_assoc($tableresult)){
                        ?>
                        <tr>
                            <td><?php echo $row['operation_id']; ?></td>
                            <td><?php echo $row['operation_name']; ?></td>
                            <td>
                                <a href="edit_operations.php?id=<?php echo $row['operation_id']; ?>" class="material-symbols-outlined">edit</a>
                                <a href="http://maps.google.com/maps?q=<?php echo urlencode($row['address']); ?>" target="_blank"><span class="material-symbols-outlined">pin_drop</span></a>
                                <a href="delete_operation.php?operation_id=<?php echo $row["operation_id"]; ?>&user_id=<?php echo $_SESSION["user_id"]; ?>"><span class="material-symbols-outlined">delete</span></a>
                                <a href="operation_details.php?id=<?php echo $row['operation_id']; ?>" class="material-symbols-outlined">loupe</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    <?php else: ?>
        <p><a href="login.php">to log in</a> or <a href="signup.htm">to sign up</a></p>
    <?php endif; ?>
 
    <div class="footer">
        <p>&copy; 2023 Indstrual Control</p>
        <div class="footer-links">
            <p>USER : <?= $user["name"] ?></p>
        </div>
    </div>

</body>
</html>
