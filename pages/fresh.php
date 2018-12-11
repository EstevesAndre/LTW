<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');
    include_once('../templates/template_publications.php');
    include_once('../partials/fresh-page.php');

    // verifies if user is logged in
    // if (!isset($_SESSION['username']))
    //     die(header('Location: login.php'));
        
    $publications = getNewestPublications();

    draw_header($_SESSION['username'], ' | Fresh');
    draw_fresh_page($publications);
    draw_footer();
?>