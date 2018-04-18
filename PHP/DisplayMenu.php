<?php
	session_start();

	$restaurantNumber = $_SESSION["restaurantNumber"];
	
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
	  die($e->getMessage());
    }
	

	echo "<div class=\"container-fluid text-center menu\">";

	$sql = "SELECT *
			FROM store_product_offerings spo
			WHERE spo.StoreNumber = '" . $restaurantNumber . "';";
	$result = $pdo->query($sql);
	
	$numBurgers = 0;
	$numSides = 0;
	$numDrinks = 0;
	$numItems = 0;
	foreach ($result as $row) {
		if (strcmp($row["ProductType"], "Burger") == 0) {
			if ($numBurgers == 0) {
				echo "<h2 class=\"menu-title\">BURGERS</h2>";
				echo "<hr class=\"burgers-underline\"/>";
				echo "<br>";
				echo "<div class=\"row\">";
			}
			$numBurgers++;
			$numItems++;
			echo "<div class=\"col-lg-3 col-md-4 col-sm-6 col-xs-12 menu-item\">";
			echo "<img src=\"../Pictures/UnlitBackground.png\" class=\"background-light\" id=\"menu-item-" . $numItems . "\"/>";
			echo "<div class=\"menu-item-name\" id=\"menu-item-name-" . $numItems . "\">";
			echo "<h1 id=\"name-" . $numItems . "\">" . $row["ProductName"] . "</h1>";
			echo "<img src=\"../Pictures/UnlitBurger.png\" id=\"menu-item-picture-" . $numItems . "\"/>";
			echo "</div>";
			echo "</div>";
		}
	}
	
	echo "</div>";
	echo "<br />";
	
	$result = $pdo->query($sql);
	
	foreach ($result as $row) {
		if (strcmp($row["ProductType"], "Side") == 0) {
			if ($numSides == 0) {
				echo "<h2 class=\"menu-title\">SIDES</h2>";
				echo "<hr class=\"sides-underline\"/>";
				echo "<br>";
				echo "<div class=\"row\">";
			}
			$numSides++;
			$numItems++;
			echo "<div class=\"col-lg-3 col-md-4 col-sm-6 col-xs-12 menu-item\">";
			echo "<img src=\"../Pictures/UnlitBackground.png\" class=\"background-light\" id=\"menu-item-" . $numItems . "\"/>";
			echo "<div class=\"menu-item-name\" id=\"menu-item-name-" . $numItems . "\">";
			echo "<h1 id=\"name-" . $numItems . "\">" . $row["ProductName"] . "</h1>";
			echo "<img src=\"../Pictures/UnlitBurger.png\" id=\"menu-item-picture-" . $numItems . "\"/>";
			echo "</div>";
			echo "</div>";
		}
	}
	
	echo "</div>";
	echo "<br />";
	
	$result = $pdo->query($sql);
	
	foreach ($result as $row) {
		if (strcmp($row["ProductType"], "Drink") == 0) {
			if ($numDrinks == 0) {
				echo "<h2 class=\"menu-title\">DRINKS</h2>";
				echo "<hr class=\"drinks-underline\"/>";
				echo "<br>";
				echo "<div class=\"row\">";
			}
			$numDrinks++;
			$numItems++;
			echo "<div class=\"col-lg-3 col-md-4 col-sm-6 col-xs-12 menu-item\">";
			echo "<img src=\"../Pictures/UnlitBackground.png\" class=\"background-light\" id=\"menu-item-" . $numItems . "\"/>";
			echo "<div class=\"menu-item-name\" id=\"menu-item-name-" . $numItems . "\">";
			echo "<h1 id=\"name-" . $numItems . "\">" . $row["ProductName"] . "</h1>";
			echo "<img src=\"../Pictures/UnlitBurger.png\" id=\"menu-item-picture-" . $numItems . "\"/>";
			echo "</div>";
			echo "</div>";
		}
	}
	
	echo "</div>";
	echo "</div>";
	
	$sql1 = "SELECT *
			FROM store_product_offerings spo
			WHERE spo.StoreNumber = '" . $restaurantNumber . "';";
	$result1 = $pdo->query($sql1);
	
	$i = 1;
	foreach ($result1 as $row1) {
		if (strcmp($row1["ProductType"], "Burger") == 0) {
			$sql2 = "SELECT ii.Name, ii.Calories, ii.Carbs, ii.Fat, ii.Sodium
					 FROM store_product_ingredients spi, ingredient_information ii
					 WHERE spi.ProductName = '" . $row1["ProductName"] . "' AND spi.IngredientID = ii.IngredientID;";
			$result2 = $pdo->query($sql2);
			
			$calorieSum = 0;
			$carbSum = 0;
			$fatSum = 0;
			$sodiumSum = 0;
			
			foreach ($result2 as $row2) {
				$calorieSum += $row2["Calories"];
				$carbSum += $row2["Carbs"];
				$fatSum += $row2["Fat"];
				$sodiumSum += $row2["Sodium"];
			}
			echo "<div id=\"content-" . $i . "\" class=\"modal-content\">";
			echo "<div class=\"modal-header\">";
			echo "<span class=\"close\" id=\"close-" . $i . "\">&times;</span>";
			echo "<h2>" . $row1["ProductName"] . "</h2>";
			echo "</div>";
			echo "<div class=\"modal-body\">";
			echo "<p class=\"ingredient-list\">Ingredients</p>";
			echo "<p>";
			$result2 = $pdo->query($sql2);
			$count = $result2->rowCount();
			$currentRow = 1;
			foreach ($result2 as $row2) {
				echo $row2["Name"];
				if ($currentRow != $count) {
					echo ", ";
				}
				$currentRow++;
			}
			echo "</p>";
			echo "</div>";
			echo "<div class=\"modal-footer\">";
			echo "<div class=\"col-xs-6 col-sm-3 calories\">";
			echo "<h3>Calories</h3>";
			echo "<h4>" . $calorieSum . "</h4>";
			echo "</div>";
			echo "<div class=\"col-xs-6 col-sm-3 carbs\">";
			echo "<h3>Carbs (g)</h3>";
			echo "<h4>" . $carbSum . "</h4>";
			echo "</div>";
			echo "<div class=\"col-xs-6 col-sm-3 fat\">";
			echo "<h3>Fat (g)</h3>";
			echo "<h4>" . $fatSum . "</h4>";
			echo "</div>";
			echo "<div class=\"col-xs-6 col-sm-3 sodium\">";
			echo "<h3>Sodium (mg)</h3>";
			echo "<h4>" . $sodiumSum . "</h4>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			$i++;
		}
	}
	
	$result1 = $pdo->query($sql1);
	
	foreach ($result1 as $row1) {
		if (strcmp($row1["ProductType"], "Side") == 0) {
			$sql2 = "SELECT ii.Name, ii.Calories, ii.Carbs, ii.Fat, ii.Sodium
					 FROM store_product_ingredients spi, ingredient_information ii
					 WHERE spi.ProductName = '" . $row1["ProductName"] . "' AND spi.IngredientID = ii.IngredientID;";
			$result2 = $pdo->query($sql2);
			
			$calorieSum = 0;
			$carbSum = 0;
			$fatSum = 0;
			$sodiumSum = 0;
			
			foreach ($result2 as $row2) {
				$calorieSum += $row2["Calories"];
				$carbSum += $row2["Carbs"];
				$fatSum += $row2["Fat"];
				$sodiumSum += $row2["Sodium"];
			}
			echo "<div id=\"content-" . $i . "\" class=\"modal-content\">";
			echo "<div class=\"modal-header\">";
			echo "<span class=\"close\" id=\"close-" . $i . "\">&times;</span>";
			echo "<h2>" . $row1["ProductName"] . "</h2>";
			echo "</div>";
			echo "<div class=\"modal-body\">";
			echo "<p class=\"ingredient-list\">Ingredients</p>";
			echo "<p>";
			$result2 = $pdo->query($sql2);
			$count = $result2->rowCount();
			$currentRow = 1;
			foreach ($result2 as $row2) {
				echo $row2["Name"];
				if ($currentRow != $count) {
					echo ", ";
				}
				$currentRow++;
			}
			echo "</p>";
			echo "</div>";
			echo "<div class=\"modal-footer\">";
			echo "<div class=\"col-xs-6 col-sm-3 calories\">";
			echo "<h3>Calories</h3>";
			echo "<h4>" . $calorieSum . "</h4>";
			echo "</div>";
			echo "<div class=\"col-xs-6 col-sm-3 carbs\">";
			echo "<h3>Carbs (g)</h3>";
			echo "<h4>" . $carbSum . "</h4>";
			echo "</div>";
			echo "<div class=\"col-xs-6 col-sm-3 fat\">";
			echo "<h3>Fat (g)</h3>";
			echo "<h4>" . $fatSum . "</h4>";
			echo "</div>";
			echo "<div class=\"col-xs-6 col-sm-3 sodium\">";
			echo "<h3>Sodium (mg)</h3>";
			echo "<h4>" . $sodiumSum . "</h4>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			$i++;
		}
	}
	
	$result1 = $pdo->query($sql1);
	
	foreach ($result1 as $row1) {
		if (strcmp($row1["ProductType"], "Drink") == 0) {
			$sql2 = "SELECT ii.Name, ii.Calories, ii.Carbs, ii.Fat, ii.Sodium
					 FROM store_product_ingredients spi, ingredient_information ii
					 WHERE spi.ProductName = '" . $row1["ProductName"] . "' AND spi.IngredientID = ii.IngredientID;";
			$result2 = $pdo->query($sql2);
			
			$calorieSum = 0;
			$carbSum = 0;
			$fatSum = 0;
			$sodiumSum = 0;
			
			foreach ($result2 as $row2) {
				$calorieSum += $row2["Calories"];
				$carbSum += $row2["Carbs"];
				$fatSum += $row2["Fat"];
				$sodiumSum += $row2["Sodium"];
			}
			echo "<div id=\"content-" . $i . "\" class=\"modal-content\">";
			echo "<div class=\"modal-header\">";
			echo "<span class=\"close\" id=\"close-" . $i . "\">&times;</span>";
			echo "<h2>" . $row1["ProductName"] . "</h2>";
			echo "</div>";
			echo "<div class=\"modal-body\">";
			echo "<p class=\"ingredient-list\">Ingredients</p>";
			echo "<p>";
			$result2 = $pdo->query($sql2);
			$count = $result2->rowCount();
			$currentRow = 1;
			foreach ($result2 as $row2) {
				echo $row2["Name"];
				if ($currentRow != $count) {
					echo ", ";
				}
				$currentRow++;
			}
			echo "</p>";
			echo "</div>";
			echo "<div class=\"modal-footer\">";
			echo "<div class=\"col-xs-6 col-sm-3 calories\">";
			echo "<h3>Calories</h3>";
			echo "<h4>" . $calorieSum . "</h4>";
			echo "</div>";
			echo "<div class=\"col-xs-6 col-sm-3 carbs\">";
			echo "<h3>Carbs (g)</h3>";
			echo "<h4>" . $carbSum . "</h4>";
			echo "</div>";
			echo "<div class=\"col-xs-6 col-sm-3 fat\">";
			echo "<h3>Fat (g)</h3>";
			echo "<h4>" . $fatSum . "</h4>";
			echo "</div>";
			echo "<div class=\"col-xs-6 col-sm-3 sodium\">";
			echo "<h3>Sodium (mg)</h3>";
			echo "<h4>" . $sodiumSum . "</h4>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			$i++;
		}
	}
?>