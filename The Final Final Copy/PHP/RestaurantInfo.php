<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Three Guys</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../CSS/Head.css" type="text/css">
  <link rel="stylesheet" href="../CSS/RestaurantInfo.css" type="text/css">
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<?php
	include "Head.php";
?>

<div id="topSpacing"></div>
<div id="restaurantInfoSelections"></div>
<div id="restaurantInfo"></div>

<script>

	function decideRestaurantInfoManagerType() {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				displayRestaurantInfoSelections(this.responseText);
			}
		};
		xmlhttp.open("GET", "DecideRestaurantInfoManagerType.php", true);
		xmlhttp.send();
	}
	
	function displayRestaurantInfoSelections(managerType) {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("restaurantInfoSelections").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "DisplayRestaurantInfoSelections.php?managerType=" + managerType, true);
		xmlhttp.send();
	}
	
	function displayRestaurantInfo(restaurantSelection, infoTypeSelection, orderSelection) {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("restaurantInfo").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "DisplayRestaurantInfo.php?restaurantSelection=" + restaurantSelection + "&infoTypeSelection=" + infoTypeSelection + "&orderSelection=" + orderSelection, true);
		xmlhttp.send();
	}
	
	decideRestaurantInfoManagerType();
	
</script>
</body>
</html>