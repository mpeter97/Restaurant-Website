<?php
	session_start();
	$productName = $_GET["productName"];
	$type = $_GET["type"];
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	if (strcmp($type, "addToOrder") != 0) {
		$_SESSION["currentItemType"] = $type;
		$_SESSION["orderItems"][$_SESSION["currentItemNumber"]] = $productName;
	} else {
		if ($_SESSION["orderItems"][$_SESSION["currentItemNumber"]] == NULL) {
			$_SESSION["orderItems"][$_SESSION["currentItemNumber"]] = $_SESSION["orderItems"][$_SESSION["currentItemNumber"] - 1];
		}
		if (strcmp($_SESSION["currentItemType"], "burgers") == 0) {
			$_SESSION["prices"][$_SESSION["currentItemNumber"]] = 2;
			$numIngredients = 0;
			for ($i = 1; $i <= count($_SESSION["selectedIngredients"]); $i++) {
				if ($_SESSION["selectedIngredients"][$i] == 2) {
					$sql = "SELECT Name, Price
							FROM ingredient_information
							WHERE IngredientID = " . $i . ";";
					$result = $pdo->query($sql);
					while ($row = $result->fetch()) {
						$_SESSION["prices"][$_SESSION["currentItemNumber"]] += $row["Price"];
						if ($numIngredients == 0) {
							$_SESSION["orderIngredients"][$_SESSION["currentItemNumber"]] = $row["Name"];
						} else {
							$_SESSION["orderIngredients"][$_SESSION["currentItemNumber"]] = $_SESSION["orderIngredients"][$_SESSION["currentItemNumber"]] . ", " . $row["Name"];
						}
						$numIngredients++;
					}
				}
			}
			if ($numIngredients == 0) {
				$_SESSION["orderIngredients"][$_SESSION["currentItemNumber"]] = "";
			}
			
		} else if (strcmp($_SESSION["currentItemType"], "sides") == 0) {
			$_SESSION["prices"][$_SESSION["currentItemNumber"]] = 0;
			$numIngredients = 0;
			$sql = "SELECT ii.Name AS Name, ii.Price AS Price
					FROM store_product_ingredients spo, ingredient_information ii
					WHERE spo.ProductName = '" . $_SESSION["orderItems"][$_SESSION["currentItemNumber"]] . "' AND spo.IngredientID = ii.IngredientID;";
			$result = $pdo->query($sql);
			while ($row = $result->fetch()) {
				$_SESSION["prices"][$_SESSION["currentItemNumber"]] += $row["Price"];
				if ($numIngredients == 0) {
					$_SESSION["orderIngredients"][$_SESSION["currentItemNumber"]] = $row["Name"];
				} else {
					$_SESSION["orderIngredients"][$_SESSION["currentItemNumber"]] = $_SESSION["orderIngredients"][$_SESSION["currentItemNumber"]] . ", " . $row["Name"];
				}
				$numIngredients++;
			}
		} else if (strcmp($_SESSION["currentItemType"], "drinks") == 0) {
			$sql = "SELECT ii.Price AS Price
					FROM ingredient_information ii
					WHERE ii.Name = '" . $_SESSION["orderItems"][$_SESSION["currentItemNumber"]] . "';";
			$result = $pdo->query($sql);
			while ($row = $result->fetch()) {
				$_SESSION["prices"][$_SESSION["currentItemNumber"]] = $row["Price"];
			}
			$_SESSION["orderIngredients"][$_SESSION["currentItemNumber"]] = $_SESSION["orderItems"][$_SESSION["currentItemNumber"]];
		} else if (strcmp($_SESSION["currentItemType"], "myBurgers") == 0) {
			$_SESSION["prices"][$_SESSION["currentItemNumber"]] = 2;
			$numIngredients = 0;
			$sql = "SELECT ii.Name, ii.Price
					FROM user_products up, ingredient_information ii
					WHERE up.Username = '" . $_SESSION["username"] . "' AND up.ProductName = '" . $_SESSION["orderItems"][$_SESSION["currentItemNumber"]] . "' AND up.IngredientID = ii.IngredientID;";
			$result = $pdo->query($sql);
			while ($row = $result->fetch()) {
				$_SESSION["prices"][$_SESSION["currentItemNumber"]] += $row["Price"];
				if ($numIngredients == 0) {
					$_SESSION["orderIngredients"][$_SESSION["currentItemNumber"]] = $row["Name"];
				} else {
					$_SESSION["orderIngredients"][$_SESSION["currentItemNumber"]] = $_SESSION["orderIngredients"][$_SESSION["currentItemNumber"]] . ", " . $row["Name"];
				}
				$numIngredients++;
			}
			if ($numIngredients == 0) {
				$_SESSION["orderIngredients"][$_SESSION["currentItemNumber"]] = "";
			}
		}
		$_SESSION["currentItemNumber"] += 1;
	}
	
?>