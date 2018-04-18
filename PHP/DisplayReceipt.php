<?php
	session_start();
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	
	$sql = "INSERT INTO order_user (StoreNumber, Username)
			VALUE (" . $_SESSION["orderLocation"] . ", '" . $_SESSION["username"] . "');";
	$pdo->exec($sql);
	
	$sql = "SELECT Username, MAX(OrderID) AS OrderID
			FROM order_user
			WHERE Username = '" . $_SESSION["username"] . "'
			GROUP BY Username;";
	$result = $pdo->query($sql);
	while ($row = $result->fetch()) {
		$orderID = $row["OrderID"];
		$itemNumber = 1;
		for ($i = 1; $i < $_SESSION["currentItemNumber"]; $i++) {
			if ($_SESSION["prices"][$i] == -1) {
				continue;
			}
			$itemIngredients = explode(',', $_SESSION["orderIngredients"][$i]);
			for ($j = 0; $j < count($itemIngredients); $j++) {
				$itemIngredients[$j] = trim($itemIngredients[$j], " ");
				$sql2 = "SELECT IngredientID
						 FROM ingredient_information
						 WHERE Name = '" . $itemIngredients[$j] . "';";
				$result2 = $pdo->query($sql2);
				$ingredientID = 0;
				while ($row2 = $result2->fetch()) {
					$ingredientID = $row2["IngredientID"];
				}
				$sql3 = "INSERT INTO order_products
						 VALUE (?, ?, ?, ?);";
				$result3 = $pdo->prepare($sql3);
				$result3->bindValue(1, $orderID);
				$result3->bindValue(2, $itemNumber);
				$result3->bindValue(3, $_SESSION["orderItems"][$i]);
				$result3->bindValue(4, $ingredientID);
				$result3->execute();
			}
			$itemNumber++;
		}
	}
	
	
	
	$subtotal = 0;
	echo "<div id=\"receiptContents\">";
	echo "<div id=\"storeInformationArea\">";
	echo "<h5 id=\"storeTitle\" class=\"storeInformation\">THREE GUYS</h5>";
	echo "<h5 class=\"storeInformation\">STORE #" . $_SESSION["orderLocation"] . "</h5>";
	
	$sql = "SELECT *
			FROM store_locations
			WHERE StoreNumber = " . $_SESSION["orderLocation"] . ";";
	$result = $pdo->query($sql);
	while ($row = $result->fetch()) {
		echo "<h5 class=\"storeInformation\">" . $row["Address"] . "</h5>";
		echo "<h5 class=\"storeInformation\">" . $row["City"] . ", " . $row["State"] . " " . $row["ZipCode"] . "</h5>";
	}
	
	date_default_timezone_set("America/Detroit");
	echo "<br />";
	echo "<h5 class=\"storeInformation\">" . date("m/d/Y H:i:s") . "</h5>";
	echo "</div>";
	echo "<br />";
	echo "<h5 id=\"orderNumber\">Order Number: " . $orderID . "</h5>";
	echo "<br />";
	
	for ($i = 1; $i < $_SESSION["currentItemNumber"]; $i++) {
		if ($_SESSION["prices"][$i] == -1) {
			continue;
		}
		echo "<div class=\"row\">";
		echo "<div class=\"col-xs-8\">";
		echo "<h1 class=\"receiptItem\">" . $_SESSION["orderItems"][$i] . "</h1>";
		echo "</div>";
		echo "<div class=\"col-xs-4\">";
		echo "<h1 class=\"receiptItemPrice\">$" . number_format($_SESSION["prices"][$i], 2) . "</h1>";
		echo "</div>";
		echo "</div>";
		$itemIngredients = explode(',', $_SESSION["orderIngredients"][$i]);
		if (count($itemIngredients) > 1) {
			echo "<div class=\"row\">";
			echo "<div class=\"col-xs-8\">";
			echo "<h1 class=\"receiptItemIngredients\">" . $_SESSION["orderIngredients"][$i] . "</h1>";
			echo "</div>";
			echo "<div class=\"col-xs-4\">";
			echo "</div>";
			echo "</div>";
		}
		$subtotal += $_SESSION["prices"]{$i};
	}
	echo "<br /><br />";
	echo "<div class=\"row\">";
	echo "<div class=\"col-xs-8\">";
	echo "<h1 id=\"receiptSubtotal\">SUBTOTAL</h1>";
	echo "</div>";
	echo "<div class=\"col-xs-4\">";
	echo "<h1 id=\"receiptSubtotalAmount\">$" . number_format($subtotal, 2) . "</h1>";
	echo "</div>";
	echo "</div>";
	echo "<div class=\"row\">";
	echo "<div class=\"col-xs-8\">";
	echo "<h1 id=\"receiptTax\">TAX</h1>";
	echo "</div>";
	echo "<div class=\"col-xs-4\">";
	echo "<h1 id=\"receiptTaxAmount\">$" . number_format($subtotal * 0.06, 2) . "</h1>";
	echo "</div>";
	echo "</div>";
	echo "<div class=\"row\">";
	echo "<div class=\"col-xs-8\">";
	echo "<h1 id=\"receiptTotal\">TOTAL</h1>";
	echo "</div>";
	echo "<div class=\"col-xs-4\">";
	echo "<h1 id=\"receiptTotalAmount\">$" . number_format($subtotal * 1.06, 2) . "</h1>";
	echo "</div>";
	echo "</div>";
	echo "<div id=\"thanksArea\">";
	echo "<h1 id=\"asterisks\">*********************************<h1>";
	echo "<h1 class=\"thanks\">THANK YOU FOR CHOOSING THREE GUYS!!!<h1>";
	echo "<h1 class=\"thanks\">SHARE YOUR THOUGHTS AT www.threeguys.com<h1>";
	echo "</div>";
	echo "</div>";
	
	
	
?>