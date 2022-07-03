<?php
//link_action.php

include('database_connection.php');

if(isset($_POST['btn_action'])) {
    //add new service
	if($_POST['btn_action'] == 'ADD') {

        $link_access_string = 'admin';
        foreach ($_POST['link_access'] as $single_link_access){
            $link_access_string = $single_link_access.','.$link_access_string;
        }
        $link_access_string = rtrim($link_access_string, ',');

		$query = "INSERT INTO links (link_name, link, link_access) VALUES (:link_name, :link, :link_access)";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':link_name'	=>	$_POST["link_name"],
				':link'	        =>	$_POST["link"],
                ':link_access'  =>  $link_access_string
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
            $output['link_access'] 	= $row['link_access'];
		}
		echo json_encode($output);
	}

    //update service
	if($_POST['btn_action'] == 'EDIT') {
        $link_access_string = 'admin';
        foreach ($_POST['link_access'] as $single_link_access){
            $link_access_string = $single_link_access.','.$link_access_string;
        }
        $link_access_string = rtrim($link_access_string, ',');

		$query = "UPDATE links SET link_name = :link_name, link = :link, link_access = :link_access WHERE link_id = :link_id";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':link_name'	=>	$_POST["link_name"],
				':link'     	=>	$_POST["link"],
				':link_id'		=>	$_POST["link_id"],
                ':link_access'	=>	$link_access_string
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