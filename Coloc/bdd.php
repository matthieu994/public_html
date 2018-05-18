<?php
$db = mysqli_connect('localhost', 'petitm', '21706050', 'coloc');
if (mysqli_connect_errno()) {
  echo "Erreur de connexion à la base de données: " . mysqli_connect_error();
}
?>
