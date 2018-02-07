<html>
	<body>
	<h1 style="text-align: center">
	<?php if($_POST["sexe"] == "homme")
	      echo "Bonjour Monsieur";
	?>
	<?php if($_POST["sexe"] == "femme")
	      echo "Bonjour Madame";
	?>
	<?php
		$lowprenom = strtolower($_POST["prenom"]);
		$lownom = strtolower($_POST["nom"]);
		echo ucfirst($lowprenom);
			?>
	<?php echo ucfirst($lowprenom); ?>
	</h1>
	</body>
</html>
