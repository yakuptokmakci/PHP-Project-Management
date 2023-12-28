<?php
session_start();
$mysqli = require __DIR__ . "/database.php";

if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    error_log("DELETE operation started for project_id: $project_id");

    $query = "DELETE FROM projects WHERE project_id = '$project_id'";

    $result = mysqli_query($mysqli, $query);

    if (!$result) {
        die("SQL Error: " . mysqli_error($mysqli));
       // die("this project is already exist from a diffrent user");
    } else {
        error_log("DELETE operation successful for project_id: $project_id");
        echo "Delete successful!";
    }
} else {
    die("Error: project_id parameter is missing.");
}
?>
