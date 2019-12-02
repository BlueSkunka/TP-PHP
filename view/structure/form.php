<?php
require_once "config/base_path.php";

use model\Association;
use model\Company;

?>
<div class="container gap-top-sm">
    <div class="row">
        <div class="col-lg-8">
            <h1><?= $action == "new" ? "Création" : "Edition" ?> d'une structure</h1>
        </div>
    </div>
    <div class="row mt-4">
        <div class="offset-lg-3 col-lg-6">
            <form method="post" action="<?= BASE_PATH ?>/index.php?controller=structure&action=handle_submit">
                <input type="hidden" name="id" value="<?= $selectedStructure ? $selectedStructure->getId() : null ?>"/>
                <div class="form-group">
                    <label for="name">Nom <span class="required">*</span></label>
                    <input required id="name" name="name" type="text" placeholder="WWF"
                           value="<?= $selectedStructure ? $selectedStructure->getName() : null ?>"/>
                </div>

                <div class="form-group">
                    <label for="streetName">Rue <span class="required">*</span></label>
                    <input required id="streetName" name="streetName" type="text" placeholder="15 rue pierre dupont"
                           value="<?= $selectedStructure ? $selectedStructure->getStreetName() : null ?>"/>
                </div>

                <div class="form-group">
                    <label for="cityName">Ville <span class="required">*</span></label>
                    <input required id="cityName" name="cityName" type="text" placeholder="Grenoble"
                           value="<?= $selectedStructure ? $selectedStructure->getCityName() : null ?>"/>
                </div>

                <div class="form-group">
                    <label for="postalCode">Code postal <span class="required">*</span></label>
                    <input required id="postalCode" name="postalCode" type="number" placeholder="38610"
                           value="<?= $selectedStructure ? $selectedStructure->getPostalCode() : null ?>"/>
                </div>

                <div class="form-group">
                    <label for="postalCode">Type <span class="required">*</span></label>
                    <div class="form-group">
                        <label class="radio-label" for="association">
                            <input required id="association" name="type" type="radio" value="association"
                                <?= $selectedStructure instanceof Association ? "checked" : "" ?>/>
                            Association
                        </label>

                        <label class="radio-label" for="company">
                            <input required id="company" name="type" type="radio" value="company"
                                <?= $selectedStructure instanceof Company ? "checked" : "" ?>/>
                            Entreprise
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button class="button-link-create mx-auto"><?= $action == "new" ? "Créer" : "Modifier" ?></button>
                </div>
            </form>
        </div>
    </div>
    <?php var_dump($selectedStructure); ?>
</div>