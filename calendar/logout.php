<?php
    //this page once reached will reset session variables and log user out
    session_start();
    include 'databaseConnection.php';
    date_default_timezone_set('America/New_York');
    //if logout button is pressed
    if(isset($_POST['action'])){
        $statsFile = fopen("LoginStats.csv","a"); //puttin data in csv file for reports
        $statsData = array("Logout, " . $_SESSION['name'] . ", " .
        date("Y-m-d") . ", " . date("h:i:sa"));
        foreach($statsData as $line){
            fputcsv($statsFile, explode(',',$line));
        }
        fclose($statsFile);
        $_SESSION['name'] = "";
        $_SESSION['access'] = "";
        $_SESSION['userID'] = "";
        $_SESSION['childMenuValue'] = "";
        echo '<script>';
        echo 'for(i=0; i<1; i++){window.location.assign("index.php")}';
        echo '</script>';
    }


?>