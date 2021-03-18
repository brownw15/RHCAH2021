<?php
    session_start();
    include 'databaseConnection.php';
    
    $read = 'SELECT * FROM events WHERE ((start > 2021-03-01))';
    $read->execute();    
    $result = $read->fetchAll();

    /*       OR

    $read = 'SELECT * FROM events WHERE ((start > ?))';
    $stmt = $link->prepare($read);
    $dateTime = dateTime(2021-03-01);
    $stmt->bind_param("s",$dateTime);

    $stmt->execute();    
    $result = $stmt->fetchAll();

    */

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