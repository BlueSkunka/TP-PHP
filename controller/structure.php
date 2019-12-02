<?php

use model\Association;
use model\Company;
use model\manager\CompanyManager;
use model\manager\AssociationManager;
use model\manager\SectorManager;
use model\manager\StructureManager;

require_once "./model/manager/associationManager.php";
require_once "./model/manager/companyManager.php";
require_once "./model/manager/structureManager.php";
require_once "./model/manager/sectorManager.php";

// *** appelle de la fonction ***
$selectedStructure = null;

if (isset($_GET)) {
    switch ($action) {
        case 'new':

            $view = "structure/form";
            $sectors = SectorManager::getAll();

            break;

        case 'show':

            $view = "structure/show";

            break;

        case 'edit':

            $view = "structure/form";
            $id = $_GET['id'];
            $selectedStructure = StructureManager::getFromId($id);
            $sectors = SectorManager::getAll();

            break;

        case 'delete':
            $id = $_GET['id'];
            StructureManager::delete($id);

            require_once "./model/manager/companyManager.php";
            require_once "./model/manager/associationManager.php";

            $companies = CompanyManager::getAll();
            $associations = AssociationManager::getAll();

            $view = "structure/list";
            break;
        case 'handle_submit':
            $entity = null;
            if ($_POST["type"] == "association") {
                $entity = new Association(null, $_POST["name"], $_POST["streetName"], $_POST["postalCode"], $_POST["cityName"], 0);
            } else {
                $entity = new Company(null, $_POST["name"], $_POST["streetName"], $_POST["postalCode"], $_POST["cityName"], 0);
            }

            StructureManager::save($entity);

        case 'list':
        default:
            require_once "./model/manager/companyManager.php";
            require_once "./model/manager/associationManager.php";

            $companies = CompanyManager::getAll();
            $associations = AssociationManager::getAll();

            $view = "structure/list";
            break;

    };
} else {
    var_dump("OK POST");
    echo "test";
    require_once "./model/manager/companyManager.php";
    require_once "./model/manager/associationManager.php";

    $companies = CompanyManager::getAll();
    $associations = AssociationManager::getAll();

    $view = "structure/list";
}

?>