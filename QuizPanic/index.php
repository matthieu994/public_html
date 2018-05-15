<?php
session_start();
if(isset($_SESSION["connected"]) && $_SESSION["connected"]) {
   header('Location: main.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title> Login </title>
   <link rel="shortcut icon" href="img/fav.ico">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="css/index.css">
   <link rel="stylesheet" type="text/css" href="css/common.css">
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>

   <div class="signup">
      <span>Pas de compte ?</span>
      <button type="button">S'inscrire</button>
   </div>

   <div class="header">
      <section class="alert">
         <div class="" id="error_auth" style="display: none">
            <span>Erreur d'authentification!</span>
         </div>
         <div class="" id="error_taken" style="display:none">
            <span>Ce pseudo existe déjà!</span>
         </div>
         <div class="" id="alert_user" style="display: none">
            <span>Le nom d'utilisateur doit contenir entre 3 et 25 caractères!</span>
         </div>
         <div class="" id="alert_pass" style="display: none">
            <span>Le mot de passe doit contenir au moins 3 caractères!</span>
         </div>
         <div class="" id="alert_pass2" style="display: none">
            <span>Les mots de passe ne correspondent pas!</span>
         </div>
      </section>
      <h1 class="animated zoomInDown">Quiz Panic EVOLVED</h1>
      <!-- <img src="img/avatar.png"></img> -->
   </div>

   <div class="container-login">
      <form style="zoom: 120%; -moz-transform: scale(1.2);">
         <div class="username">
            <span class="animated fadeIn">USERNAME</span>
            <i class="fas fa-user" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: 38%"></i>
            <input autocomplete="new-password" type="text" name="username" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" required>
         </div>
         <div class="password">
            <span class="animated fadeIn">PASSWORD</span>
            <i class="fas fa-lock" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: 38%"></i>
            <input autocomplete="new-password" id="pass" type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
            <i class="fas fa-eye fa-eye-slash" style="color: #8aaaaa; font-size: 20px; position: absolute; left: 259px; top: 28.5%"></i>
         </div>
         <button class="login animated">Se connecter</button>
      </form>
   </div>



   <div class="container-signup" style="display: none">
      <form style="zoom: 120%; -moz-transform: scale(1.2);">
         <div class="username">
            <span class="animated fadeIn">USERNAME</span>
            <i class="fas fa-user" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: 38%"></i>
            <input autocomplete="off" autocomplete="new-password" id="userinput" class="" type="text" name="username" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" required>
         </div>
         <div class="password">
            <span class="animated fadeIn">PASSWORD</span>
            <i class="fas fa-lock" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: 38%"></i>
            <input autocomplete="off" autocomplete="new-password" id="pass1" class="" type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
            <i class="fas fa-eye fa-eye-slash" style="color: #8aaaaa; font-size: 20px; position: absolute; left: 259px; top: 28.5%"></i>
         </div>
         <div class="password confirm" style="display: none">
            <span class="animated fadeIn">PASSWORD CONFIRMATION</span>
            <i class="fas fa-lock" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: 38%"></i>
            <input autocomplete="off" autocomplete="new-password" id="pass2" class="" type="password" name="password" placeholder="Password confirmation" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password confirmation'" required>
         </div>
         <button class="login animated">S'inscrire</button>
      </form>
   </div>

</body>
<script src="js/index.js"></script>
</html>
