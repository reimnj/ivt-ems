<?php

ob_start();

require 'includes/dbconfig.php';

// Retrieve Employee Data

$query = "SELECT * FROM employee";
$executeQuery = mysqli_query($connection, $query);

// Delete Employee Data

if(isset($_GET['empID'])) {

    $empID = $_GET['empID'];
    $delQuery = "DELETE FROM employee WHERE employeeID = '$empID'";
    $executeDelQuery = mysqli_query($connection, $delQuery);
    header("Location:employee_manage.php?del=success");
    exit(0);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/employee.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <title>EMS Manage Employees</title>
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

                Manage Employee
            </h2>

            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Search here">
            </div>
            
        </header>

        <main>
            <p>
                <?php
                    if(isset($_GET['del'])) {
                        echo "Employee record has been deleted!";
                    }
                ?>
            </p>
            <div class="employee-table">
                <table>
                    <tr class="head">
                        <th>Employee ID</th>
                        <th>Full Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Contact No.</th>
                        <th>Address</th>
                        <th>Birth Date</th>
                        <th>Marital Status</th>
                        <th>Nationality</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        if(mysqli_num_rows($executeQuery) > 0) {
                            foreach($executeQuery as $employeeData) {
                                ?>
                                <tr class="body">
                                    <td><?php echo $employeeData['employeeID'];?></td>
                                    <td>
                                        <?php echo $employeeData['last_name'];?>, <?php echo $employeeData['first_name'];?> <?php echo $employeeData['middle_initial'];?>.
                                    </td>
                                    <td><?php echo $employeeData['age'];?></td>
                                    <td><?php echo $employeeData['gender'];?></td>
                                    <td><?php echo $employeeData['contact_no'];?></td>
                                    <td class="address"><?php echo $employeeData['address'];?></td>
                                    <td><?php echo $employeeData['birthdate'];?></td>
                                    <td><?php echo $employeeData['marital_status'];?></td>
                                    <td><?php echo $employeeData['nationality'];?></td>
                                    <td><?php echo $employeeData['department'];?></td>
                                    <td><?php echo $employeeData['position'];?></td>
                                    <td class="action">
                                        <button><a href="profile_edit.php?empID=<?=$employeeData['employeeID'];?>"><span class="las la-edit la-2x"></span></a></button>
                                        <button><a href="employee_manage.php?empID=<?=$employeeData['employeeID'];?>"><span class="las la-trash la-2x"></span></a></button>
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
        $('.feat-btn').toggleClass("active");
        $('.sidebar-menu ul .feat-show').toggleClass("show");


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