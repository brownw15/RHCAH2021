<?php 
    session_start(); 
    include 'databaseConnection.php';
 ///FOR ADMIN PAGE

    //get number of users in database
    //get number of users in database
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.9.0-->
    <link rel="stylesheet" href="./media/css/styles.css">
  
    <!-- <link rel="stylesheet" href="./media/css/styles.css"> -->
    
</head>

<body>

    <!-- START NAV -->
    <nav class="navbar mb-2" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="home.php">
                <img src="./media/images/50th-CAH-Logo-Website.png" class="navlogo" width="150" height="170">
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
                        <a class="button is-light logoutButton" name="logout" href = "index.php">                        
                            Log out
                            </a>
                    </div>
                    </div>
            </div>
        </div>		
    </nav>
    <!-- END NAV -->
    
        <div class="columns">
            <div class="column is-2 ">
                <aside class="menu is-hidden-mobile my-2 mx-4">
                    <p class="menu-label">
                        Administration
                    </p>
                    <ul class="menu-list">
                        <li>
                            <a>Manage Your Users</a>
                            <ul>
                                <li><a class = "reports" href = "reports.php">Generate Reports</a><li>
                                <li><a href="delete_acc.php">Remove A User</a></li>
                                <li><a href="permissionChange.php">Change Permissions</a></li>
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
                                <p class="title"><?php
                                     //get number of users in database
                                        //include 'databaseConnection.php';
                                        $sql="SELECT firstname FROM account";
                                        if ($result=mysqli_query($link,$sql))
                                        {
                                            $rowcount=mysqli_num_rows($result);
                                            echo $rowcount;
                                            mysqli_free_result($result);
                                        }
                                    ?></p>
                                <p class="subtitle">Users</p>
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
                                        <?php
                                            //get list of users
                                            $resultSet = $link->query("SELECT id, firstname, lastname FROM account ORDER BY firstname ASC");
                                            while($rows = $resultSet->fetch_assoc())
                                                {
                                                    $fnames = $rows['firstname']; 
                                                    $lnames = $rows['lastname'];
                                                    echo "<tr>
                                                    <td width='5%'><i class='fa fa-user-o'></i></td>
                                                    <td>" .$fnames . " " . $lnames . "</td>
                                                    </tr>";
                                                }
                                        ?>
                                          
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
                        
                        
                    </div>
                </div>
            </div>
        </div>
    <script async type="text/javascript" src="../js/bulma.js"></script>
</body>
<html>