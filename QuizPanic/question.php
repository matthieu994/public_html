<?php
session_start();
require('bdd.php');

if (isset($_POST['deleteSet'])) {
   $req = $db->prepare("DELETE FROM questions WHERE question_set=? AND username=?");
   $req->bind_param('ss', $_POST['deleteSet'], $username); $req->execute();
   // echo $_POST['deleteSet'];
   return;
}
if(isset($_POST['getQuestions'])) {
   $username = $_SESSION['username'];
   $req = $db->prepare("SELECT * from questions WHERE username=? OR question_set='Public'");
   $req->bind_param('s', $username);
   $req->execute();
   $result = $req->get_result();
   while ($row = $result->fetch_array()) {
      $questionset = $row['question_set'];
      if ($row['question_set'] == null) $questionset = "NULL";
      echo '<div question_set="'. $questionset .'" question_id="'. $row['id'] .'" style="display: none">
      <i class="fas fa-info-circle"></i>
      <span>' . $row['question'] . '</span>';
      echo '<select>';
      for ($i = 1; $i <= 4; $i++) {
         if ($i == $row['good_answer']) {
            echo '<option value='. $i .' selected>' . $row['answer'.$i] . '</option>';
         } else
         echo '<option value='. $i .'>' . $row['answer'.$i] . '</option>';
      }
      echo '</select>';
      if ($row['question_set'] != "Public" || $row['username'] == $username) {
         echo '<i class="fas fa-pencil-alt"></i>
         <i class="fas fa-trash-alt" style="color: #d72d2d"></i>';
      }
      echo '</div>';
   }
   $req->close();
   $db->close();
}
if (isset($_POST['deleteQuestion'])) { //Suppression question
   $req = $db->prepare("SELECT username FROM questions WHERE id=?");
   $req->bind_param('s', $_POST['id']);
   $req->execute();
   $result = $req->get_result();
   $row = $result->fetch_array();
   if($row['username'] != $username) { //On verifie que la question est à l'user
      echo "ERROR_PERM_UPDATE";
      return;
   }
   $req = $db->prepare("DELETE FROM questions WHERE id=? AND username=?");
   $req->bind_param('ss', $_POST['id'], $username);
   $req->execute();
   echo $_POST['id'];
}
else {
   if(!isset($_POST['question']) || !isset($_POST['answer1']) || !isset($_POST['answer2']) || !isset($_POST['answer3']) || !isset($_POST['answer4']) || !isset($_POST['good_answer'])) {
      // header('Location: .');
      return;
   }
   $question = $_POST['question'];
   $answer1 = $_POST['answer1'];
   $answer2 = $_POST['answer2'];
   $answer3 = $_POST['answer3'];
   $answer4 = $_POST['answer4'];
   $good_answer = $_POST['good_answer'];
   $id = $_POST['id'];

   if (isset($_POST['modifyQuestion'])) { //Modification question
      $req = $db->prepare("SELECT username FROM questions WHERE id=?");
      $req->bind_param('s', $id);
      $req->execute();
      $result = $req->get_result();
      $row = $result->fetch_array();
      if($row['username'] != $username) { //On verifie que la question est à l'user
         echo "ERROR_PERM_UPDATE";
         return;
      }

      if(isset($_POST['sets'])) {
         $req = $db->prepare("UPDATE questions SET question = ?, answer1 = ?, answer2 = ?, answer3 = ?, answer4 = ?, good_answer = ?, question_set = ? WHERE id=? AND username=?");
         $req->bind_param('sssssssss', $question, $answer1, $answer2, $answer3, $answer4, $good_answer, $_POST['sets'], $id, $username);
         echo "modify";
      }
      else {
         $req = $db->prepare("UPDATE questions SET question = ?, answer1 = ?, answer2 = ?, answer3 = ?, answer4 = ?, good_answer = ? WHERE id=? AND username=?");
         $req->bind_param('ssssssss', $question, $answer1, $answer2, $answer3, $answer4, $good_answer, $id, $username);
      }
   }
   else { //Ajout question
      if(isset($_POST['sets']) && $_POST['sets'] != "Public" && $_POST['sets'] != "NULL" && $_POST['sets'] != "Indéfini") { //Set defini
         $req = $db->prepare("INSERT INTO questions (username, question, answer1, answer2, answer3, answer4, good_answer, question_set) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
         $req->bind_param('ssssssss', $username, $question, $answer1, $answer2, $answer3, $answer4, $good_answer, $_POST['sets']);
      }
      else { //Set NULL
         $req = $db->prepare("INSERT INTO questions (username, question, answer1, answer2, answer3, answer4, good_answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
         $req->bind_param('sssssss', $username, $question, $answer1, $answer2, $answer3, $answer4, $good_answer);
      }
   }

   $req->execute();
   $req->close();
   $db->close();
}
?>
