<?php
session_start();
include 'databaseConnection.php'; // connect to database

date_default_timezone_set('America/New_York');
//opens csv to be updates with values 
$statsFile = fopen("ClockInStatsFile.csv","a");
$inTime = date("Y-m-d h:i:s");
//grabs nearest calendar event based on closest time and makes a session variable indicating that clock in has occured
$stmt = $link->prepare('SELECT id FROM events WHERE userID = ? AND end > ? ORDER BY id DESC LIMIT 1');
$stmt->bind_param('is', $_SESSION['userID'], $inTime);
$stmt->execute();
$stmt->bind_result($id);
$stmt->fetch();

$_SESSION['clockEvent'] = $id;


//putting results in csv file
$statsData = array("Clock In Time, " . $inTime . ", User" . $_SESSION['userID'] . ", EventID " . $_SESSION['clockEvent']);
foreach($statsData as $line){
    fputcsv($statsFile, explode(',',$line));
}
//close stats file
fclose($statsFile);
?>