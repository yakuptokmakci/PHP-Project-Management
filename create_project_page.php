<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
$tableresult = mysqli_query($mysqli, "SELECT * FROM `projects` WHERE project_creater_id = {$_SESSION["user_id"]}");
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

    if (isset($_POST['btnsave'])) {
        $projectname = $_POST['projectname'];
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        $mysqli = require __DIR__ . "/database.php";

        $query = "INSERT INTO projects (project_name, project_creater_id, project_start_date, project_end_date)
            SELECT '$projectname', '{$_SESSION["user_id"]}', '$startdate', '$enddate'
            FROM DUAL
            WHERE NOT EXISTS (
                SELECT project_name 
                FROM projects 
                WHERE project_name = '$projectname'
            ) LIMIT 1";

        $sqlresult = $mysqli->query($query);
        if (!$sqlresult) {
            die("something went wrong" . mysqli_error());
        } else {
            header('Location: index.php');
        }
    }

    ?>

    <form action="create_project_page.php" method="post">
        <div>
            <label for="projectname">Project Name</label>
            <input type="text" id="projectname" name="projectname">
        </div>
        <div>
            <label for="startdate">Project Start Date</label>
            <input type="date" id="startdate" name="startdate">
        </div>
        <div>
            <label for="enddate">Project End Date</label>
            <input type="date" id="enddate" name="enddate">
        </div>
        <div>
            <label for="stillgoing">Project Has Not Done Yet </label>
            <input type="checkbox" id="stillgoing" name="stillgoing" onclick="visibledate()">
        </div>
        <button name="btnsave" style="margin-right: 25px;">Save</button>
    </form>
    <script>
        function visibledate() {
            var checkbox = document.getElementById("stillgoing");
            var enddate = document.getElementById("enddate");

            if (checkbox.checked == true) {
                enddate.style.visibility = "hidden";
            } else {
                enddate.style.visibility = "visible";
            }
        }
    </script>
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
                            <td><?php echo $row['project_id']; ?></td>
                            <td><?php echo $row['project_name']; ?></td>
                            <td>
                                <a href="edit_project.php?id=<?php echo $row['project_id']; ?>" class="material-symbols-outlined">edit</a>
                                <a href="delete_project_page.php?project_id=<?php echo $row["project_id"]; ?>"><span class="material-symbols-outlined">delete</span></a>
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
</body>

</html>
