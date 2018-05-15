<?php require 'check.php' ?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title> Lobby </title>
   <link rel="shortcut icon" href="img/fav.ico">
   <link rel="stylesheet" type="text/css" href="css/lobby.css">
   <link rel="stylesheet" type="text/css" href="css/common.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>

   <header>
      <span>En attente de joueurs...</span>
      <i class="fas fa-cog"></i>
      <i class="fas fa-sign-out-alt"></i>
      <div id="settings">
         <i class="fas fa-chevron-left"></i>
         <div id="avatar">
            <?php
            $files = array_diff(scandir('img/'), array('.', '..'));
            array_multisort(array_map('strlen', $files), $files);
            foreach ($files as $file) {
               if(substr($file, 0, 6) == "avatar")
               echo '<img src="img/'. $file .'">';
            }
            ?>
            <span>Choisis ton avatar!</span>
         </div>
         <div id="chat">
            <div id="messages"></div>
            <form>
               <input type="text" name="message">
               <button>Envoyer</button>
            </form>
         </div>
      </div>
   </header>
   <!-- <section id="container-pads"> -->
   <div id="players"></div>
   <table id="leaderboard">
      <tr>
         <th>Joueur</th>
         <th>Score</th>
      </tr>
   </table>

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
