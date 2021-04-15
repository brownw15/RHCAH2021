<?php 
    session_start(); 
    include 'databaseConnection.php';

    date_default_timezone_set('America/New_York');
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
                        <a class="button is-light logoutButton" name="logout">
                            Log out
                            </a>
                    </div>
                    </div>
            </div>
        </div>		
    </nav>

    <div class="main has-text-white my-4" style="display:flex">
        <div class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Modal title</p>
                    <button class="delete" aria-label="close"></button>
                </header>

                <section class="modal-card-body">
                    <!-- Content ... -->
                </section>

                <footer class="modal-card-foot">
                    <button class="button is-success">Save changes</button>
                    <button class="button">Cancel</button>
                </footer>
            </div>
        </div>

        <div class="calendar-widget mx-2 ">
            <div id="nav"> </div>
        </div>
        <div class="container calender box px-2 mx-2" id="dp"></div>
        <div class="selectchild">
            <?php
            //$mysqli = NEW MySqli('localhost','root','','testforcalendar');
            $resultSet = $link->query("SELECT id, firstname, lastname FROM account ORDER BY firstname ASC");
            ?>
                <div> 
                    <form method="post">

                    <select class="dropdown-item" id="childMenu" name ="childMenu" value="Select User">
                        <?php
                            date_default_timezone_set('America/New_York');
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
                    <input class="button block is-primary is-light my-2" type="submit" value="Select User" style="float:left;"/>
                    </form>
                </div>
            </div>
        </div>
        <div class="field is-grouped"></div>
        <button class="clockButtonIn button">
               Clock In
        </button>

        <button class="clockButtonOut button">
               Clock Out
        </button>
  
        <div class="foot">
        </div>

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
        dp.cssClassPrefix = "basic_theme";

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
            var name = prompt("New event name:");
            var location = prompt("Location of event:");
            var typeEvent = prompt("Type of event:");
            dp.clearSelection();
            if (!name) return;
            var e = new DayPilot.Event({
                start: args.start,
                end: args.end,
                id: DayPilot.guid(),
                resource: args.resource,
            });
            dp.events.add(e);

            $.post("backendCreate.php",
                    {
                        start: args.start.toString(),
                        end: args.end.toString(),
                        name: name,
                        loc: location,
                        type: typeEvent
                    },
                    function() {
                        console.log("Created.");
                    });
            
            var processURL = 'trackStats.php';
            var data = {'type': 'create',
                        'start': args.start.toString(),
                        'end': args.end.toString(),
                        'eventId': DayPilot.guid(),
                        'eventName': name,
                        'eventLocation': location
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

        $('.clockButtonIn').click(function(){
            var processURL = 'clockIn.php';
            $.post(processURL, function(response){
                alert("You Have Clocked In");
                for(i=0; i<1; i++){window.location.assign("home.php")};
            });
        });

        $('.clockButtonOut').click(function(){
            var processURL = 'clockOut.php';
            $.post(processURL, function(response){
                alert("You Have Clocked Out");
                for(i=0; i<1; i++){window.location.assign("home.php")};
            });
        });
    });

    function css(theme) {
    DayPilot.Modal.prompt("Event name:", { theme: theme }).then(function(args) { console.log(args.result); });
  }

  $(document).ready(function() {

// Check for click events on the navbar burger icon
        $(".navbar-burger").click(function() {
            // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
            $(".navbar-burger").toggleClass("is-active");
            $(".navbar-menu").toggleClass("is-active");

        });
    });

    if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
                };

    </script>

</body>
</html>

