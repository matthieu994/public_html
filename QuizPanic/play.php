<?php
header( 'content-type: text/html; charset=utf-8' );
session_start();
require('bdd.php');

if (isset($_POST['leaveRoom'])) {
   $req = $db->prepare("UPDATE lobbys SET room=NULL,admin=0 WHERE username=?");
   $req->bind_param('s', $username);
   $req->execute();
}
if (isset($_POST['kickAll'])) {
   $req = $db->prepare("UPDATE lobbys SET room=NULL,admin=0 WHERE room=?");
   $req->bind_param('s', $_POST['kickAll']);
   $req->execute();
}
$req = $db->prepare("SELECT room from lobbys WHERE username=?"); //Kick si joueur pas dans la salle
$req->bind_param('s', $username);
$req->execute();
$row = $req->get_result()->fetch_array();
$room = $row['room'];
if (empty($row['room'])) {
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

if (isset($_POST['loadPlayers'])) {
   $array = new stdClass();
   $array->room = $room;
   $req = $db->prepare("UPDATE lobbys SET answer=0 WHERE room=? AND username=?"); //Reset question de la salle
   $req->bind_param('ss', $room, $username);
   $req->execute();

   loadPlayers($array);
   if($array->current != 1 && $array->current != 0) {
      echo json_encode($array);
      return;
   }

   $req = $db->prepare("UPDATE rooms SET question=NULL WHERE name=?"); //Reset question de la salle
   $req->bind_param('s', $room); $req->execute();
   if ($array->admin == 2) {
      $req = $db->prepare("SELECT id FROM questions WHERE question_set=?"); //Selection des questions aléatoires
      $req->bind_param('s', $array->question_set); $req->execute();
   } else {
      $req = $db->prepare("SELECT id FROM questions WHERE question_set='Public'"); //Selection des questions aléatoires
   }
   $req->execute();
   $result = $req->get_result();
   $i = 0;
   while ($row = $result->fetch_assoc()) {
      $i++;
      $questions[$i] = $row['id'];
   }
   $rand_questions = array_rand($questions, $array->question_count);
   for ($i=0; $i < $array->question_count; $i++) {
      $array->question_list[$i] = $questions[$rand_questions[$i]];
   }
   echo json_encode($array);
}

if (isset($_POST['playerData'])) {
   $array = new stdClass();
   $array->room = $room;

   loadPlayers($array);
   echo json_encode($array);
}

function loadPlayers ($array) {
   global $db, $username;

   $req = $db->prepare("SELECT maxplayers,question,question_count,delay,question_set from rooms WHERE name=?"); //Récupération maxplayers
   $req->bind_param('s', $array->room);
   $req->execute();
   $row = $req->get_result()->fetch_array();
   $array->maxplayers = $row['maxplayers'];
   $array->question_count = $row['question_count'];
   $array->time = $row['delay'];
   $array->question_set = $row['question_set'];
   $array->question_id = $row['question'];

   $req = $db->prepare("SELECT username from lobbys WHERE room=? AND admin=1"); //Récupération admin
   $req->bind_param('s', $array->room); $req->execute();
   $row = $req->get_result()->fetch_array();
   if(!empty($row['username']) && $row['username'] == $username) $array->admin = 2;
   else if(!empty($row['username'])) $array->admin = 1;
   else $array->admin = 0;

   $req = $db->prepare("SELECT username,answer,score from lobbys WHERE room=? AND !admin"); //Récupération players en jeu
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
            'avatar' => $row2['avatar'],
            'score' => $row['score']
         );
      }
      else {
         $array->$i = array(
            'username' => $row['username'],
            'answer' => $row['answer'],
            'avatar' => $row2['avatar'],
            'score' => $row['score']
         );
         $i++;
      }
   }
}


// if (isset($_POST['loadQuestions'])) { //Pas utilisé
//    $req = $db->prepare("SELECT question FROM rooms WHERE name=?");
//    $req->bind_param('s', $room); $req->execute();
//    $row = $req->get_result()->fetch_assoc();
//    echo "'".$row['question']."'";
//    if (!empty($row['question'])) {
//       return;
//    }
//
//    $array = new stdClass();
//    $req = $db->prepare("SELECT id FROM questions WHERE question_set=?"); //Selection d'une question aléatoire
//    $req->bind_param('s', $_POST['loadQuestions']); $req->execute();
//    $result = $req->get_result();
//    $i = 0;
//    $rand = rand(1,$result->num_rows);
//    $array->$i = $rand;
//    while ($row = $result->fetch_assoc()) {
//       $i++;
//       $array->$i = $row['id'];
//    }
//    $i = 0;
//    $req = $db->prepare("UPDATE rooms SET question=? WHERE name=?");
//    $req->bind_param('ss', $array->$rand, $room); $req->execute();
//    echo json_encode($array);
// }
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
if (isset($_POST['setAnswer'])) {
   $req = $db->prepare("UPDATE lobbys SET answer=? WHERE username=?"); //Set answer
   $req->bind_param('ss', $_POST['setAnswer'], $username);
   $req->execute();
}
if (isset($_POST['resetAnswers'])) {
   $req = $db->prepare("UPDATE lobbys SET answer=0 WHERE room=?"); //Set answers to 0
   $req->bind_param('s', $room);
   $req->execute();
}
if (isset($_POST['setQuestion'])) {
   $req = $db->prepare("UPDATE rooms SET question=? WHERE name=?");
   $req->bind_param('ss', $_POST['setQuestion'], $room);
   $req->execute();
   // echo $_POST['setQuestion'];
}
if (isset($_POST['getQuestion'])) {
   do {
      $req = $db->prepare("SELECT question FROM rooms WHERE name=?");
      $req->bind_param('s', $room); $req->execute();
      $row = $req->get_result()->fetch_assoc();
   } while (empty($row['question']));
   $id = $row['question'];
   $req = $db->prepare("SELECT * from questions WHERE id=?"); //Récupération de la question
   $req->bind_param('s', $id);
   $req->execute();
   $row = $req->get_result()->fetch_assoc();
   $question = array(
      0 => $row['question'],
      1 => $row['answer1'],
      2 => $row['answer2'],
      3 => $row['answer3'],
      4 => $row['answer4'],
      'good' => $row['good_answer'],
      'id' => $id
   );
   // print_r($question);
   // $question = array_map('utf8_encode', $question);
   // print_r($question);
   echo json_encode($question);
   // echo "here";
}
if (isset($_POST['setScore'])) {
   $req = $db->prepare("UPDATE lobbys SET score=? WHERE username=?");
   $req->bind_param('ss', $_POST['setScore'], $username); $req->execute();
}
if (isset($_POST['setScores'])) {
   // $scores = new stdClass();
   $p = 0;
   for ($i=0; $i < count($_POST['setScores']); $i++) {
      if ($_POST['setScores'][$i]['answer'] == $_POST['goodAnswer']) {
         $req = $db->prepare("UPDATE lobbys SET score=score+3 WHERE username=?");
         $req->bind_param('s', $_POST['setScores'][$i]['username']); $req->execute();
         // $scores->$p = array(
         //    'player' => $i,
         //    'score' => 3
         // );
         // $p++;
      }
   }
   // echo json_encode($scores);
}
if (isset($_POST['getScores'])) {
   $scores = new stdClass();
   $i = 0;
   $req = $db->prepare("SELECT score FROM lobbys WHERE room=?");
   $req->bind_param('s', $room); $req->execute(); $result = $req->get_result();
   while ($row = $result->fetch_assoc()) {
      $scores->$i = $row['score'];
      $i++;
   }
   echo json_encode($scores);
}

$req->close();
$db->close();
?>
