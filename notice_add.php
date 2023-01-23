<?php

ob_start();

date_default_timezone_set('Asia/Manila');

$date = date("Y-m-d");

require 'includes/dbconfig.php';

// Create Leave Record

if(isset($_POST['create-notice'])) {

    $author = $_POST['author'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $date = $_POST['date'];

    $query = "INSERT INTO notice(postAuthor, postSubject, postContent, postDate) VALUES ('$author', '$subject', '$content', '$date')";
    $executeQuery = mysqli_query($connection, $query);
    header("Location:notice_add.php?success=true");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/notice.css">
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

                Notice
            </h2>
        </header>

        <main>
            <div class="notice-wrapper">
                <div class="notice-content">
                    <form action="" method="post">
                        <h2>Create Notice</h2>
                        <p>
                            <?php
                                if(isset($_GET['success'])) {
                                    echo "A new notice has been successfully created!";
                                }
                            ?>
                        </p>
                        <hr style="border: 2px solid var(--main-color); margin-bottom: 20px;">
                        <h3>Author</h3>
                        <input type="text" name="author">
                        <h3>Subject</h3>
                        <input type="text" name="subject">
                        <h3>Notice Content</h3>
                        <textarea name="content" id="" cols="166" rows="20"></textarea>
                        <div class="notice-footer">
                            <div>
                                <h4>Date Posted</h4>
                                <input type="text" name="date" value="<?php echo $date?>" readonly>
                            </div>
                            <input type="submit" name="create-notice" value="Create Notice">
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