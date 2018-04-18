<?php
	session_start();
	if (isset($_GET["enteredUsername"])) {
		$username = $_GET["enteredUsername"];
	} else {
		$username = "";
	}
	if (isset($_GET["enteredPassword"])) {
		$password = $_GET["enteredPassword"];
	} else {
		$password = "";
	}
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	$sql = "SELECT es.StoreNumber AS StoreNumber
			FROM user_login ul, employee_accounts ea, employee_stores es
			WHERE ul.Username = '" . $username . "' AND ul.Password = '" . md5($password) . "' AND ea.Username = ul.Username AND ea.EmployeeID = es.EmployeeID AND es.IsManager = 'y';";
	$result = $pdo->query($sql);
	$sql2 = "SELECT es.StoreNumber AS StoreNumber
			 FROM employee_accounts ea, employee_stores es
			 WHERE ea.Username = '" . $_SESSION["username"] . "' AND ea.EmployeeID = es.EmployeeID;";
	$result2 = $pdo->query($sql2);
	$validManager = 0;
	while ($row = $result->fetch()) {
		$result2 = $pdo->query($sql2);
		while ($row2 = $result2->fetch()) {
			if ($row["StoreNumber"] == $row2["StoreNumber"]) {
				$validManager = 1;
			}
		}
	}
	
	if ($validManager == 0) {
		echo "Invalid";
	} else {
		$result2 = $pdo->query($sql2);
		while ($row2 = $result2->fetch()) {
			echo $row2["StoreNumber"];
		}
	}
	
	
	
?>