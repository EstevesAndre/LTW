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
    $category = htmlentities($_POST['category']);
    $title = htmlentities($_POST['title']);
    $fulltext = htmlentities($_POST['fulltext']);

    if(!existsCategory($category))
        createsCategory($category);
    
    $id = insertPublication($username,$category,$title,$fulltext);

    header('Location: ../pages/publication.php?publication_id=' . $id );
?>