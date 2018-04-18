<?php session_start(); ?>
<!DOCTYPE html>
<head>
  <title>Three Guys</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../CSS/LoginPage.css" type="text/css">
  <link rel="stylesheet" href="../CSS/Head.css" type="text/css">
</head>

<body>
  <?php
   include "Head.php";
  ?>
 <div class="loginContainer">
<?php
  //Are we trying to log in?
  if (!isset($_SESSION["login"])) {
	  $_SESSION["login"] = "";
  }
  $_SESSION["username"] = "";
  $_SESSION["loginSuccess"] = "";
  $_SESSION["registrationSuccess"] = "";
  if(strcmp($_SESSION["login"], "") == 0 || strcmp($_SESSION["login"], "login") == 0) {
    //Make the login box
    login();
  }
  //Are they trying to register
  else if(strcmp($_SESSION["login"], "register") == 0){
    register();
  }


  function login(){
    //Make the login box
    echo("<div class='login'>");
    echo("<h1 id=\"loginTitle\">LOGIN</h1>");
    //Username
    echo("<div class='username'><input type = 'text' placeholder = 'Username' id='usernameBox' name='username'></div>");
    echo("<div class='password'><input type = 'password' placeholder = 'Password' id='passwordBox' name='password'></div>");
    echo("<button id=\"loginButton\" onclick=\"checkLogin();\">Login</button>");
	echo("<br />");
    echo("<button id=\"createAccountButton\" onclick=\"changePageType();\">Create an Account</button>");
    echo("</div>");
  }

  function register(){
    //Make the login box
    echo("<div class='register'>");
    echo("<h1 id=\"registerTitle\">CREATE ACCOUNT</h1>");
    //Username
    echo("<div class='myTable'>");
    echo("<div class='row'>");
      echo("<div class='col-xs-12'><input style=\"width: 100%;\" type = 'text' id='firstName' placeholder = 'First Name' name='first'></div>");
	  echo("</div>"); //End row
    echo("<div class='row'>");
      echo("<div class='col-xs-12'><input style=\"width: 100%;\" type = 'text' id='lastName' placeholder = 'Last Name' name='last'></div>");
    echo("</div>"); //End row
    echo("<div class='row'>");
      echo("<div class='col-xs-12' ><input style=\"width: 100%;\" type = 'text' id='username' placeholder = 'Username' name='username'></div>");
	  echo("</div>"); //End row
    echo("<div class='row'>");
      echo("<div class='col-xs-12' ><input style=\"width: 100%;\" type = 'password' id='password' placeholder = 'Password' name='password'></div>");
	  echo("</div>"); //End row
    echo("<div class='row'>");
      echo("<div class='col-xs-12' id='confirm'><input style=\"width: 100%;\" type = 'password' id='confirmPassword' placeholder = 'Confirm Password' name='confirm'></div>");
    echo("</div>"); //End of row
    echo("<div class='row'>");
      echo("<div id='tableAddress' class='col-xs-12'><input style=\"width: 100%;\" type = 'text' id='address' placeholder = 'Address' name='address'></div>");
    echo("</div>"); //End of row
    echo("<div class='row'>");
	  echo("<div class='col-xs-12'><input style=\"width: 100%;\" type = 'text' id='city' placeholder = 'City' name='city'></div>");
	  echo("</div>"); //End row
    echo("<div class='row'>");
      echo("<div class='col-xs-12'><input style=\"width: 100%;\" type = 'text' id='state' placeholder = 'State' name='state'></div>");
	  echo("</div>"); //End row
    echo("<div class='row'>");
      echo("<div class='col-xs-12'><input style=\"width: 100%;\" type = 'text' id='zipCode' placeholder = 'Zip Code' name='zipCode'></div>");
    echo("</div>");
    echo("<button id=\"registerButton\" onclick=\"checkRegister();\">Register</button>");
	echo("<br />");
	echo("<button id=\"backToLoginButton\" onclick=\"changePageType()\">Back to Login</button>");
    echo("</div>"); //close myTable
    echo("</div>");
  }
  

?>
</div>
<script>
	function checkLogin() {
		xmlhttp = new XMLHttpRequest();
		var username = document.getElementById("usernameBox").value;
		var password = document.getElementById("passwordBox").value;
		
		xmlhttp.open("GET", "CheckLogin.php?enteredUsername=" + username + "&enteredPassword=" + password, true);
		xmlhttp.send();
		window.setTimeout(innerCheckLogin, 25);
		function innerCheckLogin() {
			document.location.href = "./Main.php";
		}
	}
	
	function checkRegister() {
		xmlhttp = new XMLHttpRequest();
		var firstName = document.getElementById("firstName").value;
		var lastName = document.getElementById("lastName").value;
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;
		var confirmPassword = document.getElementById("confirmPassword").value;
		var address = document.getElementById("address").value;
		var city = document.getElementById("city").value;
		var state = document.getElementById("state").value;
		var zipCode = document.getElementById("zipCode").value;
		xmlhttp.open("GET", "CheckRegister.php?firstName=" + firstName + "&lastName=" + lastName + "&username=" + username + "&password=" + password + "&confirmPassword=" + confirmPassword + "&address=" + address + "&city=" + city + "&state=" + state + "&zipCode=" + zipCode, true);
		xmlhttp.send();
		document.location.href = "./Main.php";
	}
	
	function changePageType() {
		xmlhttp = new XMLHttpRequest();
		
		xmlhttp.open("GET", "ChangeLoginPage.php", true);
		xmlhttp.send();
		document.location.href = "./LoginPage.php";
	}
</script>

</body>
