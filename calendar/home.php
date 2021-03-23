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
    <title>Rock Hill Childrens Attention Home Calendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="./media/css/styles.css">
    <link rel="stylesheet" href="./media/css/redpurple.css">
    <link type="text/css" rel="stylesheet" href="themes/calendar_g.css" />
    <link type="text/css" rel="stylesheet" href="themes/calendar_green.css" />
    <link type="text/css" rel="stylesheet" href="themes/calendar_traditional.css" />
    <link type="text/css" rel="stylesheet" href="themes/calendar_transparent.css" />
    <link type="text/css" rel="stylesheet" href="themes/calendar_white.css" />
<!-- helper libraries -->
    <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- daypilot libraries -->
    <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
<!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/45612e4e8c.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="home.php">
            <img src="./media/images/logo.png" width="130 " height="150">
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbar" class="navbar-menu my-4">
            <div class="navbar-start">

            <a class="navbar-item">
                Documentation
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                More
                </a>

                <div class="navbar-dropdown">
                <a class="navbar-item">
                    About
                </a>
                <a class="navbar-item">
                    Jobs
                </a>
                <a class="navbar-item">
                    Contact
                </a>
                <hr class="navbar-divider">
                <a class="navbar-item">
                    Report an issue
                </a>
                </div>
            </div>
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
            
    </nav>

    <div class="main has-text-white my-4">
        <div class="calendar-widget mx-2">
            <div id="nav"> </div>
        </div>

        <div class="dropdown container">
        <!-- Include themes -->
            <div>
                <h3> Theme: <select id="theme"> </h3>
                <div class="dropdown-menu" id="dropdown-menu1" role="menu">
                    <div class="dropdown-content">
                        <option value="calendar_default">Default</option>
                        <option value="calendar_white">White</option>
                        <option value="calendar_g">Google-Like</option>
                        <option value="calendar_green">Green</option>
                        <option value="calendar_traditional">Traditional</option>
                        <option value="calendar_transparent">Transparent</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
            <?php
            //$mysqli = NEW MySqli('localhost','root','','testforcalendar');
            $resultSet = $link->query("SELECT id, firstname, lastname FROM account");
            ?>
            <div class="selectchild"> 
            <form method="post">

            <select class="dropdown-item" id="childMenu" name ="childMenu" value="Select User">
            <?php
            if(isset($_POST['childMenu'])){
            $_SESSION['childMenuValue'] = $_POST['childMenu'];
            }
            if($_SESSION['access'] == 'staff')
            {
            while($rows = $resultSet->fetch_assoc())
            {
            $fnames = $rows['firstname']; 
            $lnames = $rows['lastname'];
            $ids = $rows['id'];
            echo "<option value='$ids'>$fnames ".  $lnames ."</option>";
            }
            } 
            ?>
            </select>
            <input class="button" type="submit" value="Select" style="float:left;"/>
            </form>
            </div>
            </div>
            </div>
        <!-- Placeholder for daypilot lite calendar widget -->
        <div class="container calender" id="dp"></div>
  
        <div class="Upcoming has-text-white" style="margin-top: 15px; margin-left: 160px; width: 85%; border: .7px solid #e3e3e3; height: 80px; padding: 10px">
            <h1>Upcoming...</h1>
            "Company Potlock" &nbsp; &nbsp; <i class="fa fa-calendar" aria-hidden="true"></i> Next Friday  &nbsp; &nbsp; <i class="fa fa-map-marker" aria-hidden="true"></i> Location: On site
            &nbsp; &nbsp; <i class="fa fa-clock-o" aria-hidden="true"></i> 5:00 - 6:30p
        </div>  
    </div>

    <div class="clear">
    </div>
    <script type="text/javascript">
        //get access type
        var access = "<?php echo $_SESSION['access']; ?>";
        //create the monthly calendar widget on the left
        var nav = new DayPilot.Navigator("nav");
        nav.showMonths = 3;
        nav.skipMonths = 3;
        nav.selectMode = "week";
        nav.onTimeRangeSelected = function(args) {
            dp.startDate = args.day;
            dp.update();
            loadEvents();
        };
        nav.init();
        //initialize the main calendar view
        var dp = new DayPilot.Calendar("dp");
        dp.viewType = "Week";
        dp.eventDeleteHandling = "Update";

        // Nick Check this out
        //$("div").removeAttr("style");

        //below are the main functions you can perform on the calendar
        //each function comunicates data to the php backend functions to process
        
        dp.onEventDeleted = function(args) {
            if(access === "staff"){
            $.post("backendDelete.php",
                {
                    id: args.e.id()
                },
                function() {
                    console.log("Deleted.");
                });
                
            var processURL = 'trackStats.php';
            var data = {'type': 'delete',
                        'eventId': args.e.id()
                        };
            $.post(processURL, data, function(response){
                console.log("Stats Updated.");
            });

            }
        };

        dp.onEventMoved = function(args) {
            if(access === "staff"){
            $.post("backendMove.php",
                    {
                        id: args.e.id(),
                        newStart: args.newStart.toString(),
                        newEnd: args.newEnd.toString()
                    },
                    function() {
                        console.log("Moved.");
                    });

            var processURL = 'trackStats.php';
            var data = {'type': 'edit',
                        'start': args.newStart.toString(),
                        'end': args.newEnd.toString(),
                        'eventId': args.e.id()
                        };
            $.post(processURL, data, function(response){
                console.log("Stats Updated.");
            });

            }
        };

        dp.onEventResized = function(args) {
            if(access === "staff"){
            $.post("backendResize.php",
                    {
                        id: args.e.id(),
                        newStart: args.newStart.toString(),
                        newEnd: args.newEnd.toString()
                    },
                    function() {
                        console.log("Resized.");
                    });

            var processURL = 'trackStats.php';
            var data = {'type': 'edit',
                        'start': args.newStart.toString(),
                        'end': args.newEnd.toString(),
                        'eventId': args.e.id()
                        };
            $.post(processURL, data, function(response){
                console.log("Stats Updated.");
            });

            }
        };

        // event creating
        dp.onTimeRangeSelected = function(args) {
            if(access === "staff"){
            var name = prompt("New event name:", "Event");
            dp.clearSelection();
            if (!name) return;
            var e = new DayPilot.Event({
                start: args.start,
                end: args.end,
                id: DayPilot.guid(),
                resource: args.resource,
                text: name
            });
            dp.events.add(e);

            $.post("backendCreate.php",
                    {
                        start: args.start.toString(),
                        end: args.end.toString(),
                        name: name
                    },
                    function() {
                        console.log("Created.");
                    });
            
            var processURL = 'trackStats.php';
            var data = {'type': 'create',
                        'start': args.start.toString(),
                        'end': args.end.toString(),
                        'eventId': DayPilot.guid(),
                        'eventName': name
                        };
            $.post(processURL, data, function(response){
                console.log("Stats Updated.");
            });

            }

        };

        dp.onEventClick = function(args) {
            alert("clicked: " + args.e.id());
        };

        dp.init();

        loadEvents();

        function loadEvents() {
            dp.events.load("backendRead.php");
        }

    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $("#theme").change(function(e) {
            dp.theme = this.value;
            dp.update();
        });

        $('.logoutButton').click(function(){
            var btnValue = $(this).val();
            var processURL = 'logout.php';
            var data = {'action': btnValue};
            $.post(processURL, data, function(response){
                alert("logout successful");
                for(i=0; i<1; i++){window.location.assign("index.php")};
            });
        });
    });
    </script>

</body>
</html>

