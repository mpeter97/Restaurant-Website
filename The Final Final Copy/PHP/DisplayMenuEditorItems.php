<?php
	session_start();
	
	$restaurantNumber = $_GET["restaurantNumber"];
	$productName = $_GET["productName"];
	$productType = $_GET["productType"];
	$insertOrDelete = $_GET["insertOrDelete"];
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}

	
	if (strcmp($productName, "None") != 0) {
		if (strcmp($insertOrDelete, "insert") == 0) {
			$sql = "INSERT INTO store_product_offerings
					VALUE (" . $restaurantNumber . ", '" . $productName . "', '" . $productType . "');";
			$pdo->exec($sql);
		} else if (strcmp($insertOrDelete, "delete") == 0) {
			$sql = "DELETE FROM store_product_offerings
					WHERE StoreNumber = " . $restaurantNumber . " AND ProductName = '" . $productName . "';";
			$pdo->exec($sql);
		}
		
	}
	
	$sql1 = "SELECT DISTINCT spi1.ProductName
			 FROM store_product_ingredients spi1
			 WHERE spi1.ProductName NOT IN (SELECT spi2.ProductName
											FROM store_product_ingredients spi2
											WHERE spi2.IngredientID > 20)
			 ORDER BY spi1.ProductName;";
	$result1 = $pdo->query($sql1);
	$sql2 = "SELECT ProductName
			 FROM store_product_offerings
			 WHERE StoreNumber = '" . $restaurantNumber . "' AND ProductType = 'Burger'
			 ORDER BY ProductName;";
	$result2 = $pdo->query($sql2);
	
	echo "<h1 id=\"burgersTitle\">BURGERS</h1>";
	echo "<hr id=\"burgers-underline\"/>";
	echo "<div class=\"row\">";
	$checkBoxNum = 1;
	while ($row1 = $result1->fetch()) {
		$itemOnMenu = 0;
		echo "<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-4 productItem\">";
		$result2 = $pdo->query($sql2);
		while ($row2 = $result2->fetch()) {
			if (strcmp($row1["ProductName"], $row2["ProductName"]) == 0) {
				echo "<img src=\"../Pictures/CheckBoxSelected.png\" class=\"productCheckBoxes\" id=\"product-" . $checkBoxNum . "\" onclick=\"displayMenuEditorItems(" . $restaurantNumber . ", '" . $row1["ProductName"] . "', 'Burger', 'delete');\"/>";
				$itemOnMenu = 1;
				break;
			}
		}
		if ($itemOnMenu == 0) {
			echo "<img src=\"../Pictures/CheckBoxUnselected.png\" class=\"productCheckBoxes\" id=\"product-" . $checkBoxNum . "\" onclick=\"displayMenuEditorItems(" . $restaurantNumber . ", '" . $row1["ProductName"] . "', 'Burger', 'insert');\"/>";
		}
		echo "<h2 class=\"productNames\">" . $row1["ProductName"] . "</h2>";
		echo "</div>";
		$checkBoxNum++;
	}
	echo "</div>";
	
	
	$sql1 = "SELECT DISTINCT spi1.ProductName
			 FROM store_product_ingredients spi1
			 WHERE spi1.IngredientID = 21
			 ORDER BY spi1.ProductName;";
	$result1 = $pdo->query($sql1);
	$sql2 = "SELECT ProductName
			 FROM store_product_offerings
			 WHERE StoreNumber = '" . $restaurantNumber . "' AND ProductType = 'Side'
			 ORDER BY ProductName;";
	$result2 = $pdo->query($sql2);
	
	echo "<h1 id=\"sidesTitle\">SIDES</h1>";
	echo "<hr id=\"sides-underline\"/>";
	echo "<div class=\"row\">";
	while ($row1 = $result1->fetch()) {
		$itemOnMenu = 0;
		echo "<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-4 productItem\">";
		$result2 = $pdo->query($sql2);
		while ($row2 = $result2->fetch()) {
			if (strcmp($row1["ProductName"], $row2["ProductName"]) == 0) {
				echo "<img src=\"../Pictures/CheckBoxSelected.png\" class=\"productCheckBoxes\" id=\"product-" . $checkBoxNum . "\" onclick=\"displayMenuEditorItems(" . $restaurantNumber . ", '" . $row1["ProductName"] . "', 'Side', 'delete');\"/>";
				$itemOnMenu = 1;
				break;
			}
		}
		if ($itemOnMenu == 0) {
			echo "<img src=\"../Pictures/CheckBoxUnselected.png\" class=\"productCheckBoxes\" id=\"product-" . $checkBoxNum . "\" onclick=\"displayMenuEditorItems(" . $restaurantNumber . ", '" . $row1["ProductName"] . "', 'Side', 'insert');\"/>";
		}
		echo "<h2 class=\"productNames\">" . $row1["ProductName"] . "</h2>";
		echo "</div>";
		$checkBoxNum++;
	}
	echo "</div>";
	
	
	$sql1 = "SELECT DISTINCT spi1.ProductName
			 FROM store_product_ingredients spi1
			 WHERE spi1.IngredientID > 21
			 ORDER BY spi1.ProductName;";
	$result1 = $pdo->query($sql1);
	$sql2 = "SELECT ProductName
			 FROM store_product_offerings
			 WHERE StoreNumber = '" . $restaurantNumber . "' AND ProductType = 'Drink'
			 ORDER BY ProductName;";
	$result2 = $pdo->query($sql2);
	
	echo "<h1 id=\"drinksTitle\">DRINKS</h1>";
	echo "<hr id=\"drinks-underline\"/>";
	echo "<div class=\"row\">";
	while ($row1 = $result1->fetch()) {
		$itemOnMenu = 0;
		echo "<div class=\"col-xs-12 col-sm-6 col-md-6 col-lg-4 productItem\">";
		$result2 = $pdo->query($sql2);
		while ($row2 = $result2->fetch()) {
			if (strcmp($row1["ProductName"], $row2["ProductName"]) == 0) {
				echo "<img src=\"../Pictures/CheckBoxSelected.png\" class=\"productCheckBoxes\" id=\"product-" . $checkBoxNum . "\" onclick=\"displayMenuEditorItems(" . $restaurantNumber . ", '" . $row1["ProductName"] . "', 'Drink', 'delete');\"/>";
				$itemOnMenu = 1;
				break;
			}
		}
		if ($itemOnMenu == 0) {
			echo "<img src=\"../Pictures/CheckBoxUnselected.png\" class=\"productCheckBoxes\" id=\"product-" . $checkBoxNum . "\" onclick=\"displayMenuEditorItems(" . $restaurantNumber . ", '" . $row1["ProductName"] . "', 'Drink', 'insert');\"/>";
		}
		echo "<h2 class=\"productNames\">" . $row1["ProductName"] . "</h2>";
		echo "</div>";
		$checkBoxNum++;
	}
	echo "</div>";

?>