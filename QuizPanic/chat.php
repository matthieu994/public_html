<?php
session_start();
require('bdd.php');

if (isset($_POST['loadMessages'])) {
   $req = $db->prepare("SELECT message,username FROM chat WHERE room=?");
   $req->bind_param('s', $_POST['loadMessages']);
   $req->execute();
   $result = $req->get_result();
   while ($row = $result->fetch_assoc()) {
      if($row['username'] == $username) echo '<div class="me"><span>'.$row['message'].'</span></div>';
      else echo '<div><span>'.$row['username'].': '.$row['message'].'</span></div>';
   }
}

if (isset($_POST['message'])) {
   $req = $db->prepare("INSERT INTO chat(message,room,username) VALUES(?,?,?)");
   $req->bind_param('sss', $_POST['message'], $_POST['room'], $username);
   $req->execute();
}

if (isset($_POST['deleteAll'])) {
   $req = $db->prepare("DELETE FROM chat WHERE room=?");
   $req->bind_param('s', $_POST['deleteAll']);
   $req->execute();
}
?>
