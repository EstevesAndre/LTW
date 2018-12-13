<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_publications.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: ../actions/login.php'));

    $username = $_SESSION['username'];
    $publication_id = $_POST['publication_id'];
    $comment_id = $_POST['comment_id'];
    $publication_username = $_POST['publication_username'];
    $comment_username = $_POST['comment_username'];
    $choice = $_POST['choice'];
    $option = $_POST['option'];

    if($comment_id != NULL && $comment_id != "")
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
            {
                deleteVote($vote['id']);                
                if($comment_id != NULL && $comment_id != "")
                    insertVote("C", $username, NULL, $comment_id, 1);
                else
                    insertVote("P", $username, $publication_id, NULL, 1);
            }
        }
        else
        {
            if($comment_id != NULL && $comment_id != "")
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
            {
                deleteVote($vote['id']);
                if($comment_id != NULL && $comment_id != "")
                    insertVote("C", $username, NULL, $comment_id, -1);
                else
                    insertVote("P", $username, $publication_id, NULL, -1);
            }
        }
        else
        {
            if($comment_id != NULL && $comment_id != "")
                insertVote("C", $username, NULL, $comment_id, -1);
            else
                insertVote("P", $username, $publication_id, NULL, -1);
        }
    }
        
    if($option == 'fresh')        
    {
        $newVote = getVote($username, $publication_id, NULL);
        drawFreshVotes($publication_id, $newVote['upDown'], $publication_username);
    }
    else if($option == 'single_article')
    {        
        if($comment_id != NULL && $comment_id != "")
        {   
            $newVote = getVote($username, NULL, $comment_id);
            $commentVoteCnt = [ 'up' => getPublicationVotes(NULL,$comment_id,1)['cnt'], 'down' => getPublicationVotes(NULL, $comment_id,-1)['cnt']]; 
                                    
            drawInPubVotes($publication_id,$comment_id, $newVote['upDown'], $commentVoteCnt, $publication_username, $comment_username);
        }
        else
        {
            $newVote = getVote($username, $publication_id, NULL);
            $votes_cnt = [ 'up' => getPublicationVotes($publication_id, NULL, 1)['cnt'], 'down' => getPublicationVotes($publication_id, NULL,-1)['cnt']];

            drawInPubVotes($publication_id, NULL, $newVote['upDown'], $votes_cnt, $publication_username, $comment_username);
        }
    }
?>