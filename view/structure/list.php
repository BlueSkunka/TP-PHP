<?php require_once "config/base_path.php" ?>
<div class="container gap-top-sm">
    <div class="row">
        <div class="col-lg-8">
            <h1>Structure : Liste</h1>
            <p> D'ici, vous pouvez voir les strucures existantes ou bien en créer une nouvelle en cliquant sur le
                bouton nouveau.</p>
        </div>
        <div class="col-lg-2 offset-lg-2">
            <a class="button-link-create" href="<?= BASE_PATH ?>/index.php?controller=structure&action=new">
                Nouveau </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <h3> Associations : </h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Rue</th>
                    <th scope="col">CP</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Nombre de donateur</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($associations as $association) {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $association->getId() . "</th>";
                    echo "<th scope=\"row\">" . $association->getName() . "</th>";
                    echo "<th scope=\"row\">" . $association->getStreetName() . "</th>";
                    echo "<th scope=\"row\">" . $association->getPostalCode() . "</th>";
                    echo "<th scope=\"row\">" . $association->getCityName() . "</th>";
                    echo "<th scope=\"row\">" . $association->getDonorNumber() . "</th>";
                    echo "<th scope=\"row\"> <a href='#'><i class=\"material-icons orange600\">edit</i></a> 
                            <a href='#'><i class=\"material-icons red600\">delete</i></a>
                         </th>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <h3> Entreprises : </h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Rue</th>
                    <th scope="col">CP</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Nombre d'actionnaires</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($companies as $company) {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $company->getId() . "</th>";
                    echo "<th scope=\"row\">" . $company->getName() . "</th>";
                    echo "<th scope=\"row\">" . $company->getStreetName() . "</th>";
                    echo "<th scope=\"row\">" . $company->getPostalCode() . "</th>";
                    echo "<th scope=\"row\">" . $company->getCityName() . "</th>";
                    echo "<th scope=\"row\">" . $company->getShareholderNumber() . "</th>";
                    echo "<th scope=\"row\"> <a href='#'><i class=\"material-icons orange600\">edit</i></a> 
                            <a href='#'><i class=\"material-icons red600\">delete</i></a>
                         </th>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
