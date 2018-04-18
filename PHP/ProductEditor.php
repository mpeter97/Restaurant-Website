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
  <link rel="stylesheet" href="../CSS/ProductEditor.css" type="text/css">
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<?php
	include "Head.php";
	
	$_SESSION["selectedProductIngredients"] = array();
?>

<div id="productEditorItems"></div>

<script>

	function displayProductEditorItems(productName, productType, insertOrDelete) {
		window.setTimeout(innerDisplayProductEditorItems, 10, productName, productType, insertOrDelete);
		function innerDisplayProductEditorItems(productName, productType) {
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("productEditorItems").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "DisplayProductEditorItems.php?productName=" + productName + "&productType=" + productType + "&insertOrDelete=" + insertOrDelete, true);
			xmlhttp.send();
		}
	}
	
	function addToProducts(productType, ingredient) {
		window.setTimeout(innerAddToProducts, 25, productType, ingredient);
		function innerAddToProducts(productType, ingredient) {
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if (productType == "Burger") {
						document.getElementById("addToProductsBurgerSection").innerHTML = this.responseText;
					} else if (productType == "Side") {
						document.getElementById("addToProductsSideSection").innerHTML = this.responseText;
					} else if (productType == "Drink") {
						document.getElementById("addToProductsDrinkSection").innerHTML = this.responseText;
					}
				}
			};
			xmlhttp.open("GET", "AddToProducts.php?productType=" + productType + "&ingredient=" + ingredient, true);
			xmlhttp.send();
		}
	}
	
	function doneAddingToProducts(productType) {
		var productName = document.getElementById("productName").value;
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", "DoneAddingToProducts.php?productType=" + productType + "&productName=" + productName, true);
		xmlhttp.send();
		window.setTimeout(innerDoneAddingToProducts, 25);
		function innerDoneAddingToProducts() {
			cancelAddingToProducts();
			displayProductEditorItems("None", "None", "None")
			
		}
	}
	
	function cancelAddingToProducts() {
		document.getElementById("addToProductsBurgerSection").innerHTML = "";
		document.getElementById("addToProductsSideSection").innerHTML = "";
		document.getElementById("addToProductsDrinkSection").innerHTML = "";
		
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", "CancelAddingToProducts.php", true);
		xmlhttp.send();
	}
	


	displayProductEditorItems("None", "None", "None");
	
</script>

</body>
</html>