<?php
session_start();
if(isset($_SESSION["connected"]) && $_SESSION["connected"]) {
   header('Location: main.php');
}
if(!isset($_SESSION["username_exist"])) {
   $_SESSION["username_exist"] = 0;
}
if(!isset($_SESSION["bad_login"])) {
   $_SESSION["bad_login"] = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title> Login </title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="css/login.css">
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>

   <div class="signup">
      <span> Pas de compte ? </span>
      <button type="button">S'inscrire</button>
   </div>

   <div class="header">
      <section class="alert">
         <div class="" id="error_auth" style="display: <?php if($_SESSION["bad_login"]) echo "block"; else echo "none"; ?>">
            <span>Erreur d'authentification!</span>
         </div>
         <div class="" id="error_taken" style="display: <?php if($_SESSION["username_exist"]) echo "block"; else echo "none"; ?>">
            <span>Ce pseudo existe déjà!</span>
         </div>
         <div class="" id="alert_pass" style="display: none">
            <span>Le mot de passe doit contenir au moins 4 caractères!</span>
         </div>
         <div class="" id="alert_pass2" style="display: none">
            <span>Les mots de passe ne correspondent pas!</span>
         </div>
      </section>
      <h1>Quiz Panic EVOLVED</h1>
      <!-- <img src="img/avatar.png"></img> -->
   </div>

   <div class="container-login">
      <form method="POST" action="login.php" style="zoom: 120%; -moz-transform: scale(1.2);">
         <div class="username">
            <span class="animated fadeIn">USERNAME</span>
            <i class="fas fa-user" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: 38%"></i>
            <input autocomplete="off" autocomplete="new-password" type="text" name="username" placeholder="<?php if(isset($_SESSION["username"])) echo $_SESSION["username"]; else echo "Username";?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" required>
         </div>
         <div class="password">
            <span class="animated fadeIn">PASSWORD</span>
            <i class="fas fa-lock" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: 38%"></i>
            <input autocomplete="off" autocomplete="new-password" id="pass" type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
            <i class="fas fa-eye fa-eye-slash" style="color: #8aaaaa; font-size: 20px; position: absolute; left: 259px; top: 28.5%"></i>
         </div>
         <button class="login animated zoomIn">Se connecter</button>
      </form>
   </div>



   <div class="container-signup" style="display: none">
      <form method="POST" action="register.php" style="zoom: 120%; -moz-transform: scale(1.2);">
         <div class="username">
            <span class="animated fadeIn">USERNAME</span>
            <i class="fas fa-user" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: 38%"></i>
            <input autocomplete="off" autocomplete="new-password" class="" type="text" name="username" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" required>
         </div>
         <div class="password">
            <span class="animated fadeIn">PASSWORD</span>
            <i class="fas fa-lock" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: 38%"></i>
            <input autocomplete="off" autocomplete="new-password" id="pass1" class="" type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
            <i class="fas fa-eye fa-eye-slash" style="color: #8aaaaa; font-size: 20px; position: absolute; left: 259px; top: 29.5%"></i>
         </div>
         <div class="password confirm">
            <span class="animated fadeIn">PASSWORD CONFIRMATION</span>
            <i class="fas fa-lock" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: 38%"></i>
            <input autocomplete="off" autocomplete="new-password" id="pass2" class="" type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
         </div>
         <button class="login animated zoomIn">S'inscrire</button>
      </form>
   </div>

</body>

<script>
/*------------------------CHANGE FORM-----------------------------*/
var loginbutton = document.querySelector(".signup button");
loginbutton.addEventListener("click", toggle);
function toggle () {
   var signup = document.querySelector(".container-signup");
   var login = document.querySelector(".container-login");

   $("#pass").val("");
   $("#pass1").val("");
   $("#pass2").val("");
   reset();

   if(signup.style.display == "none") {
      signup.style.visibility = "visible";
      signup.style.display = "block";
      login.style.visibility = "hidden";
      login.style.display = "none";
      document.querySelector(".signup span").innerHTML = "Déjà inscrit ?";
      loginbutton.innerHTML = "Se connecter";
      document.querySelector("#error_auth").style.display = "none";
   }
   else {
      login.style.visibility = "visible";
      login.style.display = "block";
      signup.style.visibility = "hidden";
      signup.style.display = "none";
      document.querySelector(".signup span").innerHTML = "Pas de compte ?";
      loginbutton.innerHTML = "S'inscrire";
      document.querySelector("#error_taken").style.display = "none";
   }
}
<?php if($_SESSION["username_exist"] == 1) {$_SESSION["username_exist"] = 0; echo "toggle();";}
$_SESSION["bad_login"] = 0;
?>

/*------------------------PASSWORD MATCH-----------------------------*/
function check_valid () {
   if($("#pass1").val().length == 0) {
      reset();
   }
   if($("#pass1").val().length < 4) {
      $("#alert_pass").fadeIn();
      $(".container-signup button").css("pointer-events", "none");
      $(".container-signup .password .fa-lock").first().css("color", "rgba(82, 0, 0, 0.59)");
      $(".container-signup button").prop("disabled", true);
   }
   if($("#pass1").val().length >= 4) {
      $("#alert_pass").fadeOut();
      $(".container-signup button").css("pointer-events", "auto");
      $(".container-signup .password .fa-lock").first().css("color", "rgb(30, 142, 61)");
      $(".container-signup button").prop("disabled", false);
   }
   if($("#pass2").val().length != 0) check();
}
function check () {
   if ($("#pass1").val() != $("#pass2").val()) {
      // $("#pass2").css("box-shadow", "rgba(82, 0, 0, 0.59) 0px 0px 10px 1px");
      $(".container-signup button").css("pointer-events", "none");
      $(".confirm .fa-lock").css("color", "rgba(82, 0, 0, 0.59)");
      $(".container-signup button").prop("disabled", true);
      $("#alert_pass2").fadeIn();
   } else {
      // $("#pass2").css("box-shadow", "0px 0px 16px 1px rgba(0, 0, 0, 0.14)");
      $(".container-signup button").css("pointer-events", "auto");
      $(".confirm .fa-lock").css("color", "rgb(30, 142, 61)");
      $(".container-signup button").prop("disabled", false);
      $("#alert_pass2").fadeOut();
   }
}
function reset () {
   $(".confirm .fa-lock").css("color", "#8aaaaa");
   $(".container-signup .password .fa-lock").first().css("color", "#8aaaaa");
   $(".container-signup button").css("pointer-events", "auto");
   $(".container-signup button").prop("disabled", false);
   $("#alert_pass").fadeOut();
   $("#alert_pass2").fadeOut();
}
$("#pass1").keyup(check_valid);
$("#pass2").keyup(check);

/*------------------------PASSWORD REVEAL-----------------------------*/
document.querySelector(".container-login .fa-eye-slash").addEventListener("mouseover", function () {this.classList.remove("fa-eye-slash"); document.getElementById("pass").type = "text";});
document.querySelector(".container-signup .fa-eye-slash").addEventListener("mouseover", function () {this.classList.remove("fa-eye-slash"); document.getElementById("pass1").type = "text";});
document.querySelector(".container-login .fa-eye-slash").addEventListener("mouseout", function () {this.classList.add("fa-eye-slash"); document.getElementById("pass").type = "password";});
document.querySelector(".container-signup .fa-eye-slash").addEventListener("mouseout", function () {this.classList.add("fa-eye-slash"); document.getElementById("pass1").type = "password";});
</script>

</html>
