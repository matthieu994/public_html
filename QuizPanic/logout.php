<?php
session_start();
require 'bdd.php';
$req = $db->prepare("UPDATE lobbys SET room=NULL WHERE username=?");
$req->bind_param('s', $_SESSION['username']);
$req->execute();
$req->close();
$db->close();
session_destroy();
$_SESSION = array();
header('Location: .');
?>
