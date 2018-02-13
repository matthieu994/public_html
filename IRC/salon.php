<?php
session_start();

if(isset($_POST["pseudo"])) {
   $_SESSION["pseudo"] = $_POST["pseudo"];
   $_SESSION["salon"] = $_POST["salon"];
   $_SESSION["connected"] = 1;
}
else if(!isset($_SESSION["pseudo"])) {
   $_SESSION["connected"] = 0;
   header('Location: logout.php');
}
if (isset($_POST["pseudo"]) && $_POST["pseudo"] == "") {
   $_SESSION["connected"] = 0;
   header('Location: logout.php');
}

setcookie('pseudo', $_SESSION["pseudo"], time() + (86400 * 30), '/');
$pseudo = strtolower($_SESSION["pseudo"]);
$salon = strtoupper($_SESSION["salon"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title><?php echo ucfirst($pseudo) . ' - ' . $salon ?></title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

   <div class="profil animated fadeInDown">
      <i class="fas fa-user" style="font-size: 70px; margin: 10px; display: inline-block; cursor: pointer;"></i>
      <h1 style="vertical-align: 12px; display: inline-block;"> Profil </h1>
      <div class="dropdown">
         <p class="profil-info"> Mon pseudo: <b style="font-weight: bold"><?php echo ucfirst($pseudo) ?></b></p>
         <p class="profil-info"> Messages envoyés: <b style="font-weight: bold"><?php echo $_COOKIE["msg_sent"] ?></b></p>
      </div>
      <a class="logout" href="logout.php">Se déconnecter</a>
   </div>

   <div class="irc">
      <p class="bienvenue animated zoomIn"> Bienvenue dans le salon <b style="font-weight: bold"><?php echo $salon ?></b></p>
   </div>

</body>

<script type="text/javascript">

var drop = document.getElementsByClassName('fa-user');

function show () {
   var el = document.getElementsByClassName('dropdown')[0];

   el.style.display = "block";
   el.style.visibility = "visible";
}

function hide () {
   var el = document.getElementsByClassName('dropdown')[0];

   el.style.display = "none";
   el.style.visibility = "hidden";
}

drop[0].addEventListener("mouseover", show);
drop[0].addEventListener("mouseout", hide);

</script>

</html>
