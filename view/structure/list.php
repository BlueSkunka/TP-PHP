<?php require_once "config/base_path.php"?>
<div class="container gap-top-sm">
    <div class="row">
        <div class="col-lg-8">
            <h1>Structure : Liste</h1>
            <p> D'ici, vous pouvez voir les strucures existantes ou bien en créer une nouvelle en cliquant sur le
            bouton nouveau.</p>
        </div>
        <div class="col-lg-2 offset-lg-2">
            <a class="button-link-create" href="<?= BASE_PATH ?>/index.php?controller=structure&action=new"> Nouveau </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Libellé</th>
                </tr>
                </thead>
                <tbody>

                <!--<tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                </tr>-->
                </tbody>
            </table>
        </div>
    </div>


</div>
