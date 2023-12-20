<?php
    $is_invalid = false;
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $mysqli = require __DIR__ . "/database.php";

        // check email and password is matching a record
        $sql = sprintf("SELECT * FROM user
        WHERE email = '%s'",$_POST["email"]); // got email from post array

        $result = $mysqli->query($sql); // returns the querys result

      $user = $result->fetch_assoc(); // assign a dummy varaible

      if($user){
        if(password_verify($_POST["password"],$user["password_hash"])){
            session_start(); // to save the user id
            $_SESSION["user_id"] = $user["id"]; //session makes the user_id super global for reach
            session_regenerate_id();
            header("Location: index.php"); // redirect the index page 
            exit;
        }
      }
      // if the info from the forms is wrong we are in this situation
      $is_invalid=true;

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="global.css">
</head>
<body>
    <h1>Login</h1>
    <?php if($is_invalid): ?>
        <script>
            alert("Wrong Password or Wrong Email Adress !!!");
        </script>
    <?php endif; ?>
    <form method="post" >
    <div>
        <label for="email">e-mail</label>
        <input type="text" id="email" name="email">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
    </div>
    <button style="margin-right: 25px;">Log in</button>
    <a href="signup.htm">Don't have an account? Sign up <b>Sign Up</b></a>
    </form>
</body>
</html>