<?php
session_start();
require('bdd.php');

$req = $db->prepare("SELECT room from lobbys WHERE username=?"); //Kick si joueur pas dans la salle
$req->bind_param('s', $username);
$req->execute();
$row = $req->get_result()->fetch_array();
if ($row['room'] == NULL) {
   echo "NOT IN ROOM";
   return;
}

if (isset($_POST['getName'])) {
   $req = $db->prepare("SELECT room from lobbys WHERE username=?"); //Récupération nom room
   $req->bind_param('s', $username);
   $req->execute();
   $result = $req->get_result();
   $row = $result->fetch_array();
   $array = new stdClass();
   $array->room = $row['room'];
}
if (isset($_POST['loadPlayers'])) {
   $req = $db->prepare("SELECT maxplayers from rooms WHERE name=?"); //Récupération maxplayers
   $req->bind_param('s', $array->room);
   $req->execute();
   $result = $req->get_result();
   $row = $result->fetch_array();
   $array->maxplayers = $row['maxplayers'];

   $req = $db->prepare("SELECT username from lobbys WHERE room=? AND !admin"); //Récupération players en jeu
   $req->bind_param('s', $array->room);
   $req->execute();
   $result = $req->get_result();
   $array->current = $result->num_rows;
   $i = 0;
   while ($row = $result->fetch_assoc()) {
      $array->$i = $row['username'];
      $i++;
   }
   echo json_encode($array);
}
if (isset($_POST['kickAll'])) {
   $req = $db->prepare("UPDATE lobbys SET room=NULL WHERE room=?");
   $req->bind_param('s', $_POST['room']);
   $req->execute();
}
if (isset($_POST['leaveRoom'])) {
   $req = $db->prepare("UPDATE lobbys SET room=NULL WHERE username=?");
   $req->bind_param('s', $username);
   $req->execute();
}
$req->close();
$db->close();
?>
