<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../partials/category-page.php');
    include_once('../templates/template_publications.php');

    $username = $_SESSION['username'];
    $idChannel = $_POST['idChannel'];

    if(isUserSubOfChannel($username, $idChannel))
        deleteUserLikesChannel($idChannel, $username);
    else
        insertUserLikesChannel($idChannel,$username);

    draw_sub($idChannel);
?>