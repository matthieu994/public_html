<?php
include('bdd.php');
$s = $_GET['s'] . '%';
$req = $db->prepare("SELECT * FROM paiement WHERE personne LIKE ?");
$req->bind_param('s', $s);
$req->execute();

$result = $req->get_result();

while($row = $result->fetch_array())
  {
    echo '<div>' . $row['personne'] . '</div>';
  }
?>
