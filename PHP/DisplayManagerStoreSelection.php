<?php
	session_start();

	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}



	echo "<form>";
	echo "<select id=\"restaurant-selector\" name=\"restaurantSelection\" onchange=\"displayCustomerOrders(this.value);\">";
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
	echo "</form>";
?>