<?php
session_start();
require('bdd.php');

if(isset($_POST['getRooms'])) {
   $status = "On";
   $req = $db->prepare("SELECT * from rooms WHERE status=? OR username=?");
   $req->bind_param('ss', $status, $username);
   $req->execute();
   $result = $req->get_result();
   while ($row = $result->fetch_array()) {
      $status = "checked";
      $req = $db->prepare("SELECT * from lobbys WHERE room=? AND !admin");
      $req->bind_param('s', $row['name']);
      $req->execute();
      $result2 = $req->get_result();
      if ($result2->num_rows == $row['maxplayers'] && $row['username'] != $username) {
         continue;
      }
      if($row['status'] != "On") {
         $status = "";
         echo '<div><span class="playercount"> <label>0</label><label>'. $row['maxplayers'] .'</label></span>';
      }
      else {
         echo '<div><span class="playercount"> <label>'. $result2->num_rows .'</label><label>'. $row['maxplayers'] .'</label></span>';
      }
      echo '<i class="fas fa-sign-in-alt"></i>';
      if ($row['username'] == $username) {
         echo '<span>'. $row['name'] .'
         <i class="fas fa-pencil-alt"></i>
         <input class="tgl tgl-flip" id="'. $row['id'] .'" type="checkbox"'. $status .'/>
         <label class="tgl-btn" data-tg-off="Off" data-tg-on="On" for="'. $row['id'] .'"></label>
         </span>
         </div>';
      }
      else {
         echo '<span style="margin-top: 14px;">'. $row['name'] .'</span></div>';
      }
   }
}
else if (isset($_POST['modifyRoom']) || isset($_POST['editStatus']) || isset($_POST['deleteRoom'])) { //Modification/Suppression/Changement statut
   $id = $_POST['id'];
   $req = $db->prepare("SELECT username FROM rooms WHERE id=?");
   $req->bind_param('s', $id);
   $req->execute();
   $result = $req->get_result();
   $row = $result->fetch_array();
   if($row['username'] != $username) { //On verifie que la salle est à l'user
      echo "ERROR_PERM_UPDATE";
      return;
   }
   if (isset($_POST['modifyRoom'])) {
      $req = $db->prepare("UPDATE rooms SET name=?, maxplayers=? WHERE id=? AND username=?");
      $req->bind_param('ssss', $_POST['room'], $_POST['maxplayers'], $id, $username);
   }
   if (isset($_POST['editStatus'])) {
      $req = $db->prepare("UPDATE rooms SET status=?,question=NULL WHERE id=? AND username=?");
      $req->bind_param('sss', $_POST['status'], $id, $username);
   }
   if (isset($_POST['deleteRoom'])) {
      $req = $db->prepare("DELETE FROM rooms WHERE id=? AND username=?");
      $req->bind_param('ss', $id, $username);
   }
   $req->execute();
}
else if (isset($_POST['verifRoom'])) { //Vérification du nbr de joueurs
   $req = $db->prepare("SELECT username FROM lobbys WHERE room=?");
   $req->bind_param('s', $_POST['room']);
   $req->execute(); $countplayers = $req->get_result()->num_rows;
   echo $countplayers;
   if(isset($_POST['joinRoom'])) { //Join room
      if(isset($_POST['admin']) && $countplayers == 0) {
         $req = $db->prepare("UPDATE lobbys SET room=?,score=0,admin=1 WHERE username=?");
         $req->bind_param('ss', $_POST['room'], $username);
         $req2 = $db->prepare("UPDATE rooms SET delay=?,question_set=? WHERE name=? AND username=?");
         $req2->bind_param('ssss', $_POST['delay'], $_POST['set'], $_POST['room'], $username);
         $req2->execute();
      }
      else {
         $req = $db->prepare("UPDATE lobbys SET room=?,score=0 WHERE username=?");
         $req->bind_param('ss', $_POST['room'], $username);
      }
      $req->execute();
   }
   if (isset($_POST['questionCount']) && $countplayers == 0) {
      $req = $db->prepare("UPDATE rooms SET question_count=?,delay=10 WHERE name=?");
      $req->bind_param('ss', $_POST['questionCount'], $_POST['room']); $req->execute();
   }
}
else { //Création d'une salle
   $room = $_POST['room'];
   $maxplayers = $_POST['maxplayers'];
   $req = $db->prepare("SELECT * FROM rooms WHERE username=?"); //verification nbr de rooms
   $req->bind_param('s', $username);
   $req->execute();
   $result = $req->get_result();
   if ($result->num_rows >= 2) {
      echo "MAX_ROOMS";
      return;
   }
   if ($maxplayers < 1 || strlen($room) <= 1) {
      return;
   }
   $req = $db->prepare("INSERT INTO rooms(username, name, maxplayers) VALUES(?, ?, ?)");
   $req->bind_param('sss', $username, $room, $maxplayers);
   $req->execute();
}
$req->close();
$db->close();
?>
