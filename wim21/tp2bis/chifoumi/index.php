<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-utils/concise-utils.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-ui/concise-ui.min.css">
		<link rel="stylesheet" href="./css/style.css">

		<title></title>
	</head>
	<body container>
		<h4 class="_bb1 _ms">Pierre, Feuille, Ciseaux</h4>
		<div class="_text-center">
			<p class="_c-base-primary">Choississez votre coup </p>
			<a href="?coup=0"><img width="50px" src="./images/pierre.png"></a>
			<a href="?coup=1"><img width="50px" src="./images/feuille.png"></a>
			<a href="?coup=2"><img width="50px" src="./images/ciseaux.png"></a>
		</div>
		<?php
			if (isset($_GET['coup'])):
				$coup_joueur = $_GET['coup'];
			/* A completer */
		?>
				<div grid>
					<div column>
						<h5 class="_bb1 _ms">Votre Coup</h5>
						<div class="_text-center">
							<img src="./images/">
						</div>
					</div>
					<div column>
						<h5 class="_bb1 _ms">Celui de l'ordinateur</h5>
						<div class="_text-center">
							<img src="./images/">
						</div>
					</div>
				</div>
				<h2 class="_mts _text-center"><span class=""></span></h2>
		<?php 
		endif;
		?>
			</div>	
		</body>
	</html>
