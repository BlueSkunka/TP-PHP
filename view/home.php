<?php

use projet\model\Structure;
include_once "model/Structure.php";

    echo "<p>ok?</p>";

    $res = Structure::getFromId(2);
    // var_dump($res);

    echo "<p>It works!</p>";