<html>
  <head>
    <title>PHP - TP1</title>
    <script>
      setTimeout(function myFunction() {
      location.reload();
      }, 700);
    </script>
  </head>
  <body>
    <?php include("rebours.php"); ?>
    <h1 style="text-align: center;">Temps restant avant la fin de l'annee</h1>
    <h3 style="text-align: center;">Il reste 
      <?php echo $day?> jours, 
      <?php echo $hour?> heures, 
      <?php echo $min?> minutes et 
      <?php echo $sec?> secondes.</h3>
  </body>
</html>
