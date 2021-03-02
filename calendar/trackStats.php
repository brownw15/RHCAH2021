<?php
    session_start();
    include 'databaseConnection.php';    // holds establishing connection to database

    $statsFile = fopen("statsFile.csv","a");
    if($_POST['type'] == 'create'){
        $statsData = array("Event Created, " . $_SESSION['name'] .
            ", EventID: " . $_POST['eventId'] .
            ", EventName: " . $_POST['eventName'] .
            ", EventStart: " . $_POST['start'] . 
            ", EventEnd: " . $_POST['end'] . ", " .
            date("Y-m-d") . ", " . date("h:i:sa"));
    }
    elseif($_POST['type'] == 'edit'){
        $statsData = array("Event Edit, " . $_SESSION['name'] .
            ", EventID: " . $_POST['eventId'] .
            ", NewEventStart: " . $_POST['start'] . 
            ", NewEventEnd: " . $_POST['end'] . ", " .
            date("Y-m-d") . ", " . date("h:i:sa"));
    }
    elseif($_POST['type'] == 'delete'){
        $statsData = array("Event Deleted, " . $_SESSION['name'] .
            ", EventID: " . $_POST['eventId'] . ", " .
            date("Y-m-d") . ", " . date("h:i:sa"));
    }
    foreach($statsData as $line){
        fputcsv($statsFile, explode(',',$line));
    }
    fclose($statsFile);
?>