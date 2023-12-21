<?php
session_start();

if(isset($_SESSION["user_id"])){
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

$tableresult = mysqli_query($mysqli, "SELECT * FROM `products`");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About</title>
  <!-- Google Fonts -->
  <link rel="stylesheet" type="text/css" href="global.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
  
  <!-- start about section  -->
  <section id="About" class="about">
    <div class="container">
      <div>
        <h2>About</h2>
      </div>
      <div class="div-about">
        <div class="">
         
          <h3>Welcome to Equipment Project</h3>
          <p><i>Your go-to software Equipment app! Founded in 2023.</i></p>
         
          <h3>Our Mission</h3>
          <p><i>Helping clients to arrange their equipments easily and user-friendly.</i></p>
         
          <h3>Our Approach</h3>
          <p><i>Creating equipment system that are functional, aesthetically pleasing, and user-friendly.</i></p>
         
          <h3>Why Choose Our Program</h3>
          <p><i>We offer easy-to-use, excellent and smooth equipment arrange service. Thank You for Considering Our Service! We look forward to working with you!</i></p>
         
        </div>
       
      </div>
    </div>
  </section>
  <!-- end about section  -->


  <section id="Howtouse" class="how-to-use">
    <div class="container">
      <div>
        <h2>How to Use</h2>
      </div>


    <div class="how-to-use-container"> 
        <img src="assets/1.png" alt="How to Use Image" class="how-to-use-image">
        <div class="how-to-use-text">
          <h1>1. </h1>
            <p>You can display registered equipments. You can edit, review and delete your registered equipments as you wish.</p>
        </div>
    </div>

    <div class="how-to-use-container"> 
        <img src="assets/2.png" alt="How to Use Image" class="how-to-use-image">
        <div class="how-to-use-text">
            <h1>2. </h1>
            <p>You can edit your registered equipment as you wish by pressing the 'Pencil' icon. You can then save the changes by pressing the 'Update' button.</p>
        </div>
    </div>

      
    </div>
  </section>


  <!-- start contact section  -->
  <section id="contact">
    <div class="container">
      <div >
        <h2>Contact</h2>
        <p class="contact-text">Thank you for visiting our website! We value your interest in our services and would be delighted to assist you in any way possible. Whether you have a question, need support, or simply want to share your thoughts, we're here to listen.</p>
      </div>

      <div class="row-class">
        <div class="">
          <div class="info-box">
            <i class=""></i>
            <h3>Location</h3>
            <p>Istanbul, Turkey</p>
          </div>
        </div>
        <div>
          <div class="info-box">
            <i class="bx bx-envelope"></i>
            <h3>Email</h3>
            <p>test@gmail.com</p>
          </div>
        </div>
        <div class="col-lg-3 mb-4">
          <div class="info-box">
            <i class="bx bx-phone-call"></i>
            <h3>Meeting</h3>
            <a href="https://calendly.com/guneyberkayates/30min">Schedule a Meeting</a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="">
          <iframe class="" src="https://www.openstreetmap.org/export/embed.html?bbox=28.9500904083252%2C41.01183525191072%2C29.064245223999027%2C41.071069130806414&amp;layer=mapnik" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>

        </div>
      </div>
    </div>
  </section>
  <!-- end contact section  -->

</body>

</html>