<?php

//user_role_action.php

include('database_connection.php');

if(isset($_POST['btn_action'])) {
    //add new user
	if($_POST['btn_action'] == 'ADD') {
		$query = "INSERT INTO user_roles (ur_name) VALUES (:ur_name)";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':ur_name'	        =>	$_POST["ur_name"]
			)
		);
        echo "User Role Added";
	}

    //get user details for update form
	if($_POST['btn_action'] == 'fetch_single') {
		$query = "SELECT * FROM user_roles WHERE ur_id = :ur_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':ur_id'	=>	$_POST["ur_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row) {
			$output['ur_name'] 	= $row['ur_name'];
		}
		echo json_encode($output);
	}

    //update existing user
	if($_POST['btn_action'] == 'EDIT') {
		$query = "UPDATE user_roles SET ur_name = :ur_name WHERE ur_id = :ur_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':ur_name'	    =>	$_POST["ur_name"],
				':ur_id'		    =>	$_POST["ur_id"]
			)
		);
        echo 'User Role Edited';
	}

    //delete user
	if($_POST['btn_action'] == 'delete')
	{
		$query = "DELETE FROM user_roles WHERE ur_id = :ur_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':ur_id'		=>	$_POST["ur_id"]
			)
		);
        echo 'User Removed';
	}
}

?>