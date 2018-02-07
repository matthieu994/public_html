<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="style.css">
   <title> Calculette </title>
</head>
<body>
   <h1>Calculette</h1>
   <?php
   if(!empty($_GET["table"])) {
      $ent = $_GET["table"];
      $arr = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
      echo '<h2>Table de ' . $ent . '</h1>';
      echo '<ul style="list-style-position: inside;">';
      foreach ($arr as $variable) {
         echo '<li style="color: white; text-align: center">';
         echo "$variable x $ent = " . ($ent * $variable);
         echo '</li>';
      }
      echo '</ul>';
   }
   ?>
   <form method="get">
      <table>
         <tr>
            <td>
               <input type="number" name="table" placeholder="table de multiplication">
            </td>
         </tr>
         <tr>
            <td>
               <input class="exclude" type="submit" value="Calculer"/>
               <input class="exclude" type="reset" value="Recommencer"/>
            </td>
         </tr>
      </table>
   </form>
</body>
</html>
