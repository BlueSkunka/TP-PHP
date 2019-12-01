<?php
use model\manager\CompanyManager;
use model\manager\AssociationManager;

// *** appelle de la fonction ***
switch ($action) {
    case 'new':
        
        $view = "structure/form";
        break;
    
    case 'show':
        
        $view = "structure/show";
        
        break;

    case 'edit':
        
        $view = "structure/form";
        $formAction = "edit";

        break;

    case 'list':
        require_once "./model/manager/companyManager.php";
        require_once "./model/manager/associationManager.php";

        $companies = CompanyManager::getAll();
        $associations = AssociationManager::getAll();

        $view = "home";
        $view = "structure/list";

        break;

    case 'delete':
        
        $view = "structure/delete";

        break;

};

?>