<?php 
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');
    include_once('../templates/template_publications.php');

    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));
    
    $pref_category = $_GET['pref_category'];

    $channels = getChannels();

    draw_header($_SESSION['username'], ' | New Article');
    draw_new_article($channels, $pref_category);
    draw_footer();
?>