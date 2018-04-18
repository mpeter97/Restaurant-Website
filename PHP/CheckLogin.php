<?php
	session_start();
	if (isset($_GET["enteredUsername"])) {
		$username = $_GET["enteredUsername"];
	} else {
		$username = "";
	}
	if (isset($_GET["enteredPassword"])) {
		$password = $_GET["enteredPassword"];
	} else {
		$password = "";
	}
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	$sql = "SELECT Username
			FROM user_login
			WHERE Username = '" . $username . "' AND Password = '" . $password . "';";
	$result = $pdo->query($sql);
	if (!$result->fetch()) {
		if (strcmp($_SESSION["registrationSuccess"], "false") != 0) {
			$_SESSION["loginSuccess"] = "false";
		}
	} else {
		$result = $pdo->query($sql);
		while ($row = $result->fetch()) {
			if ($row["Username"] != NULL) {
				$_SESSION["username"] = $username;
				$_SESSION["loginSuccess"] = "true";
			}
		}
	}
	
	
	
?>