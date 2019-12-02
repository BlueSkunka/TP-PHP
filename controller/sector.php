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

            // Try to create the entity with the constructor.
            $sector = new Sector($id, $_POST["label"]);
            SectorManager::save($sector);

            $view = "sector/list";
            $sectors = SectorManager::getAll();
            break;
        case 'new':
            $sector = null;
            $view = "sector/form";

            break;
        case 'delete':
            $id = $_GET['id'];

            // @TODO: Check if there is no attached structure to this sector.

            $view = "sector/list";
            $sectors = SectorManager::getAll();
            break;
        case 'edit':

            $view = "sector/form";
            $id = $_GET['id'];
            $sector = SectorManager::getFromId($id);
            break;
        case 'list':
            $view = "sector/list";
            $sectors = SectorManager::getAll();
            break;
    }
}