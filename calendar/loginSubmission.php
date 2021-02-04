<?php
    require_once '_db.php';
    session_start();
    include 'databaseConnection.php';    // we will add this file later, which holds establishing connection to database
    
    
    /*DELETE*/
    //for now when the form is submitted it will just redirect to home.php

    /*For testing purposes*/ /*DELETE*/// $_SESSION['myUsername'] = $_POST['username'];
    //echo '<script>';
    //echo 'for(i=0; i<1; i++){window.location.assign("home.php")}';
    //echo '</script>';

    /*DELETE*/

    // This code block checks to see if user is in database
    if(isset($_POST['submit'])){
        $stmt = $db->prepare('SELECT username FROM account WHERE username = :username');
        $stmt->bindParam(':username', $_POST['username']);

        if (!$stmt->execute()){ // if query fails, then the account was not found
            $profileExists = false;
        }
        else{
            $profileExists = true;
        }
        $stmt->close();
    }

    //this code block gathers the users information once we confirm their account exists and password matches. We chose to do a seperate query to gather 
    //the rest of the data to eliminate uneccesary data requested (which adds to response time) and for security reasons
    if($profileExists == true){
        $select = "SELECT id, username, firstname, lastname, email, userPassword, image, description, background FROM account WHERE username=:username limit 1";
        $stmt = $db->prepare($select);
        $stmt->bindParam(':username', $_POST['username']);

        $stmt->execute();
        $result = $stmt->fetchAll(); //should return the one instance

        class Extract {}
        //now extract the fields of the query
        foreach($result as $value) {
            $returnData = new Extract();
            $returnData->username = $value['username'];
        /*DELETE*/ $_SESSION['myUsername'] = $value['username'];
        }

        echo '<script>';
        echo 'for(i=0; i<1; i++){window.location.assign("home.php")}';
        echo '</script>';

    }
?>