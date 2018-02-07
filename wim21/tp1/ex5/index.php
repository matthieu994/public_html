<?php
include './include/fonction.php';
$alphabet = "azertyuiopqsdfghjkklmwxcvbnAZERTYUIOPLMKJHGFDSQWXCVBN1234567890";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-utils/concise-utils.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-ui/concise-ui.min.css">
	</head>
	<body container>
		<h2 class="_bb1  _c-base-primary">Exercice 5 : createPassword </h2>
		<h3>
		Test de la fonction createPassword
		</h3>
		<ul>
			<li><?php echo createPassword(5,$alphabet);?></li>
			<li><?php echo createPassword(10,$alphabet);?></li>
			<li><?php echo createPassword(15,$alphabet);?></li>
		</ul>
	</body>
</html>
