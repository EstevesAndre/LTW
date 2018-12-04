<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');
    include_once('../templates/template_publications.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));
        
    $publications = getPublications();

    draw_header($_SESSION['username'], ' | Fresh');
    draw_publications($publications);
    draw_footer();
?>