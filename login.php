<?php
//login.php
//user authontication & session handling 

include('database_connection.php');

if (isset($_SESSION['type'])) {
    header("location:index.php");
}

// assign error message
$message = '';

if (isset($_POST["login"])) {
    $query = "SELECT * FROM user WHERE username = :u_name";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            'u_name' => $_POST["u_name"]
        )
    );
    $count = $statement->rowCount();
    if ($count > 0) {
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            if ($_POST["password"] === $row["u_password"]) {

                // adding as a session variables
                $_SESSION['type'] = $row['u_type'];
                $_SESSION['USER_ID'] = $row['u_id'];
                $_SESSION['USER_NAME'] = $row['username'];
                header("location:index.php");

                //insert data into session table
                $date = new DateTime("now", new DateTimeZone('Asia/Kolkata') );
                $date =  $date->format('Y-m-d H:i:s');
                $query = "INSERT INTO sessions (user_id, in_time) VALUES (:user_id, :in_time)";
                $statement = $connect->prepare($query);
                $statement->execute(
                    array(
                        ':user_id' => $_SESSION['USER_ID'],
//                        ':in_time' => date('Y-m-d h:i:s')
                        ':in_time' => $date
                    )
                );
                $session_id = $connect->lastInsertId();
                $_SESSION['SESSION_ID'] = $session_id;
            } else {
                $message = "<label>Wrong Password</label>";
            }
        }
    } else {
        $message = "<label>Wrong Username</labe>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>intranetX</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/intranetx.min.css">
    <style>
        .login-box {
            width: 450px;
        }
        .btn-signin {
            background-color: #064451;
            color: white;
        }
        .btn-signin:hover {
            color: white;
        }
        .card-primary.card-outline {
            border-top: 3px solid #064451;
        }

        @media (max-width: 576px) {
            .login-box {
                margin-top: 0.5rem;
                width: 90%;
            }
        }

        .card {
            padding: 5%;
        }

        .form-group {
            margin-bottom: 30px;
        }

        .btn-primary {
            font-size: 22px;
            font-weight: 500;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1><b>IntranetX</b></h1>
        </div>
        <div class="card-body">

            <form action="" method="post">
                <div class="form-group">
                    <label for="u_name">Username</label>
                    <input type="text" name="u_name" class="form-control" id="u_name"
                           placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password"
                           placeholder="Enter Password">
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" name="login" class="btn btn-signin btn-block">SIGN IN</button>
                    </div>
                </div>
                <div class="error-msg">
                    <?php echo $message; ?> <!-- display error message -->
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="js/intranetx.min.js"></script>
<!-- Page specific script -->

</body>
</html>	