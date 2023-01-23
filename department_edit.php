<?php

ob_start();

date_default_timezone_set('Asia/Manila');

$date = date("Y-m-d");

$deptID = $_GET['dID'];

require 'includes/dbconfig.php';

// Retrieve Department Record

$deptQuery = "SELECT * FROM department WHERE departmentID = '$deptID'";
$deptExecuteQuery = mysqli_query($connection, $deptQuery);
$deptData = mysqli_fetch_assoc($deptExecuteQuery);

// Update Department Record

if(isset($_POST['update-dept'])) {

    $deptName = $_POST['deptName'];

    $query = "UPDATE department SET department_name='$deptName' WHERE departmentID='$deptID'";
    $executeQuery = mysqli_query($connection, $query);
    header("Location:department_edit.php?update=true&dID=$deptID");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/department.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <title>EMS Edit Department</title>
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
                    <a class="leave-show" href="employee_leave.php"><span class="las la-clipboard-check"></span>
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

                Notice
            </h2>
        </header>

        <main>
            <div class="notice-wrapper">
                <div class="notice-content">
                    <form action="" method="post">
                        <h2>Edit Department</h2>
                        <p>
                            <?php
                                if(isset($_GET['success'])) {
                                    echo "A new department has been successfully created!";
                                }
                                if(isset($_GET['update'])) {
                                    echo "The department has been updated successfully!";
                                }
                            ?>
                        </p>
                        <hr style="border: 2px solid var(--main-color); margin-bottom: 20px;">
                        <h3>Department ID</h3>
                        <input type="text" name="deptID" value="<?php echo $deptData['departmentID'];?>">
                        <h3>Department Name</h3>
                        <input type="text" name="deptName" value="<?php echo $deptData['department_name'];?>">
                        <div class="notice-footer">
                            <div>
                                <h4>Date Created</h4>
                                <input type="text" name="date" value="<?php echo $date?>" readonly>
                            </div>
                            <input type="submit" name="update-dept" value="Update Department">
                        </div>
                        
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        $('.dash-btn').toggleClass("active");

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