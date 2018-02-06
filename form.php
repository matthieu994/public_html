<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="style.css">
      <title> S'inscrire </title>
   </head>
   <body>
      <h1 align="center">S'inscrire</h1>
      <form action="welcome.php" method="post">
         <table>
            <tr>
               <td>Nom: </td>
               <td><input required="required" type="text" placeholder="Valarcher" name="nom"/></td>
            </tr>
            <tr>
               <td>Prénom: </td>
               <td><input required="required" type="text" placeholder="Pierre" name="prenom"/></td>
            </tr>
            <tr>
               <td>Sexe: </td>
               <td align="left"><input required="required" class="exclude" type="radio" name="sexe" checked="checked" value="homme"/>Homme</td>
            </tr>
            <tr>
               <td></td>
               <td align="left"><input required="required" class="exclude" type="radio" name="sexe" value="femme"/>Femme</td>
            </tr>
            <tr>
               <td> </td>
               <td>
                  <input class="exclude" type="submit" value="S'inscrire"/>
               </td>
            </tr>
            <tr>
               <td></td>
               <td>
                  <input class="exclude" type="reset" value="Recommencer"/>
               </td>
            </tr>
         </table>
      </form>
   </body>
</html>                                                               