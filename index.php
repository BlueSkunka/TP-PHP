<?php
//Inclusion des classes

// include "model/pdo.php";
include 'view/layout/head.php';

// *** on récupère l'action à entreprendre *** 
if (isset ($_GET['action']))
{
	$controllerName = $_GET['action'];
	if ($controllerName != "connexion"){
		session_start();
	}
}
else
{
	$controllerName = 'home';
}

// *** traitement de l'action ***
$controller = 'controller/'.$controllerName.'.php';
include $controller;

// *** génération de la vue ***
// $view = '';

// *** Affichage de la navbar sauf si la page de connexion est à chargé ***

include 'view/'.$view.'.php';

include "view/layout/footer.php";
?>