<?php
session_start();
include 'databaseConnection.php'; // connect to database
include 'reports.php';

date_default_timezone_set('America/New_York');

$statsFile = fopen("statsFile.csv","a");
$inTime = date("Y-m-d h:i:s");

$stmt = $link->prepare('SELECT id FROM events WHERE userID = ? AND end > ? ORDER BY id DESC LIMIT 1');
$stmt->bind_param('is', $_SESSION['userID'], $inTime);
$stmt->execute();
$stmt->bind_result($id);
$stmt->fetch();

$_SESSION['clockEvent'] = $id;



$statsData = array("Clock In Time, " . $inTime . ", User" . $_SESSION['userID'] . ", EventID " . $_SESSION['clockEvent']);
foreach($statsData as $line){
    fputcsv($statsFile, explode(',',$line));
}

fclose($statsFile);
?>