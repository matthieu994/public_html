<?php

function initDatabase() {
	$dir = dirname(__FILE__);
	try {
		$db = new PDO (
			'mysql:host=localhost;dbname=securite',
			'',
			'');
		//
		//$db = new PDO('sqlite:' . $dir .'/database.sq3');
		// $db = new PDO('mysql:host=localhost;dbname=Base', 'login', 'mdp');
	} catch (PDOException $e) {
		die('DB error: ' . $e->getMessage());
	}
	return $db;
}

