<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');
    include_once('../templates/template_publications.php');
    include_once('../partials/fresh-page.php');
 
    $publications = getNewestPublications();

    if (!isset($_SESSION['username']))
        draw_header(NULL, ' | Fresh');
    else
        draw_header($_SESSION['username'], ' | Fresh');
        
    draw_fresh_page($publications);
    draw_footer();
?>