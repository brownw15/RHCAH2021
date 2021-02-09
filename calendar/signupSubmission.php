<?php
    //require_once '_db.php';
    session_start();
    include 'databaseConnection.php';   // we will add this file later, which holds establishing connection to database

    // This code block checks to see if user is in database before adding them to it
    //the object in $var->prepare needs to be the same object as the object created in databaseConnection.php via $var = new mysqli();
    if(isset($_POST['submit'])){
        $stmt = $link->prepare("SELECT account.username FROM account WHERE username=?");
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        // if query returns 0 rows, account not found.
        if ($result->num_rows == 0){
            $profileExists = false;
        }
        else{
            $profileExists = true;
        }
    }
 
    //create profile if it doesn't already exist
    if($profileExists == false){
        //id needs to be modified for each test unless working with a fresh database.
        $insert = "INSERT INTO account (id,firstname,lastname,username,email,userPassword) VALUES ('5',?,?,?,?,?)"; //prepared sql statement for efficiency and security
	    $stmt = $link->prepare($insert);
        $stmt->bind_param("sssss", $_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['userPassword']); //sssss for each parameter being handled as a string

	    if($stmt->execute()){
            //account was successfully created
            $_SESSION['myUsername'] = $_POST['username'];
            echo '<script>';
            echo 'for(i=0; i<1; i++){window.location.assign("home.php")}';
            echo '</script>';
	    }
    }

    //needs to be same as the connection variable. otherwise connection won't close successfully.
    $link->close();
?>
