<?php

//edit_profile.php

include('database_connection.php');

if(isset($_POST['u_name'])) {
	if($_POST["user_new_password"] != '') {
		//if user set new password
		$query = " UPDATE user SET 
			username = '".$_POST["u_name"]."', 
			u_password = '".$_POST["user_new_password"]."' 
			WHERE u_id = '".$_SESSION["USER_ID"]."'";
	} else {
		//user didn't set new password
		$query = "UPDATE user SET 
			username = '".$_POST["u_name"]."'
			WHERE u_id = '".$_SESSION["USER_ID"]."'
		";
	}
	$statement = $connect->prepare($query);
	$statement->execute();
    echo '<div class="alert alert-success">Profile Edited</div>';
}

?>