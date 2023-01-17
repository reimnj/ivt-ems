<?php
ob_start();
require 'includes/dbconfig.php';
?>

<?php

// Status Count 

$retrieveNoticeCount = "SELECT COUNT(postID) AS totalPost FROM notice";
$retrieveQuery = mysqli_query($connection, $retrieveNoticeCount);
$statusCount = mysqli_fetch_assoc($retrieveQuery);

// User Profile Display

$profileID = $_SESSION["user"];

$queryEID  = "SELECT * FROM users WHERE username = '$profileID'";
$getEmployeeID = mysqli_query($connection, $queryEID);
$userData = mysqli_fetch_assoc($getEmployeeID);

$employeeID = $userData['employeeID'];
$queryData = "SELECT * FROM employee WHERE employeeID = '$employeeID'";
$getEmployeeData = mysqli_query($connection, $queryData);
$employeeData = mysqli_fetch_assoc($getEmployeeData);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/dashboard.css">
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
                    <a href="" class="active"><span class="las la-igloo"></span>
                    <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="profile.php"><span class="las la-user"></span>
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
            <h2>Current EMS Statistics</h2>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <!-- Count -->
                        <h1>51</h1>
                        <span>Users</span>
                    </div>
                    <div>
                        <span class="las la-users la-4x"></span>
                    </div>
                </div>
    
                <div class="card-single">
                    <div>
                        <h1>5</h1>
                        <span>Department</span>
                    </div>
                    <div>
                        <span class="las la-object-group la-4x"></span>
                    </div>
                </div>
    
                <div class="card-single">
                    <div>
                        <h1><?php echo $statusCount['totalPost']; ?></h1>
                        <span>Notice</span>
                    </div>
                    <div>
                        <span class="las la-newspaper la-4x"></span>
                    </div>
                </div>
    
                <div class="card-single">
                    <div>
                        <h1>2</h1>
                        <span>On Leave</span>
                    </div>
                    <div>
                        <span class="las la-clipboard-list la-4x"></span>
                    </div>
                </div>
            </div>
            <h2 id="notice-header">Notice Board</h2>
            <div class="notice-board">
                <?php
                    $retrievePost = "SELECT * FROM notice";
                    $postQuery = mysqli_query($connection, $retrievePost);

                    if(mysqli_num_rows($postQuery) > 0) {
                        foreach($postQuery as $noticePost) {
                            ?>
                                <div class="notice-content">
                                    <div class="notice-content-header">
                                        <p class="nc-author"><?= $noticePost['postAuthor'];?></p>
                                    </div>
                                    <hr>
                                    <div class="notice-content-post">
                                        <p class="nc-post">
                                            <?= $noticePost['postContent'];?>
                                        </p>
                                    </div>
                                </div>
                            <?php
                        }
                    } else {
                        ?> <p class="nc-log">No notices for today!</p> <?php
                    }
                ?>
            </div>
        </main>
    </div>

    
</body>
</html>