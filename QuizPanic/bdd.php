<?php
if (isset($_SESSION['username'])) {
   $username = $_SESSION['username'];
}
$db = new mysqli("192.168.1.48", "distant_user", "21706050", "petitm");
// $db = new mysqli("localhost", "petitm", "21706050", "petitm");
// $db = new mysqli("quizpanic.000webhostapp.com", "id5661849_petitm", "21706050", "id5661849_petitm");
$db->set_charset("utf8");

// Check connection
if (mysqli_connect_errno()) {
   echo "Erreur de connexion à la base de données: " . mysqli_connect_error();
}
?>
