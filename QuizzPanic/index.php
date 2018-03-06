<?php
session_start();
if(!isset($_COOKIE['count'])) {
   setcookie('count', 0, time() + (86400 * 30), '/');
}

if(!isset($_SESSION["connected"])) {
   $_SESSION["connected"] = 0;
}
if($_SESSION["connected"] == 1) {
   header('Location: ./salon.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title> Login </title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

   <div class="container-login">

      <span> Je m'inscris </span>
      <form method="POST" action="salon.php">
         <input class="animated bounceIn username" type="text" name="username" placeholder="Username" required>
         <input class="animated bounceIn password" type="text" name="password" placeholder="Password" required>
         <button class="login animated zoomIn">Rejoindre</button>
      </form>

   </div>

   <div class="container-signup" style="display: none">

      <span> J'ai déjà un compte </span>
         <form method="POST" action="salon.php">
            <input class="animated bounceIn mail" type="email" name="mail" placeholder="Mail" required>
            <input class="animated bounceIn username" type="text" name="username" placeholder="Username" required>
            <input class="animated bounceIn password" type="text" name="password" placeholder="Password" required>
            <button class="login animated zoomIn">Rejoindre</button>
         </form>

   </div>

</body>

<script>

var loginspan = document.querySelector(".container-login span");
loginspan.addEventListener("click", toggle);
var signupspan = document.querySelector(".container-signup span");
signupspan.addEventListener("click", toggle);

function toggle () {
  var signup = document.querySelector(".container-signup");
   var login = document.querySelector(".container-login");

   if(signup.style.display == "none") {
   signup.style.visibility = "visible";
   signup.style.display = "block";
   login.style.visibility = "hidden";
   login.style.display = "none";
   }
   else {
   login.style.visibility = "visible";
   login.style.display = "block";
   signup.style.visibility = "hidden";
   signup.style.display = "none";
   }
}

</script>

</html>
