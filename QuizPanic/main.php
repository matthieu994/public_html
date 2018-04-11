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
            <div class="">
              <textarea rows="3" cols="20" placeholder="Question" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Question'"></textarea>
              <input type="text" name="" value="" placeholder="Réponse 1" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Réponse 1'">
              <input type="text" name="" value="" placeholder="Réponse 2" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Réponse 2'">
              <input type="text" name="" value="" placeholder="Réponse 3" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Réponse 3'">
              <input type="text" name="" value="" placeholder="Réponse 4" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Réponse 4'">
              <button>Ajouter</button>
              <select>
                <option value="" required selected>Bonne réponse</option>
                <option value="">Réponse 1</option>
                <option value="">Réponse 2</option>
                <option value="">Réponse 3</option>
                <option value="">Réponse 4</option>
              </select>
            </div>
          </div>
          <div id="set">
            <span class="title">Gérer mes questions</span>
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
<script src="js/main.js"></script>
<script src="js/timer.js"></script>
</html>
