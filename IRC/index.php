<?php
session_start();
if(!isset($_SESSION['connected'])) {
	$_SESSION['connected'] = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if($_SESSION["connected"]) echo $_SESSION["username"]; else echo 'Login' ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

	<?php
	if($_SESSION["connected"]) {
		echo '<h1 align="center" class="username"> Bonjour, '.$_SESSION["username"].'</h1>';
		echo '<a class="btn-8" href="logout.php">Se déconnecter</a>';
	}
	?>

		<div class="container">

			<?php
			if($_SESSION["connected"]) {

			}
			else {
				echo '
				<form method="POST" action="login.php" class="container-login">

				<div class="pseudo">
				<input class="input100" type="text" name="username" placeholder="Pseudo">
				</div>

				<div class="salon">
				<input class="input100" type="password" name="pass" placeholder="Salon">
				</div>

				<div class="container-button">
				<button class="login100-form-btn">Rejoindre</button>
				</div>

				</form>';
			}
			?>
		</div>
		
</body>
</html>
