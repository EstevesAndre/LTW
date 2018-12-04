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

    $votes = [ 'up' => getPublicationVotes($pub_id,1)['cnt'], 'down' => getPublicationVotes($pub_id,-1)['cnt']];

    draw_header($_SESSION['username'], ' | ' . $pub['title']);
    draw_singlePublication($pub,$comments,$votes);
    draw_footer();
?>