<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');
    include_once('../partials/categories-page.php');
    
    $channels = getChannels();

    if (!isset($_SESSION['username']))
        draw_header(NULL, ' | Categories');
    else
        draw_header($_SESSION['username'], ' | Categories');
        
    draw_categories($channels);
    draw_footer();
?>