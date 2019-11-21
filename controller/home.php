<?php

require_once "./../model/Association.php";

/**
 * * récupération de toutes les structures et
 * * secteurs pour un affichage global 
*/
var_dump("blabla");
$associations = Association::getAll();
var_dump('asso OK');
$companies = Company::getAll();
var_dump("company ok");
// $sectors = Sector::getAll(); 

$view = "home";

?>