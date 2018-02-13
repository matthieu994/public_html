<?php
session_start();
if(!isset($_SESSION["connected"])) {
   $_SESSION["connected"] = 0;
}
if($_SESSION["connected"] == 1) {
   header('Location: ./salon.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <title> Login </title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="style.css">

   <!-- <style media="screen">
   .select {
   border: 1px solid red;
}
</style> -->

</head>
<body>

   <div class="container-login">
      <form method="POST" action="salon.php">

         <input class="animated bounceIn pseudo" type="text" name="pseudo" placeholder="Pseudo"
         <?php
         if(isset($_COOKIE["pseudo"]))
         echo 'value="' . $_COOKIE["pseudo"] . '"';
         ?>
         required>

         <select class="animated bounceIn salon-select" name="salon">
            <option>APL</option>
            <option>WIM</option>
            <option>SQL</option>
            <option>ASR</option>
         </select>

         <button class="login animated zoomIn">Rejoindre</button>

      </form>
   </div>

</body>
</html>
