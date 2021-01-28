<?php
    session_start();
    //include 'databaseConnection.php'    // we will add this file later, which holds establishing connection to database
    
    /*DELETE*/
    //for now when the form is submitted it will just redirect to home.php

    /*For testing purposes*/ /*DELETE*/ $_SESSION['myUsername'] = $_POST['username'];
    echo '<script>';
    echo 'for(i=0; i<1; i++){window.location.assign("home.php")}';
    echo '</script>';

    /*DELETE*/

    // This code block checks to see if user is in database
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['userPassword'];
        $profileExists = false;

        $sql = "SELECT username FROM myguests2 WHERE username='$username' AND password='$password'";
        $sqlcheck = mysqli_query($conn, $sql);
        $sqlFetch = mysqli_fetch_array($sqlcheck);

        if (!sqlcheck){ // if query fails, then the account was not found
            $profileExists = false;
        }
        else{
            $profileExists = true;
        }
    }

    //this code block gathers the users information once we confirm their account exists and password matches. We chose to do a seperate query to gather 
    //the rest of the data to eliminate uneccesary data requested (which adds to response time) and for security reasons
    if($profileExists == true){
        $sql = "SELECT id, username, firstname, lastname, email, userPassword, image, description, background FROM myguests2 WHERE username='$username' limit 1";
        $result = mysqli_query($conn, $sql);
        $value = mysqli_fetch_array($result);
        //Now you can set your values for other pages by grabbing info out of the $value[] array using the query fields like below
        
        /*DELETE*/ $_SESSION['myUsername'] = $value["username"];

        echo '<script>';
        echo 'for(i=0; i<1; i++){window.location.assign("home.php")}';
        echo '</script>';

    }
?>