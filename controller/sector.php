<?php

use model\manager\SectorManager;

require_once "./model/manager/sectorManager.php";

if (isset($_GET)) {
    switch ($action) {
        case 'new':
            break;
        case 'update':
            break;
        case 'list':
            $view = "sector/list";
            $sectors = SectorManager::getAll();
            break;
    }
}