<?php
	session_start(); // end in logout page
?>
<html>
<head>
	<link rel="stylesheet" href="loginStyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="bulma.min.css">
	<title> Log in</title>
</head>

<body>


<div class="Container">

	<div class="loginHead">
		<h2 id="headerText">Login</h2>
	</div>

<div class= field id="loginForm">
<div class="inputSection">

	<form action="loginSubmission.php" method="post">

	<div class="loginUserN">
		<input type="text" id="inputUsername" name="username" placeholder="username" size="26" maxlength="30" minlength="3" autocomplete="off" pattern="[^$#@%><\][\\\x22,;|]+" title="enter at least 3 characters: a-z, 0-9, .':/~-_()" required>
	</div>


	<div class="loginPassW">
		<input type="password" id="inputPassword" name="userPassword" placeholder="password" size="26" maxlength="30" minlength="1" autocomplete="off" pattern="[^#@()/><\][\\\x22,;|]+" title="enter at least 7 characters: a-z, 0-9, !.':/~-$|*%" required>
	</div>

	<div class="submitButton">
		<input type="submit" value="login" id="submit" name="submit"> 
	</div>

	</form>
	<p>Don't have an account? <button onclick="toggleForm()">Sign Up</button></p>
</div>
</div>


<div id="signupForm" style="display: none">
<div class="inputSection" style="height: 300px">

	<form action="signupSubmission.php" method="post">
		

	<div class="firstname loginUserN">
		<input class="input" type="text" id="inputUsername" name="firstname" placeholder="firstname" size="26" maxlength="100" autocomplete="off" pattern="[A-Za-z]+" title="use characters: a-z">
	</div>


	<div class="lastname loginUserN">
		<input class="input" type="text" id="inputPassword" name="lastname" placeholder="lastname" size="26" maxlength="100" autocomplete="off" pattern="[A-Za-z]+" title="use characters: a-z">
	</div>

	<div class="signUpUserN loginUserN">
		<input type="text" id="inputUsername" name="username" placeholder="username" size="26" maxlength="100" minlength="3" autocomplete="off" pattern="[^$#@%><\][\\\x22,;|]+" title="use at least 3 characters: a-z, 0-9, .':/~-_()" required>
	</div>


	<div class="signUpPassW loginUserN">
		<input type="password" id="inputPassword" name="userPassword" placeholder="password" size="26" maxlength="100" minlength="7" autocomplete="off" pattern="[^#@()/><\][\\\x22,;|]+" title="Must contain 7 or more characters that are of at least one number, and one uppercase and lowercase letter. use characters: a-z, 0-9, !.':/~-$|*%" required> 
	</div>

	<div class="control email loginUserN">
		<input type="text" id="inputPassword" name="email" placeholder="email" size="26" maxlength="100" minlength="7" autocomplete="off" pattern="[^$#%*:'~()/><\][\\\x22,;|]+" title="use characters: a-z, 0-9, .@" required>
	</div>





	<div class="submitButton">
		<input class="button" type="submit" value="sign up!" id="submit" name="submitS"> <!-- it isnt good practice two have two types of button and submit  i took it out  all it does is take the first type -->

	</div>

	</form class="field">
	<p>Already have an account? <button class="button is-primary is-light"onclick="toggleForm()">Login</button></p>
</div>
</div>


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