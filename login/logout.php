<?php
session_start();
$_SESSION["connected"] = 0;
$_SESSION["try"] = 0;
header('Location: .');
?>
