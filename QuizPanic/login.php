<?php
session_start();

require ('bdd.php');

if(!isset($_POST['username']) || !isset($_POST['password'])) {
   header('Location: .');
   return;
}

//$mail = mysqli_real_escape_string($db, stripslashes($_POST['mail']));
$username = mysqli_real_escape_string($db, stripslashes($_POST['username']));
$password = mysqli_real_escape_string($db, stripslashes($_POST['password']));

$query = "SELECT * from users WHERE username='$username' AND password='". md5($password) ."'";

$result = mysqli_query($db, $query) or die(mysql_error());
echo "error";
if(mysqli_num_rows($result) == 1) {
   $_SESSION["username"] = $username;
   $_SESSION['connected'] = 1;
   header('Location: main.php');
}
else {
   $_SESSION["bad_login"] = 1;
   header('Location: .');
}
mysqli_close($db);
?>