<?php
	session_start();
	
	$category = $_GET["category"];
	$selection = $_GET["selection"];
	$ingredient = $_GET["ingredient"];
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}

	
	if (strcmp($category, "burgers") == 0) {
		$sql = "SELECT DISTINCT spi.IngredientID AS IngredientID, ii.Name AS Name
			    FROM store_product_offerings spo, store_product_ingredients spi, ingredient_information ii
			    WHERE spo.ProductType = 'Burger' AND spo.ProductName = spi.ProductName AND spi.IngredientID = ii.IngredientID;";
				
		if ($ingredient != 0) {
			if ($_SESSION["selectedIngredients"][$ingredient] == 1) {
				$_SESSION["selectedIngredients"][$ingredient] = 2;
			} else if ($_SESSION["selectedIngredients"][$ingredient] == 2) {
				$_SESSION["selectedIngredients"][$ingredient] = 1;
			}
		}
		echo "<div class=\"row\">";
		$result = $pdo->query($sql);
		$checkBoxNum = 1;
		while ($row = $result->fetch()) {
			if ($_SESSION["selectedIngredients"][$row["IngredientID"]] != 0) {
				echo "<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-4 ingredientItem\">";
				if ($_SESSION["selectedIngredients"][$row["IngredientID"]] == 1) {
					echo "<img src=\"../Pictures/CheckBoxUnselected.png\" class=\"ingredientCheckBoxes\" id=\"ingredient-" . $checkBoxNum . "\" onclick=\"displayIngredients('" . $category . "', '" . $selection . "', " . $row["IngredientID"] . ");\"/>";
				} else if ($_SESSION["selectedIngredients"][$row["IngredientID"]] == 2) {
					echo "<img src=\"../Pictures/CheckBoxSelected.png\" class=\"ingredientCheckBoxes\" id=\"ingredient-" . $checkBoxNum . "\" onclick=\"displayIngredients('" . $category . "', '" . $selection . "', " . $row["IngredientID"] . ");\"/>";
				}
				echo "<h2 class=\"ingredientNames\">" . $row["Name"] . "</h2>";
				echo "</div>";
				$checkBoxNum++;
			}
		}
		echo "</div>";
	} else if (strcmp($category, "sides") == 0) {
		echo "";
	} else if (strcmp($category, "drinks") == 0) {
		echo "";
	} else if (strcmp($category, "myBurgers") == 0) {
		echo "";
	}

	

?>