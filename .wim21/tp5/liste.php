<?php
include './include/contact.php';
$liste = contact::getListe();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-utils/concise-utils.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-ui/concise-ui.min.css">
		<link href="./css/style.css" rel="stylesheet" />
		<title>Contacts</title>
	</head>
	<body container>
		<h3 class="_bb1">Gestion de contacts</h3>
		<table class="contacts">
			<thead>
				<tr>
					<th>Prénom</th><th>Nom</th><th>Email</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($liste as $contact) : ?>
				<tr>
					<td>
						<?php echo $contact->prenom;?>
					</td>
					<td>
						<?php echo $contact->nom;?>
					</td>
					<td>
						<?php echo $contact->email;?>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</body>
</html>
