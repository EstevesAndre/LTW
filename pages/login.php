<?php 
    include_once('../includes/session.php');
    include_once('../templates/template_account.php');
    include_once('../templates/template_common.php');

    // verifies if user is logged in
    if (isset($_SESSION['username']))
        die(header('Location: mainMenu.php'));
        
    draw_header(null, ' | Login');
    draw_login();
    draw_footer();
?>