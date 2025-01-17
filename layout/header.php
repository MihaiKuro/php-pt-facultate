<?php
    session_start();
    $authenticated = false;
    if(isset($_SESSION['email'])){
        $authenticated = true;
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ceva WANNABE</title>
    <link rel="icon" href="images\logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">

  <div class="container">
    <a class="navbar-brand" href="index.php">
        <img src="images\logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
        ceva WANNABE
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item">
            <a class="nav-link text-dark" href="index.php">Home</a>
            </li>
            
            </li>
        </ul>  
    <?php 
    if($authenticated) {
            ?>
            <ul class="navbar-nav"> 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profile.php"> Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                    </ul>
                </li>
            </ul>
        <?php } 
        else {  ?>
     <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-dark" href="login.php">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="register.php">Register</a>
        </li>
     </ul>
    <?php } ?>
    </div>
  </div>

</nav>