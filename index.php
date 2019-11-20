<?php
//Inclusion des classes
if (isset ($_GET['control']))
{

}
include "modele/connexion.php";
include 'view/layout/head.php';

// *** on récupère l'action à entreprendre *** 
if (isset ($_GET['control']))
{
	$control = $_GET['control'];
	if ($control != "connexion"){
		session_start();
		if (isset($_SESSION["user"])) {
			$util = unserialize($_SESSION['user']);
		}else{
			header("Location: index.php");
		}
	}
}
else
{
	$control = 'init';
}

// *** traitement de l'action ***
$scriptControl = 'controller/';
include $scriptControl;

// *** génération de la vue ***
$scriptVue = '';

// *** Affichage de la navbar sauf si la page de connexion est à chargé ***
if ($scriptVue != "view/v-init.php")
{
	include "view/layout/navbar.php";
}
include $scriptVue;
//include "view/layout/footer.php";
?>