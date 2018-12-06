<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));

    $username = $_SESSION['username'];
    $publication_id = $_GET['publication_id'];
    $choice = $_GET['choice'];
    $option = $_GET['option'];

    $vote = getVote($username, $publication_id);

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
            insertVote("P", $username, $publication_id, NULL, 1);
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
            insertVote("P", $username, $publication_id, NULL, -1);
    }

    if($option == 'fresh')        
        header('Location: ../pages/fresh.php');
    else if($option == 'single_article')
        header("Location: ../pages/publication.php?publication_id=$publication_id");
?>