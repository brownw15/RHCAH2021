<?php
    require_once '_db.php';
    session_start();
    include 'databaseConnection.php';   // we will add this file later, which holds establishing connection to database
    
    /*DELETE*/
    //for now when the form is submitted it will just redirect to home.php
    //echo '<script>';
   // echo 'for(i=0; i<1; i++){window.location.assign("home.php")}';
    //echo '</script>';

    /*DELETE*/

    // This code block checks to see if user is in database before adding them to it
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
    
    //create profile if it doesn't already exist
    if($profileExists == false){
        $insert = "INSERT INTO account (firstname,lastname,username,email,userPassword) Values (?,?,?,?,?)"; //prepared sql statement for efficiency and security
	    $stmt = $db->prepare($insert);
        $stmt->bind_param("sssss", $_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['userPassword']); //sssss for each parameter being handled as a string

	    if($stmt->execute()){
            //account was successfully created
            $stmt->close();
            $_SESSION['myUsername'] = $firstname;
            echo '<script>';
            echo 'for(i=0; i<1; i++){window.location.assign("home.php")}';
            echo '</script>';

	    }
    }

    $stmt->close();
?>