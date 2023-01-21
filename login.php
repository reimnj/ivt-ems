<?php

ob_start();

require 'includes/dbconfig.php';

function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_POST['login_true'])) {

  $username = validate($_POST['username']);
  $password = validate($_POST['password']);
  $loginQuery = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $queryResult = mysqli_query($connection, $loginQuery);

  if(mysqli_num_rows($queryResult) === 1) {
  $row = mysqli_fetch_assoc($queryResult);
    if($row['username'] === $username && $row['password'] === $password) {
      $_SESSION["user"] = $username;
      header("location: dashboard.php");
      exit();
    } 
  } else {
    header('location: login.php?error=Invalid username/password!');
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/login.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <title>IVT</title>
</head>
<body>
    <main>
        <form action="" method="post">
          <div class="screen-1">
              <div class="logo">
                <img class="ivtLogo" src="Logo/logo.png">
              </div>
              <p style="text-align: center;">
                <?php
                  if(isset($_GET['error'])) {
                    echo $_GET['error'];
                  }
                ?>
              </p>
              <div class="email">
                <label for="email">Username</label>
                <div class="sec-2">
                  <ion-icon name="mail-outline"></ion-icon>
                  <input name="username" placeholder="Enter your username"/>
                </div>
              </div>
              <div class="password">
                <label for="password">Password</label>
                <div class="sec-2">
                  <ion-icon name="lock-closed-outline"></ion-icon>
                  <input class="pas" type="password" name="password" placeholder="············"/>
                  <ion-icon class="show-hide" name="eye-outline"></ion-icon>
                </div>
              </div>
              <input class="login" type="submit" name="login_true" value="Login">
              <div class="footer"><a href="register.php">Signup</a><a href="manage-pw.php">Forgot password?</a></div>
            </div>
        </form>
    </main>
</body>
</html>