<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');

    $username = $_SESSION['username'];
    $publication_id = $_POST['publication_id'];
    $comment_id = $_POST['comment_id'];
    $fulltext = $_POST['fulltext'];
    
    $id = 0;

    if($comment_id != NULL)
        $id = insertComment($username, NULL, $comment_id, '', $fulltext);
    else
        $id = insertComment($username, $publication_id, NULL, '', $fulltext);
       
    //header("Location: ../pages/publication.php?publication_id=$publication_id");
    $comment = getComment($id);
    echo json_encode($comment);
?>