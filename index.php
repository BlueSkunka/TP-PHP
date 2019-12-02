<?php
// *** import de la connexion à la bdd ***
require "model/pdo.php";


// *** demarrage de la session ***
session_start();

// *** on récupère l'action à entreprendre ***
$action = null;
if (isset($_REQUEST['action'])) {
	$controllerName = $_GET['controller'];
	$action = $_GET['action'];
} else {
	$controllerName = 'home';
}

// *** traitement de l'action ***
$controller = './controller/' . $controllerName . '.php';
require $controller;

// *** génération de la page ***
require 'view/layout/header.php';
require 'view/layout/navbar.php';
require 'view/' . $view . '.php';
require "view/layout/footer.php";
