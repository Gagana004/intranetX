<?php
//logout.php
//including database connection file
include ('database_connection.php');

//update out time in session table
$date = new DateTime("now", new DateTimeZone('Asia/Kolkata') );
$date =  $date->format('Y-m-d H:i:s');
$query = "UPDATE sessions SET out_time = :out_time where id=:session_id";
$statement = $connect->prepare($query);
$statement->execute(
    array(
        ':out_time'	    =>	$date,
        ':session_id'	=>	$_SESSION['SESSION_ID']
    )
);

unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
unset($_SESSION['type']);
header("location:login.php");
die();
?>