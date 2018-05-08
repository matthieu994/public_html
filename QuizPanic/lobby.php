<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="utf-8">
   <title> Lobby </title>
   <link rel="shortcut icon" href="img/fav.ico">
   <link rel="stylesheet" type="text/css" href="css/lobby.css">
   <link rel="stylesheet" type="text/css" href="css/common.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>

   <header>
      <i class="fas fa-cogs"></i>
      <i class="fas fa-sign-out-alt"></i>
      <div id="settings">
         <i class="fas fa-chevron-left"></i>
         <div id="avatar">
            <img src="img/avatar1.png"><img src="img/avatar2.png"><img src="img/avatar3.png"><img src="img/avatar4.png">
            <img src="img/avatar5.png"><img src="img/avatar6.png"><img src="img/avatar7.png"><img src="img/avatar8.png">
            <img src="img/avatar9.png"><img src="img/avatar10.png"><img src="img/avatar11.png"><img src="img/avatar12.png">
            <span>Choisis ton avatar!</span>
         </div>
      </div>
   </header>
   <!-- <section id="container-pads"> -->
   <div id="players"></div>

   <div class="sub-container top">
      <span id="question">EXEMPLE QUESTION</span>
      <div id="pad1">
         <span></span>
      </div>
      <div id="pad2">
         <span></span>
      </div>
   </div>
   <div class="sub-container bottom">
      <div id="pad3">
         <span></span>
      </div>
      <div id="pad4">
         <span></span>
      </div>

      <span id="finishtime">Temps écoulé!</span>
      <span id="progressbar"></span>
   </div>
   <!-- </section> -->

</body>
<script src="js/lobby.js"></script>
</html>
