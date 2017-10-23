<?php

$pdo = new PDO('mysql:host=localhost;dbname=des;charset=utf8', 'root', '');


function getUser($id, $pdo)
{
	$req = $pdo->prepare('SELECT * FROM users WHERE id = :user');
    $req->execute(array('user' => $id));

    return $req->fetchAll()[0];
}

function getUserByName($name, $pdo)
{
	$req = $pdo->prepare('SELECT * FROM users WHERE name = :user');
    $req->execute(array('user' => $name));
    $user = $req->fetchAll();

    if (sizeof($user) > 0){
    	return $user[0];
	}
}