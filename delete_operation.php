<?php
session_start();
$mysqli = require __DIR__ . "/database.php";

if (isset($_GET['operation_id'])) {
    $operation_id = $_GET['operation_id'];

    error_log("DELETE operation started for product_id: $product_id");

    $query = "DELETE FROM operations WHERE operation_id = '$operation_id'";

    $result = mysqli_query($mysqli, $query);

    if (!$result) {
        die("SQL Error: " . mysqli_error($mysqli));
    } else {
        error_log("DELETE operation successful for product_id: $product_id");

        echo "Delete successful!";
    }
} else {
    die("Error: product_id parameter is missing.");
}
?>
