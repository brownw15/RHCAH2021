<!DOCTYPE html>
<?php
	session_start(); // end in logout page
?>
<html>
<head>
	<link rel="stylesheet" href="./media/css/styles.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Rock Hill Childrens Attention Home Calendar Login Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- daypilot libraries -->
    <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
	<script src="https://kit.fontawesome.com/45612e4e8c.js" crossorigin="anonymous"></script>
</head>

<body>
<nav class="navbar mb-2" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="home.php">
            <img src="./media/images/logo.png" id="navlogo" width="100" height="200">
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
               Settings
            </a>
            <a class="navbar-item">
               Help
            </a>
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
	<div class="container is-centered block" style="width:600px">
		<form id="loginForm" class="box" action="loginSubmission.php" method="post">
			<h1 class="title is-1 has-text-weight-semibold is-family-monospace">Login</h1>
			<div class="field">
				<div class="control">
					<input class="input" id="inputUsername" name="username" type="text" placeholder="Username or Email" size="26" maxlength="30" minlength="3" autocomplete="off" pattern="[^$#@%><\][\\\x22,;|]+" title="enter at least 3 characters: a-z, 0-9, .':/~-_()" required >
				</div>
			</div>

			<div class="field">
				<div class="control">
					<input class="input" type="password" name="userPassword" placeholder="Password" size="26" maxlength="30" minlength="1" autocomplete="off" pattern="[^#@()/><\][\\\x22,;|]+" title="enter at least 7 characters: a-z, 0-9, !.':/~-$|*%" required >
				</div>
			</div>
			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button class="button is-success is-light" type="submit" name="loginSubmit"> Submit</button>
				</div>
				<div class="control">
					<button class="button is-link is-light" type="button" onclick="toggleForm()"> Sign Up</button>
				</div>
			</div>
		</form>

		<form id="signupForm" class="box" action="signupSubmission.php" method="post" style="display:none">
			<h1 class="title is-1 has-text-weight-semibold is-family-monospace">Sign Up</h1>

			<div class="field is-grouped">
				<div class="control">
					<input class="input" type="text" id="fname" name="firstName" placeholder="First Name" size="26" maxlength="100" autocomplete="off" pattern="[A-Za-z]+" title="use characters: a-z">
				</div>
				<div class="control">
					<input class="input" type="text" id="lname" name="lastName" placeholder="Last Name" size="26" maxlength="100" autocomplete="off" pattern="[A-Za-z]+" title="use characters: a-z">
				</div>
			</div>

			<div class="field">
				<div class="control">
				<input class="input" type="text" id="inputEmail" id="uEmail" name="email" placeholder="Email" size="26" maxlength="100" minlength="7" autocomplete="off" pattern="[^$#%*:'~()/><\][\\\x22,;|]+" title="use characters: a-z, 0-9, .@" required>
				</div>
			</div>
			
			<div class="field">
				<div class="control">
					<input class="input" id="inputUsername" name="username" type="text" placeholder="Username" size="26" maxlength="30" minlength="3" autocomplete="off" pattern="[^$#@%><\][\\\x22,;|]+" title="enter at least 3 characters: a-z, 0-9, .':/~-_()" required >
				</div>
			</div>

			<div class="field">
				<div class="control">
					<input class="input" type="password" id="inputPassword" name="userPassword" placeholder="Password" size="26" maxlength="100" minlength="7" autocomplete="off" pattern="[^#@()/><\][\\\x22,;|]+" title="Must contain 7 or more characters that are of at least one number, and one uppercase and lowercase letter. use characters: a-z, 0-9, !.':/~-$|*%" required>
				</div>
			</div>
			
			<div class="field is-grouped is-grouped-right">
				<div class="control">
					<button class="button is-link is-light" type="button"  onclick="toggleForm()">Back to login</button>
				</div>
				<div class="control">
					<button name="signupSubmit" type="submit" class="button is-success is-light"> Submit</button>
				</div>
			</div>
		</form>
	</div>
	
<script>
function toggleForm(){
	//this function toggles showing the login form and the signup form when the user clicks the 'signup' button at the bottom of login form and the 'login' button at the bottom of the sign up form
	var loginElement = document.getElementById("loginForm"); //make an object for the login and sign up form element
	var signupElement = document.getElementById("signupForm");
	var headerText = document.getElementById("headerText");
	if(loginElement.style.display === "none"){
		loginElement.style.display = "block";
		signupElement.style.display = "none";
		headerText.innerHTML = "Login";
	}
	else{
		loginElement.style.display = "none";
		signupElement.style.display = "block";
		headerText.innerHTML = "Sign Up";
	}
}
</script>
</body>
</html>