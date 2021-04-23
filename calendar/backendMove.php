<?php
    session_start();
    include 'databaseConnection.php';
    //changes timezone to reflect east coast 
    date_default_timezone_set('America/New_York');
    
    //this function changes the start and end time of calendar event 
    $move = 'UPDATE events SET start = ?, end = ? WHERE id = ?';
    $stmt = $link->prepare($move);
    $stmt->bind_param("ssi",$_POST['newStart'], $_POST['newEnd'], $_POST['id']);

    //if the event exists and can go to the right area is executes 
    if($stmt->execute()){
        class Result {}

        $response = new Result();
        $response->result = 'OK';
        $response->message = 'Success';

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    //else error
    else{
        echo '<script>';
        echo 'for(i=0; i<1; i++){alert("Error Creating Event"); window.location.assign("Home.php");}';
        echo '</script>';
    }

?>