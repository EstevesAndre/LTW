<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));

    $username = $_SESSION['username'];
    $publication_id = $_GET['publication_id'];
    $fulltext = $_POST['fulltext'];
    $fulltext = preg_replace ("/[^a-zA-Z\s]/", '', $fulltext);

    insertComment($username, $publication_id, NULL, '2018-12-04 23:59:59', '', $fulltext);
   
    header("Location: ../pages/publication.php?publication_id=$publication_id");
?>