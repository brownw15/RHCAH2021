<?php
    session_start();
    include 'databaseConnection.php';
	header('Content-Type: application/json');
	
    if($_SESSION['childMenuValue'] == ""){ 
        $id = $_SESSION['userID']; //NEED TO PULL USERID WHEN THEY SIGNUP!!!
    }
    else{
        $id = $_SESSION['childMenuValue'];
    }
	//THIS NEEDS TO BE PARAMETERIZED!!! QUERY NEEDS TO BE UPDATED TO REFLECT PER ACCOUNT
	$read = $link->query('SELECT * FROM events WHERE userID = '. $id .'');
	
	//select query needs to be updated to match.
	$result = $read->fetch_all(MYSQLI_ASSOC);
	
    class Event {
		public $id;
		public $text;
		public $start;
		public $end;
	}
	
    $events = [];
    foreach($result as $row) {
		$e = new Event();
		$e->id = $row['id'];
		$e->text = $row['name'];
		$e->start = $row['start'];
		$e->end = $row['end'];
		$events[] = $e;
    }
	
	//have to free result set.
	$read->free_result();
	
    echo json_encode($events);
?>