<?php
require 'bdd.php';

/*------------------------------- ADOPTER -----------------------------------*/
if(isset($_POST['name'])) {
   $naissance = time();
   $nom = htmlspecialchars($_POST['name']);
   $req = $db->prepare("INSERT INTO main (nom, naissance, soif, faim, bonheur) VALUES (?, ?, ?, ?, ?)");
   $req->bind_param('sssss', $nom, $naissance, $naissance, $naissance, $naissance);
   $req->execute();
   $req->close();
   $db->close();
}

/*------------------------------- LISTER -----------------------------------*/
if(isset($_POST['lister'])) {
   $req = $db->prepare("SELECT * FROM main");
   $req->execute();
   $result = $req->get_result();
   echo '<tr>
   <th>Nom</th>
   <th>Âge</th>
   <th>Soif</th>
   <th>Faim</th>
   <th>Bonheur</th>
   <th></th>
   </tr>';
   while ($row = $result->fetch_assoc()) {
      echo '<tr>
      <td><a href="care.php?tama='. $row['id'] .'">'. $row['nom'] .'</a></td>
      <td>'. secondsToTime(time() - $row['naissance']) .'</td>
      <td>'. level("soif", $row['soif']) .'</td>
      <td>'. level("faim", $row['faim']) .'</td>
      <td>'. level("bonheur", $row['bonheur']) .'</td>
      <td><a id="'. $row['id'] .'" onclick="update('. $row['id'] .')" class="update"><img src="refresh-icon.svg" width=20> Actualiser état</a></td>
      </tr>';
   }
   $req->close();
   $db->close();
}
function level($type, $lvl) {
   $lvl = time() - $lvl;
   if($type == 'soif') {
      if($lvl < 60) return "n’a pas soif !";
      if($lvl < 180) return "a un peu soif";
      if($lvl < 240) return "a soif.";
      if($lvl < 300) return "a très soif !";
      if($lvl >= 300) return "est mort de soif...";
   }
   if($type == 'faim') {
      if($lvl < 60) return "n’a pas faim ! ";
      if($lvl < 180) return "a un peu faim.";
      if($lvl < 240) return "a faim.";
      if($lvl < 300) return "a très faim !";
      if($lvl >= 300) return "est mort de faim...";
   }
   if($type == 'bonheur') {
      if($lvl < 60) return "est très heureux !";
      if($lvl < 180) return "va bien.";
      if($lvl < 240) return "est un peu down";
      if($lvl < 300) return "est malheureux et délaissé !";
      if($lvl >= 300) return "est complètement déprimé...";
   }
}
function secondsToTime($seconds) {
   $dtF = new \DateTime('@0');
   $dtT = new \DateTime("@$seconds");
   return $dtF->diff($dtT)->format('%a jours, %h:%i:%s');
}

/*------------------------------- RELOAD -----------------------------------*/
if(isset($_POST['reload'])) {
   $req = $db->prepare("SELECT naissance,soif,faim,bonheur FROM main WHERE id=?");
   $req->bind_param('s', $_POST['reload']);
   $req->execute();
   $row = $req->get_result()->fetch_assoc();
   $array['naissance'] = secondsToTime(time() - $row['naissance']);
   $array['soif'] = level("soif", $row['soif']);
   $array['faim'] = level("faim", $row['faim']);
   $array['bonheur'] = level("bonheur", $row['bonheur']);
   echo json_encode($array);
   $req->close();
   $db->close();
}

/*------------------------------- LOAD TAMA CARE.PHP -----------------------------------*/
if(isset($_POST['loadTama'])) {
   $naissance = time();
   $req = $db->prepare("SELECT * FROM main WHERE id=?");
   $req->bind_param('s', $_POST['loadTama']);
   $req->execute();
   $row = $req->get_result()->fetch_assoc();

   echo '<h1>Bienvenue dans la cage de '. $row['nom'] .'</h1>
   <img src="pink-face.png" width="20%">
   <h1>Vous pouvez: </h1>
   <ul>';

   echo '<li><a onclick="feed('. $row['id'] .')"> Nourrir '. $row['nom'] .'</a>. '. $row['nom'].' '.level("faim", $row['faim']) .' </li>
   <li><a onclick="water('. $row['id'] .')"> Donner à boire à '. $row['nom'] .'</a>. '. $row['nom'].' '.level("soif", $row['soif']) .' </li>
   <li><a onclick="pet('. $row['id'] .')"> Caresser '. $row['nom'] .'</a>. '. $row['nom'].' '.level("bonheur", $row['bonheur']) .' </li>
   <li><a href="index.php"> Revenir &agrave; la page principale</a></li>';
}

/*------------------------------- FEED/WATER/PET -----------------------------------*/
if(isset($_POST['feed'])) {
   $now = time();
   $req = $db->prepare("UPDATE main SET faim=? WHERE id=?");
   $req->bind_param('ss', $now, $_POST['feed']);
   $req->execute();
   setcookie('feed', $_COOKIE['feed']+1, time() + (86400 * 30), "/");
}
if(isset($_POST['water'])) {
   $now = time();
   $req = $db->prepare("UPDATE main SET soif=? WHERE id=?");
   $req->bind_param('ss', $now, $_POST['water']);
   $req->execute();
   setcookie('water', $_COOKIE['water']+1, time() + (86400 * 30), "/");
}
if(isset($_POST['pet'])) {
   $now = time();
   $req = $db->prepare("UPDATE main SET bonheur=? WHERE id=?");
   $req->bind_param('ss', $now, $_POST['pet']);
   $req->execute();
   setcookie('pet', $_COOKIE['pet']+1, time() + (86400 * 30), "/");
}

?>
