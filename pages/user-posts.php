<?php 
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');
    include_once('../templates/template_account.php');
    include_once('../templates/template_publications.php');
    include_once('../partials/user-page.php');

    $user = getUserInfo($_SESSION['username']);

    $pubOfUser = getUserPublications($user);
    
    draw_header($_SESSION['username'], ' | User');
    draw_user_page($user['username'], $pubOfUser);
    draw_footer();
?>