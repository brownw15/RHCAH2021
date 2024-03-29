<?php
    session_start();
    include 'databaseConnection.php'; // connect to database
    date_default_timezone_set('America/New_York');
    
    // create DELETE statement to delete an event by its id
    $delete = 'DELETE FROM events WHERE id = ?'; 
    $stmt = $link->prepare($delete);
    $stmt->bind_param("i",$_POST['id']); // puts correct id in the statement

    // determine whether the deletion was successful
    if($stmt->execute()){ // if statement succeded
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