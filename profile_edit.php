<?php

ob_start();

require 'includes/dbconfig.php';

// Display Profile Details

$profileID = $_SESSION["user"];

$queryEID  = "SELECT * FROM users WHERE username = '$profileID'";
$getEmployeeID = mysqli_query($connection, $queryEID);
$userData = mysqli_fetch_assoc($getEmployeeID);

$employeeID = $userData['employeeID'];
$queryData = "SELECT * FROM employee WHERE employeeID = '$employeeID'";
$getEmployeeData = mysqli_query($connection, $queryData);
$employeeData = mysqli_fetch_assoc($getEmployeeData);

// Update Profile Details


if(isset($_POST['update'])) {

    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $bloodtype = $_POST['bloodtype'];
    $marital_status =  $_POST['marital_status'];
    $nationality = $_POST['nationality'];
    $departmentPosition = $_POST['position'];
    
    $updateQuery = "UPDATE employee SET age='$age', gender='$gender', contact_no='$contactNo', address='$address', birthdate='$birthdate', bloodtype='$bloodtype', marital_status='$marital_status', nationality='$nationality', position='$departmentPosition' WHERE employeeID = '$employeeID'";
    $setUpdate = mysqli_query($connection, $updateQuery);
    header("location:profile.php?update=success");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/profile.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>EMS Dashboard</title>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span>Invictus</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="dashboard.php"><span class="las la-igloo"></span>
                    <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="profile.php" class="active"><span class="las la-user"></span>
                    <span>Profile</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-users"></span>
                    <span>Employee</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-clipboard"></span>
                    <span>Admin</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-clipboard-check"></span>
                    <span>Manage Employee Leave</span></a>
                </li>
                <li>
                    <a href=""><span class="las la-arrow-alt-circle-down"></span>
                    <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div> 

    <div class="main-content">
        <header>
            <h2>
                <label for="">
                    <span class="las la-bars"></span>
                </label>

                Profile
            </h2>

            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Search here">
            </div>
            
            <div class="user-wrapper">
                <!-- IMG -->
                <div>
                    <h4><?php echo $employeeData['last_name']?>, <?php echo $employeeData['first_name']?></h4>
                    <small><?php echo $employeeData['position']?></small>
                </div>
            </div>
        </header>

        <main>
            <div class="profile-wrapper">
                <div class="profile-header">
                    <div class="profile-picture">
                        <img src="Logo/Ali.jpg" alt="">
                    </div>
                    <div class="profile-header-details">
                        <h2><?php echo $employeeData['last_name']?>, <?php echo $employeeData['first_name']?></h2>
                        <h3><?php echo $employeeData['department']?> Department</h3>
                        <h3><?php echo $employeeData['position']?></h3>
                        <a href="profile.php">Cancel Changes</a>
                    </div>
                </div>
                <hr>
                <h2>Personal Information <span style="font-size: 14px; color: var(--main-color);">(Edit Mode)</span></h2>
                <form action="" method="post">
                    <div class="profile-main-content">
                        <div>
                            <h4>Employee ID:</h4>
                            <input type="text" value="<?php echo $employeeData['employeeID']?>" >
                        </div>
                        <div>
                            <h4>Age:</h4>
                            <input type="text" name="age" value="<?php echo $employeeData['age']?>">
                        </div>
                        <div>
                            <h4>Gender:</h4>
                            <input type="text" name="gender" value="<?php echo $employeeData['gender']?>">
                        </div>
                        <div>
                            <h4>Contact No.:</h4>
                            <input type="text" name="contactNo" value="<?php echo $employeeData['contact_no']?>">
                        </div>
                        <div>
                            <h4>Address:</h4>
                            <input type="text" name="address" value="<?php echo $employeeData['address']?>">
                        </div>
                        <div>
                            <h4>Birthdate:</h4>
                            <input type="text" name="birthdate" value="<?php echo $employeeData['birthdate']?>">
                        </div>
                        <div>
                            <h4>Blood Type:</h4>
                            <input type="text" name="bloodtype" value="<?php echo $employeeData['bloodtype']?>">
                        </div>
                        <div>
                            <h4>Marital Status:</h4>
                            <input type="text" name="marital_status" value="<?php echo $employeeData['marital_status']?>">
                        </div>
                        <div>
                            <h4>Nationality:</h4>
                            <input type="text" name="nationality" value="<?php echo $employeeData['nationality']?>">
                        </div>
                        <div>
                            <h4>Department Position:</h4>
                            <input type="text" name="position" value="<?php echo $employeeData['position']?>">
                        </div>
                        <div>
                            <h4>Employment Status:</h4>
                            <input type="text" value="<?php echo $employeeData['employement_status']?>" disabled>
                        </div>
                        <div>
                            <h4>Action:</h4>
                            <input name="update" type="submit" value="Apply Changes / Update Profile">
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

    
</body>
</html>