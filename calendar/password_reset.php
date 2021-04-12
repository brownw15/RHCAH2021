<?php 
    session_start(); 
    include 'databaseConnection.php';
    /* KEEP OR DELETE */
    /*
        //if the user isn't logged in and they access homepage, redirect them to login page
        if(!iiset($_SESSION[myUsername])){
            echo '<script>';
            echo 'for(i=0; i<1; i++){window.location.assign("home.php")}';
            echo '</script>';
        }

    */

?>
<!DOCTYPE html>
<html>
    <head>
        
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="./media/css/styles.css">
        <link rel="stylesheet" href="./media/css/redpurple.css">
        <link type="text/css" rel="stylesheet" href="themes/calendar_g.css" />
        <link type="text/css" rel="stylesheet" href="themes/calendar_green.css" />
        <link type="text/css" rel="stylesheet" href="themes/calendar_traditional.css" />
        <link type="text/css" rel="stylesheet" href="themes/calendar_transparent.css" />
        <link type="text/css" rel="stylesheet" href="themes/calendar_white.css" />
        <link rel="stylesheet" href="themes/modal_rounded.css" type="text/css" />
    <!-- helper libraries -->
        <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <!-- daypilot libraries -->
        <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
    <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/45612e4e8c.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar mb-2" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="home.php">
                    <img src="./media/images/50th-CAH-Logo-Website.png" class="navlogo" width="250" height="500">
                </a>

                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div id="navbar" class="navbar-menu my-4">
                <div class="navbar-start">
                    <a class="navbar-item" href="admin.php">
                        Settings
                    </a>
                    <a class="navbar-item" href="contact.php">
                        Help
                    </a>
                </div>
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="user">    
                            <span class="icon-text">
                                <span class="icon"> <i class="far fa-user"></i></span>
                                <span>Welcome Back <?php echo $_SESSION['name']; ?>!</span>
                                <span><?php echo $_SESSION['access'] ?> Access</span>
                            </span>
                    </div>
                    <div class="navbar-item">  
                        <div class="buttons">
                            <a class="button is-light logoutButton" name="logout">
                                Log out
                            </a>
                        </div>
                    </div>
                </div>
            </div>		
        </nav>

        <div class="main has-text-white my-4" style="display:flex">
    
        </div>
    </body>
    <script type="text/javascript">

    </script>
</html>

