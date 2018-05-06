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
$req = $db->prepare("SELECT status from rooms WHERE name=?"); //Kick si joueur pas dans la salle
$req->bind_param('s', $row['room']);
$req->execute();
$row = $req->get_result()->fetch_array();
if ($row['status'] == "Off") {
   echo "NOT IN ROOM";
   return;
}

$req = $db->prepare("SELECT room from lobbys WHERE username=?"); //Récupération nom room
$req->bind_param('s', $username);
$req->execute();
$result = $req->get_result();
$row = $result->fetch_array();
$room = $row['room'];

if (isset($_POST['loadPlayers'])) {
   $array = new stdClass();
   $array->room = $room;

   loadPlayers($array);
   echo json_encode($array);
}

if (isset($_POST['playerData'])) {
   $array = new stdClass();
   $array->room = $room;

   $req = $db->prepare("UPDATE lobbys SET answer=? WHERE username=?"); //Set answer
   $req->bind_param('ss', $_POST['answer'], $username);
   $req->execute();

   loadPlayers($array);
   $req = $db->prepare("SELECT * from questions WHERE id=?"); //Récupération de la question
   $req->bind_param('s', $array->question_id);
   $req->execute();
   $row = $req->get_result()->fetch_array();
   $array->question = array(
      0 => $row['question'],
      1 => $row['answer1'],
      2 => $row['answer2'],
      3 => $row['answer3'],
      4 => $row['answer4'],
      'good' => $row['good_answer']
   );
   echo json_encode($array);
}

function loadPlayers ($array) {
   global $db, $username;

   $req = $db->prepare("SELECT maxplayers,question from rooms WHERE name=?"); //Récupération maxplayers
   $req->bind_param('s', $array->room);
   $req->execute();
   $row = $req->get_result()->fetch_array();
   $array->maxplayers = $row['maxplayers'];
   $array->question_id = $row['question'];

   $req = $db->prepare("SELECT username,answer from lobbys WHERE room=? AND !admin"); //Récupération players en jeu
   $req->bind_param('s', $array->room);
   $req->execute();
   $result = $req->get_result();
   $array->current = $result->num_rows;
   $i = 0;
   while ($row = $result->fetch_assoc()) {
      $req2 = $db->prepare("SELECT avatar from users WHERE username=?"); //Récupération avatar, answer de chaque joueur
      $req2->bind_param('s', $row['username']);
      $req2->execute();
      $row2 = $req2->get_result()->fetch_array();

      if ($row['username'] == $username) {
         $array->user = array(
            'username' => $row['username'],
            'answer' => $row['answer'],
            'avatar' => $row2['avatar']
         );
      }
      else {
         $array->$i = array(
            'username' => $row['username'],
            'answer' => $row['answer'],
            'avatar' => $row2['avatar']
         );
         $i++;
      }
   }
}


if (isset($_POST['loadQuestions'])) {
   $array = new stdClass();
   $req = $db->prepare("SELECT * FROM questions WHERE question_set=?");
   $req->bind_param('s', $_POST['loadQuestions']); $req->execute(); $result = $req->get_result();
   $i = 0;
   while ($row = $result->fetch_assoc()) {
      $array->$i = $row['id'];
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
if (isset($_POST['getAvatar'])) {
   $req = $db->prepare("SELECT avatar from users WHERE username=?");
   $req->bind_param('s', $username);
   $req->execute();
   $row = $req->get_result()->fetch_array();
   echo $row['avatar'];
}
if (isset($_POST['setAvatar'])) {
   $req = $db->prepare("UPDATE users SET avatar=? WHERE username=?");
   $req->bind_param('ss', $_POST['setAvatar'], $username);
   $req->execute();
}
if (isset($_POST['setQuestion'])) {
   $req = $db->prepare("UPDATE rooms SET question=? WHERE name=?");
   $req->bind_param('ss', $_POST['setQuestion'], $room);
   $req->execute();
}
$req->close();
$db->close();
?>
