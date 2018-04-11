<?php

function initDatabase() {
	$dir = dirname(__FILE__);
	try {
		$db = new PDO (
			'mysql:host=localhost;dbname=securite',
			'petitm',
			'217060');
		//
		//$db = new PDO('sqlite:' . $dir .'/database.sq3');
		// $db = new PDO('mysql:host=localhost;dbname=Base', 'login', 'mdp');
	} catch (PDOException $e) {
		die('DB error: ' . $e->getMessage());
	}
	return $db;
}
