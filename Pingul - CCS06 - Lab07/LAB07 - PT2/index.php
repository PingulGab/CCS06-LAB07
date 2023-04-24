<?php

require "vendor/autoload.php";

session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
</head>
<body>

	<h1>Analogy Exam Registration</h1>
	<h3>Kindly register your basic information before starting the exam.</h3>

	<form method="POST" action="register.php">
		Enter your full name:<br />
		<input type="text" name="complete_name" placeholder="Complete Name" required />
		<br />
		<input type="email" name="email" placeholder="Email Address" required/>
		<br />
		<input type="date" name="birthdate" required/>
		<br />
		<input type="submit">
	</form>

</body>
</html>