<?php

//user_action.php

include('database_connection.php');

if(isset($_POST['btn_action'])) {
    //delete user
	if($_POST['btn_action'] == 'delete')
	{
		$query = "DELETE FROM sessions WHERE id = :id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id'		=>	$_POST["id"]
			)
		);
        echo 'Session Removed';
	}
}

?>