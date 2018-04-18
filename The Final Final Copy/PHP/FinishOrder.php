<?php
	session_start();
	
	date_default_timezone_set('America/Detroit');

	$orderID = $_GET["orderID"];
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	$sql = "UPDATE order_user
			SET DateFulfilled = '" . date('Y-m-d H:i:s') . "', FulfilledBy = '" . $_SESSION["username"] . "'
		    WHERE OrderID = '" . $orderID . "';";
	$pdo->exec($sql);
?>