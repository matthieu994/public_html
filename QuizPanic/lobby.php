<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="utf-8">
   <title> LOBBY </title>
   <link rel="shortcut icon" href="img/fav.ico">
   <link rel="stylesheet" type="text/css" href="css/lobby.css">
   <link rel="stylesheet" type="text/css" href="css/common.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>

   <header>
      <i class="fas fa-sign-out-alt"></i>
   </header>
   <!-- <section id="container-pads"> -->
   <div id="players">
   </div>

   <div class="sub-container">
      <span id="question">EXEMPLE QUESTION</span>
      <div id="pad1">
      </div>
      <div id="pad2">
      </div>
   </div>
   <div class="sub-container">
      <div id="pad3">
      </div>
      <div id="pad4">
      </div>

      <span id="finishtime">Temps écoulé!</span>
      <span id="progressbar"></span>
   </div>
   <!-- </section> -->

</body>
<script src="js/lobby.js"></script>
</html>
