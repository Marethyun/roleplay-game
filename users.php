<?php

error_reporting(E_ALL);

include_once 'db.php';

$data = $pdo->query('SELECT * FROM users');

$json;

foreach ($data as $key => $row) {
	$json[$key]['id'] = $row['id'];
	$json[$key]['name'] = $row['name'];
	$json[$key]['color'] = $row['color'];
	$json[$key]['master'] = $row['master'];
}

echo json_encode(["data" => $json]);

?>