<?php
	session_start();
	
	$burgerName = $_GET["burgerName"];

	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	for ($i = 1; $i <= count($_SESSION["selectedIngredients"]); $i++) {
		if ($_SESSION["selectedIngredients"][$i] == 2) {
			$sql = "INSERT INTO user_products
					VALUE ('" . $_SESSION["username"] . "', '" . $burgerName . "', " . $i . ");";
			$pdo->exec($sql);
		}
	}
				
	echo "";
?>