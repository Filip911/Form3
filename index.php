<?php
session_start();
  include('dbcon.php');

  $error = false;
  if(isset($_POST['btn-login'])){
    $email = trim($_POST['email']);
    $email = htmlspecialchars(strip_tags($email));

    $password = trim($_POST['password']);
    $password = htmlspecialchars(strip_tags($password));

    if(empty($email)){
      $error = true;
      $errorEmail = 'Please input email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $error = true;
      $errorEmail = 'Please enter a valid email address';
    }
    
    if(empty($password)){
      $error = true;
      $errorPass = 'Please enter password';
    } elseif(strlen($password) < 7){
      $error = true;
      $errorPass = 'Password at least 7 chars';
    } 
      
      if(!$error){
        $sql = "SELECT * FROM kupci1app WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])) {
          $_SESSION['name'] = $row['name'];
          header('location: home.php');
        }else{
          $errorMsg = 'Invalid Username or Password';
        }
      } 
      
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>PHP Login & Registration</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/cosmo/bootstrap.min.css">
  </head>
  <body>
      <div class="container">
        <div style="width: 500px; margin: 50px auto;">
          <form class="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
            <center><h2>Login</h2></center>
            <hr>
            <?php
              if(isset($errorMsg)){
            ?>      
              <div class="alert alert-danger">
              <span class="glyphicon glyphicon-info-sign"></span>
              <?php echo $errorMsg; ?>
              </div>
            <?php 
              }
            ?>
            <div class="form-group">
              <label for="email" class="control-group">Email</label>
              <input type="email" name="email" class="form-control" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorEmail)) echo $errorEmail; ?></span>
            </div>
            <div class="form-group">
              <label for="password" class="control-group">Password</label>
              <input type="password" name="password" class="form-control" autocomplete="off">
              <span class="text-danger"><?php if(isset($errorPass)) echo $errorPass; ?></span>
            </div>
            <div class="form-group">
              <center><input type="submit" name="btn-login" class="btn btn-primary" value="login"></center>
            </div>
            <hr>
            <a href="register.php">Register</a>
          </form>
        </div>
      </div>
  </body>
</html>
