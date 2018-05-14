<?php
session_start();
if(!isset($_COOKIE['feed'])) setcookie('feed', 0, time() + (86400 * 30), "/");
if(!isset($_COOKIE['water'])) setcookie('water', 0, time() + (86400 * 30), "/");
if(!isset($_COOKIE['pet'])) setcookie('pet', 0, time() + (86400 * 30), "/");
?>
<!doctype html>
<html>
<head>
   <title> Tamagotchi </title>
   <link rel="shortcut icon" href="fav.ico">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <link rel="stylesheet" href="https://cdn.concisecss.com/concise.css">
   <link rel="stylesheet" href="index.css">
</head>
<body>

   <section>
      <h1><?php
      require 'liste_nom.php';
      if(!isset($_SESSION['pseudo'])) {
         $_SESSION['pseudo'] = $nom[array_rand($nom, 1)];
      }
      echo 'Bienvenue '. $_SESSION['pseudo'] .' dans votre élevage de Tamagotchi !';
      ?></h1>
      Cliquez sur un Tamagotchi pour vous en occuper.
      <table>
      </table>
      <p>
         <?php
         if(isset($_COOKIE['feed'])) echo 'Vous avez nourri '. $_COOKIE['feed'] .' fois, abreuvé '. $_COOKIE['water'] .' fois et caressé '. $_COOKIE['pet'] .' fois un tamagotchi.' ?>
      </p>
      <form id="adopter">
         <input type="text" name="name" placeholder="Nom de votre futur Tamagotchi" style="width:500px">
         <input type="submit" value="Adopter un tamagotchi">
      </form>
   </section>

   <button type="button" name="button" onclick="reloadAll()">Actualisation AUTO</button>
</body>
<script src="index.js"></script>
</html>
