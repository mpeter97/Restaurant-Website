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
  <link rel="stylesheet" href="../CSS/Body.css" type="text/css">
  <link rel="stylesheet" href="../CSS/Footer.css" type="text/css">
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<?php
	if (!isset($_SESSION["username"])) {
		$_SESSION["username"] = "";
	}
	if (((!isset($_SESSION["login"])) || (strcmp($_SESSION["login"], "register") == 0)) && ((!isset($_SESSION["registrationSuccess"])) || (strcmp($_SESSION["registrationSuccess"], "false") != 0))) {
		$_SESSION["login"] = "login";
	}

	  include "Head.php";
	  include "Title.php";
	  include "CustomerReviews.php";
      include "ContactUs.php";
	  include "Footer.php";
?>

<script>
	
	function submitComment() {
		xmlhttp = new XMLHttpRequest();
		var name = "";
		var email = "";
		var tel = "";
		if (<?php if (strcmp($_SESSION["username"], "") == 0) { echo "\"false\""; } else { echo "\"true\""; } ?> == "false") {
			name = document.getElementById("name").value;
			email = document.getElementById("email").value;
			tel = document.getElementById("tel").value;
			document.getElementById("name").value = "";
			document.getElementById("email").value = "";
			document.getElementById("tel").value = "";
		}
		var commentType = document.getElementById("contactType").value;
		var commentArea = document.getElementById("commentArea").value;
		document.getElementById("contactType").value = "comment";
		document.getElementById("commentArea").value = "";
		xmlhttp.open("GET", "SubmitComment.php?name=" + name + "&email=" + email + "&tel=" + tel + "&commentType=" + commentType + "&commentArea=" + commentArea, true);
		xmlhttp.send();
		
		
		
		alert("Thank you for your " + commentType + ".  Your feedback is highly appreciated.");
	}
	
	checkRegistration();
	checkLogin();
</script>

</body>
</html>
