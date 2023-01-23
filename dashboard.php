<?php
ob_start();
require 'includes/dbconfig.php';
?>

<?php

// Status Count 

$retrieveNoticeCount = "SELECT COUNT(postID) AS totalPost FROM notice";
$retrieveQuery = mysqli_query($connection, $retrieveNoticeCount);
$noticeCount = mysqli_fetch_assoc($retrieveQuery);

$retrieveLeaveCount = "SELECT COUNT(leaveID) AS totalLeave FROM employee_leave";
$retrieveQuery1 = mysqli_query($connection, $retrieveLeaveCount);
$leaveCount = mysqli_fetch_assoc($retrieveQuery1);

$retrieveDepartmentCount = "SELECT COUNT(departmentID) AS totalDepartment FROM department";
$retrieveQuery2 = mysqli_query($connection, $retrieveDepartmentCount);
$departmentCount = mysqli_fetch_assoc($retrieveQuery2);

$retrieveEmployeeCount = "SELECT COUNT(employeeID) AS totalEmployee FROM employee";
$retrieveQuery3 = mysqli_query($connection, $retrieveEmployeeCount);
$employeeCount = mysqli_fetch_assoc($retrieveQuery3);

// Retrieve Department Data

$retrieveDept = "SELECT * FROM department";
$retrieveQuery4 = mysqli_query($connection, $retrieveDept);

// Delete Notice

if(isset($_GET['postID'])) {

    $pID = $_GET['postID'];

    $deleteNotice = "DELETE FROM notice WHERE postID='$pID'";
    $executeDeleteNotice = mysqli_query($connection, $deleteNotice);
    header("Location:dashboard.php?del=success");
}

// Delete Department

if(isset($_GET['dID'])) {
    $dID = $_GET['dID'];

    $deleteDept = "DELETE FROM department WHERE departmentID='$dID'";
    $executeDeleteDept = mysqli_query($connection, $deleteDept);
    header("Location:dashboard.php?deptDel=success");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/dashboard.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
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

                Dashboard
            </h2>
        </header>

        <main>
            <h2>Current EMS Statistics</h2>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <!-- Count -->
                        <h1><?php echo $employeeCount['totalEmployee']; ?></h1>
                        <span>Employees</span>
                    </div>
                    <div>
                        <span class="las la-users la-4x"></span>
                    </div>
                </div>
    
                <div class="card-single">
                    <div>
                        <h1><?php echo $departmentCount['totalDepartment']; ?></h1>
                        <span>Department</span>
                    </div>
                    <div>
                        <span class="las la-object-group la-4x"></span>
                    </div>
                </div>
    
                <div class="card-single">
                    <div>
                        <h1><?php echo $noticeCount['totalPost']; ?></h1>
                        <span>Notice</span>
                    </div>
                    <div>
                        <span class="las la-newspaper la-4x"></span>
                    </div>
                </div>
    
                <div class="card-single">
                    <div>
                        <h1><?php echo $leaveCount['totalLeave']; ?></h1>
                        <span>On Leave</span>
                    </div>
                    <div>
                        <span class="las la-clipboard-list la-4x"></span>
                    </div>
                </div>
            </div>
            <h2 id="notice-header">Admin Dashboard Quick Menu</h2>
            <div class="card-nav">
                <div>
                    <a href="notice_add.php"><span class="las la-plus-square la-2x"></span>Create a New Notice</a>
                </div>
                <div>
                    <a href="department_add.php"><span class="las la-plus-square la-2x"></span>Create a Department</a>
                </div>
                <div>
                    <a href="employee.php"><span class="las la-plus-square la-2x"></span>Create Employee Profile</a>
                </div>
                <div>
                    <a href="employee_leave.php"><span class="las la-plus-square la-2x"></span>Create Employee Leave</a>
                </div>
                <div>
                    <a href="admin.php"><span class="las la-plus-square la-2x"></span>Create Administrator Account</a>
                </div>
            </div>
            <h2 id="notice-header">Notice Board</h2>
            <p style="color: var(--main-color); margin-bottom: 10px; font-weight: 500;">
                <?php
                    if(isset($_GET['del'])) {
                        echo "The notice has been deleted successfully!";
                    }
                ?>
            </p>
            <div class="notice-board">
                <?php
                    $retrievePost = "SELECT * FROM notice";
                    $postQuery = mysqli_query($connection, $retrievePost);

                    if(mysqli_num_rows($postQuery) > 0) {
                        foreach($postQuery as $noticePost) {
                            ?>
                                <div class="notice-content">
                                    <div class="notice-content-header">
                                        <p class="nc-subject"><?= $noticePost['postSubject'];?></p>
                                    </div>
                                    <hr>
                                    <div class="notice-content-post">
                                        <p class="nc-post">
                                            <?= $noticePost['postContent'];?>
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="notice-content-footer">
                                        <div>
                                            <p class="nc-author">Author: <?= $noticePost['postAuthor'];?></p>
                                            <p class="nc-date">Date Posted: <?= $noticePost['postDate'];?></p>
                                        </div>
                                        <div>
                                            <button><a href="notice_edit.php?postID=<?=$noticePost['postID'];?>"><span class="las la-edit la-3x"></span></a></button>
                                            <button><a href="dashboard.php?postID=<?=$noticePost['postID'];;?>"><span class="las la-trash la-3x"></span></a></button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    } else {
                        ?> <p class="nc-log">No notices for today!</p> <?php
                    }
                ?>
            </div>
            <h2 id="notice-header">Department Board</h2>
            <p style="color: var(--main-color); margin-bottom: 10px; font-weight: 500;">
                <?php
                    if(isset($_GET['deptDel'])) {
                        echo "The department has been deleted successfully!";
                    }
                ?>
            </p>
            <div class="department-board">
                <div class="department-table">
                    <table>
                        <tr class="head">
                            <th>Department ID</th>
                            <th>Department Name</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            if(mysqli_num_rows($retrieveQuery4) > 0) {
                                foreach($retrieveQuery4 as $deptData) {
                                    ?>
                                    <tr class="body">
                                        <td><?php echo $deptData['departmentID'];?></td>
                                        <td><?php echo $deptData['department_name'];?></td>
                                        <td class="action">
                                            <button><a href="department_edit.php?dID=<?=$deptData['departmentID'];?>"><span class="las la-edit la-2x"></span></a></button>
                                            <button><a href="dashboard.php?dID=<?=$deptData['departmentID'];?>"><span class="las la-trash la-2x"></span></a></button>
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
            </div>
        </main>
    </div>

    <script src="Includes/menu.js"></script>
</body>
</html>