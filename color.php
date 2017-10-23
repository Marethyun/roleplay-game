<?php

session_start();

include_once 'db.php';
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//if (isset($_POST['color']) && isset($_POST['playerid'])){
	if (isset($_POST['color']) && isset($_POST['playerid']) && !is_null($_SESSION['id'])){
		$color = $_POST['color'];
		$playerid = $_POST['playerid'];

		$user = getUser($playerid, $pdo);
		//$master = getUser(1, $pdo);
		$master = getUser($_SESSION['id'], $pdo);

		if (!is_null($user)){
			if ($master['master'] == 1){
				$req = $pdo->prepare('UPDATE users SET color = :color WHERE id = :id');
				$req->execute(array(
					'color' => $color,
					'id' => $playerid
				));
				echo json_encode(array('success' => true));
			} else {
				echo json_encode(array('success' => false));
			}
		} else {
			echo json_encode(array('success' => false));
		}
	} else {
		echo json_encode(array('success' => false));
	}
}