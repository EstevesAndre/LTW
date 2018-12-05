<?php 
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');
    include_once('../templates/template_account.php');

    $user = getUserInfo($_SESSION['username']);
    
    draw_header($_SESSION['username'], ' | Edit Profile');
    draw_editProfile($user);
    draw_footer();
?>