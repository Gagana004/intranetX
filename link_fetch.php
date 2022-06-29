<?php

//link_fetch.php

include('database_connection.php');

$query = '';

$output = array();

$query .= "SELECT * FROM links ";

if(isset($_POST["search"]["value"])) {
	$query .= 'WHERE link_name LIKE "%'.$_POST["search"]["value"].'%" ';
}

if(isset($_POST['order'])) {
    $col_no = $_POST['order']['0']['column'] + 1;
	$query .= 'ORDER BY '.$col_no.' '.$_POST['order']['0']['dir'].' ';
} else {
	$query .= 'ORDER BY link_id DESC ';
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
	$sub_array[] = $row['link_id'];
	$sub_array[] = $row['link_name'];
    $sub_array[] = '<a type="button" href="'.$row["link"].'"  id="'.$row["link_id"].'" class="btn btn-primary btn-xs visit" target= "_blank">Visit</a>';
    $sub_array[] = '<button type="button" name="update" id="'.$row["link_id"].'" class="btn btn-xs update"><i class="fa fa-edit"></i></button>';
    $sub_array[] = '<button type="button" name="delete" id="'.$row["link_id"].'" class="btn btn-xs delete"><i class="fa fa-trash"></i></button>';
	$data[] = $sub_array;
}

$output = array(
	"draw"			    =>	intval($_POST["draw"]),
	"recordsTotal"  	=>  $filtered_rows,
	"recordsFiltered" 	=> 	get_total_all_records($connect),
	"data"				=>	$data
);

function get_total_all_records($connect){
	$statement = $connect->prepare("SELECT * FROM links");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);

?>