<?php
	session_start();
	
	$productType = $_GET["productType"];
	$productName = $_GET["productName"];

	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	if (strcmp($productType, "Burger") == 0 || strcmp($productType, "Side") == 0) {
		for ($i = 1; $i <= count($_SESSION["selectedProductIngredients"]); $i++) {
			if ($_SESSION["selectedProductIngredients"][$i] == 1) {
				$sql = "INSERT INTO store_product_ingredients
						VALUE ('" . $productName . "', " . $i . ");";
				$pdo->exec($sql);
			}
		}
	} else if (strcmp($productType, "Drink") == 0) {
		$sql = "INSERT INTO ingredient_information (Name, Price, Calories, Carbs, Fat, Sodium)
				VALUE ('" . $productName . "', 2, 0, 0, 0, 0);";
		$pdo->exec($sql);
		$sql2 = "SELECT MAX(IngredientID) AS IngredientID
				 FROM ingredient_information;";
		$result2 = $pdo->query($sql2);
		while ($row2 = $result2->fetch()) {
			$sql3 = "INSERT INTO store_product_ingredients
					 VALUE ('" . $productName . "', " . $row2["IngredientID"] . ");";
			$pdo->exec($sql3);
		}
	}
?>