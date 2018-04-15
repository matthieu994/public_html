<?php
session_start();
require('bdd.php');

if(isset($_POST['getQuestions'])) {
   // $style = ' style="
   // display: none;
   // position: absolute;
   // width: 100px;
   // height: 100px;
   // border: 1px solid white;
   // top: -90px;
   // left: -90px;" ';
   $username = $_SESSION['username'];
   $req = $db->prepare("SELECT * from questions WHERE username=?");
   $req->bind_param('s', $username);
   $req->execute();
   $result = $req->get_result();
   while ($row = $result->fetch_array()) {
      echo '<div question_id="'. $row['id'] .'">
      <i class="fas fa-info-circle"></i>
      <span>' . $row['question'] . '</span>';
      echo '<select>';
      for ($i = 1; $i <= 4; $i++) {
         if ($i == $row['good_answer']) {
            echo '<option value='. $i .' selected>' . $row['answer'.$i] . '</option>';
         } else
         echo '<option value='. $i .'>' . $row['answer'.$i] . '</option>';
      }
      echo '</select>
      <i class="fas fa-pencil-alt"></i>
      </div>';
   }
   $req->close();
   $db->close();
}
else {
   if(!isset($_POST['question']) || !isset($_POST['answer1']) || !isset($_POST['answer2']) || !isset($_POST['answer3']) || !isset($_POST['answer4']) || !isset($_POST['good_answer'])) {
      header('Location: .');
      return;
   }
   $username = $_SESSION['username'];
   $question = $_POST['question'];
   $answer1 = $_POST['answer1'];
   $answer2 = $_POST['answer2'];
   $answer3 = $_POST['answer3'];
   $answer4 = $_POST['answer4'];
   $good_answer = $_POST['good_answer'];
   $id = $_POST['id'];

   if (isset($_POST['modifyQuestion'])) {
      $req = $db->prepare("UPDATE questions SET question = ?, answer1 = ?, answer2 = ?, answer3 = ?, answer4 = ?, good_answer = ? WHERE id=?");
      $req->bind_param('sssssss', $question, $answer1, $answer2, $answer3, $answer4, $good_answer, $id);
   }
   else {
      $req = $db->prepare("INSERT INTO questions (username, question, answer1, answer2, answer3, answer4, good_answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $req->bind_param('sssssss', $username, $question, $answer1, $answer2, $answer3, $answer4, $good_answer);
   }
   $req->execute();
   $req->close();
   $db->close();
   header('Location: .');
}
?>
