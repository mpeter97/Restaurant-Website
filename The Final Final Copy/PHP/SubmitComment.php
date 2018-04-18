<?php
	session_start();
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	$name = $_GET["name"];
	$email = $_GET["email"];
	$tel = $_GET["tel"];
	$contactType = $_GET["contactType"];
	$commentArea = $_GET["commentArea"];
	
	if (strcmp($name, "") == 0 && strcmp($email, "") == 0 && strcmp($tel, "") == 0) {
		$sql = "INSERT INTO user_comments (Username, Comment, Selected)
				VALUE ('" . $_SESSION["username"] . "', '" . $commentArea . "', 'n');";
		$pdo->exec($sql);
	}

?>