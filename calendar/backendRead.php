<?php
    session_start();
    include 'databaseConnection.php';
    
    $read = 'SELECT * FROM events WHERE NOT ((end <= ' . $_GET['start'] . ') OR (start >= ' . $_GET['end'] . '))';
    //$stmt = $link->prepare($read);
    //$stmt->bind_param("ss",$_GET['start'],$_GET['end']);

    $read->execute();
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