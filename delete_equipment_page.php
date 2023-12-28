<?php
session_start();
$mysqli = require __DIR__ . "/database.php";

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    error_log("DELETE operation started for product_id: $product_id");

    $query = "DELETE FROM products WHERE product_id = '$product_id'";

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
