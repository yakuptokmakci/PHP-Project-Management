<?php

$host="localhost";
$dbname="GROUP3";
$username="abc";
$password="abc";

$mysqli = new mysqli($host,$username,$password,$dbname);

if($mysqli->connect_errno){
    die("Connetction error :" . $mysqli->connect_error);
}

return $mysqli;

?>