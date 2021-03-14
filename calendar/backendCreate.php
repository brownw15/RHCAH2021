<?php
    session_start();
    include 'databaseConnection.php';

    $statsFile = fopen("statsFile.csv","a");

    $insert = 'INSERT INTO events (name,start,end) VALUES (?,?,?)';
    $stmt = $link->prepare($insert);
    $stmt->bind_param("sss",$_POST['name'], $_POST['start'], $_POST['end']);

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