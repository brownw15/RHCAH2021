<?php
    //require_once '_db.php';
    session_start();
    include 'databaseConnection.php';   // we will add this file later, which holds establishing connection to database

    $statsFile = fopen("AccountCreationStats.csv","a");

    // This code block checks to see if user is in database before adding them to it
    //the object in $var->prepare needs to be the same object as the object created in databaseConnection.php via $var = new mysqli();
    if(isset($_POST['signupSubmit'])){
        $stmt = $link->prepare('SELECT username FROM account WHERE username = ?');
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        // if query returns 0 rows, account not found.
    
        if ($result->num_rows > 0){
            $profileExists = true;
            echo '<script>';
            echo 'for(i=0; i<1; i++){alert("Profile already exists, try logging in"); window.location.assign("index.php");}';
            echo '</script>';
        }
        else{
            $profileExists = false;
        }
    }
 
    //create profile if it doesn't already exist
    if($profileExists == false){
        //id needs to be modified for each test unless working with a fresh database.
        $insert = 'INSERT INTO account (firstname,lastname,username,email,userPassword,description) VALUES (?,?,?,?,?,?)'; //prepared sql statement for efficiency and security
	    $stmt = $link->prepare($insert);
        $child = "child";
        $stmt->bind_param("ssssss", $_POST['firstName'], $_POST['lastName'], $_POST['username'], $_POST['email'], $_POST['userPassword'], $child); //sssss for each parameter being handled as a string
        
        if($stmt->execute()){
            //account was successfully created
            $_SESSION['name'] = $_POST['firstName'];
            $_SESSION['access'] = "child";
            $statsData = array("Account Created, " . $_POST['username'] . ", " . date("Y-m-d") . ", " . date("h:i:sa"));
            foreach($statsData as $line){
                fputcsv($statsFile, explode(',',$line));
            }
            echo '<script>';
            echo 'for(i=0; i<1; i++){window.location.assign("home.php")}';
            echo '</script>';
        }
    
    }

    //needs to be same as the connection variable. otherwise connection won't close successfully.
    $link->close();
    fclose($statsFile);
?>
