<?php
	session_start();
		
	$username = $_GET["enteredUsername"];
	$password = $_GET["enteredPassword"];

	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	$sql = "SELECT Username
			FROM user_login
			WHERE Username = '" . $username . "' AND Password = '" . md5($password) . "';";
	$result = $pdo->query($sql);
	if (!$result->fetch()) {
		echo "fail";
	} else {
		$result = $pdo->query($sql);
		while ($row = $result->fetch()) {
			if ($row["Username"] != NULL) {
				$_SESSION["username"] = $username;
				echo "success";
			}
		}
	}
	
	
	
?>