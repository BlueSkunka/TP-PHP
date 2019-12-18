<?php
    require_once "config/base_path.php";

    function getPreferedValue($sector, $lastInputValue) {
        if ($sector && $sector != null) {
            return $sector->getLabel();
        } else {
            return $lastInputValue["libelle"];
        }
    }
?>
<div class="container gap-top-sm">
    <div class="row">
        <div class="col-lg-8">
            <h1><?= $action == "new" ? "Création" : "Edition" ?> d'un secteur</h1>
        </div>
        <div class="col-lg-4">
            <a href="<?= BASE_PATH ?>/index.php?controller=sector&action=list"><button class="btn btn-secondary btn-lg">Retour</button></a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="offset-lg-3 col-lg-6">
            <form method="post" action="<?= BASE_PATH ?>/index.php?controller=sector&action=handle_submit">
                <input type="hidden" name="id" value="<?= $sector ? $sector->getId() : null ?>" />
                <div class="form-group">
                    <label for="label">Libellé <span class="required">*</span></label>
                    <input required id="label" name="label" type="text" placeholder="Informatique" value="<?= getPreferedValue($sector, $lastInputValue) ?>" />
                </div>

                <div class="form-group">
                    <button class="button-link-create mx-auto"><?= $action == "new" ? "Créer" : "Modifier" ?></button>
                </div>
            </form>
        </div>
    </div>
</div>