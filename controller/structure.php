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

$selectedStructure = null;

// Switch to the right action
// according to the action GET parameter
if (isset($_GET)) {
    switch ($action) {
        case 'new':

            if (isset($_SESSION["last_structure_id"])) {
                $lastStructureId = $_SESSION["last_structure_id"];
                if ($lastStructureId != null) {
                    $tempSelectedStructure = StructureManager::getFromId($lastStructureId);
                    if ($tempSelectedStructure != null) {
                        $selectedStructure = $tempSelectedStructure;
                    }
                }
            }

            $isEditMode = false;

            $sectors = SectorManager::getAll();
            $view = "structure/form";

            break;

        case 'edit':

            $isEditMode = true;

            $id = $_GET['id'];
            $selectedStructure = StructureManager::getFromId($id);

            $sectors = SectorManager::getAll();
            $view = "structure/form";

            break;

        case 'delete':
            $id = $_GET['id'];
            StructureManager::delete($id);

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
            $sectors = [];
            foreach ($_POST["sector"] as $key => $value) {
                $sectors[] = SectorManager::getFromId($value);
            }

            $entity = null;
            if ($_POST["type"] == "association") {
                $entity = new Association($id, $_POST["name"], $_POST["streetName"], $_POST["postalCode"], $_POST["cityName"], $_POST["participantNumber"], $sectors);
            } else {
                $entity = new Company($id, $_POST["name"], $_POST["streetName"], $_POST["postalCode"], $_POST["cityName"], $_POST["participantNumber"], $sectors);
            }


            $structureId = StructureManager::save($entity);

            if (!$id) {
                $_SESSION['last_structure_id'] = $structureId;
            }


        case 'list':
        default:

            $companies = CompanyManager::getAll();
            $associations = AssociationManager::getAll();

            $view = "structure/list";
            break;
    };
}
