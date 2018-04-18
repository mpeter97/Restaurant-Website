<?php
		
	session_start();

	$productName = $_GET["productName"];
	$productType = $_GET["productType"];
	$insertOrDelete = $_GET["insertOrDelete"];
	
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

	
	if (strcmp($productName, "None") != 0) {
		if (strcmp($insertOrDelete, "insert") == 0) {
			$sql1 = "SELECT DISTINCT StoreNumber
					 FROM store_product_offerings
					 ORDER BY StoreNumber;";
			$result1 = $pdo->query($sql1);
			$sql2 = "SELECT StoreNumber
					FROM store_product_offerings
					WHERE ProductName = '" . $productName . "'
					ORDER BY StoreNumber;";
			$result2 = $pdo->query($sql2);
			while ($row1 = $result1->fetch()) {
				$storeHasIt = 0;
				$result2 = $pdo->query($sql2);
				while ($row2 = $result2->fetch()) {
					if ($row1["StoreNumber"] == $row2["StoreNumber"]) {
						$storeHasIt = 1;
						break;
					}
				}
				if ($storeHasIt == 0) {
					$sql = "INSERT INTO store_product_offerings
							VALUE (" . $row1["StoreNumber"] . ", '" . $productName . "', '" . $productType . "');";
					$pdo->exec($sql);
				}
			}
		} else if (strcmp($insertOrDelete, "delete") == 0) {
			$sql1 = "SELECT DISTINCT StoreNumber
					 FROM store_product_offerings
					 ORDER BY StoreNumber;";
			$result1 = $pdo->query($sql1);
			while ($row1 = $result1->fetch()) {
				$sql2 = "DELETE FROM store_product_offerings
						WHERE StoreNumber = " . $row1["StoreNumber"] . " AND ProductName = '" . $productName . "';";
				$pdo->exec($sql2);
			}
		}
		
	}
	
	$sql1 = "SELECT DISTINCT spi1.ProductName
			 FROM store_product_ingredients spi1
			 WHERE spi1.ProductName NOT IN (SELECT spi2.ProductName
											FROM store_product_ingredients spi2
											WHERE spi2.IngredientID > 20)
			 ORDER BY spi1.ProductName;";
	$result1 = $pdo->query($sql1);
	$sql2 = "SELECT spo1.ProductName AS ProductName
			 FROM (SELECT DISTINCT spo11.ProductName AS ProductName
				   FROM store_product_offerings spo11
				   WHERE spo11.ProductType = 'Burger') spo1
			 WHERE spo1.ProductName NOT IN (SELECT spo2.ProductName
										    FROM (SELECT DISTINCT spo21.StoreNumber AS StoreNumber, spo22.ProductName AS ProductName
												  FROM store_product_offerings spo21, store_product_offerings spo22
												  WHERE spo21.ProductType = 'Burger' AND spo22.ProductType = 'Burger') spo2
										    WHERE NOT EXISTS (SELECT spo3.StoreNumber AS StoreNumber, spo3.ProductName AS ProductName
															  FROM store_product_offerings spo3
															  WHERE spo3.ProductType = 'Burger' AND spo2.StoreNumber = spo3.StoreNumber AND spo2.ProductName = spo3.ProductName))
			 ORDER BY spo1.ProductName;";
	$result2 = $pdo->query($sql2);
	
	echo "<h1 id=\"burgersTitle\">BURGERS</h1>";
	echo "<hr id=\"burgers-underline\"/>";
	echo "<div class=\"row\">";
	$checkBoxNum = 1;
	while ($row1 = $result1->fetch()) {
		$itemOnAllMenus = 0;
		echo "<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-4 productItem\">";
		$result2 = $pdo->query($sql2);
		while ($row2 = $result2->fetch()) {
			if (strcmp($row1["ProductName"], $row2["ProductName"]) == 0) {
				echo "<img src=\"../Pictures/CheckBoxSelected.png\" class=\"productCheckBoxes\" id=\"product-" . $checkBoxNum . "\" onclick=\"displayProductEditorItems('" . $row1["ProductName"] . "', 'Burger', 'delete');\"/>";
				$itemOnAllMenus = 1;
				break;
			}
		}
		if ($itemOnAllMenus == 0) {
			echo "<img src=\"../Pictures/CheckBoxUnselected.png\" class=\"productCheckBoxes\" id=\"product-" . $checkBoxNum . "\" onclick=\"displayProductEditorItems('" . $row1["ProductName"] . "', 'Burger', 'insert');\"/>";
		}
		echo "<h2 class=\"productNames\">" . $row1["ProductName"] . "</h2>";
		echo "</div>";
		$checkBoxNum++;
	}
	echo "</div>";
	
	echo "<button id=\"addToProductsBurger\" onclick=\"cancelAddingToProducts(); addToProducts('Burger', 0);\">ADD NEW BURGER</button>";
	
	echo "<div id=\"addToProductsBurgerSection\"></div>";
	
	
	
	
	
	$sql1 = "SELECT DISTINCT spi1.ProductName
			 FROM store_product_ingredients spi1
			 WHERE spi1.IngredientID = 21
			 ORDER BY spi1.ProductName;";
	$result1 = $pdo->query($sql1);
	$sql2 = "SELECT spo1.ProductName AS ProductName
			 FROM (SELECT DISTINCT spo11.ProductName AS ProductName
				   FROM store_product_offerings spo11
				   WHERE spo11.ProductType = 'Side') spo1
			 WHERE spo1.ProductName NOT IN (SELECT spo2.ProductName
										    FROM (SELECT DISTINCT spo21.StoreNumber AS StoreNumber, spo22.ProductName AS ProductName
												  FROM store_product_offerings spo21, store_product_offerings spo22
												  WHERE spo21.ProductType = 'Side' AND spo22.ProductType = 'Side') spo2
										    WHERE NOT EXISTS (SELECT spo3.StoreNumber AS StoreNumber, spo3.ProductName AS ProductName
															  FROM store_product_offerings spo3
															  WHERE spo3.ProductType = 'Side' AND spo2.StoreNumber = spo3.StoreNumber AND spo2.ProductName = spo3.ProductName))
			 ORDER BY spo1.ProductName;";
	$result2 = $pdo->query($sql2);
	
	echo "<h1 id=\"sidesTitle\">SIDES</h1>";
	echo "<hr id=\"sides-underline\"/>";
	echo "<div class=\"row\">";
	$checkBoxNum = 1;
	while ($row1 = $result1->fetch()) {
		$itemOnAllMenus = 0;
		echo "<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-4 productItem\">";
		$result2 = $pdo->query($sql2);
		while ($row2 = $result2->fetch()) {
			if (strcmp($row1["ProductName"], $row2["ProductName"]) == 0) {
				echo "<img src=\"../Pictures/CheckBoxSelected.png\" class=\"productCheckBoxes\" id=\"product-" . $checkBoxNum . "\" onclick=\"displayProductEditorItems('" . $row1["ProductName"] . "', 'Side', 'delete');\"/>";
				$itemOnAllMenus = 1;
				break;
			}
		}
		if ($itemOnAllMenus == 0) {
			echo "<img src=\"../Pictures/CheckBoxUnselected.png\" class=\"productCheckBoxes\" id=\"product-" . $checkBoxNum . "\" onclick=\"displayProductEditorItems('" . $row1["ProductName"] . "', 'Side', 'insert');\"/>";
		}
		echo "<h2 class=\"productNames\">" . $row1["ProductName"] . "</h2>";
		echo "</div>";
		$checkBoxNum++;
	}
	echo "</div>";
	
	echo "<button id=\"addToProductsSide\" onclick=\"cancelAddingToProducts(); addToProducts('Side', 0);\">ADD NEW SIDE</button>";
	
	echo "<div id=\"addToProductsSideSection\"></div>";
	
	
	
	
	
	
	$sql1 = "SELECT DISTINCT spi1.ProductName
			 FROM store_product_ingredients spi1
			 WHERE spi1.IngredientID > 21
			 ORDER BY spi1.ProductName;";
	$result1 = $pdo->query($sql1);
	$sql2 = "SELECT spo1.ProductName AS ProductName
			 FROM (SELECT DISTINCT spo11.ProductName AS ProductName
				   FROM store_product_offerings spo11
				   WHERE spo11.ProductType = 'Drink') spo1
			 WHERE spo1.ProductName NOT IN (SELECT spo2.ProductName
										    FROM (SELECT DISTINCT spo21.StoreNumber AS StoreNumber, spo22.ProductName AS ProductName
												  FROM store_product_offerings spo21, store_product_offerings spo22
												  WHERE spo21.ProductType = 'Drink' AND spo22.ProductType = 'Drink') spo2
										    WHERE NOT EXISTS (SELECT spo3.StoreNumber AS StoreNumber, spo3.ProductName AS ProductName
															  FROM store_product_offerings spo3
															  WHERE spo3.ProductType = 'Drink' AND spo2.StoreNumber = spo3.StoreNumber AND spo2.ProductName = spo3.ProductName))
			 ORDER BY spo1.ProductName;";
	$result2 = $pdo->query($sql2);
	
	echo "<h1 id=\"drinksTitle\">DRINKS</h1>";
	echo "<hr id=\"drinks-underline\"/>";
	echo "<div class=\"row\">";
	$checkBoxNum = 1;
	while ($row1 = $result1->fetch()) {
		$itemOnAllMenus = 0;
		echo "<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-4 productItem\">";
		$result2 = $pdo->query($sql2);
		while ($row2 = $result2->fetch()) {
			if (strcmp($row1["ProductName"], $row2["ProductName"]) == 0) {
				echo "<img src=\"../Pictures/CheckBoxSelected.png\" class=\"productCheckBoxes\" id=\"product-" . $checkBoxNum . "\" onclick=\"displayProductEditorItems('" . $row1["ProductName"] . "', 'Drink', 'delete');\"/>";
				$itemOnAllMenus = 1;
				break;
			}
		}
		if ($itemOnAllMenus == 0) {
			echo "<img src=\"../Pictures/CheckBoxUnselected.png\" class=\"productCheckBoxes\" id=\"product-" . $checkBoxNum . "\" onclick=\"displayProductEditorItems('" . $row1["ProductName"] . "', 'Drink', 'insert');\"/>";
		}
		echo "<h2 class=\"productNames\">" . $row1["ProductName"] . "</h2>";
		echo "</div>";
		$checkBoxNum++;
	}
	echo "</div>";
	
	echo "<button id=\"addToProductsDrink\" onclick=\"cancelAddingToProducts(); addToProducts('Drink', 0);\">ADD NEW DRINK</button>";
	
	echo "<div id=\"addToProductsDrinkSection\"></div>";
?>