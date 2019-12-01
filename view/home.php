<?php
// print_r($associations);
?>


<div class="container gap-top-sm">
    <div class="row">
        <div class="col-lg-8">
            <h1>Dashboard</h1>
            <p> Vous retrouverez ici quelque statistique des entrées en base de données.
                Vous pouvez ajouter ou lister chaque entité en cliquant sur l'entité correspondante disponible
                dans la barre de navigation. </p>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-4 text-center">
            <p><span class="flashy-text"><?= count($companies) ?></span> Entreprise(s)</p>
        </div>
        <div class="col-lg-4 text-center">
            <p><span class="flashy-text"><?= count($associations) ?></span> Association(s)</p>
        </div>
        <div class="col-lg-4 text-center">
            <p><span class="flashy-text"><?= count($sectors) ?></span> Secteur(s)</p>
        </div>
    </div>
</div>
