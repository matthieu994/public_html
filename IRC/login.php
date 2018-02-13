<?php
session_start();
if($_POST["username"] == "petitm" && $_POST["pass"] != "") {
   $_SESSION["connected"] = 1;
   $_SESSION["username"] = $_POST["username"];
   $_SESSION["try"] = 0;
   header('Location: .');
} else {
   $_SESSION["connected"] = 0;
   $_SESSION["try"] = 1;
   header('Location: .');
}
?>
