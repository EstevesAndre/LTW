<?php 
    include_once('../includes/session.php');
    include_once('../templates/template_common.php');
    include_once('../templates/template_publications.php');

    // verifies if user is logged in
    if (isset($_SESSION['username']))
        die(header('Location: mainMenu.php'));
        
    draw_header('', ' | New Article');
    draw_new_article();
    draw_footer();
?>