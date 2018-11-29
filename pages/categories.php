<?php
    include_once('../includes/session.php');
    include_once('../templates/template_common.php');
    include_once('../partials/categories-page.php');

    // verifies if user is logged in
    if (isset($_SESSION['username']))
        die(header('Location: mainMenu.php'));
        
    draw_header(null);
    draw_categories();
    draw_footer();
?>