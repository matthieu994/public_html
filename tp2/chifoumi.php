<?php
session_start();
if(!isset($_SESSION['score']))
$_SESSION['score'] = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <title> Chifoumi! </title>
   <style media="screen">
   .chifoumi {
      width: 15%;
      padding: 2%;
      margin-right: auto;
   }
   .chifoumi[src="http://picoplex.net/games/rpslp/rock.png"] {
      margin-left: 27%;
   }
   .coup {
      margin: 0;
      width: 100%;
      display: inline-block;
      /* border: 1px solid white; */
   }
   .coup > h1 {
      font-weight: bold;
      display: inline;
      /* border: 1px solid white; */
   }
   .pl {
      position: absolute;
      width: 300px;
      left: 20%;
   }
   .pc {
      position: absolute;
      width: 300px;
      right: 20%;
   }
   .choix {
      width: 100%;
      margin-top: 0;
      display: inline-block;
      margin-bottom: 20px;
      <?php
      if ($_GET["coup"] != 0)
      echo "border-bottom: 1px solid white;";
      ?>
   }
   .jplayed {
      width: 10%;
      margin-left: 25%;
      margin-top: 4%;
   }
   .pcplayed {
      width: 10%;
      margin-left: 30%;
      margin-top: 4%;
   }
   button {
      font-size: 1em;
      background-color: #a14545;
      width: 20%;
      color: white;
      padding: 14px 20px;
      margin-left: 40%;
      border: none;
      border-radius: 4px;
      cursor: pointer;
   }
   h2 {
      position:float;
      font-weight: bold;
      font-size: 2em;
   }
   </style>
</head>
<body>
   <h1>à vous de jouer!</h1>
   <div class="choix">
      <a href="?coup=1"><img class="chifoumi" src="http://picoplex.net/games/rpslp/rock.png"></a>
      <a href="?coup=2"><img class="chifoumi" src="http://picoplex.net/games/rpslp/paper.png"></a>
      <a href="?coup=3"><img class="chifoumi" src="http://picoplex.net/games/rpslp/scissors.png"></a>
   </div>
   <?php
   $pl = $_GET["coup"];
   if($pl == 0) {
      exit();
   }
   $pc = rand(1, 3);
   echo '<div class="coup">';
   echo '<h1 class="pl">Votre coup</h1>';
   echo '<h1 class="pc">Ordinateur</h1>';
   echo '</div>';
   echo '<div class="result">';
   if($pl == 1)
   echo '<img class="jplayed w3-container w3-center w3-animate-left" src="http://picoplex.net/games/rpslp/rock.png">';
   if($pl == 2)
   echo '<img class="jplayed w3-container w3-center w3-animate-left" src="http://picoplex.net/games/rpslp/paper.png">';
   if($pl == 3)
   echo '<img class="jplayed w3-container w3-center w3-animate-left" src="http://picoplex.net/games/rpslp/scissors.png">';
   if($pc == 1)
   echo '<img class="pcplayed w3-container w3-center w3-animate-right" src="http://picoplex.net/games/rpslp/rock.png">';
   if($pc == 2)
   echo '<img class="pcplayed w3-container w3-center w3-animate-right" src="http://picoplex.net/games/rpslp/paper.png">';
   if($pc == 3)
   echo '<img class="pcplayed w3-container w3-center w3-animate-right" src="http://picoplex.net/games/rpslp/scissors.png">';
   echo '<div class="w3-container w3-center w3-animate-top">';
   if(($pl == 1 && $pc == 2) || ($pl == 2 && $pc == 3) || ($pl == 3 && $pc == 1)) {
      echo '<h1>Perdu!</h1>';
      if($_SESSION['score'] > 0)
      $_SESSION['score'] -= 1;
   }
   else if(($pl == 2 && $pc == 1) || ($pl == 3 && $pc == 2) || ($pl == 1 && $pc == 3)) {
      echo '<h1>Gagné!</h1>';
      $_SESSION['score'] += 1;
   }
   else {
      echo '<h1>égalité!</h1>';
   }
   echo '</div>';
   echo '</div>';
   ?>
   <button onclick="logout.php" type="button" id="reset">Recommencer</button>
   <h2>Votre score: <?php echo $_SESSION['score']; ?></h2>
</body>
<script>
var btn = document.getElementById('reset');
btn.addEventListener('click', function() {
   document.location.href = 'logout.php';
});
</script>
</html>
