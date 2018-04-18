<?php
    session_start(); 
	$NewMenu = $_GET["menu"];
	$_SESSION["restaurantNumber"] = $NewMenu;
?>
	