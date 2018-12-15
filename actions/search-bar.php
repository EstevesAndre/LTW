<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');

    $search = htmlentities($_POST['search']);

    header('Location: ../pages/search.php?search=' . $search);
?>