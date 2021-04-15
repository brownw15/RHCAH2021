<?php
		include 'databaseConnection.php'; 
		$pass = $ID = $confirm = $emptyErr = $matchErr = $formatErr = $password_length = "";


		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			if ($_POST["newpass"] != $_POST["confpass"]) 
			{
				$matchErr = "Passwords must Match ";
			}
			else
			{
				$pass = test_input($_POST["newpass"]);
				$ID = test_input($_POST["ID"]);
				
				if(pass_Strength($pass) == false)
				{
					$formatErr = " Password must be atleast 8 characters long AND include atleast 1 special character !@#$%^&* OR a number ";		
				}
				else { 
					// echo $pass."<BR>";
					$pass = hash("sha256", $pass);
					//echo $pass."<BR>";
					
					$stmt = $link->prepare("UPDATE `account` 
					set `userPassword` = ? 
					where id = ?");
					$stmt->bind_param('ss',$pass, $_POST['ID']);
					$stmt->execute();
					
					//echo "line 21";*/
					} 
			}
					
		}	
			
			
	
function pass_Strength($pass)//check password strength
{
	
	$password_length =	7;

	$returnval = True;
	if (strlen($pass) < $password_length) {$returnval = false; }
	if (!preg_match("#[0-9]+#", $pass) && !preg_match("/!@#$%^&*/", $pass )){$returnval = false;}//check for number OR special case
	if (!preg_match("#[a-z]+#", $pass)){$returnval = false; }// check for lowercase optional
	if (!preg_match("#[A-Z]+#", $pass)){$returnval = false;}
	
	return $returnval; 
	
		
}
function test_input($data)//Strips excess data and protects against exploits
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>


<html>
<head>
    <link rel="stylesheet" href="./media/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
    <style>
    
    </style>
    <div class="container">
        <div class="box has-text-black">
            <form class="is-centered" method ="post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label class="subtitle is-2">Password Recovery</label> </br>

                <div class="field has-addons is-group-centered mx-2 px-2">
                    <input class="input" type = "text" name=newpass placeholder="New Password">
                    <span class="error"> <?php echo $emptyErr; echo $matchErr; echo $formatErr; ?> </span>
                    <input class="input" type = "text" name=confpass placeholder="Confirm New Password">
                </div>
                <div class="field">
                    <input class="input " type = "text" name=ID placeholder="Id Number of Account">
                    <button class="button my-2 is-success is-light is-centered" type="submit" onclick="redirect()">Submit Changes</button>
					<button class="button is-warning is-light"><a href="home.php">Go Back</a></button>
                </div>
            </form>
        </div>
    </div>

<script>
    function redirect() {
        window.location("index.php");
        return false;
    }
</script>
</body>
</html>