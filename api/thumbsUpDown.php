<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));

    $username = $_SESSION['username'];
    $publication_id = $_GET['publication_id'];
    $comment_id = $_GET['comment_id'];
    $choice = $_GET['choice'];
    $option = $_GET['option'];

    if($comment_id != NULL)
        $vote = getVote($username, NULL, $comment_id);
    else
        $vote = getVote($username, $publication_id, NULL);

    if($choice == 'up')
    {
        if($vote != NULL)
        {
            if ($vote['upDown'] == 1)
                deleteVote($vote['id']);
            else if($vote['upDown'] == -1)
                toggleVote($vote['id']);
        }
        else
        {
            if($comment_id != NULL)
                insertVote("C", $username, NULL, $comment_id, 1);
            else
                insertVote("P", $username, $publication_id, NULL, 1);
        }
    }
    else if($choice == 'down')
    {
        if($vote != NULL)
        {
            if ($vote['upDown'] == -1)
                deleteVote($vote['id']);
            else if($vote['upDown'] == 1)
                toggleVote($vote['id']);
        }
        else
        {
            if($comment_id != NULL)
                insertVote("C", $username, NULL, $comment_id, -1);
            else
                insertVote("P", $username, $publication_id, NULL, -1);
        }
    }

    if($option == 'fresh')        
        header('Location: ../pages/fresh.php');
    else if($option == 'single_article')
        header("Location: ../pages/publication.php?publication_id=$publication_id");
?>