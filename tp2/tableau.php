<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width" />
   <title></title>
   <link href="https://matthieu994.github.io/style.css" rel="stylesheet" />

   <style media="screen">
   h1 {
      font-weight: bold;
      text-transform: uppercase;
      font-size: 50px;
      padding: 15px;
   }
   table {
      width: 80%;
      float: left;
      margin-left: 10%;
      font-size: 25px;
      /* table-layout: fixed; */
      /* border: 1px solid white; */
   }
   th {
      font-weight: 400;
      font-size: 35px;
      padding: 5px;
      margin-bottom: 15px;
      background: #171e1b;
   }
   td {
      text-align: center;
      padding-bottom: 5px;
      padding-top: 5px;
      /* min-width: 100px; */
   }
   .surpoids {
      background: #473434;
   }
   .souspoids {
      background: #474734;
   }

   .pagination {
      display: inline-block;
      margin-left: 10%;
      margin-top: 20px;
   }
   .pagination a {
      color: white;
      font-weight: 400;
      float: left;
      padding: 8px 16px;
      text-decoration: none;
      border-top: 1px solid #171e1b;
      border-left: 1px solid #171e1b;
      border-bottom: 1px solid #171e1b;
      transition: all 0.5s ease-out;
   }
   .pagination a.active {
      background-color: #171e1b;
      color: white;
      border: 1px solid #171e1b;
   }
   .pagination a:hover:not(.active) {background-color: #1d2622; border: #1d2622;}
   .pagination a:first-child {
      border-top-left-radius: 5px;
      border-bottom-left-radius: 5px;
   }
   .pagination a:last-child {
      border-top-right-radius: 5px;
      border-bottom-right-radius: 5px;
      border-right: 1px solid #171e1b;
   }

   i {
      border: solid white;
      border-width: 0 3px 3px 0;
      display: inline-block;
      padding: 7px;
   }

   .arrow-up {
      display: inline-block;
      margin-left: 10px;
      width: 0;
      height: 0;
      border-left: 8px solid transparent;
      border-right: 8px solid transparent;

      border-bottom: 15px solid <?php if($_GET['sort'] == "NU") echo "#6d6d6d"; else echo "white"; ?>;
   }
   .arrow-up:hover {
      border-bottom-color: #a3a3a3;
      transition: none;
   }

   .arrow-down {
      display: inline-block;
      margin-left: 5px;
      width: 0;
      height: 0;
      border-left: 8px solid transparent;
      border-right: 8px solid transparent;

      border-top: 15px solid <?php if($_GET['sort'] == "ND") echo "#6d6d6d"; else echo "white"; ?>;
   }
   .arrow-down:hover {
      border-top-color: #a3a3a3;
      transition: none;
   }

   .legende {
      /* border: 1px solid white; */
      display: inline-block;
      float: right;
      margin: 0;
      margin-right: 11%;
      margin-top: 20px;
   }
   .container {
      position:fixed;
      top:0;
      right:10%;
      bottom:0;
      left:10%;
      /* border: 1px solid white; */
      /* min-width: 1200px; */
   }

   @media (max-width: 1200px) {
      table {
         margin: 0;
      }
      .container {
         right: 0;
         left: 0;
      }
   }
   </style>
</head>
<body>
   <?php
   include 'data.php';

   if(!isset($_GET['page']) || $_GET['page'] >= 8 || $_GET['page'] <= 0)
   $_GET['page'] = 1;

   if(!isset($_GET['sort']))
   $_GET['sort'] = "NONE";
   ?>
   <div class="container">
      <h1 align="center">Données</h5>
         <table>
            <thead>
               <tr>
                  <th style="width: 400px">Nom<div class="arrow-up" onclick="location.href='./tableau.php?page=<?php echo $_GET['page']."&" ?>sort=NU';"></div><div class="arrow-down" onclick="location.href='./tableau.php?page=<?php echo $_GET['page']."&" ?>sort=ND';"></div></th>
                  <th style="width: 100px">Prénom</th>
                  <th style="width: 500px">Mail</th>
                  <th style="width: 100px">Taille</th>
                  <th style="width: 80px">Poids</th>
                  <th style="width: 120px">Imc</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $nb=count($data);
               $display = 15;
               $start = ($_GET["page"]-1) * $display;

               function cmp($a, $b)
               {
                  return strcmp($a["Nom"], $b["Nom"]);
               }

               function cmpbis($a, $b)
               {
                  return strcmp($b["Nom"], $a["Nom"]);
               }

               if(($_GET['sort']) == "NU")
               usort($data, "cmp");

               if(($_GET['sort']) == "ND")
               usort($data, "cmpbis");

               for ($i = $start; $i < ($start+$display) && $i < $nb; $i++){
                  $personne=$data[$i];
                  $m=$personne['Poids'];
                  $t=$personne['Taille']/100;
                  $imc=$m/($t*$t);
                  $class="";
                  if ($imc >= 25) $class="surpoids";
                  if ($imc <= 18.5) $class="souspoids";
                  echo "<tr class=\"$class\">";
                  echo "<td>".$personne['Nom']."</td>";
                  echo "<td>".$personne['Prenom']."</td>";
                  echo "<td>".$personne['Email']."</td>";
                  echo "<td>".$personne['Taille']."</td>";
                  echo "<td>".$personne['Poids']."</td>";
                  echo "<td>".round($imc,2)."</td>";
                  echo "</tr>";
               }
               ?>
            </tbody>
         </table>
         <div class="pagination">
            <a href="?page=<?php echo $_GET['page']-1; echo '&sort='.$_GET['sort']; ?>"> &laquo;</a>
            <a <?php if($_GET['page'] == 1) echo 'class="active"'; ?> href="?page=1<?php echo '&sort='.$_GET['sort'] ?>">1</a>
            <a <?php if($_GET['page'] == 2) echo 'class="active"'; ?> href="?page=2<?php echo '&sort='.$_GET['sort'] ?>">2</a>
            <a <?php if($_GET['page'] == 3) echo 'class="active"'; ?> href="?page=3<?php echo '&sort='.$_GET['sort'] ?>">3</a>
            <a <?php if($_GET['page'] == 4) echo 'class="active"'; ?> href="?page=4<?php echo '&sort='.$_GET['sort'] ?>">4</a>
            <a <?php if($_GET['page'] == 5) echo 'class="active"'; ?> href="?page=5<?php echo '&sort='.$_GET['sort'] ?>">5</a>
            <a <?php if($_GET['page'] == 6) echo 'class="active"'; ?> href="?page=6<?php echo '&sort='.$_GET['sort'] ?>">6</a>
            <a <?php if($_GET['page'] == 7) echo 'class="active"'; ?> href="?page=7<?php echo '&sort='.$_GET['sort'] ?>">7</a>
            <a href="?page=<?php echo $_GET['page']+1; echo '&sort='.$_GET['sort']; ?>"> &raquo;</a>
         </div>
         <div class="legende pagination">
            <a class="souspoids"> Sous-poids</a>
            <a class="surpoids"> Surpoids</a>
         </div>
      </div>
   </body>
   </html>
