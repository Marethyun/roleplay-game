<?php

session_start();

include_once 'db.php';

if (isset($_SESSION['id'])) {
	header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['username']) && isset($_POST['password'])){
		$user = getUserByName($_POST['username'], $pdo);
		if (is_null($user)){
			echo "Bad credentials";
		} else {
			if ($_POST['password'] === $user['password']){
				$_SESSION['id'] = $user['id'];
				$_SESSION['name'] = $user['name'];
				$_SESSION['master'] = $user['master'];

				header("Location: index.php");
			} else {
				echo "Bad credentials";
			}
		}
	} else {
		echo "Bad request";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body style="margin-top: 10px;">
	<div class="container">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title">Connectez-vous</h1>
				</div>
				<div class="panel-body">
					<form action="login.php" method="POST">
						<input type="text" name="username" autocomplete="off"><br>
						<input type="password" name="password" autocomplete="off"><br>
						<input type="submit" name="Login">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>