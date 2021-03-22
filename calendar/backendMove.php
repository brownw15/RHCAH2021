<?php
    session_start();
    include 'databaseConnection.php'; // connect to database
    
    // create UPDATE statement to change time of an event
    $move = 'UPDATE events SET start = ?, end = ? WHERE id = ?';
    $stmt = $link->prepare($move);
    $stmt->bind_param("ssi",$_POST['newStart'], $_POST['newEnd'], $_POST['id']); // puts info into the statement

    // determine whether the update was successful
    if($stmt->execute()){ // if the statement was succesful
        // create confirmation response
        class Result {}

        $response = new Result();
        $response->result = 'OK';
        $response->message = 'Success';

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    else{ // if statement failed
        // create pop-up error stating attempt failed
        echo '<script>';
        echo 'for(i=0; i<1; i++){alert("Error Creating Event"); window.location.assign("Home.php");}';
        echo '</script>';
    }

?>