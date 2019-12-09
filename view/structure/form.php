<?php
require_once "config/base_path.php";

use model\Association;
use model\Company;

$structureType = $selectedStructure ? ($selectedStructure instanceof Association ? ("association") : "company") : null;
$participantNumber = $structureType ? ($structureType == "association" ? ($selectedStructure->getDonorNumber()) : $selectedStructure->getShareholderNumber()) : null;

?>
<div class="container gap-top-sm">
    <div class="row">
        <div class="col-lg-8">
            <h1><?= $action == "new" ? "Création" : "Edition" ?> d'une structure</h1>
        </div>
        <div class="col-lg-4">
            <a href="<?= BASE_PATH ?>/index.php?controller=structure&action=list"><button class="btn btn-secondary btn-lg">Retour</button></a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="offset-lg-3 col-lg-6">
            <form method="post" action="<?= BASE_PATH ?>/index.php?controller=structure&action=handle_submit">
                <input type="hidden" name="id" value="<?= $selectedStructure ? $selectedStructure->getId() : null ?>" />
                <div class="form-group">
                    <label for="name">Nom <span class="required">*</span></label>
                    <input required id="name" name="name" type="text" placeholder="WWF" value="<?= $selectedStructure ? $selectedStructure->getName() : null ?>" />
                </div>

                <div class="form-group">
                    <label for="streetName">Rue <span class="required">*</span></label>
                    <input required id="streetName" name="streetName" type="text" placeholder="15 rue pierre dupont" value="<?= $selectedStructure ? $selectedStructure->getStreetName() : null ?>" />
                </div>

                <div class="form-group">
                    <label for="cityName">Ville <span class="required">*</span></label>
                    <input required id="cityName" name="cityName" type="text" placeholder="Grenoble" value="<?= $selectedStructure ? $selectedStructure->getCityName() : null ?>" />
                </div>

                <div class="form-group">
                    <label for="postalCode">Code postal <span class="required">*</span></label>
                    <input required id="postalCode" name="postalCode" type="number" placeholder="38610" value="<?= $selectedStructure ? $selectedStructure->getPostalCode() : null ?>" />
                </div>

                <div class="form-group">
                    <label for="postalCode">Type <span class="required">*</span></label>
                    <div class="form-group">
                        <label class="radio-label" for="association">
                            <input required id="association" name="type" type="radio" onclick="handleRadioClick(this);" value="association" <?= $selectedStructure instanceof Association ? "checked" : "" ?> />
                            Association
                        </label>

                        <label class="radio-label" for="company">
                            <input required id="company" name="type" type="radio" onclick="handleRadioClick(this);" value="company" <?= $selectedStructure instanceof Company ? "checked" : "" ?> />
                            Entreprise
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="participantNumber" id="participantNumber">Nombre de donateur(s) <span class="required">*</span></label>
                    <input required id="participantNumber" name="participantNumber" type="number" placeholder="50000" value="<?= $participantNumber ?>" />
                </div>

                <!-- CREATE CASE -->
                <?php if (!$selectedStructure) { ?>
                    <div class="form-group">
                        <label for="sector">Secteur(s) <span class="required">*</span></label> &nbsp;
                        <div class="btn btn-primary btn-sm" id="btnAddSector">Ajouter secteur</div>
                        <br><br>
                        <div class="row" style="padding-left: 3%;" id="prototype/__0__/">
                            <select required name="sector[]" id="sector" class="col-lg-10">
                                <option value=""></option>
                                <?php
                                    foreach ($sectors as $sector) {
                                        echo "<option label=" . $sector->getLabel() . " value=" . $sector->getId() . ">" . $sector->getLabel() . "</option>";
                                    }
                                    ?>
                            </select>
                            <div class="col-lg-2"><i class="material-icons" id="iconRemoveSector" style="color: red" onclick="removeSector(this)">delete</i></div>
                            <br><br>
                        </div>
                    </div>
                <?php } else { ?>

                    <!-- UPDATE CASE -->
                    <div class="form-group">
                        <label for="sector">Secteur(s) <span class="required">*</span></label> &nbsp;
                        <div class="btn btn-primary btn-sm" id="btnAddSector">Ajouter secteur</div>
                        <br><br>
                        <?php
                            $i = 0;
                            foreach ($selectedStructure->getSectors() as $secteur) {
                                if (0 == $i)
                                    echo '<div class="row" style="padding-left: 3%;" id="prototype/__0__/">';
                                else
                                    echo '<div class="row" style="padding-left: 3%;">';


                                echo '
                                        <select required name="sector[]" id="sector" class="col-lg-10">
                                            <option value=""></option>';

                                foreach ($sectors as $sector) {
                                    var_dump($secteur->getId(), $sector->getId());
                                    if ($secteur->getId() == $sector->getId())
                                        echo "<option label=" . $sector->getLabel() . " value=" . $sector->getId() . " selected='selected'>" . $sector->getLabel() . "</option>";
                                    else
                                        echo "<option label=" . $sector->getLabel() . " value=" . $sector->getId() . ">" . $sector->getLabel() . "</option>";
                                }

                                echo '  </select>
                                        <div class="col-lg-2">
                                            <i class="material-icons" id="iconRemoveSector" style="color: red" onclick="removeSector(this)">delete</i>
                                        </div>
                                        <br><br>
                                        </div>
                                        ';

                                $i++;
                            }
                            ?>



                    </div>

                <?php } ?>

                <div class="form-group">
                    <button class="button-link-create mx-auto"><?= $action == "new" ? "Créer" : "Modifier" ?></button>
                </div>
            </form>
        </div>
    </div>
    <script src="javascript/structure_form.js"></script>
</div>