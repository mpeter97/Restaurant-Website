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
    echo("<div class='username'><input type = 'text' id='usernameBox' placeholder = 'Username' name='username'></div>");
	echo("<span id=\"usernameLoginError\"></span>");
    echo("<div class='password'><input type = 'password' id='passwordBox' placeholder = 'Password' name='password'></div>");
	echo("<span id=\"passwordLoginError\"></span>");
	echo("<br />");
    echo("<button id=\"loginButton\" onclick=\"validateFormLogin();\">Login</button>");
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
	  echo("<span id=\"firstNameRegisterError\"></span>");
	  echo("</div>"); //End row
    echo("<div class='row'>");
      echo("<div class='col-xs-12'><input style=\"width: 100%;\" type = 'text' id='lastName' placeholder = 'Last Name' name='last'></div>");
	  echo("<span id=\"lastNameRegisterError\"></span>");
    echo("</div>"); //End row
    echo("<div class='row'>");
      echo("<div class='col-xs-12' ><input style=\"width: 100%;\" type = 'text' id='username' placeholder = 'Username' name='username'></div>");
	  echo("<span id=\"usernameRegisterError\"></span>");
	  echo("</div>"); //End row
    echo("<div class='row'>");
      echo("<div class='col-xs-12' ><input style=\"width: 100%;\" type = 'password' id='password' placeholder = 'Password' name='password'></div>");
	   echo("<span id=\"passwordRegisterError\"></span>");
	  echo("</div>"); //End row
    echo("<div class='row'>");
      echo("<div class='col-xs-12' id='confirm'><input style=\"width: 100%;\" type = 'password' id='confirmPassword' placeholder = 'Confirm Password' name='confirm'></div>");
		 echo("<span id=\"confirmPasswordRegisterError\"></span>");
	echo("</div>"); //End of row
    echo("<div class='row'>");
      echo("<div id='tableAddress' class='col-xs-12'><input style=\"width: 100%;\" type = 'text' id='address' placeholder = 'Address' name='address'></div>");
	   echo("<span id=\"addressRegisterError\"></span>");
	echo("</div>"); //End of row
    echo("<div class='row'>");
	  echo("<div class='col-xs-12'><input style=\"width: 100%;\" type = 'text' id='city' placeholder = 'City' name='city'></div>");
	   echo("<span id=\"cityRegisterError\"></span>");
	  echo("</div>"); //End row
    echo("<div class='row'>");
      echo("<div class='col-xs-12'><input style=\"width: 100%;\" type = 'text' id='state' placeholder = 'State' name='state'></div>");
	   echo("<span id=\"stateRegisterError\"></span>");
	  echo("</div>"); //End row
    echo("<div class='row'>");
      echo("<div class='col-xs-12'><input style=\"width: 100%;\" type = 'text' id='zipCode' placeholder = 'Zip Code' name='zipCode'></div>");
	 echo("<span id=\"zipCodeRegisterError\"></span>");
	echo("</div>");
    echo("<button id=\"registerButton\" onclick=\"validateFormRegister();\">Register</button>");
	echo("<br />");
	echo("<button id=\"backToLoginButton\" onclick=\"changePageType()\">Back to Login</button>");
    echo("</div>"); //close myTable
    echo("</div>");
  }
  

?>
</div>
<script>
/*
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
	}*/
	
	function changePageType() {
		xmlhttp = new XMLHttpRequest();
		
		xmlhttp.open("GET", "ChangeLoginPage.php", true);
		xmlhttp.send();
		window.setTimeout(innerChangePageType, 10);
		function innerChangePageType() {
			document.location.href = "./LoginPage.php";
		}
	}
	
	function initializeFormLogin() {
	  var usernameBox = document.getElementById("usernameBox");
	  var passwordBox = document.getElementById("passwordBox");

	  usernameBox.onchange = resetUsernameBox;
	  passwordBox.onchange = resetPasswordBox;
	}
	
	function initializeFormRegister() {
		var firstName = document.getElementById("firstName");
		var lastName = document.getElementById("lastName");
		var username = document.getElementById("username");
		var password = document.getElementById("password");
		var confirmPassword = document.getElementById("confirmPassword");
		var address = document.getElementById("address");
		var city = document.getElementById("city");
		var state = document.getElementById("state");
		var zipCode = document.getElementById("zipCode");
		
		firstName.onchange = resetFirstName;
	    lastName.onchange = resetLastName;
	    username.onchange = resetUsername;
	    password.onchange = resetPassword;
	    confirmPassword.onchange = resetConfirmPassword;
	    address.onchange = resetAddress;
	    city.onchange = resetCity;
	    state.onchange = resetState;
	    zipCode.onchange = resetZipCode;
	}
	
	function resetUsernameBox() {
	  document.getElementById('usernameBox').style.backgroundColor = 'white';
	  document.getElementById('usernameBox').style.color = 'black';
	  document.getElementById('usernameLoginError').innerHTML = '';
	}
	
	function resetPasswordBox() {
	  document.getElementById('passwordBox').style.backgroundColor = 'white';
	  document.getElementById('passwordBox').style.color = 'black';
	  document.getElementById('passwordLoginError').innerHTML = '';
	}

	function resetFirstName() {
	  document.getElementById('firstName').style.backgroundColor = 'white';
	  document.getElementById('firstName').style.color = 'black';
	  document.getElementById('firstNameRegisterError').innerHTML = '';
	}

	function resetLastName() {
	  document.getElementById('lastName').style.backgroundColor = 'white';
	  document.getElementById('lastName').style.color = 'black';
	  document.getElementById('lastNameRegisterError').innerHTML = '';
	}
	
	function resetUsername() {
	  document.getElementById('username').style.backgroundColor = 'white';
	  document.getElementById('username').style.color = 'black';
	  document.getElementById('usernameRegisterError').innerHTML = '';
	}
	
	function resetPassword() {
	  document.getElementById('password').style.backgroundColor = 'white';
	  document.getElementById('password').style.color = 'black';
	  document.getElementById('passwordRegisterError').innerHTML = '';
	}
	
	function resetConfirmPassword() {
	  document.getElementById('confirmPassword').style.backgroundColor = 'white';
	  document.getElementById('confirmPassword').style.color = 'black';
	  document.getElementById('confirmPasswordRegisterError').innerHTML = '';
	}
	
	function resetAddress() {
	  document.getElementById('address').style.backgroundColor = 'white';
	  document.getElementById('address').style.color = 'black';
	  document.getElementById('addressRegisterError').innerHTML = '';
	}
	
	function resetCity() {
	  document.getElementById('city').style.backgroundColor = 'white';
	  document.getElementById('city').style.color = 'black';
	  document.getElementById('cityRegisterError').innerHTML = '';
	}
	
	function resetState() {
	  document.getElementById('state').style.backgroundColor = 'white';
	  document.getElementById('state').style.color = 'black';
	  document.getElementById('stateRegisterError').innerHTML = '';
	}
	
	function resetZipCode() {
	  document.getElementById('zipCode').style.backgroundColor = 'white';
	  document.getElementById('zipCode').style.color = 'black';
	  document.getElementById('zipCodeRegisterError').innerHTML = '';
	}

	
	function validateFormLogin() {
	  var errorFlag = false;
      var usernameBoxTest = /^[a-zA-Z0-9]{1,40}$/;
	  var passwordBoxTest = /^[a-zA-Z0-9]{8,40}$/;
	  
	  if(!usernameBoxTest.test(usernameBox.value)) {
		document.getElementById('usernameBox').style.backgroundColor = '#bb3333';
		document.getElementById('usernameBox').style.color = 'white';
		document.getElementById('usernameLoginError').innerHTML = 'Invalid Username.  Can only contain letters and numbers.';
		document.getElementById('usernameLoginError').style.color = '#FFFFFF';
		errorFlag = true;
	  }
	  
	  if(!passwordBoxTest.test(passwordBox.value)) {
		document.getElementById('passwordBox').style.backgroundColor = '#bb3333';
		document.getElementById('passwordBox').style.color = 'white';
		document.getElementById('passwordLoginError').innerHTML = 'Invalid Password.  Can only contain letters and numbers. Must be at least 8 characters in length.';
		document.getElementById('passwordLoginError').style.color = '#FFFFFF';
		errorFlag = true;
	  }
	  
	  if (!errorFlag) {
		    xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if (this.responseText == "fail") {
						document.getElementById('usernameBox').style.backgroundColor = '#bb3333';
						document.getElementById('usernameBox').style.color = 'white';
						document.getElementById('usernameLoginError').innerHTML = 'Invalid Login.  Username/Password do not exist.';
						document.getElementById('usernameLoginError').style.color = '#FFFFFF';
						
						document.getElementById('passwordBox').style.backgroundColor = '#bb3333';
						document.getElementById('passwordBox').style.color = 'white'
					} else {
						document.location.href = "./Main.php";
					}
				}
			};
			xmlhttp.open("GET", "CheckLogin.php?enteredUsername=" + usernameBox.value + "&enteredPassword=" + passwordBox.value, true);
			xmlhttp.send();
	  }
	}
	

	function validateFormRegister() {
	  var errorFlag = false;
	  var nameTest = /^[a-zA-Z]{1,60}$/;
	  var usernameTest = /^[a-zA-Z0-9]{1,40}$/;
	  var passwordTest = /^[a-zA-Z0-9]{8,40}$/;
	  var addressTest = /^[a-zA-Z0-9 ]{1,255}$/;
	  var cityTest = /^[a-zA-Z ]{1,40}$/;
	  var stateTest = /^[A-Z]{2}$/;
	  var zipCodeTest = /^[0-9]{5}$/;

	  if(!nameTest.test(firstName.value)) {
		document.getElementById('firstName').style.backgroundColor = '#bb3333';
		document.getElementById('firstName').style.color = 'white';
		document.getElementById('firstNameRegisterError').innerHTML = 'Invalid First Name.  Can only contain letters.';
		document.getElementById('firstNameRegisterError').style.color = '#FFFFFF';
		errorFlag = true;
	  }
	  
	  if(!nameTest.test(lastName.value)) {
		document.getElementById('lastName').style.backgroundColor = '#bb3333';
		document.getElementById('lastName').style.color = 'white';
		document.getElementById('lastNameRegisterError').innerHTML = 'Invalid Last Name.  Can only contain letters.';
		document.getElementById('lastNameRegisterError').style.color = '#FFFFFF';
		errorFlag = true;
	  }
	  
	  if(!usernameTest.test(username.value)) {
		document.getElementById('username').style.backgroundColor = '#bb3333';
		document.getElementById('username').style.color = 'white';
		document.getElementById('usernameRegisterError').innerHTML = 'Invalid Username.  Can only contain letters and numbers.';
		document.getElementById('usernameRegisterError').style.color = '#FFFFFF';
		errorFlag = true;
	  }
	  
	  if(!passwordTest.test(password.value)) {
		document.getElementById('password').style.backgroundColor = '#bb3333';
		document.getElementById('password').style.color = 'white';
		document.getElementById('passwordRegisterError').innerHTML = 'Invalid Password.  Can only contain letters and numbers. Must be at least 8 characters in length.';
		document.getElementById('passwordRegisterError').style.color = '#FFFFFF';
		errorFlag = true;
	  }
	  
	  if(!passwordTest.test(confirmPassword.value)) {
		document.getElementById('confirmPassword').style.backgroundColor = '#bb3333';
		document.getElementById('confirmPassword').style.color = 'white';
		document.getElementById('confirmPasswordRegisterError').innerHTML = 'Invalid Password.  Can only contain letters and numbers. Must be at least 8 characters in length.';
		document.getElementById('confirmPasswordRegisterError').style.color = '#FFFFFF';
		errorFlag = true;
	  }
	  
	  if(password.value != confirmPassword.value) {
		document.getElementById('confirmPassword').style.backgroundColor = '#bb3333';
		document.getElementById('confirmPassword').style.color = 'white';
		document.getElementById('confirmPasswordRegisterError').innerHTML = 'Invalid Password.  Passwords do not match.';
		document.getElementById('confirmPasswordRegisterError').style.color = '#FFFFFF';
		errorFlag = true;
	  }
	  
	  if(!addressTest.test(address.value)) {
		document.getElementById('address').style.backgroundColor = '#bb3333';
		document.getElementById('address').style.color = 'white';
		document.getElementById('addressRegisterError').innerHTML = 'Invalid Address.  Can only contain letters and numbers.';
		document.getElementById('addressRegisterError').style.color = '#FFFFFF';
		errorFlag = true;
	  }
	  
	  if(!cityTest.test(city.value)) {
		document.getElementById('city').style.backgroundColor = '#bb3333';
		document.getElementById('city').style.color = 'white';
		document.getElementById('cityRegisterError').innerHTML = 'Invalid City.  Can only contain letters.';
		document.getElementById('cityRegisterError').style.color = '#FFFFFF';
		errorFlag = true;
	  }
	  
	  if(!stateTest.test(state.value)) {
		document.getElementById('state').style.backgroundColor = '#bb3333';
		document.getElementById('state').style.color = 'white';
		document.getElementById('stateRegisterError').innerHTML = 'Invalid State.  Must be two capital letters.';
		document.getElementById('stateRegisterError').style.color = '#FFFFFF';
		errorFlag = true;
	  }
	  
	  if(!zipCodeTest.test(zipCode.value)) {
		document.getElementById('zipCode').style.backgroundColor = '#bb3333';
		document.getElementById('zipCode').style.color = 'white';
		document.getElementById('zipCodeRegisterError').innerHTML = 'Invalid Zip Code.  Must be five numbers';
		document.getElementById('zipCodeRegisterError').style.color = '#FFFFFF';
		errorFlag = true;
	  }
	  
	  if (!errorFlag) {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if (this.responseText == "fail") {
					document.getElementById('username').style.backgroundColor = '#bb3333';
					document.getElementById('username').style.color = 'white';
					document.getElementById('usernameRegisterError').innerHTML = 'Invalid Username.  Username already in use.';
					document.getElementById('usernameRegisterError').style.color = '#FFFFFF';
				} else {
					document.location.href = "./Main.php";
				}
			}
		};
		xmlhttp.open("GET", "CheckRegister.php?firstName=" + firstName.value + "&lastName=" + lastName.value + "&username=" + username.value + "&password=" + password.value + "&confirmPassword=" + confirmPassword.value + "&address=" + address.value + "&city=" + city.value + "&state=" + state.value + "&zipCode=" + zipCode.value, true);
		xmlhttp.send();
	  }
	}
	
	initializeFormLogin();
	initializeFormRegister();
</script>

</body>
