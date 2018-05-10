<?php
if (isset($_SESSION['username'])) {
   $username = $_SESSION['username'];
}
$db = new mysqli("localhost", "petitm", "21706050", "petitm");
$db->set_charset("utf8");

// Check connection
if (mysqli_connect_errno()) {
   echo "Erreur de connexion à la base de données: " . mysqli_connect_error();
}
?>
