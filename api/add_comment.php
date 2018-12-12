<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_publications.php');

    $username = $_SESSION['username'];
    $publication_id = $_POST['publication_id'];
    $comment_id = $_POST['comment_id'];
    $fulltext = htmlentities($_POST['fulltext']);
    
    if($comment_id != NULL)
        insertComment($username, NULL, $comment_id, '', $fulltext);
    else
        insertComment($username, $publication_id, NULL, '', $fulltext);
    
    $comments = getPublicationComments($publication_id);
    drawCommentsOfPublication($publication_id, $comments);
?>