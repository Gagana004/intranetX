<?php ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap');

        body {
            display: flex;
            justify-content: space-around;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
<h1>Welcome <?php echo $_SESSION['USER_NAME'] ?></h1><br>
<!--<h1> --><?php //echo $_SESSION['SESSION_ID'] ?><!--</h1><br>-->
<h2><a href="index.php">Home</a></h2>
<?php
if ($_SESSION['USER_TYPE'] == "admin") {
    ?>
    <h2><a href="users.php">Users</a></h2>
    <h2><a href="session.php">Sessions</a></h2>
    <?php
}
?>
<h2><a href="links.php">Links</a></h2>
<h2><a href="logout.php">Logout</a></h2>
