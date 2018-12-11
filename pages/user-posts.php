<?php 
    include_once('../includes/session.php');
    include_once('../database/db_getQueries.php');
    include_once('../templates/template_common.php');
    include_once('../templates/template_account.php');
    include_once('../templates/template_publications.php');
    include_once('../partials/user-page.php');
    
    $username = $_GET['username'];
    $pubOfUser = getUserPublications($username);
    
    if (!isset($_SESSION['username']))
        draw_header(NULL, ' | User');
    else
        draw_header($_SESSION['username'], ' | User');

    draw_user_page($username, $pubOfUser);
    draw_footer();
?>