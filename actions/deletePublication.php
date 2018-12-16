<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
    {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'You need to Login first!');
        die(header('Location: ../pages/login.php'));
    }

    $username = $_SESSION['username'];
    $publication_id = $_GET['publication_id'];

    if(checkIsPublicationOwner($username,$publication_id))
    {
        deletePublication($publication_id);
    }

    header('Location: ../pages/fresh.php');
?>