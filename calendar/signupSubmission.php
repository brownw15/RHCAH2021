<?php
    session_start();
    //include 'databaseConnection.php'    // we will add this file later, which holds establishing connection to database
    
    /*DELETE*/
    //for now when the form is submitted it will just redirect to home.php
    echo '<script>';
    echo 'for(i=0; i<1; i++){window.location.assign("home.php")}';
    echo '</script>';

    /*DELETE*/

    // This code block checks to see if user is in database before adding them to it
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['userPassword'];
        $profileExists = false;

        $sql = "SELECT username FROM myguests2 WHERE username='$username'";
        $sqlcheck = mysqli_query($conn, $sql);
        $sqlFetch = mysqli_fetch_array($sqlcheck);

        if (!sqlcheck){ // if query fails, then the account was not found
            $profileExists = false;
        }
        else{
            $profileExists = true;
        }
    }

    if($profileExists == false){
        
	$firstname = $_POST['firstname'];
	$lastname =  $_POST['lastname'];
	$username =  $_POST['username'];
	$email =  $_POST['email'];
	$userPassword = $_POST['userPassword'];

	$sql3 = "INSERT INTO myguests2 (firstname,lastname,username,email,userPassword) Values ('$firstname','$lastname','$username','$email','$userPassword')";

	    if(mysqli_query($conn,$sql3)){
            //account was successfully created
            $_SESSION['myUsername'] = $firstname;
            echo '<script>';
            echo 'for(i=0; i<1; i++){window.location.assign("home.php")}';
            echo '</script>';
	    }
    }

?>