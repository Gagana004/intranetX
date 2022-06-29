<?php
//session_export.php
// Load the database configuration file
include_once 'database_connection.php';

// Fetch records from database
$query = "SELECT s.*, u.username FROM sessions AS s, user as u WHERE s.user_id = u.u_id ORDER BY id ASC";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

//set delimiter and file name
$delimiter = ",";
$filename = "User-Sessions_" . date('Y-m-d') . "_".time().".csv";

// Create a file pointer
$f = fopen('php://memory', 'w');

// Set column headers
$fields = array('ID', 'Username', 'In Time', 'Out Time');
fputcsv($f, $fields, $delimiter);

// Output each row of the data, format line as csv and write to file pointer
foreach($result as $row) {
    $lineData = array($row['id'], $row['username'], $row['in_time'], $row['out_time']);
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