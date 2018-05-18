<?php
include './include/data.inc.php';
function imc($p,$t){
	return round(($p*100*100)/($t*$t),2);
}

$nbitem=15;
$total=count($data);
$nbpages=ceil($total/$nbitem);

if (!isset($_GET['numpage'])) $numpage=1;
else
	$numpage = $_GET['numpage'];

/* completer le calcul 
 * de $llim et $rlim, tranche du tableau à 
 * afficher. Faites attention à
 * ce que numpage soit dans le bon intervalle.
 * */

$llim=10;
$rlim=20;

?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-utils/concise-utils.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-ui/concise-ui.min.css">
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body container>
		<h2 class="_bb1 _mxs _c-base-primary">Exercice 3 : IMC </h2>
			<table class="table">
				<thead> 
					<tr>
						<th>
						Nom
						<a  href="#" ><i class="fa fa-caret-down"></i></a> 
						<a  href="#" ><i class="fa fa-caret-up"></i></a> 
						</th>
						<th>Prénom</th>
						<th>Email</th>
						<th>Taille</th>
						<th>Poids</th>
						<th>IMC</th>
					</tr>
				</thead>
				<tbody>
<?php
for ($i=$llim;$i<$rlim;$i++){
	$ligne=$data[$i];
	$taille=$ligne['Taille'];
	$poids=$ligne['Poids'];
	$class="";
	$imc  = imc($poids,$taille);
	if ($imc >=25) $class="_bg-state-warning";
	echo "<tr class=\"$class\">";
	echo "<td>".$ligne['Nom']."</td>";
	echo "<td>".$ligne['Prenom']."</td>";
	echo "<td>".$ligne['Email']."</td>";
	echo "<td>".$ligne['Taille']."</td>";
	echo "<td>".$ligne['Poids']."</td>";
	echo "<td>$imc</td>";
	echo "</tr>";
}
?>
				</tbody>
			</table>

<!-- affichage de la barre de pagination -->

		<ul class="_mts button-group">
<?php
/* completez le calcul de next et prev
 * utlises dans les liens.
 * */
$prev=1;
$next=2;
?>

			<li><a class="item" href="?numpage=<?php echo $prev;?>">«</a></li>

			<?php
				/* compléter l'affichage des liens
				 * pour chacune des pages. Utiliser la classe
				 * -active pour la page en cours. 
				 * */
			?>
			<li><a class="item" href="?numpage=<?php echo $next;?>">»</a></li>
		</ul>
	</body>
</html>
