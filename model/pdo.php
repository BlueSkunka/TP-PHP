<?php

$server = '';
$dbname = '';
$user = '';
$password = '';

try{
    $pdo = new PDO('mysql:host='.$server.';dbname='.$dbname.';charset=utf8', $user, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch(Exception $e){
	die('Erreur :'.$e->getMessage());
}
?>