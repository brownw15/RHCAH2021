<?php 
    session_start(); 
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
	<!-- demo stylesheet -->
    	<link type="text/css" rel="stylesheet" href="media/layout.css" />

        <link type="text/css" rel="stylesheet" href="themes/calendar_g.css" />
        <link type="text/css" rel="stylesheet" href="themes/calendar_green.css" />
        <link type="text/css" rel="stylesheet" href="themes/calendar_traditional.css" />
        <link type="text/css" rel="stylesheet" href="themes/calendar_transparent.css" />
        <link type="text/css" rel="stylesheet" href="themes/calendar_white.css" />

	<!-- helper libraries -->
	<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>

	<!-- daypilot libraries -->
        <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>

</head>
<body>
        <div class="main">

            <div style="float:left; width: 160px;">
                <div id="nav"></div>
            </div>
			<h2 style="margin-bottom: 0px">Welcome Back <?php echo $_SESSION['name']; ?>!</h2>
			<p style="color: gray"><?php echo $_SESSION['access'] ?> Access</p>
            <form><input type="submit" class="logoutButton" name="logout" value="logout"/></form>
            <div style="margin-left: 160px;">
				<!-- Include themes -->
                <div class="space">
                    Theme: <select id="theme">
                        <option value="calendar_default">Default</option>
                        <option value="calendar_white">White</option>
                        <option value="calendar_g">Google-Like</option>
                        <option value="calendar_green">Green</option>
                        <option value="calendar_traditional">Traditional</option>
                        <option value="calendar_transparent">Transparent</option>
                    </select>
                </div>
				<!-- Placeholder for daypilot lite calendar widget -->
                <div id="dp"></div>
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
				
				//below are the main functions you can perform on the calendar
				//each function comunicates data to the php backend functions to process
				
                dp.onEventDeleted = function(args) {
                    if(access === "staff"){
                    $.post("backend_delete.php",
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
                    $.post("backend_move.php",
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
                    $.post("backend_resize.php",
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

                    $.post("backend_create.php",
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

