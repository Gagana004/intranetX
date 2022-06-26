<?php
//including database connection file
include ('db_connection.php');

//if user already loged in, redirect to the home page
if(isset($_SESSION['type']))
{
    header("location:index.php");
}

//assign error message
$msg = "";

//login form validation
if (isset($_POST['submit'])) {
    $query = "select * from user where username=:username";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            'username'	=>	$_POST["username"]
        )
    );
    $count = $statement->rowCount();
    if($count > 0){
        $result = $statement->fetchAll();
        foreach($result as $row) {
            if($_POST["password"] == $row["u_password"]){
                //setup session variables
                $_SESSION['USER_TYPE'] = $row['u_type'];
                $_SESSION['USER_ID'] = $row['u_id'];
                $_SESSION['USER_NAME'] = $row['username'];
                header("location:index.php");

                //insert data into session table
                $query ="INSERT INTO sessions (user_id, in_time) VALUES (:user_id, :in_time)";
                $statement = $connect->prepare($query);
                $statement->execute(
                    array(
                        ':user_id'			=>	$_SESSION['USER_ID'],
                        ':in_time'			=>  date('Y-m-d h:i:s')
                    )
                );
                $session_id = $connect->lastInsertId();
                $_SESSION['SESSION_ID'] = $session_id;
            }else{
                $msg = "Please Enter Valid Password !";
            }
        }
    }else{
        $msg = "Please Enter Valid Username !";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Login Page</title>
</head>
<body>
<div class="main">
    <div class="flex">
        <div class="content">
            <h2 class="title">Login</h2>
            <form method="post" action="">
                <label for="username">Username</label>
                <div class="box">
                    <input type="text" name="username" placeholder="Username" class="form-control" required>
                </div>
                <label for="password">Password</label>
                <div class="box">
                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                </div>
                <div class="btn-box">
                    <input type="submit" name="submit" value="Login" class="btn submit-btn">
                </div>
                <div class="error">
                    <?php
                    //show error message
                    echo $msg
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>