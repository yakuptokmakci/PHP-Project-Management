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
            <a href="create_project_page.php user_id=<?php echo $_SESSION["user_id"]; ?>">Create New Project</a> 
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
    <form action="process-signup.php" method="post" novalidate>
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label for="email">e-mail</label>
        <input type="text" id="email" name="email">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
    </div>
    <div>
        <label for="password_confirmation">Repeat Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation">
    </div>
    <button style="margin-right: 25px;">Sign Up</button>
    <a href="login.php">Already have an account ? <b>Log in</b></a>
    </form>

    <div class="footer">
        <p>&copy; 2023 Indstrual Control</p>
        <div class="footer-links">
            <p>USER : <?= $user["name"] ?></p>
        </div>
    </div>

</body>
</html>