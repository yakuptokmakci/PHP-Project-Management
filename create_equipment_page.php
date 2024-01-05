<?php
session_start();

if(isset($_SESSION["user_id"])){
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
$tableresult = mysqli_query($mysqli, "SELECT * FROM `products` WHERE product_owner_id = {$_SESSION["user_id"]}");
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
        <a href="create_project_page.php?user_id=<?php echo $_SESSION["user_id"]; ?>">Create New Project</a>
        <a href="create_equipment_page.php?user_id=<?php echo $_SESSION["user_id"]; ?>">Define Equipment</a>
        <a href="create_operations_page.php?user_id=<?php echo $_SESSION["user_id"]; ?>">Define Operation</a>
        <a href="help.php">Help</a>
        <a href="logout.php"><span class="material-symbols-outlined">logout</span></a>
    </div>
    <div class="burger-menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>

    <?php
    
    if(isset($_POST['btnsave'])){
        $productname = $_POST['productname'];
        $amount = $_POST['amount'];
        $mysqli = require __DIR__ . "/database.php";
        $address = $_POST['address'];

        $query = "INSERT INTO products (product_name, amount, product_owner_id, address) 
          SELECT * FROM (SELECT '$productname', '$amount', '{$_SESSION["user_id"]}','$address') AS tmp
          WHERE NOT EXISTS (
              SELECT product_name FROM products 
              WHERE product_name = '$productname' AND amount = '$amount'
          ) LIMIT 1";



        $sqlresult= $mysqli->query($query);
        if(!$sqlresult){
            die("something went wrong".mysqli_error());
        }else{
            header('Location: index.php');
        }

    }
    
    ?>

    <form action="create_equipment_page.php" method="post">
    <div>
        <label for="productname">Equipment Name</label>
        <input type="text" id="productname" name="productname">
    </div>
    <div>
        <label for="amount">Amount of Equipment or(set):</label>
        <input type="number" id="amount" name="amount" oninput="validateInput(this)" >
    </div>
    <div>
        <label for="address">Address</label>
        <input type="text" id="address" name="address">
    </div>
    <button name="btnsave" style="margin-right: 25px;">Save</button>
    </form>
    <?php if (isset($user)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Project-Name</th>
                    <td>Options</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!$tableresult) {
                    die("something went wrong" . mysqli_error());
                } else {
                    while ($row = mysqli_fetch_assoc($tableresult)) {
                        ?>
                        <tr>
                            <td><?php echo $row['product_id']; ?></td>
                            <td><?php echo $row['product_name'];?>
                            <?php echo $row['amount'];?></td>
                            <td>
                                <a href="edit_equipment.php?id=<?php echo $row['product_id']; ?>&user_id=<?php echo $_SESSION["user_id"]; ?>" class="material-symbols-outlined">edit</a>
                                <a href="http://maps.google.com/maps?q=<?php echo urlencode($row['address']); ?>" target="_blank"><span class="material-symbols-outlined">pin_drop</span></a>
                                <a href="delete_equipment_page.php?product_id=<?php echo $row["product_id"]; ?>"><span class="material-symbols-outlined">delete</span></a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    <?php endif; ?>
    <div class="footer">
        <p>&copy; 2023 Indstrual Control</p>
        <div class="footer-links">
            <p>USER : <?= $user["name"] ?></p>
        </div>
    </div>
    <script>
        function validateInput(input) {
            if (input.value < 0) {
                input.value = 0;
            }
        }
    </script>
</body>
</html>