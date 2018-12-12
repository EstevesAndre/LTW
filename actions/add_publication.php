<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));

    $username = $_SESSION['username'];
    $category = htmlentities($_POST['category']);
    $title = htmlentities($_POST['title']);
    $fulltext = htmlentities($_POST['fulltext']);

    if($category != NULL)
        insertPublication($username,$category,$title,$fulltext);
    else 
        insertPublication($username,'General',$title,$fulltext);

    header('Location: ../pages/fresh.php');
?>