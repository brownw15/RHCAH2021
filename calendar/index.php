<?php
	session_start(); // end in logout page

?>
<html>
<head>
	<link rel="stylesheet" href="loginStyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title> Log in</title>
</head>

<body>


<div class="mainContainer">

	<div class="loginHead">
		<h2>Login:</h2>
	</div>


<div class="inputSection">

	<form action="home.php" method="post">

	<div class="loginUserN">
		<input type="text" id="inputUsername" name="username" placeholder="username" size="26" maxlength="30" minlength="3" autocomplete="off" pattern="[^$#@%><\][\\\x22,;|]+" title="enter at least 3 characters: a-z, 0-9, .':/~-_()" required>
	</div>


	<div class="loginPassW">
		<input type="password" id="inputPassword" name="userPassword" placeholder="password" size="26" maxlength="30" minlength="1" autocomplete="off" pattern="[^#@()/><\][\\\x22,;|]+" title="enter at least 7 characters: a-z, 0-9, !.':/~-$|*%" required>
	</div>

	<div class="loginButton">
		<input type="submit" value="login" id="submit" name="submit"> 

	</div>

	</form>

</div>


</div>

</body>
</html>