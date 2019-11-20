<?php

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
        
        $view = "structure/list";

        break;

    case 'delete':
        
        $view = "structure/delete";

        break;

};

?>