<?php
session_start();

if(isset($_SESSION["user_id"])){
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

$tableresult = mysqli_query($mysqli, "SELECT * FROM `products`");

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
            <a href="#">Define Product</a>
            <a href="help.html">Help</a>
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
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td>
                        <!-- edit.php yi delete benzet!-->
                        <a href="edit.php?id=<?php echo $row['product_id']; ?>" class="material-symbols-outlined">edit</a>
                        <a href = "#"><span class="material-symbols-outlined">search</span></a>
                        <a href="delete_page.php?id=<?php echo $row["product_id"]; ?>&user_id=<?php echo $_SESSION["user_id"]; ?>"><span class="material-symbols-outlined">delete</span></a>
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