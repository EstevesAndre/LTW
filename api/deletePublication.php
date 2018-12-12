<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));

    $username = $_SESSION['username'];
    $publication_id = $_GET['publication_id'];

    if(checkIsPublicationOwner($username,$publication_id))
    {
        deletePublication($publication_id);
    }

    header('Location: ../pages/fresh.php');
?>