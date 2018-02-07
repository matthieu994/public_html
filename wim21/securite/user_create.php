<?php
require_once 'lib/common.php';
session_start();

if (!empty($_POST['name']) && !empty($_POST['login']) && !empty($_POST['password'])) {
	$db = initDatabase();
	$sql = "INSERT INTO user (name, login, password, url) "
		."VALUES ('".$_POST['name']."', '".$_POST['login']."', '".$_POST['password']
		."', '" . $_POST['url'] . "')";
	try{   
		if ($db->query($sql)){
			header('Location: user_login.php');
			exit();
		}else{
			die("Erreur !!!!");
		}
	} catch(PDOException $e) {
		echo "Erreur: ".$e;
	}
}

?>

<?php
include './templates/header.php';
?>

<body container>

<h1>Création de compte</h1>
<form action="" method="POST">
<fieldset>
<div> 
		<label>Nom  <input name="name" type="text" value="" /> </label>
</div>
	<div><label>	Site perso : <input name="url" type="text" value="" /> </label></div>

<div><label>		Login : <input name="login" type="text" value="" /> </laebl></div>
<div><label>		Mot de passe : <input name="password" type="password" value="" /> </label></div>
		<button type="submit" name="ok" value="1">Créer ce compte</button>
</fieldset>
</form>

<p> <a href="article_list.php">Retour à la liste des articles</a> </p>

<?php
include './templates/footer.php';
?>

</body>
</html>
