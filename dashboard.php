<?php
ob_start();
require 'includes/dbconfig.php';
?>

<?php

// Status Count 

$retrieveNoticeCount = "SELECT COUNT(postID) AS totalPost FROM notice";
$retrieveQuery = mysqli_query($connection, $retrieveNoticeCount);
$statusCount = mysqli_fetch_assoc($retrieveQuery);

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

            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Search here">
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

    <script src="Includes/menu.js"></script>
</body>
</html>