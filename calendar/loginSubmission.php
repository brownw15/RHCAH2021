<?php
    //require_once '_db.php';
    session_start();
    include 'databaseConnection.php';    // holds establishing connection to database


    // This code block checks to see if user is in database and logs them in
    if(isset($_POST['submit'])){
        $stmt = $link->prepare('SELECT id, username, userPassword, firstname, lastname, email, description FROM account WHERE username = ? AND userPassword = ? limit 1');
        $stmt->bind_param('ss', $_POST['username'], $_POST['userPassword']);
        $stmt->execute();
        $stmt->bind_result($id,$username,$userPassword,$firstname,$lastname,$email,$description);
        
        if ($stmt->fetch()){ // if query fails, then the account was not found
            
            $_SESSION['name'] = $firstname;
            $_SESSION['access'] = $description;
            echo '<script>';
            echo 'for(i=0; i<1; i++){window.location.assign("home.php")}';
            echo '</script>';
        }
        else{
            echo '<script>';
            echo 'for(i=0; i<1; i++){alert("Invalid username or password, try again"); window.location.assign("index.php");}';
            echo '</script>';
        }
        $stmt->close();
    }

    /* NEED PROTOCOL FOR WHAT HAPPENS WHEN USER NOT LOGGED IN */
    $link->close();
?>