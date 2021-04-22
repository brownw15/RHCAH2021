<?php
session_start();
include 'databaseConnection.php'; // connect to database

date_default_timezone_set('America/New_York');

$statsFile = fopen("statsFile.csv","a");

$statsData = array("Clock Out Time, " . $inTime . ", User" . $_SESSION['userID'] . ", EventID " . $_SESSION['clockEvent']);
foreach($statsData as $line){
    fputcsv($statsFile, explode(',',$line));
}
$_SESSION['clockEvent'] = "";

fclose($statsFile);
?>