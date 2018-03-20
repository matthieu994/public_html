<?php
$db = mysqli_connect('localhost', 'root', 'root', 'TP5');
if (mysqli_connect_errno()) {
  echo "Erreur de connexion à la base de données: " . mysqli_connect_error();
}
?>
