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
      <h1>Quiz Panic EVOLVED</h1>
      <!-- <img src="img/avatar.png"></img> -->
   </div>

   <div class="container-login">
      <form method="POST" action="login.php">
         <?php if($_SESSION["bad_login"]) echo '<span class="alert">Erreur d\'authentification!</span>'; ?>
         <span class="alert" style="display: none"></span>
         <div class="username">
            <span class="animated fadeIn">USERNAME</span>
            <i class="fas fa-user" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: <?php if($_SESSION["bad_login"]) echo "80.75px"; else echo "52.75px"; ?>"></i>
            <input class="" type="text" name="username" placeholder="<?php if(isset($_COOKIE["username"]) && $_COOKIE["username"] != "") echo $_COOKIE["username"]; else echo "Username" ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" required>
         </div>
         <div class="password">
            <span class="animated fadeIn">PASSWORD</span>
            <i class="fas fa-lock" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: <?php if($_SESSION["bad_login"]) echo "180.75px"; else echo "150.75px"; ?>"></i>
            <input id="pass" class="" type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
            <i class="fas fa-eye fa-eye-slash" style="color: #8aaaaa; font-size: 20px; position: absolute; left: 302px; top: <?php if($_SESSION["bad_login"]) echo "175.75px"; else echo "145.75px"; ?>"></i>
         </div>
         <button class="login animated zoomIn">Se connecter</button><br><br>
      </form>
   </div>


   <div class="container-signup" style="display: none">
      <form method="POST" action="register.php">
         <?php if($_SESSION["username_exist"]) echo '<span class="alert">"'.$_SESSION["username_taken"].'" - Ce pseudo existe déjà!</span>'; ?>
         <span class="alert" style="display: none"></span>
         <div class="username">
            <span class="animated fadeIn">USERNAME</span>
            <i class="fas fa-user" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: <?php if($_SESSION["username_exist"]) echo "80.75px"; else echo "52.75px"; ?>"></i>
            <input class="" type="text" name="username" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" required>
         </div>
         <div class="password">
            <span class="animated fadeIn">PASSWORD</span>
            <i class="fas fa-lock" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: <?php if($_SESSION["username_exist"]) echo "179.75px"; else echo "150.75px"; ?>"></i>
            <input id="pass1" class="" type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
            <i class="fas fa-eye fa-eye-slash" style="color: #8aaaaa; font-size: 20px; position: absolute; left: 302px; top: <?php if($_SESSION["username_exist"]) echo "174.75px"; else echo "145.75px"; ?>"></i>
         </div>
         <div class="password confirm">
            <span class="animated fadeIn">PASSWORD CONFIRMATION</span>
            <i class="fas fa-lock" style="color: #8aaaaa; font-size: 12px; position: absolute; left: 0; top: <?php if($_SESSION["username_exist"]) echo "280.5px"; else echo "250.75px"; ?>"></i>
            <input id="pass2" class="" type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
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

   if(signup.style.display == "none") {
      signup.style.visibility = "visible";
      signup.style.display = "block";
      login.style.visibility = "hidden";
      login.style.display = "none";
      document.querySelector(".signup span").innerHTML = "Déjà inscrit ?";
      loginbutton.innerHTML = "Se connecter";

      document.querySelector(".container-login .alert").style.display = "none";
      document.querySelectorAll(".container-login .fas")[0].style.top = "52.75px";
      document.querySelectorAll(".container-login .fas")[1].style.top = "150.75px";
      document.querySelectorAll(".container-login .fas")[2].style.top = "145.75px";
   }
   else {
      login.style.visibility = "visible";
      login.style.display = "block";
      signup.style.visibility = "hidden";
      signup.style.display = "none";
      document.querySelector(".signup span").innerHTML = "Pas de compte ?";
      loginbutton.innerHTML = "S'inscrire";

      document.querySelector(".container-signup .alert").style.display = "none";
      document.querySelectorAll(".container-signup .fas")[0].style.top = "52.75px";
      document.querySelectorAll(".container-signup .fas")[1].style.top = "150.75px";
      document.querySelectorAll(".container-signup .fas")[2].style.top = "145.75px";
      document.querySelectorAll(".container-signup .fas")[3].style.top = "250.75px";
   }
}
<?php if($_SESSION["username_exist"] == 1) {$_SESSION["username_exist"] = 0; echo "toggle();";}
$_SESSION["bad_login"] = 0;
?>

/*------------------------PASSWORD MATCH-----------------------------*/
$("#pass2").keyup(function() {
   if ($("#pass1").val() != $("#pass2").val()) {
      $(".container-signup .confirm").css("border-top", "2.5px solid rgba(255, 20, 20, 0.7)");
      $(".container-signup .confirm span").css("color", "rgba(255, 20, 20, 0.7)");
      $(".container-signup button").prop("disabled", true);
   } else {
      $(".container-signup .confirm").css("border-top", "2.5px solid rgba(91, 108, 122, 0.7)");
      $(".container-signup .confirm span").css("color", "#5c7a7c");
      $(".container-signup button").prop("disabled", false);
   }
});

/*------------------------PASSWORD REVEAL-----------------------------*/
document.querySelector(".container-login .fa-eye-slash").addEventListener("mouseover", function () {this.classList.remove("fa-eye-slash"); document.getElementById("pass").type = "text";});
document.querySelector(".container-signup .fa-eye-slash").addEventListener("mouseover", function () {this.classList.remove("fa-eye-slash"); document.getElementById("pass1").type = "text";});
document.querySelector(".container-login .fa-eye-slash").addEventListener("mouseout", function () {this.classList.add("fa-eye-slash"); document.getElementById("pass").type = "password";});
document.querySelector(".container-signup .fa-eye-slash").addEventListener("mouseout", function () {this.classList.add("fa-eye-slash"); document.getElementById("pass1").type = "password";});
</script>

</html>
