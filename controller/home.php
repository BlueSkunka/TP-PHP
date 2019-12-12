<?php

use model\manager\AssociationManager;
use model\manager\CompanyManager;
use model\manager\SectorManager;

require_once "./model/manager/associationManager.php";
require_once "./model/manager/companyManager.php";
require_once "./model/manager/sectorManager.php";

/**
 * * récupération de toutes les structures et
 * * secteurs pour un affichage global 
 */
$associations = AssociationManager::getAll();
$companies = CompanyManager::getAll();
$sectors = SectorManager::getAll();

// ? Récupération du nombre total d'actionnaires / donateurs
$shareHolderNumber = 0;
$donorNumber = 0;

foreach ($associations as $association) {
    $donorNumber += $association->getDonorNumber();
}

foreach ($companies as $company) {
    $shareHolderNumber += $company->getShareholderNumber();
}

$view = "home";
