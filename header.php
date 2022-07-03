<?php
//header.php
?>
<!DOCTYPE html>
<html>
	<head>
		<title>IntranetX</title>

		<script src="js/jquery-1.10.2.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- <link rel="stylesheet" href="css/fontawesome.css"> -->
		<link rel="stylesheet" href="includes/customCSS.css"/>
		<link rel="stylesheet" href="includes/index.css"/>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
		<script src="js/bootstrap.min.js"></script>
<!--        mulitiple choice-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
        <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
	</head>
	<body>
		<div class="container">
			<h1>IntranetX</h1>

			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a href="index.php" class="navbar-brand">Home</a>
					</div>
					<ul class="nav navbar-nav">
                        <li><a href="link.php">Services</a></li>
					<?php if($_SESSION['type'] == 'admin') {?> <!-- only admin can see theses -->
						<li><a href="user.php">Users</a></li>
                        <li><a href="session.php">Sessions</a></li>
                        <li><a href="user_role.php">User Roles</a></li>
					<?php } ?>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count"></span> <?php echo $_SESSION["USER_NAME"]; ?></a>
							<ul class="dropdown-menu">
								<li><a href="profile.php">Profile</a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			 