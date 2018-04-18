<?php
	session_start();

	$productType = $_GET["productType"];
	$ingredient = $_GET["ingredient"];
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	if (strcmp($productType, "Burger") == 0) {
		$sql = "SELECT DISTINCT ii.IngredientID AS IngredientID, ii.Name AS Name
			    FROM store_product_ingredients spi, ingredient_information ii
			    WHERE ii.IngredientID <= 20;";
				
		if ($ingredient != 0) {
			if ($_SESSION["selectedProductIngredients"][$ingredient] == 0 || $_SESSION["selectedProductIngredients"][$ingredient] == -1) {
				$_SESSION["selectedProductIngredients"][$ingredient] = 1;
			} else if ($_SESSION["selectedProductIngredients"][$ingredient] == 1) {
				$_SESSION["selectedProductIngredients"][$ingredient] = 0;
			}
		}
		echo "<div class=\"row\">";
		$result = $pdo->query($sql);
		$checkBoxNum = 1;
		while ($row = $result->fetch()) {
			echo "<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-4 ingredientItem\">";
			if ($_SESSION["selectedProductIngredients"][$row["IngredientID"]] == 0 || $_SESSION["selectedProductIngredients"][$row["IngredientID"]] == -1) {
				echo "<img src=\"../Pictures/CheckBoxUnselected.png\" class=\"ingredientCheckBoxes\" id=\"ingredient-" . $checkBoxNum . "\" onclick=\"addToProducts('" . $productType. "', " . $row["IngredientID"] . ");\"/>";
			} else if ($_SESSION["selectedProductIngredients"][$row["IngredientID"]] == 1) {
				echo "<img src=\"../Pictures/CheckBoxSelected.png\" class=\"ingredientCheckBoxes\" id=\"ingredient-" . $checkBoxNum . "\" onclick=\"addToProducts('" . $productType . "', " . $row["IngredientID"] . ");\"/>";
			}
			echo "<h2 class=\"ingredientNames\">" . $row["Name"] . "</h2>";
			echo "</div>";
			$checkBoxNum++;
		}
		echo "</div>";
		
		
		echo "<h1 id=\"nameYourProduct\">NAME YOUR BURGER</h1>";
		echo "<input type=\"text\" id=\"productName\" />";
		echo "<button id=\"cancelAddingButton\" onclick=\"cancelAddingToProducts();\">CANCEL</button>";
		echo "<button id=\"doneAddingButton\" onclick=\"doneAddingToProducts('Burger');\">SUBMIT</button>";
	} else if (strcmp($productType, "Side") == 0) {
		$sql = "SELECT DISTINCT ii.IngredientID AS IngredientID, ii.Name AS Name
			    FROM store_product_ingredients spi, ingredient_information ii
			    WHERE ii.IngredientID <= 21 AND ii.IngredientID >= 3;";
				
		if ($ingredient != 0) {
			if ($_SESSION["selectedProductIngredients"][$ingredient] == 0 || $_SESSION["selectedProductIngredients"][$ingredient] == -1) {
				$_SESSION["selectedProductIngredients"][$ingredient] = 1;
			} else if ($_SESSION["selectedProductIngredients"][$ingredient] == 1) {
				$_SESSION["selectedProductIngredients"][$ingredient] = 0;
			}
		}
		echo "<div class=\"row\">";
		$result = $pdo->query($sql);
		$checkBoxNum = 1;
		while ($row = $result->fetch()) {
			echo "<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-4 ingredientItem\">";
			if ($_SESSION["selectedProductIngredients"][$row["IngredientID"]] == 0 || $_SESSION["selectedProductIngredients"][$row["IngredientID"]] == -1) {
				echo "<img src=\"../Pictures/CheckBoxUnselected.png\" class=\"ingredientCheckBoxes\" id=\"ingredient-" . $checkBoxNum . "\" onclick=\"addToProducts('" . $productType. "', " . $row["IngredientID"] . ");\"/>";
			} else if ($_SESSION["selectedProductIngredients"][$row["IngredientID"]] == 1) {
				echo "<img src=\"../Pictures/CheckBoxSelected.png\" class=\"ingredientCheckBoxes\" id=\"ingredient-" . $checkBoxNum . "\" onclick=\"addToProducts('" . $productType . "', " . $row["IngredientID"] . ");\"/>";
			}
			echo "<h2 class=\"ingredientNames\">" . $row["Name"] . "</h2>";
			echo "</div>";
			$checkBoxNum++;
		}
		echo "</div>";
		
		
		echo "<h1 id=\"nameYourProduct\">NAME YOUR SIDE</h1>";
		echo "<input type=\"text\" id=\"productName\" />";
		echo "<button id=\"cancelAddingButton\" onclick=\"cancelAddingToProducts();\">CANCEL</button>";
		echo "<button id=\"doneAddingButton\" onclick=\"doneAddingToProducts('Side');\">SUBMIT</button>";
	} else if (strcmp($productType, "Drink") == 0) {
		echo "<h1 id=\"nameYourProduct\">NAME YOUR DRINK</h1>";
		echo "<input type=\"text\" id=\"productName\" />";
		echo "<button id=\"cancelAddingButton\" onclick=\"cancelAddingToProducts();\">CANCEL</button>";
		echo "<button id=\"doneAddingButton\" onclick=\"doneAddingToProducts('Drink');\">SUBMIT</button>";
	}
?>