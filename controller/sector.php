<?php

use model\manager\SectorManager;

require_once "./model/manager/sectorManager.php";

if (isset($_GET)) {
    switch ($action) {
        case 'new':
            $sector = null;
            $view = "sector/form";
            break;
        case 'delete':
            $id = $_GET['id'];

            // @TODO: Check if there is no attached structure to this sector.
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