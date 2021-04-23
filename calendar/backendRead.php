<?php
	//this file reads all the events of a user and populates them onto the calendar 
    session_start();
    include 'databaseConnection.php';
	date_default_timezone_set('America/New_York');
	header('Content-Type: application/json');
	
	//this checks whether the id of the user is a child or a staff
    if($_SESSION['childMenuValue'] == ""){ 
        $id = $_SESSION['userID']; 
    }
    else{
        $id = $_SESSION['childMenuValue'];
    }
	//selecting events associated with user
	$read = $link->query('SELECT * FROM events WHERE userID = '. $id .'');
	
	//select query needs to be updated to match.
	$result = $read->fetch_all(MYSQLI_ASSOC);
	
    class Event {
		public $id;
		public $text;
		public $start;
		public $end;
	}
	//populates all the events into an array	
    $events = [];
    foreach($result as $row) {
		$e = new Event();
		$e->id = $row['id'];
		$e->text = "<strong>" . $row['name'] . "</strong>" . "<br>" . "Location: " . $row['loc'] . "<br>";
		$e->start = $row['start'];
		$e->end = $row['end'];
		$events[] = $e;
    }
	
	//have to free result set.
	$read->free_result();
	//returned back to home page	
    echo json_encode($events);
?>