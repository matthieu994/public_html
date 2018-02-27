<?php
if(isset($_POST["salon"])) {
   $salon = $_POST["salon"];
   $pseudo = $_POST["pseudo"];
}
else {
   $salon = $_SESSION["salon"];
   $pseudo = $_SESSION["pseudo"];
}

if(isset($_POST["usercolor"]) && $_POST["usercolor"] != "#1c2824" && $_POST["usercolor"] != "#000000") {
   setcookie('usercolor', $_POST["usercolor"], time() + (86400 * 30), '/');
}
else if (!isset($_COOKIE["usercolor"]) || $_COOKIE["usercolor"] == "#000000") {
   setcookie('usercolor', "#1c2824", time() + (86400 * 30), '/');
}

if(isset($_POST["othercolor"]) && $_POST["othercolor"] != "#3d514a" && $_POST["othercolor"] != "#000000") {
   setcookie('othercolor', $_POST["othercolor"], time() + (86400 * 30), '/');
}
else if (!isset($_COOKIE["othercolor"]) || $_COOKIE["othercolor"] == "#000000") {
   setcookie('othercolor', "#3d514a", time() + (86400 * 30), '/');
}

$filename = "salons/" . $salon . ".txt";
$file = fopen($filename, 'r+');

// while(!feof($file))
// {
//    $string = htmlspecialchars(fgets($file));
//    $array = explode(' ', $string);
//
//    if($string == "")
//    break;
//
//    // On récupère le pseudo du message
//    $chat_pseudo = rtrim($array[3], ':');
//
//    // On ne garde que le texte du message envoyé
//    array_splice($array, 0, 4);
//    $text = implode($array, " ");
//
//    if($chat_pseudo == $pseudo) {
//       $class = "user";
//       $message = '<span>' . $text . '</span>';
//    }
//    else {
//       $class = "other";
//       $message = '<span>' . '<b style="font-weight: bold;">' . $chat_pseudo . '</b>' . ': ' . $text . '</span>';
//    }
//
//    $line = '<div class="' . $class . '">' . $message . '</div>';
//
//    echo $line;
// }

$offset = 0;
$prev_date = 0;
while (!feof($file)) {
   $len = fgets($file);

   if($len == "")
   break;

   $data = fgets($file);
   $data_array = explode(' ', $data);
   $current_pseudo = substr($data_array[2], 0, -1);

   $offset += strlen($data) + strlen($len);
   $text = file_get_contents($filename, NULL, NULL, $offset, $len-2);
   $time = '<label class="time">' . $data_array[1] . '<label>';

   if($current_pseudo == $pseudo) {
      $class = "user";
      $span = '<span style="background: ' . $_COOKIE["usercolor"] . '">' . $text . '</span>';
   }
   else {
      $class = "other";
      $span = '<span style="background: ' . $_COOKIE["othercolor"] . '">' . '<b style="font-weight: bold;">' . $current_pseudo . '</b>' . ': ' . $text . '</span>';
   }

   if($prev_date != $data_array[0])
   echo '<div class="date"><span>' . $data_array[0] . '</span></div>';

   echo '<div class="' . $class . '">' . $span . $time . '</div>';

   $int = 0;
   while($int != $len) {
      fgetc($file);
      $int++;
   }
   $offset = ftell($file);
   $prev_date = $data_array[0];
}

fclose($file);
?>
