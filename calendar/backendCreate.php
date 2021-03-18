<?php
    session_start();
    include 'databaseConnection.php'; // connect to database
    
    // create INSERT statement for creating events
    $insert = 'INSERT INTO events (name,start,end) VALUES (?,?,?)'; 
    $stmt = $link->prepare($insert);
    $stmt->bind_param("sss",$_POST['name'], $_POST['start'], $_POST['end']); // put info in the statement

    // determine whether the creation was successful
    if($stmt->execute()){ // if the statement is successful
        // create confirmation response
        class Result {}

        $response = new Result();
        $response->result = 'OK';
        $response->message = 'Success';

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    else{ // if the statement is not succesful
        // create pop-up error stating that the attempt failed
        echo '<script>';
        echo 'for(i=0; i<1; i++){alert("Error Creating Event"); window.location.assign("Home.php");}';
        echo '</script>';
    }

?>