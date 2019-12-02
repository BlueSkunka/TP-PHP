<?php
use model\manager\CompanyManager;
use model\manager\AssociationManager;
use model\manager\StructureManager;

require_once "./model/manager/associationManager.php";
require_once "./model/manager/companyManager.php";
require_once "./model/manager/structureManager.php";

// *** appelle de la fonction ***
$selectedStructure = null;

if (isset($_GET)) {
    switch ($action) {
        case 'new':

            $view = "structure/form";
            break;

        case 'show':

            $view = "structure/show";

            break;

        case 'edit':

            $view = "structure/form";
            $id = $_GET['id'];
            $selectedStructure = StructureManager::getFromId($id);

            break;

        case 'handle_submit':
            var_dump($_POST);
        case 'list':
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