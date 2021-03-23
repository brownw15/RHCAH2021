<?php
    session_start();
    include 'databaseConnection.php';

    if(isset($_POST['action'])){
        $statsFile = fopen("statsFile.csv","a");
        $statsData = array("Logout, " . $_SESSION['name'] . ", " .
        date("Y-m-d") . ", " . date("h:i:sa"));
        foreach($statsData as $line){
            fputcsv($statsFile, explode(',',$line));
        }
        fclose($statsFile);
        $_SESSION['name'] = "";
        $_SESSION['access'] = "";
        $_SESSION['childMenuValue'] = "";
        echo '<script>';
        echo 'for(i=0; i<1; i++){window.location.assign("index.php")}';
        echo '</script>';
    }


?>