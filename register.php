<?php
include_once('dbcon.php');
  $error = false;  

  if(isset($_POST['btn-register'])) {
    // Clean user put to prevent SQL Incjection
    $username = $_POST['username'];
    $username = strip_tags($username);
    $username = htmlspecialchars($username);

    $email = $_POST['email'];
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $password = $_POST['password'];
    $password = strip_tags($password);
    $password = htmlspecialchars($password);

    // Validate
  if(empty($username))  {
    $error = true;
    $errorUsername = 'Please input username';
  } 

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = true;
    $errorEmail = 'Please input a valid Email address';
  }

  if(empty($password)){
    $error = true;
    $errorPass = 'Please input password';
  } elseif(strlen($password) < 7) {
    $error = true;
    $errorPass = 'Password must at least 7 chars';  
  }

  // Encrypt password with md5
  //$password = md5($password);

  // Encrypt password hashing method (new)
  $password = $_POST['password'];
  $hash = password_hash($password, PASSWORD_DEFAULT);
 
  


  //$passwordHash = password_hash($password, PASSWORD_DEFAULT);
  
  // Insert data if no error
  if(!$error) {
    $sql = "insert into kupci1app(name, email, password)
      values('$username', '$email', '$hash')";
    if(mysqli_query($conn, $sql)) {
      $successMsg = 'Register successfully. click here to login <a href="home.php">Click here to login</a>';
    }  else {
      echo 'Error '.mysqli_error($conn);
    }

  }

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
        <div style="width: 500px; margin: 50px auto;">
          <form class="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
            <center><h2>Register</h2></center>
            <hr>
            <?php 
              if(isset($successMsg)){
            ?>
                <div class="alert alert-success">
                  <span class="glyphicon glyphicon-info-sign"></span>
                  <?php echo $successMsg; ?>
                </div>
            <?php
              }
            ?>
            <div class="form-group">
              <label for="username" class="control-label">Username</label>
              <input type="text" name="username" class="form-control">
              <span class="text-danger"><?php if(isset($errorUsername)) echo $errorUsername; ?></span>
            </div>
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
              <center><input type="submit" name="btn-register" class="btn btn-primary" value="Register"></center>
            </div>
            <hr>
            <a href="index.php">Login</a>
          </form>
        </div>
      </div>
  </body>
</html>
