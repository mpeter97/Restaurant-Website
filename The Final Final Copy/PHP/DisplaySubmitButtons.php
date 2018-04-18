<?php
	$type = $_GET["type"];
	
	if ($type == 0) {
		echo "";
	} else if ($type == 1) {
		echo "<button class=\"one-button-order\" onclick=\"addToOrder('', 'addToOrder'); displayOrder();\">ADD TO ORDER</button>";
	} else if ($type == 2) {
		echo "<button class=\"two-buttons-order\" onclick=\"addToOrder('', 'addToOrder'); displayOrder();\">ADD TO ORDER</button>";
		echo "<button class=\"two-buttons-custom\" onclick=\"addToCustomBurgers();\">ADD TO CUSTOM BURGERS</button>";
	}
?>