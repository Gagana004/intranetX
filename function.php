<?php
//function.php

//homepage count boxes
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

function count_total_user_roles($connect){
    $query = "SELECT * FROM user_roles ";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount(); //only return row count
}

function count_total_avilable_services($connect, $user_type){
    $query = "SELECT * FROM links where link_access like '%$user_type%' ";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount(); //only return row count
}

//dropdown fillers
function fill_user_type_list($connect)
{
    $query = "SELECT * FROM user_roles ORDER BY ur_id ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output .= '<option value="'.$row["ur_name"].'">'.$row["ur_name"].'</option>';
    }
    return $output;
}

function fill_user_type_list_without_admin($connect){
    $query = "SELECT * FROM user_roles where ur_name <> 'admin' ORDER BY ur_id ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output .= '<option value="'.$row["ur_name"].'">'.$row["ur_name"].'</option>';
    }
    return $output;
}

?>