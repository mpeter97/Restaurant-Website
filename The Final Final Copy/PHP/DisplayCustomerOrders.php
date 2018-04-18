<?php
	session_start();
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	$restaurantNumber = $_GET["restaurantNumber"];
	
	$sql = "SELECT op.OrderID AS OrderID, op.ItemNumber AS ItemNumber, op.ProductName AS ProductName, op.IngredientID AS IngredientID, ii.Name AS Name
			FROM order_user ou, order_products op, ingredient_information ii
			WHERE ou.StoreNumber = '" . $restaurantNumber . "' AND ou.DateFulfilled IS NULL AND ou.OrderID = op.OrderID AND op.IngredientID = ii.IngredientID 
			ORDER BY op.OrderID, op.ItemNumber;";
	$result = $pdo->query($sql);
	$currentOrderID = -1;
	$currentItemNumber = -1;
	$currentIngredientNumber = 1;
	echo "<div id=\"allDisplayedOrders\">";
	while ($row = $result->fetch()) {
		if ($row["OrderID"] != $currentOrderID) {
			$currentItemNumber = -1;
			$currentIngredientNumber = 1;
			if ($currentOrderID != -1) {
				echo "</h3></div>";
				echo "<div class=\"col-xs-2\">";
				echo "<h1 class=\"finishOrder\" onclick=\"finishOrder(" . $currentOrderID . ", " . $restaurantNumber . ");\">X</h1>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
			}
			$currentOrderID = $row["OrderID"];
			echo "<div class=\"displayedOrder\">";
			echo "<div class=\"row\">";
			echo "<div class=\"col-xs-10\">";
			echo "<h1 class=\"orderNumber\">ORDER #" . $row["OrderID"] . "</h1>";
		}
		if ($row["ItemNumber"] != $currentItemNumber) {
			$currentIngredientNumber = 1;
			echo "<h2 class=\"itemName\">" . $row["ProductName"] . "</h2>";
			$currentItemNumber = $row["ItemNumber"];
		}
		if ($currentIngredientNumber == 1) {
			echo "<h3 class=\"itemIngredient\">" . $row["Name"];
		} else {
			echo ", " . $row["Name"];
		}
		$currentIngredientNumber++;
	}
	if ($currentOrderID != -1) {
		echo "</h3></div>";
		echo "<div class=\"col-xs-2\">";
		echo "<h1 class=\"finishOrder\" onclick=\"finishOrder(" . $currentOrderID . ", " . $restaurantNumber . ");\">X</h1>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
	} else {
		echo "<h1 id=\"noOrders\">No current orders</h1>";
	}
	echo "</div>";

?>