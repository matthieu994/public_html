<?php
session_start();

require('bdd.php');

if(!isset($_POST['username']) || !isset($_POST['password'])) {
   header('Location: .');
   return;
}

$username = $_POST['username'];
$password = md5($_POST['password']);
$req = $db->prepare("SELECT * from users WHERE BINARY username=? AND password=?");
$req->bind_param('ss', $username, $password);
$req->execute();
$req->store_result();

if($req->num_rows == 1) {
   $_SESSION["username"] = $username;
   $_SESSION['connected'] = 1;
   echo 'connected';
}
else {
   echo 'bad login';
}
$req->close();
$db->close();
?>
