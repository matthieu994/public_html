<?php

$id = $_GET['id'];

include('bdd.php');

$query = "DELETE FROM listeDeCourse where identifiant='$id'";

$result = mysqli_query($db, $query) or die(mysql_error());

mysqli_close($db);

header('Location: courses.php');
?>
