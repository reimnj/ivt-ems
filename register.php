<?php

ob_start();

require 'includes/dbconfig.php'; // you can remove this line of code and put the database connection inside this very php code!

// create a database named 'ivt_ems'
// create a user table to store the inputs
// be sure that you're connected to the database
// query them in the indicated if-condition (code it inside the indicated condition below)
// goodluck!!

if(isset($_POST['register'])) {

    if($_POST['email'] === $_POST['email-repeat'] && $_POST['password'] === $_POST['password-repeat']) {

        if($_POST['admincode'] === "1245aa4e300z33") { // admincode 
            // do the register code here.
            header('location:register.php?success=true'); // if 'true' is displayed then this condition is guaranteed working.
        } else {
            header('location:register.php?error=Invalid admin code!');
        }

    } else {
        header('location:register.php?error=Your email/password does not match!');
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/registration.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <title>IVT Registration</title>
</head>
<body>
    <div class="body wrapper">
        <form action="" method="post">
            <div class="form f-body">
                <div class="form-header">
                    <img src="Logo/logo.png" alt="">
                    <p>Register EMS Account</p>
                    <p class="error">
                        <?php
                            if(isset($_GET['error'])) {
                                echo $_GET['error'];
                            }
                        ?>
                    </p>
                    <p class="success">
                        <?php
                            if(isset($_GET['success'])) {
                                echo $_GET['success'];
                            }
                        ?>
                    </p>
                </div>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter a valid email address">
                <label for="email-repeat">Confirm Email</label>
                <input type="email" name="email-repeat" placeholder="Re-enter your email address" >
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter your password">
                <label for="password-repeat">Confirm your password</label>
                <input type="password" name="password-repeat" placeholder="Re-enter your password">
                <label for="admincode">Adminstrator Code</label>
                <input type="text" name="admincode" placeholder="Administrator Access Code">
                <input type="submit" value="Register" name="register">
                <div class="form-nav">
                    <a href="login.php">Go back to login?</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>