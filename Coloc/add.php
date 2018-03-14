<?php
session_start();

$prix = $_POST["prix"];
$article = $_POST["article"];
$qtte = $_POST["quantite"];
$personne = $_SESSION['nom'];

include('bdd.php');

$stmt = $db->prepare("INSERT INTO listeDeCourse (identifiant, article, quantite, personne, prix) VALUES(NULL, ?, ?, ?, ?)");
$stmt->bind_param("ssss", $article, $qtte, $personne, $prix);
$stmt->execute();
$stmt->close();

header('Location: courses.php');
?>
