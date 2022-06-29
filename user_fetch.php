<?php

//user_fetch.php

include('database_connection.php');

$query = '';

$output = array();

$query .= "SELECT * FROM user ";

if(isset($_POST["search"]["value"])) {
	$query .= 'WHERE username LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR u_type LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST['order'])) {
    $coul_no = $_POST['order']['0']['column'] + 1;
	$query .= 'ORDER BY '.$coul_no.' '.$_POST['order']['0']['dir'].' ';
} else {
	$query .= 'ORDER BY u_id DESC ';
}

if($_POST['length'] != -1) {
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();

foreach($result as $row) {
	$sub_array = array();
	$sub_array[] = $row['u_id'];
	$sub_array[] = $row['username'];
	$sub_array[] = $row['u_type'];
    $sub_array[] = '<button type="button" name="update" id="'.$row["u_id"].'" class="btn btn-xs update"><i class="fa fa-edit"></i></button>';
    $sub_array[] = '<button type="button" name="delete" id="'.$row["u_id"].'" class="btn btn-xs delete"><i class="fa fa-trash"></i></button>';
	$data[] = $sub_array;
}

$output = array(
	"draw"			    =>	intval($_POST["draw"]),
	"recordsTotal"  	=>  $filtered_rows,
	"recordsFiltered" 	=> 	get_total_all_records($connect),
	"data"				=>	$data
);

function get_total_all_records($connect){
	$statement = $connect->prepare("SELECT * FROM user");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);

?>