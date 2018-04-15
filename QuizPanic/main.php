<?php
session_start(); if(!isset($_SESSION["connected"]) || !$_SESSION["connected"]) header('Location: logout.php');
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title><?php echo $_SESSION["username"] . ' - ' . 'Accueil' ?></title>
   <link rel="shortcut icon" href="img/fav.ico">
   <link rel="stylesheet" type="text/css" href="css/main.css">
   <link rel="stylesheet" type="text/css" href="css/common.css">
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
         <div class="good" id="success_addquestion" style="display: none">
            <span>Question ajoutée!</span>
         </div>
         <div class="good" id="success_modifyquestion" style="display: none">
            <span>Question modifiée!</span>
         </div>
         <div id="fail_addquestion" style="display: none">
            <span>Une erreur s'est produite.</span>
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
            <!-- <select>
               <option value="1"></option>
               <option value="2"></option>
               <option value="3"></option>
               <option value="4"></option>
            </select> -->
         </div>
      </section>
      <div id="profil">
         <i class="fas fa-cogs hoverable"></i>
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
                  <span class="title">Rejoindre une partie</span>
               </div>
               <div id="rooms">
                  <span class="title">Gérer mes salles</span>
               </div>
            </div>
            <div class="fenetre animated slideInUp" id="container-question" style="display: none">
               <i class="fas fa-chevron-left hoverable"></i>
               <span id="help">Retour</span>
               <i class="fas fa-chevron-right hoverable"></i>
               <span id="help">Créer ou rejoindre une partie</span>
               <div id="add">
                  <span class="title">Ajouter une question</span>
                  <div>
                     <form id="addquestion" class="">
                        <textarea name="question" rows="3" cols="20" placeholder="Question" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Question'"></textarea>
                        <input type="text" name="answer1" value="" placeholder="Réponse 1" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Réponse 1'">
                        <input type="text" name="answer2" value="" placeholder="Réponse 2" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Réponse 2'">
                        <input type="text" name="answer3" value="" placeholder="Réponse 3" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Réponse 3'">
                        <input type="text" name="answer4" value="" placeholder="Réponse 4" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Réponse 4'">
                        <select name="good_answer">
                           <option value="0" selected>Bonne réponse</option>
                           <option value="1">Réponse 1</option>
                           <option value="2">Réponse 2</option>
                           <option value="3">Réponse 3</option>
                           <option value="4">Réponse 4</option>
                        </select>
                        <button>Ajouter</button>
                     </form>
                     <button id="cancelmodify" style="display: none;">Annuler</button>
                  </div>
               </div>
               <div id="set">
                  <span class="title">Gérer mes questions</span>
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


</body>
<script type="text/javascript" src="js/main.js"></script>
<?php
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
$_SESSION['return'] = 2;
?>
<script type="text/javascript" src="js/timer.js"></script>
</html>
