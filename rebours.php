<?php
	$end = mktime(8, 0, 0, 7, 1, 2018);
	$today = time();
	$diff = ($end-$today);

	if ($diff < 0)
		echo "Temps écoulé!\n";
	else {
	$min = $diff / 60;
	$hour = $min / 60;
	$day = $hour / 24;

	$sec = floor($diff % 60); // Secondes restantes
	$min = floor($min % 60); // Minutes restantes
	$hour = floor($hour % 24); // Heures restantes
	$day = floor($day); // Jours restants
	}
?>