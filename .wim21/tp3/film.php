<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<title>Films</title>
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-utils/concise-utils.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-ui/concise-ui.min.css">
		<link rel="stylesheet" href="./css/style.css">
	</head>
	<body container>
		<h2 class="_bb1 _mts">Films</h2>
<?php
/* 2 variables 
 * mes => filtre le metteur en scène
 * page => filtre la page du tableau 
 * */

if (isset($_GET['mes'])){      
	$filtreMes=intval($_GET['mes']);
}else{
	$filtreMes=-1;
}
if (isset($_GET['page'])){
	$page = intval($_GET['page']);
}else{
	$page=1;
}
include './include/connexion.php';
?>

		<!-- formulaire pour filtrer l'affichage suivant un réalisateur -->

		<form  method="GET" action="?page=1">
			Réalisateur : <select name="mes">
				<option value="-1">Tous</option>
			</select> 
			<button type="submit" class="btn">Chercher</button>
		</form>

		<!-- Table des films -->

		<table>
			<thead>
				<tr>
					<th>Titre</th>
					<th>Année</th>
					<th>Genre</th>
					<th>Réalisateur</th>
				</tr>
			</thead>
			<tbody>
<?php
if ($res)
{
	foreach($res as $film)
	{
		echo "<tr>";
		echo "<td><a href='fiche.php?film=".$film['idFilm']."'>"
			.$film['titre']
			."</a></td><td>"
			.$film['annee']
			."</td><td>"
			.$film['genre']
			."</td><td>".$film['prenom']." ".$film['nom']
			."</td>";
		echo "</tr>";
	}
}
?>
			</tbody>
		</table>

		<!-- Barre de pagination -->
<?php
$nbpages = 5; /* A calculer !!!! */
$prev=$page-1;
$next=$page+1;
if ($prev<1) $prev=1;
if ($next>$nbpages) $next=$nbpages;
?>
		<ul class="_mts button-group">
			<li>
				<a class="item" href="?<?php echo $filtreMes;?>&page=<?php echo $prev;?>">
					«
				</a>
			</li>

<?php
for($i=1;$i<=$nbpages;$i++){
	$class="";
	if ($i==$page) $class="-active";
	echo "<li class='item $class'><a href='?mes=$filtreMes&page=$i'>$i</a></li>";
}
?>

			<li>
				<a class="item" href="?mes=<?php echo $filtreMes;?>&page=<?php echo $next;?>">
					»
				</a>
			</li>
		</ul>
	</body>
</html>
