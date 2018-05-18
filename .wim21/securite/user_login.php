<?php
require_once 'lib/common.php';
session_start();

if (!empty($_REQUEST['login']) && !empty($_REQUEST['password'])) {
	$db = initDatabase();
	$sql = "SELECT * FROM user "
	."WHERE login='".$_POST['login']."' AND password='".$_POST['password']."'";
	$user = $db->query($sql)->fetch(PDO::FETCH_OBJ);
	if ($user) {
			$_SESSION['user'] = $user;
			header('Location: article_list.php');
			exit();
	}
}

?>
<?php
include 'templates/header.php';
?>

<body container>

<h1>Authentification et injection SQL</h1>
<form action="" method="POST">
<fieldset>
<div>
	<label>	Login : <input name="login" type="text" value="<?php if (isset($_REQUEST['login'])) { echo $_REQUEST['login']; } ?>" /> </label></div>
<div><label>		Mot de passe : <input name="password" type="password" value="" /> </label></div>
		<button type="submit" name="ok" value="1">S'authentifier</button>
</fieldset>
</form>
<?php
include './templates/footer.php';
?>
</body>
</html>
