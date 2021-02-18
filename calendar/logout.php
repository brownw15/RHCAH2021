<?php
    session_start();
    include 'databaseConnection.php';

    if(isset($_POST['action'])){
        $_SESSION['name'] = "";
        $_SESSION['access'] = "";
        echo '<script>';
        echo 'for(i=0; i<1; i++){window.location.assign("index.php")}';
        echo '</script>';
    }


?>