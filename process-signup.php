<?php
// if this areas is empty in this array we got this errors
if(empty($_POST["name"])){
    die("Name is Required");
}

// filetering funtionb for valid e-mail
if(! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("Valid email is required");
}

if(strlen($_POST["password"])<8){
    die("Password Must be 8 charachter long");
}
// password needs at least one letter
if(! preg_match("/[a-z]/i",$_POST["password"])){
    die("password must contain at least one letter");
}
// password needs to contain one number
if(! preg_match("/[0-9]/",$_POST["password"])){
    die("password must contain at least one number");
}
 
if($_POST["password"] !== $_POST["password_confirmation"]){
    die("Passwords Must Match");
}
// encripyt the password
$password_hash = password_hash($_POST["password"],PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

// id is auto ıncremented we dont need to send 
$sql = "INSERT INTO user (name,email,password_hash)
VALUES (?,?,?)"; //place holders

$stmt = $mysqli->stmt_init();

// checking for sql errors
if(!$stmt->prepare($sql)){
    die("SQL erro:".$mysqli->error);
}
// all 3 charachters must be string 
$stmt->bind_param("sss",$_POST["name"],
$_POST["email"],$password_hash);

if($stmt->execute()){
    header("Location: signup-success.htm");
    exit;
    // eğer success olursak post redirect ile başka bir sayfaya yönlendirme yapacağız 
}
else{
    // speacial erro code for duplicate varaible 
    if($mysqli->errno === 1062){
        die("this email adress is already taken");
    }
    die($mysqli->error ." ".$mysqli->errno);
}



?>