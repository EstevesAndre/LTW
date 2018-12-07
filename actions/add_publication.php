<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));

    $username = $_SESSION['username'];
    $category = $_POST['category'];
    $title = $_POST['title'];
    $fulltext = $_POST['fulltext'];

    $category = preg_replace ("/[^a-zA-Z\s]/", '', $category);
    $title = preg_replace ("/[^a-zA-Z\s]/", '', $title);
    $fulltext = preg_replace ("/[^a-zA-Z\s]/", '', $fulltext);

    insertPublication($username,$category,$title,$fulltext);

    header('Location: ../pages/fresh.php');
?>