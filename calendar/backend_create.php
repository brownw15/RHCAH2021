<?php
include 'databaseConnection.php' // file to connect to database
require_once '_db.php';

// creates INSERT statement for creating events
$insert = "INSERT INTO events (name, start, end) VALUES (:name, :start, :end)";

// prepares statement
$stmt = $db->prepare($insert);

//inserts info into the INSERT statement
$stmt->bindParam(':start', $_POST['start']); // event start time
$stmt->bindParam(':end', $_POST['end']); // event end time
$stmt->bindParam(':name', $_POST['name']); // event name

$stmt->execute();


// creates response to confirm last insert
class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Created with id: '.$db->lastInsertId();

header('Content-Type: application/json');
echo json_encode($response);

?>
