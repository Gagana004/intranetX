<?php
//function.php

// count all users in the system
function count_total_user($connect)
{
    $query = "SELECT * FROM user ";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount(); //only return row count
}

// count all Active sessions in the system
function count_current_active_sessions($connect)
{
    $query = "SELECT id FROM `sessions` where out_time is null";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount(); //only return row count
}

// count all services in the system
function count_total_services($connect)
{
    $query = "SELECT * FROM links ";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount(); //only return row count
}

?>