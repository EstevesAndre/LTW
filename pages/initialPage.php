<?php
    include_once('../includes/session.php');
    include_once('../templates/template_common.php');    
    include_once('../partials/initial-page.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        draw_header(NULL,'');
    else
        draw_header($_SESSION['username'] ,'');

    draw_initial_page();
    draw_footer();
?>