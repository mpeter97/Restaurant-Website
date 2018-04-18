<?php
    session_start(); 
	if (strcmp($_SESSION["login"], "register") == 0) {
		$_SESSION["login"] = "login";
	} else {
		$_SESSION["login"] = "register";
	}
?>
	