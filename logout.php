<?php

require 'includes/dbconfig.php';

session_unset();
session_destroy();
mysqli_close($connection);
header("Location:login.php");

?>