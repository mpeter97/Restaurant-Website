<?php
	session_start();
	$itemNumber = $_GET["itemNumber"];
	$_SESSION["prices"][$itemNumber] = -1;
?>