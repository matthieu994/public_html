<?php
session_start();
require('bdd.php');

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
   $req->close();
   $db->close();
   echo json_encode($array);
}

?>
