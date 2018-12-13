<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_publications.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));

    $username = $_SESSION['username'];
    $publication_id = $_POST['publication_id'];
    $comment_id = $_POST['comment_id'];

    if(checkIsCommentOwner($username,$comment_id))
    {
        deleteComment($comment_id);
    }

    $comments = getPublicationComments($publication_id);
    drawCommentsOfPublication($publication_id, $comments);
?>