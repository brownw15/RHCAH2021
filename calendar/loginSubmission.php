<?php
    //require_once '_db.php';
    session_start();
    include 'databaseConnection.php';    // holds establishing connection to database


    // This code block checks to see if user is in database and logs them in
    if(isset($_POST['submit'])){
        $stmt = $link->prepare('SELECT id, username, firstname, lastname, email FROM account WHERE username = ? limit 1');
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->bind_result($id,$username,$firstname,$lastname,$email);

        if ($stmt->fetch()){ // if query fails, then the account was not found
            $_SESSION['myUsername'] = $firstname;
            echo '<script>';
            echo 'for(i=0; i<1; i++){window.location.assign("home.php")}';
            echo '</script>';
        }
        else{
            //do something
            echo "failed to login";
        }
        $stmt->close();
    }

    /* NEED PROTOCOL FOR WHAT HAPPENS WHEN USER NOT LOGGED IN */
    $link->close();
?>