<?php
require 'check.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="utf-8">
   <title><?php echo $_SESSION["username"] . ' - ' . 'Accueil' ?></title>
   <link rel="shortcut icon" href="img/fav.ico">
   <link rel="stylesheet" type="text/css" href="css/main.css">
   <link rel="stylesheet" type="text/css" href="css/common.css">
   <link rel="stylesheet" type="text/css" href="css/flip.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>

   <header>
      <section class="alert">
         <div id="alert_answer" style="display: none">
            <span>Vous devez sélectionner la bonne réponse!</span>
         </div>
         <div id="alert_answer2" style="display: none">
            <span>Une de vos réponses est vide ou trop courte!</span>
         </div>
         <div id="alert_question" style="display: none">
            <span>Votre question est vide ou trop courte!</span>
         </div>
         <div id="alert_roomname" style="display: none">
            <span>Le nom de votre salle est vide ou trop court!</span>
         </div>
         <div class="good" id="success_addquestion" style="display: none">
            <span>Question ajoutée!</span>
         </div>
         <div class="good" id="success_modifyquestion" style="display: none">
            <span>Question modifiée!</span>
         </div>
         <div class="good" id="success_deletequestion" style="display: none">
            <span>Question supprimée!</span>
         </div>
         <div class="good" id="success_addroom" style="display: none">
            <span>Salle créée!</span>
         </div>
         <div class="good" id="success_modifyroom" style="display: none">
            <span>Salle modifiée!</span>
         </div>
         <div class="good" id="success_deleteroom" style="display: none">
            <span>Salle supprimée!</span>
         </div>
         <div id="error" style="display: none">
            <span>Une erreur s'est produite.</span>
         </div>
         <div id="error_room" style="display: none">
            <span>Cette salle existe déjà!</span>
         </div>
         <div id="error_maxrooms" style="display: none">
            <span>Vous avez atteint le maximum de salles!</span>
         </div>
         <div class="indication" id="alert_details" style="display: none">
            <span>Cliquez pour obtenir plus de détails.</span>
         </div>
         <div class="indication" id="alert_modify" style="display: none">
            <span>Cliquez pour modifier cette question.</span>
         </div>
         <div id="question_details" style="display: none">
            <i class="fas fa-times" id="exitnotif"></i>
            <span></span>

         </div>
      </section>
      <div id="profil">
         <!-- <i class="fas fa-cogs hoverable"></i> -->
         <span id="help">Settings</span>
         <!-- <img src="img/menu.png" alt=""> -->
         <!-- <h1 style="vertical-align: 12px; display: inline-block; cursor: pointer;"> Profil </h1> -->
         <div id="dropdown">
            <p> Mon pseudo:<span><?php echo $_SESSION["username"]; ?></span></p>
            <p> Messages envoyés:</p>
            <p> Couleur:</p>
         </div>
      </div>
      <a class="logout" href="logout.php">Se déconnecter</a>
   </header>

   <section role="page">
      <div class="container">
         <div id="play" class="animated zoomIn hoverable">
            <img src="img/sign-in.png" alt="">
         </div>
         <span id="help">Créer ou rejoindre une partie</span>
         <div id="question" class="animated zoomIn hoverable">
            <img src="img/question.png" alt="">
         </div>
         <span id="help">Gérer vos questions</span>

         <section id="container-fenetre" style="display: none">
            <div class="fenetre animated slideInUp" id="container-play" style="display: none">
               <i class="fas fa-chevron-left hoverable"></i>
               <span id="help">Retour</span>
               <i class="fas fa-chevron-right hoverable"></i>
               <span id="help">Gérer vos questions</span>
               <div id="join">
                  <div class="container-title">
                     <span class="title">Lancer une partie
                        <i class="fas fa-sync-alt"></i>
                     </span>
                  </div>
                  <section>

                  </section>
               </div>
               <div id="rooms">
                  <div class="container-title">
                     <span class="title">Créer une salle</span>
                  </div>
                  <section>
                     <form id="addroom">
                        <input autocomplete="off" type="text" name="room" placeholder="Nom de la salle">
                        <input id="range" type="range" name="maxplayers" min="1" max="12" value="2">
                        <output id="range">0 - 2</output>
                        <div>
                           <button>Ajouter</button>
                           <button type="cancel" style="display: none; background-color: rgb(66, 147, 172);">Annuler</button>
                           <button type="delete" style="display: none; background-color: rgb(189, 85, 85);">Supprimer</button>
                        </div>
                     </form>
                  </section>
               </div>
            </div>

            <div class="fenetre animated slideInUp" id="container-question" style="display: none">
               <i class="fas fa-chevron-left hoverable"></i>
               <span id="help">Retour</span>
               <i class="fas fa-chevron-right hoverable"></i>
               <span id="help">Créer ou rejoindre une partie</span>
               <div id="add">
                  <div class="container-title">
                     <span class="title">Ajouter une question</span>
                     <span class="title" id="delete" style="display: none">Supprimer</span>
                  </div>
                  <section>
                     <form id="addquestion" class="">
                        <textarea name="question" rows="3" cols="20" placeholder="Question"></textarea>
                        <input type="text" name="answer1" placeholder="Réponse 1">
                        <input type="text" name="answer2" placeholder="Réponse 2">
                        <input type="text" name="answer3" placeholder="Réponse 3">
                        <input type="text" name="answer4" placeholder="Réponse 4" style="margin-bottom: 10px">
                        <select name="sets">
                           <option value="NULL" selected>Set: Indéfini</option>
                        </select>
                        <input id="addset" type="text" name="set_name" placeholder="Ajouter un set" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ajouter un set'" style="display: none">
                        <div>
                           <i class="fas fa-plus"></i>
                           <i class="fas fa-check" style="display: none; color: rgb(24, 127, 33);"></i>
                           <i class="fas fa-ban" style="display: none; color: rgb(127, 24, 33);"></i>
                        </div>
                        <select name="good_answer">
                           <option value="0" selected>Bonne réponse</option>
                           <option value="1">Réponse 1</option>
                           <option value="2">Réponse 2</option>
                           <option value="3">Réponse 3</option>
                           <option value="4">Réponse 4</option>
                        </select>
                        <button>Ajouter</button>
                     </form>
                     <button id="cancelmodify" style="display: none">Annuler</button>
                  </section>
               </div>
               <div id="set">
                  <div class="container-title">
                     <span class="title">Gérer mes questions
                        <i class="fas fa-sync-alt"></i>
                     </span>
                  </div>
                  <div id="questions_list">
                  </div>
               </div>
            </div>
         </section>
      </div>

      <div class="notification" style="display: none">
         <div id="">
            <span>Vous êtes toujours là ?</span>
            <span>Vous serez déconnecté dans <label id="timeleft"></label> secondes</span>
            <i class="fas fa-times" id="exitnotif"></i>
         </div>
      </div>
   </section>

   <footer>
      <i class="fas fa-volume-up"></i>
      <i class="fas fa-volume-off" style="display: none; padding-right: 15px"></i>
      <i class="fas fa-volume-down" style="display: none"></i>
   </footer>

</body>
<script type="text/javascript" src="js/main.js"></script>
<?php
if(isset($_SESSION['lobby'])) {
   echo '<script type="text/javascript">
   $( document ).ready(function() {
      $("section[role=\'page\']").children().first().hide();
      $("section[role=\'page\']").prepend("<iframe>");
      $("section[role=\'page\']").children("iframe").hide().fadeIn().attr("role", "lobby").attr("src", "lobby.php");
   });
   </script>';
}
if(isset($_SESSION['return'])) {
   $return = $_SESSION['return'];
   if ($return == 1) {
      echo '<script type="text/javascript">$( document ).ready(function() {
         $("#play").hide().removeClass("fadeOutLeft").addClass("fadeInLeft");
         $("#question").hide().removeClass("fadeOutRight").addClass("fadeInRight");
         $("#container-fenetre").show();
         $("#container-play").show();
      });</script>';
   }
   if ($return == 2) {
      echo '<script>$( document ).ready(function() {
         $("#play").hide().removeClass("fadeOutLeft").addClass("fadeInLeft");
         $("#question").hide().removeClass("fadeOutRight").addClass("fadeInRight");
         $("#container-fenetre").show();
         $("#container-question").show();
      });</script>';
   }
}
// $_SESSION['lobby'] = 1;
?>
<script type="text/javascript" src="js/timer.js"></script>
</html>
