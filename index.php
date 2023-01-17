<?php
session_start();
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "media";

$connection = mysqli_connect($servername, $username,  $password, $dbname);
$retrievePost = "SELECT * FROM post";
$postQuery = mysqli_query($connection, $retrievePost);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Update Page</title>
</head>
<body>
    <div class="main-content">
        <?php
            if(mysqli_num_rows($postQuery) > 0) {
                foreach($postQuery as $mediaPost) {
                    ?>
                    <div class="post-content">
                        <p>Post Author: <?= $mediaPost['postAuthor'];?></p>
                        <p>Content:</p>
                        <p><?= $mediaPost['postContent']; ?></p>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No post available!</p>";
            }
        ?>
    </div>
</body>
</html>