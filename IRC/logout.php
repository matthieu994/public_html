<?php
session_start();
session_destroy();
setcookie('return', 0, time() + (86400 * 30), '/');
$_SESSION = array();
header('Location: .');
?>
