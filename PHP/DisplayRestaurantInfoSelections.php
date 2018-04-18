<?php
	session_start();

	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	$managerType = $_GET["managerType"];
	
	echo "<form>";
	
	if (strcmp($managerType, "MultipleManager") == 0) {
		echo "<select id=\"restaurant-selector\" name=\"restaurantSelection\" onchange=\"displayRestaurantInfo(restaurantSelection.value, infoTypeSelection.value, 0);\">";
		echo "<option value=\"0\">SELECT A RESTAURANT</option>";
				
				
		$sql = "SELECT EmployeeID
				FROM employee_accounts
				WHERE Username = '" . $_SESSION["username"] . "';";
		$result = $pdo->query($sql);
		while ($row = $result->fetch()) {
			$sql2 = "SELECT sl.StoreNumber AS StoreNumber, sl.Address AS Address, sl.City AS City, sl.State AS State
					 FROM employee_stores es, store_locations sl
					 WHERE es.EmployeeID = " . $row["EmployeeID"] . " AND es.StoreNumber = sl.StoreNumber;";
			$result2 = $pdo->query($sql2);

			while ($row2 = $result2->fetch()) {
				echo "<option value=\"" . $row2["StoreNumber"] . "\">";
				echo $row2["Address"] . ", " . $row2["City"] . ", " . $row2["State"];
				echo "</option>";
			}
		}
				
		echo "</select>";
	}
	if (strcmp($managerType, "SingleManager") == 0) {
		$restaurantSelection = 0;
		$sql1 = "SELECT EmployeeID
				 FROM employee_accounts
				 WHERE Username = '" . $_SESSION["username"] . "';";
		$result1 = $pdo->query($sql1);
		while ($row1 = $result1->fetch()) {
			$sql2 = "SELECT *
					 FROM employee_stores
					 WHERE EmployeeID = " . $row1["EmployeeID"] . ";";
			$result2 = $pdo->query($sql2);
			while ($row2 = $result2->fetch()) {
				$restaurantSelection = $row2["StoreNumber"];
			}
		}
		echo "<select id=\"info-type-selector\" name=\"infoTypeSelection\" onchange=\"displayRestaurantInfo(" . $restaurantSelection . ", infoTypeSelection.value, 0);\">";
		echo "<option value=\"0\">SELECT INFO TYPE</option>";
		echo "<option value=\"1\">EMPLOYEE INFO</option>";
		echo "<option value=\"2\">RESTAURANT INFO</option>";
		echo "<option value=\"3\">PRODUCT INFO</option>";		
		echo "</select>";
	} else if (strcmp($managerType, "MultipleManager") == 0) {
		echo "<select id=\"info-type-selector\" name=\"infoTypeSelection\" onchange=\"displayRestaurantInfo(restaurantSelection.value, infoTypeSelection.value, 0);\">";
		echo "<option value=\"0\">SELECT INFO TYPE</option>";
		echo "<option value=\"1\">EMPLOYEE INFO</option>";
		echo "<option value=\"2\">RESTAURANT INFO</option>";
		echo "<option value=\"3\">PRODUCT INFO</option>";		
		echo "</select>";
	}
	
	
	echo "</form>";


?>