<?php

ob_start();

require 'includes/dbconfig.php';

// Display Profile Details



// Update Profile Details

$empID = "EID" . rand(1001, 999999);

if(isset($_POST['create'])) {

    $empIDG = $_POST['emp-id'];
    $firstName = $_POST['firstname'];
    $middleInitial = $_POST['middle_initial'];
    $lastName = $_POST['lastname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $bloodtype = $_POST['bloodtype'];
    $marital_status =  $_POST['marital_status'];
    $nationality = $_POST['nationality'];
    $department = $_POST['department'];
    $departmentPosition = $_POST['position'];
    
    $addQuery = "INSERT INTO employee(employeeID, first_name, middle_initial, last_name, age, gender, contact_no, address, birthdate, bloodtype, marital_status, nationality, department, position, employement_status) VALUES ('$empIDG', '$firstName', '$middleInitial', '$lastName', '$age', '$gender', '$contactNo', '$address', '$birthdate', '$bloodtype', '$marital_status', '$nationality', '$department', '$departmentPosition', 'Active')";

    $executeQuery = mysqli_query($connection, $addQuery);

    header("location:employee.php?update=success");
    exit();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/employee.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
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

                Employee
            </h2>

            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Search here">
            </div>
        </header>

        <main>
            <div class="profile-wrapper">
                <form action="" method="post">
                <div class="profile-header">
                    <div class="profile-header-details">
                        <h2>Main Details</h2><p>Status: </p><p style="color: var(--main-color);"><?php if(isset($_GET['update'])) echo "New employee has been added!"; ?></p>
                        <p>Name</p>
                        <h2><input type="text" name="lastname" placeholder="Last Name"> <input type="text" name="firstname" placeholder="First Name & Second Name (if applicable)"> <input type="text" name="middle_initial" placeholder="Middle Initial"></h2>
                        <p>Department</p>
                        <h3><input type="text" name="department" placeholder="Assign department (Ex.: IT-SE)"></h3>
                    </div>
                    <div class="profile-picture">
                        <img src="Logo/Ali.jpg" alt="">
                        <a href="">Add/Edit Photo</a>
                    </div>
                </div>
                <hr>
                <h2>Additional Details <span style="font-size: 14px; color: var(--main-color);">(Add new employee)</span></h2>
                    <div class="profile-main-content">
                        <div>
                            <h4>Employee ID (System Generated)</h4>
                            <input type="text" name="emp-id" value="<?php echo $empID?>" readonly>
                        </div>
                        <div>
                            <h4>Age:</h4>
                            <input type="text" name="age">
                        </div>
                        <div>
                            <h4>Gender:</h4>
                            <input type="text" name="gender">
                        </div>
                        <div>
                            <h4>Contact No.:</h4>
                            <input type="text" name="contactNo">
                        </div>
                        <div>
                            <h4>Address:</h4>
                            <input type="text" name="address">
                        </div>
                        <div>
                            <h4>Birthdate:</h4>
                            <input type="text" name="birthdate">
                        </div>
                        <div>
                            <h4>Blood Type:</h4>
                            <input type="text" name="bloodtype">
                        </div>
                        <div>
                            <h4>Marital Status:</h4>
                            <input type="text" name="marital_status">
                        </div>
                        <div>
                            <h4>Nationality:</h4>
                            <input type="text" name="nationality">
                        </div>
                        <div>
                            <h4>Department Position:</h4>
                            <input type="text" name="position">
                        </div>
                        <div>
                            <h4>Employment Status:</h4>
                            <input type="text" name="status">
                        </div>
                        <div>
                            <h4>Action:</h4>
                            <input name="create" type="submit" value="Add Employee">
                        </div>
                    </div>
                </form>
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