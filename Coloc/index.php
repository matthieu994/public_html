<?php
session_start();

if(!isset($_SESSION["connected"])) {
   $_SESSION["connected"] = 0;
}
if($_SESSION["connected"] == 1 && isset($_SESSION["nom"])) {
   header('Location: courses.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title> Login </title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

   <div class="container">
      <form method="POST" action="courses.php">

         <input class="pseudo" type="text" name="nom" placeholder="Pseudo" autocomplete="off" required>
         <button class="ajouter login">Rejoindre</button>

  
         <div id="results">
         </div>
      </form>
   </div>

</body>
<script src="script.js"></script>
</html>