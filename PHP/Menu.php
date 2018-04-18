<?php session_start(); 
if (!(isset($_SESSION["restaurantNumber"]))) {
	$_SESSION["restaurantNumber"] = 1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Three Guys</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../CSS/Head.css" type="text/css">
  <link rel="stylesheet" href="../CSS/Menu.css" type="text/css">
  
  <script>
	function changeRestaurantNumber(valueSelected) {
		xmlhttp = new XMLHttpRequest();
		
		xmlhttp.open("GET", "ChangeMenu.php?menu=" + valueSelected, true);
		xmlhttp.send();
		showMenu();
	}
  
	function showMenu() {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("menuDisplay").innerHTML = this.responseText;
				<?php 
					try {
					  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
					  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					} catch (PDOException $e) {
					  die($e->getMessage());
					}
					
				$restaurantNumber = $_SESSION["restaurantNumber"];
				
				
				$sql = "SELECT COUNT(spo.ProductName) AS NumProducts
						FROM store_product_offerings spo
						GROUP BY spo.StoreNumber;";
				$result = $pdo->query($sql);

				$maxNumItems = -1;
				while ($row = $result->fetch()) {
					if ($row["NumProducts"] > $maxNumItems) {
						$maxNumItems = $row["NumProducts"];
					}
				}
				
				echo "var background = document.getElementById(\"fading-background\");";

				for ($i = 1; $i <= $maxNumItems; $i++) {
					echo "var image" . $i . " = document.getElementById(\"menu-item-" . $i . "\");";
					echo "var itemName" . $i . " = document.getElementById(\"menu-item-name-" . $i . "\");";
					echo "var name" . $i . " = document.getElementById(\"name-" . $i . "\");";
					echo "var picture" . $i . " = document.getElementById(\"menu-item-picture-" . $i . "\");";
					echo "name" . $i . ".style.top = (25 - ((parseInt(name" . $i . ".innerHTML.length / 10)) * 3.5)) + \"%\";";
					echo "image" . $i . ".onmouseover = function() {image" . $i . ".src = \"../Pictures/LitBackground.png\"; picture" . $i . ".src = \"../Pictures/LitBurger.png\"; name" . $i . ".style.color = \"#FFFFFF\";};";
					echo "image" . $i . ".onmouseout = function() {image" . $i . ".src = \"../Pictures/UnlitBackground.png\"; picture" . $i . ".src = \"../Pictures/UnlitBurger.png\"; name" . $i . ".style.color = \"#999999\";};";
					echo "itemName" . $i . ".onmouseover = function() {image" . $i . ".src = \"../Pictures/LitBackground.png\"; picture" . $i . ".src = \"../Pictures/LitBurger.png\"; name" . $i . ".style.color = \"#FFFFFF\";};";
					echo "itemName" . $i . ".onmouseout = function() {image" . $i . ".src = \"../Pictures/UnlitBackground.png\"; picture" . $i . ".src = \"../Pictures/UnlitBurger.png\"; name" . $i . ".style.color = \"#999999\";};";
					echo "picture" . $i . ".onmouseover = function() {image" . $i . ".src = \"../Pictures/LitBackground.png\"; picture" . $i . ".src = \"../Pictures/LitBurger.png\"; name" . $i . ".style.color = \"#FFFFFF\";};";
					echo "picture" . $i . ".onmouseout = function() {image" . $i . ".src = \"../Pictures/UnlitBackground.png\"; picture" . $i . ".src = \"../Pictures/UnlitBurger.png\"; name" . $i . ".style.color = \"#999999\";};";
					
					echo "var modal" . $i . " = document.getElementById(\"content-" . $i . "\");";
					echo "var btn" . $i . "1 = document.getElementById(\"menu-item-" . $i . "\");";
					echo "var btn" . $i . "2 = document.getElementById(\"name-" . $i . "\");";
					echo "var btn" . $i . "3 = document.getElementById(\"menu-item-picture-" . $i . "\");";
					echo "var span" . $i . " = document.getElementById(\"close-" . $i . "\");";
					echo "btn" . $i . "1.onclick = function() {";
					echo "modal" . $i . ".style.display = \"block\";";
					echo "modal" . $i . ".style.animationName = \"fadeIn\";";
					echo "modal" . $i . ".style.zIndex = \"5\";";
					echo "modal" . $i . ".style.animationDelay = \".125s\";";
					echo "background.style.display = \"block\";";
					echo "background.style.animationName = \"backgroundDarken\";";
					echo "background.style.zIndex = \"4\";";
					echo "};";
					echo "btn" . $i . "2.onclick = function() {";
					echo "modal" . $i . ".style.display = \"block\";";
					echo "modal" . $i . ".style.animationName = \"fadeIn\";";
					echo "modal" . $i . ".style.zIndex = \"5\";";
					echo "modal" . $i . ".style.animationDelay = \".125s\";";
					echo "background.style.display = \"block\";";
					echo "background.style.animationName = \"backgroundDarken\";";
					echo "background.style.zIndex = \"4\";";
					echo "};";
					echo "btn" . $i . "3.onclick = function() {";
					echo "modal" . $i . ".style.display = \"block\";";
					echo "modal" . $i . ".style.animationName = \"fadeIn\";";
					echo "modal" . $i . ".style.zIndex = \"5\";";
					echo "modal" . $i . ".style.animationDelay = \".125s\";";
					echo "background.style.display = \"block\";";
					echo "background.style.animationName = \"backgroundDarken\";";
					echo "background.style.zIndex = \"4\";";
					echo "};";
					echo "span" . $i . ".onclick = function() {";
					echo "modal" . $i . ".style.animationName = \"fadeOut\";";
					echo "modal" . $i . ".style.animationDelay = \"0s\";";
					echo "background.style.animationName = \"backgroundBrighten\";";
					echo "};";
				}
				echo "window.onclick = function(event) {";
				echo "if (event.target == background) {";
				for ($i = 1; $i < $maxNumItems; $i++) {
					echo "modal" . $i . ".style.animationName = \"fadeOut\";";
					echo "modal" . $i . ".style.animationDelay = \"0s\";";
				}
				echo "background.style.animationName = \"backgroundBrighten\";";
				echo "}";
				echo "};";
				
				?>
			}
		};
		xmlhttp.open("GET", "DisplayMenu.php", true);
		xmlhttp.send();
	}
  </script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">


<?php
  include "Head.php";
  if (!isset($_SESSION["username"])) {
	  $_SESSION["username"] = "";
  }
?>

<div id="fading-background"></div>

<form>
	<select id="restaurant-selector" name="restaurantSelection" onchange="changeRestaurantNumber(this.value)">
		<option value="0">SELECT A RESTAURANT</option>
		<?php
			$sql = "SELECT *
					FROM store_locations;";
			$result = $pdo->query($sql);
			foreach($result as $row) {
				echo "<option value=\"" . $row["StoreNumber"] . "\">";
				echo $row["Address"] . ", " . $row["City"] . ", " . $row["State"];
				echo "</option>";
			}
		?>
	</select>
</form>

<div id="menuDisplay"></div>


</body>
</html>






