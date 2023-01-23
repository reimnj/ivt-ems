<?php

ob_start();

require 'includes/dbconfig.php';

// Retrieve admin Data

$query = "SELECT * FROM users";
$executeQuery = mysqli_query($connection, $query);

// Delete admin Data

if(isset($_GET['admID'])) {

    $admID = $_GET['admID'];
    $delQuery = "DELETE FROM users WHERE loginID = '$admID'";
    $executeDelQuery = mysqli_query($connection, $delQuery);
    header("Location:admin_manage.php?del=success");
    exit(0);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/admin.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <title>EMS Manage Admin</title>
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

                Manage admin
            </h2>
        </header>

        <main>
            <p>
                <?php
                    if(isset($_GET['del'])) {
                        echo "Admin record has been deleted!";
                    }
                    if(isset($_GET['status'])) {
                        echo "Admin record has been updated!";
                    }
                ?>
            </p>
            <div class="admin-table">
                <table>
                    <tr class="head">
                        <th>Login ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Full Name</th>
                        <th>Department & Position</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        if(mysqli_num_rows($executeQuery) > 0) {
                            foreach($executeQuery as $adminData) {
                                ?>
                                <tr class="body">
                                    <td><?php echo $adminData['loginID'];?></td>
                                    <td><?php echo $adminData['username'];?></td>
                                    <td><?php echo $adminData['password'];?></td>
                                    <td>
                                        <?php echo $adminData['last_name'];?>, <?php echo $adminData['first_name'];?> <?php echo $adminData['middle_initial'];?>.
                                    </td>
                                    <td><?php echo $adminData['deptPosition'];?></td>
                                    <td class="action">
                                        <button><a href="admin_edit.php?admID=<?=$adminData['loginID'];?>"><span class="las la-edit la-2x"></span></a></button>
                                        <button><a href="admin_manage.php?admID=<?=$adminData['loginID'];?>"><span class="las la-trash la-2x"></span></a></button>
                                    </td>
                                </tr>             
                                <?php
                            }
                        } else {
                            echo "<td>-</td>" . "<td>-</td>" . "<td>-</td>" . "<td>-</td>" . "<td>-</td>" . "<td>-</td>" . "<td>-</td>" . "<td>-</td>" . "<td>-</td>" . "<td>-</td>" . "<td>-</td>" . "<td>-</td>";
                        }
                    ?>
                    </tr> 
                </table>
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