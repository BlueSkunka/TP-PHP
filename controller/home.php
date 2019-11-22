<?php

use model\Association;
use model\Company;

require_once "./model/Association.php";
require_once "./model/Company.php";

/**
 * * récupération de toutes les structures et
 * * secteurs pour un affichage global 
 */
$associations = Association::getAll();
$companies = Company::getAll();
// $sectors = Sector::getAll();

$view = "home";
