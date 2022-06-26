<?php
//including database connection file
include ('db_connection.php');

//if user not loged in, redirect to the login page
if (!isset($_SESSION['USER_ID'])) {
    header("location:login.php");
    die();
}

include ('header.php');
?>



</body>
</html>