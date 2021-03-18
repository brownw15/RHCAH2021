<?php
    session_start();
    include 'databaseConnection.php';
    
    $delete = 'DELETE FROM events WHERE id = ?';
    $stmt = $link->prepare($delete);
    $stmt->bind_param("i",$_POST['id']);

    if($stmt->execute()){
        class Result {}

        $response = new Result();
        $response->result = 'OK';
        $response->message = 'Success';

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    else{
        echo '<script>';
        echo 'for(i=0; i<1; i++){alert("Error Creating Event"); window.location.assign("Home.php");}';
        echo '</script>';
    }

?>