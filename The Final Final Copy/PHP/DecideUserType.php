<?php
	session_start();
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	$sql = "SELECT EmployeeID
			FROM employee_accounts
			WHERE Username = '" . $_SESSION["username"] . "';";
	$result = $pdo->query($sql);
	while ($row = $result->fetch()) {
		$sql2 = "SELECT *
				 FROM employee_stores
				 WHERE EmployeeID = " . $row["EmployeeID"] . ";";
		$result2 = $pdo->query($sql2);
		$isManager = 1;
		$numStoresManaged = 0;
		while ($row2 = $result2->fetch()) {
			if ($row2["IsManager"] == 'n') {
				$isManager = 0;
				break;
			} else {
				$numStoresManaged++;
			}
		}
		if ($isManager) {
			if ($numStoresManaged == 1) {
				$result2 = $pdo->query($sql2);
				while ($row2 = $result2->fetch()) {
					echo $row2["StoreNumber"];
				}
			} else {
				echo "MultipleManager";
			}
		} else {
			echo "Employee";
		}
	}
?>