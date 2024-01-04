<?php

include 'database.php';


$project_id = isset($_GET['id']) ? intval($_GET['id']) : 0; 

// Project information from database
$project_id = intval($project_id); 

$query = "SELECT project_id, project_name, project_creater_id, project_start_date, project_end_date FROM projects WHERE project_id = $project_id";
$result = $mysqli->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    if ($row) {
        $project_id = $row['project_id'];
        $project_name = $row['project_name'];
        $project_start_date = $row['project_start_date'];
        $project_end_date = $row['project_end_date'];
        $project_creater_id = $row['project_creater_id'];

    }
    $result->close();
}

// If the form has been submitted, update the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from form
    $project_id = intval($_POST['project_id']); 
    $project_name = $mysqli->real_escape_string($_POST['project_name']);
    $project_start_date = $_POST['project_start_date'];
    $project_end_date = $_POST['project_end_date']; 
    $project_creater_id = intval($_POST['project_creater_id']); 

    $updateQuery = "UPDATE projects SET project_name='$project_name', project_start_date='$project_start_date', project_end_date='$project_end_date' WHERE project_id='$project_id'";


    // Execute the query
    $updateResult = $mysqli->query($updateQuery);

    if ($updateResult) {
        // If the update is successful, redirect to index.php
        header("Location: index.php");
        exit;
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="global.css">
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
    <h1>Edit Project</h1>
    
    
<form action="edit_project.php" method="post">
    <label for="project_id">Project ID:</label>
    <input type="text" id="project_id" name="project_id" value="<?php echo htmlspecialchars($project_id); ?>" readonly><br>

    <label for="project_name">Project Name:</label>
    <input type="text" id="project_name" name="project_name" value="<?php echo htmlspecialchars($project_name); ?>"><br>

    <label for="startdate">Project Start Date</label>
    <input type="date" id="project_start_date" name="project_start_date" value="<?php echo htmlspecialchars($project_start_date); ?>"> 
       
    <label for="end_date">Project End Date</label>
    <input type="date" id="project_end_date" name="project_end_date" value="<?php echo htmlspecialchars($project_end_date); ?>"> 

    <input type="submit" value="Update" class="button">
    <input type="text" id="project_creater_id" name="project_creater_id" value="<?php echo htmlspecialchars($project_creater_id); ?>" readonly hidden><br>
</form>
    <script>
        function validateInput(input) {
            if (input.value < 0) {
                input.value = 0;
            }
        }
    </script>
</body>
</html>