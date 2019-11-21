<?php

function initiateConnection() {
    include_once __DIR__. "/../config/db.php";
    $credentials = getDatabaseCredentials();

    try{
        $pdo = new PDO('mysql:host='.$credentials["host"].';dbname='.$credentials["db"].';charset=utf8', $credentials["user"], $credentials["password"]);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch(Exception $e){
        die('Erreur :'.$e->getMessage());
    }
}