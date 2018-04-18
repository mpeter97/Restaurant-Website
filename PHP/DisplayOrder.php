<?php
	session_start();
	$subtotal = 0;
	$numItems = 0;
	for ($i = 1; $i < $_SESSION["currentItemNumber"]; $i++) {
		if ($_SESSION["prices"][$i] == -1) {
			continue;
		} else {
			$numItems++;
			if ($numItems == 1) {
				echo "<div id=\"orderContents\">";
				echo "<h1 id=\"orderTitle\">ORDER CONTENTS</h1>";
			}
		}
		echo "<div class=\"row\">";
		echo "<div class=\"col-xs-8\">";
		echo "<h1 class=\"orderItem\">" . $_SESSION["orderItems"][$i] . " <span class=\"removeItem\" onclick=\"removeItem(" . $i . ");\"> (remove)</span></h1>";
		echo "</div>";
		echo "<div class=\"col-xs-4\">";
		echo "<h1 class=\"itemPrice\">$" . number_format($_SESSION["prices"][$i], 2) . "</h1>";
		echo "</div>";
		echo "</div>";
		$itemIngredients = explode(',', $_SESSION["orderIngredients"][$i]);
		if (count($itemIngredients) > 1) {
			echo "<div class=\"row\">";
			echo "<div class=\"col-xs-8\">";
			echo "<h1 class=\"itemIngredients\">" . $_SESSION["orderIngredients"][$i] . "</h1>";
			echo "</div>";
			echo "<div class=\"col-xs-4\">";
			echo "</div>";
			echo "</div>";
		}
		$subtotal += $_SESSION["prices"]{$i};
	}
	if ($numItems > 0) {
		echo "<br /><br />";
		echo "<div class=\"row\">";
		echo "<div class=\"col-xs-8\">";
		echo "<h1 id=\"orderSubtotal\">SUBTOTAL</h1>";
		echo "</div>";
		echo "<div class=\"col-xs-4\">";
		echo "<h1 id=\"subtotalAmount\">$" . number_format($subtotal, 2) . "</h1>";
		echo "</div>";
		echo "</div>";
		echo "<div class=\"row\">";
		echo "<div class=\"col-xs-8\">";
		echo "<h1 id=\"orderTax\">TAX</h1>";
		echo "</div>";
		echo "<div class=\"col-xs-4\">";
		echo "<h1 id=\"taxAmount\">$" . number_format($subtotal * 0.06, 2) . "</h1>";
		echo "</div>";
		echo "</div>";
		echo "<div class=\"row\">";
		echo "<div class=\"col-xs-8\">";
		echo "<h1 id=\"orderTotal\">TOTAL</h1>";
		echo "</div>";
		echo "<div class=\"col-xs-4\">";
		echo "<h1 id=\"totalAmount\">$" . number_format($subtotal * 1.06, 2) . "</h1>";
		echo "</div>";
		echo "</div>";
		echo "<div class=\"row\">";
		echo "<div class=\"col-xs-12\">";
		echo "<button id=\"checkoutButton\" onclick=\"displayReceipt();\">CHECKOUT</button>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
	}
?>