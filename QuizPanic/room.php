<?php
session_start();
require('bdd.php');

$username = $_SESSION['username'];
if(isset($_POST['getRooms'])) {
   $req = $db->prepare("SELECT * from rooms WHERE username=?");
   $req->bind_param('s', $username);
   $req->execute();
   $result = $req->get_result();
   while ($row = $result->fetch_array()) {
      $status = "checked";
      if($row['status'] == "disabled") $status = "";
      echo '
      <div>
      <span class="playercount"> <label>0</label><label>'. $row['maxplayers'] .'</label></span>
      <span>'.$row['name'].'
      <i class="fas fa-pencil-alt"></i>
      <input class="tgl tgl-flip" id="'. $row['id'] .'" type="checkbox"'. $status .'/>
      <label class="tgl-btn" data-tg-off="Plein!" data-tg-on="Ouvert!" for="'. $row['id'] .'"></label>
      </span>
      </div>
      <i class="fas fa-times" style="color: #d72d2d"></i>
      ';
   }
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
