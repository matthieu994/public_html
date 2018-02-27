<?php
if(!isset($_POST["message"]) || empty($_POST["message"]) || trim($_POST["message"]) == "") {
   setcookie('return', 1, time() + (86400 * 30), '/');
   header('Location: salon.php ');
   return;
}

$pseudo = $_COOKIE["pseudo"];
$salon = strtoupper($_COOKIE["salon"]);

$fichier = fopen("salons/" . $salon . ".txt", 'a+');

$data = date('d/m/Y H:i ') . $pseudo . "\n";
$message = trim(htmlspecialchars($_POST["message"])) . "\n\n";
$length = strlen($message);
$length = $length . "\n";

fputs($fichier, $length);
fputs($fichier, $data);
fputs($fichier, $message);

fclose($fichier);

setcookie('return', 1, time() + (86400 * 30), '/');
setcookie('count', $_COOKIE['count']+1, time() + (86400 * 30), '/');
header('Location: salon.php ');
?>
