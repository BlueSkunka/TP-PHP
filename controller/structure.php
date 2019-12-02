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

            // Retrieve the id if it's an edit, else it will be null.
            $id = null;
            if (isset($_POST["id"])) {
                $id = intval($_POST["id"]);
            }

            // Try to create the entity with the constructor.
            $sector = SectorManager::getFromId($_POST["sector"]);
            $entity = null;
            if ($_POST["type"] == "association") {
                $entity = new Association($id, $_POST["name"], $_POST["streetName"], $_POST["postalCode"], $_POST["cityName"], $_POST["participantNumber"], $sector);
            } else {
                $entity = new Company($id, $_POST["name"], $_POST["streetName"], $_POST["postalCode"], $_POST["cityName"], $_POST["participantNumber"], $sector);
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
}

?>