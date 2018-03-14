<?php
session_start();

$id = $_GET['id'];
$prix = $_GET['prix'];
$personne = $_SESSION['nom'];

include('bdd.php');

$stmt = $db->prepare("UPDATE listeDeCourse SET payeur=? WHERE identifiant=?");
$stmt->bind_param("ss", $personne, $id);
$stmt->execute();
$stmt->close();

// echo "Montant: " . $prix . " Personne: " . $personne;
$stmt = $db->prepare("UPDATE paiement SET montant=montant+? WHERE personne=?");
$stmt->bind_param("ss", $prix, $personne);
$stmt->execute();
$stmt->close();

mysqli_close($db);

header('Location: courses.php');
?>
