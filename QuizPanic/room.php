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
      if($row['status'] != "On") {
         $status = "";
         echo '<div><span class="playercount"> <label>0</label><label>'. $row['maxplayers'] .'</label></span>';
      }
      else {
         $req = $db->prepare("SELECT * from lobbys WHERE room=? AND !admin");
         $req->bind_param('s', $row['name']);
         $req->execute();
         $result2 = $req->get_result();
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
   $req->close();
   $db->close();
}
else if (isset($_POST['modifyRoom']) || isset($_POST['editStatus']) || isset($_POST['deleteRoom'])) { //Modification/Suppression/Changement statut
   $id = $_POST['id'];
   $req = $db->prepare("SELECT username FROM rooms WHERE id=?");
   $req->bind_param('s', $id);
   $req->execute();
   $result = $req->get_result();
   $row = $result->fetch_array();
   if($row['username'] != $username) { //On verifie que la question est à l'user
      echo "ERROR_PERM_UPDATE";
      return;
   }
   if (isset($_POST['modifyRoom'])) {
      $req = $db->prepare("UPDATE rooms SET name=?, maxplayers=? WHERE id=? AND username=?");
      $req->bind_param('ssss', $_POST['room'], $_POST['maxplayers'], $id, $username);
   }
   if (isset($_POST['editStatus'])) {
      $req = $db->prepare("UPDATE rooms SET status = ? WHERE id=? AND username=?");
      $req->bind_param('sss', $_POST['status'], $id, $username);
   }
   if (isset($_POST['deleteRoom'])) {
      $req = $db->prepare("DELETE FROM rooms WHERE id=? AND username=?");
      $req->bind_param('ss', $id, $username);
   }
   $req->execute();
   $req->close();
   $db->close();
}
else if (isset($_POST['joinRoom'])) {
   $req = $db->prepare("UPDATE lobbys SET room=? WHERE username=?");
   $req->bind_param('ss', $_POST['room'], $username);
   $req->execute();
   $req->close();
   $db->close();
}
else {
   $room = $_POST['room'];
   $maxplayers = $_POST['maxplayers'];
   if ($maxplayers < 1 || strlen($room) <= 1) {
      return;
   }
   $req = $db->prepare("INSERT INTO rooms(username, name, maxplayers) VALUES(?, ?, ?)");
   $req->bind_param('sss', $username, $room, $maxplayers);
   $req->execute();
   $req->close();
   $db->close();
}
?>
