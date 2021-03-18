<?php
    session_start();
    include 'databaseConnection.php';
    
    $read = 'SELECT * FROM events WHERE ((start > 2021-03-01))';
    //$stmt = $link->prepare($read);
    //$stmt->bind_param("ss",$_GET['start'],$_GET['end']);

    $read->execute();
    echo "<script>console.log('fail')</script>";
    
    $result = $read->fetchAll();

    class Event {}
    $events = array();

    foreach($result as $row) {
    $e = new Event();
    $e->id = $row['id'];
    $e->text = $row['name'];
    $e->start = $row['start'];
    $e->end = $row['end'];
    $events[] = $e;
    }

    header('Content-Type: application/json');
    echo json_encode($events);



?>