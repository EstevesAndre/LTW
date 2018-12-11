<?php
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');
    include_once('../partials/categories-page.php');

    // verifies if user is logged in
    // if (!isset($_SESSION['username']))
    //     die(header('Location: login.php'));
    
    $channels = getChannels();

    draw_header($_SESSION['username'], ' | Categories');
    draw_categories($channels);
    draw_footer();
?>