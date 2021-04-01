<?php
    session_start();
    include 'databaseConnection.php';
    
    $move = 'UPDATE events SET start = ?, end = ? WHERE id = ?';
    $stmt = $link->prepare($move);
    $stmt->bind_param("ssi",$_POST['newStart'], $_POST['newEnd'], $_POST['id']);

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