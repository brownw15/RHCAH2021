<!DOCTYPE html>
<?php
	session_start(); // end in logout page
?>
<html>
<head>
	<link rel="stylesheet" href="./media/css/styles.css">
	<title>Rock Hill Childrens Attention Home Calendar Login Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- daypilot libraries -->
    <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
	<script src="https://kit.fontawesome.com/45612e4e8c.js" crossorigin="anonymous"></script>
</head>

<body>
<div id="loading "class="pageloader is-active"></div>
	<section class="hero is-info is-fullheight"> 
		<div class="hero-head">
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
				</div>		
			</nav>
		</div>
		<div class="hero-body">
			<div class="container has-text-centered">
				<div id="loginForm" class="box login-box"> 
					<form class="is-centered" action="loginSubmission.php" method="post">
						<h1 class="title is-1 has-text-weight-semibold has-text-black is-family-secondary">Login</h1>

						<div class="field is-grouped has-addons is-centered">
							<div class="control has-icons-left">
								<input class="input" id="inputUsername" name="username" type="text" placeholder="Username or Email" size="26" maxlength="30" minlength="3" autocomplete="off" pattern="[^$#@%><\][\\\x22,;|]+" title="enter at least 3 characters: a-z, 0-9, .':/~-_()" required >
								<span class="icon is-small is-left"> <i class="fas fa-user"></i></span>
							</div>
							<div class="control has-icons-left">
								<input class="input" type="password" name="userPassword" placeholder="Password" size="26" maxlength="30" minlength="1" autocomplete="off" pattern="[^#@()/><\][\\\x22,;|]+" title="enter at least 7 characters: a-z, 0-9, !.':/~-$|*%" required >
								<span class="icon is-small is-left"> <i class="fas fa-lock"></i></span>
							</div>
						</div>
						<div class="field is-grouped is-grouped-center">
							<div class="control">
								<button class="button is-success is-light" type="submit" name="loginSubmit" onclick="Loader()"> Submit</button>
							</div>
							<div class="control">
								<button class="button is-primary is-light" type="button" onclick="toggleForm()"> Sign Up</button>
							</div>
						</div>
						<p><a class="has-text-black" href="password_reset.php">Forgot Password</a></p>
					</form>
				</div>
				<form id="signupForm" class="box" action="signupSubmission.php" method="post" style="display:none">
					<h1 class="title is-1 has-text-weight-semibold is-family-monospace has-text-black">Sign Up</h1>
					</hr>

					<div class="field is-grouped">
						<div class="control">
							<input class="input" type="text" id="fname" name="firstName" placeholder="First Name" size="26" maxlength="100" autocomplete="off" pattern="[A-Za-z]+" title="use characters: a-z">
						</div>
						<div class="control">
							<input class="input" type="text" id="lname" name="lastName" placeholder="Last Name" size="26" maxlength="100" autocomplete="off" pattern="[A-Za-z]+" title="use characters: a-z">
						</div>
					</div>

					<div class="field has-addons">
						<div class="control has-icons-left">
							<input class="input" type="text" id="inputEmail" id="uEmail" name="email" placeholder="Email" size="26" maxlength="100" minlength="7" autocomplete="off" pattern="[A-Za-z0-9_-]+@[a-z0-9-]+.[a-z]{2,}$" title="Email Format Requires @ and ." required>
							<span class="icon is-small is-left">
      							<i class="fas fa-envelope"></i>
    						</span>
						</div>
					</div>
					
					<div class="field">
						<div class="control has-icons-left">
							<input class="input" id="inputSignupUsername" name="username" type="text" placeholder="Username" size="26" maxlength="30" minlength="3" autocomplete="off" pattern="[^$#@%><\][\\\x22,;|]+" title="enter at least 3 characters: a-z, 0-9, .':/~-_()" required >
							<span class="icon is-small is-left"> <i class="fas fa-user"></i></span>
						</div>
					</div>

					<div class="field has-addons">
						<div class="control has-icons-left">
							<input class="input" type="password" id="inputPassword" name="userPassword" placeholder="Password" size="26" maxlength="100" minlength="7" autocomplete="off" pattern="[^#@()/><\][\\\x22,;|]+" title="Must contain 7 or more characters that are of at least one number, and one uppercase and lowercase letter. use characters: a-z, 0-9, !.':/~-$|*%" required>
							<span class="icon is-small is-left">
								<i class="fas fa-lock"></i>
							</span>
						</div>
					</div>
					
					<div class="field is-grouped is-grouped-right">
						<div class="control">
							<button class="button is-primary is-light" type="button"  onclick="toggleForm()">Back to login</button>
						</div>
						<div class="control">
							<button name="signupSubmit" type="submit" class="button is-success is-light"> Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>

	</section>
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

function Loader(){
	var el = document.getElementById("loading");
	el.classList.toggle("is-active");
}
</script>
</body>
<style>
  
html,body {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
}
.hero.is-info {
  background: linear-gradient(
      rgba(0, 0, 0, 0.5),
      rgba(0, 0, 0, 0.5)
    ), url('https://unsplash.it/1200/900?random') no-repeat center center fixed;
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