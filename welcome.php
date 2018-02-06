<html>
	<body>
	<h1 style="text-align: center">
	<?php if($_POST["sexe"] == "homme")
	      echo "Bonjour Monsieur";      
	?>
	<?php if($_POST["sexe"] == "femme")
	      echo "Bonjour Madame";      
	?>
	<?php echo $_POST["prenom"]; ?>
	<?php echo $_POST["nom"]; ?>
	</h1>
	</body>
</html>