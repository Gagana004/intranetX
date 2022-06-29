<?php

//user_action.php

include('database_connection.php');

if(isset($_POST['btn_action'])) {
    //add new user
	if($_POST['btn_action'] == 'ADD') {
		$query = "INSERT INTO user (username, u_password, u_type) VALUES (:username, :u_password, :u_type)";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':username'	        =>	$_POST["username"],
				':u_password'	    =>	$_POST["u_password"],
				':u_type'	        =>	$_POST["u_type"]
			)
		);
        echo "User Added";
	}

    //get user details for update form
	if($_POST['btn_action'] == 'fetch_single') {
		$query = "SELECT * FROM user WHERE u_id = :u_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':u_id'	=>	$_POST["u_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row) {
			$output['username'] 	= $row['username'];
            $output['u_password'] 	= $row['u_password'];
			$output['u_type'] 	    = $row['u_type'];
		}
		echo json_encode($output);
	}

    //update existing user
	if($_POST['btn_action'] == 'EDIT') {
		$query = "UPDATE user SET username = :username, u_password = :u_password, u_type = :u_type WHERE u_id = :u_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':username'	    =>	$_POST["username"],
				':u_password'	=>	$_POST["u_password"],
				':u_type'		=>	$_POST["u_type"],
				':u_id'		    =>	$_POST["u_id"]
			)
		);
        echo 'User Edited';
	}

    //delete user
	if($_POST['btn_action'] == 'delete')
	{
		$query = "DELETE FROM user WHERE u_id = :u_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':u_id'		=>	$_POST["u_id"]
			)
		);
        echo 'User Removed';
	}
}

?>