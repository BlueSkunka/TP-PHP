<?php require_once "config/base_path.php" ?>
<div class="container gap-top-sm">
    <div class="row">
        <div class="col-lg-8">
            <h1>Secteurs : Liste</h1>
            <p> D'ici, vous pouvez voir les secteurs existants ou bien en créer un nouvel en cliquant sur le
                bouton nouveau.</p>
        </div>
        <div class="col-lg-2 offset-lg-2">
            <a class="button-link-create" href="<?= BASE_PATH ?>/index.php?controller=sector&action=new">
                Nouveau </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10">
            <h3> Secteurs : </h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Libellé</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($sectors as $sector) {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $sector->getId() . "</th>";
                    echo "<th scope=\"row\">" . $sector->getLabel() . "</th>";
                    echo "<th scope=\"row\"> 
                            <a href='". BASE_PATH . "/index.php?controller=sector&action=edit&id=". $sector->getId() ."'>
                                <i class=\"material-icons orange600\">edit</i>
                            </a> 
                            <a href='". BASE_PATH . "/index.php?controller=sector&action=delete&id=". $sector->getId() ."'>
                                <i class=\"material-icons red600\">delete</i>
                            </a>
                         </th>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>