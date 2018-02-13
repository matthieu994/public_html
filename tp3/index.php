<!-- UTIL PDO -->
<?php
try
{
   $db = new PDO('mysql:host=localhost;dbname=website;charset=utf8', 'root', ' ');
}
catch (Exception $e)
{
   die('Erreur lors de la connexion à la base de données : ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width" />
   <title> MySQL </title>
   <link href="https://matthieu994.github.io/style.css" rel="stylesheet" />
   <style media="screen">
      .centerer {
         border: 1px solid white;
         width: 80%;
         height: 80%;
         position: absolute;
         margin: auto 10%;
         margin-top: 80px;
      }
   </style>
</head>
<body>

   <div class="centerer">
      <?php
      $sel = $db->query('SELECT * FROM jeux_video ORDER BY prix ASC');
      while ($data = $sel->fetch())
      {
      ?>
          <p>
          <strong>Jeu</strong> : <?php echo $data['nom']; ?><br />
          Le possesseur de ce jeu est : <?php echo $data['possesseur']; ?>, et il le vend à <?php echo $data['prix']; ?> euros !<br />
          Ce jeu fonctionne sur <?php echo $data['console']; ?> et on peut y jouer à <?php echo $data['nbre_joueurs_max']; ?> au maximum<br />
          <?php echo $data['possesseur']; ?> a laissé ces commentaires sur <?php echo $data['nom']; ?> : <em><?php echo $data['commentaires']; ?></em>
         </p>
      <?php } $sel = closeCursor(); ?>
   </div>

</body>
</html>
