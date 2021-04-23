<?php
session_start();
include 'databaseConnection.php'; // connect to database\

date_default_timezone_set('America/New_York');

//opens stats file to be updated
$statsFile = fopen("ClockInStatsFile.csv","a");

$statsData = array("Clock Out Time, " . $inTime . ", User" . $_SESSION['userID'] . ", EventID " . $_SESSION['clockEvent']);
foreach($statsData as $line){
    fputcsv($statsFile, explode(',',$line));
}
//resets clock event time so that clockout of event can occur
$_SESSION['clockEvent'] = "";

fclose($statsFile);
?>