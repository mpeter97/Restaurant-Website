<?php
	session_start();
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	$sql = "SELECT IngredientID
			FROM ingredient_information;";
	$result = $pdo->query($sql);
	while ($row = $result->fetch()) {
		$_SESSION["selectedProductIngredients"][$row["IngredientID"]] = -1;
	}
?>