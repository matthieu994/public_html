<?php
session_start();

require ('bdd.php');

if(!isset($_POST['username']) || !isset($_POST['password'])) {
   header('Location: .');
   return;
}

$username = mysqli_real_escape_string($db, stripslashes($_POST['username']));
$password = mysqli_real_escape_string($db, stripslashes($_POST['password']));

$query = "INSERT into users (username, password)
VALUES ('$username', '".md5($password)."')";

$result = mysqli_query($db, $query);
if($result) {
   setcookie('username', $username, time() + (86400 * 30), '/QuizPanic');
   $_SESSION['connected'] = 1;
   header('Location: main.php');
}

else {
   $select = "SELECT * from users WHERE username='$username'";
   $result = mysqli_query($db, $select);
   if(mysqli_num_rows($result) > 0) {
      $_SESSION["username_exist"] = 1;
      $_SESSION["username_taken"] = $username;
   }
   header('Location: .');
}

mysqli_close($db);
?>
