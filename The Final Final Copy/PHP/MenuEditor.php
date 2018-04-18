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
  <link rel="stylesheet" href="../CSS/MenuEditor.css" type="text/css">
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<?php
	include "Head.php";
?>

	
<div id="locationSelection"></div>
<div id="menuEditorItems"></div>

<script>

	function decideMenuEditorManagerType() {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if (this.responseText == "MultipleManager") {
					displayMenuEditorManagerStoreSelection();
				} else {
					displayMenuEditorItems(this.responseText, "None", "None", "None");
				}
			}
		};
		xmlhttp.open("GET", "DecideMenuEditorManagerType.php", true);
		xmlhttp.send();
	}
	
	function displayMenuEditorManagerStoreSelection() {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("locationSelection").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "DisplayMenuEditorManagerStoreSelection.php", true);
		xmlhttp.send();
	}
	
	function displayMenuEditorItems(restaurantNumber, productName, productType, insertOrDelete) {
		window.setTimeout(innerDisplayMenuEditorItems, 10, restaurantNumber, productName, productType, insertOrDelete);
		function innerDisplayMenuEditorItems(restaurantNumber, productName, productType, insertOrDelete) {
			document.getElementById("locationSelection").innerHTML = "";
			
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("menuEditorItems").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "DisplayMenuEditorItems.php?restaurantNumber=" + restaurantNumber + "&productName=" + productName + "&productType=" + productType + "&insertOrDelete=" + insertOrDelete, true);
			xmlhttp.send();
		}
	}
	


	decideMenuEditorManagerType();
	
</script>

</body>
</html>