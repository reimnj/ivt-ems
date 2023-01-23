<?php

ob_start();

require 'includes/dbconfig.php';

// Display Profile Details

$admID = $_GET['admID'];

$query = "SELECT * FROM users WHERE loginID = '$admID'";
$queryRun = mysqli_query($connection, $query);
$adminData = mysqli_fetch_assoc($queryRun);

// Update Profile Details

if(isset($_POST['update-admin'])) {

    $firstName = $_POST['firstname'];
    $middleInitial = $_POST['middle_initial'];
    $lastName = $_POST['lastname'];
    $departmentHead = $_POST['departmentHead'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordRep = $_POST['password-rep'];

    if($password != $passwordRep) {

        header("Location:admin_edit.php?admID=$admID&status=failed");

    } else {

        if($password == $adminData['password']) {
            header("Location:admin_edit.php?admID=$admID&status=repfailed");
        } else {

            $addQuery = "UPDATE users SET username='$username', password='$password', first_name='$firstName', middle_initial='$middleInitial', last_name='$lastName', deptPosition='$departmentHead'";

            $executeQuery = mysqli_query($connection, $addQuery);
            header("location:admin_manage.php?status=success");
            exit();
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/admin.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <title>EMS Admin</title>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span>Invictus</span></h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="dashboard.php" class="dash-btn"><span class="las la-igloo"></span>
                    <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="profile.php" class="prof-btn"><span class="las la-user"></span>
                    <span>Profiles</span></a>
                </li>
                <li>
                    <a href="#" class="feat-btn"><span class="las la-users"></span>
                    <span>Employee</span></a>
                    <ul class="feat-show">
                        <li><a href="employee.php">Add New Employee</a></li>
                        <li><a href="employee_manage.php">Manage Employee</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="serv-btn"><span class="las la-clipboard"></span>
                    <span>Admin</span></a>
                    <ul class="serv-show">
                        <li><a href="admin.php">Add New Admin</a></li>
                        <li><a href="admin_manage.php">Manage Admin</a></li>
                    </ul>
                </li>
                <li>
                    <a href="employee_leave.php"><span class="las la-clipboard-check"></span>
                    <span>Manage Employee Leave</span></a>
                </li>
                <li>
                    <a href="logout.php"><span class="las la-arrow-alt-circle-down"></span>
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

                Admin
            </h2>
        </header>

        <main>
            <div class="profile-wrapper">
                <form action="" method="post">
                <div class="profile-header">
                    <div class="profile-header-details">
                        <h2>Edit administrator details</h2>
                        <a href="admin_manage.php">Cancel changes</a>
                        <p>Status:</p>
                        <p style="color: var(--main-color);">
                        <?php 
                            if(isset($_GET['status'])) {
                                if($_GET['status'] == "success") {
                                    echo "Admin has been successfully updated!";
                                } else if($_GET['status'] == "repfailed") {
                                    echo "Your password matches with your old one!";
                                } else {
                                    echo "Passwords do not match!";
                                }
                            }
                        ?>
                        </p>
                        <p>Name</p>
                        <h2><input type="text" name="lastname" value="<?php echo $adminData['last_name'];?>"> <input type="text" name="firstname" value="<?php echo $adminData['first_name'];?>"> <input type="text" name="middle_initial" value="<?php echo $adminData['middle_initial'];?>"></h2>
                        <p>Department & Position</p>
                        <h3><input type="text" name="departmentHead" value="<?php echo $adminData['deptPosition'];?>"></h3>
                        <p>Username</p>
                        <h3><input type="text" name="username" value="<?php echo $adminData['username'];?>"></h3>
                        <p>New Password</p>
                        <h3><input type="password" name="password"></h3>
                        <p>Confirm Password</p>
                        <h3><input type="password" name="password-rep"></h3>
                        <input type="submit" name="update-admin" value="Create new account">
                    </div>
                </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        $('.serv-btn').toggleClass("active");
        $('.sidebar-menu ul .serv-show').toggleClass("show");


        $('.feat-btn').click(function(){
            $('.feat-btn').toggleClass("active");
            $('.sidebar-menu ul .feat-show').toggleClass("show");
        });

        $('.serv-btn').click(function(){
            $('.sidebar-menu ul .serv-show').toggleClass("show");
            $('.serv-btn').toggleClass("active");
        });
    </script>
</body>
</html>