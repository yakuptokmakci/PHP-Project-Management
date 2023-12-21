<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

$dropdownresult = mysqli_query($mysqli, "SELECT * FROM `projects`");
$dropdownequipment = mysqli_query($mysqli, "SELECT * FROM `products`");
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

    <?php
    $mysqli = require __DIR__ . "/database.php";
    if (isset($_POST['btnsave'])) {
        $operationname = $_POST['operationname'];
        $projectname = $_POST['project']; 
        $equipmentname =$_POST['equipment'];

        $selectedprojectquery = "SELECT project_id FROM projects WHERE project_name = '$projectname'";
        $selectedprojectresult = mysqli_query($mysqli, $selectedprojectquery);
        $selectedprojectrow = mysqli_fetch_assoc($selectedprojectresult);
        $operation_project_id = $selectedprojectrow['project_id'];

        $query = "INSERT INTO `operations` (`operation_name`, `operation_project_id`, `operation_equipment_name`, `operation_owner`) VALUES ('$operationname', '$operation_project_id', '$equipmentname', '{$_SESSION["user_id"]}')";

        $sqlresult = $mysqli->query($query);
        if (!$sqlresult) {
            die("something went wrong" . mysqli_error($mysqli));
        } else {
            die("New Operation Added");
        }
    }
    ?>

    <form action="create_operations_page.php" method="post">
        <div>
            <label for="operationname">Operation Name</label>
            <input type="text" id="operationname" name="operationname">
        </div>
        <div>
            <label for="project">Select a Project</label>
            <select id="project" name="project" onchange="getdropdownelement()">
                <?php
                while ($row = mysqli_fetch_assoc($dropdownresult)) {
                    echo "<option value='{$row["project_name"]}'>{$row["project_name"]}</option>";
                }
                ?>
            </select>
        </div>
        
        <div>
            <label for="equipment">Select an equipment</label>
            <select id="equipment" name="equipment" onchange="getdropdownelement()">
                <?php
                while ($row = mysqli_fetch_assoc($dropdownequipment)) {
                    echo "<option value='{$row["product_name"]}'>{$row["product_name"]}</option>";
                }
                ?>
            </select>
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
