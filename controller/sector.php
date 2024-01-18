<?php

use model\manager\SectorManager;
use model\Sector;

require_once "./model/manager/sectorManager.php";

if (isset($_GET)) {
    switch ($action) {
        case 'handle_submit':

            // Retrieve the id if it's an edit, else it will be null.
            $id = null;
            if (isset($_POST["id"])) {
                $id = intval($_POST["id"]);
            }

            $sector = new Sector($id, $_POST["label"]);
            SectorManager::save($sector);

            $_SESSION["sector"] = ["label" => $_POST["label"]];

            $view = "sector/list";
            $sectors = SectorManager::getAllWithExtraInformations();
            break;
        case 'new':
            $lastInputValue = $_SESSION["sector"];
            $sector = null;
            $view = "sector/form";

            break;
        case 'delete':
            $id = $_GET['id'];

            SectorManager::delete($id);
            $sectors = SectorManager::getAllWithExtraInformations();
            $view = "sector/list";

            break;
        case 'edit':

            $view = "sector/form";
            $id = $_GET['id'];
            $sector = SectorManager::getFromId($id);
            break;
        case 'list':
            $view = "sector/list";
            $sectors = SectorManager::getAllWithExtraInformations();
            break;
    }
}
