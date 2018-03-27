<?php
session_start();

require('bdd.php');

if(!isset($_POST['username']) || !isset($_POST['password'])) {
   header('Location: .');
   return;
}

$username = $_POST['username'];
$password = $_POST['password'];
$req = $db->prepare("SELECT * from users WHERE username=? AND password=?");
$req->bind_param('ss', $username, md5($password));
$req->execute();
$req->store_result();

if($req->num_rows == 1) {
   $_SESSION["username"] = $username;
   $_SESSION['connected'] = 1;
   header('Location: main.php');
}
else {
   $_SESSION["bad_login"] = 1;
   header('Location: .');
}
$req->close();
$db->close();
?>
