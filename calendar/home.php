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
    <title>HTML5/JavaScript Event Calendar</title>
        <link rel="stylesheet" href="./media/css/styles.css">
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
     <script src="https://use.fontawesome.com/f3a0fc03e6.js"></script>

</head>
<body>
        <div class="container has-text-white">

            <div class="container" style="float:right; width: 160px;">
                <div id="nav"> </div>
            </div>
             <!--Dayspedia.com widget--><iframe width='300' height='140' style='padding:0!important;margin:0!important;border:none!important;background:none!important;background:transparent!important;float: right; top:-30px' marginheight='0' marginwidth='0' frameborder='0' scrolling='no' comment='/*defined*/' src='https://dayspedia.com/widgets/digit/?v=1&iframe=eyJ3LTEyIjp0cnVlLCJ3LTExIjp0cnVlLCJ3LTEzIjp0cnVlLCJ3LTE0IjpmYWxzZSwidy0xNSI6ZmFsc2UsInctMTEwIjpmYWxzZSwidy13aWR0aC0wIjp0cnVlLCJ3LXdpZHRoLTEiOmZhbHNlLCJ3LXdpZHRoLTIiOmZhbHNlLCJ3LTE2IjoiMjRweCIsInctMTkiOiI0OCIsInctMTciOiIxNiIsInctMjEiOnRydWUsImJnaW1hZ2UiOi0yLCJiZ2ltYWdlU2V0IjpmYWxzZSwidy0yMWMwIjoiI2ZmZmZmZiIsInctMCI6dHJ1ZSwidy0zIjp0cnVlLCJ3LTNjMCI6IiMzNDM0MzQiLCJ3LTNiMCI6IjEiLCJ3LTYiOiIjMzQzNDM0Iiwidy0yMCI6dHJ1ZSwidy00IjoiIzAwN2RiZiIsInctMTgiOmZhbHNlLCJ3LXdpZHRoLTJjLTAiOiIzMDAifQ==&lang=en&cityid=1490'></iframe><!--Dayspedia.com widget ENDS-->
            <br >
			<h2 style="margin-bottom: 0px">Welcome Back <?php echo $_SESSION['name']; ?>!</h2>
			<p style="color: gray"><?php echo $_SESSION['access'] ?> Access</p>
             <button type="submit" class="button is-warning logoutButton" name="logout">Logout</button>
            <div style="margin-left: 160px;">
            <div class="dropdown">
                    <?php
                        //$mysqli = NEW MySqli('localhost','root','','testforcalendar');
                        $resultSet = $link->query("SELECT firstname, lastname FROM account");
                    ?>
                    <form method="post">
                    Select Child: <select id="dropdown-content" name ="childMenu">
                    <?php
                        if($_SESSION['access'] == 'staff')
                        {
                            while($rows = $resultSet->fetch_assoc())
                            {
                                $fnames = $rows['firstname']; 
                                $lnames = $rows['lastname'];
                                echo "<option value='$fnames'>$fnames ".  $lnames ."</option>";
                            }
                        } 
                    ?>
                    </select>
                    <input class="button" type="submit" value="Submit the form"/>
                    </form>
                </div>
            </div>
            <div>
				<!-- Include themes -->
                <div class="space dropdown">
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

				<!-- Placeholder for daypilot lite calendar widget -->
                <div class="container calender" id="dp"></div>
            </div>
            
            <div class="Upcoming has-text-white" style="margin-top: 15px; margin-left: 160px; width: 85%; border: .7px solid #e3e3e3; height: 80px; padding: 10px">
                <h1>Upcoming...</h1>
                "Company Potlock" &nbsp; &nbsp; <i class="fa fa-calendar" aria-hidden="true"></i> Next Friday  &nbsp; &nbsp; <i class="fa fa-map-marker" aria-hidden="true"></i> Location: On site
                &nbsp; &nbsp; <i class="fa fa-clock-o" aria-hidden="true"></i> 5:00 - 6:30p
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
                    dp.events.load("backend_events.php");
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

        </div>
        
        <div class="clear">
        </div>

</body>
</html>

