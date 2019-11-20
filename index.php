<?php

// *** import de la connexion à la bdd ***
require "model/pdo.php";

// *** import des modèles ***

// *** demarrage de la session ***
session_start();

// *** on récupère l'action à entreprendre *** 
if (isset ($_GET['action']))
{
	$controllerName = $_GET['controller'];
	$action = $_GET['action'];
}
else
{
	$controllerName = 'home';
}

// *** traitement de l'action ***
$controller = 'controller/'.$controllerName.'.php';
include $controller;

// *** génération de la page ***
include 'view/layout/header.php';
include 'view/layout/navbar.php';
include 'view/'.$view.'.php';
include "view/layout/footer.php";

?>