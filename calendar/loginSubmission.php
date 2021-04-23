<?php
    //require_once '_db.php';
    session_start();
    include 'databaseConnection.php';    // holds establishing connection to database
    date_default_timezone_set('America/New_York');

    $statsFile = fopen("LoginStats.csv","a");

    // This code block checks to see if user is in database and logs them in
    if(isset($_POST['loginSubmit'])){
        $stmt = $link->prepare('SELECT id, username, userPassword, firstname, lastname, email, description FROM account WHERE username = ? AND userPassword = ? limit 1');
        $stmt->bind_param('ss', $_POST['username'], $_POST['userPassword']);
        $stmt->execute();
        $stmt->bind_result($id,$username,$userPassword,$firstname,$lastname,$email,$description);
        
        if ($stmt->fetch()){ // if query fails, then the account was not found
            
            $_SESSION['name'] = $firstname;
            $_SESSION['access'] = $description;
            $_SESSION['userID'] = $id;
            $statsData = array("Login, " . $firstname . ", " . date("Y-m-d") . ", " . date("h:i:sa"));
            foreach($statsData as $line){
                fputcsv($statsFile, explode(',',$line));
            }
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
    fclose($statsFile);
?>