<?php
	echo "<div class=\"contactUs\">";
	echo "<h1 id=\"commentsTitle\">Tell us how YOU feel!</h1>";
	
	if (strcmp($_SESSION["username"], "") == 0) {
		echo "<div class=\"row\">";
		echo "<div class=\"col-md-6 form-group\">";
		echo "<span class=\"glyphicon glyphicon-user\"></span>";
		echo "<h1 class=\"contact-label\">Name</h1>";
		echo "<input id=\"name\" type=\"text\" placeholder=\"Your Name\" name=\"name\">";
		echo "</div>";
		echo "<div class=\"col-md-6 form-group\">";
		echo "<span class=\"glyphicon glyphicon-envelope\"></span>";
		echo "<h1 class=\"contact-label\">Email</h1>";
		echo "<input id=\"email\" type=\"email\" placeholder=\"email@website.com\" name=\"email\">";
		echo "</div>";
		echo "<div class=\"col-md-6 form-group\">";
		echo "<span class=\"glyphicon glyphicon-earphone\"></span>";
		echo "<h1 class=\"contact-label\">Phone</h1>";
		echo "<input id=\"tel\" type=\"tel\" placeholder=\"###-###-####\" name=\"tel\">";
		echo "</div>";
		echo "<div class=\"col-md-6 form-group\">";
		echo "<h1 class=\"contact-label\">Reason for Contact</h1>";
		echo "<select id=\"contactType\" class=\"contactType\" name=\"contactType\">";
		echo "<option value=\"comment\">Comment</option>";
		echo "<option value=\"concern\">Concern</option>";
		echo "</select>";
		echo "</div>";
	} else {
		echo "<div class=\"row\">";
		echo "<div class=\"col-md-12 form-group-logged-in\">";
		echo "<h1 class=\"contact-label\">Reason for Contact</h1>";
		echo "<select id=\"contactType\" class=\"contactType\" name=\"contactType\">";
		echo "<option value=\"comment\">Comment</option>";
		echo "<option value=\"concern\">Concern</option>";
		echo "</select>";
		echo "</div>";
	}
	echo "<div class=\"col-md-12\">";
	echo "<textarea rows=\"6\" cols=\"100\" id=\"commentArea\" name=\"comment\" placeholder=\"Enter your thoughts here...\"></textarea>";
	echo "<button class=\"commentSubmit\" onclick=\"submitComment();\">Submit</button>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
?>