<?php
	echo '<h1 style="text-align:center;">Temps restant avant la fin de l\'année</h1>';
	$end = mktime(8, 0, 0, 7, 1, 2018);
	$today = time();
	$diff = ($end-$today);

	if ($diff < 0)
		echo "Temps écoulé!";
	else {
	$min = $diff / 60;
	$hour = $min / 60;
	$day = $hour / 24;

	$sec = floor($diff % 60); // Secondes restantes
	$min = floor($min % 60); // Minutes restantes
	$hour = floor($hour % 24); // Heures restantes
	$day = floor($day); // Jours restants
	echo 'Il reste '. $day .' jours '. $hour .' heures,'. $min .' minutes et '. $sec .' secondes.';
	}

	echo '<h1 style="text-align:center;">Temps restant avant la fin du monde</h1>';
	$end = mktime(8, 0, 0, 10, 23, 2077);
	$today = time();
	$diff = ($end-$today);

	$min = $diff / 60;
	$hour = $min / 60;
	$day = $hour / 24;

	$sec = floor($diff % 60); // Secondes restantes
	$min = floor($min % 60); // Minutes restantes
	$hour = floor($hour % 24); // Heures restantes
	$day = floor($day); // Jours restants
	echo 'Il reste '. $day .' jours '. $hour .' heures,'. $min .' minutes et '. $sec .' secondes.'; 
?>