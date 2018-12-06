<?php 
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');
    include_once('../templates/template_publications.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));
    
    $pub_id = $_GET['publication_id'];
    $pub = getPublication($pub_id);

    $comments = getPublicationComments($pub_id);
    $vote = getVote($_SESSION['username'], $pub_id);    
    $votes_cnt = [ 'up' => getPublicationVotes($pub_id,1)['cnt'], 'down' => getPublicationVotes($pub_id,-1)['cnt']];

    draw_header($_SESSION['username'], ' | ' . $pub['title']);
    if($vote == NULL)
        draw_singlePublication($pub,$comments, 0, $votes_cnt);
    else 
        draw_singlePublication($pub,$comments, $vote['upDown'], $votes_cnt);
    
    draw_footer();
?>