<?php

include('database_connection.php');

if(isset($_POST['btn_action'])) {
    //add new service
	if($_POST['btn_action'] == 'ADD') {
		$query = "INSERT INTO links (link_name, link) VALUES (:link_name, :link)";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':link_name'	=>	$_POST["link_name"],
				':link'	        =>	$_POST["link"]
			)
		);
        echo "Service Added";
	}

    //get service details for update form
	if($_POST['btn_action'] == 'fetch_single') {
		$query = "SELECT * FROM links WHERE link_id = :link_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':link_id'	=>	$_POST["link_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row) {
			$output['link_name'] 	= $row['link_name'];
			$output['link'] 	    = $row['link'];
		}
		echo json_encode($output);
	}

    //update service
	if($_POST['btn_action'] == 'EDIT') {
		$query = "UPDATE links SET link_name = :link_name, link = :link WHERE link_id = :link_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':link_name'	=>	$_POST["link_name"],
				':link'     	=>	$_POST["link"],
				':link_id'		=>	$_POST["link_id"]
			)
		);
        echo 'Service Edited';
	}

    //delete service
    if($_POST['btn_action'] == 'delete') {
        $query = "DELETE FROM links WHERE link_id = :link_id";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':link_id'		=>	$_POST["link_id"]
            )
        );
        echo 'Service Removed';
    }
}
?>