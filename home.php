<?php
session_start(); 
if(!isset($_SESSION['name'])){
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP Login & Registration</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/cosmo/bootstrap.min.css">
  </head>
  <body>
      <div class="container">
      <a href="logout.php">Logout</a>
        <h1>WELCOME! <?php echo $_SESSION['name']; ?></h1>
      </div>
  </body>
</html>
