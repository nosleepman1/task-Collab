<?php 

    $currentPage = "tasks";
    $title = "tasks";

    ob_start();

    ?>

        <h1>Bienvenue  <?= $_SESSION["username"] ?> </h1>

    <?php

    $content = ob_get_clean();
    require_once __DIR__ ."/../layouts/main.php";
?>