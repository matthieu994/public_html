<?php
session_start();

if (!isset($_COOKIE["usercolor"]) || $_COOKIE["usercolor"] == "#000000") {
   $usercolor = "#1c2824";
}
else
$usercolor = $_COOKIE["usercolor"];

if (!isset($_COOKIE["othercolor"]) || $_COOKIE["othercolor"] == "#000000") {
   $othercolor = "#3d514a";
}
else $othercolor = $_COOKIE["othercolor"];

if(isset($_POST["pseudo"])) {
   $_SESSION["pseudo"] = trim(htmlspecialchars($_POST["pseudo"]));
   $_SESSION["salon"] = $_POST["salon"];
   $_SESSION["connected"] = 1;
}
else if(!isset($_SESSION["pseudo"])) {
   header('Location: logout.php');
}
if (isset($_POST["pseudo"]) && $_POST["pseudo"] == "") {
   header('Location: logout.php');
}

setcookie('pseudo', $_SESSION["pseudo"], time() + (86400 * 30), '/');
setcookie('salon', $_SESSION["salon"], time() + (86400 * 30), '/');
setcookie('return', 0, time() + (86400 * 30), '/');

$pseudo = $_SESSION["pseudo"];
$salon = strtoupper($_SESSION["salon"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title><?php echo $pseudo . ' - ' . $salon ?></title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="style.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
</head>
<body>

   <div class="header animated <?php if(!$_COOKIE["return"]) echo "fadeInDown";?>">
      <div id="profil">
         <i class="fas fa-user" style="font-size: 70px; margin: 10px; display: inline-block; cursor: pointer;"></i>
         <h1 style="vertical-align: 12px; display: inline-block; cursor: pointer;"> Profil </h1>
         <div class="dropdown">
            <p> Mon pseudo: <b><?php echo $pseudo ?></b></p>
            <p> Messages envoyés: <b><?php echo $_COOKIE["count"] ?></b></p>
            <p class="profil-settings"><b> Couleur: </b><i class="fas fa-cog"></i></p>
         </div>
      </div>
      <a class="logout" href="logout.php">Se déconnecter</a>
   </div>

   <div class="settings" id="settings">
      <!-- <div class="date">
      <span> Paramètres </span>
           </div> -->
      <div class="other">
         <span> Choisis une couleur! </span>
      </div>
      <div class="user">
         <span> <i class="fab fa-android" style="font-size: 25px;"></i> > <i class="fab fa-apple" style="font-size: 25px;"></i> </span>
      </div>
      <div class="colors">
         <input type="color" id="othercolor">
         <input type="color" id="usercolor">
      </div>

   </div>

   <div class="irc animated <?php if(!$_COOKIE["return"]) echo "zoomIn";?>">
      <p class="bienvenue"> Bienvenue dans le salon <b><?php echo $salon ?></b></p>
      <div class="messages" id="messages">

         <!-- LECTURE FICHIER -->

         <?php include('load.php') ?>

         <?php  ?>

         <!-- FIN LECTURE -->

      </div>

      <div class="chat">
         <form id="form" action="message.php" method="post">
            <textarea id="chatarea" maxlength="300" placeholder="Entrez votre message ici" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez votre message ici'" name="message" required></textarea>
            <button class="envoyer">Envoyer</button>
         </form>
      </div>
   </div>

</body>

<style>
/* .other span {
background: #3d514a;
}

.user span {
background: #1c2824;
} */
</style>

<script src="script.js"></script>
<script>
window.addEventListener("load", startup, false);
function startup() {
   inputOther.value = <?php echo '"' . $othercolor . '"' ?>;
   inputUser.value = <?php echo '"' . $usercolor . '"' ?>;
   console.log("other: <?php echo $othercolor ?>");
   console.log("user: <?php echo $usercolor ?>");
   updateExemples();
   updateAll();

   inputOther.addEventListener("input", updateExemples, false);
   // inputOther.addEventListener("change", updateAll, false);
   inputOther.select();
   inputUser.addEventListener("input", updateExemples, false);
   // inputUser.addEventListener("change", updateAll, false);
   inputUser.select();
}

var auto_refresh = setInterval(function(){
   $('#messages').load('load.php', {salon: "<?php echo $salon ?>", pseudo: "<?php echo $pseudo ?>", othercolor: defaultOther, usercolor: defaultUser});
   // scroll();
}, 500);
</script>

</html>
