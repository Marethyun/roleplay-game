<?php

session_start();

include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data = $pdo->query('SELECT * FROM chat');

    $json = array();

    $data = $data->fetchAll();
    for ($i = 0; $i < sizeof($data); $i++) { 

    	$currjson = array();

    	$row = $data[$i];
    	$key = $i;

    	$sender = $row['sender_id'];

    	$usender = getUser($sender, $pdo);
        
    	$user = getUser($_SESSION['id'], $pdo);

    	$hidden = $row['hidden'];

    	if ($hidden != 1 || $user['master'] == 1){

    		$currjson['id'] = $row['id'];
    		$message = str_replace('{NAME}', $usender['name'], $row['message']);

    		$currjson['sender'] = $sender;
    		$currjson['message'] = $message;

    		$currjson['color'] = $usender['color'];

    		$currjson['hidden'] = $row['hidden'];

    		array_push($json, $currjson);
    	}
    }

    if (isset($json)){
    	echo json_encode(['data' => $json], JSON_UNESCAPED_UNICODE);
	} else {
		echo '{"data":[]}';
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['message']) && isset($_POST['sender']) && isset($_POST['hidden'])) {
		$user = getUser($_POST['sender'], $pdo);

		$hidden = $_POST['hidden'] == 1 && $user['master'] == 1 ? 1 : 0;

		$req = $pdo->prepare("INSERT INTO chat (message, sender_id, hidden) VALUES(:message, :sender, :hidden)");
		$req->execute(array(
			'message' => $_POST['message'],
			'sender' => $_POST['sender'],
			'hidden' => $hidden
		));

		echo json_encode(array('success' => true));
	} else {
		echo json_encode(array('success' => false));
	}
}