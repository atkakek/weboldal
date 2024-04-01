<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../client/css/main.css">
    <script src="getData.js"></script>
    <title>dolgozat</title>
</head>
<body>

<nav class="navbar bg-dark navbar-expand-lg navbar-dark-color mb-5 sticky-top">
  <div class="container-fluid">
    <div class="collapse navbar-collapse row">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-center">
        <li class="nav-item">
          <a class="nav-link active text-light" href="main.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="main.php?page=favorites.php">Favorites</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="main.php?page=login.php">LogIn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="main.php?page=logout.php">Log out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="row p-3 justify-content-center">    
      <?php
      if (isset($_GET['page'])) {
          include $_GET['page'];
      } else
          include("home.php");
      ?>
    </div>

    

   
</body>
</html>