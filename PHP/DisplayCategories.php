<?php
	session_start();
	$_SESSION["orderLocation"] = $_GET["restaurantSelection"];

	echo "<div class=\"row\">";
	echo "<div class=\"col-xs-12 col-sm-6 col-md-3\">";
	echo "<h1 onclick=\"displayCategoryOptions('burgers', 0); displaySubmitButtons(0);\">BURGERS</h1>";
	echo "</div>";
	echo "<div class=\"col-xs-12 col-sm-6 col-md-3\">";
	echo "<h1 onclick=\"displayCategoryOptions('sides', 0); displayIngredients('sides', '', 0); displaySubmitButtons(0);\">SIDES</h1>";
	echo "</div>";
	echo "<div class=\"col-xs-12 col-sm-6 col-md-3\">";
	echo "<h1 onclick=\"displayCategoryOptions('drinks', 0); displayIngredients('drinks', '', 0); displaySubmitButtons(0);\">DRINKS</h1>";
	echo "</div>";
	echo "<div class=\"col-xs-12 col-sm-6 col-md-3\">";
	echo "<h1 onclick=\"displayCategoryOptions('myBurgers', 0); displayIngredients('myBurgers', '', 0); displaySubmitButtons(0);\">CUSTOM BURGERS</h1>";
	echo "</div>";
	echo "</div>";
?>