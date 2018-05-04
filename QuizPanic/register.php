<?php
session_start();

require('bdd.php');

/*------------------------------- VERIFICATION PSEUDO -----------------------------------*/
if(isset($_POST['verifUsername'])) {
   $username = $_POST['username'];
   $req = $db->prepare("SELECT username FROM users WHERE username=?");
   $req->bind_param('s', $username);
   $req->execute();
   $req->store_result();
   if($req->num_rows) echo "taken";
   $req->close();
   $db->close();
   return;
}


/*------------------------------- ENREGISTREMENT USER -----------------------------------*/
if(!isset($_POST['username']) || !isset($_POST['password'])) {
   header('Location: .');
   return;
}

$username = $_POST['username'];
$password = md5($_POST['password']);
$req = $db->prepare("INSERT into users (username, password) VALUES (?, ?)");
$req->bind_param('ss', $username, $password);
$req->execute();
$req = $db->prepare("INSERT into lobbys (username) VALUES (?)");
$req->bind_param('s', $username);
$req->execute();

if($req) {
   $_SESSION["username"] = $username;
   $_SESSION['connected'] = 1;
   header('Location: main.php');
}
else {
   header('Location: .');
}

$req->close();
$db->close();
?>
