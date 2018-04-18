<?php
	session_start();
	$firstName = $_GET["firstName"];
	$lastName = $_GET["lastName"];
	$username = $_GET["username"];
	$password = $_GET["password"];
	$confirmPassword = $_GET["confirmPassword"];
	$address = $_GET["address"];
	$city = $_GET["city"];
	$state = $_GET["state"];
	$zipCode = $_GET["zipCode"];
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	$sql = "SELECT Username
			FROM user_login
			WHERE Username = '" . $username . "';";
	$result = $pdo->query($sql);
	if (!$result->fetch()) {
		$_SESSION["registrationSuccess"] = "true";
		$sql = "INSERT INTO user_login
				VALUE (?, ?);";
		$result = $pdo->prepare($sql);
		$result->bindValue(1, $username);
		$result->bindValue(2, $password);
		$result->execute();
		$sql = "INSERT INTO user_information
				VALUE (?, ?, ?, ?, ?, ?, ?);";
		$result = $pdo->prepare($sql);
		$result->bindValue(1, $username);
		$result->bindValue(2, $firstName);
		$result->bindValue(3, $lastName);
		$result->bindValue(4, $address);
		$result->bindValue(5, $city);
		$result->bindValue(6, $state);
		$result->bindValue(7, $zipCode);
		$result->execute();
	} else {
		$_SESSION["registrationSuccess"] = "false";
	}
?>