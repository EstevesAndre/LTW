<?php 
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');
    include_once('../templates/template_account.php');
    
    // verifies if user is logged in
    if (!isset($_SESSION['username']))
        die(header('Location: login.php'));

    $user = getUserInfo($_SESSION['username']);
    
    draw_header($_SESSION['username'], ' | Edit Profile');
    draw_editProfile($user);
    draw_footer();
?>