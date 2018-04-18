<?php
	session_start();
	
	$category = $_GET["category"];
	$selection = $_GET["selection"];
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	if (strcmp($category, "burgers") == 0) {
		$sql = "SELECT *
				FROM store_product_offerings spo
				WHERE spo.ProductType = 'Burger' AND spo.StoreNumber = '" . $_SESSION["orderLocation"] . "';";
	} else if (strcmp($category, "sides") == 0) {
		$sql = "SELECT *
				FROM store_product_offerings spo
				WHERE spo.ProductType = 'Side' AND spo.StoreNumber = '" . $_SESSION["orderLocation"] . "';";
	} else if (strcmp($category, "drinks") == 0) {
		$sql = "SELECT *
				FROM store_product_offerings spo
				WHERE spo.ProductType = 'Drink' AND spo.StoreNumber = '" . $_SESSION["orderLocation"] . "';";
	} else if (strcmp($category, "myBurgers") == 0) {
		$sql = "SELECT DISTINCT up1.ProductName
				FROM (SELECT DISTINCT up11.ProductName AS ProductName
					  FROM user_products up11
					  WHERE up11.Username = '" . $_SESSION["username"] . "') up1
				WHERE up1.ProductName NOT IN (SELECT DISTINCT up2.ProductName AS ProductName
											  FROM (SELECT *
													FROM user_products up12
													WHERE up12.Username = '" . $_SESSION["username"] . "') up2
											  WHERE up2.IngredientID NOT IN (SELECT DISTINCT spi.IngredientID
																			 FROM store_product_offerings spo, store_product_ingredients spi
																			 WHERE spo.ProductType = 'Burger' AND spo.ProductName = spi.ProductName AND spo.StoreNumber = '" . $_SESSION["orderLocation"] . "'));";
	}
	
	echo "<div class=\"row\">";
	$result = $pdo->query($sql);
	$optionNum = 1;
	while ($row = $result->fetch()) {
		echo "<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-4 menuItem\">";
		if ($optionNum == $selection) {
			$_SESSION["selectedItem"] = $row["ProductName"];
			if (strcmp($category, "burgers") == 0) {
				$sql2 = "SELECT DISTINCT spi.IngredientID AS IngredientID
						 FROM store_product_offerings spo, store_product_ingredients spi
						 WHERE spo.ProductType = 'Burger' AND spo.ProductName = spi.ProductName;";
				$result2 = $pdo->query($sql2);
				$sql3 = "SELECT DISTINCT spi.IngredientID AS IngredientID
						FROM store_product_offerings spo, store_product_ingredients spi
						WHERE spo.ProductType = 'Burger' AND spo.ProductName = spi.ProductName AND spo.StoreNumber = '" . $_SESSION["orderLocation"] . "';";
				$result3 = $pdo->query($sql3);
				$sql4 = "SELECT DISTINCT spi.IngredientID AS IngredientID
						 FROM store_product_offerings spo, store_product_ingredients spi
						 WHERE spo.ProductType = 'Burger' AND spo.ProductName = '" . $_SESSION["selectedItem"] . "' AND spo.ProductName = spi.ProductName AND spo.StoreNumber = '" . $_SESSION["orderLocation"] . "';";
				$result4 = $pdo->query($sql4);
				$_SESSION["selectedIngredients"] = array();
				while ($row2 = $result2->fetch()) {
					$_SESSION["selectedIngredients"][$row2["IngredientID"]] = 0;
				}
				while ($row3 = $result3->fetch()) {
					$_SESSION["selectedIngredients"][$row3["IngredientID"]] = 1;
				}
				while ($row4 = $result4->fetch()) {
					$_SESSION["selectedIngredients"][$row4["IngredientID"]] = 2;
				}
			}
			if (strcmp($category, "burgers") == 0) {
				echo "<img src=\"../Pictures/OptionSelected.png\" class=\"itemOptions\" id=\"option-" . $optionNum . "\" onclick=\"displayCategoryOptions('" . $category . "', " . $optionNum . ");\"/>";
			} else if (strcmp($category, "sides") == 0) {
				echo "<img src=\"../Pictures/OptionSelected.png\" class=\"itemOptions\" id=\"option-" . $optionNum . "\" onclick=\"displayCategoryOptions('" . $category . "', " . $optionNum . ");\"/>";
			} else if (strcmp($category, "drinks") == 0) {
				echo "<img src=\"../Pictures/OptionSelected.png\" class=\"itemOptions\" id=\"option-" . $optionNum . "\" onclick=\"displayCategoryOptions('" . $category . "', " . $optionNum . ");\"/>";
			} else if (strcmp($category, "myBurgers") == 0) {
				echo "<img src=\"../Pictures/OptionSelected.png\" class=\"itemOptions\" id=\"option-" . $optionNum . "\" onclick=\"displayCategoryOptions('" . $category . "', " . $optionNum . ");\"/>";
			}
		} else {
			if (strcmp($category, "burgers") == 0) {
				echo "<img src=\"../Pictures/OptionUnselected.png\" class=\"itemOptions\" id=\"option-" . $optionNum . "\" onclick=\"displayCategoryOptions('" . $category . "', " . $optionNum . "); displayIngredients('" . $category . "', '" . $row["ProductName"] . "', 0); displaySubmitButtons(2); addToOrder('" . $row["ProductName"] . "', 'burgers');\"/>";	
			} else if (strcmp($category, "sides") == 0) {
				echo "<img src=\"../Pictures/OptionUnselected.png\" class=\"itemOptions\" id=\"option-" . $optionNum . "\" onclick=\"displayCategoryOptions('" . $category . "', " . $optionNum . "); displayIngredients('" . $category . "', '" . $row["ProductName"] . "', 0); displaySubmitButtons(1); addToOrder('" . $row["ProductName"] . "', 'sides');\"/>";	
			} else if (strcmp($category, "drinks") == 0) {
				echo "<img src=\"../Pictures/OptionUnselected.png\" class=\"itemOptions\" id=\"option-" . $optionNum . "\" onclick=\"displayCategoryOptions('" . $category . "', " . $optionNum . "); displayIngredients('" . $category . "', '" . $row["ProductName"] . "', 0); displaySubmitButtons(1); addToOrder('" . $row["ProductName"] . "', 'drinks');\"/>";	
			} else if (strcmp($category, "myBurgers") == 0) {
				echo "<img src=\"../Pictures/OptionUnselected.png\" class=\"itemOptions\" id=\"option-" . $optionNum . "\" onclick=\"displayCategoryOptions('" . $category . "', " . $optionNum . "); displayIngredients('" . $category . "', '" . $row["ProductName"] . "', 0); displaySubmitButtons(1); addToOrder('" . $row["ProductName"] . "', 'myBurgers');\"/>";
			}
		}
		echo "<h2 class=\"itemNames\">" . $row["ProductName"] . "</h2>";
		echo "</div>";
		$optionNum++;
	}
	echo "</div>";
	


?>