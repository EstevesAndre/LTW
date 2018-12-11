<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));

    $username = $_SESSION['username'];
    $publication_id = $_POST['publication_id'];
    $comment_id = $_POST['comment_id'];
    $choice = $_POST['choice'];
    $option = $_POST['option'];

    if($comment_id != NULL)
        $vote = getVote($username, NULL, $comment_id);
    else
        $vote = getVote($username, $publication_id, NULL);
        
    if($choice == 'up')
    {
        if($vote != NULL)
        {
            if ($vote['upDown'] == 1)
            {
                deleteVote($vote['id']);
                echo json_encode(null);
            }
            else if($vote['upDown'] == -1)
            {
                toggleVote($vote['id']);

                $voteChanged = getVoteWithId($vote['id']);
                echo json_encode($voteChanged);
            }
        }
        else
        {
            $id = 1;
            if($comment_id != NULL)
                $id = insertVote("C", $username, NULL, $comment_id, 1);
            else
                $id = insertVote("P", $username, $publication_id, NULL, 1);
            
            $voteChanged = getVoteWithId($id);
            echo json_encode($voteChanged);
        }
    }
    else if($choice == 'down')
    {
        if($vote != NULL)
        {
            if ($vote['upDown'] == -1)
            {
                deleteVote($vote['id']);
                echo json_encode(null);
            }
            else if($vote['upDown'] == 1)
            {
                toggleVote($vote['id']);   

                $voteChanged = getVoteWithId($vote['id']);
                echo json_encode($voteChanged);
            }
        }
        else
        {
            $id = 1;
            if($comment_id != NULL)
                $id = insertVote("C", $username, NULL, $comment_id, -1);
            else
                $id = insertVote("P", $username, $publication_id, NULL, -1);
            
            $voteChanged = getVoteWithId($id);
            echo json_encode($voteChanged);
        }
    }
?>