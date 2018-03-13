<?php
session_start();
if(!isset($connected)) {
   $connected = 0;
}
if(isset($_POST["nom"]) || isset($_SESSION['nom'])) {
   $connected = 1;
   $_SESSION['connected'] = 1;
   if(isset($_POST['nom']))
   $_SESSION['nom'] = $_POST["nom"];
}
if(!$connected) {
   // header('Location: .');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title> Liste de Courses </title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

   <div class="signup">
      <button type="button" name="button" onclick="window.location.href='logout.php'">Déconnexion</button>
   </div>

   <div class="container">
      <?php

      $query = "SELECT * from listeDeCourse ORDER BY quantite DESC";
      include('bdd.php');
      $result = mysqli_query($db, $query) or die(mysql_error());
      mysqli_close($db);

      echo '<table>
      <tr>
      <th>Quantite</th>
      <th>Article</th>
      </tr>';
      while($row = $result->fetch_array())
      {
         echo '<tr>';
         echo '<td>' .  $row['quantite'] . '</td>';
         echo '<td>' .  $row['article'] . '<a href="delete.php?id='. $row['identifiant'] .'" class="delete">x</a>' . '</td>';
         // echo '<td class="delete"></td>';
         echo "</tr>";
      }
      echo '</table>';
      ?>

      <form method="POST" action="add.php">
         <input type="text" name="article" placeholder="Article" required>
         <input type="number" name="quantite" placeholder="Quantité" required>
         <button class="ajouter">Ajouter</button>
      </form>
   </div>

</body>

</html>
