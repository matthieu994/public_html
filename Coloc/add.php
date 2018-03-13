<?php
session_start();

$article = $_POST["article"];
$qtte = $_POST["quantite"];
$personne = $_SESSION['nom'];

include('bdd.php');

$stmt = $db->prepare("INSERT INTO listeDeCourse (identifiant, article, quantite, personne) VALUES(NULL, ?, ?, ?)");
$stmt->bind_param("sss", $article, $qtte, $personne);

$stmt->execute();

$stmt->close();
mysqli_close($db);

header('Location: courses.php');
?>
