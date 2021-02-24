<?php
    session_start();
    include 'databaseConnection.php';    // holds establishing connection to database

    $statsFile = fopen("statsFile.csv","a");
    $statsData = array("Event Created, " . $_SESSION['name'] . ", NewEventTime: " . $_POST['start'] . "," . date("Y-m-d") . ", " . date("h:i:sa"));
    foreach($statsData as $line){
        fputcsv($statsFile, explode(',',$line));
    }
    fclose($statsFile);
?>