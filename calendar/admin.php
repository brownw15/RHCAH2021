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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Free Bulma template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.9.0-->
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
    
</head>

<body>

    <!-- START NAV -->
    <nav class="navbar mb-2" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="home.php">
                <img src="./media/images/50th-CAH-Logo-Website.png" class="navlogo" width="250" height="500">
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
    <!-- END NAV -->
    <div class="container">
        <div class="columns">
            <div class="column is-2 ">
                <aside class="menu is-hidden-mobile">
                    <p class="menu-label">
                        Administration
                    </p>
                    <ul class="menu-list">
                        <li>
                            <a>Manage Your Users</a>
                            <ul>
                                <li><a>View Members</a></li>
                                <li><a>Add a child</a></li>
                                <li><a>Remove a child</a></li>
                                <li><a>Generate Reports</a><li>
                            </ul>
                        </li>
</ul>
                </aside>
            </div>
            <div class="column is-9">
                <nav class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li class="is-active"><a href="#" aria-current="page">Admin</a></li>
                    </ul>
                </nav>
                <section class="hero is-primary welcome is-small">
                    <div class="hero-body">
                        <div class="container">
                            <h1 class="title">
                                Hello, <span><?php echo $_SESSION['name']; ?>!</span>
                            </h1>
                            <h2 class="subtitle">
                                Have a great day!
                            </h2>
                        </div>
                    </div>
                </section>
                <section class="info-tiles">
                    <div class="tile is-ancestor has-text-centered">
                        <div class="tile is-parent">
                            <article class="tile is-child box">
                                <p class="title">439</p>
                                <p class="subtitle">Users</p>
                            </article>
                        </div>
                        
                        <div class="tile is-parent">
                            <article class="tile is-child box">
                                <p class="title">30</p>
                                <p class="subtitle">Events today</p>
                            </article>
                        </div>
                    </div>
                </section>
                <div class="columns">
                    <div class="column is-6">
                        <div class="card events-card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    Users
                                </p>
                                <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                </a>
                            </header>
                            <div class="card-table">
                                <div class="content">
                                    <table class="table is-fullwidth is-striped">
                                        <tbody>
                                            <tr>
                                                <td width="5%"><i class="fa fa-user-o"></i></td>
                                                <td>Son Goku</td>
                                                <td class="level-right"><a class="button is-small is-primary" href="#">Actions</a></td>
                                            </tr>
                                            <tr>
                                                <td width="5%"><i class="fa fa-bell-o"></i></td>
                                                <td>Tj Wynn</td>
                                                <td class="level-right"><a class="button is-small is-primary" href="#">Actions</a></td>
                                            </tr>
                                            <tr>
                                                <td width="5%"><i class="fa fa-bell-o"></i></td>
                                                <td>Nick Paul</td>
                                                <td class="level-right"><a class="button is-small is-primary" href="#">Actions</a></td>
                                            </tr>
                                            <tr>
                                                <td width="5%"><i class="fa fa-bell-o"></i></td>
                                                <td>Lorum ipsum dolem aire</td>
                                                <td class="level-right"><a class="button is-small is-primary" href="#">Actions</a></td>
                                            </tr>
                                            <tr>
                                                <td width="5%"><i class="fa fa-bell-o"></i></td>
                                                <td>Lorum ipsum dolem aire</td>
                                                <td class="level-right"><a class="button is-small is-primary" href="#">Actions</a></td>
                                            </tr>
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <footer class="card-footer">
                                <a href="#" class="card-footer-item">View All</a>
                            </footer>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="card">
                            <header class="card-header">
                                <p class="card-header-title">
                                    User Search
                                </p>
                                <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                </a>
                            </header>
                            <div class="card-content">
                                <div class="content">
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input is-large" type="text" placeholder="">
                                        <span class="icon is-medium is-left">
                      <i class="fa fa-search"></i>
                    </span>
                                        <span class="icon is-medium is-right">
                      <i class="fa fa-check"></i>
                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script async type="text/javascript" src="../js/bulma.js"></script>
</body>
<html>