<?php 
    include_once('../includes/session.php');
    include_once('../templates/template_account.php');
    include_once('../templates/template_common.php');


    // verifies if the user is logged in
    if (isset($_SESSION['username']))
        die(header('Location: mainMenu.php'));
        
    draw_header(' | Sign Up');
    draw_signup();
    draw_footer();
?>