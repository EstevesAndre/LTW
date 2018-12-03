<?php
    include_once('../includes/session.php');
    include_once('../database/db_getLists.php');
    include_once('../templates/template_common.php');
    include_once('../templates/template_publications.php');

    // verifies if user is logged in
    if (isset($_SESSION['username']))
        die(header('Location: mainMenu.php'));
        
    $publications = getPublications();

    draw_header('', ' | Fresh');
    draw_publications($publications);
    draw_footer();
?>