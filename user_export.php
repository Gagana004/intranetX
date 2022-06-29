<?php

// Load the database configuration file
include_once 'database_connection.php';

// Fetch records from database
$query = "SELECT * FROM user ORDER BY u_id ASC";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

//set delimiter and file name
$delimiter = ",";
$filename = "User-data_" . date('Y-m-d') . ".csv";

// Create a file pointer
$f = fopen('php://memory', 'w');

// Set column headers
$fields = array('ID', 'Username', 'User Type');
fputcsv($f, $fields, $delimiter);

// Output each row of the data, format line as csv and write to file pointer
foreach($result as $row) {
    $lineData = array($row['u_id'], $row['username'], $row['u_type']);
    fputcsv($f, $lineData, $delimiter);
}

// Move back to beginning of file
fseek($f, 0);

// Set headers to download file rather than displayed
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

//output all remaining data on a file pointer
fpassthru($f);

exit;

?>