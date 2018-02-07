<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-utils/concise-utils.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-ui/concise-ui.min.css">
		<link href="../css/style.css" rel="stylesheet" />
	</head>

	<body container>

		<h4 class="_bb1 _mbs _mtxs _pbxs _ptxs">Effectifs de l'enseignement supérieur dans l'académie de Créteil</h4>
		<div grid>
			<div column='4'>
				<form method="POST">
					<fieldset>
						<legend>
							Filtres
						</legend>
						<!-- SELECT -->
						<label>Année </label>
						<select name="annee">
													</select>
						<label>Formations </label>
						<select name="formation">
							<option value="toutes">Toutes</option>
													</select>
						<label>Sexe</label>
						<div>
						Masculin <input  value="Masculin" type="checkbox" name="sexe[]"> Féminin <input  value="Feminin" type="checkbox" name="sexe[]">
						</div>
						<button name="OK">Envoyez</button>
					</fieldset>
				</form>
			</div>

			<div column='8'>
				<table>
					<thead>
						<tr>
							<th>Regroupement Formations</th>
							<th>Effectif</th>
							<th>Sexe</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
