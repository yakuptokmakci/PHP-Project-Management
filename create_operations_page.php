<?php
session_start();

// Database connection
$mysqli = require __DIR__ . "/database.php";

if (isset($_SESSION["user_id"])) {
    $address = "";
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

if (isset($_POST['btnsave'])) {
    $operationname = $_POST['operationname'];
    $projectnames = $_POST['project']; 
    $equipmentnames = $_POST['equipment'];
    $address = $_POST['address'];

    $query = "INSERT INTO operations (operation_name, operation_owner, address) 
              VALUES ('$operationname', '{$_SESSION["user_id"]}', '$address')";

    $sqlresult = $mysqli->query($query);
    if (!$sqlresult) {
        die("Something went wrong" . mysqli_error($mysqli));
    } else {
        $operationId = $mysqli->insert_id;

        foreach ($projectnames as $projectname) {
            $selectedprojectquery = "SELECT project_id FROM projects WHERE project_name = '$projectname'";
            $selectedprojectresult = mysqli_query($mysqli, $selectedprojectquery);
            $selectedprojectrow = mysqli_fetch_assoc($selectedprojectresult);
            $project_id = $selectedprojectrow['project_id'];

            $insertProjectQuery = "INSERT INTO operation_projects (operation_id, project_id) 
                                   VALUES ('$operationId', '$project_id')";
            $mysqli->query($insertProjectQuery);
        }

        foreach ($equipmentnames as $equipmentname) {
            $selectedequipmentquery = "SELECT product_id FROM products WHERE product_name = '$equipmentname'";
            $selectedequipmentresult = mysqli_query($mysqli, $selectedequipmentquery);
            $selectedequipmentrow = mysqli_fetch_assoc($selectedequipmentresult);
            $equipment_id = $selectedequipmentrow['product_id'];

            $insertEquipmentQuery = "INSERT INTO operation_products (operation_id, product_id) 
                                     VALUES ('$operationId', '$equipment_id')";
            $mysqli->query($insertEquipmentQuery);
        }

        header('Location: index.php');
    }
}

$dropdownresult = mysqli_query($mysqli, "SELECT * FROM projects WHERE project_creater_id = {$_SESSION["user_id"]}");
$dropdownequipment = mysqli_query($mysqli, "SELECT * FROM products WHERE product_owner_id = {$_SESSION["user_id"]}");
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
            <a href="create_operations_page.php">Define Operation</a>
            <a href="help.php">Help</a>
            <a href="logout.php"><span class="material-symbols-outlined">logout</span></a>
        </div>
        <div class="burger-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <form action="create_operations_page.php" method="post">
        <div>
            <label for="operationname">Operation Name</label>
            <input type="text" id="operationname" name="operationname">
        </div>
        <div>
            <label for="project">Select Project(s)</label>
            <select id="project" name="project[]" multiple>
                <?php while ($row = mysqli_fetch_assoc($dropdownresult)) { ?>
                    <option value="<?= $row["project_name"] ?>"><?= $row["project_name"] ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div>
            <label for="equipment">Select Equipment(s)</label>
            <select id="equipment" name="equipment[]" multiple>
                <?php while ($row = mysqli_fetch_assoc($dropdownequipment)) { ?>
                    <option value="<?= $row["product_name"] ?>"><?= $row["product_name"] ?> (<?= $row["amount"] ?>)</option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>"><br>
        </div>
        <button name="btnsave" style="margin-right: 25px;">Save</button>
    </form>

    <div class="footer">
        <p>&copy; 2023 Indstrual Control</p>
        <div class="footer-links">
            <p>USER : <?= $user["name"] ?></p>
        </div>
    </div>

    <script>
        function getdropdownelement() {
            var projectdropdown = document.getElementById("project");
            var value = projectdropdown.value;
            var textformat = projectdropdown.options[projectdropdown.selectedIndex].text;

            var xhr = new XMLHttpRequest();
            xhr.open("GET", "ajax_handler.php?textformat=" + encodeURIComponent(textformat), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var projectname = xhr.responseText;
                    console.log(projectname);
                }
            };
            xhr.send();
        }

        function getequipment() {
            var equipmentropdown = document.getElementById("project");
            var value = equipmentropdown.value;
            var textformat = equipmentropdown.options[equipmentropdown.selectedIndex].text;

            var xhr = new XMLHttpRequest();
            xhr.open("GET", "ajax_handler.php?textformat=" + encodeURIComponent(textformat), true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var equipmentname = xhr.responseText;
                    console.log(projectname);
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>
