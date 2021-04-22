
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
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" /> 
    <!-- <link rel="stylesheet" href="./media/css/styles.css"> -->
    
</head>
	<body>
		<style>
		.error {color: #FF0000;}
		</style>
		<nav class="navbar mb-2" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="admin.php">
                <img src="./media/images/50th-CAH-Logo-Website.png" class="navlogo" width="150" height="170">
            </a>
        </div>
        <div id="navbar" class="navbar-menu my-4">
            <div class="navbar-start">
                <a class="navbar-item" href="contact.php">
                    Help
                </a>
            </div>
            <div class="navbar-end">
            </div>
        </div>		
    </nav>
<?php
		include 'databaseConnection.php'; 
		$confirm2 = $confirm1 = $NoMatchError = $NoInputError = $InputError = $data =  $confirmError = $NotExistErr = "";

//Start of Table View for Accounts
	$readAcc = $link->prepare("select firstname, lastname, id , description FROM account ORDER BY id ASC");
	$readAcc->execute();
	$readResult = $readAcc->get_result();
	$accList = $readResult->fetch_all(MYSQLI_ASSOC);
	
	echo '<div class=" my-2 px-2 container is-flex is-flex-direction-row ">';
		echo '<table class= "table is-bordered is-striped is-hoverable align-self-flex-auto mx-2 px-2">';
		echo '<tr><td class="subtitle is-4"> Staff Account Table </td> </tr>';
		echo "<tr><td> First Name </td><td> Last Name </td> <td> ID </td></tr>";
		foreach( $accList as  $readResult )
		{	
			$data = $readResult['description'];
			if($data == "staff")
			{
					$data = $readResult['firstname'];
					echo "<tr><td>".$data." </td>";
					$data = $readResult['lastname'];
					echo "<td>".$data." </td>";
					$data = $readResult['id'];
					echo "<td>".$data."</td></tr>"; 
			}
		}
	/*	echo "</table> <br> <br>";
		echo '<table class="table is-bordered is-striped is-hoverable">';
		echo '<tr><td class="subtitle is-4"> Child Account Table </td> </tr>';
		echo "<tr><td> First Name </td><td> Last Name </td> <td> ID </td></tr>";
		foreach( $accList as  $readResult )
		{	
			$data = $readResult['description'];
			if($data == "child")
			{
					$data = $readResult['firstname'];
					echo "<tr><td>".$data." </td>";
					$data = $readResult['lastname'];
					echo "<td>".$data." </td>";
					$data = $readResult['id'];
					echo "<td>".$data."</td></tr>"; 
			}
		}
		echo "</table> <br><br>"; */
		
		echo '<table class=" box table is-bordered is-striped is-hoverable align-self-flex-end mx-2 px-2">';
		echo '<tr><td class="subtitle is-4"> Child Account Table </td> </tr>';
		echo "<tr><td> First Name </td><td> Last Name </td><td> ID </td></tr>";
		foreach( $accList as  $readResult )
		{	
			$data = $readResult['description'];
		if($data != "staff" && $data != "child")
			{
					$data = $readResult['firstname'];
					echo "<tr><td>".$data." </td>";
					$data = $readResult['lastname'];
					echo "<td>".$data." </td>";
					//$data = $readResult['id'];
					//echo "<td>".$data."</td></tr>"; 
			}
		}
		echo "</table> <br><br>";
	echo "</div>";
//End of Table Creation

//Start of Input Validation


	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if($_POST["confirm1"] == "" || $_POST["confirm2"] == "")
		{
			$NoInputError = "Input is Required ";

		}
		else if ($_POST["confirm1"] != $_POST["confirm2"])
			{
				$NoMatchError = "Both fields must match ";
				
			}
			else if (preg_match("/^[0-9]*$/", $_POST["confirm1"]) == false)
			{
				$InputError = "Data Entered must be a set of numbers 0 - 9 ";
			}
			else
			{
				$confirm1 = test_input($_POST["confirm1"]);
				//Test Code :  echo $confirm1;
				foreach ($accList as $readResult)// check if the id actually exists
				{
					if($confirm1 == $readResult['id'])
					{
						
						//echo $confirm1;
							$deletion = $link->prepare("DELETE FROM account WHERE id = ? "); //clear
							$deletion2 = $link->prepare("DELETE FROM events WHERE userID = ?");
							
							$deletion->bind_param("i",$confirm1);
							$deletion2->bind_param("i",$confirm1);
							
							$deletion->execute();
							$deletion2->execute();
							
							break;
					}
						
				}
			}
	}
		
//End of Input Validation

//start of deletion


function test_input($data)//Strips excess data and protects against exploits
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
?>


		
		<div class="container box">
			<form method ="post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<!--<span class="error"><?php echo $NoMatchError; echo $InputError; echo $NoInputError; echo $NotExistErr; ?> </span> -->
				<div class=" field">
					<label class="label">Enter ID of ACC to be Deleted</label>
					<div class="control">
						<input class="input" type="text" placeholder="e.g 733221" name="confirm1">
					</div>
				</div>

				<div class="field">
					<span class="error"><?php echo $NoMatchError; echo $InputError; echo $NoInputError; echo $NotExistErr; ?> </span>
					<label class="label">Re-Enter ID of Account to be Deleted</label>
					<div class="control">
						<input class="input" type="email" placeholder="e.g.733221" name="confirm2">
					</div>

					<div class="control">
						<button class="button is-success is-light my-2 px-2" type ="submit" name ="submit">Submit</button>
						<button class="button is-info is-light my-2 px-2"><a href="home.php">Go Back</a></button>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>