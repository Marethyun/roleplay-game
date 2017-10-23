<?php
	session_start();
	if (!isset($_SESSION['id'])){
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Jeu de rôle</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style type="text/css">
		.game {
			padding: 0
		}
		.picker {
			width: 100px;
			display: inline-block;
		}
	</style>
	<input type="hidden" id="userid" value=<?= $_SESSION['id'] ?>>
	<input type="hidden" id="username" value=<?= $_SESSION['name'] ?>>
	<input type="hidden" id="usermaster" value=<?= $_SESSION['master'] ?>>
</head>
<body>

<div id="topbar">
	<span>Connecté en tant que <b><?= $_SESSION['name'] ?></b> - </span><a href="disconnect.php">Déconnexion</a>
	<?php if ($_SESSION['master'] == 1){ ?>
		<span style="float: right;">Vous êtes un maître du jeu</span>
	<?php } else { ?>
		<span style="float: right;">Vous êtes un joueur</span>
	<?php } ?>
</div>

<div class="container">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<h1>Jeu de rôle</h1>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="col-lg-8 container game">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Lancer un dé</h3>
				</div>
				<div class="panel-body" id="dice">
					<div class="container game">
						<div class="col-lg-3 game" id="form-dice">
							<form>
								<div class="form-group">
									<label for="faces">Faces du dé</label>
									<input id="faces" type="text" class="form-control">
								</div>
								<?php if ($_SESSION['master'] == 1) { ?>
								<div class="form-check">
    								<label class="form-check-label">
      									<input id="hidden" type="checkbox" class="form-check-input">
      									Cacher
    								</label>
  								</div>
  								<?php } ?>
							</form>
							<button id="run" class="btn btn-primary">Lancer</button>
						</div>
						<div class="col-lg-3" id="form-result">
							<form>
								<div class="form-group">
									<label for="result">Résultat</label>
									<input class="form-control" type="text" name="result" id="result" disabled>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Log d'évènements</h3>
				</div>
				<div class="panel-body" id="chat">

				</div>
			</div>		
		</div>
	</div>
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Joueurs</h3>
			</div>
			<div class="panel-body" id="players">
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jscolor.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>