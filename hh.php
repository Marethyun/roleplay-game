<?php
	session_start();
	if (!isset($_SESSION['id'])){
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dés</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<input type="hidden" id="userid" value=<?= $_SESSION['id'] ?>>
	<input type="hidden" id="username" value=<?= $_SESSION['name'] ?>>
	<input type="hidden" id="usermaster" value=<?= $_SESSION['master'] ?>>
</head>
<body>
	<div id="#login">
		<p>Vous êtes connecté en tant que: <?= $_SESSION['name'] ?> !</p>
		<p><a href="disconnect.php">Déconnexion</a></p>
	</div>
	<hr>
	<div id="game">
		<div id="dice">
			<h1>Lancer un dé</h1>
			<input type="text" name="faces" id="faces"><br>
			<?php if ($_SESSION['master'] == 1) { ?>
				<label for="hidden">Cacher</label>
				<input type="checkbox" name="hidden" id="hidden">
			<?php } ?>
			<button id="run">Lancer</button>
		</div>
		<hr>
		<div id="chat">
		
		</div>
		<div id="players">
		</div>
	</div>

</body>
<script type="text/javascript" src="js/jscolor.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script src="https://use.fontawesome.com/7336673297.js"></script>
</html>