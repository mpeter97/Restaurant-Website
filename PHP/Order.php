<?php session_start(); ?>
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
  <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
  <link rel="stylesheet" href="../CSS/Head.css" type="text/css">
  <link rel="stylesheet" href="../CSS/Order.css" type="text/css">
</head>
<body>

<?php
	include "Head.php";
	$_SESSION["orderLocation"] = "";
	$_SESSION["selectedItem"] = "";
	$_SESSION["selectedIngredients"] = array();
	$_SESSION["currentItemNumber"] = 1;
	$_SESSION["currentItemType"] = "";
	$_SESSION["orderItems"] = array();
	$_SESSION["orderIngredients"] = array();
	$_SESSION["prices"] = array();
?>

<div id="locationSelection"></div> <!-- This is used to hold the location selection box -->
<div id="orderArea1"></div> <!-- On the menu, this is used to display the categories Burger, Side, Drink, and My Burgers -->
<div id="orderArea2"></div> <!-- On the menu, this is used to display the types of burgers, sides, drinks, and my burgers -->
<div id="orderArea3"></div> <!-- On the menu, this is used to display the ingredients on the burgers and my burgers -->
<div id="submitArea"></div> <!-- This used to hold the "Add to Order"/"Add to Custom Burgers" buttons -->
<div id="namingArea"></div> <!-- This is where you will name custom burgers -->
<div id="resultArea"></div> <!-- This is used to display your current order, the ability to remove items, and the ability to check out -->
<div id="receipt"></div> <!-- Will show final receipt -->

<script>
	
	function checkLogin() {
		if (<?php if ((!isset($_SESSION["username"])) || (strcmp($_SESSION["username"], "") == 0)) { echo "\"false\""; } else { echo "\"\""; } ?> == "false") {
			document.location.href = "./LoginPage.php";
		} else {	
			getOrderLocation();
		}
	}
	
	
	function getOrderLocation() {
		if (<?php echo "\"" . $_SESSION["orderLocation"] . "\""; ?> == "") {
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("locationSelection").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "DisplayOrderLocations.php", true);
			xmlhttp.send();
		}
	}
	
	function startOrder(restaurantSelection) {
		document.getElementById("locationSelection").style.display = "none";
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("orderArea1").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "DisplayCategories.php?restaurantSelection=" + restaurantSelection, true);
		xmlhttp.send();
	}
	
	function displayCategoryOptions(category, selection) {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("orderArea2").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "DisplayItems.php?category=" + category + "&selection=" + selection, true);
		xmlhttp.send();
	}
	
	function displayIngredients(category, selection, ingredient) {
		window.setTimeout(innerDisplayIngredients, 25, category, selection, ingredient);
		function innerDisplayIngredients(category, selection, ingredient) {
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("orderArea3").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "DisplayIngredients.php?category=" + category + "&selection=" + selection + "&ingredient=" + ingredient, true);
			xmlhttp.send();
		}
		
	}
	
	function displaySubmitButtons(type) {
		window.setTimeout(innerDisplaySubmitButtons, 25, type);
		function innerDisplaySubmitButtons(type) {
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("submitArea").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "DisplaySubmitButtons.php?type=" + type, true);
			xmlhttp.send();
		}
	}
	
	function addToOrder(productName, type) {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", "AddToOrder.php?productName=" + productName + "&type=" + type, true);
		xmlhttp.send();
	}
	
	function displayOrder() {
		window.setTimeout(innerDisplayOrder, 25);
		function innerDisplayOrder() {
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("resultArea").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "DisplayOrder.php", true);
			xmlhttp.send();
		}
	}
	
	function addToCustomBurgers() {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("namingArea").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "AddToCustomBurgers.php", true);
		xmlhttp.send();
	}
	
	function cancelAddingToCustomBurgers() {
		document.getElementById("namingArea").innerHTML = "";
	}
	
	function doneAddingToCustomBurgers() {
		var burgerName = document.getElementById("burgerName").value;
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("namingArea").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "DoneAddingToCustomBurgers.php?burgerName=" + burgerName, true);
		xmlhttp.send();
	}
	
	function removeItem(itemNumber) {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", "RemoveItem.php?itemNumber=" + itemNumber, true);
		xmlhttp.send();
		window.setTimeout(innerRemoveItem, 25);
		function innerRemoveItem() {
			displayOrder();
		}
	}
	
	function displayReceipt() {
		document.getElementById("orderArea1").innerHTML = "";
		document.getElementById("orderArea2").innerHTML = "";
		document.getElementById("orderArea3").innerHTML = "";
		document.getElementById("submitArea").innerHTML = "";
		document.getElementById("namingArea").innerHTML = "";
		document.getElementById("resultArea").innerHTML = "";
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("receipt").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "DisplayReceipt.php", true);
		xmlhttp.send();
	}

	checkLogin();
	
	
	
</script>
</body>
</html>
  
  
  
  