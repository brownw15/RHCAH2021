
<?php
{
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'updatedcalendardb');
	

	/* Attempt to connect to MySQL database */
	$link = new mysqli (DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
	 
	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
		
		
	}
		//OBJECT ORIENTED SQLI MAKE SURE YOU ARE NOT USING PROCEDURAL
		//Set ID to the ID of the CHILD ACCOUNT SELECTED IN HOME.PHP ON SUBMIT NOTHING ELSE NEEDS TO BE DONE.
		
		
		$ID = "4";
		
		
		

		//SELECTS NAME, START DATE END DATE
		$stmt = $link->prepare("select `events`.`name`, `events`.`start` , `events`.`end`
		from `events` 
		inner join `account` on `events`.`accountID` = `account`.`id`
		WHERE `events`.`accountID` = ?
		ORDER BY `events`.`start` ASC
		");
		$stmt->bind_param("i", $ID);
		$stmt->execute();
		$result = $stmt->get_result();
		$schedule = $result->fetch_all(MYSQLI_ASSOC);
		/*
		Schedule Holds the Entire Query Results as an Array with the following format.
			array(3) {
				  [0]=>
				  array(3) {
					["name"]=>
					string(13) "Class - Math "
					["start"]=>
					string(19) "2021-03-16 09:45:00"
					["end"]=>
					string(19) "2021-03-16 11:45:00"
		
		
		*/
		
		//Test Code to Check Array values
		/*	echo "<pre>";
					var_dump($schedule);
					echo "</pre>";
		*/
		echo "<table>";//Test Table
		
				//OUTPUT TO THE CALENDAR AREA
				foreach($schedule as $result )
				{
					$data = $result['name'];
					echo "<tr><td>".$data." Starts at : </td>";
					$data = $result['start'];
					echo "<td>".$data." Ends At : </td>";
					$data = $result['end'];
					echo "<td>".$data."</td></tr>";
				}
			
		echo "</table>";//Emd of Test Table
		
		 
/* PURPOSE?
header('Content-Type: application/json');
echo json_encode($response);
*/
} ?>
