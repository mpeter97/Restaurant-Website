<?php
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}



	echo "<form>";
	echo "<select id=\"restaurant-selector\" name=\"restaurantSelection\" onchange=\"startOrder(this.value)\">";
	echo "<option value=\"0\">SELECT A RESTAURANT</option>";
			
	$sql = "SELECT *
			FROM store_locations;";
	$result = $pdo->query($sql);
	while ($row = $result->fetch()) {
		echo "<option value=\"" . $row["StoreNumber"] . "\">";
		echo $row["Address"] . ", " . $row["City"] . ", " . $row["State"];
		echo "</option>";
	}
			
	echo "</select>";
	echo "</form>";
?>