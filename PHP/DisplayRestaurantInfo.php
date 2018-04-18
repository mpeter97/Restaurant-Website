<?php
	session_start();
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	$restaurantSelection = $_GET["restaurantSelection"];
	$infoTypeSelection = $_GET["infoTypeSelection"];
	$orderSelection = $_GET["orderSelection"];
	
	echo "<form>";
	if ($infoTypeSelection == 0) {
		echo "";
	} else if ($infoTypeSelection == 1) {
		echo "<select id=\"order-selector\" name=\"orderSelection\" onchange=\"displayRestaurantInfo(" . $restaurantSelection . ", " . $infoTypeSelection . ", orderSelection.value);\">";
		echo "<option value=\"0\" ";
		if ($orderSelection == 0) {
			echo "selected";
		}
		echo ">SELECT ORDER</option>";
		echo "<option value=\"1\" ";
		if ($orderSelection == 1) {
			echo "selected";
		}
		echo ">FIRST NAME</option>";
		echo "<option value=\"2\" ";
		if ($orderSelection == 2) {
			echo "selected";
		}
		echo ">LAST NAME</option>";
		echo "<option value=\"3\" ";
		if ($orderSelection == 3) {
			echo "selected";
		}
		echo ">STORE NUMBER</option>";	
		echo "<option value=\"4\" ";
		if ($orderSelection == 4) {
			echo "selected";
		}
		echo ">NUMBER OF ORDERS FULFILLED</option>";
		echo "</select>";
	} else if ($infoTypeSelection == 2) {
		echo "<select id=\"order-selector\" name=\"orderSelection\" onchange=\"displayRestaurantInfo(" . $restaurantSelection . ", " . $infoTypeSelection . ", orderSelection.value);\">";
		echo "<option value=\"0\" ";
		if ($orderSelection == 0) {
			echo "selected";
		}
		echo ">SELECT ORDER</option>";
		echo "<option value=\"1\" ";
		if ($orderSelection == 1) {
			echo "selected";
		}
		echo ">PRODUCT NAME</option>";
		echo "<option value=\"2\" ";
		if ($orderSelection == 2) {
			echo "selected";
		}
		echo ">PRODUCT QUANTITY</option>";
		echo "<option value=\"3\" ";
		if ($orderSelection == 3) {
			echo "selected";
		}
		echo ">PRODUCT SALES</option>";	
		echo "</select>";
	} else if ($infoTypeSelection == 3) {
		echo "<select id=\"order-selector\" name=\"orderSelection\" onchange=\"displayRestaurantInfo(" . $restaurantSelection . ", " . $infoTypeSelection . ", orderSelection.value);\">";
		echo "<option value=\"0\" ";
		if ($orderSelection == 0) {
			echo "selected";
		}
		echo ">SELECT ORDER</option>";
		echo "<option value=\"1\" ";
		if ($orderSelection == 1) {
			echo "selected";
		}
		echo ">PRODUCT NAME</option>";
		echo "<option value=\"2\" ";
		if ($orderSelection == 2) {
			echo "selected";
		}
		echo ">PRODUCT QUANTITY</option>";
		echo "<option value=\"3\" ";
		if ($orderSelection == 3) {
			echo "selected";
		}
		echo ">PRODUCT SALES</option>";	
		echo "</select>";
	}
	echo "</form>";
	
	
	if ($infoTypeSelection == 1) {
		if ($restaurantSelection == 0) {
			if ($orderSelection == 1) {
				$sql = "SELECT ui.FirstName AS FirstName, ui.LastName AS LastName, es.StoreNumber AS StoreNumber, COUNT(ou.OrderID) AS NumOrdersFulfilled
					FROM user_information ui, employee_accounts ea, employee_stores es, order_user ou
					WHERE ui.Username = ea.Username AND ea.EmployeeID = es.EmployeeID AND es.IsManager = 'n' AND ea.Username = ou.FulfilledBy AND es.StoreNumber IN (SELECT es2.StoreNumber
																																									 FROM employee_stores es2, employee_accounts ea2
																																									 WHERE ea2.Username = '" . $_SESSION["username"] . "' AND ea2.EmployeeID = es2.EmployeeID)
					GROUP BY ea.EmployeeID
					ORDER BY ui.FirstName;";
			} else if ($orderSelection == 2) {
				$sql = "SELECT ui.FirstName AS FirstName, ui.LastName AS LastName, es.StoreNumber AS StoreNumber, COUNT(ou.OrderID) AS NumOrdersFulfilled
					FROM user_information ui, employee_accounts ea, employee_stores es, order_user ou
					WHERE ui.Username = ea.Username AND ea.EmployeeID = es.EmployeeID AND es.IsManager = 'n' AND ea.Username = ou.FulfilledBy AND es.StoreNumber IN (SELECT es2.StoreNumber
																																									 FROM employee_stores es2, employee_accounts ea2
																																									 WHERE ea2.Username = '" . $_SESSION["username"] . "' AND ea2.EmployeeID = es2.EmployeeID)
					GROUP BY ea.EmployeeID
					ORDER BY ui.LastName;";
			} else if ($orderSelection == 3) {
				$sql = "SELECT ui.FirstName AS FirstName, ui.LastName AS LastName, es.StoreNumber AS StoreNumber, COUNT(ou.OrderID) AS NumOrdersFulfilled
					FROM user_information ui, employee_accounts ea, employee_stores es, order_user ou
					WHERE ui.Username = ea.Username AND ea.EmployeeID = es.EmployeeID AND es.IsManager = 'n' AND ea.Username = ou.FulfilledBy AND es.StoreNumber IN (SELECT es2.StoreNumber
																																									 FROM employee_stores es2, employee_accounts ea2
																																									 WHERE ea2.Username = '" . $_SESSION["username"] . "' AND ea2.EmployeeID = es2.EmployeeID)
					GROUP BY ea.EmployeeID
					ORDER BY es.StoreNumber;";
			} else if ($orderSelection == 4) {
				$sql = "SELECT ui.FirstName AS FirstName, ui.LastName AS LastName, es.StoreNumber AS StoreNumber, COUNT(ou.OrderID) AS NumOrdersFulfilled
					FROM user_information ui, employee_accounts ea, employee_stores es, order_user ou
					WHERE ui.Username = ea.Username AND ea.EmployeeID = es.EmployeeID AND es.IsManager = 'n' AND ea.Username = ou.FulfilledBy AND es.StoreNumber IN (SELECT es2.StoreNumber
																																									 FROM employee_stores es2, employee_accounts ea2
																																									 WHERE ea2.Username = '" . $_SESSION["username"] . "' AND ea2.EmployeeID = es2.EmployeeID)
					GROUP BY ea.EmployeeID
					ORDER BY COUNT(ou.OrderID);";
			} else {
				$sql = "SELECT ui.FirstName AS FirstName, ui.LastName AS LastName, es.StoreNumber AS StoreNumber, COUNT(ou.OrderID) AS NumOrdersFulfilled
					FROM user_information ui, employee_accounts ea, employee_stores es, order_user ou
					WHERE ui.Username = ea.Username AND ea.EmployeeID = es.EmployeeID AND es.IsManager = 'n' AND ea.Username = ou.FulfilledBy AND es.StoreNumber IN (SELECT es2.StoreNumber
																																									 FROM employee_stores es2, employee_accounts ea2
																																									 WHERE ea2.Username = '" . $_SESSION["username"] . "' AND ea2.EmployeeID = es2.EmployeeID)
					GROUP BY ea.EmployeeID;";
			}
			

			
			$result = $pdo->query($sql);
			echo "<div class=\"row\">";
			echo "<div class=\"col-xs-6\">";
			echo "<h1 id=\"employeeInfoNameTitle\">NAME</h1>";
			echo "</div>";
			echo "<div class=\"col-xs-3\">";
			echo "<h1 id=\"employeeInfoStoreNumberTitle\">STORE NUMBER</h1>";
			echo "</div>";
			echo "<div class=\"col-xs-3\">";
			echo "<h1 id=\"employeeInfoNumOrdersFulfilledTitle\">NUMBER OF ORDERS FULFILLED</h1>";
			echo "</div>";
			while ($row = $result->fetch()) {
				echo "<div class=\"col-xs-6\">";
				echo "<h1 class=\"employeeInfoName\">" . $row["FirstName"] . " " . $row["LastName"] . "</h1>";
				echo "</div>";
				echo "<div class=\"col-xs-3\">";
				echo "<h1 class=\"employeeInfoStoreNumber\">" . $row["StoreNumber"] . "</h1>";
				echo "</div>";
				echo "<div class=\"col-xs-3\">";
				echo "<h1 class=\"employeeInfoNumOrdersFulfilled\">" . $row["NumOrdersFulfilled"] . "</h1>";
				echo "</div>";
			}
			echo "</div>";
		} else {
			if ($orderSelection == 1) {
				$sql = "SELECT ui.FirstName AS FirstName, ui.LastName AS LastName, es.StoreNumber AS StoreNumber, COUNT(ou.OrderID) AS NumOrdersFulfilled
					FROM user_information ui, employee_accounts ea, employee_stores es, order_user ou
					WHERE ui.Username = ea.Username AND ea.EmployeeID = es.EmployeeID AND es.IsManager = 'n' AND ea.Username = ou.FulfilledBy AND es.StoreNumber = " . $restaurantSelection  . "
					GROUP BY ea.EmployeeID
					ORDER BY ui.FirstName;";
			} else if ($orderSelection == 2) {
				$sql = "SELECT ui.FirstName AS FirstName, ui.LastName AS LastName, es.StoreNumber AS StoreNumber, COUNT(ou.OrderID) AS NumOrdersFulfilled
					FROM user_information ui, employee_accounts ea, employee_stores es, order_user ou
					WHERE ui.Username = ea.Username AND ea.EmployeeID = es.EmployeeID AND es.IsManager = 'n' AND ea.Username = ou.FulfilledBy AND es.StoreNumber = " . $restaurantSelection  . "
					GROUP BY ea.EmployeeID
					ORDER BY ui.LastName;";
			} else if ($orderSelection == 3) {
				$sql = "SELECT ui.FirstName AS FirstName, ui.LastName AS LastName, es.StoreNumber AS StoreNumber, COUNT(ou.OrderID) AS NumOrdersFulfilled
					FROM user_information ui, employee_accounts ea, employee_stores es, order_user ou
					WHERE ui.Username = ea.Username AND ea.EmployeeID = es.EmployeeID AND es.IsManager = 'n' AND ea.Username = ou.FulfilledBy AND es.StoreNumber = " . $restaurantSelection  . "
					GROUP BY ea.EmployeeID
					ORDER BY es.StoreNumber;";
			} else if ($orderSelection == 4) {
				$sql = "SELECT ui.FirstName AS FirstName, ui.LastName AS LastName, es.StoreNumber AS StoreNumber, COUNT(ou.OrderID) AS NumOrdersFulfilled
					FROM user_information ui, employee_accounts ea, employee_stores es, order_user ou
					WHERE ui.Username = ea.Username AND ea.EmployeeID = es.EmployeeID AND es.IsManager = 'n' AND ea.Username = ou.FulfilledBy AND es.StoreNumber = " . $restaurantSelection  . "
					GROUP BY ea.EmployeeID
					ORDER BY COUNT(ou.OrderID);";
			} else {
				$sql = "SELECT ui.FirstName AS FirstName, ui.LastName AS LastName, es.StoreNumber AS StoreNumber, COUNT(ou.OrderID) AS NumOrdersFulfilled
					FROM user_information ui, employee_accounts ea, employee_stores es, order_user ou
					WHERE ui.Username = ea.Username AND ea.EmployeeID = es.EmployeeID AND es.IsManager = 'n' AND ea.Username = ou.FulfilledBy AND es.StoreNumber = " . $restaurantSelection  . "
					GROUP BY ea.EmployeeID;";
			}
			
			$result = $pdo->query($sql);
			echo "<div class=\"row\">";
			echo "<div class=\"col-xs-6\">";
			echo "<h1 id=\"employeeInfoNameTitle\">NAME</h1>";
			echo "</div>";
			echo "<div class=\"col-xs-3\">";
			echo "<h1 id=\"employeeInfoStoreNumberTitle\">STORE NUMBER</h1>";
			echo "</div>";
			echo "<div class=\"col-xs-3\">";
			echo "<h1 id=\"employeeInfoNumOrdersFulfilledTitle\">NUMBER OF ORDERS FULFILLED</h1>";
			echo "</div>";
			while ($row = $result->fetch()) {
				echo "<div class=\"col-xs-6\">";
				echo "<h1 class=\"employeeInfoName\">" . $row["FirstName"] . " " . $row["LastName"] . "</h1>";
				echo "</div>";
				echo "<div class=\"col-xs-3\">";
				echo "<h1 class=\"employeeInfoStoreNumber\">" . $row["StoreNumber"] . "</h1>";
				echo "</div>";
				echo "<div class=\"col-xs-3\">";
				echo "<h1 class=\"employeeInfoNumOrdersFulfilled\">" . $row["NumOrdersFulfilled"] . "</h1>";
				echo "</div>";
			}
			echo "</div>";
		}
	} else if ($infoTypeSelection == 2) {
		if ($restaurantSelection == 0) {
			$sql1 = "SELECT es.StoreNumber
					 FROM employee_stores es, employee_accounts ea
					 WHERE ea.Username = '" . $_SESSION["username"] . "' AND ea.EmployeeID = es.EmployeeID
					 ORDER BY es.StoreNumber;";
			$result1 = $pdo->query($sql1);
			
			$currentOrderID = 0;
			$currentItemNumber = 0;
			while ($row1 = $result1->fetch()) {
				$totalTotalRevenue = 0;
				$storeInformationPrinted = 0;
				$countValues = array();
				$productNames = array();
				$totalRevenues = array();
				$sql2 = "SELECT *
						 FROM store_product_offerings spo
						 WHERE spo.StoreNumber = " . $row1["StoreNumber"] . ";";
				$result2 = $pdo->query($sql2);
				while ($row2 = $result2->fetch()) {
					$sql3 = "SELECT sl.StoreNumber AS StoreNumber, sl.Address AS Address, sl.City AS City, sl.State AS State, sl.ZipCode AS ZipCode, op.OrderID AS OrderID, op.ItemNumber AS ItemNumber, op.ProductName AS ProductName, SUM(ii.Price) AS Price
							FROM store_locations sl, employee_stores es, order_user ou, order_products op, ingredient_information ii
							WHERE sl.StoreNumber = es.StoreNumber AND es.StoreNumber = ou.StoreNumber AND ou.StoreNumber = " . $row1["StoreNumber"] . " AND ou.OrderID = op.OrderID AND op.IngredientID = ii.IngredientID AND op.ProductName = '" . $row2["ProductName"] . "' AND es.StoreNumber IN (SELECT es2.StoreNumber
																																																																									FROM employee_stores es2, employee_accounts ea2
																																																																									WHERE ea2.Username = '" . $_SESSION["username"] . "' AND ea2.EmployeeID = es2.EmployeeID) AND es.EmployeeID = (SELECT EmployeeID
																																																																																																					FROM employee_accounts
																																																																																																					WHERE Username = '" . $_SESSION["username"] . "')
							GROUP BY op.OrderID, op.ItemNumber;";
					$result3 = $pdo->query($sql3);
					$sql4 = "SELECT sl.StoreNumber AS StoreNumber, sl.Address AS Address, sl.City AS City, sl.State AS State, sl.ZipCode AS ZipCode
							 FROM store_locations sl
							 WHERE sl.StoreNumber = " . $row1["StoreNumber"] . ";";
					$result4 = $pdo->query($sql4);
					while ($row4 = $result4->fetch()) {
						if (!$storeInformationPrinted) {
							echo "<h1 id=\"restaurantInfoRestaurantLocation\">" . $row4["Address"] . " " . $row4["City"] . " " . $row4["State"] . " " . $row4["ZipCode"] . "</h1>";
							$storeInformationPrinted = 1;
						}
					}
					$totalRevenue = 0;
					$count = 0;
					while ($row3 = $result3->fetch()) {
						$totalRevenue += $row3["Price"];
						if (strcmp($row2["ProductType"], "Burger") == 0) {
							$totalRevenue += 2;
						}
						$count++;
					}
					$countValues[] = $count;
					$productNames[] = $row2["ProductName"];
					$totalRevenues[] = $totalRevenue;
					$totalTotalRevenue += $totalRevenue;
				}
				$sql7 = "SELECT sl.StoreNumber AS StoreNumber, sl.Address AS Address, sl.City AS City, sl.State AS State, sl.ZipCode AS ZipCode, op.OrderID AS OrderID, op.ItemNumber AS ItemNumber, op.ProductName AS ProductName, SUM(ii.Price) AS Price
							FROM store_locations sl, employee_stores es, order_user ou, order_products op, ingredient_information ii
							WHERE sl.StoreNumber = es.StoreNumber AND es.StoreNumber = ou.StoreNumber AND ou.StoreNumber = " . $row1["StoreNumber"] . " AND ou.OrderID = op.OrderID AND op.IngredientID = ii.IngredientID AND op.ProductName NOT IN (SELECT ProductName
																																																													 FROM store_product_offerings
																																																													 WHERE StoreNumber = " . $row1["StoreNumber"] . ") AND es.StoreNumber IN (SELECT es2.StoreNumber
																																																																																						 FROM employee_stores es2, employee_accounts ea2
																																																																																						 WHERE ea2.Username = '" . $_SESSION["username"] . "' AND ea2.EmployeeID = es2.EmployeeID) AND es.EmployeeID = (SELECT EmployeeID
																																																																																																																		FROM employee_accounts
																																																																																																																		WHERE Username = '" . $_SESSION["username"] . "')
							GROUP BY op.OrderID, op.ItemNumber;";
				$result7 = $pdo->query($sql7);
				$totalRevenue = 0;
				$count = 0;
				while ($row7 = $result7->fetch()) {
					$totalRevenue += $row7["Price"] + 2;
					$count++;
				}
				$countValues[] = $count;
				$productNames[] = "Custom Burgers";
				$totalRevenues[] = $totalRevenue;
				$totalTotalRevenue += $totalRevenue;
				for ($i = count($countValues) - 1; $i >= 1; $i--) {
					for ($j = 0; $j < $i; $j++) {
						if ($orderSelection == 2) {
							if ($countValues[$j] < $countValues[$j + 1]) {
								$temp = $countValues[$j];
								$countValues[$j] = $countValues[$j + 1];
								$countValues[$j + 1] = $temp;
								
								$temp = $productNames[$j];
								$productNames[$j] = $productNames[$j + 1];
								$productNames[$j + 1] = $temp;
								
								$temp = $totalRevenues[$j];
								$totalRevenues[$j] = $totalRevenues[$j + 1];
								$totalRevenues[$j + 1] = $temp;
							}
						} else if ($orderSelection == 1) {
							if (strcmp(strtolower($productNames[$j]), strtolower($productNames[$j + 1])) > 0) {
								$temp = $countValues[$j];
								$countValues[$j] = $countValues[$j + 1];
								$countValues[$j + 1] = $temp;
								
								$temp = $productNames[$j];
								$productNames[$j] = $productNames[$j + 1];
								$productNames[$j + 1] = $temp;
								
								$temp = $totalRevenues[$j];
								$totalRevenues[$j] = $totalRevenues[$j + 1];
								$totalRevenues[$j + 1] = $temp;
							}
						} else if ($orderSelection == 3) {
							if ($totalRevenues[$j] < $totalRevenues[$j + 1]) {
								$temp = $countValues[$j];
								$countValues[$j] = $countValues[$j + 1];
								$countValues[$j + 1] = $temp;
								
								$temp = $productNames[$j];
								$productNames[$j] = $productNames[$j + 1];
								$productNames[$j + 1] = $temp;
								
								$temp = $totalRevenues[$j];
								$totalRevenues[$j] = $totalRevenues[$j + 1];
								$totalRevenues[$j + 1] = $temp;
							}
						}
					}
				}
				
				$sql5 = "SELECT es.EmployeeID AS EmployeeID, ui.FirstName AS FirstName, ui.LastName AS LastName
						 FROM employee_stores es, employee_accounts ea, user_information ui
						 WHERE es.StoreNumber = " . $row1["StoreNumber"] . " AND es.IsManager = 'y' AND es.EmployeeID = ea.EmployeeID AND ea.Username = ui.Username AND es.EmployeeID IN     (SELECT es2.EmployeeID
																																															  FROM employee_stores es2
																																															  GROUP BY es2.EmployeeID
																																															  HAVING COUNT(es2.StoreNumber) < (SELECT MAX(StoreNumber)
																																																							   FROM store_locations))
						GROUP BY es.EmployeeID;";
				$result5 = $pdo->query($sql5);
				$row5 = $result5->fetch();
				$sql6 = "SELECT es.EmployeeID AS EmployeeID, COUNT(es.StoreNumber) AS NumStoresManaged
						 FROM employee_stores es
						 WHERE es.EmployeeID = " . $row5["EmployeeID"] . ";";
				$result6 = $pdo->query($sql6);
				$row6 = $result6->fetch();
				if ($row6["NumStoresManaged"] > 1) {
					$row5 = $result5->fetch();
					echo "<h1 id=\"restaurantInfoRestaurantManager\">Restaurant Manager: " . $row5["FirstName"] . " " . $row5["LastName"] . "</h1>";
					$result5 = $pdo->query($sql5);
					$row5 = $result5->fetch();
					echo "<h1 id=\"restaurantInfoRegionalManager\">Regional Manager: " . $row5["FirstName"] . " " . $row5["LastName"] . "</h1>";
				} else {
					echo "<h1 id=\"restaurantInfoRestaurantManager\">Restaurant Manager: " . $row5["FirstName"] . " " . $row5["LastName"] . "</h1>";
					$row5 = $result5->fetch();
					echo "<h1 id=\"restaurantInfoRegionalManager\">Regional Manager: " . $row5["FirstName"] . " " . $row5["LastName"] . "</h1>";
				}
				
				echo "<div class=\"row\">";
				echo "<div class=\"col-xs-6\">";
				echo "<h1 id=\"restaurantInfoNameTitle\">NAME</h1>";
				echo "</div>";
				echo "<div class=\"col-xs-3\">";
				echo "<h1 id=\"restaurantInfoQuantityTitle\">QUANTITY</h1>";
				echo "</div>";
				echo "<div class=\"col-xs-3\">";
				echo "<h1 id=\"restaurantInfoSalesTitle\">SALES</h1>";
				echo "</div>";
				
				
				for ($i = 0; $i < count($countValues); $i++) {
					echo "<div class=\"col-xs-6\">";
					echo "<h1 class=\"restaurantInfoName\">" . $productNames[$i] . "</h1>";
					echo "</div>";
					echo "<div class=\"col-xs-3\">";
					echo "<h1 class=\"restaurantInfoQuantity\">" . $countValues[$i] . "</h1>";
					echo "</div>";
					echo "<div class=\"col-xs-3\">";
					echo "<h1 class=\"restaurantInfoSales\">$" . number_format($totalRevenues[$i], 2) . "</h1>";
					echo "</div>";
				}
				
				echo "<div class=\"col-xs-6\">";
				echo "<h1 class=\"restaurantInfoName\">TOTAL</h1>";
				echo "</div>";
				echo "<div class=\"col-xs-3\">";
				echo "<h1 class=\"restaurantInfoQuantity\"></h1>";
				echo "</div>";
				echo "<div class=\"col-xs-3\">";
				echo "<h1 class=\"restaurantInfoSales\">$" . number_format($totalTotalRevenue, 2) . "</h1>";
				echo "</div>";
				echo "</div>";
			}
			
		} else {
			$currentOrderID = 0;
			$currentItemNumber = 0;
			$totalTotalRevenue = 0;
			$storeInformationPrinted = 0;
			$countValues = array();
			$productNames = array();
			$totalRevenues = array();
			$sql1 = "SELECT *
					 FROM store_product_offerings spo
					 WHERE spo.StoreNumber = " . $restaurantSelection . ";";
			$result1 = $pdo->query($sql1);
			while ($row1 = $result1->fetch()) {
				$sql2 = "SELECT sl.StoreNumber AS StoreNumber, sl.Address AS Address, sl.City AS City, sl.State AS State, sl.ZipCode AS ZipCode, op.OrderID AS OrderID, op.ItemNumber AS ItemNumber, op.ProductName AS ProductName, SUM(ii.Price) AS Price
						FROM store_locations sl, employee_stores es, order_user ou, order_products op, ingredient_information ii
						WHERE sl.StoreNumber = es.StoreNumber AND es.StoreNumber = ou.StoreNumber AND ou.StoreNumber = " . $restaurantSelection . " AND ou.OrderID = op.OrderID AND op.IngredientID = ii.IngredientID AND op.ProductName = '" . $row1["ProductName"] . "' AND es.StoreNumber IN (SELECT es2.StoreNumber
																																																																								FROM employee_stores es2, employee_accounts ea2
																																																																								WHERE ea2.Username = '" . $_SESSION["username"] . "' AND ea2.EmployeeID = es2.EmployeeID) AND es.EmployeeID = (SELECT EmployeeID
																																																																																																				FROM employee_accounts
																																																																																																				WHERE Username = '" . $_SESSION["username"] . "')
						GROUP BY op.OrderID, op.ItemNumber;";
				$result2 = $pdo->query($sql2);
				$sql3 = "SELECT sl.StoreNumber AS StoreNumber, sl.Address AS Address, sl.City AS City, sl.State AS State, sl.ZipCode AS ZipCode
						 FROM store_locations sl
						 WHERE sl.StoreNumber = " . $restaurantSelection . ";";
				$result3 = $pdo->query($sql3);
				while ($row3 = $result3->fetch()) {
					if (!$storeInformationPrinted) {
						echo "<h1 id=\"restaurantInfoRestaurantLocation\">" . $row3["Address"] . " " . $row3["City"] . " " . $row3["State"] . " " . $row3["ZipCode"] . "</h1>";
						$storeInformationPrinted = 1;
					}
				}
				
				$totalRevenue = 0;
				$count = 0;
				while ($row2 = $result2->fetch()) {
					$totalRevenue += $row2["Price"];
					if (strcmp($row1["ProductType"], "Burger") == 0) {
						$totalRevenue += 2;
					}
					$count++;
				}
				
				$countValues[] = $count;
				$productNames[] = $row1["ProductName"];
				$totalRevenues[] = $totalRevenue;
				
				$totalTotalRevenue += $totalRevenue;
			}
			$sql6 = "SELECT sl.StoreNumber AS StoreNumber, sl.Address AS Address, sl.City AS City, sl.State AS State, sl.ZipCode AS ZipCode, op.OrderID AS OrderID, op.ItemNumber AS ItemNumber, op.ProductName AS ProductName, SUM(ii.Price) AS Price
						FROM store_locations sl, employee_stores es, order_user ou, order_products op, ingredient_information ii
						WHERE sl.StoreNumber = es.StoreNumber AND es.StoreNumber = ou.StoreNumber AND ou.StoreNumber = " . $restaurantSelection . " AND ou.OrderID = op.OrderID AND op.IngredientID = ii.IngredientID AND op.ProductName NOT IN (SELECT ProductName
																																																												 FROM store_product_offerings
																																																												 WHERE StoreNumber = " . $restaurantSelection . ")  AND es.StoreNumber IN (SELECT es2.StoreNumber
																																																																																					 FROM employee_stores es2, employee_accounts ea2
																																																																																					 WHERE ea2.Username = '" . $_SESSION["username"] . "' AND ea2.EmployeeID = es2.EmployeeID) AND es.EmployeeID = (SELECT EmployeeID
																																																																																																																	FROM employee_accounts
																																																																																																																	WHERE Username = '" . $_SESSION["username"] . "')
						GROUP BY op.OrderID, op.ItemNumber;";
			$result6 = $pdo->query($sql6);
			$totalRevenue = 0;
			$count = 0;
			while ($row6 = $result6->fetch()) {
				$totalRevenue += $row6["Price"] + 2;
				$count++;
			}
			$countValues[] = $count;
			$productNames[] = "Custom Burgers";
			$totalRevenues[] = $totalRevenue;
			$totalTotalRevenue += $totalRevenue;
			for ($i = count($countValues) - 1; $i >= 1; $i--) {
				for ($j = 0; $j < $i; $j++) {
					if ($orderSelection == 2) {
						if ($countValues[$j] < $countValues[$j + 1]) {
							$temp = $countValues[$j];
							$countValues[$j] = $countValues[$j + 1];
							$countValues[$j + 1] = $temp;
							
							$temp = $productNames[$j];
							$productNames[$j] = $productNames[$j + 1];
							$productNames[$j + 1] = $temp;
							
							$temp = $totalRevenues[$j];
							$totalRevenues[$j] = $totalRevenues[$j + 1];
							$totalRevenues[$j + 1] = $temp;
						}
					} else if ($orderSelection == 1) {
						if (strcmp(strtolower($productNames[$j]), strtolower($productNames[$j + 1])) > 0) {
							$temp = $countValues[$j];
							$countValues[$j] = $countValues[$j + 1];
							$countValues[$j + 1] = $temp;
							
							$temp = $productNames[$j];
							$productNames[$j] = $productNames[$j + 1];
							$productNames[$j + 1] = $temp;
							
							$temp = $totalRevenues[$j];
							$totalRevenues[$j] = $totalRevenues[$j + 1];
							$totalRevenues[$j + 1] = $temp;
						}
					} else if ($orderSelection == 3) {
						if ($totalRevenues[$j] < $totalRevenues[$j + 1]) {
							$temp = $countValues[$j];
							$countValues[$j] = $countValues[$j + 1];
							$countValues[$j + 1] = $temp;
							
							$temp = $productNames[$j];
							$productNames[$j] = $productNames[$j + 1];
							$productNames[$j + 1] = $temp;
							
							$temp = $totalRevenues[$j];
							$totalRevenues[$j] = $totalRevenues[$j + 1];
							$totalRevenues[$j + 1] = $temp;
						}
					}
				}
			}
			
			$sql4 = "SELECT es.EmployeeID AS EmployeeID, ui.FirstName AS FirstName, ui.LastName AS LastName
					 FROM employee_stores es, employee_accounts ea, user_information ui
					 WHERE es.StoreNumber = " . $restaurantSelection . " AND es.IsManager = 'y' AND es.EmployeeID = ea.EmployeeID AND ea.Username = ui.Username AND es.EmployeeID IN     (SELECT es2.EmployeeID
																																														  FROM employee_stores es2
																																														  GROUP BY es2.EmployeeID
																																														  HAVING COUNT(es2.StoreNumber) < (SELECT MAX(StoreNumber)
																																																						   FROM store_locations))
					GROUP BY es.EmployeeID;";
			$result4 = $pdo->query($sql4);
			$row4 = $result4->fetch();
			$sql5 = "SELECT es.EmployeeID AS EmployeeID, COUNT(es.StoreNumber) AS NumStoresManaged
					 FROM employee_stores es
					 WHERE es.EmployeeID = " . $row4["EmployeeID"] . ";";
			$result5 = $pdo->query($sql5);
			$row5 = $result5->fetch();
			if ($row5["NumStoresManaged"] > 1) {
				$row4 = $result4->fetch();
				echo "<h1 id=\"restaurantInfoRestaurantManager\">Restaurant Manager: " . $row4["FirstName"] . " " . $row4["LastName"] . "</h1>";
				$result4 = $pdo->query($sql4);
				$row4 = $result4->fetch();
				echo "<h1 id=\"restaurantInfoRegionalManager\">Regional Manager: " . $row4["FirstName"] . " " . $row4["LastName"] . "</h1>";
			} else {
				echo "<h1 id=\"restaurantInfoRestaurantManager\">Restaurant Manager: " . $row4["FirstName"] . " " . $row4["LastName"] . "</h1>";
				$row4 = $result4->fetch();
				echo "<h1 id=\"restaurantInfoRegionalManager\">Regional Manager: " . $row4["FirstName"] . " " . $row4["LastName"] . "</h1>";
			}
			
			echo "<div class=\"row\">";
			echo "<div class=\"col-xs-6\">";
			echo "<h1 id=\"restaurantInfoNameTitle\">NAME</h1>";
			echo "</div>";
			echo "<div class=\"col-xs-3\">";
			echo "<h1 id=\"restaurantInfoQuantityTitle\">QUANTITY</h1>";
			echo "</div>";
			echo "<div class=\"col-xs-3\">";
			echo "<h1 id=\"restaurantInfoSalesTitle\">SALES</h1>";
			echo "</div>";
			
			
			for ($i = 0; $i < count($countValues); $i++) {
				echo "<div class=\"col-xs-6\">";
				echo "<h1 class=\"restaurantInfoName\">" . $productNames[$i] . "</h1>";
				echo "</div>";
				echo "<div class=\"col-xs-3\">";
				echo "<h1 class=\"restaurantInfoQuantity\">" . $countValues[$i] . "</h1>";
				echo "</div>";
				echo "<div class=\"col-xs-3\">";
				echo "<h1 class=\"restaurantInfoSales\">$" . number_format($totalRevenues[$i], 2) . "</h1>";
				echo "</div>";
			}
			
			echo "<div class=\"col-xs-6\">";
			echo "<h1 class=\"restaurantInfoName\">TOTAL</h1>";
			echo "</div>";
			echo "<div class=\"col-xs-3\">";
			echo "<h1 class=\"restaurantInfoQuantity\"></h1>";
			echo "</div>";
			echo "<div class=\"col-xs-3\">";
			echo "<h1 class=\"restaurantInfoSales\">$" . number_format($totalTotalRevenue, 2) . "</h1>";
			echo "</div>";
			echo "</div>";
		}
	} else if ($infoTypeSelection == 3) {
		$currentOrderID = 0;
		$currentItemNumber = 0;
		$totalTotalRevenue = 0;
		$countValues = array();
		$productNames = array();
		$totalRevenues = array();
		$sql1 = "SELECT DISTINCT spo.ProductName AS ProductName, spo.ProductType AS ProductType
				 FROM store_product_offerings spo;";
		$result1 = $pdo->query($sql1);
		while ($row1 = $result1->fetch()) {
			$sql2 = "SELECT op.OrderID AS OrderID, op.ItemNumber AS ItemNumber, op.ProductName AS ProductName, SUM(ii.Price) AS Price
					FROM order_products op, ingredient_information ii
					WHERE op.IngredientID = ii.IngredientID AND op.ProductName = '" . $row1["ProductName"] . "'
					GROUP BY op.OrderID, op.ItemNumber;";
			$result2 = $pdo->query($sql2);
			$totalRevenue = 0;
			$count = 0;
			while ($row2 = $result2->fetch()) {
				$totalRevenue += $row2["Price"];
				if (strcmp($row1["ProductType"], "Burger") == 0) {
					$totalRevenue += 2;
				}
				$count++;
			}
			
			$countValues[] = $count;
			$productNames[] = $row1["ProductName"];
			$totalRevenues[] = $totalRevenue;

			$totalTotalRevenue += $totalRevenue;
		}
		$sql3 = "SELECT op.OrderID AS OrderID, op.ItemNumber AS ItemNumber, op.ProductName AS ProductName, SUM(ii.Price) AS Price
				FROM order_products op, ingredient_information ii
				WHERE op.IngredientID = ii.IngredientID AND op.ProductName NOT IN (SELECT ProductName
																					 FROM store_product_offerings)
				GROUP BY op.OrderID, op.ItemNumber;";
		$result3 = $pdo->query($sql3);
		$totalRevenue = 0;
		$count = 0;
		while ($row3 = $result3->fetch()) {
			$totalRevenue += $row3["Price"] + 2;
			$count++;
		}
		$countValues[] = $count;
		$productNames[] = "Custom Burgers";
		$totalRevenues[] = $totalRevenue;
		$totalTotalRevenue += $totalRevenue;
		
		for ($i = count($countValues) - 1; $i >= 1; $i--) {
			for ($j = 0; $j < $i; $j++) {
				if ($orderSelection == 2) {
					if ($countValues[$j] < $countValues[$j + 1]) {
						$temp = $countValues[$j];
						$countValues[$j] = $countValues[$j + 1];
						$countValues[$j + 1] = $temp;
						
						$temp = $productNames[$j];
						$productNames[$j] = $productNames[$j + 1];
						$productNames[$j + 1] = $temp;
						
						$temp = $totalRevenues[$j];
						$totalRevenues[$j] = $totalRevenues[$j + 1];
						$totalRevenues[$j + 1] = $temp;
					}
				} else if ($orderSelection == 1) {
					if (strcmp(strtolower($productNames[$j]), strtolower($productNames[$j + 1])) > 0) {
						$temp = $countValues[$j];
						$countValues[$j] = $countValues[$j + 1];
						$countValues[$j + 1] = $temp;
						
						$temp = $productNames[$j];
						$productNames[$j] = $productNames[$j + 1];
						$productNames[$j + 1] = $temp;
						
						$temp = $totalRevenues[$j];
						$totalRevenues[$j] = $totalRevenues[$j + 1];
						$totalRevenues[$j + 1] = $temp;
					}
				} else if ($orderSelection == 3) {
					if ($totalRevenues[$j] < $totalRevenues[$j + 1]) {
						$temp = $countValues[$j];
						$countValues[$j] = $countValues[$j + 1];
						$countValues[$j + 1] = $temp;
						
						$temp = $productNames[$j];
						$productNames[$j] = $productNames[$j + 1];
						$productNames[$j + 1] = $temp;
						
						$temp = $totalRevenues[$j];
						$totalRevenues[$j] = $totalRevenues[$j + 1];
						$totalRevenues[$j + 1] = $temp;
					}
				}
			}
		}
		
		echo "<div class=\"row\">";
		echo "<div class=\"col-xs-6\">";
		echo "<h1 id=\"productInfoNameTitle\">NAME</h1>";
		echo "</div>";
		echo "<div class=\"col-xs-3\">";
		echo "<h1 id=\"productInfoQuantityTitle\">QUANTITY</h1>";
		echo "</div>";
		echo "<div class=\"col-xs-3\">";
		echo "<h1 id=\"productInfoSalesTitle\">SALES</h1>";
		echo "</div>";
		
		for ($i = 0; $i < count($countValues); $i++) {
			echo "<div class=\"col-xs-6\">";
			echo "<h1 class=\"productInfoName\">" . $productNames[$i] . "</h1>";
			echo "</div>";
			echo "<div class=\"col-xs-3\">";
			echo "<h1 class=\"productInfoQuantity\">" . $countValues[$i] . "</h1>";
			echo "</div>";
			echo "<div class=\"col-xs-3\">";
			echo "<h1 class=\"productInfoSales\">$" . number_format($totalRevenues[$i], 2) . "</h1>";
			echo "</div>";
		}
		
		echo "<div class=\"col-xs-6\">";		
		echo "<h1 class=\"productInfoName\">TOTAL</h1>";
		echo "</div>";
		echo "<div class=\"col-xs-3\">";
		echo "<h1 class=\"productInfoQuantity\"></h1>";
		echo "</div>";
		echo "<div class=\"col-xs-3\">";
		echo "<h1 class=\"productInfoSales\">$" . number_format($totalTotalRevenue, 2) . "</h1>";
		echo "</div>";
		echo "</div>";
	}
?>