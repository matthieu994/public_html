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
   header('Location: .');
}

$personne = $_SESSION['nom'];
include('bdd.php');
$stmt = $db->prepare("INSERT INTO paiement (personne, montant) VALUES(?, 0)");
$stmt->bind_param("s", $personne);
$stmt->execute();
$stmt->close();
mysqli_close($db);
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
      <button id="dettes" type="button" name="button">Historique</button>
   </div>

   <div class="container" id="container_courses">
      <?php
      include('bdd.php');
      $query = "SELECT * from listeDeCourse WHERE payeur IS NULL ORDER BY quantite*prix DESC";
      $result = mysqli_query($db, $query) or die(mysql_error());
      mysqli_close($db);

      echo '<table>
      <tr>
      <th>Prix</th>
      <th>Quantité</th>
      <th>Article</th>
      </tr>';
      while($row = $result->fetch_array())
      {
         echo '<tr>';
         echo '<td>' .  $row['prix']*$row['quantite'].'€' . '</td>';
         echo '<td>' .  $row['quantite'] . '</td>';
         echo '<td>' .  $row['article'] . '<a href="delete.php?id='. $row['identifiant'] .'&prix='. $row['prix']*$row['quantite'] .'" class="delete">x</a>' . '</td>';
         // echo '<td class="delete"></td>';
         echo "</tr>";
      }
      echo '</table>';
      ?>

      <form method="POST" action="add.php">
         <input type="text" name="article" placeholder="Article" required>
         <input type="number" name="quantite" placeholder="Quantité" required>
         <input type="number" name="prix" placeholder="Prix" required>
         <button class="ajouter">Ajouter</button>
      </form>
   </div>

   <div class="container" id="container_dettes" style="display: none">
      <?php
      $nom =  $_SESSION['nom'];
      include('bdd.php');
      $req = $db->prepare("SELECT payeur,article,prix*quantite FROM listeDeCourse WHERE payeur IS NOT NULL");
      // $req->bind_param("s", $nom);
      $req->execute();

      $result = $req->get_result();
      echo '<table>
      <tr>
      <th>Prix</th>
      <th>Payeur</th>
      <th>Article</th>
      </tr>';
      while($row = $result->fetch_array())
      {
         echo '<tr>';
         echo '<td>' .  $row['prix*quantite'].'€' . '</td>';
         echo '<td>' .  $row['payeur'] . '</td>';
         echo '<td>' .  $row['article'] . '</td>';
         echo '</tr>';
      }
      echo '</table>';

      $req = $db->query("SELECT AVG(montant) AS 'moyenne' FROM paiement");
      $row = $req->fetch_array();
      $avg = $row['moyenne'];
      echo '<br>';

      $req = $db->query("SELECT * FROM paiement ORDER BY montant");
      while($row = $req->fetch_array())
      {
         $dette = round(($row['montant'] - $avg), 1);
         $bg = "#b7141461";
         if($dette > 0) {
            $dette = '+' . $dette;
            $bg = "#2ba73661";
         }
         echo '<span class="paiement">'. $row['personne'] . '</span><span class="montant" style="background-color:'. $bg .'">' . $dette .'€</span>';
      }


      $req->close();
      $db->close();
      ?>
   </div>

</body>

<script>
document.getElementById('dettes').addEventListener("click", toggle);
function toggle () {
   var container = document.getElementById("container_dettes");
   var container2 = document.getElementById('container_courses');

   if(container.style.display == "none") {
      container.style.visibility = "visible";
      container.style.display = "block";

      container2.style.visibility = "hidden";
      container2.style.display = "none";
      document.getElementById("dettes").innerHTML = "Courses";
   }
   else {
      container.style.visibility = "hidden";
      container.style.display = "none";

      container2.style.visibility = "visible";
      container2.style.display = "block";
      document.getElementById("dettes").innerHTML = "Historique";
   }
}
</script>

</html>
