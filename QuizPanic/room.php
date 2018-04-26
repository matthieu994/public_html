<?php
session_start();
require('bdd.php');

$username = $_SESSION['username'];
if(isset($_POST['getRooms'])) {
   $status = "enabled";
   $req = $db->prepare("SELECT * from rooms WHERE status=? OR username=?");
   $req->bind_param('ss', $status, $username);
   $req->execute();
   $result = $req->get_result();
   while ($row = $result->fetch_array()) {
      $status = "checked";
      if($row['status'] != "enabled") $status = "";
      echo '<div>
      <span class="playercount"> <label>0</label><label>'. $row['maxplayers'] .'</label></span>
      <span>'.$row['name'];
      if ($row['username'] == $username) {
         echo'
         <i class="fas fa-pencil-alt"></i>
         <input class="tgl tgl-flip" id="'. $row['id'] .'" type="checkbox"'. $status .'/>
         <label class="tgl-btn" data-tg-off="Off" data-tg-on="On" for="'. $row['id'] .'"></label>
         </span>
         </div>
         <i class="fas fa-times" style="color: #d72d2d"></i>';
      }
      else {
         echo '</span></div>';
      }
   }
   $req->close();
   $db->close();
}
else if (isset($_POST['setStatus'])) {

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
