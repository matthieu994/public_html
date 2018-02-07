<?php
$OS = "Linux";
// À compléter
// pour gérer le formulaire 
// et le cookie
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-utils/concise-utils.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-ui/concise-ui.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body container>
		<div grid="center" class="_mts">
			<div column="8">
				<section class=" alert-box">
					<p class="_text-center _ts8 _c-base-primary">
						<?php echo $OS;?>
					</p>
				</section>
				<p class="_text-center">Rafraîchir la page <a href=""><i class="fa fa-refresh" aria-hidden="true"></i></a></p>
			</div>
			<div column="4">
				<form method="POST">
					<fieldset>
						<legend>Changez votre OS</legend>
						<label>
							<input type="radio" name="OS" value="Linux"> 
							<i class="fa fa-linux fa-2x" aria-hidden="true"></i>
						</label>
						<label>
							<input type="radio" name="OS" value="Windows"> 
							<i class="fa fa-windows fa-2x" aria-hidden="true"></i>
						</label>
						<label>
							<input type="radio" name="OS" value="Macos"> 
							<i class="fa fa-apple fa-2x" aria-hidden="true"></i>
						</label>
						<button>Envoyer</button>
					</fieldset>
				</form>
			</div>
		</div>

	</body>
</html>
