<?php
session_start();
if(!isset($_SESSION['connected'])) {
	$_SESSION['connected'] = 0;
}
if(!isset($_SESSION['try'])) {
	$_SESSION['try'] = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if($_SESSION["connected"]) echo $_SESSION["username"]; else echo 'Login' ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/parallax.css">
	<!--===============================================================================================-->
	<?php
	if($_SESSION["connected"]) {
		echo '<link rel="stylesheet" type="text/css" href="css/button.css">';
	}
	else {
		echo '<link rel="stylesheet" type="text/css" href="css/util.css">';
		echo '<link rel="stylesheet" type="text/css" href="css/main.css">';
	}
	?>

</head>
<body onload="verify_alert()">

	<script>
	function verify_alert() {
		if(document.getElementsByClassName('alert').length > 0) {
			document.getElementsByClassName('exist')[0].style.visibility = "hidden";
			document.getElementsByClassName('exist')[0].style.display = "none";
		}
		else {
			document.getElementsByClassName('exist')[0].style.visibility = "visible";
			document.getElementsByClassName('exist')[0].style.display = "block";
		}
	}
	</script>

	<div id='stars'></div>
	<div id='stars2'></div>

	<?php
	if($_SESSION["connected"]) {
		echo '<h1 align="center" class="username"> Bonjour, '.$_SESSION["username"].'</h1>';
		echo '<a class="btn-8" href="logout.php">Se déconnecter</a>';
	}
	?>

	<div class="container-login100">
		<div class="wrap-login100 p-t-30 p-b-50">
			<span class="login100-form-title p-b-41 exist" style="visibility: hidden; display: block">
				J'ai déjà un compte
			</span>
			<span class="login100-form-title p-b-41 create" style="visibility: hidden; display: none">
				Créer un compte
			</span>
			<?php
			if($_SESSION["try"] == 1) {
				echo '
				<span class="login100-form-title p-b-41 alert">
				Utilisateur inconnu!
				</span>';
				$_SESSION["try"] += 1;
			}
			if($_SESSION["connected"]) {

			}
			else {
				echo '
				<form method="POST" action="login.php" class="login100-form validate-form p-b-33 p-t-5">

				<div class="wrap-input100 validate-input signup-div" data-validate = "Enter mail">
				<input type="mail" name="email" placeholder="Mail">
				<span class="focus-input100" data-placeholder="&#xe818;"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Enter username">
				<input class="input100" type="text" name="username" placeholder="Username">
				<span class="focus-input100" data-placeholder="&#xe82a;"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Enter password">
				<input class="input100" type="password" name="pass" placeholder="Password">
				<span class="focus-input100" data-placeholder="&#xe80f;"></span>
				</div>

				<div class="container-login100-form-btn m-t-32">
				<button type="button" onclick="signup()" class="login100-form-btn signup">S\'inscrire</button>
				<button class="login100-form-btn">Login</button>
				</div>

				</form>';
			}
			?>
		</div>
	</div>

	<!-- <div id="dropDownSelect1"></div> -->

	<!--===============================================================================================-->
	<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<!--===============================================================================================-->

</body>
</html>
