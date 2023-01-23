<?php

ob_start();

require 'includes/dbconfig.php';

// Display Profile Details

$lvID = $_GET['lvID'];

$editQuery = "SELECT * FROM employee_leave WHERE leaveID = '$lvID'";
$executeEditQuery = mysqli_query($connection, $editQuery);
$leaveData = mysqli_fetch_assoc($executeEditQuery);

// Update Profile Details

if(isset($_POST['update-leave'])) {

    $empID = $_POST['empID'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $reason = $_POST['reason'];
    $status = $_POST['status'];
    
    $updateQuery = "UPDATE employee_leave SET startDate='$startDate', endDate='$endDate', reason='$reason', status='$status'";
    $executeUpdate = mysqli_query($connection, $updateQuery);
    header("Location:employee_leave.php?status=success");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/leave.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <title>EMS New Leave Record</title>
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

                Edit Leave Record
            </h2>
        </header>

        <main>
            <div class="profile-wrapper">
                <form action="" method="post">
                <div class="profile-header">
                    <div class="profile-header-details">
                        <h2>Create New Leave Record</h2>
                        <a href="employee_leave.php">Cancel Changes</a>
                        <p>Status:</p>
                        <p style="color: var(--main-color);">
                        <?php 
                            if(isset($_GET['status'])) {
                                if($_GET['status'] == "success") {
                                    echo "New leave record has been successfully added!";
                                } 
                            }
                        ?>
                        </p>
                        <p>Employee ID</p>
                        <h2><input type="text" name="empID" value="<?php echo $leaveData['employeeID'];?>"></h2>
                        <p>Leave Start Date</p>
                        <h3><input type="date" name="startDate" value="<?php echo $leaveData['startDate'];?>"></h3>
                        <p>Leave End Date</p>
                        <h3><input type="date" name="endDate" value="<?php echo $leaveData['endDate'];?>"></h3>
                        <p>Reason</p>
                        <h3><input type="text" name="reason" value="<?php echo $leaveData['reason'];?>"></h3>
                        <p>Status</p>
                        <h3>
                            <select name="status" id="">
                                <option value="Accepted">Accepted</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </h3>
                        <input type="submit" name="update-leave" value="Update Leave Request">
                    </div>
                </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        $('.leave-show').toggleClass("active");

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