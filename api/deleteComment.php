<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));

    $username = $_SESSION['username'];
    $publication_id = $_GET['publication_id'];
    $comment_id = $_GET['comment_id'];

    if(checkIsCommentOwner($username,$comment_id))
    {
        deleteComment($comment_id);
    }

    header("Location: ../pages/publication.php?publication_id=$publication_id");
?>