<?php

use model\manager\AssociationManager;
use model\manager\CompanyManager;

require_once "./model/manager/associationManager.php";
require_once "./model/manager/companyManager.php";

/**
 * * récupération de toutes les structures et
 * * secteurs pour un affichage global 
 */
$associations = AssociationManager::getAll();
$companies = CompanyManager::getAll();
// $sectors = Sector::getAll();

$view = "home";
