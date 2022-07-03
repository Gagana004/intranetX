<?php
//index.php
include('database_connection.php');
include('function.php');

if(!isset($_SESSION["type"]))
{
	header("location:login.php");
}

include('header.php');

?>
	<br />
	<div class="row">

		<!-- only admin user can seee this -->
	<?php
	if($_SESSION['type'] == 'admin')
	{
	?>

		<!-- labels  -->
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Total User</strong></div>
				<div class="panel-body">
					<h1><?php echo count_total_user($connect); ?></h1>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Active Sessions</strong></div>
				<div class="panel-body">
					<h1><?php echo count_current_active_sessions($connect); ?></h1>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Total Services</strong></div>
				<div class="panel-body">
					<h1><?php echo count_total_services($connect); ?></h1>
				</div>
			</div>
		</div>
	<?php
	}
	?>

	<!-- user and admin can see this -->
	<?php
		if($_SESSION['type']!== 'admin')
		{
	?>
	<!-- lables -->
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Total Services</strong></div>
				<div class="panel-body">
					<h1><?php echo count_total_services($connect); ?></h1>
				</div>
			</div>
		</div>
		<?php
		}
		?>
	</div>

<?php
include("footer.php");
?>