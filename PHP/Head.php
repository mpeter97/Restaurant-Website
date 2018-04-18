<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="Main.php">THREE GUYS</a>
    </div>
    <div class="collapse navbar-collapse NavBar" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="Menu.php"><div class="nav-option">MENU</div></a></li>
        <li><a href="Order.php"><div class="nav-option">ORDER</div></a></li>
        <li><a href="Location.php"><div class="nav-option">LOCATIONS</div></a></li>
		<?php
			try {
			  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
			  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
			  die($e->getMessage());
			}
		
		
			if (!isset($_SESSION["username"])) {
				$_SESSION["username"] = "";
			}
			if (strcmp($_SESSION["username"], "") != 0) {
				echo "<li class=\"dropdown\"><a class=\"dropdown-toggle\" id=\"dropdown-button\" data-toggle=\"dropdown\" href=\"#\"><div class=\"nav-option\">OTHER <span class=\"caret\"></span></div></a>";
				echo "<ul class=\"dropdown-menu\">";
				echo "<li id=\"logout\" onclick=\"logout()\">LOGOUT</li>";
				$sql = "SELECT EmployeeID
						FROM employee_accounts
						WHERE Username = '" . $_SESSION["username"] . "';";
				$result = $pdo->query($sql);
				while ($row = $result->fetch()) {
					echo "<li><a class=\"otherOption\" href=\"CustomerOrders.php\">CUSTOMER ORDERS</a></li>";
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
						echo "<li><a class=\"otherOption\" href=\"MenuEditor.php\">MENU EDITOR</a></li>";
						echo "<li><a class=\"otherOption\" href=\"RestaurantInfo.php\">RESTAURANT INFO</a></li>";
						$sql3 = "SELECT COUNT(StoreNumber) AS NumStores
								 FROM store_locations;";
						$result3 = $pdo->query($sql3);
						while ($row3 = $result3->fetch()) {
							if ($row3["NumStores"] == $numStoresManaged) {
								echo "<li><a class=\"otherOption\" href=\"ProductEditor.php\">PRODUCT EDITOR</a></li>";
							}
						}
					}
				}
				
				echo "</ul></li>";
			} else {
				echo  "<li><a href=\"LoginPage.php\"><div class=\"nav-option\">LOGIN</div></a></li>";
			}
		?>
      </ul>
    </div>
  </div>
</nav>

<script>
	function logout() {
		xmlhttp = new XMLHttpRequest();
		
		xmlhttp.open("GET", "Logout.php", true);
		xmlhttp.send();
		window.setTimeout(innerLogout, 25);
		function innerLogout() {
			document.location.href = "./Main.php";
		}
	}
</script>
