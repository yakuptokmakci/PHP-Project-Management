<?php

$host="localhost";
$dbname="teodb";
$username="root";
$password="";

$mysqli = new mysqli($host,$username,$password,$dbname);

if($mysqli->connect_errno){
    die("Connetction error :" . $mysqli->connect_error);
}

return $mysqli;

?>