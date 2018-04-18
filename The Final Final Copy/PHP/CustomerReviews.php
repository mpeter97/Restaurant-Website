<div class="custTalk">
<h3>WHAT YOU GUYS SAY</h3>
<div id="myCarousel" class="carousel slide text-center" data-ride="carousel">

  
  <?php
	try {
	  $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  die($e->getMessage());
	}
	
	$sql = "SELECT *
			FROM user_comments uc, user_information ui
			WHERE uc.Selected = 'y' AND uc.Username = ui.Username;";
	$result = $pdo->query($sql);
	/*
	$count = $result->rowCount();
	
	echo "<ol class=\"carousel-indicators\">";
	for ($i = 0; $i < $count; $i++) {
		echo "<li data-target\"#myCarousel\"";
		if ($i == 0) {
			echo " class=\"active\"";
		}
		echo "></li>";
	}
	echo "</ol>";
	*/
	$commentNumber = 1;
	echo "<div class=\"carousel-inner\" role=\"listbox\">";
	foreach($result as $row) {
		if ($commentNumber == 1) {
			echo "<div class=\"item active\">";
		} else {
			echo "<div class=\"item\">";
		}
		echo "<h5>\"" . $row["Comment"] . "\"<br /><span>" . $row["FirstName"] . " " . $row["LastName"] . " from " . $row["City"] . ", " . $row["State"] . "</span></h5>";
		echo "</div>";
		$commentNumber++;
	}
	echo "</div>";
  ?>
  
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
