<?php 
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');
    include_once('../templates/template_publications.php');

    $pub_id = $_GET['publication_id'];
    $pub = getPublication($pub_id);

    $comments = getPublicationComments($pub_id);
    $votes_cnt = [ 'up' => getPublicationVotes($pub_id, NULL, 1)['cnt'], 'down' => getPublicationVotes($pub_id, NULL,-1)['cnt']];
    
    if (!isset($_SESSION['username']))
    {
        $vote = ['upDown' => 0];
        draw_header(NULL, ' | ' . $pub['title']);
        draw_singlePublication($pub,$comments, 0, $votes_cnt);
    }
    else
    {
        $vote = getVote($_SESSION['username'], $pub_id, NULL);   
        draw_header($_SESSION['username'], ' | ' . $pub['title']);
        draw_singlePublication($pub,$comments, $vote['upDown'], $votes_cnt);
    }

    draw_footer();
?>