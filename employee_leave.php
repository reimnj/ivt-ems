<?php

ob_start();

require 'includes/dbconfig.php';

// Leave Stats

$leaveQuery = "SELECT COUNT(leaveID) AS leaveCount from employee_leave";
$executeLeaveQuery = mysqli_query($connection, $leaveQuery);
$leaveStat = mysqli_fetch_assoc($executeLeaveQuery);

$acceptQuery = "SELECT COUNT(status) AS acceptCount from employee_leave WHERE status = 'Accepted'";
$executeAcceptQuery = mysqli_query($connection, $acceptQuery);
$acceptStat = mysqli_fetch_assoc($executeAcceptQuery);

$rejectQuery = "SELECT COUNT(status) AS rejectCount from employee_leave WHERE status = 'Rejected'";
$executeRejectQuery = mysqli_query($connection, $rejectQuery);
$rejectStat = mysqli_fetch_assoc($executeRejectQuery);

$pendingQuery = "SELECT COUNT(status) AS pendingCount from employee_leave WHERE status = 'Pending'";
$executePendingQuery = mysqli_query($connection, $pendingQuery);
$pendingStat = mysqli_fetch_assoc($executePendingQuery);

// Retrieve Employee Leave Data

$query = "SELECT * FROM employee_leave";
$executeQuery = mysqli_query($connection, $query);

// Create Employee Leave

// Delete Employee Leave Data

if(isset($_GET['lvID'])) {

    $lvID = $_GET['lvID'];
    $delQuery = "DELETE FROM employee_leave WHERE leaveID = '$lvID'";
    $executeDelQuery = mysqli_query($connection, $delQuery);
    header("Location:employee_leave.php?del=success");
    exit(0);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/leave.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <title>EMS Manage Leave</title>
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

                Manage Employee Leave
            </h2>
        </header>

        <main>
            <div class="admin-table">
                <table>
                    <tr class="head">
                        <th>Leave ID</th>
                        <th>Employee ID</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        if(mysqli_num_rows($executeQuery) > 0) {
                            foreach($executeQuery as $leaveData) {
                                ?>
                                <tr class="body">
                                    <td><?php echo $leaveData['leaveID'];?></td>
                                    <td><?php echo $leaveData['employeeID'];?></td>
                                    <td><?php echo $leaveData['startDate'];?></td>
                                    <td><?php echo $leaveData['endDate'];?></td>
                                    <td><?php echo $leaveData['reason'];?></td>
                                    <td><?php echo $leaveData['status'];?></td>
                                    <td class="action">
                                        <button><a href="employee_leave_edit.php?lvID=<?=$leaveData['leaveID'];?>"><span class="las la-edit la-2x"></span></a></button>
                                        <button><a href="employee_leave.php?lvID=<?=$leaveData['leaveID'];?>"><span class="las la-trash la-2x"></span></a></button>
                                    </td>
                                </tr>             
                                <?php
                            }
                        } else {
                            echo "<td>-</td>" . "<td>-</td>" . "<td>-</td>" . "<td>-</td>" . "<td>-</td>" . "<td>-</td>" . "<td>-</td>";
                        }
                    ?> 
                </table>
            </div>
            <div class="leave-stats">
                <table>
                    <tr>
                        <th>Applied Leaves</th> <td><?php echo $leaveStat['leaveCount']; ?></td>
                    </tr>
                    <tr>
                        <th>Total Accepted</th> <td><?php echo $acceptStat['acceptCount']; ?></td>
                    </tr>
                    <tr>
                        <th>Total Rejected</th> <td><?php echo $rejectStat['rejectCount']; ?></td>
                    </tr>
                    <tr>
                        <th>Total Pending</th> <td><?php echo $pendingStat['pendingCount']; ?></td>
                    </tr>
                </table>
                <div class="leave-action">
                    <a href="employee_leave_add.php"><span class="las la-plus-square la-2x"></span>Create a New Leave</a>
                </div>
                <p style="text-align: center; margin-top: 20px;">
                    <?php
                        if(isset($_GET['del'])) {
                            echo "Leave record has been deleted!";
                        }
                        if(isset($_GET['status'])) {
                            echo "Leave record has been updated!";
                        }
                    ?>
                </p>
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