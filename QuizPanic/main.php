<?php
session_start(); if(!isset($_SESSION["connected"]) || !$_SESSION["connected"]) header('Location: logout.php');
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title><?php echo $_COOKIE["username"] . ' - ' . 'Accueil' ?></title>
   <link rel="stylesheet" type="text/css" href="css/main.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>

   <header>
      <div id="profil">
         <img src="img/menu.png" alt="">
         <!-- <h1 style="vertical-align: 12px; display: inline-block; cursor: pointer;"> Profil </h1> -->
         <div id="dropdown">
		   <p> Mon pseudo:<span><?php echo $_SESSION["username"]; ?></span></p>
            <p> Messages envoyés:</p>
            <p> Couleur:</p>
         </div>
      </div>
      <a class="logout" href="logout.php">Se déconnecter</a>
   </header>

   <div class="container">
      <div id="play">
         <span>Créer ou héberger une partie</span>
         <img src="img/sign-in.png" alt="">
      </div>
      <div id="question">
         <span>Créer une question</span>
         <img src="img/question.png" alt="">
      </div>
   </div>


</body>
<script>
/*------------------------PROFILE DROPDOWN--------------------------*/
// $(document).ready(function(){
//    var userMenu = $('header .profile');
//    userMenu.on('touchend', function(e){
//       userMenu.addClass('show');
//       e.preventDefault();
//       e.stopPropagation();
//    });
//    $(document).on('touchend', function(e){
//       userMenu.removeClass('show');
//    });
// });
</script>
</html>
