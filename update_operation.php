<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation_id'])) {
        $operationId = $_POST['operation_id'];
        $operationName = $_POST['operation_name'];
        $operationOwner = $_POST['operation_owner'];
        $address = $_POST['address'];

        // Update operation in the database
        $updateQuery = "UPDATE operations SET operation_name='$operationName', operation_owner=$operationOwner, address='$address' WHERE operation_id=$operationId";

        $result = $mysqli->query($updateQuery);

        if ($result) {
            // Redirect to the index.php after successful update
            header("Location: index.php");
            exit;
        } else {
            echo "Error updating record: " . $mysqli->error;
        }
    } else {
        echo "Invalid request";
    }
} else {
    echo "User not logged in";
}
?>
