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
					//$pass = hash("sha256", $pass);
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
<section class="hero is-info is-fullheight">
<div class="hero-head">
<nav class="navbar mb-2" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php">
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
	</div>
	<div class="hero-body">
    <div class="container has-text-centered ">
        <div class="box has-text-black is-flex is-flex-direction-column is-justify-content-center">
            <form id="recov_form" class="is-centered" method ="post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label class="title is-2 my-2 px-4 has-text-weight-semibold has-text-black is-family-secondary">Password Recovery</label> </br>
             
				<div class="field is-grouped is-grouped-centered has-addons mx-2 px-2">

					<div class="control has-icons-left">
						<input class="input mx-2 px-2" type = "text" name=newpass placeholder="New Password">
						<span class="icon is-small is-left"><i class="fas fa-lock -o"></i></span>
                    	<span class="error"> <?php echo $emptyErr; echo $matchErr; echo $formatErr; ?> </span>
                    	<input class="input mx-2 px-2" type = "text" name=confpass placeholder="Confirm New Password">
						<span class="icon is-small is-right"><i class="fas fa-lock -o"></i></span>
					</div>
				</div>
				<div class="field is-grouped has-addons mx-2 px-2 is-grouped-centered">
					<div class="control has-icons-left ">
						<input class="input" type = "text" name=ID placeholder="Id Number of Account">
						<button class="button my-2 is-success is-light is-centered" type="submit" onclick="redirect()">Submit Changes</button>
						<button class="button is-info is-light my-2 px-2"><a href="home.php">Back to login</a></button>
					</div>
				</div>
            </form>
        </div>
    </div>
</div>
</section>
<script>
    function redirect() {
        window.location("index.php");
        return false;
    }
</script>
</body>
<style>
  
html,body {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
}
.hero.is-info {
  background:#262525 no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.hero , .hero.is-success .nav {
  -webkit-box-shadow: none;
  box-shadow: none;
}
.hero .subtitle {
  padding: 3rem 0;
  line-height: 1.5;
}
</style>
</html>